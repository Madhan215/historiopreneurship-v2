<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $user = auth()->user();
    $kelasIds = array_keys($user->token_kelas ?? []); // ambil semua ID kelas dari token_kelas
    $activeMenu = '';

    $kelas = \App\Models\Kelas::whereIn('id', $kelasIds)->get();        
    return view('kelas.index', compact('kelas', 'activeMenu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        do {
            $kode = Str::upper(Str::random(6));
        } while (Kelas::where('kode_kelas', $kode)->exists());

         $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kode_kelas' => $kode,
            'deskripsi_kelas' => $request->deskripsi_kelas,
        ]);

        $user = auth()->user();

        $existingTokens = $user->token_kelas ?? [];

        $existingTokens[$kelas->id] = $kode;

        $user->token_kelas = $existingTokens;
        $user->save();      
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');

    }


    public function storeUser(Request $request)
    {
        $kode = $request->input('kode_kelas');
        $kelas = Kelas::where('kode_kelas', $kode)->first();

        if (!$kelas) {
            return back()->with('error', 'Kode kelas tidak ditemukan.');
        }

        $user = auth()->user();

        $existingTokens = $user->token_kelas ?? [];
        $existingTokens[$kelas->id] = $kode;

        $user->token_kelas = $existingTokens;
        $user->save();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
         return view('kelas.input');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'deskripsi_kelas' => $request->deskripsi_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

            $users = \App\Models\User::whereNotNull('token_kelas')->get();

        foreach ($users as $user) {
            $tokens = $user->token_kelas;

            if (is_array($tokens) && array_key_exists($kelas->id, $tokens)) {
                unset($tokens[$kelas->id]);
                $user->token_kelas = $tokens;
                $user->save();
            }
        }

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');

    }
}
