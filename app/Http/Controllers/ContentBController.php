<?php

namespace App\Http\Controllers;

use App\Models\ManajemenKonten;
use App\Models\Nilai;
use App\Models\Refleksi;
use Illuminate\Http\Request;
use App\Models\FormKelayakan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AnalisisIndividuKesejarahan;
use App\Models\AnalisisIndividuKesejeranhanII;
use Illuminate\Support\Facades\DB;

class ContentBController extends Controller
{
    public function preTest()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Informasi/Tahapan";
        $nextUrl = "/Kesejarahan/Kegiatan-Pembelajaran-1";
        $activeMenu = 'menu2';

        $batas_test = Nilai::where('email', $user)
            ->where('aspek', 'pre_test_kesejarahan')
            ->first();

        if ($batas_test) {
            $skor_test_value = $batas_test->nilai_akhir;
            // Jika data sudah ada (batas_test ditemukan), set menjadi 0
            $batas_test_value = 0;
        } else {
            $skor_test_value = "-";
            // Jika data tidak ada, set menjadi 1
            $batas_test_value = 1;
        }

        return view('content-B.preTest', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'batas_test_value', 'skor_test_value'));
    }

    public function kegiatanPembelajaran1(Request $request)
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Pre-Test";
        $nextUrl = "/Kesejarahan/Kuis-Kesejarahan";
        $activeMenu = 'menu2';

        // Nomor halaman dari query ?page=, default = 1
        $page = $request->input('page', 1);

        // Ambil semua konten dari DB kategori kegiatanPembelajaran1, urutkan sesuai nomor
        $content = ManajemenKonten::where('kategori_konten', 'kegiatanPembelajaran1')
            ->orderBy('nomor')
            ->pluck('konten')
            ->toArray();

        // Tentukan jumlah item per halaman (3 per halaman)
        $perPage = 3;

        // Hitung total halaman
        $totalPages = ceil(count($content) / $perPage);

        // Potong konten sesuai halaman
        $start = ($page - 1) * $perPage;
        $currentContent = array_slice($content, $start, $perPage);

        return view('content-B.kegiatanPembelajaran1', compact(
            'activeMenu',
            'prevUrl',
            'nextUrl',
            'user',
            'currentContent',
            'totalPages',
            'page'
        ));
    }

    public function kuisKesejarahan()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Kegiatan-Pembelajaran-1";
        $nextUrl = "/Kesejarahan/Kegiatan-Pembelajaran-2";
        $activeMenu = 'menu2';

        $batas_test = Nilai::where('email', $user)
            ->where('aspek', 'poin_DND_Kesejarahan')
            ->first();

        if ($batas_test) {
            $skor_test_value = $batas_test->nilai_akhir;
            // Jika data sudah ada (batas_test ditemukan), set menjadi 0
            $batas_test_value = 0;
        } else {
            $skor_test_value = "-";
            // Jika data tidak ada, set menjadi 1
            $batas_test_value = 1;
        }


        return view('content-B.kuisKesejarahan', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'batas_test_value', 'skor_test_value'));
    }

    public function kegiatanPembelajaran2()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Kuis-Kesejarahan";
        $nextUrl = "/Kesejarahan/Analisis-Kelompok";
        $activeMenu = 'menu2';
        return view('content-B.kegiatanPembelajaran2', compact('activeMenu', 'prevUrl', 'nextUrl', 'user'));
    }

    public function analisisKelompok()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Kegiatan-Pembelajaran-2";
        $nextUrl = "/Kesejarahan/Analisi-Individu";
        $activeMenu = 'menu2';

        // Retrieve individual answers from AnalisisIndividuKesejarahanII
        $jawabanIndividuII = AnalisisIndividuKesejeranhanII::where('created_by', $user)->get();
        $nilaiJawabanIndividuKesejarahan = DB::table('nilai')->where('email', $user)->where('aspek', 'analisa_individu_kesejarahan_II')->first();

        return view('content-B.analisisKelompok', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'jawabanIndividuII', 'nilaiJawabanIndividuKesejarahan'));
    }

    public function analisisIndividu()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Analisis-Kelompok";
        $nextUrl = "/Kesejarahan/Kegiatan-Pembelajaran-3";
        $activeMenu = 'menu2';

        $jawabanIndividu = AnalisisIndividuKesejarahan::where('created_by', $user)->get();
        $nilaiJawabanIndividuKesejarahanII = DB::table('nilai')->where('email', $user)->where('aspek', 'analisa_individu_kesejarahan')->first();

        if (!$jawabanIndividu->isEmpty()) {

            $statusJawabanIndividu = "Selesai";

            // Menggunakan optional untuk menghindari error
            $objekWisata = optional($jawabanIndividu[0])->jawaban ?? '';
            $objekKesejarahan = optional($jawabanIndividu[1])->jawaban ?? '';
            $urgensiObjekKesejarahan = optional($jawabanIndividu[2])->jawaban ?? '';
            $urgensiKesejarahan = optional($jawabanIndividu[3])->jawaban ?? '';

        } else {
            $statusJawabanIndividu = "Belum dikerjakan";
            $objekWisata = '';
            $objekKesejarahan = '';
            $urgensiObjekKesejarahan = '';
            $urgensiKesejarahan = '';
        }

        // Menentukan apakah input harus dinonaktifkan
        $isDisabled = !empty($objekWisata) || !empty($objekKesejarahan) || !empty($urgensiObjekKesejarahan) || !empty($urgensiKesejarahan);

        // Form Kelayakan
        $formKelayakanDayaTarik = FormKelayakan::where('email', $user)->where('aspect', 'Daya Tarik')->get();
        $formKelayakanAksesbilitas = FormKelayakan::where('email', $user)->where('aspect', 'Aksesbilitas')->get();
        $formKelayakanSaranaDanPrasarana = FormKelayakan::where('email', $user)->where('aspect', 'Sarana dan Prasarana')->get();
        $formKelayakanPartisipasiMasyarakat = FormKelayakan::where('email', $user)->where('aspect', 'Partisipasi Masyarakat')->get();

        if (!$formKelayakanDayaTarik->isEmpty()) {
            $statusFormKelayakan = "Selesai";

            // Menentukan apakah input harus dinonaktifkan
            $isDisabledForm = True;
            // 1-1
            $formKelayakanDayaTarik1_1_score = $formKelayakanDayaTarik[0]->score;
            $formKelayakanDayaTarik1_1_reason = $formKelayakanDayaTarik[0]->reason;

            // 1-2
            $formKelayakanDayaTarik1_2_score = $formKelayakanDayaTarik[1]->score;
            $formKelayakanDayaTarik1_2_reason = $formKelayakanDayaTarik[1]->reason;

            // 1-3
            $formKelayakanDayaTarik1_3_score = $formKelayakanDayaTarik[2]->score;
            $formKelayakanDayaTarik1_3_reason = $formKelayakanDayaTarik[2]->reason;

            // 1-4
            $formKelayakanDayaTarik1_4_score = $formKelayakanDayaTarik[3]->score;
            $formKelayakanDayaTarik1_4_reason = $formKelayakanDayaTarik[3]->reason;

            // 2-1
            $formKelayakanAksesbilitas2_1_score = $formKelayakanAksesbilitas[0]->score;
            $formKelayakanAksesbilitas2_1_reason = $formKelayakanAksesbilitas[0]->reason;

            // 2-2
            $formKelayakanAksesbilitas2_2_score = $formKelayakanAksesbilitas[1]->score;
            $formKelayakanAksesbilitas2_2_reason = $formKelayakanAksesbilitas[1]->reason;

            // 2-3
            $formKelayakanAksesbilitas2_3_score = $formKelayakanAksesbilitas[2]->score;
            $formKelayakanAksesbilitas2_3_reason = $formKelayakanAksesbilitas[2]->reason;

            // 3-1
            $formKelayakanSaranaDanPrasarana3_1_score = $formKelayakanSaranaDanPrasarana[0]->score;
            $formKelayakanSaranaDanPrasarana3_1_reason = $formKelayakanSaranaDanPrasarana[0]->reason;

            // 3-2
            $formKelayakanSaranaDanPrasarana3_2_score = $formKelayakanSaranaDanPrasarana[1]->score;
            $formKelayakanSaranaDanPrasarana3_2_reason = $formKelayakanSaranaDanPrasarana[1]->reason;

            // 3-3
            $formKelayakanSaranaDanPrasarana3_3_score = $formKelayakanSaranaDanPrasarana[2]->score;
            $formKelayakanSaranaDanPrasarana3_3_reason = $formKelayakanSaranaDanPrasarana[2]->reason;

            // 3-4
            $formKelayakanSaranaDanPrasarana3_4_score = $formKelayakanSaranaDanPrasarana[3]->score;
            $formKelayakanSaranaDanPrasarana3_4_reason = $formKelayakanSaranaDanPrasarana[3]->reason;

            // 4-1
            $formKelayakanPartisipasiMasyarakat4_1_score = $formKelayakanPartisipasiMasyarakat[0]->score;
            $formKelayakanPartisipasiMasyarakat4_1_reason = $formKelayakanPartisipasiMasyarakat[0]->reason;

            // 4-2
            $formKelayakanPartisipasiMasyarakat4_2_score = $formKelayakanPartisipasiMasyarakat[1]->score;
            $formKelayakanPartisipasiMasyarakat4_2_reason = $formKelayakanPartisipasiMasyarakat[1]->reason;

            // 4-3
            $formKelayakanPartisipasiMasyarakat4_3_score = $formKelayakanPartisipasiMasyarakat[2]->score;
            $formKelayakanPartisipasiMasyarakat4_3_reason = $formKelayakanPartisipasiMasyarakat[2]->reason;

            // 4-4
            $formKelayakanPartisipasiMasyarakat4_4_score = $formKelayakanPartisipasiMasyarakat[3]->score;
            $formKelayakanPartisipasiMasyarakat4_4_reason = $formKelayakanPartisipasiMasyarakat[3]->reason;

            // 4-5
            $formKelayakanPartisipasiMasyarakat4_5_score = $formKelayakanPartisipasiMasyarakat[4]->score;
            $formKelayakanPartisipasiMasyarakat4_5_reason = $formKelayakanPartisipasiMasyarakat[4]->reason;

            // 4-6
            $formKelayakanPartisipasiMasyarakat4_6_score = $formKelayakanPartisipasiMasyarakat[5]->score;
            $formKelayakanPartisipasiMasyarakat4_6_reason = $formKelayakanPartisipasiMasyarakat[5]->reason;

            // 4-7
            $formKelayakanPartisipasiMasyarakat4_7_score = $formKelayakanPartisipasiMasyarakat[6]->score;
            $formKelayakanPartisipasiMasyarakat4_7_reason = $formKelayakanPartisipasiMasyarakat[6]->reason;
        } else {

            $statusFormKelayakan = "Belum dikerjakan";
            // Menentukan apakah input harus dinonaktifkan
            $isDisabledForm = False;
            // 1-1
            $formKelayakanDayaTarik1_1_score = "";
            $formKelayakanDayaTarik1_1_reason = "";

            // 1-2
            $formKelayakanDayaTarik1_2_score = "";
            $formKelayakanDayaTarik1_2_reason = "";

            // 1-3
            $formKelayakanDayaTarik1_3_score = "";
            $formKelayakanDayaTarik1_3_reason = "";

            // 1-4
            $formKelayakanDayaTarik1_4_score = "";
            $formKelayakanDayaTarik1_4_reason = "";

            // 2-1
            $formKelayakanAksesbilitas2_1_score = "";
            $formKelayakanAksesbilitas2_1_reason = "";

            // 2-2
            $formKelayakanAksesbilitas2_2_score = "";
            $formKelayakanAksesbilitas2_2_reason = "";

            // 2-3
            $formKelayakanAksesbilitas2_3_score = "";
            $formKelayakanAksesbilitas2_3_reason = "";

            // 3-1
            $formKelayakanSaranaDanPrasarana3_1_score = "";
            $formKelayakanSaranaDanPrasarana3_1_reason = "";

            // 3-2
            $formKelayakanSaranaDanPrasarana3_2_score = "";
            $formKelayakanSaranaDanPrasarana3_2_reason = "";

            // 3-3
            $formKelayakanSaranaDanPrasarana3_3_score = "";
            $formKelayakanSaranaDanPrasarana3_3_reason = "";

            // 3-4
            $formKelayakanSaranaDanPrasarana3_4_score = "";
            $formKelayakanSaranaDanPrasarana3_4_reason = "";

            // 4-1
            $formKelayakanPartisipasiMasyarakat4_1_score = "";
            $formKelayakanPartisipasiMasyarakat4_1_reason = "";

            // 4-2
            $formKelayakanPartisipasiMasyarakat4_2_score = "";
            $formKelayakanPartisipasiMasyarakat4_2_reason = "";

            // 4-3
            $formKelayakanPartisipasiMasyarakat4_3_score = "";
            $formKelayakanPartisipasiMasyarakat4_3_reason = "";

            // 4-4
            $formKelayakanPartisipasiMasyarakat4_4_score = "";
            $formKelayakanPartisipasiMasyarakat4_4_reason = "";

            // 4-5
            $formKelayakanPartisipasiMasyarakat4_5_score = "";
            $formKelayakanPartisipasiMasyarakat4_5_reason = "";

            // 4-6
            $formKelayakanPartisipasiMasyarakat4_6_score = "";
            $formKelayakanPartisipasiMasyarakat4_6_reason = "";

            // 4-7
            $formKelayakanPartisipasiMasyarakat4_7_score = "";
            $formKelayakanPartisipasiMasyarakat4_7_reason = "";
        }




        return view('content-B.analisisIndividu', compact(
            'activeMenu',
            'prevUrl',
            'nextUrl',
            'user',
            'objekWisata',
            'objekKesejarahan',
            'urgensiObjekKesejarahan',
            'urgensiKesejarahan',
            'isDisabled',
            'isDisabledForm',

            'statusJawabanIndividu',
            'statusFormKelayakan',

            'formKelayakanDayaTarik1_1_score',
            'formKelayakanDayaTarik1_1_reason',

            'formKelayakanDayaTarik1_2_score',
            'formKelayakanDayaTarik1_2_reason',

            'formKelayakanDayaTarik1_3_score',
            'formKelayakanDayaTarik1_3_reason',

            'formKelayakanDayaTarik1_4_score',
            'formKelayakanDayaTarik1_4_reason',

            'formKelayakanAksesbilitas2_1_score',
            'formKelayakanAksesbilitas2_1_reason',

            'formKelayakanAksesbilitas2_2_score',
            'formKelayakanAksesbilitas2_2_reason',

            'formKelayakanAksesbilitas2_3_reason',
            'formKelayakanAksesbilitas2_3_score',

            'formKelayakanSaranaDanPrasarana3_1_reason',
            'formKelayakanSaranaDanPrasarana3_1_score',

            'formKelayakanSaranaDanPrasarana3_2_reason',
            'formKelayakanSaranaDanPrasarana3_2_score',

            'formKelayakanSaranaDanPrasarana3_3_reason',
            'formKelayakanSaranaDanPrasarana3_3_score',

            'formKelayakanSaranaDanPrasarana3_4_reason',
            'formKelayakanSaranaDanPrasarana3_4_score',

            'formKelayakanPartisipasiMasyarakat4_1_reason',
            'formKelayakanPartisipasiMasyarakat4_1_score',

            'formKelayakanPartisipasiMasyarakat4_2_reason',
            'formKelayakanPartisipasiMasyarakat4_2_score',

            'formKelayakanPartisipasiMasyarakat4_3_reason',
            'formKelayakanPartisipasiMasyarakat4_3_score',

            'formKelayakanPartisipasiMasyarakat4_4_reason',
            'formKelayakanPartisipasiMasyarakat4_4_score',

            'formKelayakanPartisipasiMasyarakat4_5_reason',
            'formKelayakanPartisipasiMasyarakat4_5_score',

            'formKelayakanPartisipasiMasyarakat4_6_reason',
            'formKelayakanPartisipasiMasyarakat4_6_score',

            'formKelayakanPartisipasiMasyarakat4_7_reason',
            'formKelayakanPartisipasiMasyarakat4_7_score',
            'nilaiJawabanIndividuKesejarahanII'
        ));
    }

    public function kegiatanPembelajaran3()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Analisi-Individu";
        $nextUrl = "/Kesejarahan/Post-Test";
        $activeMenu = 'menu2';
        $uploadedFile = \DB::table('upload_file_tugas')
            ->where('kategori', 'kegiatan pembelajaran 3')
            ->where('created_by', $user)
            ->first();
        $nilaiUploadKegiatanPembelajaran3 = DB::table('nilai')->where('email', $user)->where('aspek', 'upload_file_pembelajaran3')->first();
        return view('content-B.kegiatanPembelajaran3', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'uploadedFile', 'nilaiUploadKegiatanPembelajaran3'));
    }

    public function postTest()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Kegiatan-Pembelajaran-3";
        $nextUrl = "/Kesejarahan/Refleksi";
        $activeMenu = 'menu2';

        $batas_test = Nilai::where('email', $user)
            ->where('aspek', 'post_test_kesejarahan')
            ->first();

        if ($batas_test) {
            $skor_test_value = $batas_test->nilai_akhir;
            // Jika data sudah ada (batas_test ditemukan), set menjadi 0
            $batas_test_value = 0;
        } else {
            $skor_test_value = "-";
            // Jika data tidak ada, set menjadi 1
            $batas_test_value = 1;
        }

        return view('content-B.postTest', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'batas_test_value', 'skor_test_value'));
    }

    public function refleksi()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Post-Test";
        $nextUrl = "/KWU-dan-Kepariwisataan/Pre-Test";
        $activeMenu = 'menu2';

        // Ambil jawaban refleksi dan pastikan jika tidak ada data, tetap hasilkan collection
        $jawabanRefleksi = Refleksi::where('created_by', $user)
            ->get()
            ->groupBy('kategori')
            ->map(function ($items) {
                return $items->keyBy('aspek');
            });

        // dd($jawabanRefleksi);

        // Pastikan jawabanRefleksi bukan null dan set sebagai collection jika kosong
        if (!$jawabanRefleksi || $jawabanRefleksi->isEmpty()) {
            $jawabanRefleksi = collect();
        }

        // dd($jawabanRefleksi);

        return view('content-B.refleksi', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'jawabanRefleksi'));
    }
}
