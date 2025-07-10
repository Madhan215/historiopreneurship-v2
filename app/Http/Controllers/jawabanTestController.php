<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class jawabanTestController extends Controller
{
    public function tampilkanJawabanTest($email)
    {
        $activeMenu = 'active';
        $user = User::where('email', $email)->first();

        // Mengambil Nilai Test
        $nilaiPreTestKesejarahan = DB::table('nilai')->where('email', $email)->where('aspek', 'pre_test_kesejarahan')->first();

        $nilaiPostTestKesejarahan = DB::table('nilai')->where('email', $email)->where('aspek', 'post_test_kesejarahan')->first();

        $nilaiPreTestKWU = DB::table('nilai')->where('email', $email)->where('aspek', 'pre_test_kwu')->first();

        $nilaiPostTestKWU = DB::table('nilai')->where('email', $email)->where('aspek', 'post_test_kwu')->first();

        $nilaiDNDKesejarahan = DB::table('nilai')->where('email', $email)->where('aspek', 'poin_DND_Kesejarahan')->first();

        $nilaiDNDKWU = DB::table('nilai')->where('email', $email)->where('aspek', 'poin_DND_KWU')->first();

        return view('latihan.jawabanTest', compact('email','activeMenu','user','nilaiPreTestKesejarahan','nilaiPostTestKesejarahan','nilaiPreTestKWU','nilaiPostTestKWU',
        'nilaiDNDKesejarahan',
        'nilaiDNDKWU'));

    }
}
