<?php

namespace App\Http\Controllers;

use App\Models\AksesHalaman;
use Illuminate\Http\Request;

class UpdateAksesHalamanController extends Controller
{
    function update (Request $request){

        // Kode untuk update halaman
        // dd($request);
        $user = $request->user_id;
        $halaman = $request->halaman;
        $progress = $request->progress;

        AksesHalaman::updateOrCreate(
            [
                'email' => $user,
            ]
            );

        $progressSaatIni = AksesHalaman::where('email', $user)
                                        ->where($halaman, '<=', $progress)->exists();

        // dd($progressSaatIni, $progress, isset($progressSaatIni));
        if($progressSaatIni || isset($progressSaatIni)){
            $aksesHalaman = AksesHalaman::where('email', $user)
                                     ->firstOrFail();
            $aksesHalaman->$halaman = $progress;
            $aksesHalaman->save();
        }

        



        

        return redirect()->back()->with('progress', $progress);
    }

}
