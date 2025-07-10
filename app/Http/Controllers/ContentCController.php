<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kelompok;
use App\Models\Refleksi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AnalisisKelompokKewirausahaan;
use App\Models\Analisis_individu_kewirausahaan;
use Illuminate\Support\Facades\DB;

class ContentCController extends Controller
{
    public function preTest()
    {
        $user = Auth::user()->email;
        $prevUrl = "/Kesejarahan/Refleksi";
        $nextUrl = "/KWU-dan-Kepariwisataan/KWU-dan-Kepariwisataan";
        $activeMenu = 'menu3';

        $batas_test = Nilai::where('email', $user)
            ->where('aspek', 'pre_test_kwu')
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
        return view('content-C.preTest', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'batas_test_value', 'skor_test_value'));
    }

    public function kwuDanKepariwisataan(Request $request)
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Pre-Test";
        $nextUrl = "/KWU-dan-Kepariwisataan/Kuis";
        // $nextUrl = "/KWU-dan-Kepariwisataan/Proyek-Individu";

        // Ambil nomor halaman dari query string, default ke 1
        $page = $request->input('page', 1);

        // Teks yang akan dibagi
        $content = ['
            <p>
    <b>CPMK:</b>
</p>
<ol>
    <li>
        Mahasiswa mampu menguraikan perspektif terkait pemasaran kewirausahaan kesejarahan melalui diskusi kelompok dan pakar.
    </li>
    <li>
        Mahasiswa mampu merancang produk dan jasa terkait kewirausahaan kesejarahan berdasarkan konsep kewirausahaan.
    </li>
    <li>
        Mahasiswa memiliki keterampilan memasarkan produk dan jasa terkait kewirausahaan kesejarahan berdasarkan hasil praktik lapangan.
    </li>
</ol>
<p class="kotak">
    <b>PERTANYAAN PEMANTIK</b> <br> Adakah di antara kalian yang pernah berbelanja online? Berapa rata-rata pengeluaran per bulan jika berbelanja online? <br> <b>Tips untuk dosen:</b> <br>Dalam melakukan pembelajaran ini, dosen dapat menayangkan sebuah video tentang pemasaran yang menggunakan teknologi, misal pemasaran pada Amazon.com, Alibaba, Lazada, shopee, Tokopedia, bukalapak, dan lain-lain.
</p>
<figure>
<img class="d-block mx-auto img-fluid my-3 shadow" src="https://files.planet.ung.ac.id/univ/img-20220119-wa0003-19.01.2022.14.37.18.jpg" alt="Pasar Terapung" style="width: 500px; height: auto;">
<figcaption class="text-center">Sumber: https://ung.ac.id/</figcaption>
</figure>
<p>
    Secara etimologi, kewirausahaan berasal dari kata wira dan usaha. Wira berarti peluang, pahlawan, manusia unggul, teladan, dan berbudi luhur. Wirausaha adalah orang yang pandai mengenali produk baru, menyusun cara produksi, mengatur permodalan, serta memasarkan produk (Rusdiana, 2014).
</p>
<p>
    Wirausaha adalah orang yang mendirikan, mengelola, dan mengembangkan perusahaan, serta melihat dan menilai kesempatan bisnis untuk meraih keuntungan (Sukamdani, 2013). Wirausahawan adalah orang yang menciptakan bisnis baru dengan mengambil risiko demi mencapai keuntungan dan pertumbuhan (Fahmi, 2014).
</p>
<p>
    Kewirausahaan adalah ilmu yang mengkaji pengembangan kreativitas dan keberanian menanggung risiko untuk mewujudkan hasil karya (Fahmi, 2014). Wirausahawan berperan sebagai penemu dan perencana dalam menciptakan produk baru, teknologi, serta merancang usaha dan strategi perusahaan (Suryana).
</p>
<p>
    Peter F. Drucker menjelaskan konsep kewirausahaan merujuk pada sifat, watak, dan ciri-ciri yang melekat pada seseorang yang mempunyai kemauan keras untuk mewujudkan gagasan inovatif ke dalam dunia usaha yang nyata dan dapat mengembangkannya dengan tangguh. Dan menurut Zimmerer kewirausahaan adalah penerapan kreativitas dan inovasi untuk memecahkan masalah dan upaya memanfaatkan peluang yang dihadapi setiap hari.
</p>','
<p>
    Kewirausahaan merupakan gabungan dari kreativitas, inovasi dan keberanian menghadapi resiko yang dilakukan dengan cara kerja keras untuk membentuk dan memelihara usaha baru (Suryana, 2014). Nilai-nilai hakiki kewirausahaan menurut Suryana (2014) yaitu:

</p>
<ol type="a">
    <li class="mb-2">
        <strong>Percaya diri</strong>: Keyakinan dalam menghadapi tugas dan risiko, yang membantu menyelesaikan pekerjaan dengan efektif dan efisien.
    </li>
    <li class="mb-2">
        <strong>Kepemimpinan</strong>: Wirausahawan harus mampu memimpin usahanya untuk mencapai kesuksesan.
    </li>
    <li class="mb-2">
        <strong>Berorientasi ke masa depan</strong>: Wirausahawan memiliki pandangan jauh ke depan dan tidak cepat puas dengan pencapaian saat ini.
    </li>
    <li class="mb-2">
        <strong>Berani mengambil risiko</strong>: Kemauan untuk menghadapi risiko merupakan nilai utama dalam kewirausahaan.
    </li>
    <li class="mb-2">
        <strong>Keorisinalitas (kreativitas dan inovasi)</strong>: Kreativitas menciptakan gagasan baru, sedangkan inovasi mengaplikasikan solusi kreatif untuk permasalahan.
    </li>
    <li class="mb-2">
        <strong>Berorientasi pada tugas dan hasil</strong>: Mengutamakan prestasi, ketekunan, dan inisiatif untuk meraih peluang dan keberhasilan dalam kewirausahaan.
    </li>
</ol>'
        ];

        // Hitung total halaman
        $totalPages = ceil(count($content) / 1); // Setiap halaman menampilkan 1 konten

        // Validasi halaman
        if ($page < 1 || $page > $totalPages) {
            $page = 1; // Set ke halaman 1 jika halaman tidak valid
        }

        // Ambil konten untuk halaman saat ini
        $start = ($page - 1) * 1; // Setiap halaman menampilkan 1 konten
        $currentContent = array_slice($content, $start, 1);


        $activeMenu = 'menu3';
        return view('content-C.kwuDanKepariwisataan', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'currentContent', 'totalPages', 'page'));
    }

    public function kuisKwuDanKepariwisataan()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/KWU-dan-Kepariwisataan";
        $nextUrl = "/KWU-dan-Kepariwisataan/Analisis-Kelompok-1";

        $batas_test = Nilai::where('email', $user)
            ->where('aspek', 'poin_DND_KWU')
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

        $activeMenu = 'menu3';
        return view('content-C.kuisKwuDanKepariwisataan', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'batas_test_value', 'skor_test_value'));
    }

    public function analisisKelompok1()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Kuis";
        $nextUrl = "/KWU-dan-Kepariwisataan/Analisis-Kelompok-2";
        $activeMenu = 'menu3';

        // Dapatkan id_kelompok dari tabel kelompok berdasarkan email pengguna
        $kelompok = Kelompok::where('email', $user)->first();

        if ($kelompok) {
            $id_kelompok = $kelompok->id_kelompok;

            // Ambil semua anggota kelompok berdasarkan id_kelompok dengan join ke tabel users
            $anggotaKelompok = Kelompok::where('id_kelompok', $id_kelompok)
                ->join('users', 'kelompok.email', '=', 'users.email')
                ->select('kelompok.*', 'users.nama_lengkap')
                ->get(); // Convert to collection

            // Ambil jawaban berdasarkan id_kelompok untuk halaman C
            $jawabanKelompok = AnalisisKelompokKewirausahaan::where('id_kelompok', $id_kelompok)->get();
        } else {
            $id_kelompok = null;
            $anggotaKelompok = collect(); // Kosongkan jika id_kelompok tidak ditemukan
            $jawabanKelompok = collect(); // Kosongkan jika id_kelompok tidak ditemukan
        }
        ;
        $nilaiKelompokAktivitas1 = DB::table('nilai')->where('email', $user)->where('aspek', 'analisa_kelompok_kewirausahaan_aktivitas1')->first();
        return view('content-C.analisisKelompok1', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'jawabanKelompok', 'id_kelompok', 'anggotaKelompok','nilaiKelompokAktivitas1'));
    }

    public function analisisKelompok2()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Analisis-Kelompok-1";
        $nextUrl = "/KWU-dan-Kepariwisataan/Diskusi-Kelompok";
        $activeMenu = 'menu3';

        // Dapatkan id_kelompok dari tabel kelompok berdasarkan email pengguna
        $kelompok = Kelompok::where('email', $user)->first();

        if ($kelompok) {
            $id_kelompok = $kelompok->id_kelompok;

            // Ambil semua anggota kelompok berdasarkan id_kelompok dengan join ke tabel users
            $anggotaKelompok = Kelompok::where('id_kelompok', $id_kelompok)
                ->join('users', 'kelompok.email', '=', 'users.email')
                ->select('kelompok.*', 'users.nama_lengkap')
                ->get(); // Convert to collection

            // Ambil jawaban berdasarkan id_kelompok untuk halaman C
            $jawabanKelompok = AnalisisKelompokKewirausahaan::where('id_kelompok', $id_kelompok)->get();
        } else {
            $id_kelompok = null;
            $anggotaKelompok = collect(); // Kosongkan jika id_kelompok tidak ditemukan
            $jawabanKelompok = collect(); // Kosongkan jika id_kelompok tidak ditemukan
        }
        ;
        $nilaiKelompokAktivitas2 = DB::table('nilai')->where('email', $user)->where('aspek', 'analisa_kelompok_kewirausahaan_aktivitas2')->first();
        return view('content-C.analisisKelompok2', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'jawabanKelompok', 'id_kelompok', 'anggotaKelompok','nilaiKelompokAktivitas2'));
    }

    public function diskusiKelompok()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Analisis-Kelompok-2";
        $nextUrl = "/KWU-dan-Kepariwisataan/Proyek-Individu";
        $activeMenu = 'menu3';

        // Dapatkan id_kelompok dari tabel kelompok berdasarkan email pengguna
        $kelompok = Kelompok::where('email', $user)->first();

        if ($kelompok) {
            $id_kelompok = $kelompok->id_kelompok;

            // Ambil semua anggota kelompok berdasarkan id_kelompok dengan join ke tabel users
            $anggotaKelompok = Kelompok::where('id_kelompok', $id_kelompok)
                ->join('users', 'kelompok.email', '=', 'users.email')
                ->select('kelompok.*', 'users.nama_lengkap')
                ->get(); // Convert to collection

            // Ambil jawaban berdasarkan id_kelompok untuk halaman C
            $jawabanKelompok = AnalisisKelompokKewirausahaan::where('id_kelompok', $id_kelompok)->get();
        } else {
            $id_kelompok = null;
            $anggotaKelompok = collect(); // Kosongkan jika id_kelompok tidak ditemukan
            $jawabanKelompok = collect(); // Kosongkan jika id_kelompok tidak ditemukan
        }
        ;

        $nilaiKelompokAktivitas3 = DB::table('nilai')->where('email', $user)->where('aspek', 'analisa_kelompok_kewirausahaan_aktivitas3')->first();

        return view('content-C.diskusiKelompok', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'jawabanKelompok', 'id_kelompok', 'anggotaKelompok','nilaiKelompokAktivitas3'));
    }

    public function proyekIndividu()
    {
        $filename = "PROYEK_INDIVIDU_HISTORIOPRENEURSHIP.docx";
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Diskusi-Kelompok";
        // $prevUrl = "/KWU-dan-Kepariwisataan/KWU-dan-Kepariwisataan"; 
        $nextUrl = "/KWU-dan-Kepariwisataan/Refleksi-1";
        $activeMenu = 'menu3';

        // Ambil jawaban individu yang sudah ada
        $jawabanIndividu = Analisis_individu_kewirausahaan::where('created_by', $user)
            ->pluck('jawaban', 'aspek')
            ->toArray();
        $uploadedFile = \DB::table('upload_file_tugas')
            ->where('kategori', 'proyek individu')
            ->where('created_by', $user)
            ->first();
        $nilaiAnalisisIndividuKWU = DB::table('nilai')->where('email', $user)->where('aspek', 'analisa_individu_kewirausahaan')->first();
        $nilaiUploadProyekIndividu = DB::table('nilai')->where('email', $user)->where('aspek', 'upload_file_proyekIndividu')->first();
        return view('content-C.proyekIndividu', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'filename', 'jawabanIndividu', 'uploadedFile', 'nilaiUploadProyekIndividu','nilaiAnalisisIndividuKWU'));
    }

    public function refleksi1()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Proyek-Individu";
        $nextUrl = "/KWU-dan-Kepariwisataan/Praktik-Lapangan-1";
        // $nextUrl = "/KWU-dan-Kepariwisataan/Post-Test";
        $activeMenu = 'menu3';

        // Ambil jawaban refleksi dan pastikan jika tidak ada data, tetap hasilkan collection
        $jawabanRefleksi = Refleksi::where('created_by', $user)->where('kategori', 'refleksi kewirausahaan')
            ->get()
            ->groupBy('kategori')
            ->map(function ($items) {
                return $items->keyBy('aspek');
            });

        // Pastikan jawabanRefleksi bukan null dan set sebagai collection jika kosong
        if (!$jawabanRefleksi || $jawabanRefleksi->isEmpty()) {
            $jawabanRefleksi = collect();
        }
        return view('content-C.refleksi1', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'jawabanRefleksi'));
    }

    public function praktikLapangan1()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Refleksi-1";
        $nextUrl = "/KWU-dan-Kepariwisataan/Praktik-Lapangan-2";
        $activeMenu = 'menu3';

        $uploadedFile = \DB::table('upload_file_tugas')
            ->where('kategori', 'praktik lapangan 1')
            ->where('created_by', $user)
            ->first();

        // Tambahkan log untuk debugging
        // dd($uploadedFile); // Menampilkan data di browser untuk memastikan hasil query
        $nilaiUploadAktivitas1 = DB::table('nilai')->where('email', $user)->where('aspek', 'upload_file_aktivitas1')->first();
        return view('content-C.praktikLapangan1', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'uploadedFile', 'nilaiUploadAktivitas1'));
    }


    public function praktikLapangan2()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Praktik-Lapangan-1";
        $nextUrl = "/KWU-dan-Kepariwisataan/Post-Test";
        $activeMenu = 'menu3';
        $uploadedFile = \DB::table('upload_file_tugas')
            ->where('kategori', 'praktik lapangan 2')
            ->where('created_by', $user)
            ->first();
        $nilaiUploadAktivitas2 = DB::table('nilai')->where('email', $user)->where('aspek', 'upload_file_aktivitas2')->first();
        return view('content-C.praktikLapangan2', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'uploadedFile', 'nilaiUploadAktivitas2'));
    }

    public function postTest()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Praktik-Lapangan-2";
        // $prevUrl = "/KWU-dan-Kepariwisataan/Refleksi-1"; 
        $nextUrl = "/KWU-dan-Kepariwisataan/Refleksi-2";
        // $nextUrl = null;
        $activeMenu = 'menu3';

        $batas_test = Nilai::where('email', $user)
            ->where('aspek', 'post_test_kwu')
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

        return view('content-C.postTest', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'batas_test_value', 'skor_test_value'));
    }

    public function refleksi2()
    {
        $user = Auth::user()->email;
        $prevUrl = "/KWU-dan-Kepariwisataan/Post-Test";
        $nextUrl = null;
        $activeMenu = 'menu3';

        // Ambil jawaban refleksi dan pastikan jika tidak ada data, tetap hasilkan collection
        $jawabanRefleksi = Refleksi::where('created_by', $user)->where('kategori', 'refleksi kepariwisataan')
            ->get()
            ->groupBy('kategori')
            ->map(function ($items) {
                return $items->keyBy('aspek');
            });

        // Pastikan jawabanRefleksi bukan null dan set sebagai collection jika kosong
        if (!$jawabanRefleksi || $jawabanRefleksi->isEmpty()) {
            $jawabanRefleksi = collect();
        }

        return view('content-C.refleksi2', compact('activeMenu', 'prevUrl', 'nextUrl', 'user', 'jawabanRefleksi'));
    }
}
