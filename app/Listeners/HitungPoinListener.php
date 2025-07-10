<?php

namespace App\Listeners;

use App\Events\PoinUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class HitungPoinListener
{
    public function handle(PoinUpdated $event)
    {
        $email = $event->email;

        // Ambil data nilai berdasarkan email dari tabel 'nilai'
        $nilai_pretest_kesejarahan = DB::table('nilai')->where('email', $email)->where('aspek', 'pre_test_kesejarahan')->first();
        $nilai_posttest_kesejarahan = DB::table('nilai')->where('email', $email)->where('aspek', 'post_test_kesejarahan')->first();
        $nilai_dnd_kesejarahan = DB::table('nilai')->where('email', $email)->where('aspek', 'poin_DND_kesejarahan')->first();
        $nilai_pretest_kwu = DB::table('nilai')->where('email', $email)->where('aspek', 'pre_test_KWU')->first();
        $nilai_posttest_kwu = DB::table('nilai')->where('email', $email)->where('aspek', 'post_test_KWU')->first();
        $nilai_dnd_kwu = DB::table('nilai')->where('email', $email)->where('aspek', 'poin_DND_KWU')->first();

        // Jika data tidak ada, set nilai default 0
        $pretest_kesejarahan = $nilai_pretest_kesejarahan->nilai_akhir ?? 0;
        $posttest_kesejarahan = $nilai_posttest_kesejarahan->nilai_akhir ?? 0;
        $dnd_kesejarahan = $nilai_dnd_kesejarahan->nilai_akhiir??0;
        $pretest_kwu = $nilai_pretest_kwu->nilai_akhir ?? 0;
        $posttest_kwu = $nilai_posttest_kwu->nilai_akhir ?? 0;
        $dnd_kwu = $nilai_dnd_kwu->nilai_akhir ?? 0;

        // Hitung aspek yang tersedia
        $aspek_tersedia = 0;
        if ($pretest_kesejarahan > 0)
            $aspek_tersedia++;
        if ($posttest_kesejarahan > 0)
            $aspek_tersedia++;
        if ($dnd_kesejarahan > 0)
            $aspek_tersedia++;
        if ($pretest_kwu > 0)
            $aspek_tersedia++;
        if ($posttest_kwu > 0)
            $aspek_tersedia++;
        if ($dnd_kwu > 0)
            $aspek_tersedia++;

        // Jika ada aspek yang tersedia, hitung rata-rata poin
        $total_poin = $aspek_tersedia > 0
            ? ($pretest_kesejarahan + $posttest_kesejarahan + $pretest_kwu + $posttest_kwu + $dnd_kwu + $dnd_kesejarahan) 
            : 0;

        // Update nilai poin di tabel 'users' hanya jika peran adalah 'siswa'
        $user = DB::table('users')->where('email', $email)->first();
        if ($user && $user->peran === 'siswa') {
            DB::table('users')->where('email', $email)->update(['poin' => $total_poin]);
        }
    }
}
