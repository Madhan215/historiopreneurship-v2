<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\evaluasiDinamis;
use App\Models\materiDinamis;
use App\Models\topikdinamis;
use App\Models\uploadDinamis;
use Illuminate\Http\Request;

class WebDinamisController extends Controller
{
    //function buat navbar dinamis
    public function showSubtopik($topik, $subtopik)
    {
        $user = auth()->user();

        // Ubah slug jadi nama normal
        $topikNama = str_replace('-', ' ', $topik);
        $subtopikNama = str_replace('-', ' ', $subtopik);

        // Cari topik berdasarkan nama, status, dan token kelas
        $topikData = topikdinamis::whereRaw('LOWER(nama_topik) = ?', [strtolower($topikNama)])
            ->where('status', 'on')
            ->where('token_kelas', $user->token_kelas)
            ->firstOrFail();

        // Cek di materi
        $materi = materiDinamis::whereRaw('LOWER(nama_materi) = ?', [strtolower($subtopikNama)])
            ->where('id_topik', $topikData->id_topik)
            ->where('status', 'on')
            ->first();

        // Cek di evaluasi
        $evaluasi = evaluasiDinamis::whereRaw('LOWER(nama_evaluasi) = ?', [strtolower($subtopikNama)])
            ->where('id_topik', $topikData->id_topik)
            ->where('status', 'on')
            ->first();

        // Cek di upload
        $upload = uploadDinamis::whereRaw('LOWER(nama_upload) = ?', [strtolower($subtopikNama)])
            ->where('id_topik', $topikData->id_topik)
            ->where('status', 'on')
            ->first();

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


}
