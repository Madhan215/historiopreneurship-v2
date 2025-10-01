<?php

namespace App\Providers;

use App\Models\topikDinamis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('layouts.main', function ($view) {
            $user = Auth::user();

            if (!$user) {
                return; // kalau belum login, tidak usah lempar data
            }

            // --- Ambil token kelas ---
            $tokenKelas = collect();

            if (!empty($user->token_kelas) && is_array($user->token_kelas)) {
                // bentuk array [{"kode":"7BQBYF","status":"aktif"}, {"kode":"H3EML1","status":"tidak aktif"}]
                $tokenKelas = collect($user->token_kelas)
                    ->where('status', 'aktif') // ambil hanya yang aktif
                    ->pluck('kode')
                    ->filter()
                    ->values();
            } elseif (!empty($user->token_kelas)) {
                // fallback kalau ternyata hanya string biasa
                $tokenKelas = collect([$user->token_kelas]);
            }

            // --- Query topik ---
            $topiks = topikDinamis::where('status', 'on')
                ->whereIn('token_kelas', $tokenKelas)
                ->whereNotIn('nama_topik', ['pembukaan', 'kesejarahan', 'kewirausahaan']) 
                ->orderBy('urutan')
                ->with([
                    'materi'   => fn($q) => $q->where('status', 'on')->orderBy('urutan'),
                    'evaluasi' => fn($q) => $q->where('status', 'on')->orderBy('urutan'),
                    'upload'   => fn($q) => $q->where('status', 'on')->orderBy('urutan'),
                ])
                ->get()
                ->map(function ($topik) {
                    $gabungan = collect();

                    foreach ($topik->materi as $m) {
                        $gabungan->push([
                            'tipe'   => 'materi',
                            'nama'   => $m->nama_materi,
                            'urutan' => $m->urutan,
                        ]);
                    }

                    foreach ($topik->evaluasi as $e) {
                        $gabungan->push([
                            'tipe'   => 'evaluasi',
                            'nama'   => $e->nama_evaluasi,
                            'urutan' => $e->urutan,
                        ]);
                    }

                    foreach ($topik->upload as $u) {
                        $gabungan->push([
                            'tipe'   => 'upload',
                            'nama'   => $u->nama_upload,
                            'urutan' => $u->urutan,
                        ]);
                    }

                    $topik->subtopiks_urut = $gabungan->sortBy('urutan')->values();
                    return $topik;
                });

            // --- Cek apakah menu materi default perlu ditampilkan ---
            $showMateriMenu = topikDinamis::whereIn('nama_topik', [
                    'pembukaan',
                    'kesejarahan',
                    'kewirausahaan'
                ])
                ->where('status', 'on')
                ->whereIn('token_kelas', $tokenKelas)
                ->exists();

            // --- Lempar variabel ke view ---
            $view->with([
                'topiks'         => $topiks,
                'showMateriMenu' => $showMateriMenu,
            ]);
        });
    }
}
