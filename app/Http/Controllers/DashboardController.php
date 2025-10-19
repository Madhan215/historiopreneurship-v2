<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\evaluasiDinamis;
use App\Models\topikdinamis;
use App\Models\uploadDinamis;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Refleksi;
use App\Models\userBadge;
use App\Models\uploadFile;
use App\Models\AksesHalaman;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\AnalisisIndividuKesejarahan;
use App\Models\AnalisisKelompokKewirausahaan;
use App\Models\AnalisisIndividuKesejeranhanII;

class DashboardController extends Controller
{
    public function index()
    {
        $email = auth()->user()->email;
        // ambil kelas aktif user
        $tokens = auth()->user()->token_kelas ?? [];
        $activeKode = collect($tokens)->firstWhere('status', 'aktif')['kode'] ?? null;

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

        $data = [
            'badgeTamatClaimed' => false,
            'eligibleForTamat' => false,
        ];

        if ($activeKode) {
            // 🔹 Ambil id_topik dari topik dinamis yang aktif dan status = 'on'
            $topikIds = topikdinamis::where('token_kelas', $activeKode)
                ->where('status', 'on')
                ->pluck('id_topik');

            if ($topikIds->isNotEmpty()) {
                // 🔹 Ambil semua nama evaluasi & upload dari topik yang statusnya 'on'
                $evaluasiAspek = evaluasiDinamis::whereIn('id_topik', $topikIds)
                    ->where('status', 'on')
                    ->pluck('nama_evaluasi')
                    ->toArray();

                $uploadAspek = uploadDinamis::whereIn('id_topik', $topikIds)
                    ->where('status', 'on')
                    ->pluck('nama_upload')
                    ->toArray();

                // 🔹 Gabungkan aspek wajib
                $requiredAspects = array_merge($evaluasiAspek, $uploadAspek);

           

                if (!empty($requiredAspects)) {
                    // 🔹 Ambil aspek yang sudah memiliki nilai
                    $completedAspects = Nilai::where('email', $email)
                        ->whereIn('aspek', $requiredAspects)
                        ->whereNotNull('nilai_akhir')
                        ->pluck('aspek')
                        ->toArray();

                    // 🔹 Cek apakah semua aspek sudah terpenuhi
                    $allFulfilled = count(array_intersect($requiredAspects, $completedAspects)) === count($requiredAspects);

                    // 🔹 Simpan ke data dashboard
                    $data['eligibleForTamat'] = $allFulfilled;
                }
            }
        }

        // 🔹 Cek apakah badge tamat sudah diklaim
        $badgeTamat = 5; // ID badge tamat
        $userTamat = userBadge::where('email', $email)
            ->where('id_badge', $badgeTamat)
            ->first();

        if ($userTamat) {
            // Jika status disimpan sebagai JSON
            $statusDecoded = json_decode($userTamat->status, true);
            if (is_array($statusDecoded)) {
                $data['badgeTamatClaimed'] = collect($statusDecoded)->contains(fn($s) => $s['status'] === 'claimed');
            } else {
                // Jika masih string biasa
                $data['badgeTamatClaimed'] = $userTamat->status === 'claimed';
            }
        }


        // Badge High Rank
        $highRankBadgeId = 1; // ID untuk badge "High Rank"

        $rankedUsers = DB::table('users')
            ->select(
                'email',
                'nama_lengkap',
                DB::raw("
            CAST(
                JSON_UNQUOTE(
                    JSON_EXTRACT(
                        poin,
                        REPLACE(
                            JSON_UNQUOTE(JSON_SEARCH(poin, 'one', '$activeKode', NULL, '$[*].kode')),
                            '.kode',
                            '.poin'
                        )
                    )
                ) AS UNSIGNED
            ) as nilai_poin
        ")
            )
            ->where('peran', 'siswa')
            ->having('nilai_poin', '>', 0) // hanya ambil user dengan poin > 0
            ->orderByDesc('nilai_poin')
            ->get();



        // Temukan pengguna saat ini berdasarkan email
        $currentUser = $rankedUsers->firstWhere('email', $email);

        // Jika pengguna ditemukan di daftar ranking
        if ($currentUser) {
            // Cari peringkat pengguna
            $userRank = $rankedUsers->search(fn($user) => $user->email === $email);

            if ($userRank !== false) {
                $userRank += 1;

                // Periksa apakah pengguna berada di peringkat 1, 2, atau 3
                $data['eligibleForHighRankBadge'] = $userRank <= 3;

                // Cek apakah user sudah klaim badge High Rank untuk kelas aktif
                $userBadgeHighRank = UserBadge::where('email', $email)
                    ->where('id_badge', $highRankBadgeId)
                    ->whereRaw("JSON_CONTAINS(status, JSON_OBJECT('status', 'claimed'))")
                    ->whereRaw("JSON_CONTAINS(status, JSON_OBJECT('kelas', ?))", [$activeKode])
                    ->exists();

                // Tandai jika sudah diklaim
                $data['highRankBadgeClaimed'] = $userBadgeHighRank;
            }
        }
        $data['eligibleForCepat'] = false;
        $data['siCepatBadgeClaimed'] = false;

        if ($activeKode) {
            // 🔹 Ambil semua topik berdasarkan token kelas aktif
            $topikIds = topikdinamis::where('token_kelas', $activeKode)->pluck('id_topik');

            if ($topikIds->isNotEmpty()) {
                // 🔹 Ambil nama evaluasi dari topik-topik tersebut
                $requiredAspects = evaluasiDinamis::whereIn('id_topik', $topikIds)
                    ->pluck('nama_evaluasi')
                    ->toArray();

                if (!empty($requiredAspects)) {
                    // 🔹 Ambil lama waktu pengerjaan berdasarkan aspek-aspek di atas
                    $lamaWaktuPengerjaan = Nilai::where('email', $email)
                        ->whereIn('aspek', $requiredAspects)
                        ->whereNotNull('lama_waktu_pengerjaan')
                        ->pluck('lama_waktu_pengerjaan', 'aspek');

                    // 🔹 Tentukan eligibility
                    $data['eligibleForCepat'] = $lamaWaktuPengerjaan
                        ->filter(fn($value) => $value < 900)
                        ->isNotEmpty();

                    // 🔹 Ambil badge siCepat
                    $siCepatBadgeId = 3;
                    $badgeSiCepat = Badge::find($siCepatBadgeId);

                    if ($badgeSiCepat && $lamaWaktuPengerjaan->isNotEmpty() && $data['eligibleForCepat']) {
                        // 🔹 Cek apakah user sudah punya badge di kelas aktif
                        $userBadgeSiCepat = UserBadge::where('email', $email)
                            ->where('id_badge', $siCepatBadgeId)
                            ->first();

                        if ($userBadgeSiCepat) {
                            // Decode status JSON
                            $statusData = json_decode($userBadgeSiCepat->status, true) ?? [];

                            // Cek apakah sudah diklaim di kelas ini
                            $alreadyClaimedInClass = collect($statusData)
                                ->contains(fn($item) => ($item['kelas'] ?? null) === $activeKode && $item['status'] === 'claimed');

                            $data['siCepatBadgeClaimed'] = $alreadyClaimedInClass;
                        }
                    }
                }
            }
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

        // Ambil badge yang diklaim sesuai kelas aktif
        $claimedBadges = userBadge::where('email', $email)
            ->join('badge', 'user_badge.id_badge', '=', 'badge.id')
            ->whereRaw("JSON_CONTAINS(status, JSON_OBJECT('status', 'claimed'))")
            ->whereRaw("JSON_CONTAINS(status, JSON_OBJECT('kelas', ?))", [$activeKode])
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

        // // Buat query untuk leaderboard

        // $data['leaderboard'] = DB::table('users')
        //     ->join('nilai', 'users.email', '=', 'nilai.email')
        //     ->select(
        //         'users.email',
        //         'users.nama_lengkap',
        //         DB::raw('SUM(CASE WHEN nilai.aspek IN ("' . implode('", "', $nilaiAspek) . '") THEN nilai.nilai_akhir ELSE 0 END) as poin')
        //     )
        //     ->where('users.peran', 'siswa') // Hanya ambil siswa
        //     ->groupBy('users.email', 'users.nama_lengkap') // Mengelompokkan berdasarkan email dan nama_lengkap
        //     ->orderBy('poin', 'desc') // Urutkan berdasarkan total poin
        //     ->limit(10) // Ambil 10 besar
        //     ->get();

        // Leaderboard 



        $data['perolehanNilai'] = DB::table('users')
            ->select(
                'email',
                'nama_lengkap',
                DB::raw("
            JSON_UNQUOTE(
                JSON_EXTRACT(
                    poin,
                    REPLACE(
                        JSON_UNQUOTE(JSON_SEARCH(poin, 'one', ?, NULL, '$[*].kode')),
                        '.kode',
                        '.poin'
                    )
                )
            ) as nilai_poin
        ")
            )
            ->where('peran', 'siswa')
            ->where('email', $email)
            ->addBinding($activeKode, 'select')
            ->first();



        //dd($data['leaderboard']);
        $data['claimedBadges'] = $claimedBadges;
        // @dd($data['claimedBadges']);
        $data['jumlahGuru'] = User::where('peran', 'guru')->count();
        $data['jumlahSiswa'] = User::where('peran', 'siswa')->count();



        if ($activeKode) {
            // Subquery poin per siswa untuk kelas aktif
            $poinSub = DB::table('users')
                ->select(
                    'email',
                    DB::raw("
                JSON_UNQUOTE(
                    JSON_EXTRACT(
                        poin,
                        REPLACE(
                            JSON_UNQUOTE(JSON_SEARCH(poin, 'one', '$activeKode', NULL, '$[*].kode')),
                            '.kode',
                            '.poin'
                        )
                    )
                ) AS nilai_poin
            ")
                )
                ->where('peran', 'siswa');

            $badgeSub = DB::table('user_badge')
                ->join('badge', 'user_badge.id_badge', '=', 'badge.id')
                ->select(
                    'user_badge.email',
                    DB::raw('GROUP_CONCAT(DISTINCT badge.link_gambar) as badges')
                )
                ->whereRaw("JSON_CONTAINS(user_badge.status, JSON_OBJECT('status', 'claimed'))")
                ->whereRaw("JSON_CONTAINS(user_badge.status, JSON_OBJECT('kelas', ?))", [$activeKode])
                ->groupBy('user_badge.email');

            $data['leaderboard'] = DB::table('users')
                ->leftJoinSub($poinSub, 'poinSub', fn($join) => $join->on('users.email', '=', 'poinSub.email'))
                ->leftJoinSub($badgeSub, 'badgeSub', fn($join) => $join->on('users.email', '=', 'badgeSub.email'))
                ->select(
                    'users.email',
                    'users.nama_lengkap',
                    DB::raw('CAST(COALESCE(poinSub.nilai_poin, 0) AS UNSIGNED) as poin'),
                    'badgeSub.badges'
                )
                ->where('users.peran', 'siswa')
                ->whereJsonContains('users.token_kelas', [['kode' => $activeKode]])
                ->orderByDesc('poin')
                ->limit(10)
                ->get();

            // @dd($data['leaderboard']);
        } else {
            $data['leaderboard'] = collect();
        }
        // @dd($data['leaderboard']);

        return view('dashboard', $data);
    }



    public function showUser()
    {
        $data['users'] = User::all();
        return view('dashboard_admin', $data);
    }

    public function dashboardGuru()
    {
        // Ambil ID Guru
        $idGuru = auth()->user()->id;

        // Ambil jumlah kelas berdasarkan kelas yang dibuat oleh guru
        $jumlahKelasDiampu = count(Kelas::where('created_by', $idGuru)->get());

        // Ambil kode kelas yang diampu guru, lalu masukkan kedalam list
        $kelasGuru = Kelas::where('created_by', $idGuru)->pluck('kode_kelas');

        $users = User::where('peran', 'siswa')->pluck('token_kelas');

        // Hitung jumlah siswa
        $jumlahSiswa = 0;

        foreach ($users as $token) {

            $token = $token ?? []; // kalau null jadi array kosong

            if (is_array($token)) {
                foreach ($token as $t) {
                    if (isset($t['kode']) && in_array($t['kode'], $kelasGuru->toArray())) {
                        $jumlahSiswa++;
                    }
                }
            }
        }

        // dd($jumlahSiswa);

        return view('dashboard_guru', compact('jumlahKelasDiampu', 'jumlahSiswa'));



    }
}
