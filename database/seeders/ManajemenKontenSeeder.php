<?php

namespace Database\Seeders;

use App\Models\ManajemenKonten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManajemenKontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert topik terlebih dahulu
        $idTopik = DB::table('topikdinamis')->insertGetId([
            'nama_topik' => 'Panduan Penggunaan',
            'status' => 'on',
            'urutan' => 1,
        ]);

        // Isi konten HTML ul dari Blade
        $konten = '
            <h2>Cara Penggunaan</h2>
            <ul>
                <li>
                    Media ajar ajar ini dirancang untuk membantu dosen untuk melaksanakan kegiatan program kewirausahaan kesejarahan (historiopreneurship) di perguruan tinggi yang menerapkan Merdeka Belajar Kampus Merdeka.
                </li>
                <li>
                    Di dalam media ajar ajar ini ada beberapa aktivitas yang saling berkaitan, dengan beberapa formatif asesmen sebagai diagnostik asesmen dan asesmen sumatif sebagai ujung dari proses pembelajaran. Disarankan agar media ajar ajar ini dilakukan sesuai dengan urutan di alur CPMK.
                </li>
                <li>
                    Waktu yang direkomendasikan untuk pelaksanaan media ajar ajar ini adalah 1 semester atau 14 kali tatap muka dengan durasi kurang lebih 28 JP. Sebaiknya ada jeda waktu antar aktivitas agar di satu sisi para dosen mempunyai waktu yang cukup untuk melakukan persiapan materi untuk memantik diskusi dan refleksi mahasiswa. Mahasiswa juga mempunyai waktu untuk berpikir, berefleksi, dan menjalankan masing-masing aktivitas dengan baik.
                </li>
            </ul>
        ';

        // Masukkan ke materi dinamis
        DB::table('materidinamis')->insert([
            'id_topik' => $idTopik,
            'nama_materi' => 'Cara Penggunaan',
            'konten' => $konten,
            'status' => 'on',
            'urutan' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Materi 2: Capaian Pembelajaran Lulusan
        $konten2 = '
        <h2>Capaian Pembelajaran Lulusan (CPL)</h2>
        <p>CPL yang ingin dicapai dalam pembelajaran ini adalah mahasiswa mampu mengaplikasikan teori dan nilai-nilai kewirausahaan dalam kehidupan nyata berdasarkan potensi kewirausahaan kesejarahan (historiopreneurship) beserta berbagai aspek pendukungnya, dengan konten kesejarahan, kewirausahaan dan kepariwisataan yang mengacu  pada kebutuhan materi, Merdeka Belajar Kampus Merdeka, dan project based learning.</p>';

        DB::table('materidinamis')->insert([
            'id_topik' => $idTopik,
            'nama_materi' => 'Capaian Pembelajaran Lulusan (CPL)',
            'konten' => $konten2,
            'status' => 'on',
            'urutan' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $konten3 = '
    <h2>Capaian Pembelajaran Mata Kuliah (CPMK)</h2>
    <p>Melalui media ajar berbasis <i>Project based learning</i> (PjBL) ini, diharapkan:</p>
    <table class="shadow my-4 table table-striped table-sm">
        <tr>
            <td class="text-nowrap"><b>CPMK 1</b></td>
            <td>Mahasiswa mampu mendeskripsikan konten dan karakter objek berdasarkan kesejarahan serta urgensinya dalam perspektif budaya dan nilai karakter</td>
        </tr>
        <tr>
            <td class="text-nowrap"><b>CPMK 2</b></td>
            <td>Mahasiswa mampu mengorganisasikan objek kesejarahan berdasarkan hasil identifikasi dan eksplorasi dalam pemetaan</td>
        </tr>
        <tr>
            <td class="text-nowrap"><b>CPMK 3</b></td>
            <td>Mahasiswa mampu mengasesmen objek kesejarahan berdasarkan hasil identifikasi</td>
        </tr>
        <tr>
            <td class="text-nowrap"><b>CPMK 4</b></td>
            <td>Mahasiswa mampu mendesain pola perjalanan (travel pattern) objek berdasarkan hasil kelayakan</td>
        </tr>
        <tr>
            <td class="text-nowrap"><b>CPMK 5</b></td>
            <td>Mahasiswa mampu menyusun laporan terkait ramburambu wisata kesejarahan berbasis kewirausahaan berdasarkan hasil observasi lapangan</td>
        </tr>
        <tr>
            <td class="text-nowrap"><b>CPMK 6</b></td>
            <td>Mahasiswa mampu menguraikan perspektif terkait pemasaran kewirausahaan kesejarahan melalui diskusi kelompok dan pakar</td>
        </tr>
        <tr>
            <td class="text-nowrap"><b>CPMK 7</b></td>
            <td>Mahasiswa mampu merancang produk dan jasa terkait kewirausahaan kesejarahan berdasarkan konsep kewirausahaan</td>
        </tr>
        <tr>
            <td class="text-nowrap"><b>CPMK 8</b></td>
            <td>Mahasiswa memiliki keterampilan memasarkan produk dan jasa terkait kewirausahaan kesejarahan berdasarkan hasil praktik lapangan</td>
        </tr>
    </table>
    <h3>HAL YANG HARUS DIPERHATIKAN SEBELUM MEMULAI PROSES PEMBELAJARAN</h3>
    <p>
        Dalam proses belajar berbasis PjBL ini, sangat penting sekali diajukan sebuah pertanyaan atau studi kasus untuk menstimulasi mahasiswa agar mengekplorasi pembahasan masalah melalui pendalaman materi, lalu menganalisisnya dari berbagai sudut pandang dan teori, yang akhirnya mengkonfirmasi masalah tersebut melalui diskusi, refleksi dan pengambilan kesimpulan. Mahasiswa diberikan stimulus yang memicu pembelajaran aktif dan menyenangkan sesuai dengan konsep merdeka belajar untuk mengkonstruksi pengetahuannya sendiri melalui pengalaman yang nyata. Pada akhir kegiatan pembelajaran, mahasiswa berkreasi membuat sebuah project bisnis dengan memanfaatkan potensi wirausaha dalam berbagai bidang pariwisata yang sudah teridentifikasi.
    </p>';

        DB::table('materidinamis')->insert([
            'id_topik' => $idTopik,
            'nama_materi' => 'CPMK dan Pedoman Belajar',
            'konten' => $konten3,
            'status' => 'on',
            'urutan' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $konten4 = '<h2>Kolaborasi Narasumber</h2>
<p class="text-justify">
    Apabila dosen dan mahasiswa mempunyai keterbatasan untuk memperoleh konten, dosen bisa mengundang narasumber ahli misalnya dari guru mata pelajaran produktif, praktisi di berbagai bidang, dan bisa menggunakan sarana sekitar sebagai sumber belajar primer maupun sekunder. 
</p>';
        DB::table('materidinamis')->insert([
            'id_topik' => $idTopik,
            'nama_materi' => 'Kolaborasi Narasumber',
            'konten' => $konten4,
            'status' => 'on',
            'urutan' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $konten5 = '<h2>Peran Dosen</h2>
<ol>
    <li>
        Fasilitator: memfasilitasi kegiatan, menyediakan media belajar, lembar belajar, lembar kerja dan lain-lain.
    </li>
    <li>
        Moderator: memoderasi diskusi, memberikan pertanyaan pemantik, menutup dengan kesimpulan.
    </li>
    <li>
        Penyedia Informasi: menyediakan artikel, video, tautan informasi.
    </li>
    <li>
        Mentor: membimbing peserta didik dalam mengembangkan proyek.
    </li>
</ol>';
        DB::table('materidinamis')->insert([
            'id_topik' => $idTopik,
            'nama_materi' => 'Peran Dosen',
            'konten' => $konten5,
            'status' => 'on',
            'urutan' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $konten6 = '<h2>Sarana dan Prasarana</h2>
<p><b>Sarana Pembelajaran</b></p>
<ol>
    <li>
        Digital dan Nondigital berupa Buku paket, e-book, portal pembelajaran, tautan edukasi di internet, surat kabar, majalah, televisi, radio, teks iklan di ruang publik, tempat wisata kesejarahan.
    </li>
    <li>
        Video pembelajaran di internet.
    </li>
    <li>
        Aplikasi “BAHIMAT” yang telah dikembangkan dan diunduh dari Google Playstore.
    </li>
</ol>
<p><b>Prasarana Pembelajaran</b></p>
<ol>
    <li>
        Perangkat keras (PC, Laptop, Smartphone, Tablet, Headset).
    </li>
    <li>
        Perangkat lunak (Aplikasi pembelajaran: Whatsapp, Zoom, Google Classroom, Media Sosial: Youtube, Instagram, dan lain-lain).
    </li>
    <li>
        Jaringan internet
    </li>
</ol>';
        DB::table('materidinamis')->insert([
            'id_topik' => $idTopik,
            'nama_materi' => 'Sarana dan Prasarana',
            'konten' => $konten6,
            'status' => 'on',
            'urutan' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $konten7 = '<h2>Tahapan Kegiatan Pembelajaran <i>Project Based Learning</i></h2>
<p class="mt-3"><b>Merdeka Belajar</b></p>
<ol>
    <li>
        Mulai dari diri: Mahasiswa diberi pertanyaan pemantik oleh dosen dan mencurahkannya
        berbagai pendapat dan pengalamannya.
    </li>
    <li>
        Eksplorasi konsep: Mahasiswa melihat tayangan foto maupun video wisata sejarah yang ada di Kalimantan Selatan.
    </li>
    <li>
        Ruang kolaborasi: Mahasiswa melakukan identifikasi dan asesmen potensi wisata sejarah secara berkelompok.
    </li>
    <li>
        Refleksi terbimbing: merefleksi hasil kajiannya bersama dengan kelompok.
    </li>
    <li>
        Demokrasi konstekstual: Mengerjakan lembar analisis individu.
    </li>
    <li>
        Elaborasi: Mahasiswa memperdalam materi pengayaan untuk memperluas pemahaman.
    </li>
    <li>
        Koneksi antar materi: Mahasiswa membuat kesimpulan materi dan keterkaitannya
        dengan materi atau mata kuliah lain.
    </li>
    <li>
        Aksi nyata: Mahasiswa melakukan presentasi hasil kajian bersama kelompok.
    </li>
</ol>
<p><b>Project Based Learning</b></p>
<ol>
    <li>
        Pertanyaan mendasar: Mahasiswa secara berkelompok menentukan topik "objek wisata sejarah" yang akan dijadikan potensi wirausaha wisata kesejarahan.                        
    </li>
    <li>
        Desain perencanaan: Mahasiswa secara berkelompok menyusun desain perencanaan produk melalui marketing mix, merencanakan startegi pemasarannya melalui teknologi digital.                        
    </li>
    <li>
        Menyusun jadwal: Mahasiswa secara berkelompok membuat jadwal langkah-langkah penyediakan produk dan jadwal pembuatan sampai dengan pengoperasian pemasaran.                        
    </li>
    <li>
        Monitor perkembangan: Mahasiswa secara berkelompok memonitor perkembangan pemasaran produknya selama 2 minggu.                        
    </li>
    <li>
        Uji hasil: setelah 2 minggu melakukan pemasaran, mahasiswa melaporkan hasil pemasaran produknya.
    </li>
</ol>';
        DB::table('materidinamis')->insert([
            'id_topik' => $idTopik,
            'nama_materi' => 'Tahapan',
            'konten' => $konten7,
            'status' => 'on',
            'urutan' => 7,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


}
