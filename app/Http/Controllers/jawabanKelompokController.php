<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AnalisisKelompokKesejarahan;
use App\Models\AnalisisKelompokKewirausahaan;
use App\Models\AnalisisIndividuKesejeranhanII;

class jawabanKelompokController extends Controller
{
public function lihatJawaban($kode_kelas = null, $id_kelompok = null)
{
    $activeMenu = 'active';

    // Ambil token_kelas guru
    $kelasGuru = Auth::user()->token_kelas;

    if (is_string($kelasGuru)) {
        $kelasGuru = json_decode($kelasGuru, true);
    }

    if (!is_array($kelasGuru)) {
        return back()->with('error', 'Format token_kelas guru tidak valid.');
    }

    // Ambil hanya kelas aktif
    $kelasAktifGuru = collect($kelasGuru)
        ->where('status', 'aktif')
        ->pluck('kode')
        ->values()
        ->all();

    if (empty($kelasAktifGuru)) {
        return back()->with('error', 'Tidak ada kelas aktif.');
    }

    // Jika kelas belum dipilih → pilih kelas aktif pertama
    if (!$kode_kelas) {
        $kode_kelas = $kelasAktifGuru[0];
    }

    // Ambil kelompok dalam kelas yang dipilih
    $kelompokList = Kelompok::where('token_kelas', $kode_kelas)->get();

    if ($kelompokList->isEmpty()) {
        return back()->with('error', 'Tidak ada kelompok pada kelas ini.');
    }

    // Jika kelompok belum dipilih → pilih kelompok pertama
    if (!$id_kelompok) {
        $id_kelompok = $kelompokList->first()->id_kelompok;
    }

    // ----------------------------
    // AMBIL JAWABAN PER AKTIVITAS
    // ----------------------------

    $jawabanKewirausahaan1 = AnalisisKelompokKewirausahaan::where('id_kelompok', $id_kelompok)
        ->where('kategori', 'aktivitas 1')
        ->get();

    $jawabanKewirausahaan2 = AnalisisKelompokKewirausahaan::where('id_kelompok', $id_kelompok)
        ->where('kategori', 'aktivitas 2')
        ->get();

    $jawabanKewirausahaan3 = AnalisisKelompokKewirausahaan::where('id_kelompok', $id_kelompok)
        ->where('kategori', 'aktivitas 3')
        ->get();

    // ----------------------------
    // AMBIL NILAI (SELALU NILAI TERBARU)
    // ----------------------------

    $nilaiAktivitas1 = DB::table('nilai')
        ->where('percobaan_ke', $id_kelompok)
        ->where('aspek', 'analisa_kelompok_kewirausahaan_aktivitas1')

        ->first();

    $nilaiAktivitas2 = DB::table('nilai')
        ->where('percobaan_ke', $id_kelompok)
        ->where('aspek', 'analisa_kelompok_kewirausahaan_aktivitas2')

        ->first();

    $nilaiAktivitas3 = DB::table('nilai')
        ->where('percobaan_ke', $id_kelompok)
        ->where('aspek', 'analisa_kelompok_kewirausahaan_aktivitas3')

        ->first();

    return view('latihan.jawabanKelompok', compact(
        'kode_kelas',
        'kelasAktifGuru',
        'kelompokList',
        'id_kelompok',
        'jawabanKewirausahaan1',
        'jawabanKewirausahaan2',
        'jawabanKewirausahaan3',
        'nilaiAktivitas1',
        'nilaiAktivitas2',
        'nilaiAktivitas3',
        'activeMenu'
    ));
}



    public function simpanAktivitas(Request $request)
    {
        // dd($request);
        // Dapatkan email pengguna yang sedang login
        $userEmail = Auth::user()->email;
        $kelas = Auth::user()->token_kelas;

        $kodeAktif = collect($kelas)
            ->firstWhere('status', 'aktif')['kode'] ?? null;

        // Dapatkan id_kelompok dari tabel kelompok berdasarkan email pengguna
        $kelompok = Kelompok::where('email', $userEmail)->first();
        if (!$kelompok) {
            return redirect()->back()->with(['error' => 'Gagal mengirim jawaban, kamu belum memiliki kelompok.']);
        }

        $id_kelompok = $kelompok->id_kelompok;
        $created_by = auth()->user()->email;

        // Ambil data dari request
        $kategori = $request->input('kategori');
        $jawaban = $request->input('jawaban');

        // Mapping untuk aspek dari jawaban
        $aspekMapping = [
            'pengalaman' => 'Pengalaman yang didapat',
            'kelebihan' => 'kelebihan e-commerce',
            'kekurangan' => 'kekurangan e-commerce',
            'JenisTeknologi' => 'Jenis-jenis teknologi',
            'pengaruhTeknologi' => 'Pengaruh Teknologi',
            'kelebihanKekuranganTeknologi' => 'Kelebihan dan Kekurangan penggunaan teknologi',
            'kondisiProses' => 'kondisi proses sebelum dan sesudah',
            'analisaKelompok' => 'Hasil analisa kelompok'
        ];

        // Loop untuk menyimpan atau memperbarui setiap jawaban ke dalam tabel
        foreach ($jawaban as $key => $value) {
            $aspek = $aspekMapping[$key];

            // Jika jawaban adalah null, tetap gunakan null
            $value = $value === '' ? null : $value;

            // Cek apakah data sudah ada
            $existingRecord = AnalisisKelompokKewirausahaan::where('id_kelompok', $id_kelompok)
                ->where('kategori', $kategori)
                ->where('aspek', $aspek)
                ->first();

            if ($existingRecord) {
                // Update jawaban yang sudah ada jika berubah
                if ($existingRecord->jawaban !== $value) {
                    $existingRecord->update([
                        'jawaban' => $value,
                        'created_by' => $created_by, // Update created_by jika ada perubahan
                        'updated_at' => now(),
                    ]);
                }
            } else {
                // Buat jawaban baru jika belum ada
                AnalisisKelompokKewirausahaan::create([
                    'id_kelompok' => $id_kelompok,
                    'kategori' => $kategori,
                    'aspek' => $aspek,
                    'jawaban' => $value, // Nilai kosong jika sebelumnya null
                    'token_kelas'=>$kodeAktif,
                    'created_at' => now(),
                    'created_by' => $created_by,
                ]);
            }
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Jawaban berhasil disimpan atau diperbarui.');
    }


}
