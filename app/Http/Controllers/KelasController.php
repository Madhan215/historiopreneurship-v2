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
    $tokens = $user->token_kelas ?? []; 
    $activeMenu = '';

    // Ambil semua kode kelas dari token_kelas JSON
    $kodeKelas = collect($tokens)->pluck('kode')->toArray();

    // Cari data kelas berdasarkan kode, bukan id
    $kelas = \App\Models\Kelas::whereIn('kode_kelas', $kodeKelas)
                    ->with('guru')
                    ->get();        
        

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
            'created_by' => auth()->id(),
        ]);

        $user = auth()->user();

        $existingTokens = $user->token_kelas ?? [];

        $existingTokens[] = [
            'kode' => $kode,
            'status' => 'tidak aktif'
        ];

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
        // Cek apakah kode sudah ada dalam daftar
        $sudahAda = collect($existingTokens)->contains(function ($item) use ($kode) {
            return $item['kode'] === $kode;
        });

        if (!$sudahAda) {
            // Tambahkan objek baru dengan key 'kode' dan 'status'
            $existingTokens[] = [
                'kode' => $kode,
                'status' => 'tidak aktif' // default tidak aktif saat pertama kali ditambahkan
            ];
        }

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

    public function updateUser(Request $request, string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $user = auth()->user();
        $tokens = $user->token_kelas ?? [];

        // Ubah status
        foreach ($tokens as &$token) {
            if ($token['kode'] === $kelas->kode_kelas) {
                if ($token['status'] === 'aktif') {
                    $token['status'] = 'tidak aktif'; // keluar
                } else {
                // pertama reset semua kelas jadi tidak aktif
                    foreach ($tokens as &$t) {
                        $t['status'] = 'tidak aktif';
                    }
                    // lalu aktifkan kelas ini
                    $token['status'] = 'aktif'; // masuk
                }
            }        
        }

        $user->token_kelas = $tokens;
        $user->save();

        return redirect()->route('kelas.index')->with('success', 'Status kelas berhasil diubah.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

            $users = \App\Models\User::whereNotNull('token_kelas')->get();

        foreach ($users as $user) {
            $tokens = $user->token_kelas ?? [];

            if (is_array($tokens)) {
                // filter token, buang yang punya kode sama dengan kelas yang dihapus
                $tokens = collect($tokens)->reject(function ($item) use ($kelas) {
                    return $item['kode'] === $kelas->kode_kelas;
                })->values()->toArray();

                $user->token_kelas = $tokens;
                $user->save();
            }
        }

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');

    }
}
