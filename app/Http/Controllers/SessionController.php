<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function laman(Request $request){
        // Mendefinisikan A B C tertutup

        // Simpan status sidebar di session
        Session::put('active_menu_sub', $request->input('menuBabSub'));
        Session::put('active_menu', $request->input('menu'));

        // dd(Session::all());


        // Redirect ke halaman yang diinginkan
        return redirect()->route($request->input('menu'));
    }
    public function lamanSub(Request $request){

        // Simpan status sidebar di session
        Session::put('sidebar_status_sub', $request->input('statusSub'));
        Session::put('active_menu_sub', $request->input('menuSub'));

        // dd(Session::all());


        // Redirect ke halaman yang diinginkan
        return redirect()->back();
    }
}
