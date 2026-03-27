<?php

namespace Database\Seeders;

use App\Models\LayananDI;
use Illuminate\Database\Seeder;

class LayananDISeeder extends Seeder
{
    public function run(): void
    {
        LayananDI::updateOrCreate([], [
            'title'       => 'Design Interior',
            'description' => 'Layanan desain dan renovasi interior unit apartemen Bale Hinggil. 
            Dari konsultasi, visualisasi 3D, hingga eksekusi renovasi — satu tim, satu pintu.',
            'foto_carousel_1' => 'assets/img/promo.jpg',
            'foto_carousel_2' => 'assets/img/promo.jpg',
            'foto_carousel_3' => 'assets/img/promo.jpg',
            'foto_carousel_4' => 'assets/img/promo.jpg',
            'foto_slide_1'    => 'assets/img/promo.jpg',
            'foto_slide_2'    => 'assets/img/promo.jpg',
            'foto_slide_3'    => 'assets/img/promo.jpg',

            'tarif_konsultasi' => [
                ['jenis' => 'Konsultasi Awal (online)', 'kondisi' => 'Gratis',   'tarif' => 'Gratis',      'petugas' => '1 desainer', 'durasi' => '30 mnt'],
                ['jenis' => 'Konsultasi On-site Unit',  'kondisi' => 'Berbayar', 'tarif' => 'Rp 200.000', 'petugas' => '1 desainer', 'durasi' => '1–2 jam'],
                ['jenis' => 'Konsultasi + Mood Board',  'kondisi' => 'Berbayar', 'tarif' => 'Rp 350.000', 'petugas' => '1 desainer', 'durasi' => '2–3 jam'],
            ],

            'tarif_desain' => [
                ['jenis' => 'Denah 2D (per ruangan)',       'kondisi' => 'Standar', 'tarif' => 'Rp 300.000',   'petugas' => '1 desainer', 'durasi' => '2–3 hari'],
                ['jenis' => 'Visualisasi 3D (per ruangan)', 'kondisi' => 'Standar', 'tarif' => 'Rp 500.000',   'petugas' => '1 desainer', 'durasi' => '3–5 hari'],
                ['jenis' => 'Desain Full Unit (studio)',    'kondisi' => 'Lengkap', 'tarif' => 'Rp 1.500.000', 'petugas' => '2 desainer', 'durasi' => '5–7 hari'],
                ['jenis' => 'Desain Full Unit (1BR)',       'kondisi' => 'Lengkap', 'tarif' => 'Rp 2.500.000', 'petugas' => '2 desainer', 'durasi' => '7–10 hari'],
            ],

            'tarif_renovasi' => [
                ['jenis' => 'Renovasi Kamar Mandi',         'kondisi' => 'Sedang', 'tarif' => 'Rp 5.000.000',  'petugas' => '3 org', 'durasi' => '5–7 hari'],
                ['jenis' => 'Renovasi Dapur (kitchen set)', 'kondisi' => 'Sedang', 'tarif' => 'Rp 8.000.000',  'petugas' => '3 org', 'durasi' => '7–10 hari'],
                ['jenis' => 'Pemasangan Wallpaper',         'kondisi' => 'Ringan', 'tarif' => 'Rp 80.000/m²',  'petugas' => '1 org', 'durasi' => '1–2 hari'],
                ['jenis' => 'Pemasangan Vinyl / Parket',    'kondisi' => 'Ringan', 'tarif' => 'Rp 120.000/m²', 'petugas' => '2 org', 'durasi' => '1–3 hari'],
                ['jenis' => 'Renovasi Total Studio',        'kondisi' => 'Berat',  'tarif' => 'Hubungi Kami',  'petugas' => 'Tim',   'durasi' => 'Sesuai scope'],
            ],

            'ketentuan' => [
                'Konsultasi online gratis, namun tidak termasuk pembuatan dokumen desain.',
                'Biaya konsultasi on-site akan dikreditkan jika berlanjut ke proyek desain.',
                'Revisi desain maksimal 2 kali per fase tanpa biaya tambahan.',
                'Pengerjaan renovasi hanya dilakukan oleh kontraktor rekanan resmi Bale Hinggil.',
                'Jadwal pengerjaan harus dikonfirmasi minimal 3 hari sebelumnya.',
                'Penghuni bertanggung jawab memindahkan barang pribadi sebelum renovasi dimulai.',
            ],

            'is_active' => true,
        ]);
    }
}