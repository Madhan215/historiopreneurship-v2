<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormKelayakan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class controllerSyaratKelayakanObjekKesejarahan extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user()->email;
        
        // Validasi input
        $request->validate([
            'nomor1-1' => 'nullable|string',
            'alasan1-1' => 'nullable|string',
            'nomor1-2' => 'nullable|string',
            'alasan1-2' => 'nullable|string',
            'nomor1-3' => 'nullable|string',
            'alasan1-3' => 'nullable|string',
            'nomor1-4' => 'nullable|string',
            'alasan1-4' => 'nullable|string',
            'nomor2-1' => 'nullable|string',
            'alasan2-1' => 'nullable|string',
            'nomor2-2' => 'nullable|string',
            'alasan2-2' => 'nullable|string',
            'nomor2-3' => 'nullable|string',
            'alasan2-3' => 'nullable|string',
            'nomor3-1' => 'nullable|string',
            'alasan3-1' => 'nullable|string',
            'nomor3-2' => 'nullable|string',
            'alasan3-2' => 'nullable|string',
            'nomor3-3' => 'nullable|string',
            'alasan3-3' => 'nullable|string',
            'nomor3-4' => 'nullable|string',
            'alasan3-4' => 'nullable|string',
            'nomor4-1' => 'nullable|string',
            'alasan4-1' => 'nullable|string',
            'nomor4-2' => 'nullable|string',
            'alasan4-2' => 'nullable|string',
            'nomor4-3' => 'nullable|string',
            'alasan4-3' => 'nullable|string',
            'nomor4-4' => 'nullable|string',
            'alasan4-4' => 'nullable|string',
            'nomor4-5' => 'nullable|string',
            'alasan4-5' => 'nullable|string',
            'nomor4-6' => 'nullable|string',
            'alasan4-6' => 'nullable|string',
            'nomor4-7' => 'nullable|string',
            'alasan4-7' => 'nullable|string',
        ]);

        // Daftar aspek dan sub-aspek
        $evaluations = [
            ['aspect' => 'Daya Tarik', 'sub_aspects' => [
                ['name' => 'Memiliki keunikan atau ciri khas sejarah lokal', 'score' => $request->input('nomor1-1'), 'reason' => $request->input('alasan1-1')],
                ['name' => 'Objek sejarah memiliki lokasi yang bersih', 'score' => $request->input('nomor1-2'), 'reason' => $request->input('alasan1-2')],
                ['name' => 'Kawasan objek sejarah terjamin keamanannya', 'score' => $request->input('nomor1-3'), 'reason' => $request->input('alasan1-3')],
                ['name' => 'Keserasian bangunan objek dengan lingkungan', 'score' => $request->input('nomor1-4'), 'reason' => $request->input('alasan1-4')],
            ]],
            ['aspect' => 'Aksesbilitas', 'sub_aspects' => [
                ['name' => 'Kondisi jalan menuju objek sejarah terlampau mulus', 'score' => $request->input('nomor2-1'), 'reason' => $request->input('alasan2-1')],
                ['name' => 'Dekat dari pusat kota', 'score' => $request->input('nomor2-2'), 'reason' => $request->input('alasan2-2')],
                ['name' => 'Waktu tempuh dari pusat kota tidak terlalu lama/jauh', 'score' => $request->input('nomor2-3'), 'reason' => $request->input('alasan2-3')],
            ]],
            ['aspect' => 'Sarana dan Prasarana', 'sub_aspects' => [
                ['name' => 'Memiliki fasilitas umum seperti toilet dan tempat wudhu	', 'score' => $request->input('nomor3-1'), 'reason' => $request->input('alasan3-1')],
                ['name' => 'Memiliki gif/merchandise store di sekitar objek sejarah', 'score' => $request->input('nomor3-2'), 'reason' => $request->input('alasan3-2')],
                ['name' => 'Memiliki warung dan rumah makan di sekitar objek sejarah', 'score' => $request->input('nomor3-3'), 'reason' => $request->input('alasan3-3')],
                ['name' => 'Memiliki areal parkir yang cukup untuk wisatawan', 'score' => $request->input('nomor3-4'), 'reason' => $request->input('alasan3-4')],
            ]],
            ['aspect' => 'Partisipasi Masyarakat', 'sub_aspects' => [
                ['name' => 'Objek kesejarahan dapat mensejahterakan tuan rumah atau masyarakat sekitar', 'score' => $request->input('nomor4-1'), 'reason' => $request->input('alasan4-1')],
                ['name' => 'Masyarakat sekitar menyambut kehadiran wisatawan', 'score' => $request->input('nomor4-2'), 'reason' => $request->input('alasan4-2')],
                ['name' => 'Masyarakat menyediakan fasilitas kenyamanan wisata	', 'score' => $request->input('nomor4-3'), 'reason' => $request->input('alasan4-3')],
                ['name' => 'Masyarakat menyediakan pemandu wisata', 'score' => $request->input('nomor4-4'), 'reason' => $request->input('alasan4-4')],
                ['name' => 'Pelaku wisata berasal dari masyarak lokal', 'score' => $request->input('nomor4-5'), 'reason' => $request->input('alasan4-5')],
                ['name' => 'Terdapat penjual cindremata/oleh-oleh khas wisata setempat yang dibuat masyarakat lokal', 'score' => $request->input('nomor4-6'), 'reason' => $request->input('alasan4-6')],
                ['name' => 'Masyarakat turut serta dalam menjaga keamanan, kenyamanan, ketertiban, dan kebersihan daerah wisata', 'score' => $request->input('nomor4-7'), 'reason' => $request->input('alasan4-7')],
            ]],
        ];

        // Simpan data ke database
        foreach ($evaluations as $evaluation) {
            foreach ($evaluation['sub_aspects'] as $sub_aspect) {
                FormKelayakan::create([
                    'aspect' => $evaluation['aspect'],
                    'sub_aspect' => $sub_aspect['name'],
                    'score' => $sub_aspect['score'] ? explode('-', $sub_aspect['score'])[1] : null, // Ambil nilai setelah '-'
                    'reason' => $sub_aspect['reason'],
                    'email' =>$user
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
