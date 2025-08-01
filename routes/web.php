<?php

use App\Http\Controllers\Admin\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\GuruMiddleware;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\nilaiController;

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ContentAController;
use App\Http\Controllers\ContentBController;

use App\Http\Controllers\ContentCController;
use App\Http\Controllers\RefleksiController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\userBadgeController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\dataExportController;
use App\Http\Controllers\uploadFileController;
use App\Http\Controllers\jawabanTestController;
use App\Http\Controllers\jawabanKelompokController;
use App\Http\Controllers\AnalisisIndividuController;
use App\Http\Controllers\UpdateAksesHalamanController;
use App\Http\Controllers\RefleksiKesejarahanController;
use App\Http\Controllers\controllerSyaratKelayakanObjekKesejarahan;


// Download
Route::get('/download/{filename}', [FileController::class, 'download']);

// Home Controller
Route::get('/', [HomeController::class, 'beranda'])->name('beranda');
Route::get('/materi', [HomeController::class, 'materi'])->name('materi');
Route::get('/perihal', [HomeController::class, 'perihal'])->name('perihal');
Route::get('/bahan-bacaan', [HomeController::class, 'sumber'])->name('sumber');

// Content A
Route::controller(ContentAController::class)->group(function () {
    Route::get('/Informasi/CPL', 'cpl')->name('A-1');
    Route::get('/Informasi/CPMK', 'cpmk')->name('A-2');
    Route::get('/Informasi/Peran-Dosen', 'peranDosen')->name('A-3');
    Route::get('/Informasi/Sarana-Dan-Prasarana', 'saranaDanPrasarana')->name('A-4');
    Route::get('/Informasi/Kolaborasi-Narasumber', 'kolaborasiNarasumber')->name('A-5');
    Route::get('/Informasi/Cara-Penggunaan', 'caraPenggunaan')->name('A-6');
    Route::get('/Informasi/Tahapan', 'tahapan')->name('A-7');
});

// Content B
Route::controller(ContentBController::class)->group(function () {
    Route::get('/Kesejarahan/Pre-Test', 'preTest')->name('B-1');
    Route::get('/Kesejarahan/Kegiatan-Pembelajaran-1', 'kegiatanPembelajaran1')->name('B-2');
    Route::get('/Kesejarahan/Kuis-Kesejarahan', 'kuisKesejarahan')->name('B-3');
    Route::get('/Kesejarahan/Kegiatan-Pembelajaran-2', 'kegiatanPembelajaran2')->name('B-4');
    Route::get('/Kesejarahan/Analisis-Kelompok', 'analisisKelompok')->name('B-5');
    Route::get('/Kesejarahan/Analisi-Individu', 'analisisIndividu')->name('B-6');
    Route::get('/Kesejarahan/Kegiatan-Pembelajaran-3', 'kegiatanPembelajaran3')->name('B-7');
    Route::get('/Kesejarahan/Post-Test', 'postTest')->name('B-8');
    Route::get('/Kesejarahan/Refleksi', 'refleksi')->name('B-9');
});

