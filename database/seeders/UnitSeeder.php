<?php
// database/seeders/UnitSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        Unit::query()->delete();

        $units = [
            [
                'nama_tipe'         => 'Studio',
                'subtitle'          => 'Elegant & Modern',
                'luas_unit'         => '25 m²',
                'kapasitas'         => '1-2 Orang',
                'tower'             => 'A & B',
                'view'              => 'City',
                'order'             => 1,
                'deskripsi'         => 'Unit studio dengan desain modern yang mengutamakan efisiensi ruang tanpa mengurangi kenyamanan. Dirancang dengan tata letak yang fungsional, pencahayaan alami yang maksimal, serta sentuhan interior elegan yang menciptakan suasana hunian yang hangat dan berkelas.',
                'deskripsi_singkat' => 'Cocok untuk pelajar, mahasiswa, atau professional muda yang aktif dan penuh semangat.',
                'fasilitas'         => [
                    'Entrance',
                    'Bathroom',
                    'Kitchen',
                    'Bedroom',
                    'Workspace',
                    'Balcony',
                ],
                'foto_card'    => 'assets/img/headerunit.jpg',
                'foto_3d'      => 'assets/img/3dstudio.png',
                'galeri_foto'  => [
                    'assets/img/headerunit.jpg',
                    'assets/img/logohijau.png',
                    'assets/img/berita1.jpg',
                    'assets/img/berita2.jpg',
                    'assets/img/headerunit.jpg',
                    'assets/img/headerunit.jpg',
                ],
            ],
            [
                'nama_tipe'         => '2 BR',
                'subtitle'          => 'Elegant & Modern',
                'luas_unit'         => '44 m²',
                'kapasitas'         => '1-3 Orang',
                'tower'             => 'A & B',
                'view'              => 'City',
                'order'             => 2,
                'deskripsi'         => 'Unit dua kamar tidur yang dirancang untuk menghadirkan keseimbangan sempurna antara ruang pribadi dan ruang kebersamaan. Dengan desain interior yang elegan serta ruang yang lebih luas, hunian ini memberikan kenyamanan maksimal bagi Anda dan keluarga.',
                'deskripsi_singkat' => 'Pilihan terbaik untuk pasangan muda yang mendambakan kenyamanan & keamanan sang buah hati.',
                'fasilitas'         => [
                    'Entrance',
                    'Bathroom',
                    'Kitchen',
                    'Bedroom A',
                    'Bedroom B',
                    'Living Room',
                    'Workspace',
                    'Balcony',
                ],
                'foto_card'    => 'assets/img/headerunit.jpg',
                'foto_3d'      => 'assets/img/3d2br.png',
                'galeri_foto'  => [
                    'assets/img/headerunit.jpg',
                    'assets/img/logohijau.png',
                    'assets/img/berita1.jpg',
                    'assets/img/berita2.jpg',
                    'assets/img/headerunit.jpg',
                    'assets/img/headerunit.jpg',
                ],
            ],
            [
                'nama_tipe'         => '3 BR',
                'subtitle'          => 'Elegant & Modern',
                'luas_unit'         => '64 m²',
                'kapasitas'         => '1-5 Orang',
                'tower'             => 'A & B',
                'view'              => 'City',
                'order'             => 3,
                'deskripsi'         => 'Unit tiga kamar tidur dengan ruang yang luas dan tata letak yang dirancang untuk menghadirkan kenyamanan keluarga secara maksimal. Nikmati suasana hunian premium dengan pemandangan kota yang memukau, ruang yang lapang, serta fasilitas lengkap setara hotel bintang lima.',
                'deskripsi_singkat' => 'Untuk anda yang mendambakan hunian luas dan mewah.',
                'fasilitas'         => [
                    'Entrance',
                    'Bathroom',
                    'Kitchen',
                    'Bedroom A',
                    'Bedroom B',
                    'Bedroom C',
                    'Living Room',
                    'Workspace',
                    'Balcony',
                ],
                'foto_card'    => 'assets/img/headerunit.jpg',
                'foto_3d'      => 'assets/img/3d3br.png',
                'galeri_foto'  => [
                    'assets/img/headerunit.jpg',
                    'assets/img/logohijau.png',
                    'assets/img/berita1.jpg',
                    'assets/img/berita2.jpg',
                    'assets/img/headerunit.jpg',
                    'assets/img/headerunit.jpg',
                ],
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }

        $this->command->info('Units seeded successfully!');
    }
}