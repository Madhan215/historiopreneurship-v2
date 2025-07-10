<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentAController extends Controller
{
    public function cpl()
    {
        $prevUrl = null; 
        $nextUrl = "/Informasi/CPMK";
        $activeMenu = 'menu1';
        return view('content-A.cpl', compact('activeMenu','prevUrl','nextUrl',));
    }
    
    public function cpmk()
    {
        $prevUrl = "/Informasi/CPL"; 
        $nextUrl = "/Informasi/Peran-Dosen";
        $activeMenu = 'menu1';
        return view('content-A.cpmk', compact('activeMenu','prevUrl','nextUrl'));
    }

    public function peranDosen()
    {
        $prevUrl = "/Informasi/CPMK"; 
        $nextUrl = "/Informasi/Sarana-Dan-Prasarana";
        $activeMenu = 'menu1';
        return view('content-A.peranDosen', compact('activeMenu','prevUrl','nextUrl'));
    }

    public function saranaDanPrasarana()
    {
        $prevUrl = "/Informasi/Peran-Dosen"; 
        $nextUrl = "/Informasi/Kolaborasi-Narasumber";
        $activeMenu = 'menu1';
        return view('content-A.saranaDanPrasarana', compact('activeMenu','prevUrl','nextUrl'));
    }

    public function kolaborasiNarasumber()
    {
        $prevUrl = "/Informasi/Sarana-Dan-Prasarana"; 
        $nextUrl = "/Informasi/Cara-Penggunaan";
        $activeMenu = 'menu1';
        return view('content-A.kolaborasiNarasumber', compact('activeMenu','prevUrl','nextUrl'));
    }

    public function caraPenggunaan()
    {
        $prevUrl = "/Informasi/Kolaborasi-Narasumber"; 
        $nextUrl = "/Informasi/Tahapan";
        $activeMenu = 'menu1';
        return view('content-A.caraPenggunaan', compact('activeMenu','prevUrl','nextUrl'));
    }

    public function tahapan()
    {
        $prevUrl = "/Informasi/Kolaborasi-Narasumber"; 
        $nextUrl = "/Kesejarahan/Pre-Test";
        $activeMenu = 'menu1';
        return view('content-A.tahapan', compact('activeMenu','prevUrl','nextUrl'));
    }
    
    
}
