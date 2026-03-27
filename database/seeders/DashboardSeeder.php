<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('visitors')->truncate();
        $startOfWeek = $now->copy()->startOfWeek(Carbon::MONDAY);
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            DB::table('visitors')->insert([
                'visit_date'  => $date->format('Y-m-d'),
                'hour'        => rand(8, 22),
                'day_of_week' => $date->dayOfWeek,
                'week_of_year'=> $date->weekOfYear,
                'month'       => $date->month,
                'year'        => $date->year,
                'count'       => rand(20, 120),
                'created_at'  => $date,
                'updated_at'  => $date,
            ]);
        }

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($now->year, $month, 15);
            DB::table('visitors')->insert([
                'visit_date'  => $date->format('Y-m-d'),
                'hour'        => 12,
                'day_of_week' => $date->dayOfWeek,
                'week_of_year'=> $date->weekOfYear,
                'month'       => $month,
                'year'        => $now->year,
                'count'       => rand(800, 3000),
                'created_at'  => $date,
                'updated_at'  => $date,
            ]);
        }

        DB::table('cta_clicks')->truncate();
        for ($i = 0; $i < 47; $i++) {
            DB::table('cta_clicks')->insert([
                'ip_address' => '192.168.1.' . rand(1, 254),
                'user_agent' => 'Mozilla/5.0 (seed)',
                'clicked_at' => $now->copy()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('contact_messages')->truncate();
        $unitIds = DB::table('units')->pluck('id')->toArray();
        $names    = ['Budi Santoso', 'Siti Rahayu', 'Ahmad Fauzi', 'Dewi Lestari', 'Raka Pratama'];
        $messages = [
            'Halo, saya tertarik dengan unit Studio. Bisa info harga dan cicilan?',
            'Saya ingin tahu lebih lanjut tentang fasilitas unit 2BR.',
            'Apakah bisa survey unit hari Sabtu?',
            'Ada promo apa saja bulan ini untuk unit 3BR?',
            'Berapa DP minimal untuk unit 2BR?',
        ];
        $divisis = ['Pengelola', 'Developer'];
        foreach ($names as $idx => $name) {
            DB::table('contact_messages')->insert([
                'unit_id'    => $unitIds[array_rand($unitIds)],
                'name'       => $name,
                'email'      => strtolower(explode(' ', $name)[0]) . '@email.com',
                'divisi'     => $divisis[array_rand($divisis)],
                'message'    => $messages[$idx],
                'is_read'    => $idx < 2,
                'created_at' => $now->copy()->subDays(rand(0, 14)),
                'updated_at' => now(),
            ]);
        }

        DB::table('activities')->truncate();
        $activities = [
            ['Unit Studio diperbarui',        'Deskripsi dan fasilitas diupdate',           5],
            ['Halaman Tipe Unit diperbarui',   'Hero image dan teks CTA diubah',             60],
            ['Pesan masuk dibaca',             'Pesan dari "Budi Santoso" sudah dibaca',     180],
            ['Unit 2BR diperbarui',            'Foto card dan galeri foto diganti',          300],
            ['Pengaturan website diperbarui',  'Nomor WhatsApp dan deskripsi CTA diubah',   480],
            ['Unit baru ditambahkan',          'Tipe "3BR" (70 m²) berhasil ditambahkan',   1440],
            ['Pesan masuk dihapus',            'Pesan dari "Ahmad Fauzi" dihapus',          2880],
        ];
        foreach ($activities as [$desc, $detail, $minsAgo]) {
            DB::table('activities')->insert([
                'description' => $desc,
                'details'     => $detail,
                'user_id'     => null,
                'ip_address'  => '127.0.0.1',
                'user_agent'  => 'Seeder',
                'created_at'  => $now->copy()->subMinutes($minsAgo),
                'updated_at'  => $now->copy()->subMinutes($minsAgo),
            ]);
        }

        $this->command->info('DashboardSeeder selesai: Visitor, CtaClicks, ContactMessages, Activities.');
    }
}