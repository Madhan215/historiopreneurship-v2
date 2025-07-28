<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordResetsLog;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetPassword()
    {
        $users = User::with('passwordResetsLog')->get(); // Ambil semua user dengan relasi reset password
        $activeMenu = '';
        return view('admin.reset-password', compact('users', 'activeMenu'));
    }

    public function resetPassword($id)
    {
        try {
            $user = User::findOrFail($id);
            $newPassword = strval(rand(100000, 999999)); // Konversi langsung ke string

            // Update atau buat log reset password
            PasswordResetsLog::updateOrCreate(
                ['user_id' => $user->id], // Cari berdasarkan user_id
                [
                    'new_password_hash' => $newPassword,
                    'user_changed_password' => 0, // Reset ke belum diubah oleh user
                ]
            );

            // Reset password user
            $user->update(['password' => Hash::make($newPassword)]);

            Log::info("Password berhasil direset untuk user ID: {$user->id}");

            return response()->json([
                'message' => "Password berhasil direset. Password baru: $newPassword",
            ]);

        } catch (\Exception $e) {
            // Simpan error ke laravel.log
            Log::error("Gagal mereset password untuk user ID: {$id}. Error: " . $e->getMessage());

            return response()->json([
                'message' => "Terjadi kesalahan saat mereset password.",
            ], 500);
        }
    }
}
