<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class LatihanController extends Controller
{
    //Database soal
    
    public function index(){
        
    

        return redirect()->route('latihan.show');
    }
    

    public function latihan(){
        
        
        return view('latihan.latihan');
    }
    public function kuis(){
        return view('latihan.kuis');
    }
    public function evaluasi(){
        $soal['soal'] = Soal::first();
        $soal['halaman_terbuka'] = 0;
        $_SESSION['soal_sekarang'] = 0;
        $_SESSION['jawaban'] = 0;
        $_SESSION['nilai'] = 0;
        
        return view('latihan.evaluasi', $soal);
    }
    
    public function info(){
        $soal['halaman_terbuka'] = 0;
        return view('latihan.info', $soal);
    }
    // public function dragndrop(){
    //     $data['halaman_terbuka'] = 'drag n drop'; 
    //     return view('latihan.dragndrop', $data);
    // }
    public function latihan2(){
        $data['halaman_terbuka'] = 'latihan2'; 
        return view('latihan.latihan2', $data);
    }
}
