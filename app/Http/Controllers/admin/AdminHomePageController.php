<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\HomePage;

class AdminHomepageController extends Controller
{
    private array $fieldLabels = [
        'hero_judul'          => 'Judul hero',
        'hero_subjudul'       => 'Subjudul hero',
        'hero_deskripsi'      => 'Deskripsi hero',
        'about_judul'         => 'Judul about',
        'about_deskripsi'     => 'Deskripsi about',
        'layanan_judul'       => 'Judul section layanan',
        'layanan_deskripsi'   => 'Deskripsi section layanan',
        'fasilitas_judul'     => 'Judul section fasilitas',
        'fasilitas_deskripsi' => 'Deskripsi section fasilitas',
        'lokasi_judul'        => 'Judul section lokasi',
        'lokasi_alamat'       => 'Alamat',
        'lokasi_maps_url'     => 'URL Google Maps',
        'berita_judul'        => 'Judul section berita',
        'kontak_judul'        => 'Judul section kontak',
        'kontak_telepon'      => 'Nomor telepon',
        'kontak_email'        => 'Email kontak',
        'kontak_whatsapp'     => 'Nomor WhatsApp',
    ];

    private function adminName(): string
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->name;
    }

    public function index()
    {
        $hp = HomePage::first();
        return view('admin.halaman_home.index', compact('hp'));
    }

    public function edit()
    {
        $hp = HomePage::first();
        return view('admin.halaman_home.edit', compact('hp'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_video'      => 'nullable|file|mimes:mp4,webm,jpg,jpeg,png,webp|max:51200',
            'about_foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'layanan_foto_bg' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'fasilitas_foto.*'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'berita_foto.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $hp = HomePage::first();
        if (!$hp) {
            $hp = HomePage::create([]);
        }

        // ── Snapshot sebelum update ───────────────────────────────
        $before = $hp->toArray();
        $admin  = $this->adminName();
        $logs   = [];

        $data = $request->except(['_token', '_method']);
        if ($request->input('hero_video_clear') === '1' && !$request->hasFile('hero_video')) {
            if ($hp->hero_video) Storage::disk('public')->delete($hp->hero_video);
            $data['hero_video'] = null;
            $logs[] = 'Video/foto hero dihapus';
        } elseif ($request->hasFile('hero_video')) {
            if ($hp->hero_video) Storage::disk('public')->delete($hp->hero_video);
            $file = $request->file('hero_video');
            $isImage = str_starts_with($file->getMimeType(), 'image/');
            $folder = $isImage ? 'homepage/hero_image' : 'homepage/video';
            $data['hero_video'] = $file->store($folder, 'public');
            $logs[] = $isImage ? 'Gambar hero diperbarui' : 'Video hero diperbarui';
        } else {
            unset($data['hero_video']);
        }
        unset($data['hero_video_clear']);

        if ($request->hasFile('about_foto')) {
            if ($hp->about_foto) Storage::disk('public')->delete($hp->about_foto);
            $data['about_foto'] = $request->file('about_foto')->store('homepage/about', 'public');
            $logs[] = 'Foto about diperbarui';
        } else {
            unset($data['about_foto']);
        }

        if ($request->hasFile('layanan_foto_bg')) {
            if ($hp->layanan_foto_bg) Storage::disk('public')->delete($hp->layanan_foto_bg);
            $data['layanan_foto_bg'] = $request->file('layanan_foto_bg')->store('homepage/layanan', 'public');
            $logs[] = 'Foto background layanan diperbarui';
        } else {
            unset($data['layanan_foto_bg']);
        }

        if ($request->has('about_misi_items')) {
            $misiLama = is_array($hp->about_misi_items) ? $hp->about_misi_items : json_decode($hp->about_misi_items ?? '[]', true);
            $misiBaru = array_values(array_filter($request->input('about_misi_items', [])));
            $data['about_misi_items'] = json_encode($misiBaru);
            if (json_encode($misiLama) !== json_encode($misiBaru)) {
                $logs[] = 'Daftar misi diperbarui (' . count($misiLama) . ' → ' . count($misiBaru) . ' poin)';
            }
        }

        $fasJudul      = $request->input('fasilitas_judul', []);
        $fasKeterangan = $request->input('fasilitas_keterangan', []);
        $fasExisting   = $request->input('fasilitas_foto_existing', []);
        $fasFiles      = $request->file('fasilitas_foto', []);
        $fasItems      = [];
        $fasAdaFotoBaru = false;
        foreach ($fasJudul as $i => $judul) {
            $foto = $fasExisting[$i] ?? '';
            if (!empty($fasFiles[$i]) && $fasFiles[$i]->isValid()) {
                if ($foto) Storage::disk('public')->delete($foto);
                $foto = $fasFiles[$i]->store('homepage/fasilitas', 'public');
                $fasAdaFotoBaru = true;
            }
            $fasItems[] = [
                'judul'      => $judul,
                'keterangan' => $fasKeterangan[$i] ?? '',
                'foto'       => $foto,
            ];
        }
        $fasLama = is_array($hp->fasilitas_items) ? $hp->fasilitas_items : json_decode($hp->fasilitas_items ?? '[]', true);
        $data['fasilitas_items'] = json_encode($fasItems);
        unset($data['fasilitas_judul'], $data['fasilitas_keterangan'], $data['fasilitas_foto_existing']);
        if ($fasAdaFotoBaru) $logs[] = 'Foto fasilitas diperbarui';
        elseif (json_encode($fasLama) !== json_encode($fasItems)) {
            $logs[] = 'Konten fasilitas diperbarui (' . count($fasLama) . ' → ' . count($fasItems) . ' item)';
        }

        $aksesNama  = $request->input('akses_nama', []);
        $aksesWaktu = $request->input('akses_waktu', []);
        $aksesList  = [];
        foreach ($aksesNama as $i => $nama) {
            if (trim($nama) === '') continue;
            $aksesList[] = ['nama' => $nama, 'waktu' => $aksesWaktu[$i] ?? ''];
        }
        $aksesLama = is_array($hp->lokasi_akses_items) ? $hp->lokasi_akses_items : json_decode($hp->lokasi_akses_items ?? '[]', true);
        $data['lokasi_akses_items'] = json_encode($aksesList);
        unset($data['akses_nama'], $data['akses_waktu']);
        if (json_encode($aksesLama) !== json_encode($aksesList)) {
            $logs[] = 'Info akses lokasi diperbarui (' . count($aksesLama) . ' → ' . count($aksesList) . ' item)';
        }

        $btnTeks = $request->input('layanan_btn_teks', []);
        $btnLink = $request->input('layanan_btn_link', []);
        $btnList = [];
        foreach ($btnTeks as $i => $teks) {
            if (trim($teks) === '') continue;
            $btnList[] = ['teks' => $teks, 'link' => $btnLink[$i] ?? ''];
        }
        $btnLama = is_array($hp->layanan_buttons) ? $hp->layanan_buttons : json_decode($hp->layanan_buttons ?? '[]', true);
        $data['layanan_buttons'] = json_encode($btnList);
        unset($data['layanan_btn_teks'], $data['layanan_btn_link']);
        if (json_encode($btnLama) !== json_encode($btnList)) {
            $logs[] = 'Tombol layanan diperbarui (' . count($btnLama) . ' → ' . count($btnList) . ' tombol)';
        }

        $ytUrls      = $request->input('berita_yt_url',       []);
        $ytTanggals  = $request->input('berita_yt_tanggal',   []);
        $ytDurasis   = $request->input('berita_yt_durasi',    []);
        $ytJuduls    = $request->input('berita_yt_judul',     []);
        $ytDescs     = $request->input('berita_yt_deskripsi', []);
        $ytChannels  = $request->input('berita_yt_channel',   []);
        $ytLinks     = $request->input('berita_yt_link',      []);
        $ytItems = [];
        foreach ($ytUrls as $i => $url) {
            $ytItems[] = [
                'url'       => $url,
                'tanggal'   => $ytTanggals[$i]  ?? '',
                'durasi'    => $ytDurasis[$i]   ?? '',
                'judul'     => $ytJuduls[$i]    ?? '',
                'deskripsi' => $ytDescs[$i]     ?? '',
                'channel'   => $ytChannels[$i]  ?? '',
                'link'      => $ytLinks[$i]     ?? '',
            ];
        }
        $ytLama = is_array($hp->berita_yt_items) ? $hp->berita_yt_items : json_decode($hp->berita_yt_items ?? '[]', true);
        $data['berita_yt_items'] = json_encode($ytItems);
        foreach (['berita_yt_url','berita_yt_tanggal','berita_yt_durasi','berita_yt_judul',
                  'berita_yt_deskripsi','berita_yt_channel','berita_yt_link'] as $k) unset($data[$k]);
        if (json_encode($ytLama) !== json_encode($ytItems)) {
            $logs[] = 'Video YouTube berita diperbarui (' . count($ytLama) . ' → ' . count($ytItems) . ' video)';
        }

        $artFotos     = $request->file('berita_foto',      []);
        $artTanggals  = $request->input('berita_tanggal',  []);
        $artJams      = $request->input('berita_jam',      []);
        $artJuduls    = $request->input('berita_judul_item', []);
        $artRings     = $request->input('berita_ringkasan', []);
        $artPenerbit  = $request->input('berita_penerbit', []);
        $artLinks     = $request->input('berita_link_item', []);
        $existingArtikel = is_array($hp->berita_artikel_items) ? $hp->berita_artikel_items : [];
        $artItems = [];
        $artAdaFoto = false;
        for ($i = 0; $i < 3; $i++) {
            $fotoPath = $existingArtikel[$i]['foto'] ?? '';
            if (!empty($artFotos[$i]) && $artFotos[$i]->isValid()) {
                if ($fotoPath) Storage::disk('public')->delete($fotoPath);
                $fotoPath = $artFotos[$i]->store('homepage/berita', 'public');
                $artAdaFoto = true;
            }
            $artItems[] = [
                'foto'      => $fotoPath,
                'tanggal'   => $artTanggals[$i]  ?? '',
                'jam'       => $artJams[$i]       ?? '',
                'judul'     => $artJuduls[$i]     ?? '',
                'ringkasan' => $artRings[$i]      ?? '',
                'penerbit'  => $artPenerbit[$i]   ?? '',
                'link'      => $artLinks[$i]      ?? '',
            ];
        }
        $data['berita_artikel_items'] = json_encode($artItems);
        foreach (['berita_foto','berita_tanggal','berita_jam','berita_judul_item',
                  'berita_ringkasan','berita_penerbit','berita_link_item'] as $k) unset($data[$k]);
        if ($artAdaFoto) $logs[] = 'Foto artikel berita diperbarui';
        elseif (json_encode($existingArtikel) !== json_encode($artItems)) {
            $logs[] = 'Konten artikel berita diperbarui';
        }

        if ($request->has('kontak_jam_items')) {
            $jamLama = is_array($hp->kontak_jam_items) ? $hp->kontak_jam_items : json_decode($hp->kontak_jam_items ?? '[]', true);
            $jamBaru = array_values(array_filter($request->input('kontak_jam_items', [])));
            $data['kontak_jam_items'] = json_encode(
                array_values(array_filter($request->input('kontak_jam_items', [])))
            );
            if (json_encode($jamLama) !== json_encode($jamBaru)) {
                $logs[] = 'Jam operasional diperbarui (' . count($jamLama) . ' → ' . count($jamBaru) . ' item)';
            }
        }

        if ($request->has('kontak_divisi_items')) {
            $divisiLama = is_array($hp->kontak_divisi_items) ? $hp->kontak_divisi_items : json_decode($hp->kontak_divisi_items ?? '[]', true);
            $divisiBaru = array_values(array_filter($request->input('kontak_divisi_items', [])));
            $data['kontak_divisi_items'] = json_encode($divisiBaru);
            if (json_encode($divisiLama) !== json_encode($divisiBaru)) {
                $logs[] = 'Divisi kontak diperbarui (' . count($divisiLama) . ' → ' . count($divisiBaru) . ' divisi)';
            }
        }

        $sosmedIcon = $request->input('sosmed_icon', []);
        $sosmedLink = $request->input('sosmed_link', []);
        $sosmedList = [];
        foreach ($sosmedIcon as $i => $icon) {
            if (trim($icon) === '') continue;
            $sosmedList[] = ['icon' => $icon, 'link' => $sosmedLink[$i] ?? ''];
        }
        $sosmedLama = is_array($hp->kontak_sosmed_items) ? $hp->kontak_sosmed_items : json_decode($hp->kontak_sosmed_items ?? '[]', true);
        $data['kontak_sosmed_items'] = json_encode($sosmedList);
        unset($data['sosmed_icon'], $data['sosmed_link']);
        if (json_encode($sosmedLama) !== json_encode($sosmedList)) {
            $logs[] = 'Link media sosial diperbarui (' . count($sosmedLama) . ' → ' . count($sosmedList) . ' item)';
        }

        // ── Cek perubahan field teks biasa ────────────────────────
        foreach ($this->fieldLabels as $field => $label) {
            if (array_key_exists($field, $data) && isset($before[$field]) && (string)$before[$field] !== (string)$data[$field]) {
                $logs[] = $label . ' diubah';
            }
        }

        $hp->update($data);
        session()->forget('homepage_preview');

        // ── Tulis log aktivitas ───────────────────────────────────
        foreach ($logs as $log) {
            ActivityLogger::log(
                'Halaman Utama: ' . $log,
                'Admin ' . $admin . ' mengubah Halaman Utama — ' . $log . '.'
            );
        }

        return back()->with('success', 'Berhasil disimpan');
    }

    public function preview(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        if ($request->has('about_misi_items')) {
            $data['about_misi_items'] = json_encode(
                array_values(array_filter($request->input('about_misi_items', [])))
            );
        }
        if ($request->has('preview_img_prev_about_foto')) {
            $data['about_foto_preview'] = $request->input('preview_img_prev_about_foto');
        }
        $fasBase64 = $request->input('fasilitas_foto_base64', []);
        if (!empty($fasBase64)) {
            $existingFasItems = json_decode($data['fasilitas_items'] ?? '[]', true);
            foreach ($fasBase64 as $i => $b64) {
                if (!empty($b64) && isset($existingFasItems[$i])) {
                    $existingFasItems[$i]['foto_preview'] = $b64;
                }
            }
            $data['fasilitas_items'] = json_encode($existingFasItems);
        }

        $fasJudul      = $request->input('fasilitas_judul', []);
        $fasKeterangan = $request->input('fasilitas_keterangan', []);
        $fasItems      = [];
        foreach ($fasJudul as $i => $judul) {
            $fasItems[] = [
                'judul'      => $judul,
                'keterangan' => $fasKeterangan[$i] ?? '',
                'foto'       => $request->input('fasilitas_foto_existing.' . $i, ''),
            ];
        }
        $data['fasilitas_items'] = json_encode($fasItems);

        $aksesNama  = $request->input('akses_nama', []);
        $aksesWaktu = $request->input('akses_waktu', []);
        $aksesList  = [];
        foreach ($aksesNama as $i => $nama) {
            if (trim($nama) === '') continue;
            $aksesList[] = ['nama' => $nama, 'waktu' => $aksesWaktu[$i] ?? ''];
        }
        $data['lokasi_akses_items'] = json_encode($aksesList);

        $btnTeks = $request->input('layanan_btn_teks', []);
        $btnLink = $request->input('layanan_btn_link', []);
        $btnList = [];
        foreach ($btnTeks as $i => $teks) {
            if (trim($teks) === '') continue;
            $btnList[] = ['teks' => $teks, 'link' => $btnLink[$i] ?? ''];
        }
        $data['layanan_buttons'] = json_encode($btnList);
        $ytItems = [];
        foreach (($request->input('berita_yt_url', [])) as $i => $url) {
            $ytItems[] = [
                'url'       => $url,
                'tanggal'   => $request->input("berita_yt_tanggal.$i",   ''),
                'durasi'    => $request->input("berita_yt_durasi.$i",    ''),
                'judul'     => $request->input("berita_yt_judul.$i",     ''),
                'deskripsi' => $request->input("berita_yt_deskripsi.$i", ''),
                'channel'   => $request->input("berita_yt_channel.$i",   ''),
                'link'      => $request->input("berita_yt_link.$i",      ''),
            ];
        }
        $data['berita_yt_items'] = json_encode($ytItems);
        $artItems = [];
        for ($i = 0; $i < 3; $i++) {
            $artItems[] = [
                'foto'      => '',
                'tanggal'   => $request->input("berita_tanggal.$i",   ''),
                'jam'       => $request->input("berita_jam.$i",        ''),
                'judul'     => $request->input("berita_judul_item.$i", ''),
                'ringkasan' => $request->input("berita_ringkasan.$i",  ''),
                'penerbit'  => $request->input("berita_penerbit.$i",   ''),
                'link'      => $request->input("berita_link_item.$i",  ''),
            ];
        }
        $data['berita_artikel_items'] = json_encode($artItems);

        if ($request->has('kontak_jam_items')) {
            $data['kontak_jam_items'] = json_encode(
                array_values(array_filter($request->input('kontak_jam_items', [])))
            );
        }

        if ($request->has('kontak_divisi_items')) {
            $data['kontak_divisi_items'] = json_encode(
                array_values(array_filter($request->input('kontak_divisi_items', [])))
            );
        }

        $sosmedIcon = $request->input('sosmed_icon', []);
        $sosmedLink = $request->input('sosmed_link', []);
        $sosmedList = [];
        foreach ($sosmedIcon as $i => $icon) {
            if (trim($icon) === '') continue;
            $sosmedList[] = ['icon' => $icon, 'link' => $sosmedLink[$i] ?? ''];
        }
        $data['kontak_sosmed_items'] = json_encode($sosmedList);

        session(['homepage_preview' => $data]);
        session()->save();

        return response()->json(['ok' => true]);
    }
}