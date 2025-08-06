<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\evaluasiDinamis;
use App\Models\materiDinamis;
use App\Models\topikdinamis;
use App\Models\uploadDinamis;
use Illuminate\Http\Request;

class subtopikController extends Controller
{
    public function create($id_topik)
    {
        return view('admin.FiturKontenDinamis.subtopik.create', compact('id_topik'));
    }

    public function store(Request $request)
    {
        $tipe = $request->tipe;

        // Validasi umum terlebih dahulu
        $request->validate([
            'id_topik' => 'required|exists:topikdinamis,id_topik',
            'tipe' => 'required|in:materi,evaluasi,upload',
        ], [
            'id_topik.required' => 'Topik harus diisi.',
            'id_topik.exists' => 'Topik tidak valid.',
            'tipe.required' => 'Tipe subtopik harus diisi.',
            'tipe.in' => 'Tipe subtopik tidak valid.',
        ]);

        $topik = topikdinamis::find($request->id_topik);

        switch ($tipe) {
            case 'materi':
                $request->validate([
                    'nama_materi' => 'required|string|max:255',
                    'konten_materi' => 'required|string',
                ], [
                    'nama_materi.required' => 'Nama materi harus diisi.',
                    'konten_materi.required' => 'Konten materi harus diisi.',
                ]);

                materiDinamis::create([
                    'id_topik' => $request->id_topik,
                    'nama_materi' => $request->nama_materi,
                    'konten' => $request->konten_materi,
                    'status' => 'on',
                ]);
                break;

            case 'evaluasi':
                $request->validate([
                    'nama_evaluasi' => 'required|string|max:255',
                    'soal_json' => 'required|json',
                ], [
                    'nama_evaluasi.required' => 'Nama evaluasi harus diisi.',
                    'soal_json.required' => 'Soal evaluasi harus diisi.',
                    'soal_json.json' => 'Format soal evaluasi harus berupa JSON yang valid.',
                ]);

                evaluasiDinamis::create([
                    'id_topik' => $request->id_topik,
                    'nama_evaluasi' => $request->nama_evaluasi,
                    'konten' => $request->soal_json,
                    'status' => 'on',
                ]);
                break;

            case 'upload':
                $request->validate([
                    'nama_upload' => 'required|string|max:255',
                    'deskripsi_upload' => 'required|string',
                    'tipe_file' => 'required|in:word,excel,pdf,image,video',
                ], [
                    'nama_upload.required' => 'Nama upload harus diisi.',
                    'deskripsi_upload.required' => 'Deskripsi upload harus diisi.',
                    'tipe_file.required' => 'Tipe file harus dipilih.',
                    'tipe_file.in' => 'Tipe file tidak valid.',
                ]);

                $input = '<label for="myfile">Select a file:</label>';
                $accept = '';

                switch ($request->tipe_file) {
                    case 'word':
                        $accept = '.doc,.docx';
                        break;
                    case 'excel':
                        $accept = '.xls,.xlsx';
                        break;
                    case 'pdf':
                        $accept = '.pdf';
                        break;
                    case 'image':
                        $accept = 'image/*';
                        break;
                    case 'video':
                        $accept = 'video/*';
                        break;
                }

                $input .= '<input type="file" id="myfile" name="myfile" accept="' . $accept . '">';

                uploadDinamis::create([
                    'id_topik' => $request->id_topik,
                    'nama_upload' => $request->nama_upload,
                    'konten' => $input,
                    'deskripsi' => $request->deskripsi_upload,
                    'status' => 'on',
                ]);
                break;

            default:
                return back()->with('error', 'Jenis subtopik tidak dikenali.');
        }

        return redirect()->route('topik.index', ['token_kelas' => $topik->token_kelas])
            ->with('success', 'Subtopik berhasil ditambahkan');
    }


    public function edit($tipe, $id)
    {
        switch ($tipe) {
            case 'materi':
                $data = materiDinamis::findOrFail($id);
                $id_topik = $data->id_topik;
                break;
            case 'evaluasi':
                $data = evaluasiDinamis::findOrFail($id);
                $id_topik = $data->id_topik;
                break;
            case 'upload':
                $data = uploadDinamis::findOrFail($id);
                $id_topik = $data->id_topik;

                if (preg_match('/accept="([^"]+)"/', $data->konten, $matches)) {
                    $accept = str_replace('.', '', $matches[1]);
                    $data->tipe_file = $accept;
                }
                break;
            default:
                abort(404);
        }

        return view('admin.FiturKontenDinamis.subtopik.edit', compact('tipe', 'data', 'id_topik'));
    }

    public function update(Request $request, $tipe, $id)
    {
        $topik = topikdinamis::find($request->id_topik);
        switch ($tipe) {
            case 'materi':
                $data = materiDinamis::findOrFail($id);
                $data->update([
                    'nama_materi' => $request->nama_materi ?? $data->nama_materi,
                    'konten' => $request->konten_materi ?? $data->konten,
                ]);
                break;

            case 'evaluasi':
                $data = evaluasiDinamis::findOrFail($id);
                $data->update([
                    'nama_evaluasi' => $request->nama_evaluasi ?? $data->nama_evaluasi,
                    'konten' => $request->filled('soal_json') ? $request->soal_json : $data->konten,
                ]);
                break;

            case 'upload':
                $data = uploadDinamis::findOrFail($id);

                $konten_lama = $data->konten;
                $input = $konten_lama;

                if ($request->filled('tipe_file')) {
                    $accept = match ($request->tipe_file) {
                        'word' => '.doc,.docx',
                        'excel' => '.xls,.xlsx',
                        'pdf' => '.pdf',
                        'image' => 'image/*',
                        'video' => 'video/*',
                        default => '',
                    };

                    $input = '<label for="myfile">Select a file:</label>';
                    $input .= '<input type="file" id="myfile" name="myfile" accept="' . $accept . '">';
                }

                $data->update([
                    'nama_upload' => $request->nama_upload ?? $data->nama_upload,
                    'konten' => $input,
                    'deksripsi' => $request->deskripsi_upload
                ]);
                break;
        }

        return redirect()->route('topik.index', ['token_kelas' => $topik->token_kelas])
            ->with('success', 'Subtopik berhasil dirubah');
    }

    public function destroy($tipe, $id)
    {
        switch ($tipe) {
            case 'materi':
                $data = materiDinamis::findOrFail($id);
                break;
            case 'evaluasi':
                $data = evaluasiDinamis::findOrFail($id);
                break;
            case 'upload':
                $data = uploadDinamis::findOrFail($id);
                break;
            default:
                abort(404);
        }

        $data->delete();

        return redirect()->route('admin.FiturKontenDinamis.topik.index')->with('success', 'Subtopik berhasil dihapus.');
    }
}
