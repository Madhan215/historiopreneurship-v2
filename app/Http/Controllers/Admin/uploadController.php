<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\uploadDinamis;
use Illuminate\Http\Request;

class uploadController extends Controller
{
    public function toggleStatus($id)
    {
        $upload =uploadDinamis::findOrFail($id);

        // Cek status topik, jangan ubah jika topik OFF
        if ($upload->topik->status === 'off') {
            return redirect()->back()->with('error', 'Topik sedang tidak aktif. Tidak dapat mengubah statusupload.');
        }

        $upload->status = $upload->status === 'on' ? 'off' : 'on';
        $upload->save();

        return redirect()->back()->with('success', 'Statusupload berhasil diperbarui.');
    }
}
