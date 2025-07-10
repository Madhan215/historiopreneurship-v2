@extends('layouts.main')

@section('container')

{{-- Materi A --}}
<div class="mt-3">
    {{-- Status Bar --}}
    <div id="halaman_saat_ini">{{ session('active_menu_sub') }}</div>

    <div class="progress rounded" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 0.001%" id="status_bar"></div>
      </div>
    
    
        <div class="row mt-3" id="">
            <div class="col">
                <h2>A. Informasi Umum</h2>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="col-6">
                <button class="btn btn-primary" onclick="prev()" id="prev">Sebelumnya</button>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-primary" onclick="next()" id="next">Selanjutnya</button>
            </div>
        </div>
        <div class="row materi-a" id="CPL">
            <div class="col">
                <h3>Capaian Pembelajaran Lulusan (CPL)</h3>
                <p>CPL yang ingin dicapai dalam pembelajaran ini adalah mahasiswa
                    mampu mengaplikasikan teori dan nilai-nilai kewirausahaan dalam
                    kehidupan nyata berdasarkan potensi kewirausahaan kesejarahan
                    (historiopreneurship) beserta berbagai aspek pendukungnya, dengan
                    konten kesejarahan, kewirausahaan dan kepariwisataan yang mengacu 
                    pada kebutuhan materi, Merdeka Belajar Kampus Merdeka, dan project 
                    based learning. </p>
            </div>
        </div>
        <div class="row materi-a" id="CPMK">
            <div class="col">
                <h3>Capaian Pembelajaran Mata Kuliah (CPMK)</h3>
                <p>Melalui media ajar berbasis <i>Project based learning</i> (PjBL) ini, diharapkan:</p>
                <table class="table table-striped table-sm">
                    <tr>
                        <td class="text-nowrap" ><b>CPMK 1</b></td>
                        <td>Mahasiswa mampu mendeskripsikan konten dan karakter objek berdasarkan kesejarahan serta urgensinya dalam perspektif budaya dan nilai karakter
                            </td>
                    </tr>
                    <tr>
                        <td class="text-nowrap" ><b>CPMK 2</b></td>
                        <td>Mahasiswa mampu mengorganisasikan objek
                            kesejarahan berdasarkan hasil identifikasi dan
                            eksplorasi dalam pemetaan
                            </td>
                    </tr>
                    <tr>
                        <td class="text-nowrap" ><b>CPMK 3</b></td>
                        <td>Mahasiswa mampu mengasesmen objek kesejarahan
                            berdasarkan hasil identifikasi
                            </td>
                    </tr>
                    <tr>
                        <td class="text-nowrap" ><b>CPMK 4</b></td>
                        <td>Mahasiswa mampu mendesain pola perjalanan (travel
                            pattern) objek berdasarkan hasil kelayakan
                            
                            </td>
                    </tr>
                    <tr>
                        <td class="text-nowrap" ><b>CPMK 5</b></td>
                        <td>Mahasiswa mampu menyusun laporan terkait ramburambu
                            wisata kesejarahan berbasis kewirausahaan
                            berdasarkan hasil observasi lapangan
                            
                            </td>
                    </tr>
                    <tr>
                        <td class="text-nowrap" ><b>CPMK 6</b></td>
                        <td>Mahasiswa mampu menguraikan perspektif terkait
                            pemasaran kewirausahaan kesejarahan melalui
                            diskusi kelompok dan pakar                            
                            </td>
                    </tr>
                    <tr>
                        <td class="text-nowrap" ><b>CPMK 7</b></td>
                        <td>Mahasiswa mampu merancang produk dan jasa
                            terkait kewirausahaan kesejarahan berdasarkan
                            konsep kewirausahaan                            
                            </td>
                    </tr>
                    <tr>
                        <td class="text-nowrap" ><b>CPMK 8</b></td>
                        <td>Mahasiswa memiliki keterampilan memasarkan
                            produk dan jasa terkait kewirausahaan kesejarahan
                            berdasarkan hasil praktik lapangan 
                            </td>
                    </tr>
                </table>
            </div>
        
        <div class="row" id="hal">
            <div class="col">
                <h2>HAL YANG HARUS DIPERHATIKAN SEBELUM MEMULAI PROSES PEMBELAJARAN </h2>
                <p>Dalam proses belajar berbasis PjBL ini, sangat penting sekali diajukan
                    sebuah pertanyaan atau studi kasus untuk menstimulasi mahasiswa agar
                    mengekplorasi pembahasan masalah melalui pendalaman materi, lalu
                    menganalisisnya dari berbagai sudut pandang dan teori, yang akhirnya
                    mengkonfirmasi masalah tersebut melalui diskusi, refleksi dan
                    pengambilan kesimpulan. Mahasiswa diberikan stimulus yang memicu
                    pembelajaran aktif dan menyenangkan sesuai dengan konsep merdeka
                    belajar untuk mengkonstruksi pengetahuannya sendiri melalui pengalaman
                    yang nyata. Pada akhir kegiatan pembelajaran, mahasiswa berkreasi
                    membuat sebuah project bisnis dengan memanfaatkan potensi wirausaha
                    dalam berbagai bidang pariwisata yang sudah teridentifikasi. </p>
            </div>
        </div>
    </div>
        <div class="row materi-a" id="peran-dosen">
            <div class="col">
                <h2>Peran Dosen</h2>
                <ol>
                    <li>Fasilitator: memfasilitasi kegiatan, menyediakan media
                        belajar, lembar belajar, lembar kerja dan lain-lain. </li>
                    <li>Moderator: memoderasi diskusi, memberikan pertanyaan
                        pemantik, menutup dengan kesimpulan.</li>
                    <li>Penyedia Informasi: menyediakan artikel, video, tautan
                        informasi. </li>
                    <li>Mentor: membimbing peserta didik dalam mengembangkan
                        proyek. </li>
                </ol>
            </div>
        </div>
        <div class="row materi-a" id="sarana-dan-prasarana">
            <div class="col">
                <h2>Sarana dan Prasarana</h2>
                <p><b>Sarana Pembelajaran</b></p>
                <ol>
                    <li> Digital dan Nondigital berupa Buku paket, e-book, portal pembelajaran,
                        tautan edukasi di internet, surat kabar, majalah, televisi, radio, teks iklan
                        di ruang publik, tempat wisata kesejarahan.
                        </li>
                    <li>Video pembelajaran di internet.</li>
                    <li>Aplikasi “BAHIMAT” yang telah dikembangkan dan diunduh dari
                        Google Playstore.</li>
                </ol>
            </div>
        
        <div class="row">
            <div class="col">
                <p><b>Prasarana Pembelajaran</b></p>
                <ol>
                    <li>  Perangkat keras (PC, Laptop, Smartphone, Tablet, Headset).
                        </li>
                    <li> Perangkat lunak (Aplikasi pembelajaran: Whatsapp, Zoom, Google
                        Classroom, Media Sosial: Youtube, Instagram, dan lain-lain). </li>
                    <li>Jaringan internet</li>
                </ol>
            </div>
        </div>
    </div>
        <div class="row materi-a" id="kolaborasi-narasumber">
            <div class="col">
                <h2>Kolaborasi dan Narasumber</h2>
                <p class="text-justify">
                    Apabila dosen dan mahasiswa mempunyai keterbatasan untuk memperoleh konten, dosen bisa mengundang narasumber ahli misalnya dari guru mata pelajaran produktif, praktisi di berbagai bidang, dan bisa menggunakan sarana sekitar sebagai sumber belajar primer maupun sekunder. 
                </p>
            </div>
        </div>
        <div class="row materi-a" id="cara-penggunaan">
            <div class="col">
                <h2>Cara Penggunaan</h2>
                <ul>
                    <li>Buku ajar ajar ini dirancang untuk membantu dosen
                        untuk melaksanakan kegiatan program
                        kewirausahaan kesejarahan (historiopreneurship) di
                        perguruan tinggi yang menerapkan Merdeka Belajar
                        Kampus Merdeka.</li>
                    <li>Di dalam buku ajar ajar ini ada beberapa aktivitas
                        yang saling berkaitan, dengan beberapa formatif
                        asesmen sebagai diagnostik asesmen dan asesmen
                        sumatif sebagai ujung dari proses pembelajaran.
                        Disarankan agar buku ajar ajar ini dilakukan sesuai
                        dengan urutan di alur CPMK. </li>
                    <li>Waktu yang direkomendasikan untuk pelaksanaan buku ajar ajar ini adalah 1 semester atau 14 kali tatap muka dengan durasi kurang lebih 28 JP. Sebaiknya ada jeda waktu antar aktivitas agar di satu sisi para dosen mempunyai waktu yang cukup untuk melakukan persiapan materi untuk memantik diskusi dan refleksi mahasiswa. Mahasiswa juga mempunyai waktu untuk berpikir, berefleksi, dan menjalankan masing-masing aktivitas dengan baik.</li>
                </ul>
            </div>
        </div>
        <div  class="materi-a" id="tahapan">
        <div class="row">
            <div class="col">
                <h2>Tahapan Kegiatan Pembelajaran Projeck Based Learning</h2>
                <p><b>Merdeka Belajar</b></p>
                <ol>
                    <li>Mulai dari diri: Mahasiswa diberi pertanyaan pemantik oleh dosen dan mencurahkannya
                        berbagai pendapat dan pengalamannya.
                        </li>
                    <li>Eksplorasi konsep: Mahasiswa melihat tayangan foto maupun video wisata
                        sejarah yang ada di Kalimantan Selatan.
                        </li>
                    <li>Ruang kolaborasi: Mahasiswa melakukan identifikasi dan asesmen potensi wisata
                        sejarah secara berkelompok.
                        </li>
                    <li>Refleksi terbimbing: merefleksi hasil kajiannya bersama dengan kelompok.
                    </li>
                    <li>Demokrasi konstekstual: Mengerjakan lembar analisis individu.
                    </li>
                    <li>Elaborasi: Mahasiswa memperdalam materi pengayaan untuk memperluas pemahaman.
                    </li>
                    <li>Koneksi antar materi: Mahasiswa membuat kesimpulan materi dan keterkaitannya
                        dengan materi atau mata kuliah lain. </li>
                    <li>Aksi nyata: Mahasiswa melakukan presentasi hasil kajian bersama kelompok. </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p><b>Project Based Learning</b></p>
                <ol>
                    <li>Pertanyaan mendasar: Mahasiswa secara berkelompok menentukan topik "objek wisata
                        sejarah" yang akan dijadikan potensi wirausaha wisata kesejarahan.                        
                        </li>
                    <li>Desain perencanaan: Mahasiswa secara berkelompok menyusun desain perencanaan
                        produk melalui marketing mix, merencanakan startegi pemasarannya melalui teknologi
                        digital.                        
                        </li>
                    <li>Menyusun jadwal: Mahasiswa secara berkelompok membuat jadwal langkah-langkah
                        penyediakan produk dan jadwal pembuatan sampai dengan pengoperasian pemasaran.                        
                        </li>
                    <li>Monitor perkembangan: Mahasiswa secara berkelompok memonitor perkembangan
                        pemasaran produknya selama 2 minggu.                        
                    </li>
                    <li>Uji hasil: setelah 2 minggu melakukan pemasaran, mahasiswa melaporkan hasil
                        pemasaran produknya.
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- Materi B --}}
<div class="mt-3">
    <div class="row">
        <div class="col">
            <h2>B. Kesejarahan</h2>
        </div>
    </div>
    {{-- Tombol Navigasi --}}
    <div class="row mb-3 mt-3">
        <div class="col-6">
            <button class="btn btn-primary" onclick="prev()" id="prev">Sebelumnya</button>
        </div>
        <div class="col-6 text-end">
            <button class="btn btn-primary" onclick="next()" id="next">Selanjutnya</button>
        </div>
    </div>
    <div class="row materi-b" id="kegiatan-pembelajaran-1">
        <div class="col">
            <h3>Kegiatan Pembelajaran 1</h3>
            <p class="text-sm">2 JP x @50 menit = 100 menit.</p>
            <p>Sejarah sebagai salah satu
                bentuk peninggalan masa lalu yang
                harus tetap kita rawat sebagai
                ingatan kolektif manusia. Banyak
                peninggalan sejarah yang tersebar
                di berbagai sudut dunia, tak
                terkecuali di Kalimantan Selatan.
                Belajar sejarah bukan berarti hanya
                belajar tentang masa lalu yang
                tiada guna, namun akan memberikan manfaat untuk masa yang akan datang, karena
                sejarah merupakan dialog antara peristiwa masa lampau dan perkembangan di masa
                depan (Kochhar, 2008). Peninggalan tersebut salah satu bentuknya adalah bangunan
                bersejarah.
            </p>
            <p>
                Pariwisata di Indonesia mempunyai peluang besar karena memiliki daya tarik
                tersendiri dimana setiap tujuan wisatanya memiliki unsur-unsur budaya, atraksi dan
                sejarah dan setiap daerahnya memiliki ciri khas yang berbeda-beda. Undang-Undang
                Nomor 9 Tahun 1990 menjelaskan bahwa pengembangan pariwisata di Indonesia
                menggunakan konsep budaya atau culture tourism dengan mempertimbangkan
                potensi seni dan budaya yang beraneka ragam yang tersebar pada daerah tujuan
                wisata daerah wisata (Yoeti, 2006). Sejalan dengan Undang-Undang Nomor 10 Tahun
                7
                2009 yang menjelaskan bahwa peninggalan purbakala, peninggalan sejarah, seni dan
                budaya yang dimiliki oleh bangsa Indonesia merupakan sumber daya dan modal
                pembangunan kepariwisataan untuk meningkatkan kesejahteraan rakyat (Kirom,
                Sudarmiatin, & Putra, 2016).

            </p>
            <p>
                Peninggalan bersejarah mempunyai daya tarik yang besar yang dapat menarik
                wisatawan. Potensi pariwisata berbasis sejarah budaya merupakan salah satu aset
                yang memiliki potensi untuk dikembangkan oleh setiap daerah (Adi et al, 2013).
                Pengembangan potensi sektor pariwisata di daerah selain untuk menambah
                pendapatan daerah juga dapat memperkenalkan sejarah serta melestarikan budaya
                daerah wisata tersebut.

            </p>
            <p>
                Wisata sejarah adalah kegiatan wisata yang bertujuan untuk mengunjungi
                tempat-tempat yang memiliki nilai kesejarahan. Nilai kesejarahan yang terdapat pada
                daerah wisata itulah yang menjadi objek wisata sejarah yang ditawarkan. Objek wisata
                tersebut beberapa diantaranya adalah arsitektur bangunan, kebudayaan dan
                kepercayaan masa lampau (Ishak, 2020). Obyek wisata yang berupa tempat atau
                keadaan alam, tata hidup, seni budaya serta peninggalan sejara bangsa perlu
                dikembangkan secara terencana serta inovatif karena obyek wisata ini merupakan titik
                sentral dari pengembangan pariwisata nasional (Suwena & Widyamatja, 2017).

            </p>
            <p>
                Daya tarik wisata sejarah adalah para wisatawan dapat menikmati keunikan
                dari keragaman budaya dan sejarah di daerah yang dikunjunginya. Tujuan dari wisata
                sejarah bagi para wisatawan adalah mempelari budaya daerah untuk memenuhi
                kebutuhan serta kepuasan rekreasinya, selain itu mereka mendapatkan edukasi dari
                peristiwa sejarah dan budaya daerah wisata (Jamal, bustami, & Desma).
                Dikemukakan oleh Irdika (Pusaka Budaya dan Pariwisata, 2007) terdapat 10 elemen
                budaya yang menjadi daya tarik wisata yakni: (1) Kerajninan, (2) tradisi, (3) sejarah,
                (4) arsitektur, (5) makanan lokal, (6) seni musik, (7) cara hidup masyarakat, (8) agama,
                (9) bahasa dan (10) pakaian lokal. Daya tarik wisata juga dipengaruhi oleh penyajian
                dari eksistensi dan keunikan dari obyek wisatayang ada yang dikemas menjadi ragam
                atraksi wisata yang menarik.

            </p>
            <p>
                Setiap daerah memiliki sejarah budaya yang unik sehingga menjadi
                karakteristik pembeda dengan daerah lain. Perbedaan karakteristik sejarah budaya
                tersebut merupakan potensi dari pariwisata sejarah di setiap daerah (Suyatmin & Edy,
                2017). Penelitian yang dilakukan oleh Aziz (2018) menyimpulkan bahwa aspek daya
                tarik kota Banjarmasin salah satunya adalah wisata heritage dan peninggalan sejarah. Sebagai kota yang
                dijuluki sebagai kota seribu sungai, Banjarmasin juga dipenuhi
                dengan tempat-tempat bersejarah yang menjadi daya tarik wisatawan lokal maupun
                non lokal. Daya tarik wisata sejarah di kota Banjarmasin dipengaruhi oleh keberadaan
                sungai dan peninggalan sejarah kerjaan Banjar dan jaman pejuangannya. Sejarah
                kerajaan banjar juga memiliki nuansa Islami sehingga Kebanyakan dari tempat
                bersejarah yang dikunjungi adalah masjid yang dibangun pada pemerintahan zaman
                dahulu yang masih dipelihara dengan menjaga bentuk aslinya serta makam keramat
                para wali yang berpengaruh menyebarkan agama Islam di Banjarmasin.
            </p>
            <p>
                Seperti yang terjadi pada obyek wisata pasar terapung di Kuin yang mengalami
                penurunan aksistensinya karena aktivitas dan kegiatan ekonomi masyarakat
                berpindah ke darat (Pradana, 2020). Dikembangkannya Pasar Terapung buatan di
                Siring Tandean juga membuat Pasar Terapung Muara Kuin semakin terpinggirkan.
                Masalah lain adalah Kurangnya pengemasan daya tarik obyek wisata dimana
                seharusnya daerah tujuan wisata memiliki keunikan, kekhasan dan dan daya tarik
                tersendiri, baik berupa alam maupun masyarakat serta budayanya (Huiwen & Hassink,
                2017). Selain itu faktor lingkungan disekitar juga mempengaruhi seperti jalan yang
                sempit, kondisi lingkungan dan fasilitas yang kurang memadai, serta waktu menikmati
                wisata terbatas dari pukul 03.00 dini hari hingga pukul 07.00 pagi wita saja. Penurunan
                keberadaan obyek wisata Pasar Terapung Kuin juga menyebabkan hilangnya nilainilai
                sosial
                dan
                budaya
                yang
                terkandung
                di
                dalam
                Pasar
                Terapung
                itu
                sendiri
                (Gibson,

                2015).


            </p>
            <p>
                Peninggalan bersejarah mempunyai daya tarik yang besar yang juga dapat
                menarik wisatawan mancanegara. Sehingga untuk mengembangkan wisata sejarah
                Kota Banjarmasin dengan memberdayakan elemen dan lansekap budaya sebagai
                objek wisata serta nilai-nilai kultural yang terdapat di Kota Banjarmasin, diperlukan
                sebuah identifikasi guna menemukan potensi objek wisata sejarah berdasarkan
                kelayakan lanskap untuk selanjutnya diketahui strategi pengembangan berdasarkan
                variabel kelayakan lanskap yang perlu dioptimalkan guna meningkatkan
                kesejahteraan kota dan masyarakat.

            </p>
            <p><b>Destinasi Wisata Banjarmasin Favorit</b></p>
            <p><b>Air Terjun Haratai</b></p>
            <div class="text-center">
                <img class="rounded" src="https://meratusgeopark.org/wp-content/uploads/2019/05/Air-Terjun-Haratai-6.jpg"
                alt="Gambar Air Terjun Haratai" style="width : 500px;height :300px">
            </div>
            
            <p>
                Keistimewaan Air Terjun Haratai terletak pada pemandangan alamnya yang
                indah. Air Terjun Haratai seakan-akan diapit oleh tebing bebatuan dan pepohonan di
                kanan kiri. Meskipun memiliki debit air yang deras, Anda masih bisa masuk ke perairan
                untuk menikmati sensasi menyegarkan airnya. Di bagian pinggir air terjun, airnya tidak
                begitu dalam masih bisa dinikmati dengan baik meski suhunya dingin menusuk.

            </p>
            <p>
                Selain menikmati pemandangan dan kesegaran air terjun. Anda bisa
                melakukan terapi psikologis di tempat ini. Suara air terjunnya sangat menenangkan.
                Puas mendengarkan suara air, carilah tempat yang bagus untuk mengambil foto air
                terjun atau foto selfie dengan background air terjun.

            </p>
            <p>
                Ada sebuah nilai luhur yang membuat saya kagum, bahwa kelestarian alam
                lebih berharga dari harta ataupun materi lainnya. Sehingga keberadaan air terjun
                menjadi sangat dissakralkan bagi Suku Dayak Meratus.

            </p>
            <p>
                Air Terjun Haratai, sebuah air terjun yang sangat elok di tengah alam yang
                masih asri. Air Terjun Haratai adalah air terjun yang berada di deretan pegunungan
                Meratus, serta berada di kawasan wisata Loksado.

            </p>
            <p>
                <b>
                    Bamboo Rafting
                </b>
            </p>
            <div class="text-center">
                <img class="rounded"  src="https://www.amazingborneo.id/wp-content/uploads/2019/12/Bamboo-Rafting-Balanting-Paring-Banjarmasin2.jpg"
                alt="Gambar Bambu Rafting" style="width : 500px;height :300px">
            </div>
            
            <p>Anda yang hobi menguji adrenalin akan mendapatkan sensasi mendebarkan
                ketika berlibur ke tempat wisata di Banjarmasin seperti Bamboo Rafting. Tempat ini
                digadang-gadang sebagai tempat rafting paling unik di Banjarmasin. Keunikan dari
                Bamboo Rafting adalah media arung jeramnya yang menggunakan bambu atau rakit
                bukan perahu karet.
            </p>
            <p>Selain menikmati sensasi mendebarkan mengelilingi sungai, Anda juga akan
                dimanjakan dengan pemandangan kiri kanan yang asri dan indah. Tempat wisata ini
                masih sangat asri dan menyejukkan dengan pepohonan rindang. Meski dilakukan di
                siang hari, Anda masih bisa merasakan hawa sejuknya. </p>

            <p>
                <b>
                    Pasar Terapung
                </b>
            </p>
            <div class="text-center">
                <img class="rounded" src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/11/2023/10/29/269929595_937342236887852_4647198914071301074_n-750673262.jpg"
                alt="Gambar pasar terapung" style="width : 500px;height :300px">
            </div>
            
            <p>Anda yang hobi pergi ke pasar akan menemukan konsep pasar tradisional yang
                berbeda saat mengunjungi Pasar Terapung Banjarmasin. Pasar di sini bukan berdiri
                di atas daratan tapi dibuka di perahu klotok tepat di atas Sungai Martapura.
            </p>
            <p>
                Selain mengagumi keunikan para pedagang pasar terapung, Anda juga bisa
                menikmati penjelajahan Sungai Martapura dengan menyewa perahu. Coba
                bayangkan, sensasi menyenangkan kuliner di atas perahu sambil melintasi sungai?
            </p>
            <p><b>Pemandian Air Panas Tanuhi</b></p>
            <div class="text-center">
                <img class="rounded" src="https://megapolis.id/wp-content/uploads/2024/02/20220213_185243_compress98.jpg"
                alt="Gambar Pemandian Air Panas Tanuhi" style="width : 500px;height :300px">
            </div>
            
            <p>
                Mandi air panas di kolam terbuka bersama pengunjung lainnya merupakan
                konsep utama Pemandian Air Panas Tanuhi. Tempat wisata ini setidaknya difasilitasi
                dengan empat kolam renang, lapangan tenis, restoran, penginapan dan fasilitas
                lainnya.
            </p>
            <p>
                Selain menawarkan kolam mandi air panas, tempat wisata alam Banjarmasin
                ini juga menyuguhkan view pegunungan yang sangat indah. Karena kolam terbuka,
                otomatis Anda bisa melihat pemandangan yang tersaji dengan lebih mudah. Jika
                sudah merasa haus atau lelah, ada restoran dan cottage yang siap melayani.

            </p>
            <p>
                <b>
                    Taman Wisata Alam Pulau Bakut
                </b>
            </p>
            <div class="text-center">
                <img class="rounded" src="https://asset-2.tstatic.net/banjarmasinposttravel/foto/bank/images/taman-wisata-alam-pulau-bakut-di-kecamatan-anjir-muara.jpg"
                alt="Gambar Taman WIsata Alam Pulau Bakut" style="width : 500px;height :300px">
            </div>
            
            <p>
                Manjakan mata Anda dengan melihat pemandangan asri di Taman Wisata
                Alam Pulau Bakut. Hutan Mangrove di kawasan wisata ini sangat indah dan rindang
                membuat udara di sekitarnya selalu sejuk. Anda yang suka dengan pemandangan
                hutan dan pepohonan akan merasa terpikat dengan penataan ruangnya.

            </p>
            <p>
                Salah satu keistimewaan di Taman Wisata Alam Pulau Bakut adalah jembatan
                panjangnya. Anda bisa mengambil foto selfie dengan latar belakang pepohonan di
                sekelilingnya. Atau mengambil foto jarak jauh dengan background jembatan. Intinya,
                Anda jangan lupa bawa kamera ketika berencana datang ke sini.

            </p>
            <p>
                Dari kelima tempat wisata di atas, mana yang ingin Anda kunjungi? Semua
                tempat wisata Banjarmasin memiliki potensi pariwisata. Selain banyak daya tariknya,
                masing-masing tempat wisata juga sudah dilengkapi dengan beragam fasilitas.
                Fasilitas tersebut membantu para pengunjung untuk menikmati lokasi wisata lebih
                lama.
            </p>
            <p>PERTANYAAN PEMANTIK</p>
            <p><b>"Siapakah di antara kalian yang hobi wisata atau jalan-jalan?" </b></p>
            <p>Dalam melakukan pembelajaran ini, ditayangkan sebuah video tentang wisata yang ada di
                Kalimantan Selatan.</p>
        </div>
    </div>
    <div class="row materi-b" id="kegiatan-pembelajaran-2">
        <div class="col">
            <h3>Kegiatan Pembelajaran 2</h3>
            <p class="text-sm">6 JP x @50 menit = 300 menit
            </p>
            <p>
                <b>CPMK:</b>
            </p>
            <ol>
                <li>Mahasiswa mampu mengorganisasikan objek kesejarahan berdasarkan hasil identifikasi dan
                    eksplorasi dalam pemetaan.</li>
                <li>Mahasiswa mampu mengasesmen objek kesejarahan berdasarkan hasil identifikasi.
                </li>
                <li>Mahasiswa mampu mendesain potensi usaha berdasarkan hasil kelayakan objek (<i>object pattern and feasibility</i>).
                </li>
            </ol>
            <div class="kotak bg-warning-subtle">
                Untuk dapat mecapai Kegiatan Pembelajaran 2, silahkan eksplorasi lebih lanjut terkait kesejarahan yang ada di Kalimantan Selatan. Dan kerjakan analisi yang ada pada halaman selanjutnya >>
            </div>
        </div>
    </div>
    <div class="row materi-b" id="lembar-analisa-kelompok">
        <div class="col">
            <h3>LEMBAR ANALISA KELOMPOK</h3>
            <p class="text-lg">AKTIVITAS EKSPLORASI MAHASISWA</p>
            <p>
                Berdasarkan hasil identifikasi terkait objek kesejarahan yang ada di daerah kalian, petakanlah objek-objek kesejarahan tersebut.
                <br>Lakukanlah analisa secara berkelompok!
            </p>
            <p class="kotak bg-warning-subtle"> 
                Silahkan berselancar di dunia maya / lingkungan sekitar untuk melakuka analisis
            </p>
            <div class="text-center bordered mb-3">
                <iframe width="900" height="507" src="https://www.youtube.com/embed/P4B-OnP8ISc?si=YBNeIwxF_qJmlo3E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            
            <p>Anggota Kelompok</p>
            <ol>
                <li>Nama: </li>
                <li>Nama: </li>
                <li>Nama: </li>
                <li>Nama: </li>
                <li>Nama: </li>
            </ol>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek1">Objek 1</label><br>
                <textarea name="objek1" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek2">Objek 2</label><br>
                <textarea name="objek2" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek3">Objek 3</label><br>
                <textarea name="objek3" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek4">Objek 4</label><br>
                <textarea name="objek4" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek5">Objek 5</label><br>
                <textarea name="objek5" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek6">Objek 6</label><br>
                <textarea name="objek6" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek7">Objek 7</label><br>
                <textarea name="objek7" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek8">Objek 8</label><br>
                <textarea name="objek8" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="objek9">Objek 9</label><br>
                <textarea name="objek9" id="" rows="5"></textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <label for="objek10">Objek 10</label><br>
                <textarea name="objek10" id="" rows="5"></textarea>
            </div>
        </div>
    </div>
    <div class="row materi-b" id="lembar-analisa-individu">
        <div class="col">
            <h2>LEMBAR ANALISA INDIVIDU</h2>
            <h3>AKTIVITAS UNTUK KERJA</h3>
            <p>Berdasarkan hasil identifikasi dari setiap kelompok, analisa dan asesmen lah hasil pemetaan
                tersebut dengan melengkapi kolom di bawah ini. Selanjutnya, diskusikan di kelas.
            </p>
            <p class="text-lg">LENGKAPILAH KOLOM DI BAWAH INI!</p>
        </div>

        <div class="row">
            <div class="col">
                <div class="row mt-3">
                    <div class="col">
                        <label for="objekWisata">Objek Wisata</label><br>
                        <textarea name="objekWisata" id="" rows="5"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="objekWisata">Objek Kesejarahan</label><br>
                        <textarea name="objekWisata" id="" rows="5"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="objekWisata">Urgensi Objek Kesejarahan</label><br>
                        <textarea name="objekWisata" id="" rows="5"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="objekWisata">Urgensi Kesejarahan</label><br>
                        <textarea name="objekWisata" id="" rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <h3 class="text-center">INDIKATOR PENILAIAN KELAYAKAN OBJEK KESEJARAHAN </h3>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aspek</th>
                        <th>Bobot</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tr>
                    <td>1.</td>
                    <td>Daya Tarik</td>
                    <td>6</td>
                    <td>Daya tarik merupakan faktor utama
                        alasan seseorang melakukan
                        perjalanan wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Aksesibilitas</td>
                    <td>5</td>
                    <td>Aksesbilitas merupakan faktor penting
                        yang mendukung wisatawan dapat
                        melakukan kegiatan wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Sarana Prasarana</td>
                    <td>3</td>
                    <td>Sarana dan prasarana bersifat
                        sebagai penunjang dalam kegiatan
                        wisata sejarah.
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Partisipasi Masyarakat</td>
                    <td>6</td>
                    <td>Partisipasi masyarakat adalah
                        keterlibatan sukarela oleh masyarakat
                        dalam pembangunan objek sejarah di
                        lingkungan mereka sendiri.</td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col">
                <h3 class="text-center mt-4">LAMPIRAN <br> FORM SYARAT KELAYAKAN OBJEK KESEJARAHAB</h3>
                <table class="table table-bordered  table-responsive-md">
                    <thead>
                        <tr>
                            <th rowspan="2">NO</th>
                            <th rowspan="2">ASPEK</th>
                            <th rowspan="2">Sub Aspek</th>
                            <th colspan="5">Skor</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                        </tr>
                    </thead>
                    <tr>
                        <td rowspan="4">1.</td>
                        <td rowspan="4">Daya Tarik</td>
                        <td>1. Memiliki keunikan atau ciri khas sejarah lokal</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Objek sejarah memiliki lokasi yang bersih</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Kawasan objek sejarah terjamin keamanannya</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4. Keserasian bangunan objek dengan lingkungan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="3">2.</td>
                        <td rowspan="3">Aksesbilitas</td>
                        <td>1. Kondisi jalan menuju objek sejarah terlampau mulus</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Dekat dari pusat kota</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Waktu tempuh dari pusat kota tidak terlalu lama/jauh</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="4">3.</td>
                        <td rowspan="4">Sarana Prasarana</td>
                        <td>1. Memiliki fasilitas umum seperti toilet dan tempat wudhu</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Memiliki <i>gif/merchandise store</i> di sekitar objek sejarah</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Memiliki warung dan rumah makan di sekitar objek sejarah</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4. Memiliki areal parkir yang cukup untuk wisatawan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="7">4.</td>
                        <td rowspan="7">Partisipasi Masyarakat</td>
                        <td>1. Objek kesejarahan dapat mensejahterakan tuan rumah atau masyarakat sekitar</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2. Masyarakat sekitar menyambut kehadiran wisatawan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3. Masyarakat menyediakan fasilitas kenyamanan wisata</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4. Masyarakat menyediakan pemandu wisata</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5. Pelaku wisata berasal dari masyarak lokal</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6. Terdapat penjual cindremata/oleh-oleh khas wisata setempat yang dibuat masyarakat lokal
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7. Masyarakat turut serta dalam menjaga keamanan, kenyamanan, ketertiban, dan kebersihan
                            daerah wisata</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row materi-b" id="kegiatan-pembelajaran-3">
        <div class="col">
            <h3>Kegiatan Pembelajaran 3</h3>
            <p class="text-sm">4 JP x @50 menit = 200 menit </p>
            <p><b>CPMK:</b></p>
            <ol>
                <li>Mahasiswa mampu menyusun laporan terkait rambu-rambu wisata kesejarahan
                    berbasis kewirausahaan berdasarkan hasil observasi lapangan.
                </li>
            </ol>
            <p class="text-lg">LAPORAN KEGIATAN</p>
            <p>AKTIVITAS UNJUK KERJA</p>
            <p>Berdasarkan hasil penilaian kelayakan objek sejarah yang dipilih dari setiap kelompok,
                buatlah laporan kegiatan tersebut dengan memuat “object pattern and feasibility”,
                selanjutnya diskusikan di kelas. </p>
            <div class="mb-3">
                <label for="formFile" class="form-label">Silahkan kumpulkan tugas anda!</label>
                <input class="form-control" type="file" id="formFile">
            </div>
        </div>
    </div>
    <div class="row materi-b" id="refleksi">
        <div class="col">
            <h2>REFLEKSI</h2>
            <p>Setelah mempelajari buku ajar ini, bagaimana pemahaman kalian terhadap materi?

                Isilah penilaian diri ini dengan sejujur-jujurnya dan sebenar- benarnya sesuai dengan
                perasaan kalian ketika mengerjakan suplemen bahan materi ini! Bubuhkanlah tanda centang
                (√) pada salah satu gambar yang dapat mewakili perasaan kalian setelah mempelajari materi
                ini! </p>

            <!-- emoticon -->
            <div class="icon-radio">
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-laugh-beam"></i></label>
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-smile"></i></label>
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-grin-beam-sweat"></i></label>
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-sad-cry"></i></label>
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-dizzy"></i></label>
            </div>

            <p><b>Jawablah pertanyaan berikut!</b></p>
            <ol>
                <li class="mt-3"><label for="">Apa yang sudah kalian pelajari?</label> <br> <textarea name="" id=""
                        rows="5"></textarea></li>
                <li class="mt-3"><label for="">Apa yang kalian kuasai dari materi ini?</label> <br> <textarea name=""
                        id="" rows="5"></textarea></li>
                <li class="mt-3"><label for="">Bagian apa yang belum kalian kuasai?</label> <br> <textarea name="" id=""
                        rows="5"></textarea></li>
                <li class="mt-3"><label for="">Apa upaya kalian untuk menguasai yang belum kalian kuasai?</label> <br>
                    <textarea name="" id="" rows="5"></textarea>
                </li>
            </ol>
        </div>
    </div>

