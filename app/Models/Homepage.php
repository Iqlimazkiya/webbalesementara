<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $table = 'homepage';

    protected $fillable = [
        'hero_video', 'hero_teks_baris1', 'hero_teks_baris2', 'hero_teks_baris3',
        'hero_subjudul', 'hero_btn1_teks', 'hero_btn1_link', 'hero_btn2_teks', 'hero_btn2_nomor',
        'about_foto', 'about_review_rating', 'about_review_jumlah', 'about_review_link',
        'about_judul', 'about_deskripsi', 'about_visi_judul', 'about_visi_isi',
        'about_misi_judul', 'about_misi_items',
        'fasilitas_judul1', 'fasilitas_judul2', 'fasilitas_deskripsi', 'fasilitas_items',
        'lokasi_tag', 'lokasi_judul1', 'lokasi_judul2', 'lokasi_gmaps_embed',
        'lokasi_nama_gedung', 'lokasi_alamat_lengkap', 'lokasi_akses_items',
        'layanan_tag', 'layanan_judul', 'layanan_deskripsi', 'layanan_buttons',
        'berita_tag', 'berita_judul1', 'berita_judul2', 'berita_link_semua',
        'berita_yt_items',       
        'berita_artikel_items',  
        'kontak_judul', 'kontak_telepon',
        'kontak_jam_items', 'kontak_divisi_items', 'kontak_sosmed_items',
    ];

    protected $casts = [
        'about_misi_items'      => 'array',
        'fasilitas_items'       => 'array',
        'lokasi_akses_items'    => 'array',
        'layanan_buttons'       => 'array',
        'berita_yt_items'       => 'array',
        'berita_artikel_items'  => 'array',
        'kontak_jam_items'      => 'array',
        'kontak_divisi_items'   => 'array',
        'kontak_sosmed_items'   => 'array',
    ];
}