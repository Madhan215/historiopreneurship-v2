<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegisterController extends Controller
{
    public function show()
    {
        return view('home/daftar');
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        // dd($request->all());

        $validator = $request->validate([
            'namaInput' => 'required',
            'emailInput' => 'required|email',
            'peranInput' => 'required',
            'passwordInput' => 'required|min:4',
            'jenisKelamin' => 'required|in:L,P'
        ]);

        // Menambahkan logika untuk menetapkan kelas "A1" jika peran adalah "guru"


        $query = User::create([
            'nama_lengkap' => $request->namaInput,
            'email' => $request->emailInput,
            'peran' => $request->peranInput,
            'password' => Hash::make($request->passwordInput),
            'jenis_kelamin' => $request->jenisKelamin
        ]);

        // dd($query);
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');

        if ($query) {
            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
        } else {
            return redirect()->back();
        }
    }
}
