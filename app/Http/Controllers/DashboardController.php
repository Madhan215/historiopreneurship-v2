<?php

namespace App\Http\Controllers;

use App\Models\AnalisisIndividuKesejarahan;
use App\Models\AnalisisIndividuKesejeranhanII;
use App\Models\AnalisisKelompokKewirausahaan;
use App\Models\Refleksi;
use App\Models\uploadFile;
use App\Models\User;
use App\Models\Nilai;
use App\Models\userBadge;
use App\Models\AksesHalaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $email = auth()->user()->email;

        // Data tambahan untuk dashboard
        $data['activeMenu'] = 'active';
        $data['users'] = User::where('peran', 'siswa')
            ->whereNotNull('poin')
            ->orderBy('poin', 'desc')
            ->get();
        $data['materi_a'] = AksesHalaman::where('email', $email)->value('materi_a');
        $data['materi_b'] = AksesHalaman::where('email', $email)->value('materi_b');
        $data['materi_c'] = AksesHalaman::where('email', $email)->value('materi_c');


        // ID Badge "kesejarahan"
        $badgeKesejarahanId = 2;

        // Cek status badge "kesejarahan"
        $userBadgeKesejarahan = UserBadge::where('email', $email)->where('id_badge', $badgeKesejarahanId)->first();
        $data['badgeKesejarahanClaimed'] = $userBadgeKesejarahan ? $userBadgeKesejarahan->status === 'claimed' : false;

        // Cek eligibility untuk badge "kesejarahan"
        $nilaiAspectsKesejarahan = ['pre_test_kesejarahan', 'poin_DND_kesejarahan', 'post_test_kesejarahan'];
        // Cek tabel nilai untuk aspek yang harus terpenuhi
        $nilaiFulfilled = Nilai::where('email', $email)
            ->whereIn('aspek', $nilaiAspectsKesejarahan)
            ->distinct('aspek')
            ->count() === count($nilaiAspectsKesejarahan);

        // Cek tabel analisis_individu_kesejarahanii dan analisis_individu_kesejarahan
        $analysisFulfilled = AnalisisIndividuKesejeranhanII::where('created_by', $email)->exists() &&
            AnalisisIndividuKesejarahan::where('created_by', $email)->exists();

        // Cek tabel upload_file_tugas untuk kategori 'kegiatan pembelajaran 3'
        $uploadFulfilled = uploadFile::where('created_by', $email)
            ->where('kategori', 'kegiatan pembelajaran 3')
            ->exists();

        // Cek tabel jawaban_refleksi untuk kategori 'refleksi kesejarahan'
        $reflectionFulfilled = Refleksi::where('created_by', $email)
            ->where('kategori', 'refleksi kesejarahan')
            ->exists();

        // Tentukan apakah pengguna memenuhi semua kriteria
        $data['eligibleForBadgeKesejarahan'] = $nilaiFulfilled && $analysisFulfilled && $uploadFulfilled && $reflectionFulfilled;

        // Badge Kwu
        // ID untuk badge "KWU"
        $badgeKWUId = 4;

        // Cek apakah badge KWU sudah diklaim
        $userBadgeKWU = UserBadge::where('email', $email)->where('id_badge', $badgeKWUId)->first();
        $data['badgeKwuClaimed'] = $userBadgeKWU ? $userBadgeKWU->status === 'claimed' : false;

        // Aspek nilai yang harus terpenuhi untuk badge KWU
        $nilaiAspectsKWU = ['pre_test_KWU', 'poin_DND_KWU', 'post_test_KWU'];
        $nilaiFulfilledKWU = Nilai::where('email', $email)
            ->whereIn('aspek', $nilaiAspectsKWU)
            ->distinct('aspek')
            ->count() === count($nilaiAspectsKWU);

        // Cek kondisi lain yang harus terpenuhi
        $requiredConditions = [
            'analisis_kelompok_kewirausahaan' => ['kategori' => ['aktivitas 1', 'aktivitas 2', 'aktivitas 3']],
            'upload_file_tugas' => ['kategori' => ['praktik lapangan 1', 'praktik lapangan 2', 'proyek individu']],
            'jawaban_refleksi' => ['kategori' => ['refleksi kewirausahaan', 'refleksi kepariwisataan']],
        ];

        $groupAnalysisFulfilled = AnalisisKelompokKewirausahaan::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['analisis_kelompok_kewirausahaan']['kategori'])
            ->exists();

        $uploadFulfilledKWU = uploadFile::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['upload_file_tugas']['kategori'])
            ->exists();

        $reflectionFulfilledKWU = Refleksi::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['jawaban_refleksi']['kategori'])
            ->exists();

        // Tentukan apakah pengguna memenuhi semua kriteria
        $data['eligibleForBadgeKWU'] = $nilaiFulfilledKWU && $groupAnalysisFulfilled && $uploadFulfilledKWU && $reflectionFulfilledKWU;

        // Badge Kesejarahan
        $badgeTamat = 5; // ID untuk badge "tamat"
        $userTamat = userBadge::where('email', $email)->where('id_badge', $badgeTamat)->first();
        $data['badgeTamatClaimed'] = $userTamat ? $userTamat->status === 'claimed' : false;
        $data['eligibleForTamat'] = $data['eligibleForBadgeKesejarahan'] && $data['eligibleForBadgeKWU'];

        // Badge High Rank
        $highRankBadgeId = 1; // ID untuk badge "High Rank"

        // Ambil semua pengguna yang memiliki poin lebih dari nol, urutkan berdasarkan poin dari terbesar ke terkecil
        $rankedUsers = User::whereNotNull('poin')
            ->where('poin', '>', 0) // Hanya pengguna dengan poin lebih dari nol
            ->orderBy('poin', 'desc')
            ->get();


        // Temukan pengguna saat ini berdasarkan email
        $currentUser = $rankedUsers->firstWhere('email', $email);

        // Default eligibility dan klaim badge
        $data['eligibleForHighRankBadge'] = false;
        $data['highRankBadgeClaimed'] = false;

        // Jika pengguna ditemukan di daftar ranking
        if ($currentUser) {
            // Cari peringkat pengguna
            $userRank = $rankedUsers->search(function ($user) use ($email) {
                return $user->email === $email;
            });

            // Jika peringkat ditemukan, tambahkan 1 karena peringkat dimulai dari 0
            if ($userRank !== false) {
                $userRank += 1;

                // Periksa apakah pengguna berada di peringkat 1, 2, atau 3
                $data['eligibleForHighRankBadge'] = $userRank <= 3;

                // Cek status badge High Rank
                $userBadgeHighRank = UserBadge::where('email', $email)
                    ->where('id_badge', $highRankBadgeId)
                    ->first();

                // Periksa apakah badge sudah diklaim
                $data['highRankBadgeClaimed'] = $userBadgeHighRank ? $userBadgeHighRank->status === 'claimed' : false;
            }
        }


        // Ambil lama waktu pengerjaan dari tabel nilai
        $lamaWaktuPengerjaan = Nilai::where('email', $email)
            ->whereIn('aspek', [
                'pre_test_kesejarahan',
                'post_test_kesejarahan',
                'pre_test_KWU',
                'post_test_KWU',
            ])
            ->whereNotNull('lama_waktu_pengerjaan') // Pastikan hanya mengambil data yang memiliki nilai
            ->pluck('lama_waktu_pengerjaan', 'aspek');

        // Tentukan eligibility untuk siCepat Badge
        $data['eligibleForCepat'] = $lamaWaktuPengerjaan->filter(fn($value) => $value < 900)->isNotEmpty();

        // Badge siCepat
        $siCepatBadgeId = 3; // ID untuk badge "siCepat"

        // Pastikan lamaWaktuPengerjaan tidak null dan memenuhi syarat
        if ($lamaWaktuPengerjaan->isNotEmpty() && $data['eligibleForCepat']) {
            // Cek apakah user sudah memiliki badge siCepat
            $userBadgeSiCepat = UserBadge::where('email', $email)->where('id_badge', $siCepatBadgeId)->first();
            $data['siCepatBadgeClaimed'] = $userBadgeSiCepat && $userBadgeSiCepat->status === 'claimed';
        } else {
            $data['siCepatBadgeClaimed'] = false;
        }

        // Aspek untuk nilai aspek
        $nilaiAspek = [
            'pre_test_kesejarahan',
            'poin_DND_kesejarahan',
            'post_test_kesejarahan',
            'pre_test_KWU',
            'poin_DND_KWU',
            'post_test_KWU',
        ];

        // Ambil badge yang diklaim
        $claimedBadges = userBadge::where('email', $email)
            ->join('badge', 'user_badge.id_badge', '=', 'badge.id')
            ->select('badge.link_gambar', 'badge.deskripsi')
            ->get();

        // Aspek untuk nilai kesejarahan
        $nilaiHistoricalAspects = [
            'pre_test_kesejarahan',
            'poin_DND_kesejarahan',
            'post_test_kesejarahan',
        ];

        // Aspek untuk nilai kewirausahaan
        $nilaiEntrepreneurialAspects = [
            'pre_test_KWU',
            'poin_DND_KWU',
            'post_test_KWU',
        ];
        
        //leaderboard

        // Buat query untuk leaderboard

        $data['leaderboard'] = DB::table('users')
            ->join('nilai', 'users.email', '=', 'nilai.email')
            ->select(
                'users.email',
                'users.nama_lengkap',
                DB::raw('SUM(CASE WHEN nilai.aspek IN ("' . implode('", "', $nilaiAspek) . '") THEN nilai.nilai_akhir ELSE 0 END) as poin')
            )
            ->where('users.peran', 'siswa') // Hanya ambil siswa
            ->groupBy('users.email', 'users.nama_lengkap') // Mengelompokkan berdasarkan email dan nama_lengkap
            ->orderBy('poin', 'desc') // Urutkan berdasarkan total poin
            ->limit(10) // Ambil 10 besar
            ->get();


        // Buat query untuk leaderboard
        $data['perolehanNilai'] = DB::table('users')
            ->join('nilai', 'users.email', '=', 'nilai.email')
            ->select(
                'users.email',
                'users.nama_lengkap',
                DB::raw('SUM(CASE WHEN nilai.aspek IN ("' . implode('", "', $nilaiAspek) . '") THEN nilai.nilai_akhir ELSE 0 END) as poin')
            )
            ->where('users.peran', 'siswa') // Hanya ambil siswa
            ->where('users.email', $email) // Filter berdasarkan email
            ->groupBy('users.email', 'users.nama_lengkap') // Mengelompokkan berdasarkan email dan nama_lengkap
            ->orderBy('poin', 'desc') // Urutkan berdasarkan total poin
            ->first(); // Mengambil hanya satu hasil


        //dd($data['leaderboard']);
        $data['claimedBadges'] = $claimedBadges;
        return view('dashboard', $data);
    }



    public function showUser()
    {
        $data['users'] = User::all();
        return view('dashboard_admin', $data);
    }
}
