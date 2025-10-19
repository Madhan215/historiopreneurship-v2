<?php

namespace App\Http\Controllers\Admin;
use App\Events\PoinUpdated;
use App\Http\Controllers\Controller;

use App\Models\evaluasiDinamis;
use App\Models\materiDinamis;
use App\Models\Nilai;
use App\Models\topikDinamis;
use App\Models\uploadDinamis;
use App\Models\uploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;

class WebDinamisController extends Controller
{
    //function buat navbar dinamis
    public function showSubtopik($topik, $subtopik)
    {
        $user = auth()->user();
        if (!$user)
            abort(403, 'Anda harus login untuk mengakses halaman ini.');

        $aktif = collect($user->token_kelas)
            ->firstWhere('status', 'aktif')['kode'] ?? null;

        // Normalisasi nama topik dan subtopik
        $topikNama = urldecode(str_replace('-', ' ', $topik));
        $subtopikNama = urldecode(str_replace('-', ' ', $subtopik));

        // Temukan topik aktif
        $topikData = topikDinamis::whereRaw(
            'LOWER(REPLACE(nama_topik, ".", "")) = ?',
            [strtolower(str_replace('.', '', $topikNama))]
        )
            ->where('status', 'on')
            ->where('token_kelas', $aktif)
            ->firstOrFail();

        // Bersihkan nama subtopik
        $cleanSubtopikNama = strtolower(preg_replace('/[^\w\s]/u', '', $subtopikNama));

        // Cek jenis subtopik
        $materi = materiDinamis::where('id_topik', $topikData->id_topik)
            ->where('status', 'on')->get()
            ->first(fn($item) => strtolower(preg_replace('/[^\w\s]/u', '', $item->nama_materi)) === $cleanSubtopikNama);

        $evaluasi = evaluasiDinamis::where('id_topik', $topikData->id_topik)
            ->where('status', 'on')->get()
            ->first(fn($item) => strtolower(preg_replace('/[^\w\s]/u', '', $item->nama_evaluasi)) === $cleanSubtopikNama);

        $upload = uploadDinamis::where('id_topik', $topikData->id_topik)
            ->where('status', 'on')->get()
            ->first(fn($item) => strtolower(preg_replace('/[^\w\s]/u', '', $item->nama_upload)) === $cleanSubtopikNama);

        // Gabungkan semua subtopik
        $allSubtopik = $this->getAllSubtopik($topikData);
        [$prevUrl, $nextUrl] = $this->getPrevNextUrls($allSubtopik, $cleanSubtopikNama, $topikData);

        // Panggil handler sesuai tipe
        if ($materi)
            return $this->handleMateri($materi, $topikData, $prevUrl, $nextUrl);
        elseif ($evaluasi)
            return $this->handleEvaluasi($evaluasi, $topikData, $user, $prevUrl, $nextUrl);
        elseif ($upload)
            return $this->handleUpload($upload, $topikData, $user, $prevUrl, $nextUrl);

        abort(404, 'Subtopik tidak ditemukan atau belum aktif.');
    }

    // ------------------------
    // 🧱 HANDLER-FUNCTIONS
    // ------------------------

    private function handleMateri($materi, $topikData, $prevUrl, $nextUrl)
    {
        return view('kontenDinamis.materi', [
            'judul' => $materi->nama_materi,
            'konten' => $materi->konten,
            'topik' => $topikData->nama_topik,
            'tipe' => 'materi',
            'prevUrl' => $prevUrl,
            'nextUrl' => $nextUrl,
        ]);
    }

    private function handleEvaluasi($evaluasi, $topikData, $user, $prevUrl, $nextUrl)
    {
        $aspek = $evaluasi->nama_evaluasi;

        $nilaiTerakhir = Nilai::where('email', $user->email)
            ->where('aspek', $aspek)
            ->orderByDesc('waktu_selesai')
            ->first();

        $batasPercobaan = 1; // ubah jika ingin lebih dari sekali
        $jumlahPercobaan = Nilai::where('email', $user->email)
            ->where('aspek', $aspek)
            ->count();

        $bisaMengerjakan = $jumlahPercobaan < $batasPercobaan;

        $questions = json_decode($evaluasi->konten, true) ?? [];
        $jumlahSoal = count($questions);

        return view('kontenDinamis.evaluasi', [
            'judul' => $evaluasi->nama_evaluasi,
            'konten' => $evaluasi->konten,
            'topik' => $topikData->nama_topik,
            'questions' => $questions,
            'jumlahSoal' => $jumlahSoal,
            'skor_test_value' => $nilaiTerakhir->nilai_akhir ?? '-',
            'jumlahPercobaan' => $jumlahPercobaan,
            'bisaMengerjakan' => $bisaMengerjakan,
            'tipe' => 'evaluasi',
            'prevUrl' => $prevUrl,
            'nextUrl' => $nextUrl,
        ]);
    }

