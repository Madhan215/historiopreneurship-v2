<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\evaluasiDinamis;
use Illuminate\Http\Request;

class evaluasiController extends Controller
{
    public function toggleStatus($id)
    {
        $evaluasi = evaluasiDinamis::findOrFail($id);

        // Cek status topik, jangan ubah jika topik OFF
        if ($evaluasi->topik->status === 'off') {
            return redirect()->back()->with('error', 'Topik sedang tidak aktif. Tidak dapat mengubah status evaluasi.');
        }

        $evaluasi->status = $evaluasi->status === 'on' ? 'off' : 'on';
        $evaluasi->save();

        return redirect()->back()->with('success', 'Status evaluasi berhasil diperbarui.');
    }
}
