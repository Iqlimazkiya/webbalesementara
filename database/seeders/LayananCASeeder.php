<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananCA;

class LayananCASeeder extends Seeder
{
    public function run(): void
    {
        LayananCA::create([
            'hero_badge'        => 'Commercial Area',
            'hero_title'        => 'Balehinggil',
            'hero_subtitle'     => 'Creative & Business Hub',
            'hero_tagline'      => 'One Space, Unlimited Possibilities',
            'hero_description'  => 'Satu kawasan multifungsi untuk bisnis & event.',
            'whatsapp_number'   => '6282334466773',
            'cta_title'         => 'Wujudkan Event',
            'cta_subtitle'      => 'Impian Anda',
            'cta_description'   => 'Hubungi kami sekarang!',
            'is_active'         => true,
        ]);
    }
}