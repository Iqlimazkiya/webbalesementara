<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomePage;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        HomePage::truncate();

        HomePage::create([
            // hero
            'hero_video'       => null,
            'hero_teks_baris1' => 'Welcome to',
            'hero_teks_baris2' => 'Bale Hinggil',
            'hero_teks_baris3' => 'Apartment',
            'hero_subjudul'    => 'Apartemen 31 lantai yang dirancang dengan konsep adequate apartment dengan arti ketersediaan pelayanan, fasilitas, dan infrastruktur.',
            'hero_btn1_teks'   => 'Jelajahi Unit',
            'hero_btn1_link'   => '/tipe-unit',
            'hero_btn2_teks'   => 'Hubungi Kami',
            'hero_btn2_nomor'  => '6282334466773',

            // tentang kami
            'about_foto'          => null,
            'about_review_rating' => '3,6',
            'about_review_jumlah' => '383 Reviews on Google',
            'about_review_link'   => 'https://maps.app.goo.gl/fzwcm3bDCPijTe1X9',
            'about_judul'         => 'Who Are We?',
            'about_deskripsi'     => 'PT Tlatah Gema Anugrah merupakan salah satu perusahaan properti di pusat kota Surabaya yang didirikan pada tahun 2009 oleh Ir. Hengky Budiharto.',
            'about_visi_judul'    => 'Visi',
            'about_visi_isi'      => 'Menjadi Perusahaan Properti yang terpercaya di Indonesia.',
            'about_misi_judul'    => 'Misi',
            'about_misi_items'    => json_encode([
                'Mengembangkan peluang bisnis properti di Indonesia',
                'Bersinergi dalam mendayagunakan aset properti investasi',
                'Memberikan manfaat optimal kepada pemegang saham',
            ]),

            // fasilitas
            'fasilitas_judul1'    => 'Hidup Lebih dari',
            'fasilitas_judul2'    => 'Sekadar Hunian',
            'fasilitas_deskripsi' => 'Fasilitas yang tersedia dirancang untuk menghadirkan rasa nyaman dalam setiap aktivitas.',
            'fasilitas_items'     => json_encode([
                ['judul' => 'Swimming Pool', 'keterangan' => 'Kolam renang modern untuk relaksasi dan olahraga penghuni.', 'foto' => ''],
                ['judul' => 'Gym',           'keterangan' => 'Fasilitas gym lengkap untuk menunjang gaya hidup sehat Anda.',  'foto' => ''],
                ['judul' => 'Playground',    'keterangan' => 'Area bermain anak yang aman dan nyaman untuk aktivitas keluarga.', 'foto' => ''],
            ]),

            // lokasi
            'lokasi_tag'            => 'LOKASI',
            'lokasi_judul1'         => 'Strategis di Jantung',
            'lokasi_judul2'         => 'Surabaya Timur',
            'lokasi_gmaps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.3915759719225!2d112.77882707431479!3d-7.309830771868249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7faf4046567bd%3A0x53447890bfbd91bc!2sApartemen%20Bale%20Hinggil!5e0!3m2!1sid!2sid!4v1774510063999!5m2!1sid!2sid" class="absolute inset-0 w-full h-full border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'lokasi_nama_gedung'    => 'Apartement Bale Hinggil',
            'lokasi_alamat_lengkap' => 'Jl. Dr. Ir. H. Soekarno Jl. Medokan Semampir Indah No.63, Medokan Semampir, Kec. Sukolilo, Surabaya, Jawa Timur 60119',
            'lokasi_akses_items'    => json_encode([
                ['nama' => 'Galaxy Mall 3',                      'waktu' => '± 5 menit'],
                ['nama' => 'RS. Gotong Royong',                  'waktu' => '± 8 menit'],
                ['nama' => 'Institut Teknologi Sepuluh November', 'waktu' => '± 8 menit'],
                ['nama' => 'Universitas Airlangga',              'waktu' => '± 12 menit'],
                ['nama' => 'Juanda Int. Airport',                'waktu' => '± 25 menit'],
            ]),

            // layanan
            'layanan_tag'       => 'OUR SERVICES',
            'layanan_judul'     => 'Layanan',
            'layanan_deskripsi' => 'Menghadirkan layanan eksklusif yang mendukung gaya hidup modern Anda. Setiap layanan dirancang untuk kenyamanan dan kepuasan Anda.',
            'layanan_buttons' => json_encode([
    ['teks' => 'Working Order',    'link' => '/layanan-wo'],
    ['teks' => 'Cleaning Order',   'link' => '/layanan-co'],
    ['teks' => 'Comersial Area',   'link' => '/layanan-ca'],
    ['teks' => 'Sewa & Titip Unit','link' => '/layanan-su'],
    ['teks' => 'Penjualan',        'link' => '/layanan-pj'],
    ['teks' => 'Design Interior',  'link' => '/layanan-di'],
]),

            // berita
            'berita_tag'        => 'BERITA',
            'berita_judul1'     => 'Update Terkini',
            'berita_judul2'     => 'Bale Hinggil',
            'berita_link_semua' => '/berita',
            'berita_yt_items'   => json_encode([
                ['url' => 'https://www.youtube.com/watch?v=-DDtu27BCK0', 'tanggal' => '24 Feb 2025', 'durasi' => '7 menit',  'judul' => 'Bale Hinggil Apartement', 'deskripsi' => 'Mencari hunian yang tepat?? Baleh Hinggil Apartment solusinya, ...', 'channel' => 'Bale Hinggil Apartement', 'link' => 'https://youtu.be/-DDtu27BCK0'],
                ['url' => 'https://www.youtube.com/watch?v=k2yQLKPrhD0', 'tanggal' => '22 Okt 2019', 'durasi' => '3 menit',  'judul' => 'Bale Hinggil Apartement', 'deskripsi' => 'Simak Isi Apartemen Bale Hinggil, kami mengajak Anda melihat lebih dekat fasilitas dan...', 'channel' => 'Bale Hinggil', 'link' => 'https://youtu.be/k2yQLKPrhD0'],
                ['url' => 'https://www.youtube.com/watch?v=GzcH_QtoJjg', 'tanggal' => '3 Sep 2019',  'durasi' => '30 menit', 'judul' => 'Akses Jembatan ke Bale Hinggil', 'deskripsi' => 'Update progres jembatan akses yang menghubungkan langsung area Apartemen...', 'channel' => 'Bale Hinggil', 'link' => 'https://youtu.be/GzcH_QtoJjg'],
            ]),
            'berita_artikel_items' => json_encode([
                ['foto' => 'assets/img/berita3.jpg', 'tanggal' => '27 Feb 2025', 'jam' => '20.58 WIB', 'judul' => 'Konflik Penghuni dan Pengelola Apartemen Bale Hinggil Temui Titik Terang', 'ringkasan' => 'Konflik antara penghuni dan pengelola Apartemen Bale Hinggil Surabaya akhirnya...', 'penerbit' => 'Bicara Indonesia', 'link' => 'https://www.jawapos.com/surabaya-raya/015912193/ketegangan-di-apartemen-bale-hinggil-surabaya-manajemen-perkarakan-penghuni-menunggak'],
                ['foto' => 'assets/img/berita1.jpg', 'tanggal' => '23 April 2025', 'jam' => '17.51 WIB', 'judul' => 'Kasus Bale Hinggil Memanas, Pengelola Lapor Oknum ke Polda Jatim dengan Bukti CCTV', 'ringkasan' => 'Konflik internal pengelolaan Apartemen Bale Hinggil memasuki babak baru...', 'penerbit' => 'Jawa Pos', 'link' => 'https://www.jawapos.com/surabaya-raya/015917526/kasus-bale-hinggil-memanas-pengelola-lapor-oknum-ke-polda-jatim-dengan-bukti-cctv'],
                ['foto' => 'assets/img/berita2.jpg', 'tanggal' => '23 April 2025', 'jam' => '15.54 WIB', 'judul' => 'Manajemen Apartemen Bale Hinggil Bongkar Dugaan Sindikat Rusun', 'ringkasan' => 'Manajemen Apartemen Bale Hinggil bersama kuasa hukum resmi mengungkap...', 'penerbit' => 'Jawa Pos', 'link' => 'https://www.jawapos.com/nasional/015916922/manajemen-apartemen-bale-hinggil-bongkar-dugaan-sindikat-rusun'],
            ]),

            // kontak
            'kontak_judul'        => 'Informasi Kontak',
            'kontak_telepon'      => '0823-3446-6773',
            'kontak_jam_items'    => json_encode(['Senin – Jumat', '09.00 – 15.00 WIB', 'Sabtu', '09.00 – 12.00 WIB']),
            'kontak_divisi_items' => json_encode(['Pengelola', 'Developer']),
            'kontak_sosmed_items' => json_encode([
                ['icon' => 'bi-instagram', 'link' => 'https://www.instagram.com/balehinggil_apartement'],
                ['icon' => 'bi-tiktok',    'link' => 'https://www.tiktok.com/@balehinggil_apartement'],
                ['icon' => 'bi-youtube',   'link' => 'https://youtube.com/@balehinggil_apartement'],
            ]),
        ]);

        $this->command->info('HomePage seeded successfully!');
    }
}