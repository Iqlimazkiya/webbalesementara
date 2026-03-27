<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomepageUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Tambahkan auth check jika perlu
    }

    public function rules(): array
    {
        return [
            // Hero
            'hero_teks_baris1'  => 'nullable|string|max:200',
            'hero_teks_baris2'  => 'nullable|string|max:200',
            'hero_subjudul'     => 'nullable|string|max:300',
            'hero_teks_tombol'  => 'nullable|string|max:100',
            'hero_foto_hero'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',

            // About
            'about_judul'          => 'nullable|string|max:200',
            'about_subjudul'       => 'nullable|string|max:300',
            'about_deskripsi'      => 'nullable|string',
            'about_foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'about_tahun_berdiri'  => 'nullable|string|max:10',
            'about_jumlah_unit'    => 'nullable|string|max:20',
            'about_jumlah_penghuni' => 'nullable|string|max:20',

            // Fasilitas
            'fasilitas_judul'         => 'nullable|string|max:200',
            'fasilitas_subjudul'      => 'nullable|string|max:300',
            'fasilitas_items'         => 'nullable|array',
            'fasilitas_items.*.id'    => 'nullable|integer|exists:fasilitas_items,id',
            'fasilitas_items.*.nama'  => 'required_with:fasilitas_items|string|max:100',
            'fasilitas_items.*.deskripsi' => 'nullable|string|max:200',
            'fasilitas_items.*.icon'  => 'nullable|string|max:50',
            'fasilitas_items.*.foto'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'fasilitas_items.*.urutan' => 'nullable|integer|min:0',

            // Lokasi
            'lokasi_judul'          => 'nullable|string|max:200',
            'lokasi_subjudul'       => 'nullable|string|max:300',
            'lokasi_alamat_lengkap' => 'nullable|string',
            'lokasi_embed_maps_url' => 'nullable|string',
            'lokasi_keterangan_1'   => 'nullable|string|max:200',
            'lokasi_keterangan_2'   => 'nullable|string|max:200',
            'lokasi_keterangan_3'   => 'nullable|string|max:200',

            // Layanan
            'layanan_judul'         => 'nullable|string|max:200',
            'layanan_subjudul'      => 'nullable|string|max:300',
            'layanan_items'         => 'nullable|array',
            'layanan_items.*.id'    => 'nullable|integer|exists:layanan_items,id',
            'layanan_items.*.nama'  => 'required_with:layanan_items|string|max:100',
            'layanan_items.*.deskripsi' => 'nullable|string',
            'layanan_items.*.foto'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'layanan_items.*.urutan' => 'nullable|integer|min:0',

            // Berita
            'berita_judul'          => 'nullable|string|max:200',
            'berita_subjudul'       => 'nullable|string|max:300',
            'berita_items'          => 'nullable|array',
            'berita_items.*.id'     => 'nullable|integer|exists:berita_items,id',
            'berita_items.*.judul'  => 'required_with:berita_items|string|max:200',
            'berita_items.*.ringkasan'  => 'nullable|string',
            'berita_items.*.thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'berita_items.*.tanggal'    => 'nullable|date',
            'berita_items.*.slug'       => 'nullable|string|max:200',
            'berita_items.*.urutan'     => 'nullable|integer|min:0',

            // Kontak
            'kontak_judul'           => 'nullable|string|max:200',
            'kontak_subjudul'        => 'nullable|string|max:300',
            'kontak_nomor_telepon'   => 'nullable|string|max:50',
            'kontak_nomor_whatsapp'  => 'nullable|string|max:50',
            'kontak_email'           => 'nullable|email|max:200',
            'kontak_jam_operasional' => 'nullable|string|max:200',
            'kontak_instagram'       => 'nullable|url|max:500',
            'kontak_facebook'        => 'nullable|url|max:500',
        ];
    }

    public function attributes(): array
    {
        return [
            'hero_foto_hero'        => 'foto hero',
            'about_foto'            => 'foto about',
            'fasilitas_items.*.nama' => 'nama fasilitas',
            'layanan_items.*.nama'  => 'nama layanan',
            'berita_items.*.judul'  => 'judul berita',
            'kontak_email'          => 'email kontak',
            'kontak_instagram'      => 'URL Instagram',
            'kontak_facebook'       => 'URL Facebook',
        ];
    }
}