<?php
// database/seeders/UnitPageSettingSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class UnitPageSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero Section
            [
                'key'   => 'hero_image',
                'value' => 'assets/img/headerunit.jpg',
                'type'  => 'image',
            ],
            [
                'key'   => 'hero_line_1',
                'value' => 'Temukan Sudut Favorit',
                'type'  => 'text',
            ],
            [
                'key'   => 'hero_line_2',
                'value' => 'Hunian Impianmu',
                'type'  => 'text',
            ],
            [
                'key'   => 'hero_desc',
                'value' => 'Ruang untuk bernafas, ruang untuk hidup — hadirkan ketenangan di setiap sudut hunian Anda.',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'hero_tag',
                'value' => 'Bale Hinggil Apartment',
                'type'  => 'text',
            ],

            // Counting Section
            [
                'key'   => 'counting_image',
                'value' => 'assets/img/headerunit.jpg',
                'type'  => 'image',
            ],
            [
                'key'   => 'counting_desc',
                'value' => 'Bale Hinggil hadir bukan sekadar tempat tinggal — melainkan ruang di mana setiap pagi terasa lebih hangat, setiap pulang terasa lebih berarti.',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'counting_title_1',
                'value' => 'Rumah Nyaman,',
                'type'  => 'text',
            ],
            [
                'key'   => 'counting_title_2',
                'value' => 'Investasi Masa Depan',
                'type'  => 'text',
            ],
            [
                'key'   => 'stat_floors',
                'value' => '31',
                'type'  => 'text',
            ],
            [
                'key'   => 'stat_units',
                'value' => '200',
                'type'  => 'text',
            ],
            [
                'key'   => 'stat_security',
                'value' => '24',
                'type'  => 'text',
            ],
            [
                'key'   => 'family_count',
                'value' => '150',
                'type'  => 'text',
            ],

            // Promo Section
            [
                'key'   => 'promo_images',
                'value' => json_encode([
                    'assets/img/promo.jpg',
                    'assets/img/promo.jpg',
                    'assets/img/promo.jpg',
                ]),
                'type'  => 'json',
            ],
            [
                'key'   => 'promo_title',
                'value' => 'Harga Spesial Early Bird',
                'type'  => 'text',
            ],
            [
                'key'   => 'promo_subtitle',
                'value' => 'Penawaran terbatas — hubungi kami untuk info lebih lanjut',
                'type'  => 'text',
            ],
            [
                'key'   => 'promo_badge',
                'value' => 'Penawaran Terbatas',
                'type'  => 'text',
            ],

            // Unit Section
            [
                'key'   => 'unit_section_title_1',
                'value' => 'Pilih Tipe Unit yang',
                'type'  => 'text',
            ],
            [
                'key'   => 'unit_section_title_2',
                'value' => 'Sesuai Gaya Hidup Anda',
                'type'  => 'text',
            ],
            [
                'key'   => 'unit_section_desc',
                'value' => 'Setiap sudut dirancang dengan cermat — dari Studio kompak hingga 3BR yang lapang, semua tersedia untuk melengkapi ritme hidup Anda.',
                'type'  => 'textarea',
            ],
            [
                'key'   => 'unit_section_badge',
                'value' => 'Pilihan Unit',
                'type'  => 'text',
            ],

            // Video Section
            [
                'key'   => 'main_video',
                'value' => 'assets/video/tipeunitvideo.mp4',
                'type'  => 'video',
            ],
            [
                'key'   => 'video_title',
                'value' => 'Bale Hinggil Experience',
                'type'  => 'text',
            ],
            [
                'key'   => 'video_subtitle',
                'value' => 'Cinematic Tour',
                'type'  => 'text',
            ],

            // Gallery Section
            [
                'key'   => 'gallery_title',
                'value' => 'Lihat Lebih Dekat',
                'type'  => 'text',
            ],
            [
                'key'   => 'gallery_badge',
                'value' => 'Galeri',
                'type'  => 'text',
            ],

            // Contact
            [
                'key'   => 'whatsapp_number',
                'value' => '6282334466773',
                'type'  => 'text',
            ],
            [
                'key'   => 'whatsapp_message',
                'value' => 'Halo, saya tertarik dengan unit di Bale Hinggil Apartment',
                'type'  => 'text',
            ],

            // Rental / Booking
            [
                'key'   => 'rental_url',
                'value' => 'https://dev.hotelify.id',
                'type'  => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type'  => $setting['type'],
                ]
            );
        }

        $this->command->info('Unit page settings seeded successfully!');
    }
}