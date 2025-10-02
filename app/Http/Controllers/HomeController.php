<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function sumber()
    {
        $activeMenu = 'menu3';
        return view('home.sumber', compact('activeMenu'));
    }
    public function beranda()
    {
        // $userRole = auth()->user()->peran;
        // dd($userRole);
        return view('home.beranda');
    }

    public function materi()
    {
        return view('home.materi');
    }

    public function perihal()
    {
        return view('home.perihal');
    }
}

