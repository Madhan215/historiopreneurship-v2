<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\uploadFile;
use Illuminate\Http\Request;
use App\Models\FormKelayakan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AnalisisIndividuKesejarahan;
use App\Models\AnalisisIndividuKesejeranhanII;
use App\Models\Analisis_individu_kewirausahaan;

class AnalisisIndividuController extends Controller
{
    
    public function tampilkanJawabanIndividu($email)
    {
        $activeMenu = 'active';
        $user = User::where('email', $email)->first();
        $jawabanIndividuII = AnalisisIndividuKesejeranhanII::where('created_by', $email)->get();
        // Mengambil jawaban dari tabel analisis_individu_kesejarahan berdasarkan aspek yang disebutkan
        $jawabanKesejarahanIndividu = AnalisisIndividuKesejarahan::where('created_by', $email)
            ->whereIn('aspek', ['wisata', 'kesejarahan', 'urgensi objek kesejarahan', 'urgensi kesejarahan'])
            ->get();
    
        // Mengambil jawaban dari tabel analisis_individu_kewirausahaan berdasarkan aspek yang disebutkan
        $jawabanKewirausahaanPariwisataIndividu = Analisis_individu_kewirausahaan::where('created_by', $email)
            ->whereIn('aspek', [
                'produk atau jasa yang akan dirancang',
                'Analisa produk atau jasa yang digunakan',
                'langkah kerja',
                // 'pendapat tentang hasil proyek yang telah dibuat',
                // 'Hal yang bisa dilakukan agar proyek menjadi lebih baik atau lebih sempurna'
            ])
            ->get();
    
        // Mengambil file yang di-upload oleh user berdasarkan email
        $fileUploads = UploadFile::where('created_by', $email)
            ->orderBy('kategori')
            ->get();

        // Ini dengan nilai
        $jawabanFormKelayakan = FormKelayakan::where('email', $email)->get();
        // dd($jawabanFormKelayakan[0]->aspect,$jawabanFormKelayakan[0]->sub_aspect,$jawabanFormKelayakan[0]->score);

        $nilaiAnalisisIndividuKWU = DB::table('nilai')->where('email', $email)->where('aspek', 'analisa_individu_kewirausahaan')->first();
        $nilaiAnalisisIndividuKesejarahan_II = DB::table('nilai')->where('email', $email)->where('aspek', 'analisa_individu_kesejarahan_II')->first();
        $nilaiAnalisisIndividuKesejarahan = DB::table('nilai')->where('email', $email)->where('aspek', 'analisa_individu_kesejarahan')->first();
        $nilaiUploadKegiatanPembelajaran3 = DB::table('nilai')->where('email', $email)->where('aspek', 'upload_file_pembelajaran3')->first();
        $nilaiUploadAktivitas1 = DB::table('nilai')->where('email', $email)->where('aspek', 'upload_file_aktivitas1')->first();
        $nilaiUploadAktivitas2 = DB::table('nilai')->where('email', $email)->where('aspek', 'upload_file_aktivitas2')->first();
        $nilaiUploadProyekIndividu = DB::table('nilai')->where('email', $email)->where('aspek', 'upload_file_proyekIndividu')->first();
        // Mengirim data ke tampilan
        return view('latihan.jawabanIndividu', compact('email',  'jawabanIndividuII','jawabanKesejarahanIndividu', 'jawabanKewirausahaanPariwisataIndividu', 'fileUploads', 'activeMenu', 'user', 'nilaiAnalisisIndividuKWU','jawabanFormKelayakan','nilaiAnalisisIndividuKesejarahan_II','nilaiAnalisisIndividuKesejarahan','nilaiUploadKegiatanPembelajaran3','nilaiUploadAktivitas1','nilaiUploadAktivitas2','nilaiUploadProyekIndividu'));
    }
    
    

