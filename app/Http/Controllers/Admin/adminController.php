<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function daftarGuru()
    {
        // Ambil user dengan peran guru
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
}
