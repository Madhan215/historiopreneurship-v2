<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\evaluasiDinamis;
use App\Models\materiDinamis;
use App\Models\topikdinamis;
use App\Models\uploadDinamis;
use Illuminate\Http\Request;

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
        // Validasi request terlebih dahulu
        $request->validate([
            'topik_id' => 'required|array',
            'topik_urutan' => 'required|array',
        ]);

        $topikUrutan = $request->topik_urutan ?? [];
        $materiUrutan = $request->materi_urutan ?? [];
        $evaluasiUrutan = $request->evaluasi_urutan ?? [];
        $uploadUrutan = $request->upload_urutan ?? [];

        // Cek duplikasi urutan antar topik
        if (count($topikUrutan) !== count(array_unique($topikUrutan))) {
            return redirect()->back()->with('error', 'Urutan antar topik tidak boleh sama!');
        }

        // Cek duplikasi urutan sub-topik dalam satu topik (gunakan kombinasi ID topik jika perlu)
        $subTopikGabungan = array_merge($materiUrutan, $evaluasiUrutan, $uploadUrutan);
        if (count($subTopikGabungan) !== count(array_unique($subTopikGabungan))) {
            return redirect()->back()->with('error', 'Urutan antar subtopik dalam satu topik tidak boleh sama!');
        }

        // Update topik
        foreach ($request->topik_id as $index => $id) {
            if (isset($topikUrutan[$index])) {
                topikdinamis::where('id_topik', $id)->update([
                    'urutan' => $topikUrutan[$index]
                ]);
            }
        }

        // Update materi
        foreach ($request->materi_id ?? [] as $index => $id) {
            if (isset($materiUrutan[$index])) {
                materiDinamis::where('id_materi', $id)->update([
                    'urutan' => $materiUrutan[$index]
                ]);
            }
        }

        // Update evaluasi
        foreach ($request->evaluasi_id ?? [] as $index => $id) {
            if (isset($evaluasiUrutan[$index])) {
                evaluasiDinamis::where('id_evaluasi', $id)->update([
                    'urutan' => $evaluasiUrutan[$index]
                ]);
            }
        }

        // Update upload
        foreach ($request->upload_id ?? [] as $index => $id) {
            if (isset($uploadUrutan[$index])) {
                uploadDinamis::where('id_upload', $id)->update([
                    'urutan' => $uploadUrutan[$index]
                ]);
            }
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

}
