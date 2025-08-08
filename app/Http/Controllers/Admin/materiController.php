<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\materiDinamis;
use Illuminate\Http\Request;

class materiController extends Controller
{
    public function toggleStatus($id)
    {
        $materi = materiDinamis::findOrFail($id);

        // Cek status topik, jangan ubah jika topik OFF
        if ($materi->topik->status === 'off') {
            return redirect()->back()->with('error', 'Topik sedang tidak aktif. Tidak dapat mengubah status materi.');
        }

        $materi->status = $materi->status === 'on' ? 'off' : 'on';
        $materi->save();

        return redirect()->back()->with('success', 'Status materi berhasil diperbarui.');
    }
}