// Content C
Route::controller(ContentCController::class)->group(function () {
    Route::get('/KWU-dan-Kepariwisataan/Pre-Test', 'preTest')->name('C-1');
    Route::get('/KWU-dan-Kepariwisataan/KWU-dan-Kepariwisataan', 'kwuDanKepariwisataan')->name('C-2');
    Route::get('/KWU-dan-Kepariwisataan/Kuis', 'kuisKwuDanKepariwisataan')->name('C-3');
    Route::get('/KWU-dan-Kepariwisataan/Analisis-Kelompok-1', 'analisisKelompok1')->name('C-4');
    Route::get('/KWU-dan-Kepariwisataan/Analisis-Kelompok-2', 'analisisKelompok2')->name('C-5');
    Route::get('/KWU-dan-Kepariwisataan/Diskusi-Kelompok', 'diskusiKelompok')->name('C-6');
    Route::get('/KWU-dan-Kepariwisataan/Proyek-Individu', 'proyekIndividu')->name('C-7');
    Route::get('/KWU-dan-Kepariwisataan/Refleksi-1', 'refleksi1')->name('C-8');
    Route::get('/KWU-dan-Kepariwisataan/Praktik-Lapangan-1', 'praktikLapangan1')->name('C-9');
    Route::get('/KWU-dan-Kepariwisataan/Praktik-Lapangan-2', 'praktikLapangan2')->name('C-10');
    Route::get('/KWU-dan-Kepariwisataan/Post-Test', 'postTest')->name('C-11');
    Route::get('/KWU-dan-Kepariwisataan/Refleksi-2', 'refleksi2')->name('C-12');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Register
Route::get('/daftar', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Login
Route::get('/masuk', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');

// Middleware auth
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
    // Route untuk menampilkan dashboard
    // Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    // Route untuk klaim Master Badge
    Route::post('/klaim-master-badge', [UserBadgeController::class, 'awardHistoricalBadge'])->name('awardHistoricalBadge');
    Route::post('/klaim-penguasa-materi-badge', [UserBadgeController::class, 'awardEntrepreneurialBadge'])->name('awardEntrepreneurialBadge');
    Route::post('/selesaiMateri', [UserBadgeController::class, 'awardCombinedBadge'])->name('awardCombinedBadge');
    Route::post('/klaim-high-rank-badge', [UserBadgeController::class, 'awardHighRankBadge'])->name('awardHighRankBadge');
    Route::post('/klaim-siCepat-badge', [UserBadgeController::class, 'awardSiCepatBadge'])->name('awardSiCepatBadge');
    Route::get('/data-pengguna', [DashboardController::class, 'showUser'])->name('dashboard.showUser')->middleware('admin');

    // Pemindahan halaman
    Route::get('/A-Informasi-Umum', [HalamanController::class, 'A'])->name('pages.A');
    Route::get('/B-Kesejarahan', [HalamanController::class, 'B'])->name('pages.B');
    //pretest kesejarahan
    Route::post('/B-Kesejarahan/simpan-nilai-pretest', [NilaiController::class, 'simpanNilaiPretest'])->name('simpanNilaiPretest');
    //posttest kesejarahan
    Route::post('/B-Kesejarahan/simpan-nilai-posttest', [NilaiController::class, 'simpanNilaiPosttest'])->name('simpanNilaiPosttest');
    Route::post('/B-Kesejarahan/individu2', [AnalisisIndividuController::class, 'simpanJawaban'])->name('simpanJawabanIndividu2');
    Route::post('/B-Kesejarahan/individu', [AnalisisIndividuController::class, 'simpanJawabanIndividu'])->name('simpanAnalisisIndividu');
    Route::post('/B-Kesejarahan/refleksi', [RefleksiController::class, 'simpanRefleksi'])->name('simpanRefleksiKesejarahan');
    Route::post('/B-Kesejarahan/uploadFile', [uploadFileController::class, 'uploadFile'])->name('uploadFileKesejarahan');
    Route::get('/C-Kewirausahaan-dan-Kepariwisataan', [HalamanController::class, 'C'])->name('pages.C');
    Route::post('/C-Kewirausahaan-dan-Kepariwisataan/aktivitaskelompok', [jawabanKelompokController::class, 'simpanAktivitas'])->name('simpanAktivitas');
    Route::post('/C-Kewirausahaan-dan-Kepariwisataan/uploadFile', [uploadFileController::class, 'uploadFile'])->name('uploadFileKewirausahaan');
    Route::post('/C-Kewirausahaan-dan-Kepariwisataan/individu', [AnalisisIndividuController::class, 'simpanJawabanIndividuKewirausahaan'])->name('simpanJawabanIndividuKewirausahaan');
    Route::post('/C-Kewirausahaan-dan-Kepariwisataan/refleksi', [RefleksiController::class, 'simpanRefleksi'])->name('simpanRefleksiKewirausahaan');
    // Route::get('/materi', [HalamanController::class, 'materi'])->name('pages.materi');
    Route::get('/Daftar-Pustaka', [HalamanController::class, 'daftarPustaka'])->name('pages.dafus');
    Route::get('/hasil', [HalamanController::class, 'review'])->name('hasil');
});

// Menyimpan Data Syarat Kelayakan Objek Kesejarahan
Route::post('/B-Kesejarahan/inputFormKelayakan', [controllerSyaratKelayakanObjekKesejarahan::class, 'store'])->name('simpanFormKelayakan');


// Middleware admin
Route::group(['middleware' => ['admin']], function () {

    Route::get('/data-pengguna', [DashboardController::class, 'showUser'])->name('dashboard.showUser');

    Route::prefix('/admin')->group(function () {
        Route::resource('/manajemen-konten', App\Http\Controllers\Admin\ManajemenKontenController::class);
    });
});

// Latihan
Route::get('/latihan', [LatihanController::class, 'latihan'])->name('latihan');
Route::put('/latihan', [LatihanController::class, 'latihan']);
Route::get('/kuis', [LatihanController::class, 'kuis'])->name('kuis');
Route::get('/evaluasi', [LatihanController::class, 'evaluasi'])->name('evaluasi');
Route::post('/evaluasi', [NilaiController::class, 'simpanNilai'])->name('simpanNilai');
Route::get('/selesai-evaluasi', function () {
    return view('latihan.selesaiEvaluasi');
})->name('selesaiEvaluasi');

Route::get('/info', [LatihanController::class, 'info'])->name('info');
Route::get('/dragndrop', [LatihanController::class, 'dragndrop'])->name('dragndrop');
Route::get('/latihan2', [LatihanController::class, 'latihan2'])->name('latihan2');

// Controller Dosen
Route::get('/Data-Kelas', [DosenController::class, 'datakelas'])->name('data-kelas');
Route::get('/Progress-Belajar', [DosenController::class, 'dataEvaluasi'])->name('progress-belajar');
Route::get('/Data-Mahasiswa', [DosenController::class, 'dataMahasiswa'])->name('data-mahasiswa');
Route::get('/data-export-nilai', [DosenController::class, 'dataExportNilai'])->name('data.export.nilai');
Route::post('/dataMahasiswa/save', [DosenController::class, 'saveGroup'])->name('dataMahasiswa.saveGroup');
Route::post('/dataMahasiswa/remove', [DosenController::class, 'removeFromGroup'])->name('dataMahasiswa.removeFromGroup');
Route::post('/dataMahasiswa/autoAssignGroup', [DosenController::class, 'autoAssignGroup'])->name('dataMahasiswa.autoAssignGroup');

Route::get('/Data-Nilai', [DosenController::class, 'dataNilai'])->name('data-nilai');
Route::get('/Data-Nilai-Test', [DosenController::class, 'dataNilaiTest'])->name('data-hasil-test');
Route::get('/Data-Refleksi', [DosenController::class, 'dataRefleksi'])->name('data-refleksi');

// data jawaban individu
Route::get('/jawabanIndividu/{email}', [AnalisisIndividuController::class, 'tampilkanJawabanIndividu'])->name('dataJawabanIndividu');

// data jawaban Test
Route::get('/jawabanTest/{email}', [jawabanTestController::class, 'tampilkanJawabanTest'])->name('dataJawabanTest');

// data jawaban Refleksi
Route::get('/jawabanRefleksi/{email}', [RefleksiController::class, 'tampilkanJawabanRefleksi'])->name('dataJawabanRefleksi');
// Route to handle the POST request for saving individual answers
Route::post('/jawabanIndividu/{email}', [nilaiController::class, 'simpanNilaiIndividu'])->name('kirimJawabanIndividu');

// data jawaban kelompok
Route::get('/jawabanKelompok/{id_kelompok?}', [JawabanKelompokController::class, 'lihatJawaban'])->name('dataJawabanKelompok');
Route::post('/jawabanKelompok/{id_kelompok}', [nilaiController::class, 'simpanNilaiKelompok'])->name('kirimJawabanKelompok');


// Session Controller Untuk Sidebar agar tidak menutup
Route::post('/laman', [SessionController::class, 'laman'])->name('laman');
Route::post('/lamanSub', [SessionController::class, 'lamanSub'])->name('lamanSub');

// Progress akses Halaman

Route::get('/updateAksesHalaman', [UpdateAksesHalamanController::class, 'update'])->name('updateAksesHalaman');


// Poin DND 
Route::post('/DND1', [PoinController::class, 'DND1'])->name('DND1');
Route::post('/DND2', [PoinController::class, 'DND2'])->name('DND2');

// Export Data
Route::get('/export-evaluasi', [dataExportController::class, 'exportEvaluasi'])->name('export.evaluasi');
Route::get('/export-kelas', [dataExportController::class, 'exportKelas'])->name('export.kelas');
Route::get('/export-nilai', [dataExportController::class, 'exportNilai'])->name('export.nilai');

// Sistem Kelas
Route::middleware([
    GuruMiddleware::class,
])->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::get('kelas/create', [KelasController::class, 'create'])->name('kelas.create');
});

// Halaman Rubah foto Profil
Route::get('/change-profil-photo', function () {
    return view('auth.change-profile');
})->name('change.profile');

// Update Foto Profil
Route::post('/update-profile-photo', [AuthController::class, 'updateProfilePhoto'])->name('profile.photo.update');

// Halaman Rubah Nama
Route::get('/change-name', function () {
    return view('auth.change-name');
})->name('change.name');

// Update Nama dan Password
Route::post('/update-nama', [AuthController::class, 'updateName'])->name('update.nama');
Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('update.auth');

// Halaman Reset Password
Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('reset.password');

// Route::controller(AdminController::class)->group(function () {
//     Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
//     Route::get('/admin/reset-password', 'showResetPassword')->name('admin.reset.password');
//     Route::post('/admin/reset-password/{id}', 'resetPassword');
//     Route::get('/admin/data-kelas', 'dataKelas')->name('admin.data.kelas');
//     Route::delete('/kelas/{id}', [AdminController::class, 'destroy'])->name('kelas.destroy');

// });

Route::get('/admin/reset-password', [ResetPasswordController::class, 'showResetPassword'])->name('admin.reset.password');
Route::post('/admin/reset-password/{id}', [ResetPasswordController::class, 'resetPassword']);
