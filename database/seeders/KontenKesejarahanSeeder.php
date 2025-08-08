<?php

namespace Database\Seeders;

use App\Models\kuisDinamis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class KontenKesejarahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Simpan ke tabel topik
        $topikId = DB::table('topikdinamis')->insertGetId([
            'nama_topik' => 'Kesejarahan',
            'status' => 'on',
            'urutan' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $soalJson = json_encode([
            [
                'question' => 'Siapakah pendiri Kesultanan Banjar?',
                'options' => [
                    'Sultan Adam',
                    'Sultan Suriansyah',
                    'Pangeran Antasari',
                    'Pangeran Hidayatullah'
                ],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Perang Banjar terjadi pada tahun?',
                'options' => ["1860-1865", "1859-1905", "1845-1862", "1870-1885"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Siapa yang memimpin Perang Banjar setelah Pangeran Antasari?',
                'options' => ["Sultan Adam", "Pangeran Hidayatullah", "Pangeran Diponegoro", "Sultan Suriansyah"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa nama kerajaan sebelum menjadi Kesultanan Banjar?',
                'options' => ["Kerajaan Tanjungpura", "Kerajaan Daha", "Kerajaan Kutai", "Kerajaan Martapura"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Pahlawan nasional dari Kalimantan Selatan adalah?',
                'options' => ["Pangeran Diponegoro", "Cut Nyak Dien", "Pangeran Antasari", "Sultan Hasanuddin"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa dampak dari Perang Banjar terhadap masyarakat lokal?',
                'options' => ["Meningkatnya kesejahteraan", "Peningkatan pendidikan", "Kerugian ekonomi dan sosial", "Pembangunan infrastruktur"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Mengapa Sultan Suriansyah memeluk Islam?',
                'options' => ["Untuk mendapatkan kekuasaan", "Pengaruh dari pedagang", "Untuk menyatukan rakyat", "Tekanan dari Belanda"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi motivasi utama Pangeran Antasari dalam memimpin Perang Banjar?',
                'options' => ["Mendapatkan kekayaan", "Mempertahankan tanah air", "Mendapatkan dukungan dari Belanda", "Mencari ketenaran"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa peran perempuan dalam Perang Banjar?',
                'options' => ["Tidak ada peran", "Sebagai pengumpul dana", "Sebagai pejuang", "Sebagai diplomat"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang dapat dipelajari dari perjuangan Pangeran Antasari?',
                'options' => ["Kepentingan kekuasaan", "Nilai-nilai kepemimpinan dan keberanian", "Pentingnya aliansi dengan Belanda", "Kepentingan ekonomi"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Bagaimana cara Pangeran Hidayatullah melanjutkan perjuangan setelah Pangeran Antasari?',
                'options' => ["Dengan diplomasi", "Dengan strategi militer", "Dengan penggalangan massa", "Dengan perjanjian damai"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi ciri khas budaya Banjar setelah Islam masuk?',
                'options' => ["Pengaruh Hindu yang kuat", "Tradisi lisan yang hilang", "Perkembangan seni dan sastra Islam", "Penutupan terhadap budaya lokal"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi tantangan utama Kesultanan Banjar dalam mempertahankan kemerdekaan?',
                'options' => ["Persaingan antar kerajaan", "Kekurangan sumber daya", "Intervensi kolonial Belanda", "Kurangnya dukungan rakyat"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang dapat dilakukan untuk melestarikan sejarah Perang Banjar?',
                'options' => ["Mengabaikan sejarah", "Mendokumentasikan dan mengajarkan kepada generasi muda", "Membuat film tentang Perang Banjar", "Menyembunyikan fakta sejarah"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi pengaruh Perang Banjar terhadap perkembangan politik di Indonesia?',
                'options' => ["Meningkatnya kekuasaan kolonial", "Berkurangnya kesadaran politik", "Munculnya gerakan nasionalisme", "Peningkatan kerjasama dengan Belanda"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Siapa yang menjadi tokoh penting dalam diplomasi Kesultanan Banjar?',
                'options' => ["Sultan Adam", "Pangeran Antasari", "Pangeran Hidayatullah", "Sultan Suriansyah"],
                'correct' => 0,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi strategi utama dalam Perang Banjar?',
                'options' => ["Perang terbuka", "Perang gerilya", "Perang diplomasi", "Perang ekonomi"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi warisan budaya dari Kesultanan Banjar?',
                'options' => ["Seni tari", "Seni lukis", "Seni musik", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Bagaimana cara masyarakat Banjar merayakan hari kemerdekaan?',
                'options' => ["Dengan upacara resmi", "Dengan festival budaya", "Dengan demonstrasi", "Dengan perayaan sederhana"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi peran penting pendidikan dalam masyarakat Banjar?',
                'options' => ["Meningkatkan kesadaran sejarah", "Meningkatkan keterampilan ekonomi", "Meningkatkan kesadaran politik", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi tantangan dalam pelestarian budaya Banjar?',
                'options' => ["Globalisasi", "Kurangnya minat generasi muda", "Keterbatasan sumber daya", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi kontribusi Kesultanan Banjar terhadap Indonesia?',
                'options' => ["Peningkatan perdagangan", "Peningkatan pendidikan", "Perjuangan melawan penjajahan", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi simbol perjuangan rakyat Banjar?',
                'options' => ["Bendera Kesultanan", "Lambang Pahlawan", "Lagu perjuangan", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi harapan masyarakat Banjar untuk masa depan?',
                'options' => ["Kemandirian ekonomi", "Pelestarian budaya", "Pendidikan yang lebih baik", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi peran penting pemuda dalam sejarah Banjar?',
                'options' => ["Sebagai pengikut", "Sebagai pemimpin perubahan", "Sebagai penonton", "Sebagai pengacau"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi nilai-nilai yang diajarkan dalam sejarah Perang Banjar?',
                'options' => ["Keberanian dan pengorbanan", "Kekuasaan dan kekayaan", "Kepentingan pribadi", "Semua jawaban salah"],
                'correct' => 0,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi faktor utama yang memicu Perang Banjar?',
                'options' => ["Pajak yang tinggi", "Kekuasaan lokal", "Perbedaan agama", "Intervensi asing"],
                'correct' => 0,
                'explanation' => ''
            ],
            [
                'question' => 'Bagaimana pengaruh Perang Banjar terhadap identitas masyarakat Banjar?',
                'options' => ["Menghilangkan identitas lokal", "Memperkuat identitas budaya", "Mendorong asimilasi", "Tidak ada pengaruh"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi peran penting sejarah dalam pendidikan masyarakat Banjar?',
                'options' => ["Membentuk karakter", "Meningkatkan keterampilan teknis", "Mendorong persaingan", "Mengabaikan nilai-nilai lokal"],
                'correct' => 0,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi harapan masyarakat Banjar terhadap generasi muda?',
                'options' => ["Menjaga tradisi", "Meningkatkan pengetahuan", "Berpartisipasi dalam pembangunan", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ]
        ]);

        // 3. Simpan ke tabel evaluasi
        DB::table('evaluasidinamis')->insert([
            'id_topik' => $topikId,
            'nama_evaluasi' => 'Pre Test Kesejarahan',
            'konten' => $soalJson,
            'status' => 'on',
            'urutan' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $soalJson2 = json_encode([
            [
                'question' => 'Siapakah pendiri Kesultanan Banjar?',
                'options' => [
                    'Sultan Adam',
                    'Sultan Suriansyah',
                    'Pangeran Antasari',
                    'Pangeran Hidayatullah'
                ],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Perang Banjar terjadi pada tahun?',
                'options' => ["1860-1865", "1859-1905", "1845-1862", "1870-1885"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Siapa yang memimpin Perang Banjar setelah Pangeran Antasari?',
                'options' => ["Sultan Adam", "Pangeran Hidayatullah", "Pangeran Diponegoro", "Sultan Suriansyah"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa nama kerajaan sebelum menjadi Kesultanan Banjar?',
                'options' => ["Kerajaan Tanjungpura", "Kerajaan Daha", "Kerajaan Kutai", "Kerajaan Martapura"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Pahlawan nasional dari Kalimantan Selatan adalah?',
                'options' => ["Pangeran Diponegoro", "Cut Nyak Dien", "Pangeran Antasari", "Sultan Hasanuddin"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa dampak dari Perang Banjar terhadap masyarakat lokal?',
                'options' => ["Meningkatnya kesejahteraan", "Peningkatan pendidikan", "Kerugian ekonomi dan sosial", "Pembangunan infrastruktur"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Mengapa Sultan Suriansyah memeluk Islam?',
                'options' => ["Untuk mendapatkan kekuasaan", "Pengaruh dari pedagang", "Untuk menyatukan rakyat", "Tekanan dari Belanda"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi motivasi utama Pangeran Antasari dalam memimpin Perang Banjar?',
                'options' => ["Mendapatkan kekayaan", "Mempertahankan tanah air", "Mendapatkan dukungan dari Belanda", "Mencari ketenaran"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa peran perempuan dalam Perang Banjar?',
                'options' => ["Tidak ada peran", "Sebagai pengumpul dana", "Sebagai pejuang", "Sebagai diplomat"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang dapat dipelajari dari perjuangan Pangeran Antasari?',
                'options' => ["Kepentingan kekuasaan", "Nilai-nilai kepemimpinan dan keberanian", "Pentingnya aliansi dengan Belanda", "Kepentingan ekonomi"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Bagaimana cara Pangeran Hidayatullah melanjutkan perjuangan setelah Pangeran Antasari?',
                'options' => ["Dengan diplomasi", "Dengan strategi militer", "Dengan penggalangan massa", "Dengan perjanjian damai"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi ciri khas budaya Banjar setelah Islam masuk?',
                'options' => ["Pengaruh Hindu yang kuat", "Tradisi lisan yang hilang", "Perkembangan seni dan sastra Islam", "Penutupan terhadap budaya lokal"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi tantangan utama Kesultanan Banjar dalam mempertahankan kemerdekaan?',
                'options' => ["Persaingan antar kerajaan", "Kekurangan sumber daya", "Intervensi kolonial Belanda", "Kurangnya dukungan rakyat"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang dapat dilakukan untuk melestarikan sejarah Perang Banjar?',
                'options' => ["Mengabaikan sejarah", "Mendokumentasikan dan mengajarkan kepada generasi muda", "Membuat film tentang Perang Banjar", "Menyembunyikan fakta sejarah"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi pengaruh Perang Banjar terhadap perkembangan politik di Indonesia?',
                'options' => ["Meningkatnya kekuasaan kolonial", "Berkurangnya kesadaran politik", "Munculnya gerakan nasionalisme", "Peningkatan kerjasama dengan Belanda"],
                'correct' => 2,
                'explanation' => ''
            ],
            [
                'question' => 'Siapa yang menjadi tokoh penting dalam diplomasi Kesultanan Banjar?',
                'options' => ["Sultan Adam", "Pangeran Antasari", "Pangeran Hidayatullah", "Sultan Suriansyah"],
                'correct' => 0,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi strategi utama dalam Perang Banjar?',
                'options' => ["Perang terbuka", "Perang gerilya", "Perang diplomasi", "Perang ekonomi"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi warisan budaya dari Kesultanan Banjar?',
                'options' => ["Seni tari", "Seni lukis", "Seni musik", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Bagaimana cara masyarakat Banjar merayakan hari kemerdekaan?',
                'options' => ["Dengan upacara resmi", "Dengan festival budaya", "Dengan demonstrasi", "Dengan perayaan sederhana"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi peran penting pendidikan dalam masyarakat Banjar?',
                'options' => ["Meningkatkan kesadaran sejarah", "Meningkatkan keterampilan ekonomi", "Meningkatkan kesadaran politik", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi tantangan dalam pelestarian budaya Banjar?',
                'options' => ["Globalisasi", "Kurangnya minat generasi muda", "Keterbatasan sumber daya", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi kontribusi Kesultanan Banjar terhadap Indonesia?',
                'options' => ["Peningkatan perdagangan", "Peningkatan pendidikan", "Perjuangan melawan penjajahan", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi simbol perjuangan rakyat Banjar?',
                'options' => ["Bendera Kesultanan", "Lambang Pahlawan", "Lagu perjuangan", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi harapan masyarakat Banjar untuk masa depan?',
                'options' => ["Kemandirian ekonomi", "Pelestarian budaya", "Pendidikan yang lebih baik", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi peran penting pemuda dalam sejarah Banjar?',
                'options' => ["Sebagai pengikut", "Sebagai pemimpin perubahan", "Sebagai penonton", "Sebagai pengacau"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi nilai-nilai yang diajarkan dalam sejarah Perang Banjar?',
                'options' => ["Keberanian dan pengorbanan", "Kekuasaan dan kekayaan", "Kepentingan pribadi", "Semua jawaban salah"],
                'correct' => 0,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi faktor utama yang memicu Perang Banjar?',
                'options' => ["Pajak yang tinggi", "Kekuasaan lokal", "Perbedaan agama", "Intervensi asing"],
                'correct' => 0,
                'explanation' => ''
            ],
            [
                'question' => 'Bagaimana pengaruh Perang Banjar terhadap identitas masyarakat Banjar?',
                'options' => ["Menghilangkan identitas lokal", "Memperkuat identitas budaya", "Mendorong asimilasi", "Tidak ada pengaruh"],
                'correct' => 1,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi peran penting sejarah dalam pendidikan masyarakat Banjar?',
                'options' => ["Membentuk karakter", "Meningkatkan keterampilan teknis", "Mendorong persaingan", "Mengabaikan nilai-nilai lokal"],
                'correct' => 0,
                'explanation' => ''
            ],
            [
                'question' => 'Apa yang menjadi harapan masyarakat Banjar terhadap generasi muda?',
                'options' => ["Menjaga tradisi", "Meningkatkan pengetahuan", "Berpartisipasi dalam pembangunan", "Semua jawaban benar"],
                'correct' => 3,
                'explanation' => ''
            ]
        ]);
        // 3. Simpan ke tabel evaluasi
        DB::table('evaluasidinamis')->insert([
            'id_topik' => $topikId,
            'nama_evaluasi' => 'Post Test Kesejarahan',
            'konten' => $soalJson2,
            'status' => 'on',
            'urutan' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $konten3 = "
            <img class='d-block mx-auto img-fluid my-3 shadow' src='https://historiopreneurship.research-media.web.id/img/MasjidSultanSuriansyah.jpg' alt='Masjid Sultan Suriansyah' style='width: 500px; height: auto;'><figcaption class='text-center my-3'>Gambar Masjid Sultan Suriansyah, Kuin Utara Banjarmasin</figcaption>
            <p>Sejarah adalah peninggalan masa lalu yang perlu dirawat sebagai ingatan kolektif manusia, dengan banyak peninggalannya, termasuk bangunan bersejarah, tersebar di Kalimantan Selatan. Mempelajari sejarah tidak hanya memahami masa lalu, tetapi juga memberikan manfaat untuk masa depan sebagai dialog antara peristiwa lampau dan perkembangan masa depan (Kochhar, 2008).</p>
            <p>Pariwisata di Indonesia memiliki peluang besar karena setiap tujuan wisatanya menawarkan daya tarik budaya, atraksi, dan sejarah yang khas di setiap daerah. Sesuai dengan Undang-Undang Nomor 9 Tahun 1990 dan Undang-Undang Nomor 10 Tahun 2009, pengembangan pariwisata berbasis budaya memanfaatkan potensi seni, budaya, serta peninggalan sejarah sebagai modal pembangunan untuk meningkatkan kesejahteraan rakyat (Yoeti, 2006; Kirom, Sudarmiatin, & Putra, 2016).</p>
            <p>Peninggalan bersejarah mempunyai daya tarik yang besar yang dapat menarik wisatawan. Potensi pariwisata berbasis sejarah budaya merupakan salah satu aset yang memiliki potensi untuk dikembangkan oleh setiap daerah (Adi et al, 2013). Pengembangan potensi sektor pariwisata di daerah selain untuk menambah pendapatan daerah juga dapat memperkenalkan sejarah serta melestarikan budaya daerah wisata tersebut.</p>
            <p>Peninggalan bersejarah memiliki daya tarik besar yang dapat menarik wisatawan dan menjadi aset potensial untuk dikembangkan oleh setiap daerah (Adi et al., 2013). Pengembangan pariwisata berbasis sejarah dan budaya tidak hanya meningkatkan pendapatan daerah, tetapi juga memperkenalkan sejarah serta melestarikan budaya lokal.</p>
            <p>Daya tarik wisata sejarah terletak pada keunikan keragaman budaya dan sejarah di suatu daerah, yang memungkinkan wisatawan mempelajari budaya lokal untuk memenuhi kebutuhan rekreasi sekaligus mendapatkan edukasi dari peristiwa sejarah (Jamal, Bustami, & Desma). Menurut Irdika (Pusaka Budaya dan Pariwisata, 2007), terdapat 10 elemen budaya yang menjadi daya tarik wisata, yaitu kerajinan, tradisi, sejarah, arsitektur, makanan lokal, seni musik, cara hidup masyarakat, agama, bahasa, dan pakaian lokal. Daya tarik ini semakin kuat jika dikemas dalam bentuk atraksi wisata yang menarik dan unik.</p>
            <p>Setiap daerah memiliki sejarah budaya yang unik, menjadi karakteristik pembeda sekaligus potensi pariwisata sejarah (Suyatmin & Edy, 2017). Penelitian Aziz (2018) menyimpulkan bahwa daya tarik kota Banjarmasin meliputi wisata heritage dan peninggalan sejarah, dengan keberadaan sungai, peninggalan kerajaan Banjar, dan nuansa Islami sebagai elemen utamanya. Tempat bersejarah seperti masjid dari era kerajaan dan makam keramat para wali yang berperan dalam penyebaran Islam menjadi daya tarik utama bagi wisatawan lokal maupun nonlokal.</p>
            <img class='d-block mx-auto img-fluid my-3 shadow' src='https://historiopreneurship.research-media.web.id/img/2.jpg' alt='Pasar Terapung' style='width: 500px; height: auto;'><figcaption class='text-center my-3'>Gambar Pasar Terapung, Lok Baintan</figcaption>
            <p>Pasar Terapung di Kuin mengalami penurunan eksistensi akibat pergeseran aktivitas ekonomi masyarakat ke darat (Pradana, 2020), ditambah pengembangan Pasar Terapung buatan di Siring Tandean yang membuat Pasar Terapung Muara Kuin semakin terpinggirkan. Faktor lain yang memengaruhi adalah kurangnya pengemasan daya tarik wisata, minimnya fasilitas, kondisi lingkungan yang kurang mendukung, serta waktu operasional yang terbatas dari pukul 03.00 hingga 07.00 WITA (Huiwen & Hassink, 2017). Penurunan ini turut menyebabkan hilangnya nilai-nilai sosial dan budaya yang terkandung dalam Pasar Terapung Kuin (Gibson, 2015).</p>
            <p>Peninggalan bersejarah memiliki daya tarik besar, termasuk bagi wisatawan mancanegara. Untuk mengembangkan wisata sejarah Kota Banjarmasin, diperlukan identifikasi potensi objek wisata berdasarkan kelayakan lanskap dan nilai-nilai kultural yang ada. Strategi pengembangan ini bertujuan mengoptimalkan variabel kelayakan lanskap agar wisata sejarah dapat mendukung peningkatan kesejahteraan kota dan masyarakat.</p>"
        ;
        DB::table('materidinamis')->insert([
            'id_topik' => $topikId,
            'nama_materi' => 'Kegiatan Pembelajaran 1',
            'konten' => $konten3,
            'status' => 'on',
            'urutan' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $konten4 = '<h2>Kegiatan Pembelajaran 2</h2>
<p class="text-sm">6 JP x @50 menit = 300 menit</p>
<p>
    <b>CPMK:</b>
</p>
<ol>
    <li>
        Mahasiswa mampu mengorganisasikan objek kesejarahan berdasarkan hasil identifikasi dan eksplorasi dalam pemetaan.
    </li>
    <li>
        Mahasiswa mampu mengasesmen objek kesejarahan berdasarkan hasil identifikasi.
    </li>
    <li>
        Mahasiswa mampu mendesain potensi usaha berdasarkan hasil kelayakan objek (<i>object pattern and feasibility</i>).
    </li>
</ol>
<div class="border rounded bg-warning-subtle p-2">
    Untuk dapat mencapai Kegiatan Pembelajaran 2, silahkan eksplorasi lebih lanjut terkait kesejarahan yang ada di Kalimantan Selatan. Dan kerjakan analisi yang ada pada halaman selanjutnya >>
</div>'
        ;
        DB::table('materidinamis')->insert([
            'id_topik' => $topikId,
            'nama_materi' => 'Kegiatan Pembelajaran 2',
            'konten' => $konten4,
            'status' => 'on',
            'urutan' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kontenkuis = <<<HTML
<link rel='stylesheet' href="{{ asset('css/test.css') }}">

<h2>Kuis Kesejarahan</h2>
<div class="card mt-4">
    <div class="p-3 d-flex align-items-center card-header">
        <div class="mb-0 h5 fw-semibold card-title">
            <i class="bi bi-pencil"></i> Kuis: Drag n Drop 5 Objek Wisata di Kalimantan Selatan!
        </div>
    </div>
    <div class="p-4 card-body">
        <p class="fw-semibold">Panduan Pengerjaan:</p>
        <ol>
            <li>Pilih Gambar yang menurut Anda Benar</li>
            <li>Seret Gambar ke kotak Jawaban</li>
            <li>Untuk Mengganti Jawaban seret kembali gambar ke atas kotak soal</li>
            <li>Tekan Submit ketika jawaban sudah dirasa benar</li>
            <li>Tekan Reset ketika Anda ingin mengulang </li>
        </ol>
        <p class="fw-semibold">Keterangan:</p>
        <ul>
            <li>Batas pengerjaan kuis hanya satu kali</li>
            <li>Status : <span class="fw-bold">{{ \$batas_test_value == 0 ? 'Sudah dikerjakan' : 'Belum dikerjakan' }}</span></li>
            <li>Skor Kuis : <span class="fw-bold">{{ \$skor_test_value }}</span></li>
        </ul>
    </div>
</div>

<div {{ \$batas_test_value == 0 ? 'hidden' : '' }}>
    <!-- Semua kode soal drag-n-drop di sini -->
    <div class="soal">
        <div class="jawaban" draggable="true" id="jawaban1" data-correct="true">
            <img src="{{ asset('img/1.jpg') }}" alt="Gambar 1">
        </div>
        <!-- dan seterusnya ... -->
    </div>
    <div class="kotakJawaban" id="kotakJawaban"></div>

    <div class="text-center">
        <button id="submitBtn" class="btn btn-primary">Submit</button>
        <button id="resetBtn" class="btn btn-warning">Reset</button>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <h2>Hasil</h2>
            <p id="nilaiTotal" class="nilai-text">Total Nilai: 0</p>
            <form id="tutupForm" action="{{ route('DND1') }}" method="POST">
                @csrf
                <input type="hidden" id="nilaiAkhirInput" name="nilai_akhir">
                <input type="hidden" name="aspek" value="poin_DND_Kesejarahan">
                <button type="submit" id="closeModalBtn" class="btn btn-primary">Tutup</button>
            </form>
        </div>
    </div>

    <div id="resetModal" class="modal">
        <div class="modal-content">
            <h2>Konfirmasi Reset</h2>
            <button id="confirmResetBtn" class="btn btn-danger">Ya, Reset</button><br>
            <button id="cancelResetBtn" class="btn btn-secondary">Batal</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/test.js') }}"></script>
<script src="{{ asset('js/kuis1.js') }}"></script>
HTML;

        DB::table('kuisdinamis')->insert([
            'id_topik' => $topikId,
            'nama_quis' => 'Kuis DnD Kalimantan Selatan',
            'konten' => $kontenkuis,
            'status' => 'on',
            'urutan' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Analisis
        $inputObjek = '';
        for ($i = 1; $i <= 10; $i++) {
            $inputObjek .= '
        <div class="row mt-3">
            <div class="col">
                <label for="objek' . $i . '" class="form-label fw-bold mt-2">Objek ' . $i . '</label><br>
                <input name="objek' . $i . '" id="objek' . $i . '" class="form-control">
            </div>
        </div>
    ';
        }

        // Baru sekarang kita buat satu blok heredoc yang utuh
        $kontenanalisis = <<<HTML
<h2>ANALISA INDIVIDU 1</h2>
<p class="text-lg">AKTIVITAS EKSPLORASI MAHASISWA</p>
<p>
    Berdasarkan hasil identifikasi terkait objek kesejarahan yang ada di daerah kalian, petakanlah objek-objek kesejarahan tersebut.
    <br>Lakukanlah analisa secara individu!
</p>
<p class="border rounded p-2 bg-warning-subtle">
    Silahkan berselancar di dunia maya / lingkungan sekitar untuk melakukan analisis
</p>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="ratio ratio-16x9 shadow">
                <iframe 
                    src="https://www.youtube.com/embed/P4B-OnP8ISc?si=YBNeIwxF_qJmlo3E"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
    <h4 class="mt-4">Temukanlah 10 Objek Kesejarahan yang ada di daerah kalian.</h4>
    <form class="w-100" method="post" action="/simpan-jawaban-individu2">
        <input type="hidden" name="_token" value="[token_csrf]">
        {$inputObjek}
        <p class="border rounded p-2 bg-warning-subtle mt-4 fw-semibold">
            Note: Tugas ini tidak dapat di edit setelah disimpan
        </p>
        <div class="mt-4">
            <button type="submit" class="me-2 btn btn-primary">SIMPAN JAWABAN</button>
        </div>
    </form>
</div>
HTML;
        DB::table('analisisdinamis')->insert([
            'id_topik' => $topikId,
            'nama_analisis' => 'analisis 1',
            'konten' => $kontenanalisis,
            'status' => 'on',
            'urutan' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kontenAnalisis2 = view('content-B.analisisIndividu', [])->render();




        DB::table('analisisdinamis')->insert([
            'id_topik' => $topikId,
            'nama_analisis' => 'analisis 2',
            'konten' => $kontenAnalisis2,
            'status' => 'on',
            'urutan' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

}
