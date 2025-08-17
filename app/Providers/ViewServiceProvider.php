<?php

namespace App\Providers;

use App\Models\topikdinamis;
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

            if ($user) {
                $topiks = topikdinamis::where('status', 'on')
                    ->where('token_kelas', $user->token_kelas)
                    ->orderBy('urutan')
                    ->with([
                        'materi' => fn($q) => $q->where('status', 'on'),
                        'evaluasi' => fn($q) => $q->where('status', 'on'),
                        'upload' => fn($q) => $q->where('status', 'on'),
                    ])
                    ->get()
                    ->map(function ($topik) {
                        $gabungan = collect();

                        foreach ($topik->materi as $m) {
                            $gabungan->push([
                                'tipe' => 'materi',
                                'nama' => $m->nama_materi,
                                'urutan' => $m->urutan,
                            ]);
                        }

                        foreach ($topik->evaluasi as $e) {
                            $gabungan->push([
                                'tipe' => 'evaluasi',
                                'nama' => $e->nama_evaluasi,
                                'urutan' => $e->urutan,
                            ]);
                        }

                        foreach ($topik->upload as $u) {
                            $gabungan->push([
                                'tipe' => 'upload',
                                'nama' => $u->nama_upload,
                                'urutan' => $u->urutan,
                            ]);
                        }

                        $topik->subtopiks_urut = $gabungan->sortBy('urutan')->values();
                        return $topik;
                    });
                $tokenKelas = auth()->user()->token_kelas;

                $showMateriMenu = topikdinamis::whereIn('nama_topik', [
                    'pembukaan',
                    'kesejarahan',
                    'kewirausahaan'
                ])
                    ->where('status', 'on')
                    ->where('token_kelas', $tokenKelas)
                    ->exists();

                $view->with([
                    'topiks' => $topiks,
                    'showMateriMenu' => $showMateriMenu,
                ]);

            }
        });
    }
}
