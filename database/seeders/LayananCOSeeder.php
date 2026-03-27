<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananCO;

class LayananCOSeeder extends Seeder
{
    public function run(): void
    {
        LayananCO::truncate();

        $base = 'assets/img';

        LayananCO::create([
            'title'       => 'Cleaning Order',
            'description' => 'Percayakan kebersihan unit Anda kepada tim profesional kami — terlatih, bersertifikasi, dan hadir tepat waktu.',

            'foto_hero'  => $base . '/promo.jpg',

            // Slideshow promo — JSON array, tambah sebanyak yang diinginkan
            'foto_slide' => [
                $base . '/promo.jpg',
                $base . '/promo.jpg',
                $base . '/promo.jpg',
            ],

            // Galeri — JSON array, isi path foto hasil kerja sebanyak yang diinginkan
            'foto_galeri' => [
                $base . '/promo.jpg',
                $base . '/promo.jpg',
                $base . '/promo.jpg',
            ],

            'tarif_cleaning' => [
                ['type' => 'Studio',    'kondisi' => 'A — Tanpa Furniture', 'tarif' => 'Rp 100.000', 'petugas' => '1 Orang', 'durasi' => '1,5 Jam'],
                ['type' => 'Studio',    'kondisi' => 'B — Full Furniture',  'tarif' => 'Rp 120.000', 'petugas' => '1 Orang', 'durasi' => '2 Jam'],
                ['type' => '2 Bedroom', 'kondisi' => 'A — Tanpa Furniture', 'tarif' => 'Rp 130.000', 'petugas' => '1 Orang', 'durasi' => '2 Jam'],
                ['type' => '2 Bedroom', 'kondisi' => 'B — Full Furniture',  'tarif' => 'Rp 170.000', 'petugas' => '2 Orang', 'durasi' => '2,5 Jam'],
                ['type' => '3 Bedroom', 'kondisi' => 'A — Tanpa Furniture', 'tarif' => 'Rp 150.000', 'petugas' => '1 Orang', 'durasi' => '2,5 Jam'],
                ['type' => '3 Bedroom', 'kondisi' => 'B — Full Furniture',  'tarif' => 'Rp 200.000', 'petugas' => '2 Orang', 'durasi' => '3 Jam'],
            ],

            'tarif_cuci' => [
                ['nama' => 'Cuci Kasur 180×200',  'satuan' => '/pcs', 'tarif' => 'Rp 300.000', 'durasi' => '± 4–5 Jam'],
                ['nama' => 'Cuci Kasur 160×200',  'satuan' => '/pcs', 'tarif' => 'Rp 250.000', 'durasi' => '± 4–5 Jam'],
                ['nama' => 'Cuci Kasur 120×200',  'satuan' => '/pcs', 'tarif' => 'Rp 225.000', 'durasi' => '± 4–5 Jam'],
                ['nama' => 'Cuci Kasur 100×200',  'satuan' => '/pcs', 'tarif' => 'Rp 225.000', 'durasi' => '± 4–5 Jam'],
                ['nama' => 'Cuci Sofa Bed Lipat', 'satuan' => '/pcs', 'tarif' => 'Rp 250.000', 'durasi' => '± 4–5 Jam'],
                ['nama' => 'Cuci Sofa Jumbo',     'satuan' => '/pcs', 'tarif' => 'Rp 200.000', 'durasi' => '± 2–3 Jam'],
                ['nama' => 'Cuci Sofa Standar',   'satuan' => '/pcs', 'tarif' => 'Rp 150.000', 'durasi' => '± 2–3 Jam'],
                ['nama' => 'Cuci Kursi Kantor',   'satuan' => '/pcs', 'tarif' => 'Rp 125.000', 'durasi' => '± 2–3 Jam'],
                ['nama' => 'Cuci Karpet Biasa',   'satuan' => '/m²',  'tarif' => 'Rp 75.000',  'durasi' => '± 2–3 Jam'],
            ],

            'tarif_tambahan' => [
                ['area' => 'Toilet',                'tarif' => 'Rp 50.000',  'petugas' => '1 Orang', 'durasi' => '45 Mnt'],
                ['area' => 'Kitchen Set',           'tarif' => 'Rp 50.000',  'petugas' => '1 Orang', 'durasi' => '45 Mnt'],
                ['area' => 'Balkon & Jendela Kaca', 'tarif' => 'Rp 50.000',  'petugas' => '1 Orang', 'durasi' => '45 Mnt'],
                ['area' => '@ 1 BR',                'tarif' => 'Rp 50.000',  'petugas' => '1 Orang', 'durasi' => '45 Mnt'],
                ['area' => '@ 2 BR',                'tarif' => 'Rp 75.000',  'petugas' => '1 Orang', 'durasi' => '1 Jam'],
                ['area' => '@ 3 BR',                'tarif' => 'Rp 110.000', 'petugas' => '1 Orang', 'durasi' => '1,5 Jam'],
            ],

            'tarif_berkala' => [],

            'ketentuan' => [
                'Pemesanan di Resident Relation Lobby 1A Tower A & B',
                'Pekerjaan dilakukan setelah pembayaran lunas di kasir BM Lobby 1B Tower B',
                'Penambahan jam dikenakan biaya Rp 30.000/jam',
                'Biaya sudah termasuk peralatan, bahan chemical, tenaga kerja & supervisor',
                'Cuci sofa, bed & karpet dikerjakan di luar unit dengan mesin pengering (blower)',
                'Titip kunci ke Resident Relation — pastikan barang berharga sudah tersimpan',
                'Sampah wajib dibungkus kantong plastik di tempat sampah sebelum petugas datang',
                'Petugas hanya berkewajiban membersihkan dan merapikan dalam unit, serta membuang sampah yang ada di tempat sampah',
            ],

            'is_active' => true,
        ]);
    }
}