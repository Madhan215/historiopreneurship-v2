<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PasswordResetsLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $user = Auth::user();
        $user->nama_lengkap = $request->name;
        $user->save();

        return redirect()->route('beranda')->with('success', 'Nama anda berhasil diperbarui');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Password baru harus diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);

        $user = Auth::user(); // Ambil user yang sedang login

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan!');
        }

        // Update password di tabel users 
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Update log reset password (Ini perubahannya akan terlihat jika admin sudah merubahkan, maka saat user changed passwordnya akan ketahuan dari data admin)
        PasswordResetsLog::where('user_id', $user->id)->update([
            'user_changed_password' => true,
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Password anda berhasil diperbarui, Silakan login kembali');
    }
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'cropped_image' => 'required'
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->profile_photo) {
            Storage::delete('public/' . $user->profile_photo);
        }

        // Konversi base64 ke file
        $imageData = $request->cropped_image;
        $image = str_replace('data:image/jpeg;base64,', '', $imageData);
        $image = str_replace(' ', '+', $image);
        $imageName = 'avatars/' . uniqid() . '.jpg';

        // Simpan ke storage
        Storage::disk('public')->put($imageName, base64_decode($image));

        // Simpan ke database
        $user->update(['profile_photo' => $imageName]);

        return redirect()->route('beranda')->with('success', 'Foto profil berhasil diperbarui');
    }
}
