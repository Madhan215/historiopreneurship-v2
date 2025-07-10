<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Refleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefleksiController extends Controller
{
    public function simpanRefleksi(Request $request)
    {
        // dd($request);
        
        // Validasi input
        $request->validate([
            'respon' => 'required|string',
            'kategori' => 'required|string',
            'sudah_dipelajari' => 'nullable|string',
            'dikuasai' => 'nullable|string',
            'belum_dikuasai' => 'nullable|string',
            'upaya_menguasai' => 'nullable|string',
        ]);



        // Dapatkan email pengguna yang sedang login
        $userEmail = Auth::user()->email;

        // Array aspek refleksi dengan nilai dari input
        $aspekRefleksi = [
            'sudah dipelajari' => $request->input('sudah_dipelajari'),
            'dikuasai' => $request->input('dikuasai'),
            'belum dikuasai' => $request->input('belum_dikuasai'),
            'upaya untuk menguasai' => $request->input('upaya_menguasai'),
        ];

        // Dapatkan kategori dari input
        $kategori = $request->input('kategori');

        // Proses setiap aspek refleksi
        foreach ($aspekRefleksi as $aspek => $jawaban) {
            // Proses hanya jika ada jawaban yang terisi
            if (!empty($jawaban)) {
                $existingRecord = Refleksi::where('created_by', $userEmail)
                    ->where('aspek', $aspek)
                    ->where('kategori', $kategori)
                    ->first();

                if ($existingRecord) {
                    // Jika data sudah ada, update
                    $existingRecord->update([
                        'jawaban' => $jawaban,
                        'respon' => $request->input('respon'),
                        'created_at' => now(),
                    ]);
                } else {
                    // Jika data belum ada, buat baru
                    Refleksi::create([
                        'created_by' => $userEmail,
                        'aspek' => $aspek,
                        'kategori' => $kategori,
                        'jawaban' => $jawaban,
                        'respon' => $request->input('respon'),
                        'created_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Jawaban refleksi telah disimpan.');

    }

    public function tampilkanJawabanRefleksi($email)
    {
        $activeMenu = 'active';
        $user = User::where('email', $email)->first();

        $refleksiKesejarahan = Refleksi::where('created_by', $email)->where('kategori', 'refleksi kesejarahan')->get();
        $refleksiKewirausahaan = Refleksi::where('created_by', $email)->where('kategori', 'refleksi kewirausahaan')->get();
        $refleksiKepariwisataan = Refleksi::where('created_by', $email)->where('kategori', 'refleksi kepariwisataan')->get();
        // dd($refleksiKesejarahan, $refleksiKewirausahaan, $refleksiKepariwisataan);

        // dd($refleksiKesejarahan[0]->respon);




    

        // Mengirim data ke tampilan
        return view('latihan.jawabanRefleksi', compact('activeMenu', 'user', 'refleksiKesejarahan', 'refleksiKewirausahaan', 'refleksiKepariwisataan'
    
    ));
    }
}
