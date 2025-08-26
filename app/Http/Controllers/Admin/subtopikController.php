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
                    'konten_upload' => 'required|string', // ← isi dari Quill editor
                    'tipe_file' => 'required|in:word,excel,pdf,image,video',
                ], [
                    'nama_upload.required' => 'Nama upload harus diisi.',
                    'deskripsi_upload.required' => 'Deskripsi upload harus diisi.',
                    'konten_upload.required' => 'Konten editor harus diisi.',
                    'tipe_file.required' => 'Tipe file harus dipilih.',
                    'tipe_file.in' => 'Tipe file tidak valid.',
                ]);

                // Cek tipe file untuk accept
                $accept = '';
                $ext_info = '';

                switch ($request->tipe_file) {
                    case 'word':
                        $accept = '.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                        $ext_info = '.doc atau .docx';
                        break;
                    case 'excel':
                        $accept = '.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                        $ext_info = '.xls atau .xlsx';
                        break;
                    case 'pdf':
                        $accept = '.pdf,application/pdf';
                        $ext_info = '.pdf';
                        break;
                    case 'image':
                        $accept = 'image/*';
                        $ext_info = 'gambar (jpeg, png, dll)';
                        break;
                    case 'video':
                        $accept = 'video/*';
                        $ext_info = 'video (mp4, avi, dll)';
                        break;
                }

                // Simpan instruksi upload ke variabel konten (HTML dari Quill)
                $input = '
        <div class="mb-2">
            <div>' . $request->konten_upload . '</div>
        </div>
        <label for="formFile1" class="form-label fw-semibold">' . e($request->deskripsi_upload) . '</label>
        <input class="form-control" type="file" id="formFile1" name="file" accept="' . $accept . '">
        <small>Kumpulkan dengan format <strong>' . $ext_info . '</strong></small>
    ';

                uploadDinamis::create([
                    'id_topik' => $request->id_topik,
                    'nama_upload' => $request->nama_upload,
                    'konten' => $input, // ← termasuk konten dari Quill
                    'deskripsi' => $request->deskripsi_upload, // ← ringkasan biasa
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
        $request->validate([
            'id_topik' => 'required|exists:topikdinamis,id_topik',
        ]);

        $topik = topikdinamis::findOrFail($request->id_topik);

        switch ($tipe) {
            case 'materi':
                $request->validate([
                    'nama_materi' => 'required|string|max:255',
                    'konten_materi' => 'required|string',
                ]);

                $data = materiDinamis::findOrFail($id);
                $data->update([
                    'nama_materi' => $request->nama_materi,
                    'konten' => $request->konten_materi,
                ]);
                break;

            case 'evaluasi':
                $request->validate([
                    'nama_evaluasi' => 'required|string|max:255',
                    'soal_json' => 'required|json',
                ]);

                $data = evaluasiDinamis::findOrFail($id);
                $data->update([
                    'nama_evaluasi' => $request->nama_evaluasi,
                    'konten' => $request->soal_json,
                ]);
                break;

            case 'upload':
                $request->validate([
                    'nama_upload' => 'required|string|max:255',
                    'deskripsi_upload' => 'required|string',
                    'konten_upload' => 'required|string',
                    'tipe_file' => 'required|in:word,excel,pdf,image,video',
                ]);

                // Tentukan accept dan info file
                $fileInfo = [
                    'word' => ['.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document', '.doc atau .docx'],
                    'excel' => ['.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', '.xls atau .xlsx'],
                    'pdf' => ['.pdf,application/pdf', '.pdf'],
                    'image' => ['image/*', 'gambar (jpeg, png, dll)'],
                    'video' => ['video/*', 'video (mp4, avi, dll)']
                ];
                [$accept, $ext_info] = $fileInfo[$request->tipe_file];

                $input = "
                <div class='mb-2'><div>{$request->konten_upload}</div></div>
                <label for='formFile1' class='form-label fw-semibold'>" . e($request->deskripsi_upload) . "</label>
                <input class='form-control' type='file' id='formFile1' name='file' accept='{$accept}'>
                <small>Kumpulkan dengan format <strong>{$ext_info}</strong></small>
            ";

                $data = uploadDinamis::findOrFail($id);
                $data->update([
                    'nama_upload' => $request->nama_upload,
                    'tipe_file' => $request->tipe_file,
                    'konten' => $input,
                    'deskripsi' => $request->deskripsi_upload,
                ]);
                break;

            default:
                return back()->with('error', 'Jenis subtopik tidak dikenali.');
        }

        return redirect()->route('topik.index', ['token_kelas' => $topik->token_kelas])
            ->with('success', 'Subtopik berhasil diperbarui');
    }

    public function destroy(Request $request, $tipe, $id)
    {
        // Validasi dulu apakah id_topik ada dalam request
        if (!$request->has('id_topik')) {
            abort(400, 'ID Topik tidak ditemukan dalam permintaan.');
        }

        // Ambil topik berdasarkan ID dari request
        $topik = TopikDinamis::find($request->id_topik);

        // Cek apakah topik ditemukan
        if (!$topik) {
            abort(404, 'Topik tidak ditemukan.');
        }

        // Ambil data subtopik berdasarkan tipe
        switch ($tipe) {
            case 'materi':
                $data = MateriDinamis::findOrFail($id);
                break;
            case 'evaluasi':
                $data = EvaluasiDinamis::findOrFail($id);
                break;
            case 'upload':
                $data = UploadDinamis::findOrFail($id);
                break;
            default:
                abort(404, 'Tipe subtopik tidak dikenali.');
        }

        // Hapus subtopik
        $data->delete();

        // Redirect ke halaman topik dengan token_kelas
        return redirect()->route('topik.index', ['token_kelas' => $topik->token_kelas])
            ->with('success', 'Subtopik berhasil dihapus.');
    }

}