    public function simpanJawabanIndividu(Request $request)
    {
        
        // Validasi input
        $request->validate([
            'objekWisata' => 'required|string',
            'objekKesejarahan' => 'required|string',
            'urgensiObjekKesejarahan' => 'required|string',
            'urgensiKesejarahan' => 'required|string',
        ]);

        // Dapatkan email user yang sedang login
        $userEmail = Auth::user()->email;

        // Daftar aspek dan jawaban yang diinput
        $aspekList = [
            'wisata' => $request->input('objekWisata'),
            'kesejarahan' => $request->input('objekKesejarahan'),
            'urgensi objek kesejarahan' => $request->input('urgensiObjekKesejarahan'),
            'urgensi kesejarahan' => $request->input('urgensiKesejarahan'),
        ];

        // Simpan atau perbarui jawaban untuk setiap aspek
        foreach ($aspekList as $aspek => $jawaban) {
            $existingJawaban = AnalisisIndividuKesejarahan::where('aspek', $aspek)
                ->where('created_by', $userEmail)
                ->first();

            if ($existingJawaban) {
                // Jika jawaban sudah ada, perbarui
                $existingJawaban->update(['jawaban' => $jawaban]);
            } else {
                // Jika jawaban belum ada, buat yang baru
                AnalisisIndividuKesejarahan::create([
                    'aspek' => $aspek,
                    'jawaban' => $jawaban,
                    'created_at' => now(),
                    'created_by' => $userEmail,
                ]);
            }
        }

        // Redirect setelah data berhasil disimpan
        return redirect()->back()->with('success', 'Jawaban berhasil disimpan.');
    }
    


    public function simpanJawabanIndividuKewirausahaan(Request $request)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'produkJasa' => 'required|string',
            'analisaProduk' => 'required|string',
            'langkahKerja' => 'required|string',
            // 'pendapatPengguna' => 'required|string',
            // 'perbaikanProyek' => 'required|string',

        ]);

        // Dapatkan email user yang sedang login
        $userEmail = Auth::user()->email;

        // Daftar aspek dan jawaban yang diinput
        $aspekList = [
            'produk atau jasa yang akan dirancang' => $request->input('produkJasa'),
            'Analisa produk atau jasa yang digunakan' => $request->input('analisaProduk'),
            'langkah kerja' => $request->input('langkahKerja'),
            // 'pendapat tentang hasil proyek yang telah dibuat' => $request->input('pendapatPengguna'),
            // 'Hal yang bisa dilakukan agar proyek menjadi lebih baik atau lebih sempurna' => $request->input('perbaikanProyek'),
        ];

        // Simpan atau perbarui jawaban untuk setiap aspek
        foreach ($aspekList as $aspek => $jawaban) {
            $existingJawaban = Analisis_individu_kewirausahaan::where('aspek', $aspek)
                ->where('created_by', $userEmail)
                ->first();

            if ($existingJawaban) {
                // Jika jawaban sudah ada, perbarui
                $existingJawaban->update(['jawaban' => $jawaban]);
            } else {
                // Jika jawaban belum ada, buat yang baru
                Analisis_individu_kewirausahaan::create([
                    'aspek' => $aspek,
                    'jawaban' => $jawaban,
                    'created_at' => now(),
                    'created_by' => $userEmail,
                ]);
            }
        }

        // Redirect setelah data berhasil disimpan
        return redirect()->back()->with('success', 'Jawaban berhasil disimpan.');
    }
    public function simpanJawaban(Request $request)
    {
        $validatedData = $request->validate([
            'objek1' => 'nullable|string',
            'objek2' => 'nullable|string',
            'objek3' => 'nullable|string',
            'objek4' => 'nullable|string',
            'objek5' => 'nullable|string',
            'objek6' => 'nullable|string',
            'objek7' => 'nullable|string',
            'objek8' => 'nullable|string',
            'objek9' => 'nullable|string',
            'objek10' => 'nullable|string',
        ]);

        $userEmail = Auth::user()->email;

        foreach ($validatedData as $key => $value) {
            if ($value) {
                if (preg_match('/^objek(\d+)$/', $key, $matches)) {
                    $no_objek = $matches[1];

                    // Check if a record exists for the specific object and created_by without id_kelompok
                    $existingJawaban = AnalisisIndividuKesejeranhanII::where('no_objek', $no_objek)
                        ->where('created_by', $userEmail)
                        ->first();

                    if ($existingJawaban) {
                        // Update if answer has changed
                        if ($existingJawaban->jawaban !== $value) {
                            $existingJawaban->update([
                                'jawaban' => $value,
                                'updated_at' => now(),
                            ]);
                        }
                    } else {
                        // Create new entry without id_kelompok
                        AnalisisIndividuKesejeranhanII::create([
                            'no_objek' => $no_objek,
                            'jawaban' => $value,
                            'created_at' => now(),
                            'created_by' => $userEmail,
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Jawaban berhasil terkirim');
    }

}