</div>

{{-- Materi C --}}
<div class="mt-3">


    <div class="row">
        <div class="col">
            <h2>C. Kewirausahaan dan Kepariwisataan </h2>
        </div>
        {{-- Tombol Navigasi --}}
        <div class="row mb-3 mt-3">
            <div class="col-6">
                <button class="btn btn-primary" onclick="prev()" id="prev">Sebelumnya</button>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-primary" onclick="next()" id="next">Selanjutnya</button>
            </div>
        </div>
    </div>
    <div class="materi-c" id="kewirausahaan-dan-kepariwisataan">
        <div class="row">
            <div class="col">

                <h3>Kewirausahaan dan Kepariwisataan</h3>
                <p class="text-sm">14 JP x @ 50 menit = 700 menit
                </p>
                <p>
                    <b>CPMK:</b>
                </p>
                <ol>
                    <li>Mahasiswa mampu menguraikan perspektif terkait pemasaran kewirausahaan
                        kesejarahan melalui diskusi kelompok dan pakar.
                    </li>
                    <li>Mahasiswa mampu merancang produk dan jasa terkait kewirausahaan kesejarahan
                        berdasarkan konsep kewirausahaan.
                    </li>
                    <li>
                        Mahasiswa memiliki keterampilan memasarkan produk dan jasa terkait kewirausahaan
                        kesejarahan berdasarkan hasil praktik
                        lapangan.
                    </li>
                </ol>
                <p class="kotak">
                    <b>PERTANYAAN PEMANTIK</b> <br>
                    Adakah di antara kalian
                    yang pernah berbelanja
                    online? Berapa rata-rata
                    pengeluaran per bulan
                    jika berbelanja online?
                    <br> <b>Tips untuk dosen:</b> <br>Dalam melakukan
                    pembelajaran ini, dosen
                    dapat menayangkan sebuah
                    video tentang pemasaran
                    yang menggunakan
                    teknologi, misal pemasaran
                    pada Amazon.com, Alibaba,
                    Lazada, shopee, Tokopedia,
                    bukalapak, dan lain-lain.
                </p>
                <p>
                    Secara etimologi, kewirausahaan
                    berasal dari kata wira dan usaha. Wira berarti
                    peluang, pahlawan, manusia unggul, teladan,
                    berbudi luhur, gagah berani, dan berwatak
                    agung. Sedangkan menurut Kamus Besar
                    Bahasa Indonesia, wirausaha adalah orang
                    yang pandai atau berbakat mengenali produk
                    baru, menentukan cara produksi baru,
                    menyusun operasi untuk mengadakan produk
                    baru, mengatur permodalan operasinya, serta
                    memasarkannya (Rusdiana, 2014).

                </p>
                <p>
                    Wirausaha adalah orang yang
                    mendirikan, mengelola, mengembangkan dan
                    melembagakan perusahaan miliknya atau
                    kemampuan yang dimiliki oleh seseorang untuk
                    melihat dan menilai kesempatan-kesempatan
                    bisnis, mengumpulkan sumber daya- sumber
                    daya yang dibutuhkan untuk mengambil
                    tindakan yang tepat dan mengmbil keuntungn
                    dalam rangka meraih sukses (Sukamdani, 2013). Menurut Zimmerer dan Scrbrough, wirausahawan adalah
                    orang yang
                    menciptakan bisnis baru dengan mengambil risiko dan ketidakpastian demi
                    mencapai keuntungan dan pertumbuhan dengan cara mengidentifikasi peluang dan
                    menggabungkan sumber daya yang diperlukan (Fahmi, 2014).
                </p>
                <p>
                    Kewirausahaan adalah suatu ilmu yang mengkaji tentang pengembangan
                    dan pembangunan semangat kreatifitas serta berani menanggung risiko terhadap
                    pekerjaan yang dilakukan demi mewujudkan hasil karya tersebut (Fahmi, 2014).
                    Keberanian mengambil risiko sudah menjadi milik seorang wirausahawan karena
                    dituntut untuk berani dan siap jika usaha yang dilakukan tersebut belum mmeiliki
                    nilai perhatian dipasar. Peran dari seorang wirausaha menurut Suryana memiliki
                    dua peran yaitu sebagai penemu dan sebagai perencana. Sebagai penemu
                    wirausaha menemukan dan menciptakan produk baru, teknologi dan cara baru, ideide

                    baru dan organisasi usaha baru. Sebagai perencana, wirausaha berperan
                    merancang usaha baru, merencakan strategi perusahaan baru, merencakan ideide dan
                    peluang
                    dalam
                    perusahaan.

                </p>
                <p>
                    Peter F. Drucker menjelaskan konsep kewirausahaan merujuk pada sifat,
                    watak, dan ciri-ciri yang melekat pada seseorang yang mempunyai kemauan keras
                    untuk mewujudkan gagasan inovatif ke dalam dunia usaha yang nyata dan dapat
                    mengembangkannya dengan tangguh. Dan menurut Zimmerer kewirausahaan
                    adalah penerapan kreativitas dan inovasi untuk memecahkan masalah dan upaya
                    memanfaatkan peluang yang dihadapi setiap hari.
                </p>
                <p>
                    Kewirausahaan merupakan gabungan dari kreativitas, inovasi dan
                    keberanian menghadapi resiko yang dilakukan dengan cara kerja keras untuk
                    membentuk dan memelihara usaha baru (Suryana, 2014). Nilai-nilai hakiki
                    kewirausahaan menurut Suryana (2014) yaitu:

                </p>
                <ol type="a">
                    <li>Percaya diri <br>
                        Merupakan suatu paduan sikap dan kenyakinan seseorang dalam
                        menghadapi tugas atau pekerjaan. Kepercayaan diri merupakan landasan
                        yang kuat untuk meningkatkan karsa dan karya seseorang. Orang yang
                        percaya diri memiliki kemampuan untuk menyelesaikan pekerjaan dengan
                        sistematis, berencana, efektif, dan efisien. Seperti percaya diri dalam
                        menentukan sesuatu, percaya diri dalam menjalankan sesuatu, percaya diri
                        bahwa kita dapat mengatasi berbagai risiko yang dihadapi merupakan
                        faktor yang mendasar yang harus dimiliki oleh wirausaha. Seseorang yang
                        memiliki jiwa wirausaha merasa yakin bahwa apa-apa yang diperbuatnya
                        akan berhasil walaupun akan menghadapi berbagai rintangan. Tidak selalu dihantui rasa takut akan
                        kegagalan sehingga membuat dirinya optimis untuk
                        terus maju. </li>
                    <li>Kepemimpinan <br>
                        Sifat kepemimpinan memang ada dalam diri masing- masing individu dan
                        sifat tersebut juga harus melekat pada diri wirausahawan. Wirausahawan
                        adalah seseorang yang akan memimpin jalannya sebuah usaha,
                        wirausahawan harus bisa memimpin pekerjaannya karena kepemimpinan
                        merupakan faktor kunci menjadi wirausahawan sukses.
                    </li>
                    <li>Berorientasi ke masa depan <br>
                        Orang yang berorientasi ke masa depan adalah orang yang memiliki
                        perspektif dan pandangan ke masa depan. Meskipun terdapat resiko yang
                        mungkin terjadi, ia tetap tabah untuk mencari peluang dan tantangan demi
                        pembaharuan masa depan. Pandangan yang jauh ke depan membuat
                        wirausahawan tidak cepat puas dengan karsa dan karya yang sudah ada
                        saat ini.
                    </li>
                    <li>
                        Berani mengambil resiko <br>
                        Kemauan dan kemampuan untuk menghadapi risiko merupakan salah satu
                        nilai utama dalam kewirausahaan. wirausahawan yang tidak mau
                        menghadapi risiko akan sukar memulai atau berinisiatif. Menurut Angelita
                        S. Bajaro, seorang wirausahawan yang berani menanggung resiko adalah
                        orang yang selalu ingin jadi pemenang dan memenangkan dengan cara
                        yang baik.
                    </li>
                    <li>Keorisinalitas (kreativitas dan inovasi)
                        <br> Kreativitas adalah kemampuan untuk berpikir yang baru dan berbeda,
                        sedangkan inovasi adalah kemampuan untuk bertindak yang baru dan
                        berbeda. Menurut Hardvards Theodore Levitt menjelaskan inovasi dan
                        kreativitas lebih mengarah pada konsep berpikir dan bertindak yang baru.
                        Kreatifitas adalah kemampuan menciptakan gagasan dan menemukan cara
                        baru dalam melihat permasalahan dan peluang yang ada. Sementara
                        inovasi adalah kemampuan mengaplikasikan solusi yang kreatif terhadap
                        permasalahan dan peluang yang ada untuk lebih memakmurkan kehidupan
                        masyarakat. Jadi, kreativitas adalah kemampuan menciptakan gagasan
                        baru, sedangkan inovasi adalah melakukan sesuatu yang baru.

                    </li>
                    <li>Berorientasi pada tugas dan hasil.
                        <br> Seseorang yang selalu mengutamakan tugas dan hasil adalah orang yang
                        selalu mengutamakan nilai-nilai motif berprestasi, berorientasi pada
                        keberhasilan, ketekunan dan ketabahan, tekad kerja keras, mempunyai
                        dorongan kuat, energik, dan berinisiatif. Berinisiatif artinya selalu ingin
                        mencari dan memulai. Dalam kewirausahaan, peluang hanya diperoleh
                        apabila terdapat inisiatif. Perilaku inisiatif ini biasanya diperoleh melalui
                        pelatihan dan pengalaman selama bertahun-tahun, dan pengembangannya
                        diperoleh dengan cara disiplin diri, berpikir kritis, tanggap dan semangat
                        berprestasi (Suryana, 2014).
                        <br> Wirausaha berbasis sejarah penting untuk dikembangkan karena telah
                        dibuktikan oleh beberapa orang jika dengan mengembangkan wirausaha
                        berbasis sejarah seseorang dapat meraih kesuksesan (Mursal dkk, 2022).
                        Seorang wirausaha berbasis sejarah adalah seseorang yang dapat menjual
                        produk berdasarkan penelitian sejarah dan memiliki jiwa kewirausahaan.
                    </li>
                </ol>
            </div>
        </div>

    </div>
    <div class="materi-c" id="lembar-analisa-kelompok-1">


        <div class="row">
            <div class="col">
                <h2>Lembar Analisis Kelompok</h2>
                <p class="text-lg">AKTIVITAS 1</p>
                <p class="text-sm">1 JP x @ 50 menit = 50 menit</p>
                <p class="mt-2 text-lg">DESKRIPSIKANLAH PERSPEKTIF KALIAN TERHADAP PERMASALAHAN
                    BERIKUT!
                </p>
                <p>Perkembangan teknologi semakin hari semakin bertambah canggih. Dengan
                    ditemukannya berbagai macam jenis software atau aplikasi serta pemrograman internet,
                    membawa pengaruh yang sangat besar terhadap isu perdagangan dan pemasaran dari
                    strategi offline ke startegi berbasis online. Pemasaran Online atau bisa disebut juga dengan
                    Digital Marketing merupakan teknik pemasaran terkini dengan menggunakan internet sebagai
                    sumber utamanya. Selain bisa menjangkau ke seluruh dunia, pemasaran online bisa dilakukan
                    hanya di depan komputer dan tentunya memerlukan strategi-strategi terstentu untuk bisa
                    menyukseskan proses pemasarannya.
                </p>
                <p>Strategi-startegi yang bisa dilakukan dalam pemasaran berbasis online dapat
                    menggunakan berbagai macam software, aplikasi atau program, baik yang disedikan secara
                    organik (gratis) maupun anorganik (berbayar). Saat ini tersedia berbagai macam platform
                    aplikasi yang dapat digunakan sebagai media atau tools untuk meningkatkan strategi
                    pemasaran, diantaranya SEO, SEM, Social media marketing (Facebook, Instagram,
                    whatsapp, twitter, dan lain-lain), PPC, dan Afiliate marketing. </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h3 class="text-center">PENGALAMAN BERBELANJA PADA SITUS e-COMMERCE</h3>
                <ol>
                    <li class="mt-3"><label for="">Pengalaman yang didapat:</label> <br> <textarea name="" id=""
                            rows="5"></textarea></li>
                    <li class="mt-3"><label for="">Kelebihan berbelanja melalu situs <i>e-commerce</i></label> <br>
                        <textarea name="" id="" rows="5"></textarea></li>
                    <li class="mt-3"><label for="">Kekurangan belanja melalui situs <i>e-commerce</i></label> <br>
                        <textarea name="" id="" rows="5"></textarea></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="materi-c" id="lembar-analisa-kelompok-2">


        <div class="row">
            <div class="col">
                <h3>LEMBAR ANALISA KELOMPOK</h3>
                <p class="text-lg">AKTIVITAS 2</p>
                <p class="text-sm">1 JP x @ 50 menit = 50 menit</p>
                <p class="mt-2 text-lg">LAKUKAN ANALISA TERHADAP PERMASALAHAN BERIKUT!</p>

                <label for="" class="mt-4">Jenis-jenis teknologi yang berpengaruh terhadap dunia pemasaran produkproduk
                    yang berkaitan dengan kewirausahaan kesejarahan:
                </label> <br> <textarea name="" id="" rows="5"></textarea>
                <label for="" class="mt-4">Bagaimana pengaruh teknologi tersebut terhadap proses pemasaran kewirausahaan
                    kesejarahan: </label> <br> <textarea name="" id="" rows="5"></textarea>
                <label for="" class="mt-4">Kelebihan dan kekurangan penggunaan teknologi dalam proses pemasaran
                    kewirausahaan kesejarahan:</label> <br> <textarea name="" id="" rows="5"></textarea>
                <label for="" class="mt-4">Analisislah kondisi proses pemasaran sebelum dan sesudah ditemukannya
                    teknologi khususnya platform pemasaran digital: </label> <br> <textarea name="" id=""
                    rows="5"></textarea>

            </div>
        </div>
    </div>

    <div class="materi-c" id="lembar-diskusi-kelompok">


        <div class="row">
            <div class="col">
                <h3>LEMBAR DISKUSI KELOMPOK</h3>
                <p class="text-lg">AKTIVITAS 3</p>
                <p class="text-sm">2 JP x @ 50 menit = 100 menit</p>
                <p class="mt-2">Berdasarkan materi yang disampaikan oleh pakar, diskusikanlah materi tersebut
                    dengan menguraikan perspektif kalian dalam bentuk ringkasan dan peta konsep
                    terkait pemasaran kewirausahaan kesejarahan!
                </p>
                <p><b>RINGKASAN DAN PETA KONSEP PEMASARAN KEWIRAUSAHAAN KESEJARAHAN </b></p>

                <label for="" class="mt-4">Hasil analisa kelompok :
                </label> <br> <textarea name="" id="" rows="5"></textarea>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <h3>RUBRIK HASIL ANALISA</h3>
                <ol>
                    <li><b>KATEGORI 1</b><br>Jika hasil analisa mengambarkan
                        jawaban yang tidak lengkap, tidak
                        terstruktur dan tidak tepat sasaran </li>
                    <li class="mt-3"><b>KATEGORI 2</b><br>Jika hasil analisa mengambarkan
                        jawaban yang cukup lengkap, cukup
                        terstruktur dan cukup tepat sasaran </li>
                    <li class="mt-3"><b>KATEGORI 3</b><br>Jika hasil analisa mengambarkan
                        jawaban yang lengkap, terstruktur dan
                        tepat sasaran </li>
                    <li class="mt-3"><b>KATEGORI 4</b><br>Jika hasil analisa mengambarkan
                        jawaban yang sangat lengkap, sangat
                        terstruktur dan sangat tepat sasaran </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="materi-c" id="lembar-proyek-individu">



        <div class="row">
            <div class="col">
                <h3>LEMBAR PROYEK INDIVIDU</h3>
                <p class="text-lg">AKTIVITAS 4</p>
                <p class="text-sm">4 JP x @ 50 menit = 200 menit </p>

                <p class="mt-4"><b>MERANCANG PRODUK DAN JASA TERKAIT KEWIRAUSAHAAN KESEJARAHAN BERDASARKAN KONSEP
                        KEWIRAUSAHAAN </b></p>
                <p>Wirausahawan merupakan seorang individu yang memiliki semangat,
                    kemampuan, dan pikiran untuk menaklukkan cara berpikir yang lambat dan
                    malas. Seorang wirausahawan adalah seorang inovator yang memiliki naluri
                    untuk melihat peluang yang ada. Seorang wirausahawan akan mencari
                    kombinasi baru yang menggabungkan lima hal: barang dan jasa baru, teknik
                    produksi baru, sumber bahan baku baru, pasar baru, dan organisasi industri
                    baru. Sementara itu, orang-orang yang mampu melihat ke depan, berpikir
                    rasional, dan menemukan solusi atas berbagai masalah akan menjadi seorang wirausahawan yang sukses
                    (Ratumbusyang, 2017)
                </p>
                <p>Untuk menjadi wirausahawan yang sukses, mahasiswa harus mampu
                    membuka peluang bisnis, tanggap terhadap orang lain dan menjalin hubungan
                    antar wirausaha. Sebagai upaya menekan angka pengangguran, perlu
                    diciptakan peluang-peluang usaha baru, salah satunya di bidang
                    kewirausahaan kesejarahan.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="kotak bg-warning-subtle">
                    Pada aktivitas ini, kalian membuat business plan produk dan jasa terkait
                    kewirausahaan kesejarahan. Kalian diminta untuk bekerja sambil belajar secara
                    individu untuk membuat business plan tersebut.
                    Kalian bebas menyusun, merancang dan mengatur proyek yang kalian kerjakan.
                </div>
                <p class="mt-4 text-center text-lg"><b>Hal yang akan kalian lakukan: </b></p>
                <ol class="mt-3">
                    <li>Pelajari buku ajar dengan seksama;</li>
                    <li>Pada bagian penentuan proyek, kalian akan menentukan proyek yang sesuai dengan isi wacana;</li>
                    <li>Pada bagian perancangan proyek, kalian menyusun Langkah-langkah untuk menyelesaikan proyek;</li>
                    <li>Pada bagian penyusunan jadwal proyek, kalian harus Menyusun jadwal untuk memperkirakan awal
                        pelaksanaan hingga selesai;</li>
                    <li>Pada bagian penyelesaian proyek dan monitoring dosen, kalian mengisi form monitoring
                        keterlaksanaan jadwal penyelesaian proyek yang sebelumnya telah disepakati;</li>
                    <li>Pada bagian penyusunan dan presentasi proyek, kalian mempresentasikan proyek yang telah dibuat.
                    </li>
                    <li>Pada bagian evaluasi proses dan hasil proyek, kalian menjawab pertanyaan pada kolom yang telah
                        disediakan mengenai proyek yang telah dikerjakan.</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-lg">LENGKAPILAH KOLOM DI BAWAH INI!</p>
                <p class="text-center"><b>Rancangan/Desain Proyek</b></p>
                <p>Rancangan produk dan jasa yang dibuat harus berkaitan dengan kewirausahaan
                    kesejarahan, boleh berupa produk, boleh berupa jasa, yang berpeluang dipasarkan di
                    Kawasan sekitar wisata sejarah di daerah kalian.</p>
                <label for="" class="mt-3">Produk/Jasa yang akan dirancang</label>
                <textarea name="" id="" rows="5"></textarea>
                <label for="" class="mt-3">Analisa produk/jasa yang digunakan:</label>
                <textarea name="" id="" rows="5"></textarea>
                <hr>
                <p class="text-center"><b>Perencanaan Proyek</b></p>
                <p>Tuliskan Langkah kerja untuk merancang proyek dan jasa, dimulai dari membuat
                    business plan.
                </p>
                <label for="" class="mt-3">Langkah kerja:</label>
                <textarea name="" id="" rows="5"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-lg text-center mt-4"><b>Penyusunan Jadwal Pelaksanaan Proyek</b></p>
                <p>Susunlah jadwal penyelesaian proyek tersebut. Setelah itu tunjukkan pada dosen kalian agar diberikan
                    persetujuan pembuatan proyek tersebut. </p>
                <p class="text-center"><i>=== Tabel Rincian Jadwal Kegiatan Proyek ===</i></p>
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Rincian Kegiatan</td>
                            <td>Keterangan</td>
                            <td>Waktu Pelaksanaan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-lg text-center mt-4"><b>Penyelesaian Proyek dan Monitoring</b></p>
                <p>Setelah jadwal disusun dan disetujui, selanjutnya yaitu mengisi form monitoring proyek berikut.</p>
                <p class="mt-3 text-center">
                    <i>Daftar Checklist Monitoring Proyek</i>
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <td rowspan="2">No</td>
                            <td rowspan="2">Jenis Kegiatan</td>
                            <td colspan="2">Keterangan</td>
                        </tr>
                        <tr>
                            <td>Sudah</td>
                            <td>Sudah</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><b>Persiapan</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Masing-masing anggota kelompok mendapat tugas sesuai bagiannya</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Membuat rencana penyelesaian proyek</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Membuat jadwal penyelesaian proyek</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Menuliskan alat dan bahan yang digunakan</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Menuliskan cara kerja yang akan dilaksanakn</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><b>Pelaksanaan</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pembagian tugas secara merata kepada anggota kelompok</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Proyek terlaksana sesuai dengan rencana yang dibuat</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Proyek selesai sesuai jadwal yang telah dirancang</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><b>Presentasi</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Peralatan presentasi</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Produk memiliki nilai jual atau manfaat</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-center text-lg mt-3">
                    <b>Penyusunan dan Presentasi Proyek</b>
                </p>
                <p class="text-center">Sekarang tugas kalian adalah mempresentasikan proyek yang telah kalian buat</p>

                <p class="text-center text-lg mt-3">
                    <b>Evaluasi Proses dan Hasil Proyek</b>
                </p>

                <ol>
                    <li class="mt-3"><label for="">Bagaimana pendapat kalian tentang hasil proyek yang telah kalian
                            buat</label> <br> <textarea name="" id="" rows="5"></textarea></li>
                    <li class="mt-3"><label for="">Apa yang bisa Anda lakukan agar proyek Anda menjadi lebih baik atau
                            lebih sempurna</label> <br> <textarea name="" id="" rows="5"></textarea></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-lg">
                    <b>Belajar Karakter Berwirausaha</b>
                </p>

                <p><b>Persiapan</b></p>
                <ol>
                    <li>Mahasiswa menentukan topik berwirausaha yang berkarakter dan
                        dampak dari COVID 19 di berbagai sektor yang berhubungan dengan
                        ekonomi.</li>
                    <li>Mempersiapan tempat dan sound system oleh panitia.</li>
                    <li>Mempersiapkan 2 narasumber tokoh wirausahawan lokal untuk
                        berbagi mengenai Wirausaha Yang Bertanggung JawabPokok materi
                        yang disampaikan adalah :
                        <ol type="a">
                            <li>Pengalaman mulai berwiraswasta.</li>
                            <li>Alasan kenapa memilih bisnis tersebut.</li>
                            <li>Bagaimana permasalahan dan peluang yang timbul dari bisnis
                                tersebut.</li>
                            <li>Karakter Wirausahawan.</li>
                            <li>Dampak COVID 19 terhadap perekonomian</li>
                            <li>Motivasi peserta didik</li>
                        </ol>
                    </li>
                </ol>
                <p><b>Pelaksanaan</b></p>
                <ol>
                    <li>Mahasiswa membuat dokumen jurnal belajar.</li>
                    <li>Mahasiswa memfasilitasi sebagai Moderator dan Pewara Acara.</li>
                    <li>Peserta didik mendengarkan dan secara aktif didorong untuk aktif
                        menggali informasi dari narasumber.</li>
                    <li>Peserta didik diberikan tugas dengan mencatat rangkuman informasi
                        yang telah disampaikan narasumber selama acara berlangsung.</li>
                    <li>Peserta didik diberikan tugas dengan mencatat rangkuman informasi
                        yang telah disampaikan narasumber selama acara berlangsung.</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-lg"><b>Orasi "Jika Aku Menjadi?"</b></p>
                <p><b>Deskripsi</b></p>
                <p>Seorang wirausahawan harus memiliki karakter yang visioner. Dalam
                    menumbuhkan karakter tersebut, peserta didik diberikan kesempatannya
                    untuk menyusun visi dan misinya ketika berkeinginan menjadi seorang
                    pengusaha. Dengan diberikan tenggat waktu, peserta didik dituntut untuk
                    menuangkan visi dan misinya secara spontan sehingga diharapkan peserta
                    didik berani mengutarakan visi dan misinya serta memahami salah satu
                    karakter wirausahawan.
                </p>
                <p><b>Persiapan</b></p>
                <ol>
                    <li>Peserta didik diminta mempersiapkan alat tulis dan secarik kertas.
                    </li>
                    <li>Mahasiswa mempersiapkan pertanyaan yang harus dijawab oleh rekan
                        lainnya:
                        <ol type="a">
                            <li>Jika kamu memiliki modal dan menjadi seorang wirausahawan, kamu
                                ingin menjadi pengusaha apa?
                            </li>
                            <li>Kalau kamu sudah menentukan menjadi pengusaha apa, maka apa visi
                                dan misimu menjadi seorang pengusaha? </li>
                        </ol>
                    </li>

                </ol>
                <p><b>Pelaksanaan</b></p>
                <ol>
                    <li>Peserta didik diberikan pertanyaan yang telah disiapkan.</li>
                    <li>Peserta diminta menjawab pertanyaan tersebut di secarik kertas dengan
                        tenggat waktu 15 menit.</li>
                    <li>Meminta audien maju ke depan berorasi tentang visi dan misinya ketika
                        menjadi wirausahawan.</li>
                    <li>Memberikan refleksi singkat dan mengijikan teman-temannya untuk
                        bertanya.</li>
                    <li>Peserta didik diajak untuk meneriakkan “Aku ingin menjadi Pengusaha
                        ............. Aku pasti sukses!” Secara bersamaan.</li>
                </ol>
                <p>Hasil karya dan Cara Berorasi di depan umum pada kegiatan ini bukan
                    menjadi pokok pembelajaran, namun memperlihatkan kecepatan, dan
                    kemandiriannya dalam menentukan visi dan misinya sendiri untuk menjadi
                    seorang wirausahawan.</p>
            </div>
        </div>
    </div>
    <div class="materi-c" id="refleksi-1">


        <div class="row">
            <div class="col">
                <h3>REFLEKSI</h3>
                <p>Setelah mempelajari buku ajar ini, bagaimana pemahaman kalian terhadap materi?

                    Isilah penilaian diri ini dengan sejujur-jujurnya dan sebenar-benarnya sesuai dengan
                    perasaan kalian ketika mengerjakan suplemen bahan materi ini! Bubuhkanlah tanda centang
                    (√) pada salah satu gambar yang dapat mewakili perasaan kalian setelah mempelajari materi
                    ini!</p>
                <!-- emoticon -->
                <div class="icon-radio">
                    <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-laugh-beam"></i></label>
                    <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-smile"></i></label>
                    <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-grin-beam-sweat"></i></label>
                    <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-sad-cry"></i></label>
                    <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-dizzy"></i></label>
                </div>
                <p><b>Jawablah pertanyaan berikut!</b></p>
                <ol>
                    <li class="mt-3"><label for="">Apa yang sudah kalian pelajari?</label> <br> <textarea name="" id=""
                            rows="5"></textarea></li>
                    <li class="mt-3"><label for="">Apa yang kalian kuasai dari materi ini?</label> <br> <textarea
                            name="" id="" rows="5"></textarea></li>
                    <li class="mt-3"><label for="">Bagian apa yang belum kalian kuasai?</label> <br> <textarea name=""
                            id="" rows="5"></textarea></li>
                    <li class="mt-3"><label for="">Apa upaya kalian untuk menguasai yang belum kalian kuasai?</label>
                        <br> <textarea name="" id="" rows="5"></textarea></li>
                </ol>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <h3>RUBRIK HASIL ANALISA</h3>
                <ol>
                    <li><b>KATEGORI 1</b><br>Jika hasil analisa mengambarkan jawaban
                        yang tidak lengkap, tidak terstruktur dan
                        tidak tepat sasaran </li>
                    <li class="mt-3"><b>KATEGORI 2</b><br>Jika hasil analisa mengambarkan jawaban
                        yang cukup lengkap, cukup terstruktur dan
                        cukup tepat sasaran </li>
                    <li class="mt-3"><b>KATEGORI 3</b><br>Jika hasil analisa mengambarkan jawaban
                        yang lengkap, terstruktur dan tepat sasaran </li>
                    <li class="mt-3"><b>KATEGORI 4</b><br>Jika hasil analisa mengambarkan jawaban
                        yang sangat lengkap, sangat terstruktur dan
                        sangat tepat sasaran </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row materi-c" id="praktik-lapangan-1">
        <div class="col">
            <h3>Praktik Lapangan 1</h3>
            <p class="text-lg">AKTIVITAS 5</p>
            <p class="text-sm">2 JP x @ 50 menit = 100 menit</p>
            <p>Produk dan jasa yang telah kalian rancang, akan disimulasikan pada pertemuan ini.
                Simulasikanlah dengan teman-teman di kelas kalian terlebih dahulu sebelum dipraktikkan ke
                lingkup yang lebih luas. Tulislah saran dari teman-teman di kelas terkait Produk dan jasa
                yang sudah kalian jual kepada mereka.</p>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Silahkan kumpulkan tugas anda!</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
        </div>
    </div>
    <div class="row materi-c" id="praktik-lapangan-2">
        <div class="col">
            <h3>Praktik Lapangan 2</h3>
            <p class="text-lg">AKTIVITAS 6</p>
            <p class="text-sm">2 JP x @ 50 menit = 100 menit</p>
            <p>Pada pertemuan kali ini, saatnya kalian menjual produk dan jasa terkait kewirausahaan
                kesejarahan yang telah kalian rancang kepada lingkup yang lebih luas, seperti masyarakat
                umum, teman di luar kelas/fakultas, teman di luar universitas, pengguna sosial media, dan lainlain.
                Tulislah produk dan yang berhasil kalian jual beserta jumlahnya.
            </p>

            <div class="mb-3">
                <label for="formFile" class="form-label">Silahkan kumpulkan tugas anda!</label>
                <input class="form-control" type="file" id="formFile">
            </div>

            <p class="text-lg text-center"><b>Lampiran tabel jumlah produk dan jasa yang terjual</b></p>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <td>No</td>
                        <td>Nama Konsumen</td>
                        <td>Jumlah</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row materi-c" id="refleksi-2">
        <div class="col">
            <h3>REFLEKSI</h3>
            <p>Setelah mempelajari buku ajar ini, bagaimana pemahaman kalian terhadap materi?

                Isilah penilaian diri ini dengan sejujur-jujurnya dan sebenar- benarnya sesuai dengan
                perasaan kalian ketika mengerjakan suplemen bahan materi ini! Bubuhkanlah tanda centang
                (√) pada salah satu gambar yang dapat mewakili perasaan kalian setelah mempelajari materi
                ini! </p>
            <!-- emoticon -->
            <div class="icon-radio">
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-laugh-beam"></i></label>
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-smile"></i></label>
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-grin-beam-sweat"></i></label>
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-sad-cry"></i></label>
                <label><input type="radio" name="icon" /> <i class="fa-solid fa-face-dizzy"></i></label>
            </div>
            <p><b>Jawablah pertanyaan berikut!</b></p>
            <ol>
                <li class="mt-3"><label for="">Apa yang sudah kalian pelajari?</label> <br> <textarea name="" id=""
                        rows="5"></textarea></li>
                <li class="mt-3"><label for="">Apa yang kalian kuasai dari materi ini?</label> <br> <textarea name=""
                        id="" rows="5"></textarea></li>
                <li class="mt-3"><label for="">Bagian apa yang belum kalian kuasai?</label> <br> <textarea name="" id=""
                        rows="5"></textarea></li>
                <li class="mt-3"><label for="">Apa upaya kalian untuk menguasai yang belum kalian kuasai?</label> <br>
                    <textarea name="" id="" rows="5"></textarea></li>
            </ol>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
    // Mengambil semua class sub
    const materi_a = document.getElementsByClassName('materi-a');

    // Navigasi Soal
    var $sub = 0;
    var $progress = 0;

    // Hide semua bab
    function hide_semua_sub(){
        for(let i=0;i<=6;i++){
            // console.log(materi_a[i])
            materi_a[i].style.display = 'none';
        }
    }
    hide_semua_sub();
    
    // Menampilkan sub
    function show_sub($no){
        materi_a[$no].style.display = 'block';
    }
    // show_sub($sub);

    // Show Sub by Session
    const halaman_saat_ini = document.getElementById('halaman_saat_ini').innerHTML;
    console.log(halaman_saat_ini);
    document.getElementById(halaman_saat_ini).style.display = 'block'

    // Navigasi tombol
    function nav_tombol(){
        if($sub == 6){
            document.getElementById('next').disabled = true;
        }else if($sub == 0){
            document.getElementById('prev').disabled = true;
        }else{
            document.getElementById('prev').disabled = false;
            document.getElementById('next').disabled = false;
        }
    }
    nav_tombol();

    // Status Bar
    
    const status_bar = document.getElementById('status_bar');
    function update_status(){
        let persen = $progress * 16.66666667;
        status_bar.style.width = `${persen}%`;
    }

    // Testing
    // console.log(materi_a)
    
    function next(){
        console.log('Selanjutnya',$sub)
        hide_semua_sub();
        $sub++;
        if($sub > $progress){
            $progress++; 
        }      
        show_sub($sub);
        nav_tombol()
        update_status()
    }
    
    function prev(){
        console.log('Sebelumnya',$sub)
        hide_semua_sub();
        $sub--;
        show_sub($sub);
        nav_tombol()
    }

</script>

@endsection