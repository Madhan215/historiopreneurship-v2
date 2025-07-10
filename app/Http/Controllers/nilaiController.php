<?php

namespace App\Http\Controllers;

use App\Events\PoinUpdated;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class nilaiController extends Controller
{
    public function simpanNilaiIndividu(Request $request, $email){
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nilai_akhir' => 'required|integer',
        'data_jawaban_penilai' => 'nullable|string',
    ]);

    // Get the aspek value from the request
    $aspek = $request->input('aspek');

    // Check if a record with the same email and aspek exists
    $nilai = Nilai::where('email', $email)->where('aspek', $aspek)->first();

    if ($nilai) {
        // If the record exists, update only specified fields
        $nilai->update([
            'data_jawaban_penilai' => $validatedData['data_jawaban_penilai'],
            'nilai_akhir' => $validatedData['nilai_akhir'],
            'waktu_selesai' => now(),  // Update completion time
        ]);
    } else {
        // If no record exists, create a new one
        Nilai::create([
            'email' => $email,
            'id_soal' => null,  // If not applicable, otherwise populate accordingly
            'aspek' => $aspek,
            'data_jawaban_penilai' => $validatedData['data_jawaban_penilai'],
            'nilai_akhir' => $validatedData['nilai_akhir'],
            'percobaan_ke' => null,  // Populate as needed
            'lama_waktu_pengerjaan' => null,  // Populate as needed
            'waktu_selesai' => now(),  // Set the completion time to the current time
        ]);
    }

    return redirect()->route('dataJawabanIndividu', ['email' => $email])->with('success', 'Nilai dan feedback berhasil disimpan.');
}


    public function simpanNilaiKelompok(Request $request, $id_kelompok){
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nilai_akhir' => 'required|integer',
            'data_jawaban_penilai' => 'nullable|string',
        ]);

        // Dapatkan nilai kategori dari input hidden
        $aspek = $request->input('aspek');

        // Dapatkan semua anggota kelompok berdasarkan id_kelompok
        $anggotaKelompok = User::whereHas('kelompok', function ($query) use ($id_kelompok) {
            $query->where('id_kelompok', $id_kelompok);
        })->get();

        // Simpan data untuk setiap anggota kelompok
        foreach ($anggotaKelompok as $anggota) {
            Nilai::create([
                'email' => $anggota->email,
                'id_soal' => null,
                'aspek' => $aspek,
                'data_jawaban_penilai' => $validatedData['data_jawaban_penilai'],
                'nilai_akhir' => $validatedData['nilai_akhir'],
                'percobaan_ke' => $id_kelompok,
                'lama_waktu_pengerjaan' => null,  // Isi jika ada
                'waktu_selesai' => now(),  // Set waktu selesai ke waktu saat ini
            ]);
        }

        // Redirect ke route yang menampilkan jawaban kelompok dengan pesan sukses
        return redirect()->route('dataJawabanKelompok', ['id_kelompok' => $id_kelompok])->with('success', 'Nilai dan feedback berhasil disimpan untuk seluruh anggota kelompok.');
    }

    public function simpanNilai(Request $request){
        // Validasi data yang masuk
        $request->validate([
            'email' => 'required|email',
            'nilai_akhir' => 'required|integer',
            'aspek' => 'required|string',
            'benar' => 'required|integer',
            'salah' => 'required|integer',
            'lama_waktu_pengerjaan' => 'required|integer'
        ]);

        // Menentukan pesan motivasi berdasarkan nilai
        $message = $request->nilai_akhir > 60
            ? 'Semangat dan tingkatkan lagi belajarnya!'
            : 'Jangan patah semangat, terus tingkatkan belajar lagi!';

        // Cek apakah data dengan email yang diberikan sudah ada
        $existingRecord = DB::table('nilai')->where('email', $request->email)->where('aspek', $request->aspek)->first();

        if ($existingRecord) {
            // Jika data ada, lakukan update
            DB::table('nilai')->where('email', $request->email)->update([
                'nilai_akhir' => $request->nilai_akhir,
                'data_jawaban_penilai' => $message,
                'lama_waktu_pengerjaan' => $request->lama_waktu_pengerjaan,
                'waktu_selesai' => now(),
            ]);
        } else {
            // Jika data tidak ada, lakukan create
            DB::table('nilai')->insert([
                'email' => $request->email,
                'nilai_akhir' => $request->nilai_akhir,
                'aspek' => $request->aspek,
                'data_jawaban_penilai' => $message,
                'lama_waktu_pengerjaan' => $request->lama_waktu_pengerjaan,
                'waktu_selesai' => now(),
            ]);
        }
        event(new PoinUpdated($request->email));
        // Mengarahkan ke halaman hasil evaluasi dengan parameter
        return view('latihan.selesaiEvaluasi', [
            'benar' => $request->benar,  // Ganti dengan nilai yang sebenarnya
            'salah' => $request->salah,   // Ganti dengan nilai yang sebenarnya
            'skor' => $request->nilai_akhir
        ]);
        
    }
    
    public function simpanNilaiPretest(Request $request) {
        
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
    

    public function simpanNilaiPosttest(Request $request) {
        
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'nilai_akhir' => 'required|numeric|min:0|max:100' // Sesuaikan dengan rentang nilai yang valid
        ]);
    
        $aspek = $request->aspek;
    
        // Coba untuk memperbarui nilai
        $affected = DB::table('nilai')
            ->where('email', $request->email)
            ->where('aspek', $aspek)
            ->update(['nilai_akhir' => $request->nilai_akhir]);
    
        // Jika tidak ada baris yang terpengaruh, buat record baru
        if ($affected === 0) {
            DB::table('nilai')->insert([
                'email' => $request->email,
                'nilai_akhir' => $request->nilai_akhir,
                'lama_waktu_pengerjaan' => $request->lama_waktu_pengerjaan,
                'aspek' => $aspek
            ]);
        }
    
        return redirect()->back()->with('success', 'Nilai Post-Test berhasil disimpan');
    }
    
}
