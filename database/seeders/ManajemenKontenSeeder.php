<?php

namespace Database\Seeders;

use App\Models\ManajemenKonten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManajemenKontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $konten1 = [
            "<img class='d-block mx-auto img-fluid my-3 shadow' src='https://historiopreneurship.research-media.web.id/img/MasjidSultanSuriansyah.jpg' alt='Masjid Sultan Suriansyah' style='width: 500px; height: auto;'><figcaption class='text-center my-3'>Gambar Masjid Sultan Suriansyah, Kuin Utara Banjarmasin</figcaption>",
            "<p>Sejarah adalah peninggalan masa lalu yang perlu dirawat sebagai ingatan kolektif manusia, dengan banyak peninggalannya, termasuk bangunan bersejarah, tersebar di Kalimantan Selatan. Mempelajari sejarah tidak hanya memahami masa lalu, tetapi juga memberikan manfaat untuk masa depan sebagai dialog antara peristiwa lampau dan perkembangan masa depan (Kochhar, 2008).</p>",
            "<p>Pariwisata di Indonesia memiliki peluang besar karena setiap tujuan wisatanya menawarkan daya tarik budaya, atraksi, dan sejarah yang khas di setiap daerah. Sesuai dengan Undang-Undang Nomor 9 Tahun 1990 dan Undang-Undang Nomor 10 Tahun 2009, pengembangan pariwisata berbasis budaya memanfaatkan potensi seni, budaya, serta peninggalan sejarah sebagai modal pembangunan untuk meningkatkan kesejahteraan rakyat (Yoeti, 2006; Kirom, Sudarmiatin, & Putra, 2016).</p>",
            "<p>Peninggalan bersejarah mempunyai daya tarik yang besar yang dapat menarik wisatawan. Potensi pariwisata berbasis sejarah budaya merupakan salah satu aset yang memiliki potensi untuk dikembangkan oleh setiap daerah (Adi et al, 2013). Pengembangan potensi sektor pariwisata di daerah selain untuk menambah pendapatan daerah juga dapat memperkenalkan sejarah serta melestarikan budaya daerah wisata tersebut.</p>",
            "<p>Peninggalan bersejarah memiliki daya tarik besar yang dapat menarik wisatawan dan menjadi aset potensial untuk dikembangkan oleh setiap daerah (Adi et al., 2013). Pengembangan pariwisata berbasis sejarah dan budaya tidak hanya meningkatkan pendapatan daerah, tetapi juga memperkenalkan sejarah serta melestarikan budaya lokal.</p>",
            "<p>Daya tarik wisata sejarah terletak pada keunikan keragaman budaya dan sejarah di suatu daerah, yang memungkinkan wisatawan mempelajari budaya lokal untuk memenuhi kebutuhan rekreasi sekaligus mendapatkan edukasi dari peristiwa sejarah (Jamal, Bustami, & Desma). Menurut Irdika (Pusaka Budaya dan Pariwisata, 2007), terdapat 10 elemen budaya yang menjadi daya tarik wisata, yaitu kerajinan, tradisi, sejarah, arsitektur, makanan lokal, seni musik, cara hidup masyarakat, agama, bahasa, dan pakaian lokal. Daya tarik ini semakin kuat jika dikemas dalam bentuk atraksi wisata yang menarik dan unik.</p>",
            "<p>Setiap daerah memiliki sejarah budaya yang unik, menjadi karakteristik pembeda sekaligus potensi pariwisata sejarah (Suyatmin & Edy, 2017). Penelitian Aziz (2018) menyimpulkan bahwa daya tarik kota Banjarmasin meliputi wisata heritage dan peninggalan sejarah, dengan keberadaan sungai, peninggalan kerajaan Banjar, dan nuansa Islami sebagai elemen utamanya. Tempat bersejarah seperti masjid dari era kerajaan dan makam keramat para wali yang berperan dalam penyebaran Islam menjadi daya tarik utama bagi wisatawan lokal maupun nonlokal.</p>",
            "<img class='d-block mx-auto img-fluid my-3 shadow' src='https://historiopreneurship.research-media.web.id/img/2.jpg' alt='Pasar Terapung' style='width: 500px; height: auto;'><figcaption class='text-center my-3'>Gambar Pasar Terapung, Lok Baintan</figcaption>",
            "<p>Pasar Terapung di Kuin mengalami penurunan eksistensi akibat pergeseran aktivitas ekonomi masyarakat ke darat (Pradana, 2020), ditambah pengembangan Pasar Terapung buatan di Siring Tandean yang membuat Pasar Terapung Muara Kuin semakin terpinggirkan. Faktor lain yang memengaruhi adalah kurangnya pengemasan daya tarik wisata, minimnya fasilitas, kondisi lingkungan yang kurang mendukung, serta waktu operasional yang terbatas dari pukul 03.00 hingga 07.00 WITA (Huiwen & Hassink, 2017). Penurunan ini turut menyebabkan hilangnya nilai-nilai sosial dan budaya yang terkandung dalam Pasar Terapung Kuin (Gibson, 2015).</p>",
            "<p>Peninggalan bersejarah memiliki daya tarik besar, termasuk bagi wisatawan mancanegara. Untuk mengembangkan wisata sejarah Kota Banjarmasin, diperlukan identifikasi potensi objek wisata berdasarkan kelayakan lanskap dan nilai-nilai kultural yang ada. Strategi pengembangan ini bertujuan mengoptimalkan variabel kelayakan lanskap agar wisata sejarah dapat mendukung peningkatan kesejahteraan kota dan masyarakat.</p>"
        ];

        foreach ($konten1 as $index => $item) {
            ManajemenKonten::create([
                'kategori_konten' => 'kegiatanPembelajaran1',
                'nomor' => $index + 1,
                'konten' => $item,
            ]);
        }

        $konten2 = [
            "<li>Mahasiswa mampu mengorganisasikan objek kesejarahan berdasarkan hasil identifikasi dan eksplorasi dalam pemetaan.</li>",
            "<li>Mahasiswa mampu mengasesmen objek kesejarahan berdasarkan hasil identifikasi.</li>",
            "<li>Mahasiswa mampu mendesain potensi usaha berdasarkan hasil kelayakan objek (<i>object pattern and feasibility</i>).</li>"
        ];

        foreach ($konten2 as $index => $item) {
            ManajemenKonten::create([
                'kategori_konten' => 'kegiatanPembelajaran2',
                'nomor' => $index + 1,
                'konten' => $item,
            ]);
        }
        $konten3 = [
            [
                "question" => "Siapakah pendiri Kesultanan Banjar?",
                "options" => ["Sultan Adam", "Sultan Suriansyah", "Pangeran Antasari", "Pangeran Hidayatullah"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Perang Banjar terjadi pada tahun?",
                "options" => ["1860-1865", "1859-1905", "1845-1862", "1870-1885"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Siapa yang memimpin Perang Banjar setelah Pangeran Antasari?",
                "options" => ["Sultan Adam", "Pangeran Hidayatullah", "Pangeran Diponegoro", "Sultan Suriansyah"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Apa nama kerajaan sebelum menjadi Kesultanan Banjar?",
                "options" => ["Kerajaan Tanjungpura", "Kerajaan Daha", "Kerajaan Kutai", "Kerajaan Martapura"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Pahlawan nasional dari Kalimantan Selatan adalah?",
                "options" => ["Pangeran Diponegoro", "Cut Nyak Dien", "Pangeran Antasari", "Sultan Hasanuddin"],
                "correct" => 2,
                "explanation" => ""
            ],
            [
                "question" => "Apa dampak dari Perang Banjar terhadap masyarakat lokal?",
                "options" => ["Meningkatnya kesejahteraan", "Peningkatan pendidikan", "Kerugian ekonomi dan sosial", "Pembangunan infrastruktur"],
                "correct" => 2,
                "explanation" => ""
            ],
            [
                "question" => "Mengapa Sultan Suriansyah memeluk Islam?",
                "options" => ["Untuk mendapatkan kekuasaan", "Pengaruh dari pedagang", "Untuk menyatukan rakyat", "Tekanan dari Belanda"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi motivasi utama Pangeran Antasari dalam memimpin Perang Banjar?",
                "options" => ["Mendapatkan kekayaan", "Mempertahankan tanah air", "Mendapatkan dukungan dari Belanda", "Mencari ketenaran"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Apa peran perempuan dalam Perang Banjar?",
                "options" => ["Tidak ada peran", "Sebagai pengumpul dana", "Sebagai pejuang", "Sebagai diplomat"],
                "correct" => 2,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang dapat dipelajari dari perjuangan Pangeran Antasari?",
                "options" => ["Kepentingan kekuasaan", "Nilai-nilai kepemimpinan dan keberanian", "Pentingnya aliansi dengan Belanda", "Kepentingan ekonomi"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Bagaimana cara Pangeran Hidayatullah melanjutkan perjuangan setelah Pangeran Antasari?",
                "options" => ["Dengan diplomasi", "Dengan strategi militer", "Dengan penggalangan massa", "Dengan perjanjian damai"],
                "correct" => 2,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi ciri khas budaya Banjar setelah Islam masuk?",
                "options" => ["Pengaruh Hindu yang kuat", "Tradisi lisan yang hilang", "Perkembangan seni dan sastra Islam", "Penutupan terhadap budaya lokal"],
                "correct" => 2,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi tantangan utama Kesultanan Banjar dalam mempertahankan kemerdekaan?",
                "options" => ["Persaingan antar kerajaan", "Kekurangan sumber daya", "Intervensi kolonial Belanda", "Kurangnya dukungan rakyat"],
                "correct" => 2,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang dapat dilakukan untuk melestarikan sejarah Perang Banjar?",
                "options" => ["Mengabaikan sejarah", "Mendokumentasikan dan mengajarkan kepada generasi muda", "Membuat film tentang Perang Banjar", "Menyembunyikan fakta sejarah"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi pengaruh Perang Banjar terhadap perkembangan politik di Indonesia?",
                "options" => ["Meningkatnya kekuasaan kolonial", "Berkurangnya kesadaran politik", "Munculnya gerakan nasionalisme", "Peningkatan kerjasama dengan Belanda"],
                "correct" => 2,
                "explanation" => ""
            ],
            [
                "question" => "Siapa yang menjadi tokoh penting dalam diplomasi Kesultanan Banjar?",
                "options" => ["Sultan Adam", "Pangeran Antasari", "Pangeran Hidayatullah", "Sultan Suriansyah"],
                "correct" => 0,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi strategi utama dalam Perang Banjar?",
                "options" => ["Perang terbuka", "Perang gerilya", "Perang diplomasi", "Perang ekonomi"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi warisan budaya dari Kesultanan Banjar?",
                "options" => ["Seni tari", "Seni lukis", "Seni musik", "Semua jawaban benar"],
                "correct" => 3,
                "explanation" => ""
            ],
            [
                "question" => "Bagaimana cara masyarakat Banjar merayakan hari kemerdekaan?",
                "options" => ["Dengan upacara resmi", "Dengan festival budaya", "Dengan demonstrasi", "Dengan perayaan sederhana"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi peran penting pendidikan dalam masyarakat Banjar?",
                "options" => ["Meningkatkan kesadaran sejarah", "Meningkatkan keterampilan ekonomi", "Meningkatkan kesadaran politik", "Semua jawaban benar"],
                "correct" => 3,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi tantangan dalam pelestarian budaya Banjar?",
                "options" => ["Globalisasi", "Kurangnya minat generasi muda", "Keterbatasan sumber daya", "Semua jawaban benar"],
                "correct" => 3,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi kontribusi Kesultanan Banjar terhadap Indonesia?",
                "options" => ["Peningkatan perdagangan", "Peningkatan pendidikan", "Perjuangan melawan penjajahan", "Semua jawaban benar"],
                "correct" => 3,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi simbol perjuangan rakyat Banjar?",
                "options" => ["Bendera Kesultanan", "Lambang Pahlawan", "Lagu perjuangan", "Semua jawaban benar"],
                "correct" => 3,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi harapan masyarakat Banjar untuk masa depan?",
                "options" => ["Kemandirian ekonomi", "Pelestarian budaya", "Pendidikan yang lebih baik", "Semua jawaban benar"],
                "correct" => 3,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi peran penting pemuda dalam sejarah Banjar?",
                "options" => ["Sebagai pengikut", "Sebagai pemimpin perubahan", "Sebagai penonton", "Sebagai pengacau"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi nilai-nilai yang diajarkan dalam sejarah Perang Banjar?",
                "options" => ["Keberanian dan pengorbanan", "Kekuasaan dan kekayaan", "Kepentingan pribadi", "Semua jawaban salah"],
                "correct" => 0,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi faktor utama yang memicu Perang Banjar?",
                "options" => ["Pajak yang tinggi", "Kekuasaan lokal", "Perbedaan agama", "Intervensi asing"],
                "correct" => 0,
                "explanation" => ""
            ],
            [
                "question" => "Bagaimana pengaruh Perang Banjar terhadap identitas masyarakat Banjar?",
                "options" => ["Menghilangkan identitas lokal", "Memperkuat identitas budaya", "Mendorong asimilasi", "Tidak ada pengaruh"],
                "correct" => 1,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi peran penting sejarah dalam pendidikan masyarakat Banjar?",
                "options" => ["Membentuk karakter", "Meningkatkan keterampilan teknis", "Mendorong persaingan", "Mengabaikan nilai-nilai lokal"],
                "correct" => 0,
                "explanation" => ""
            ],
            [
                "question" => "Apa yang menjadi harapan masyarakat Banjar terhadap generasi muda?",
                "options" => ["Menjaga tradisi", "Meningkatkan pengetahuan", "Berpartisipasi dalam pembangunan", "Semua jawaban benar"],
                "correct" => 3,
                "explanation" => ""
            ]
        ];
        foreach ($konten3 as $index => $item) {
            ManajemenKonten::create([
                'kategori_konten' => 'kegiatanPembelajaran2',
                'nomor' => $index + 1,
                'konten' => $item,
            ]);
        }
    }
}
