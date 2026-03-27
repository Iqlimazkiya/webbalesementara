<?php
namespace App\Http\Controllers\Admin;
use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    private array $unitFieldLabels = [
        'nama_tipe'         => 'Nama tipe',
        'subtitle'          => 'Subtitle',
        'luas_unit'         => 'Luas unit',
        'kapasitas'         => 'Kapasitas',
        'tower'             => 'Tower',
        'view'              => 'View',
        'deskripsi'         => 'Deskripsi',
        'deskripsi_singkat' => 'Deskripsi singkat',
    ];
 
    private array $settingFieldLabels = [
        'hero_tag'             => 'Tag hero',
        'hero_line_1'          => 'Teks hero baris 1',
        'hero_line_2'          => 'Teks hero baris 2',
        'hero_desc'            => 'Deskripsi hero',
        'counting_title_1'     => 'Judul counting 1',
        'counting_title_2'     => 'Judul counting 2',
        'counting_desc'        => 'Deskripsi counting',
        'stat_floors'          => 'Jumlah lantai',
        'stat_units'           => 'Jumlah unit',
        'stat_security'        => 'Jumlah security',
        'family_count'         => 'Jumlah keluarga',
        'promo_badge'          => 'Badge promo',
        'promo_title'          => 'Judul promo',
        'promo_subtitle'       => 'Subjudul promo',
        'unit_section_badge'   => 'Badge section unit',
        'unit_section_title_1' => 'Judul section unit 1',
        'unit_section_title_2' => 'Judul section unit 2',
        'unit_section_desc'    => 'Deskripsi section unit',
        'video_title'          => 'Judul video',
        'video_subtitle'       => 'Subjudul video',
        'gallery_badge'        => 'Badge galeri',
        'gallery_title'        => 'Judul galeri',
        'whatsapp_number'      => 'Nomor WhatsApp',
        'whatsapp_message'     => 'Pesan WhatsApp default',
        'rental_url'           => 'URL rental',
    ];

    private function adminName(): string
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->name;
    }

    public function index()
    {
        $units = Unit::orderBy('order')->get();
        return view('admin.unit.index', compact('units'));
    }

    public function create()
    {
        $nextOrder = Unit::count() + 1;
        session()->forget('unit_preview');
        return view('admin.unit.create', compact('nextOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe'         => 'required|string|max:255',
            'subtitle'          => 'nullable|string|max:255',
            'luas_unit'         => 'required|string|max:50',
            'kapasitas'         => 'nullable|string|max:100',
            'tower'             => 'nullable|string|max:100',
            'view'              => 'nullable|string|max:100',
            'foto_card'         => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
            'foto_3d'           => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
            'deskripsi'         => 'nullable|string',
            'deskripsi_singkat' => 'nullable|string',
            'fasilitas'         => 'nullable|array',
            'fasilitas.*'       => 'nullable|string',
            'galeri_foto.*'     => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
            'order'             => 'nullable|integer',
        ]);

        $data = $request->except(['foto_card', 'foto_3d', 'galeri_foto']);

        if ($request->hasFile('foto_card')) {
            $path = $request->file('foto_card')->store('units/cards', 'public');
            $data['foto_card'] = 'storage/' . $path;
        }
        if ($request->hasFile('foto_3d')) {
            $path = $request->file('foto_3d')->store('units/denah', 'public');
            $data['foto_3d'] = 'storage/' . $path;
        }
        if ($request->has('fasilitas')) {
            $data['fasilitas'] = array_values(array_filter(
                $request->fasilitas, fn($v) => !empty(trim($v))
            ));
        }
        if ($request->hasFile('galeri_foto')) {
            $paths = [];
            foreach ($request->file('galeri_foto') as $file) {
                $paths[] = 'storage/' . $file->store('units/galeri', 'public');
            }
            $data['galeri_foto'] = $paths;
        }

        $order = isset($data['order']) ? (int)$data['order'] : (Unit::max('order') + 1);
        Unit::where('order', '>=', $order)->increment('order');
        $data['order'] = $order;

        $unit = Unit::create($data);
        Unit::orderBy('order')->get()->each(function ($u, $i) {
            $u->update(['order' => $i + 1]);
        });
        session()->forget('unit_preview');

        $details = [];
        if ($request->hasFile('foto_card'))  $details[] = 'foto card';
        if ($request->hasFile('foto_3d'))    $details[] = 'foto denah 3D';
        if ($request->hasFile('galeri_foto')) $details[] = count($request->file('galeri_foto')) . ' foto galeri';
        $fasCount = count($data['fasilitas'] ?? []);
        if ($fasCount) $details[] = $fasCount . ' fasilitas';
 
        ActivityLogger::log(
            'Menambahkan tipe unit "' . $unit->nama_tipe . '"',
            'Admin ' . $this->adminName() . ' menambahkan unit "' . $unit->nama_tipe . '"'
                . ($details ? ' dengan ' . implode(', ', $details) : '') . '.'
        );

        return redirect()->route('admin.unit.index')
            ->with('success', 'Unit berhasil ditambahkan');
    }

    public function destroy(Unit $unit)
    {
        $namaUnit = $unit->nama_tipe;
        if ($unit->foto_card && !str_starts_with($unit->foto_card, 'assets/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $unit->foto_card));
        }
        if ($unit->foto_3d && !str_starts_with($unit->foto_3d, 'assets/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $unit->foto_3d));
        }
        if ($unit->galeri_foto) {
            foreach ($unit->galeri_foto as $foto) {
                if (!str_starts_with($foto, 'assets/')) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $foto));
                }
            }
        }
        $unit->delete();

        Unit::orderBy('order')->get()->each(function ($u, $i) {
            $u->update(['order' => $i + 1]);
        });

        ActivityLogger::log(
            'Menghapus tipe unit "' . $namaUnit . '"',
            'Admin ' . $this->adminName() . ' menghapus tipe unit "' . $namaUnit . '" beserta semua fotonya.'
        );

        return redirect()->route('admin.unit-page.edit')
            ->with('success', 'Unit berhasil dihapus');
    }

    public function editPage()
    {
        session()->forget('page_preview');
        $s = Setting::getMany([
            'hero_image', 'hero_tag', 'hero_line_1', 'hero_line_2', 'hero_desc',
            'counting_image', 'counting_title_1', 'counting_title_2', 'counting_desc',
            'stat_floors', 'stat_units', 'stat_security', 'family_count',
            'promo_images', 'promo_badge', 'promo_title', 'promo_subtitle',
            'unit_section_badge', 'unit_section_title_1', 'unit_section_title_2', 'unit_section_desc',
            'main_video', 'video_title', 'video_subtitle',
            'gallery_badge', 'gallery_title',
            'whatsapp_number', 'whatsapp_message', 'rental_url',
        ]);
        $units = Unit::orderBy('order')->get();
        return view('admin.unit.edit', compact('s', 'units'));
    }

    public function updatePage(Request $request)
    {
        $request->validate([
            'hero_image'           => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
'counting_image'       => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
'promo_images_baru.*'  => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
'unit_foto_card.*'     => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
'unit_foto_3d.*'       => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
'unit_galeri_baru.*.*' => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
'main_video' => 'nullable|mimetypes:video/mp4,video/webm,video/mpeg,video/quicktime|max:51200',
        ]);

        $admin        = $this->adminName();
        $logs         = [];
        $settingsBefore = Setting::getMany(array_keys($this->settingFieldLabels));

        // hero
        if ($request->hasFile('hero_image')) {
            $old = Setting::where('key', 'hero_image')->value('value');
            if ($old && !str_starts_with($old, 'assets/')) Storage::disk('public')->delete(str_replace('storage/', '', $old));
            $path = $request->file('hero_image')->store('unit-page/hero', 'public');
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => 'storage/' . $path, 'type' => 'image']);
            $logs[] = 'Foto hero halaman unit diperbarui';
        }
        foreach (['hero_tag', 'hero_line_1', 'hero_line_2', 'hero_desc'] as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->$key ?? '', 'type' => 'text']);
        }

        // perhitungan
        if ($request->hasFile('counting_image')) {
            $old = Setting::where('key', 'counting_image')->value('value');
            if ($old && !str_starts_with($old, 'assets/')) Storage::disk('public')->delete(str_replace('storage/', '', $old));
            $path = $request->file('counting_image')->store('unit-page/counting', 'public');
            Setting::updateOrCreate(['key' => 'counting_image'], ['value' => 'storage/' . $path, 'type' => 'image']);
            $logs[] = 'Foto counting diperbarui';
        }
        foreach (['counting_title_1', 'counting_title_2', 'counting_desc', 'stat_floors', 'stat_units', 'stat_security', 'family_count'] as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->$key ?? '', 'type' => 'text']);
        }

        // promo
        $promoArr = json_decode(Setting::where('key', 'promo_images')->value('value') ?? '[]', true) ?? [];
        if ($request->filled('hapus_promo')) {
            $toHapus = array_map('intval', (array) $request->hapus_promo);
            foreach ($toHapus as $idx) {
                if (isset($promoArr[$idx]) && !str_starts_with($promoArr[$idx], 'assets/')) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $promoArr[$idx]));
                }
            }
            $promoArr = array_values(array_filter($promoArr, fn($_, $i) => !in_array($i, $toHapus), ARRAY_FILTER_USE_BOTH));
            $logs[]   = 'Menghapus ' . count($toHapus) . ' foto promo';
        }
        if ($request->hasFile('promo_images_baru')) {
            foreach ($request->file('promo_images_baru') as $file) {
                $promoArr[] = 'storage/' . $file->store('unit-page/promo', 'public');
            }
        }
        Setting::updateOrCreate(['key' => 'promo_images'], ['value' => json_encode(array_values($promoArr)), 'type' => 'json']);
        foreach (['promo_badge', 'promo_title', 'promo_subtitle'] as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->$key ?? '', 'type' => 'text']);
        }

        // section unit
        foreach (['unit_section_badge', 'unit_section_title_1', 'unit_section_title_2', 'unit_section_desc'] as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->$key ?? '', 'type' => 'text']);
        }

        // video
        if ($request->hasFile('main_video')) {
            $old = Setting::where('key', 'main_video')->value('value');
            if ($old && !str_starts_with($old, 'assets/')) Storage::disk('public')->delete(str_replace('storage/', '', $old));
            $path = $request->file('main_video')->store('unit-page/video', 'public');
            Setting::updateOrCreate(['key' => 'main_video'], ['value' => 'storage/' . $path, 'type' => 'video']);
            $logs[] = 'Video utama halaman unit diperbarui';
        }
        foreach (['video_title', 'video_subtitle'] as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->$key ?? '', 'type' => 'text']);
        }

        // galeri
        foreach (['gallery_badge', 'gallery_title'] as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->$key ?? '', 'type' => 'text']);
        }

        // kontak
        foreach (['whatsapp_number', 'whatsapp_message', 'rental_url'] as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->$key ?? '', 'type' => 'text']);
        }

        foreach ($this->settingFieldLabels as $key => $label) {
            $before = $settingsBefore[$key] ?? '';
            $after  = $request->$key ?? '';
            if ((string)$before !== (string)$after) {
                $logs[] = $label . ' diubah';
            }
        }

        // hapus unit
        $hapusUnitIds = $request->input('hapus_unit', []);
        foreach ($hapusUnitIds as $hapusId) {
            $hapusUnit = Unit::find($hapusId);
            if (!$hapusUnit) continue;
            if ($hapusUnit->foto_card && !str_starts_with($hapusUnit->foto_card, 'assets/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $hapusUnit->foto_card));
            }
            if ($hapusUnit->foto_3d && !str_starts_with($hapusUnit->foto_3d, 'assets/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $hapusUnit->foto_3d));
            }
            if ($hapusUnit->galeri_foto) {
                foreach ($hapusUnit->galeri_foto as $foto) {
                    if (!str_starts_with($foto, 'assets/')) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $foto));
                    }
                }
            }
            $hapusUnit->delete();
        }
        $unitIds        = $request->input('unit_ids', []);
        $unitData       = $request->input('units', []);
        $unitFotoCard   = $request->file('unit_foto_card', []);
        $unitFoto3d     = $request->file('unit_foto_3d', []);
        $unitGaleriBaru = (array) $request->file('unit_galeri_baru', []);

        foreach ($unitIds as $id) {
            $unit = Unit::find($id);
            if (!$unit) continue;

            $d = $unitData[$id] ?? [];
            $unitLogs   = [];

            foreach ($this->unitFieldLabels as $field => $label) {
                if (isset($d[$field]) && (string)($unit->$field ?? '') !== (string)$d[$field]) {
                    $unitLogs[] = $label . ' diubah';
                }
            }

            $newOrder = isset($d['order']) ? (int)$d['order'] : $unit->order;
            if ($newOrder != $unit->order) {
                Unit::where('id', '!=', $unit->id)
                    ->where('order', '>=', $newOrder)
                    ->increment('order');
                $d['order'] = $newOrder;
                $unitLogs[] = 'urutan diubah ke ' . $newOrder;
            }

            if (isset($unitFotoCard[$id])) {
                if ($unit->foto_card && !str_starts_with($unit->foto_card, 'assets/')) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $unit->foto_card));
                }
                $d['foto_card'] = 'storage/' . $unitFotoCard[$id]->store('units/cards', 'public');
                $unitLogs[] = 'foto card diperbarui';
            }

            if (isset($unitFoto3d[$id])) {
                if ($unit->foto_3d && !str_starts_with($unit->foto_3d, 'assets/')) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $unit->foto_3d));
                }
                $d['foto_3d'] = 'storage/' . $unitFoto3d[$id]->store('units/denah', 'public');
                $unitLogs[] = 'foto denah 3D diperbarui';
            }

            $fasLama = $unit->fasilitas ?? [];
            $fasBaru = array_values(array_filter(is_array($d['fasilitas'] ?? []) ? $d['fasilitas'] : [], fn($v) => !empty(trim($v))));
            $d['fasilitas'] = $fasBaru;
            if (json_encode($fasLama) !== json_encode($fasBaru)) {
                $unitLogs[] = 'fasilitas diperbarui (' . count($fasLama) . ' → ' . count($fasBaru) . ' item)';
            }

            $existing = $request->input("unit_existing_galeri.$id", []);
            if (isset($unitGaleriBaru[$id]) && is_array($unitGaleriBaru[$id])) {
                $jumlahBaru = count($unitGaleriBaru[$id]);
                foreach ($unitGaleriBaru[$id] as $file) {
                    $existing[] = 'storage/' . $file->store('units/galeri', 'public');
                }
                $unitLogs[] = "menambahkan {$jumlahBaru} foto galeri";
            }
            $d['galeri_foto'] = array_values($existing);

            $unit->update($d);

            if (!empty($unitLogs)) {
                $logs[] = 'Unit "' . ($unit->nama_tipe) . '": ' . implode(', ', $unitLogs);
            }
        }

        if (!empty($hapusUnitIds)) {
            Unit::orderBy('order')->get()->each(function ($u, $i) {
                $u->update(['order' => $i + 1]);
            });
        }

        session()->forget('page_preview');

        foreach ($logs as $log) {
            ActivityLogger::log(
                'Halaman Tipe Unit: ' . $log,
                'Admin ' . $admin . ' mengubah halaman Tipe Unit — ' . $log . '.'
            );
        }

        return redirect()->route('admin.unit-page.edit')
            ->with('success', 'Konten halaman unit berhasil disimpan.');
    }

    public function preview(Request $request)
{
    $galeriBase64 = [];
    if ($request->hasFile('galeri_foto')) {
        foreach ($request->file('galeri_foto') as $file) {
            $mime = $file->getMimeType();
            $data = base64_encode(file_get_contents($file->getRealPath()));
            $galeriBase64[] = "data:{$mime};base64,{$data}";
        }
    }
    $foto3dBase64 = null;
    if ($request->hasFile('foto_3d')) {
        $file = $request->file('foto_3d');
        $mime = $file->getMimeType();
        $data = base64_encode(file_get_contents($file->getRealPath()));
        $foto3dBase64 = "data:{$mime};base64,{$data}";
    }
    $fotoCardBase64 = null;
    if ($request->hasFile('foto_card')) {
        $file = $request->file('foto_card');
        $mime = $file->getMimeType();
        $data = base64_encode(file_get_contents($file->getRealPath()));
        $fotoCardBase64 = "data:{$mime};base64,{$data}";
    }

    session(['unit_preview' => [
        'unit_id'           => $request->unit_id ?? null,
        'nama_tipe'         => $request->nama_tipe,
        'subtitle'          => $request->subtitle,
        'luas_unit'         => $request->luas_unit,
        'kapasitas'         => $request->kapasitas,
        'tower'             => $request->tower,
        'view'              => $request->view,
        'deskripsi'         => $request->deskripsi,
        'deskripsi_singkat' => $request->deskripsi_singkat,
        'fasilitas'         => array_values(array_filter(
            (array)($request->fasilitas ?? []),
            fn($v) => !empty(trim($v))
        )),
        'order'             => $request->order ?? null,
        'galeri_foto'       => $galeriBase64,
        'foto_3d_base64'    => $foto3dBase64,   
        'foto_card_base64'  => $fotoCardBase64, 
    ]]);

    return response()->json(['ok' => true]);
}

    public function previewPageSettings(Request $request)
    {
        $hapusUnitPreview = array_map('intval', (array)($request->input('hapus_unit_preview', [])));

        $promoArr = json_decode(Setting::where('key', 'promo_images')->value('value') ?? '[]', true) ?? [];

        $hapusPromo = array_map('intval', (array)$request->input('hapus_promo', []));
        if (!empty($hapusPromo)) {
            $promoArr = array_values(array_filter(
                $promoArr,
                fn($_, $i) => !in_array($i, $hapusPromo),
                ARRAY_FILTER_USE_BOTH
            ));
        }

        session(['page_preview' => [
            'hero_tag'             => $request->hero_tag,
            'hero_line_1'          => $request->hero_line_1,
            'hero_line_2'          => $request->hero_line_2,
            'hero_desc'            => $request->hero_desc,
            'counting_title_1'     => $request->counting_title_1,
            'counting_title_2'     => $request->counting_title_2,
            'counting_desc'        => $request->counting_desc,
            'stat_floors'          => $request->stat_floors,
            'stat_units'           => $request->stat_units,
            'stat_security'        => $request->stat_security,
            'family_count'         => $request->family_count,
            'promo_badge'          => $request->promo_badge,
            'promo_title'          => $request->promo_title,
            'promo_subtitle'       => $request->promo_subtitle,
            'promo_images'         => $promoArr,
            'unit_section_badge'   => $request->unit_section_badge,
            'unit_section_title_1' => $request->unit_section_title_1,
            'unit_section_title_2' => $request->unit_section_title_2,
            'unit_section_desc'    => $request->unit_section_desc,
            'video_title'          => $request->video_title,
            'video_subtitle'       => $request->video_subtitle,
            'gallery_badge'        => $request->gallery_badge,
            'gallery_title'        => $request->gallery_title,
            'units_data'           => $request->input('units', []),
            'hapus_unit_preview'   => $hapusUnitPreview,
        ]]);

        return response()->json(['ok' => true]);
    }

    public function moveUp($id)
    {
        $unit = Unit::findOrFail($id);
        $prev = Unit::where('order', '<', $unit->order)->orderBy('order', 'desc')->first();
        if ($prev) {
            $t = $unit->order;
            $unit->update(['order' => $prev->order]);
            $prev->update(['order' => $t]);
            ActivityLogger::log(
                'Mengubah urutan unit "' . $unit->nama_tipe . '" — dipindah ke atas',
                'Admin ' . $this->adminName() . ' memindahkan unit "' . $unit->nama_tipe . '" ke atas (urutan ' . $prev->order . ' → ' . $unit->order . ').'
            );
        }
        return redirect()->route('admin.unit.index')->with('success', 'Urutan berhasil diubah');
    }

    public function moveDown($id)
    {
        $unit = Unit::findOrFail($id);
        $next = Unit::where('order', '>', $unit->order)->orderBy('order', 'asc')->first();
        if ($next) {
            $t = $unit->order;
            $unit->update(['order' => $next->order]);
            $next->update(['order' => $t]);
            ActivityLogger::log(
                'Mengubah urutan unit "' . $unit->nama_tipe . '" — dipindah ke bawah',
                'Admin ' . $this->adminName() . ' memindahkan unit "' . $unit->nama_tipe . '" ke bawah (urutan ' . $next->order . ' → ' . $unit->order . ').'
            );
        }
        return redirect()->route('admin.unit.index')->with('success', 'Urutan berhasil diubah');
    }
}