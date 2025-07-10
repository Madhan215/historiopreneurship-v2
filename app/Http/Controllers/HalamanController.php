<?php

namespace App\Http\Controllers;

use App\Models\AnalisisIndividuKesejeranhanII;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Kelompok;
use App\Models\Refleksi;
use App\Models\AksesHalaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use App\Models\AnalisisIndividuKesejarahan;
use App\Models\AnalisisKelompokKesejarahan;
use App\Models\AnalisisKelompokKewirausahaan;
use App\Models\Analisis_individu_kewirausahaan;


class HalamanController extends Controller
{
    function A () {
        $data['halaman_terbuka'] = 'A'; 
        $data['user'] = Auth::user()->email;
        $data['progress'] = 0;
        $data['materi_a'] = AksesHalaman::where('email', Auth::user()->email)->value('materi_a');
        return view('pages.A', $data);
    }

    public function B() 
    {
        $userEmail = Auth::user()->email;
    
        // Prepare data for view
        $data['halaman_terbuka'] = 'B';
        $data['user'] = $userEmail;
        $data['materi_b'] = AksesHalaman::where('email', $userEmail)->value('materi_b');
    
        // Retrieve individual answers from AnalisisIndividuKesejarahan
        $jawabanIndividu = AnalisisIndividuKesejarahan::where('created_by', $userEmail)
            ->pluck('jawaban', 'aspek')
            ->toArray();
    
        // Retrieve reflection answers and group them by category
        $jawabanRefleksi = Refleksi::where('created_by', $userEmail)
            ->get()
            ->groupBy('kategori')
            ->map(function ($items) {
                return $items->keyBy('aspek');
            });
    
        // Ensure jawabanRefleksi is a collection, even if empty
        if ($jawabanRefleksi->isEmpty()) {
            $jawabanRefleksi = collect();
        }
    
        // Retrieve individual answers from AnalisisIndividuKesejarahanII
        $jawabanIndividuII = AnalisisIndividuKesejeranhanII::where('created_by', $userEmail)->get();
    
        // Return the view with the necessary data
        return view('pages.B', array_merge($data, [
            'jawabanIndividu' => $jawabanIndividu,
            'jawabanRefleksi' => $jawabanRefleksi,
            'jawabanIndividuII' => $jawabanIndividuII,
        ]));
    }
    

    function C () {
        $data['halaman_terbuka'] = 'C';
        $data['user'] = Auth::user()->email;
        $data['materi_c'] = AksesHalaman::where('email', Auth::user()->email)->value('materi_c');
         // Dapatkan email pengguna yang sedang login
         $userEmail = Auth::user()->email;

         // Ambil jawaban individu yang sudah ada
         $jawabanIndividu = Analisis_individu_kewirausahaan::where('created_by', $userEmail)
             ->pluck('jawaban', 'aspek')
             ->toArray();
 
         // Ambil jawaban refleksi dan pastikan jika tidak ada data, tetap hasilkan collection
         $jawabanRefleksi = Refleksi::where('created_by', $userEmail)
             ->get()
             ->groupBy('kategori')
             ->map(function ($items) {
                 return $items->keyBy('aspek');
             });
     
         // Pastikan jawabanRefleksi bukan null dan set sebagai collection jika kosong
         if (!$jawabanRefleksi || $jawabanRefleksi->isEmpty()) {
             $jawabanRefleksi = collect();
         }
 
         // Dapatkan id_kelompok dari tabel kelompok berdasarkan email pengguna
         $kelompok = Kelompok::where('email', $userEmail)->first();
 
         if ($kelompok) {
             $id_kelompok = $kelompok->id_kelompok;
 
             // Ambil semua anggota kelompok berdasarkan id_kelompok dengan join ke tabel users
             $anggotaKelompok = Kelompok::where('id_kelompok', $id_kelompok)
                 ->join('users', 'kelompok.email', '=', 'users.email')
                 ->select('kelompok.*', 'users.nama_lengkap')
                 ->get(); // Convert to collection
 
             // Ambil jawaban berdasarkan id_kelompok untuk halaman C
             $jawabanKelompok = AnalisisKelompokKewirausahaan::where('id_kelompok', $id_kelompok)->get();
         } else {
             $id_kelompok = null;
             $anggotaKelompok = collect(); // Kosongkan jika id_kelompok tidak ditemukan
             $jawabanKelompok = collect(); // Kosongkan jika id_kelompok tidak ditemukan
         }
 
         return view('pages.C', compact('jawabanKelompok', 'id_kelompok', 'anggotaKelompok', 'jawabanIndividu', 'jawabanRefleksi'),$data);
    }


    function daftarPustaka()
    {
        $data['halaman_terbuka'] = 0;
        return view('pages.daftarPustaka', $data);
    }

    function materi()
    {
        return view('pages.materi');
    }

    function review()
    {
        $activeMenu = 'active';
        $email = Auth::user()->email;
        $dataNilai = Nilai::where('email', $email)->get(['aspek', 'data_jawaban_penilai', 'nilai_akhir']);
    
        $hasData = $dataNilai->isNotEmpty();
    
        return view('pages.reviewGuru', compact('dataNilai', 'hasData','activeMenu'));
    }
}
