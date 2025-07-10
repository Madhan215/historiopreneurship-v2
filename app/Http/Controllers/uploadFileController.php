<?php

namespace App\Http\Controllers;

use App\Models\uploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class uploadFileController extends Controller
{
    public function uploadFile(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:10240', // Hanya PDF, max 10MB
        ]);

        // Ambil file yang di-upload
        $file = $request->file('file');

        // Dapatkan nilai kategori dari input hidden
        $category = $request->input('category');

        // Ambil email pengguna yang sedang login
        $createdBy = Auth::user()->email;

        // Cari file yang sudah ada di database oleh pengguna ini
        $existingFile = uploadFile::where('created_by', $createdBy)
            ->where('kategori', $category)
            ->first();

        // Jika file sudah ada, hapus file lama dari storage
        if ($existingFile) {
            Storage::disk('public')->delete($existingFile->file_path);

            // Update file di database
            $existingFile->update([
                'file_path' => $file->store('uploads', 'public'),
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);

            return redirect()->back()->with('success', 'File berhasil diupload!');
        } else {
            // Simpan file baru ke database
            uploadFile::create([
                'file_path' => $file->store('uploads', 'public'),
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
                'created_by' => $createdBy,
                'kategori' => $category,
            ]);

            return redirect()->back()->with('success', 'File berhasil diupload!');
        }
    }



}
