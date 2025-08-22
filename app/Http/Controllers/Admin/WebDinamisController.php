<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\evaluasiDinamis;
use App\Models\materiDinamis;
use App\Models\topikDinamis;
use App\Models\uploadDinamis;
use App\Models\uploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WebDinamisController extends Controller
{
    //function buat navbar dinamis
    public function showSubtopik($topik, $subtopik)
    {
        $user = auth()->user();

        // Ubah slug jadi nama normal (decode dan ganti tanda hubung dengan spasi)
        $topikNama = urldecode(str_replace('-', ' ', $topik));
        $subtopikNama = urldecode(str_replace('-', ' ', $subtopik));

        // Cari topik berdasarkan nama, status, dan token kelas
        $topikData = topikDinamis::whereRaw(
            'LOWER(REPLACE(nama_topik, ".", "")) = ?',
            [strtolower(str_replace('.', '', $topikNama))]
        )
            ->where('status', 'on')
            ->where('token_kelas', $user->token_kelas)
            ->firstOrFail();

        // Pencocokan subtopik dengan menghapus tanda baca umum
        $cleanSubtopikNama = strtolower(preg_replace('/[^\w\s]/u', '', $subtopikNama));

        // Ambil semua jenis konten berdasarkan ID topik
        $materi = materiDinamis::where('id_topik', $topikData->id_topik)
            ->where('status', 'on')
            ->get()
            ->first(function ($item) use ($cleanSubtopikNama) {
                return strtolower(preg_replace('/[^\w\s]/u', '', $item->nama_materi)) === $cleanSubtopikNama;
            });

        $evaluasi = evaluasiDinamis::where('id_topik', $topikData->id_topik)
            ->where('status', 'on')
            ->get()
            ->first(function ($item) use ($cleanSubtopikNama) {
                return strtolower(preg_replace('/[^\w\s]/u', '', $item->nama_evaluasi)) === $cleanSubtopikNama;
            });

        $upload = uploadDinamis::where('id_topik', $topikData->id_topik)
            ->where('status', 'on')
            ->get()
            ->first(function ($item) use ($cleanSubtopikNama) {
                return strtolower(preg_replace('/[^\w\s]/u', '', $item->nama_upload)) === $cleanSubtopikNama;
            });

        // Tentukan view mana yang dibuka
        if ($materi) {
            return view('kontenDinamis.materi', [
                'judul' => $materi->nama_materi,
                'konten' => $materi->konten,
                'topik' => $topikData->nama_topik
            ]);
        } elseif ($evaluasi) {
            return view('kontenDinamis.evaluasi', [
                'judul' => $evaluasi->nama_evaluasi,
                'konten' => $evaluasi->konten,
                'topik' => $topikData->nama_topik
            ]);
        } elseif ($upload) {
            return view('kontenDinamis.upload', [
                'judul' => $upload->nama_upload,
                'konten' => $upload->konten,
                'topik' => $topikData->nama_topik
            ]);
        }

        abort(404, 'Subtopik tidak ditemukan atau belum aktif.');
    }


    public function SimpanNilaiEvaluasi(Request $request)
    {

        $aspek = $request->aspek;

        $affected = DB::table('nilai')
            ->where('email', $request->email)
            ->where('aspek', $aspek)
            ->update(['nilai_akhir' => $request->nilai_akhir]);

        if ($affected === 0) {
            DB::table('nilai')->insert([
                'email' => $request->email,
                'nilai_akhir' => $request->nilai_akhir,
                'lama_waktu_pengerjaan' => $request->lama_waktu_pengerjaan,
                'aspek' => $aspek
            ]);
        }

        return redirect()->back()->with('success', 'Nilai Pre-Test berhasil disimpan');
    }
    public function uploadFileDinamis(Request $request)
    {
        $file = $request->file('file');
        $createdBy = Auth::user()->email;
        $kategoriInput = $request->input('category');

        if (!$file) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        // Ambil ekstensi file
        $extension = strtolower($file->getClientOriginalExtension());

        // Peta ekstensi ke tipe MIME dan ukuran maksimal
        $mimeTypes = [
            'pdf' => ['pdf'],
            'word' => ['doc', 'docx'],
            'excel' => ['xls', 'xlsx'],
            'image' => ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'],
            'video' => ['mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv', 'webm'],
        ];

        $mimeRules = [
            'pdf' => 'mimes:pdf,application/pdf',
            'word' => 'mimes:doc,docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'excel' => 'mimes:xls,xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'image' => 'mimes:jpg,jpeg,png,gif,bmp,svg,webp',
            'video' => 'mimes:mp4,mov,avi,mkv,flv,wmv,webm',
        ];

        $maxSizes = [
            'pdf' => 10240,
            'word' => 10240,
            'excel' => 10240,
            'image' => 5120,
            'video' => 51200,
        ];

        // Deteksi kategori file berdasarkan ekstensi
        $category = null;
        foreach ($mimeTypes as $key => $extensions) {
            if (in_array($extension, $extensions)) {
                $category = $key;
                break;
            }
        }

        if (!$category) {
            return back()->with('error', 'Jenis file tidak dikenali.');
        }

        // Validasi file
        $request->validate([
            'file' => 'required|file|' . $mimeRules[$category] . '|max:' . $maxSizes[$category],
        ], [
            'file.required' => 'File harus diunggah.',
            'file.file' => 'Unggahan harus berupa file.',
            'file.mimes' => 'Jenis file tidak sesuai kategori.',
            'file.max' => 'Ukuran file melebihi batas maksimum.',
        ]);

        // Cek apakah ada file lama dari user dengan kategori yang sama
        $existingFile = uploadFile::where('created_by', $createdBy)
            ->where('kategori', $kategoriInput)
            ->first();

        $storedPath = $file->store('uploads', 'public');

        if ($existingFile) {
            // Hapus file lama
            Storage::disk('public')->delete($existingFile->file_path);

            // Update record
            $existingFile->update([
                'file_path' => $storedPath,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        } else {
            // Simpan record baru
            uploadFile::create([
                'file_path' => $storedPath,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'created_by' => $createdBy,
                'kategori' => $kategoriInput, // ✅ dari input form
            ]);
        }

        return redirect()->back()->with('success', 'File berhasil diunggah!');
    }


}
