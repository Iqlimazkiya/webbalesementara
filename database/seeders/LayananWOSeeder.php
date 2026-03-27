<?php

namespace Database\Seeders;

use App\Models\LayananWO;
use Illuminate\Database\Seeder;

class LayananWOSeeder extends Seeder
{
    public function run(): void
    {
        LayananWO::truncate();

        LayananWO::create([
            'title'       => 'Working Order',
            'description' => 'Layanan perbaikan teknis unit apartemen Bale Hinggil. Satu laporan, langsung ditangani oleh teknisi berpengalaman dan bersertifikasi.',

            'foto_carousel_1' => 'assets/img/promo.jpg',
            'foto_carousel_2' => 'assets/img/promo.jpg',
            'foto_carousel_3' => 'assets/img/promo.jpg',
            'foto_carousel_4' => 'assets/img/promo.jpg',
            'foto_slide_1'    => 'assets/img/promo.jpg',
            'foto_slide_2'    => 'assets/img/promo.jpg',
            'foto_slide_3'    => 'assets/img/promo.jpg',

            'tarif_listrik' => [
                ['jenis' => 'Ganti Stop Kontak / Saklar',   'kondisi' => 'Ringan', 'tarif' => 'Rp 75.000',  'petugas' => '1 org', 'durasi' => '30-60 mnt'],
                ['jenis' => 'Pemasangan Lampu / Fitting',   'kondisi' => 'Ringan', 'tarif' => 'Rp 50.000',  'petugas' => '1 org', 'durasi' => '30 mnt'],
                ['jenis' => 'Perbaikan MCB / Sekring Trip', 'kondisi' => 'Sedang', 'tarif' => 'Rp 100.000', 'petugas' => '1 org', 'durasi' => '1-2 jam'],
                ['jenis' => 'Instalasi Kabel Baru',         'kondisi' => 'Berat',  'tarif' => 'Rp 250.000', 'petugas' => '2 org', 'durasi' => '2-4 jam'],
                ['jenis' => 'Perbaikan AC (kelistrikan)',   'kondisi' => 'Sedang', 'tarif' => 'Rp 150.000', 'petugas' => '1 org', 'durasi' => '1-3 jam'],
            ],

            'tarif_plumbing' => [
                ['jenis' => 'Saluran Air Mampet',           'kondisi' => 'Ringan', 'tarif' => 'Rp 100.000', 'petugas' => '1 org', 'durasi' => '1 jam'],
                ['jenis' => 'Kran Bocor / Ganti Kran',      'kondisi' => 'Ringan', 'tarif' => 'Rp 80.000',  'petugas' => '1 org', 'durasi' => '30-60 mnt'],
                ['jenis' => 'Flush Toilet Tidak Berfungsi', 'kondisi' => 'Sedang', 'tarif' => 'Rp 120.000', 'petugas' => '1 org', 'durasi' => '1-2 jam'],
                ['jenis' => 'Shower Bocor / Rusak',         'kondisi' => 'Ringan', 'tarif' => 'Rp 90.000',  'petugas' => '1 org', 'durasi' => '1 jam'],
                ['jenis' => 'Pipa Bocor',                   'kondisi' => 'Berat',  'tarif' => 'Rp 200.000', 'petugas' => '2 org', 'durasi' => '2-3 jam'],
            ],

            'tarif_umum' => [
                ['jenis' => 'Ganti Engsel / Kunci Pintu', 'kondisi' => 'Ringan', 'tarif' => 'Rp 60.000',  'petugas' => '1 org', 'durasi' => '30 mnt'],
                ['jenis' => 'Perbaikan Plafon Bocor',     'kondisi' => 'Sedang', 'tarif' => 'Rp 150.000', 'petugas' => '1 org', 'durasi' => '2-3 jam'],
                ['jenis' => 'Cat Ulang Dinding (per m2)', 'kondisi' => 'Ringan', 'tarif' => 'Rp 40.000',  'petugas' => '1 org', 'durasi' => 'Sesuai luas'],
                ['jenis' => 'Perbaikan Lantai Keramik',   'kondisi' => 'Sedang', 'tarif' => 'Rp 120.000', 'petugas' => '1 org', 'durasi' => '1-2 jam'],
                ['jenis' => 'Perbaikan Jendela / Rel',    'kondisi' => 'Ringan', 'tarif' => 'Rp 80.000',  'petugas' => '1 org', 'durasi' => '30-60 mnt'],
            ],

            'ketentuan' => [
                'Pekerjaan hanya dilakukan oleh teknisi resmi Bale Hinggil yang bersertifikasi.',
                'Biaya di atas belum termasuk material/suku cadang - akan diinformasikan sebelum pengerjaan.',
                'Pemesanan minimal 1 hari sebelumnya melalui petugas atau aplikasi.',
                'Garansi pekerjaan 7 hari sejak tanggal penyelesaian.',
                'Teknisi berhak menolak pekerjaan yang berisiko terhadap keselamatan atau di luar cakupan layanan.',
            ],

            'is_active' => true,
        ]);
    }
}