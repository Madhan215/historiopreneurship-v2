<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class adminController extends Controller
{
    public function daftarGuru()
    {
        // Ambil user dengan peran guru
        //ujar iki dirubah
        $guruList = DB::table('users')
            ->where('peran', 'guru')
            ->get()
            ->map(function ($guru) {
                // Decode token_kelas JSON ke array
                $guru->kelas = $guru->token_kelas ? json_decode($guru->token_kelas, true) : [];
                return $guru;
            });

        return view('admin.FiturKontenDinamis.daftarGuru', compact('guruList'));
    }

    public function dashboard()
    {
        // Hitung jumlah kelas unik berdasarkan class_token
        // $jumlahKelas = User::whereNotNull('class_token')->distinct('class_token')->count();
        $jumlahKelas = count(Kelas::all());

        // Hitung jumlah user non-admin
        $jumlahUser = User::where('peran', '!=', 'admin')->count();

        return view('dashboard_admin', compact('jumlahKelas', 'jumlahUser'));
    }
}
