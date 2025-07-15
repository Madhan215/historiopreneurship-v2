<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManajemenKonten;

class ManajemenKontenController extends Controller
{
    public function index(Request $request)
    {
        $kategoriDipilih = $request->input('kategori_konten', 'kegiatanPembelajaran1');

        $items = ManajemenKonten::where('kategori_konten', $kategoriDipilih)
            ->orderBy('nomor')
            ->get();

        $kategoriList = [
            'kegiatanPembelajaran1',
            'kegiatanPembelajaran2',
            'kegiatanPembelajaran3',
            'preTestKesejarahan',
            'postTestKesejarahan',
            'kuisKesejarahan',
            'refleksi',
            'preTestKewirausahaan',
            'postTestKewirausahaan',
            'analisisIndividu',
            'analisisKelompok1',
            'analisisKelompok2',
            'diskusiKelompok',
            'kuisKwuDanKepariwisataan',
            'kwuDanKepariwisataan',
            'praktikLapangan1',
            'praktikLapangan2',
            'proyekIndividu',
            'refleksi2'
        ];

        return view('admin.manajemen_konten.index', compact(
            'items',
            'kategoriDipilih',
            'kategoriList'
        ))->with('activeMenu', 'manajemen-konten');
    }


    public function create(Request $request)
    {
        $kategori = $request->input('kategori', 'kegiatanPembelajaran1');
        return view('admin.manajemen_konten.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nomor' => 'required|integer',
            'konten' => 'required'
        ]);

        ManajemenKonten::create($request->only('kategori', 'nomor', 'konten'));

        return redirect()->route('manajemen-konten.index', ['kategori' => $request->kategori])
            ->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit(ManajemenKonten $manajemen_konten)
    {
        $kategoriList = [
            'kegiatanPembelajaran1',
            'kegiatanPembelajaran2',
            'kegiatanPembelajaran3',
            'preTestKesejarahan',
            'postTestKesejarahan',
            'kuisKesejarahan',
            'refleksi',
            'preTestKewirausahaan',
            'postTestKewirausahaan',
            'analisisIndividu',
            'analisisKelompok1',
            'analisisKelompok2',
            'diskusiKelompok',
            'kuisKwuDanKepariwisataan',
            'kwuDanKepariwisataan',
            'praktikLapangan1',
            'praktikLapangan2',
            'proyekIndividu',
            'refleksi2'
        ];

        // Tambahkan activeMenu
        $activeMenu = 'manajemen-konten';

        return view('admin.manajemen_konten.edit', [
            'manajemen_konten' => $manajemen_konten,
            'kategoriList' => $kategoriList,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Simpan hasil update.
     */
    public function update(Request $request, ManajemenKonten $manajemen_konten)
    {
        $validated = $request->validate([
            'kategori_konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'konten_teks' => 'nullable|string',
        ]);

        $konten = '';

        if ($validated['kategori_konten'] === 'kegiatanPembelajaran1') {
            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('uploads', 'public');

                $imgTag = "<img src='" . asset('storage/' . $path) . "' class='d-block mx-auto img-fluid my-3 shadow' style='width: 500px; height: auto;'>";

                $figcaption = "<figcaption class='text-center my-3'>" . e($validated['konten_teks']) . "</figcaption>";

                $konten = $imgTag . $figcaption;
            } else {
                $konten = $validated['konten_teks'];
            }
        } elseif ($validated['kategori_konten'] === 'kegiatanPembelajaran2') {
            $konten = "<li>" . e($validated['konten_teks']) . "</li>";
        } else {
            $konten = $validated['konten_teks'];
        }

        $manajemen_konten->update([
            'kategori_konten' => $validated['kategori_konten'],
            'konten' => $konten,
        ]);

        return redirect()
            ->route('manajemen-konten.index', ['kategori' => $validated['kategori_konten']])
            ->with('success', 'Konten berhasil diperbarui!')
            ->with('activeMenu', 'manajemen-konten');
    }


}
