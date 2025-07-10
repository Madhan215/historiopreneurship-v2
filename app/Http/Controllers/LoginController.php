<?php

namespace App\Http\Controllers;

use App\Models\AksesHalaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        return view('home/masuk');
    }

    public function auth(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        

        // dd($credentials);


        if (Auth::attempt($credentials, $request->checkRemember)) {
            $request->session()->regenerate();

            // Menyimpan progress ke dalam Session
            $materi_a = AksesHalaman::where('email', auth()->user()->email)->value('materi_a');
            $materi_b = AksesHalaman::where('email', auth()->user()->email)->value('materi_b');
            $materi_c = AksesHalaman::where('email', auth()->user()->email)->value('materi_c');

            // dd($materi_a, $materi_b, $materi_c);

            Session::put('materi_a', $materi_a);
            Session::put('materi_b', $materi_b);
            Session::put('materi_c', $materi_c);

            // dd($credentials);
            return redirect()->intended('/dashboard');
        }

       

        return back()->withErrors([
            'email' => 'Akun tidak ditemukan'
        ])->onlyInput('email');
    }
    public function logout(Request $request): RedirectResponse
    {
        // dd(Auth::user());
        Auth::logout();
      
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
