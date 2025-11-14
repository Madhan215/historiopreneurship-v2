<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class kelompokController extends Controller
{
    /**
     * Tampilkan halaman pengaturan kelompok
     */
    public function dataKelompok()
    {
        $guru = Auth::user();

        // Ambil token guru
        $tokensGuru = $guru->token_kelas;
        if (is_string($tokensGuru)) {
            $tokensGuru = json_decode($tokensGuru, true);
        }

        if (!is_array($tokensGuru)) {
            return back()->with('error', 'Guru tidak memiliki token kelas.');
        }

        // Ambil hanya kode kelas guru yang statusnya aktif
        $kelasAktifGuru = collect($tokensGuru)
            ->filter(fn($t) => $t['status'] === 'aktif')
            ->pluck('kode')
            ->toArray();

        if (empty($kelasAktifGuru)) {
            return back()->with('error', 'Guru tidak memiliki kelas aktif.');
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SISWA YANG MEMILIKI KODE KELAS YANG SAMA DENGAN KELAS AKTIF GURU
        |--------------------------------------------------------------------------
        | CATATAN:
        | Status token siswa TIDAK DIPEDULIKAN. Yang penting kodenya cocok.
        |--------------------------------------------------------------------------
        */

        $siswa = User::where('peran', 'siswa')
            ->get()
            ->filter(function ($mhs) use ($kelasAktifGuru) {

                $token = $mhs->token_kelas;

                if (is_string($token)) {
                    $token = json_decode($token, true);
                }

                if (!is_array($token))
                    return false;

                foreach ($token as $t) {
                    // Bandingkan kode siswa dengan kode kelas aktif guru
                    if (in_array($t['kode'], $kelasAktifGuru)) {
                        return true;
                    }
                }

                return false;
            })
            ->sortBy('nama_lengkap')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA KELOMPOK SISWA KHUSUS UNTUK KODE KELAS AKTIF GURU
        |--------------------------------------------------------------------------
        */

        $emails = $siswa->pluck('email');

        // Hanya pilih kelompok pada kelas aktif (token_kelas = salah satu kode aktif guru)
        $kelompokData = Kelompok::whereIn('email', $emails)
            ->whereIn('token_kelas', $kelasAktifGuru)  // ← ambil hanya kelompok untuk kelas aktif guru
            ->get()
            ->keyBy('email');

        return view('lamanDosen.dataKelompok', compact('siswa', 'kelompokData'));
    }



    /**
     * Update / tambah kelompok manual
     */
    public function updateKelompok(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'id_kelompok' => 'required|integer'
        ]);

        $guru = Auth::user();

        // Ambil token guru yang aktif
        $tokenGuru = $guru->token_kelas;
        if (is_string($tokenGuru)) {
            $tokenGuru = json_decode($tokenGuru, true);
        }

        $kelasAktifGuru = collect($tokenGuru)
            ->where('status', 'aktif')
            ->pluck('kode')
            ->first();

        if (!$kelasAktifGuru) {
            return back()->with('error', 'Guru tidak memiliki kelas aktif.');
        }

        // CARI kelompok siswa KHUSUS kelas aktif
        $existing = Kelompok::where('email', $request->email)
            ->where('token_kelas', $kelasAktifGuru)
            ->first();

        if ($existing) {
            $existing->update([
                'id_kelompok' => $request->id_kelompok
            ]);
        } else {
            Kelompok::create([
                'email' => $request->email,
                'id_kelompok' => $request->id_kelompok,
                'token_kelas' => $kelasAktifGuru  // penting!
            ]);
        }

        return back()->with('success', 'Kelompok siswa berhasil diperbarui.');
    }




    /**
     * Mengatur kelompok siswa secara otomatis
     */
    public function autoKelompok()
    {
        $guru = Auth::user();

        // Ambil token guru & decode jika string
        $tokenGuru = $guru->token_kelas;
        if (is_string($tokenGuru)) {
            $tokenGuru = json_decode($tokenGuru, true);
        }

        // Ambil hanya token guru yang statusnya aktif
        $kelasAktifGuru = collect($tokenGuru)
            ->where('status', 'aktif')
            ->pluck('kode')
            ->first();

        if (!$kelasAktifGuru) {
            return back()->with('error', 'Guru tidak memiliki kelas aktif.');
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SISWA YANG PUNYA KODE KELAS = KELAS AKTIF GURU
        | STATUS SISWA TIDAK DIPEDULIKAN
        |--------------------------------------------------------------------------
        */
        $siswa = User::where('peran', 'siswa')
            ->get()
            ->filter(function ($mhs) use ($kelasAktifGuru) {

                $token = $mhs->token_kelas;

                if (is_string($token)) {
                    $token = json_decode($token, true);
                }

                if (!is_array($token))
                    return false;

                foreach ($token as $t) {
                    if ($t['kode'] === $kelasAktifGuru) {
                        return true;
                    }
                }

                return false;
            })
            ->shuffle()
            ->values();

        if ($siswa->isEmpty()) {
            return back()->with('error', 'Tidak ada siswa dalam kelas aktif.');
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL KELOMPOK EXISTING KHUSUS KELAS AKTIF GURU
        |--------------------------------------------------------------------------
        */
        $existing = Kelompok::where('token_kelas', $kelasAktifGuru)
            ->whereIn('email', $siswa->pluck('email'))
            ->get();

        // Hitung jumlah anggota tiap kelompok
        $jumlah = [1 => 0, 2 => 0, 3 => 0, 4 => 0];

        foreach ($existing as $k) {
            if ($k->id_kelompok && isset($jumlah[$k->id_kelompok])) {
                $jumlah[$k->id_kelompok]++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | ASSIGN KELOMPOK OTOMATIS
        |--------------------------------------------------------------------------
        */
        foreach ($siswa as $mhs) {

            // Cek apakah siswa SUDAH punya kelompok di kelas aktif guru
            $record = $existing->firstWhere('email', $mhs->email);

            if ($record && $record->id_kelompok) {
                continue; // biarkan, karena itu dari kelas aktif guru
            }

            // Assign kelompok baru
            for ($i = 1; $i <= 4; $i++) {

                if ($jumlah[$i] < 4) {

                    Kelompok::updateOrCreate(
                        [
                            'email' => $mhs->email,
                            'token_kelas' => $kelasAktifGuru
                        ],
                        [
                            'id_kelompok' => $i
                        ]
                    );

                    $jumlah[$i]++;
                    break;
                }
            }
        }

        return back()->with('success', 'Kelompok otomatis berhasil diatur!');
    }

}
