<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage', function (Blueprint $table) {
            $table->id();

            // hero
            $table->string('hero_video')->nullable();
            $table->string('hero_teks_baris1')->nullable();
            $table->string('hero_teks_baris2')->nullable();
            $table->string('hero_teks_baris3')->nullable();
            $table->text('hero_subjudul')->nullable();
            $table->string('hero_btn1_teks')->nullable();
            $table->string('hero_btn1_link')->nullable();
            $table->string('hero_btn2_teks')->nullable();
            $table->string('hero_btn2_nomor')->nullable();

            // about
            $table->string('about_foto')->nullable();
            $table->string('about_review_rating', 20)->nullable();
            $table->string('about_review_jumlah', 100)->nullable();
            $table->string('about_review_link')->nullable();
            $table->string('about_judul', 100)->nullable();
            $table->text('about_deskripsi')->nullable();
            $table->string('about_visi_judul', 100)->nullable();
            $table->text('about_visi_isi')->nullable();
            $table->string('about_misi_judul', 100)->nullable();
            $table->json('about_misi_items')->nullable();

            // fasilitas
            $table->string('fasilitas_judul1', 100)->nullable();
            $table->string('fasilitas_judul2', 100)->nullable();
            $table->text('fasilitas_deskripsi')->nullable();
            $table->json('fasilitas_items')->nullable();

            // lokasi
            $table->string('lokasi_tag', 50)->nullable();
            $table->string('lokasi_judul1', 100)->nullable();
            $table->string('lokasi_judul2', 100)->nullable();
            $table->text('lokasi_gmaps_embed')->nullable();
            $table->string('lokasi_nama_gedung', 150)->nullable();
            $table->text('lokasi_alamat_lengkap')->nullable();
            $table->json('lokasi_akses_items')->nullable();

            // layanan
            $table->string('layanan_tag', 50)->nullable();
            $table->string('layanan_judul', 100)->nullable();
            $table->text('layanan_deskripsi')->nullable();
            $table->json('layanan_buttons')->nullable();

            // berita
            $table->string('berita_tag', 50)->nullable();
            $table->string('berita_judul1', 100)->nullable();
            $table->string('berita_judul2', 100)->nullable();
            $table->string('berita_link_semua')->nullable();
            $table->json('berita_yt_items')->nullable();
            $table->json('berita_artikel_items')->nullable();

            // kontak
            $table->string('kontak_judul', 100)->nullable();
            $table->string('kontak_telepon', 30)->nullable();
            $table->json('kontak_jam_items')->nullable();
            $table->json('kontak_divisi_items')->nullable();
            $table->json('kontak_sosmed_items')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage');
    }
};