    private function handleUpload($upload, $topikData, $user, $prevUrl, $nextUrl)
    {
        $uploadedFile = DB::table('upload_file_tugas')
            ->where('kategori', $upload->nama_upload)
            ->where('created_by', $user->email)
            ->first();

        $maxSizes = [
            'pdf' => 10240,
            'word' => 10240,
            'excel' => 10240,
            'image' => 5120,
            'video' => 51200,
        ];

        return view('kontenDinamis.upload', [
            'judul' => $upload->nama_upload,
            'konten' => $upload->konten,
            'topik' => $topikData->nama_topik,
            'uploadedFile' => $uploadedFile,
            'maxSizes' => $maxSizes,
            'tipe' => 'upload',
            'prevUrl' => $prevUrl,
            'nextUrl' => $nextUrl,
        ]);
    }

    // ------------------------
    // 🧭 HELPER-FUNCTIONS
    // ------------------------

    // ganti fungsi getAllSubtopik dan getPrevNextUrls dengan yang ini

    private function getAllSubtopik($topikData)
    {
        // Ambil semua topik yang aktif dan punya token_kelas sama
        $topiks = topikDinamis::where('status', 'on')
            ->where('token_kelas', $topikData->token_kelas)
            ->orderBy(DB::raw('COALESCE(urutan, 999)')) // urutan topik, fallback 999
            ->get(['id_topik', 'nama_topik', DB::raw('COALESCE(urutan, 999) as topik_urutan')]);

        $all = collect();

        foreach ($topiks as $t) {
            // Materi
            $m = materiDinamis::where('id_topik', $t->id_topik)
                ->where('status', 'on')
                ->get(['nama_materi as nama', DB::raw('COALESCE(urutan, 999) as urutan')])
                ->map(function ($item) use ($t) {
                    return (object) [
                        'nama' => $item->nama,
                        'tipe' => 'materi',
                        'urutan' => $item->urutan,
                        'topik_nama' => $t->nama_topik,
                        'topik_urutan' => $t->topik_urutan,
                    ];
                });

            // Evaluasi
            $e = evaluasiDinamis::where('id_topik', $t->id_topik)
                ->where('status', 'on')
                ->get(['nama_evaluasi as nama', DB::raw('COALESCE(urutan, 999) as urutan')])
                ->map(function ($item) use ($t) {
                    return (object) [
                        'nama' => $item->nama,
                        'tipe' => 'evaluasi',
                        'urutan' => $item->urutan,
                        'topik_nama' => $t->nama_topik,
                        'topik_urutan' => $t->topik_urutan,
                    ];
                });

            // Upload
            $u = uploadDinamis::where('id_topik', $t->id_topik)
                ->where('status', 'on')
                ->get(['nama_upload as nama', DB::raw('COALESCE(urutan, 999) as urutan')])
                ->map(function ($item) use ($t) {
                    return (object) [
                        'nama' => $item->nama,
                        'tipe' => 'upload',
                        'urutan' => $item->urutan,
                        'topik_nama' => $t->nama_topik,
                        'topik_urutan' => $t->topik_urutan,
                    ];
                });

            $all = $all->merge($m)->merge($e)->merge($u);
        }

        // Urutkan: pertama berdasarkan topik_urutan, lalu urutan subtopik; reset index
        return $all->sortBy(function ($item) {
            return sprintf('%04d%04d', (int) $item->topik_urutan, (int) $item->urutan);
        })->values();
    }

    private function getPrevNextUrls($allSubtopik, $cleanSubtopikNama, $topikData): array
    {
        // Cari index sekarang (samakan pembersihan nama seperti di showSubtopik)
        $currentIndex = $allSubtopik->search(
            fn($item) =>
            strtolower(preg_replace('/[^\w\s]/u', '', $item->nama)) === $cleanSubtopikNama
        );

        $prevUrl = $nextUrl = null;
        if ($currentIndex !== false) {
            if ($currentIndex > 0) {
                $prev = $allSubtopik[$currentIndex - 1];
                $prevUrl = route('showSubtopik', [
                    'topik' => Str::slug($prev->topik_nama),
                    'subtopik' => Str::slug($prev->nama),
                ]);
            }
            if ($currentIndex < $allSubtopik->count() - 1) {
                $next = $allSubtopik[$currentIndex + 1];
                $nextUrl = route('showSubtopik', [
                    'topik' => Str::slug($next->topik_nama),
                    'subtopik' => Str::slug($next->nama),
                ]);
            }
        }

        return [$prevUrl, $nextUrl];
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
        event(new PoinUpdated($request->email));

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }
    public function uploadFileDinamis(Request $request)
    {

        $kelas = Auth::user()->token_kelas;

        $kodeAktif = collect($kelas)
            ->firstWhere('status', 'aktif')['kode'] ?? null;

        // dd($kodeAktif);

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
                'kategori' => $kategoriInput,
                'token_kelas' => $kodeAktif
            ]);
        }

        return redirect()->back()->with('success', 'File berhasil diunggah!');
    }


}
