<?php

namespace App\Listeners;

use App\Events\PoinUpdated;
use Illuminate\Support\Facades\DB;

class HitungPoinListener
{
    public function handle(PoinUpdated $event)
    {
        $email = $event->email;

        // 🔹 Pastikan user ada
        $user = DB::table('users')->where('email', $email)->first();
        if (!$user)
            return;

        // 🔹 Ambil data token_kelas (JSON ke array)
        $tokenData = json_decode($user->token_kelas, true);
        if (!$tokenData || !is_array($tokenData))
            return;

        // 🔹 Temukan kelas yang statusnya aktif
        $kelasAktif = collect($tokenData)->firstWhere('status', 'aktif');
        if (!$kelasAktif)
            return;

        $kodeAktif = $kelasAktif['kode'];

        // 🔹 Ambil semua nilai berdasarkan email saja
        $nilaiUser = DB::table('nilai')
            ->where('email', $email)
            ->pluck('nilai_akhir');

        // 🔹 Hitung total poin
        $totalPoin = $nilaiUser->sum();

        // 🔹 Ambil poin lama jika sudah ada
        $poinLama = json_decode($user->poin, true) ?: [];

        // 🔹 Update hanya kelas aktif
        $poinData = collect($tokenData)->map(function ($item) use ($kodeAktif, $totalPoin, $poinLama) {
            $kode = $item['kode'];

            // ambil poin sebelumnya jika sudah ada
            $poinSebelumnya = collect($poinLama)->firstWhere('kode', $kode)['poin'] ?? 0;

            return [
                'kode' => $kode,
                'poin' => $kode === $kodeAktif ? $totalPoin : $poinSebelumnya,
            ];
        })->values()->toArray();

        // 🔹 Simpan kembali ke tabel users
        DB::table('users')
            ->where('email', $email)
            ->update(['poin' => json_encode($poinData)]);
    }
}
