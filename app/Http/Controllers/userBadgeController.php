<?php

namespace App\Http\Controllers;

use App\Models\Analisis_individu_kewirausahaan;
use App\Models\AnalisisIndividuKesejarahan;
use App\Models\AnalisisIndividuKesejeranhanII;
use App\Models\AnalisisKelompokKewirausahaan;
use App\Models\Badge;
use App\Models\evaluasiDinamis;
use App\Models\Nilai;
use App\Models\Refleksi;
use App\Models\topikdinamis;
use App\Models\uploadFile;
use App\Models\User;
use App\Models\userBadge;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userBadgeController extends Controller
{
    public function awardHistoricalBadge(Request $request)
    {
        $email = Auth::user()->email;

        // Aspek yang harus dipenuhi dari tabel nilai
        $nilaiAspects = [
            'pre_test_kesejarahan',
            'poin_DND_kesejarahan', // Kuis kesejarahan
            'post_test_kesejarahan',
        ];

        // Aspek lainnya yang dicocokkan dengan tabel terkait
        $requiredConditions = [
            'analisis_individu_kesejarahanii', // Cocokkan email pada kolom `created_by`
            'analisis_individu_kesejarahan',  // Cocokkan email pada kolom `created_by`
            'upload_file_tugas' => [
                'kategori' => 'kegiatan pembelajaran 3' // Cocokkan kategori
            ],
            'jawaban_refleksi' => [
                'kategori' => 'refleksi kesejarahan' // Cocokkan kategori
            ]
        ];

        // Cek tabel nilai untuk aspek yang harus terpenuhi
        $nilaiFulfilled = Nilai::where('email', $email)
            ->whereIn('aspek', $nilaiAspects)
            ->distinct('aspek')
            ->count() === count($nilaiAspects);

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

        // Tentukan apakah semua aspek terpenuhi
        $allConditionsFulfilled = $nilaiFulfilled && $analysisFulfilled && $uploadFulfilled && $reflectionFulfilled;

        if ($allConditionsFulfilled) {
            $badge = Badge::find(2); // Asumsikan badge dengan ID 1 adalah badge yang diinginkan

            if ($badge) {
                UserBadge::updateOrCreate(
                    ['email' => $email, 'id_badge' => $badge->id],
                    ['email' => $email, 'id_badge' => $badge->id, 'status' => 'claimed'] // Status klaim diatur ke 'claimed'
                );
                return redirect()->route('dashboard')->with('success', 'Historical Badge successfully claimed!');
            }
        }


        // Jika tidak memenuhi syarat, beri tahu pengguna
        return redirect()->route('dashboard')->with('error', 'You do not meet the criteria for the Historical Badge.');
    }


    public function awardEntrepreneurialBadge(Request $request)
    {
        $email = Auth::user()->email;

        // Aspek yang harus dipenuhi dari tabel nilai
        $nilaiAspects = [
            'pre_test_KWU',        // Pre-test kewirausahaan
            'poin_DND_KWU',        // Kuis kewirausahaan
            'post_test_KWU',       // Post-test kewirausahaan
        ];

        // Kategori lain yang dicocokkan dengan tabel terkait (tanpa analisis individu)
        $requiredConditions = [
            'analisis_kelompok_kewirausahaan' => ['kategori' => ['aktivitas 1', 'aktivitas 2', 'aktivitas 3']],
            'upload_file_tugas' => ['kategori' => ['praktik lapangan 1', 'praktik lapangan 2', 'proyek individu']],
            'jawaban_refleksi' => ['kategori' => ['refleksi kewirausahaan', 'refleksi kepariwisataan']],
        ];

        // Cek tabel nilai untuk aspek yang harus terpenuhi
        $nilaiFulfilled = Nilai::where('email', $email)
            ->whereIn('aspek', $nilaiAspects)
            ->distinct('aspek')
            ->count() === count($nilaiAspects);

        // Cek tabel analisis_individu_kewirausahaan (hanya mencocokkan email)
        $individuAnalysisFulfilled = Analisis_individu_kewirausahaan::where('created_by', $email)->exists();

        // Cek tabel analisis_kelompok_kewirausahaan
        $groupAnalysisFulfilled = AnalisisKelompokKewirausahaan::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['analisis_kelompok_kewirausahaan']['kategori'])
            ->exists();

        // Cek tabel upload_file_tugas
        $uploadFulfilled = uploadFile::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['upload_file_tugas']['kategori'])
            ->exists();

        // Cek tabel jawaban_refleksi
        $reflectionFulfilled = Refleksi::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['jawaban_refleksi']['kategori'])
            ->exists();

        // Tentukan apakah semua kriteria terpenuhi
        $allConditionsFulfilled = $nilaiFulfilled && $individuAnalysisFulfilled && $groupAnalysisFulfilled && $uploadFulfilled && $reflectionFulfilled;

        if ($allConditionsFulfilled) {
            $badge = Badge::find(4); // Asumsikan badge dengan ID 2 adalah badge yang diinginkan

            if ($badge) {
                UserBadge::updateOrCreate(
                    ['email' => $email, 'id_badge' => $badge->id],
                    ['email' => $email, 'id_badge' => $badge->id, 'status' => 'claimed'] // Status klaim diatur ke 'claimed'
                );
                return redirect()->route('dashboard')->with('success', 'Entrepreneurial Badge successfully claimed!');
            }
        }

        // Jika tidak memenuhi syarat, beri tahu pengguna
        return redirect()->route('dashboard')->with('error', 'You do not meet the criteria for the Entrepreneurial Badge.');
    }

    public function awardCombinedBadge(Request $request)
    {
        $email = Auth::user()->email;

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

        // Kategori terkait untuk kondisi tambahan
        $requiredConditions = [
            'analisis_individu_kesejarahanii',
            'analisis_individu_kesejarahan',
            'analisis_kelompok_kewirausahaan' => ['kategori' => ['aktivitas 1', 'aktivitas 2', 'aktivitas 3']],
            'upload_file_tugas' => ['kategori' => ['kegiatan pembelajaran 3', 'praktik lapangan 1', 'praktik lapangan 2', 'proyek individu']],
            'jawaban_refleksi' => ['kategori' => ['refleksi kesejarahan', 'refleksi kewirausahaan', 'refleksi kepariwisataan']],
        ];

        // Cek tabel nilai untuk kesejarahan
        $nilaiHistoricalFulfilled = Nilai::where('email', $email)
            ->whereIn('aspek', $nilaiHistoricalAspects)
            ->distinct('aspek')
            ->count() === count($nilaiHistoricalAspects);

        // Cek tabel nilai untuk kewirausahaan
        $nilaiEntrepreneurialFulfilled = Nilai::where('email', $email)
            ->whereIn('aspek', $nilaiEntrepreneurialAspects)
            ->distinct('aspek')
            ->count() === count($nilaiEntrepreneurialAspects);

        // Cek analisis individu kesejarahan
        $historicalAnalysisFulfilled = AnalisisIndividuKesejeranhanII::where('created_by', $email)->exists() &&
            AnalisisIndividuKesejarahan::where('created_by', $email)->exists();

        // Cek analisis kelompok kewirausahaan
        $entrepreneurialGroupAnalysisFulfilled = AnalisisKelompokKewirausahaan::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['analisis_kelompok_kewirausahaan']['kategori'])
            ->exists();

        // Cek upload file tugas
        $uploadFulfilled = uploadFile::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['upload_file_tugas']['kategori'])
            ->exists();

        // Cek jawaban refleksi
        $reflectionFulfilled = Refleksi::where('created_by', $email)
            ->whereIn('kategori', $requiredConditions['jawaban_refleksi']['kategori'])
            ->exists();

        // Tentukan apakah semua kriteria terpenuhi
        $allConditionsFulfilled = $nilaiHistoricalFulfilled
            && $nilaiEntrepreneurialFulfilled
            && $historicalAnalysisFulfilled
            && $entrepreneurialGroupAnalysisFulfilled
            && $uploadFulfilled
            && $reflectionFulfilled;

        if ($allConditionsFulfilled) {
            $badge = Badge::find(5); // Asumsikan badge gabungan memiliki ID 5

            if ($badge) {
                UserBadge::updateOrCreate(
                    ['email' => $email, 'id_badge' => $badge->id],
                    ['email' => $email, 'id_badge' => $badge->id, 'status' => 'claimed'] // Status klaim diatur ke 'claimed'
                );
                return redirect()->route('dashboard')->with('success', 'Combined Badge successfully claimed!');
            }
        }

        // Jika tidak memenuhi syarat, beri tahu pengguna
        return redirect()->route('dashboard')->with('error', 'You do not meet the criteria for the Combined Badge.');
    }


    public function awardHighRankBadge(Request $request)
    {
        $email = Auth::user()->email;
        $tokens = auth()->user()->token_kelas ?? [];
        $activeKode = collect($tokens)->firstWhere('status', 'aktif')['kode'] ?? null;

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
            ->having('nilai_poin', '>', 0)
            ->orderByDesc('nilai_poin')
            ->get();

        $currentUser = $rankedUsers->firstWhere('email', $email);

        if (!$currentUser) {
            return redirect()->route('dashboard')->with('error', 'You do not meet the criteria for the High Rank Badge.');
        }

        $userRank = $rankedUsers->search(fn($user) => $user->email === $email);

        if ($userRank !== false) {
            $userRank += 1;
            $badgeId = 1; // High Rank Badge

            if ($userRank <= 3) {
                $badge = Badge::find($badgeId);

                if ($badge) {
                    // bentuk JSON array untuk status
                    $statusData = [
                        [
                            'status' => 'claimed',
                            'kelas' => $activeKode,
                        ]
                    ];

                    userBadge::updateOrCreate(
                        ['email' => $email, 'id_badge' => $badge->id],
                        [
                            'email' => $email,
                            'id_badge' => $badge->id,
                            'status' => json_encode($statusData),
                        ]
                    );

                    return redirect()->route('dashboard')->with('success', 'Badge High Rank successfully claimed!');
                }
            }
        }

        return redirect()->route('dashboard')->with('error', 'You do not meet the criteria for the High Rank Badge.');
    }



    public function awardSiCepatBadge(Request $request)
    {
        $email = Auth::user()->email;
        $tokens = auth()->user()->token_kelas ?? [];
        $activeKode = collect($tokens)->firstWhere('status', 'aktif')['kode'] ?? null;

        // Pastikan user punya token kelas aktif
        if (!$activeKode) {
            return redirect()->route('dashboard')->with('error', 'No active class token found.');
        }

        // 🔹 Ambil semua topik berdasarkan token kelas aktif
        $topikIds = topikdinamis::where('token_kelas', $activeKode)->pluck('id_topik');

        if ($topikIds->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'No topics found for your active class token.');
        }

        // 🔹 Ambil nama evaluasi dari topik-topik tersebut
        $requiredAspects = evaluasiDinamis::whereIn('id_topik', $topikIds)
            ->pluck('nama_evaluasi')
            ->toArray();

        if (empty($requiredAspects)) {
            return redirect()->route('dashboard')->with('error', 'No evaluation aspects found for your active class.');
        }

        // 🔹 Ambil lama waktu pengerjaan dari tabel nilai berdasarkan aspek-aspek di atas
        $lamaWaktuPengerjaan = Nilai::where('email', $email)
            ->whereIn('aspek', $requiredAspects)
            ->whereNotNull('lama_waktu_pengerjaan')
            ->pluck('lama_waktu_pengerjaan', 'aspek');

        if ($lamaWaktuPengerjaan->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'No valid completion times found for siCepat Badge.');
        }

        // 🔹 Cek apakah ada waktu pengerjaan kurang dari 900 detik (15 menit)
        $eligibleForBadge = $lamaWaktuPengerjaan->filter(fn($value) => $value < 900)->isNotEmpty();

        if (!$eligibleForBadge) {
            return redirect()->route('dashboard')->with('error', 'You do not meet the criteria for the siCepat Badge.');
        }

        // 🔹 Ambil data badge siCepat
        $badgeId = 3; // ID badge siCepat
        $badge = Badge::find($badgeId);

        if (!$badge) {
            return redirect()->route('dashboard')->with('error', 'Badge siCepat not found.');
        }

        // 🔹 Bentuk status JSON untuk mencatat kelas tempat badge diklaim
        $statusData = [
            [
                'status' => 'claimed',
                'kelas' => $activeKode,
            ]
        ];

        // 🔹 Update atau buat entri baru di tabel user_badge
        UserBadge::updateOrCreate(
            ['email' => $email, 'id_badge' => $badge->id],
            [
                'email' => $email,
                'id_badge' => $badge->id,
                'status' => json_encode($statusData),
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Badge siCepat successfully claimed!');
    }

}
