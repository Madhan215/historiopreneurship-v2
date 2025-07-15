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
        $konten = [
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

        foreach ($konten as $index => $item) {
            ManajemenKonten::create([
                'kategori_konten' => 'kegiatanPembelajaran1',
                'nomor' => $index + 1,
                'konten' => $item,
            ]);
        }
    }
}
