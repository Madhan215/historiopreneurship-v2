<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\evaluasiDinamis;
use App\Models\materiDinamis;
use App\Models\topikdinamis;
use App\Models\uploadDinamis;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class topikController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->query('token_kelas');

        $query = topikdinamis::with(['materi', 'evaluasi', 'upload']);

        if ($token) {
            $query->where('token_kelas', $token);
        }

        $topiks = $query->get();

        return view('admin.FiturKontenDinamis.topik.index', compact('topiks', 'token'));
    }



    public function toggleStatus($id)
    {
        $topik = topikdinamis::findOrFail($id);
        $topik->status = $topik->status === 'on' ? 'off' : 'on';
        $topik->save();

        return redirect()->back()->with('success', 'Status topik berhasil diperbarui.');
    }


    public function create(Request $request)
    {
        $token_kelas = $request->token_kelas; // Ambil token dari query
        return view('admin.FiturKontenDinamis.topik.create', compact('token_kelas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_topik' => 'required',
            'status' => 'required',
            'token_kelas' => 'required'
        ]);

        topikdinamis::create([
            'nama_topik' => $request->nama_topik,
            'status' => $request->status,
            'token_kelas' => $request->token_kelas,
        ]);

        return redirect()->route('topik.index', ['token_kelas' => $request->token_kelas])
            ->with('success', 'Topik berhasil ditambahkan');

    }


    public function show($id)
    {
        $topik = topikdinamis::findOrFail($id);
        return view('admin.FiturKontenDinamis.topik.show', compact('topik'));
    }

    public function edit($id)
    {
        $topik = topikdinamis::findOrFail($id);
        return view('admin.FiturKontenDinamis.topik.edit', compact('topik'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_topik' => 'required',
            'status' => 'required'
        ]);

        $topik = topikdinamis::findOrFail($id);
        $token_kelas = $topik->token_kelas; // ambil token_kelas

        $topik->update($request->all());

        return redirect()->route('topik.index', ['token_kelas' => $token_kelas])
            ->with('success', 'Topik berhasil diperbarui');
    }


    public function destroy($id)
    {
        $topik = topikdinamis::findOrFail($id);
        $token_kelas = $topik->token_kelas; // ambil token_kelas sebelum delete

        $topik->delete();

        return redirect()->route('topik.index', ['token_kelas' => $token_kelas])
            ->with('success', 'Topik berhasil dihapus');
    }


    public function aturUrutan(Request $request)
    {
        $token_kelas = $request->query('token_kelas'); // ambil dari query string

        $topiks = topikdinamis::with(['materi', 'evaluasi', 'upload'])
            ->where('token_kelas', $token_kelas)
            ->orderBy('urutan')
            ->get();

        return view('admin.FiturKontenDinamis.topik.aturUrutan', compact('topiks', 'token_kelas'));
    }
    public function simpanUrutan(Request $request)
    {

        $topikUrutan = $request->topik_urutan ?? [];
        $materiUrutan = $request->materi_urutan ?? [];
        $evaluasiUrutan = $request->evaluasi_urutan ?? [];
        $uploadUrutan = $request->upload_urutan ?? [];

        // Validasi urutan topik tidak boleh duplikat
        if (count($topikUrutan) !== count(array_unique(array_values($topikUrutan)))) {
            return redirect()->back()->with('error', 'Urutan antar topik tidak boleh sama!');
        }

        // Gabungkan subtopik berdasarkan topik-nya
        $subTopikPerTopik = [];

        // Ambil topik masing-masing subtopik
        foreach ($materiUrutan as $id => $urutan) {
            $materi = materiDinamis::find($id);
            if (!$materi) {
                dd("Materi dengan id_materi $id tidak ditemukan");
            }
        }


        foreach ($evaluasiUrutan as $id => $urutan) {
            $evaluasi = evaluasiDinamis::find($id);
            if ($evaluasi) {
                $subTopikPerTopik[$evaluasi->id_topik][] = $urutan;
            }
        }

        foreach ($uploadUrutan as $id => $urutan) {
            $upload = uploadDinamis::find($id);
            if ($upload) {
                $subTopikPerTopik[$upload->id_topik][] = $urutan;
            }
        }

        // Cek duplikasi urutan dalam masing-masing topik
        foreach ($subTopikPerTopik as $idTopik => $urutans) {
            if (count($urutans) !== count(array_unique($urutans))) {
                return redirect()->back()->with('error', "Urutan subtopik di Topik ID $idTopik tidak boleh sama!");
            }
        }

        // Simpan urutan topik
        foreach ($topikUrutan as $id => $urutan) {
            topikdinamis::where('id_topik', $id)->update(['urutan' => $urutan]);
        }

        // Simpan urutan materi
        foreach ($materiUrutan as $id => $urutan) {
            materiDinamis::where('id_materi', $id)->update(['urutan' => $urutan]);
        }

        // Simpan urutan evaluasi
        foreach ($evaluasiUrutan as $id => $urutan) {
            evaluasiDinamis::where('id_evaluasi', $id)->update(['urutan' => $urutan]);
        }

        // Simpan urutan upload
        foreach ($uploadUrutan as $id => $urutan) {
            uploadDinamis::where('id_upload', $id)->update(['urutan' => $urutan]);
        }

        return redirect()->route('topik.index', ['token_kelas' => $request->token_kelas])
            ->with('success', 'Urutan berhasil disimpan!');
    }


    public function lihatUrutan()
    {
        $topiks = topikdinamis::where('status', 'on') // hanya ambil yang status-nya "on"
            ->orderBy('urutan')
            ->with([
                'materi' => fn($q) => $q->orderBy('urutan'),
                'evaluasi' => fn($q) => $q->orderBy('urutan'),
                'upload' => fn($q) => $q->orderBy('urutan'),
            ])
            ->get()
            ->map(function ($topik) {
                $gabungan = collect();

                foreach ($topik->materi as $m) {
                    $gabungan->push([
                        'tipe' => 'Materi',
                        'nama' => $m->nama_materi,
                        'urutan' => $m->urutan,
                    ]);
                }

                foreach ($topik->evaluasi as $e) {
                    $gabungan->push([
                        'tipe' => 'Evaluasi',
                        'nama' => $e->nama_evaluasi,
                        'urutan' => $e->urutan,
                    ]);
                }

                foreach ($topik->upload as $u) {
                    $gabungan->push([
                        'tipe' => 'Upload',
                        'nama' => $u->nama_upload,
                        'urutan' => $u->urutan,
                    ]);
                }

                $topik->subtopiks_urut = $gabungan->sortBy('urutan')->values();

                return $topik;
            });

        return view('admin.FiturKontenDinamis.topik.lihatUrutan', compact('topiks'));
    }

    public function paketMateri(Request $request)
    {
        $token = $request->query('token_kelas');

        if (!$token) {
            return redirect()->back()->with('error', 'Token kelas tidak ditemukan.');
        }

        // Cek apakah sudah ada topik default (hindari duplikasi)
        $sudahAda = topikdinamis::where('token_kelas', $token)
            ->whereIn('nama_topik', ['Pembukaan', 'Kesejarahan', 'Kewirausahaan'])
            ->exists();

        if ($sudahAda) {
            return redirect()->route('topik.index', ['token_kelas' => $token])
                ->with('error', 'Paket topik sudah pernah diklaim.');
        }

        $topiks = [
            ['nama_topik' => 'Pembukaan', 'urutan' => 1],
            ['nama_topik' => 'Kesejarahan', 'urutan' => 2],
            ['nama_topik' => 'Kewirausahaan', 'urutan' => 3],
        ];

        foreach ($topiks as $topik) {
            topikdinamis::create([
                'nama_topik' => $topik['nama_topik'],
                'status' => 'on', // default off, bisa diubah sesuai kebutuhan
                'urutan' => $topik['urutan'],
                'token_kelas' => $token,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('topik.index', ['token_kelas' => $token])
            ->with('success', 'Paket topik berhasil diklaim.');
    }

}
