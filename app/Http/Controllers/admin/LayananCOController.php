<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\LayananCO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananCOController extends Controller
{
    public function index()
    {
        $co = LayananCO::first();
        return view('admin.layananco.index', compact('co'));
    }

    public function edit()
    {
        $co = LayananCO::firstOrCreate([], [
            'tarif_cleaning' => [],
            'tarif_cuci'     => [],
            'tarif_tambahan' => [],
            'tarif_berkala'  => [],
            'foto_slide'     => [],
            'foto_galeri'    => [],
            'ketentuan'      => [],
        ]);

        $this->cleanTempPreview();

        session(['co_preview' => [
            'tarif_cleaning' => $co->tarif_cleaning ?? [],
            'tarif_tambahan' => $co->tarif_tambahan ?? [],
            'tarif_cuci'     => $co->tarif_cuci     ?? [],
            'tarif_berkala'  => $co->tarif_berkala  ?? [],
            'ketentuan'      => $co->ketentuan      ?? [],
            'hapus_slide'    => [],
            'hapus_galeri'   => [],
        ]]);

        return view('admin.layananco.edit', compact('co'));
    }

    public function preview(Request $request)
    {
        $preview = session('co_preview', []);

        if ($request->hasFile('foto_hero')) {
            if (!empty($preview['foto_hero_temp'])) {
                Storage::disk('public')->delete($preview['foto_hero_temp']);
            }
            $preview['foto_hero_temp'] = $request->file('foto_hero')->store('cleaning-order/temp', 'public');
        }

foreach ($preview['foto_slide_temp'] ?? [] as $p) Storage::disk('public')->delete($p);
$preview['foto_slide_temp'] = [];

if ($request->hasFile('foto_slide_baru')) {
    foreach ($request->file('foto_slide_baru') as $file) {
        $preview['foto_slide_temp'][] = $file->store('cleaning-order/temp', 'public');
    }
}

        $preview['hapus_slide']  = array_map('intval', (array)($request->hapus_slide ?? []));

        foreach ($preview['foto_galeri_temp'] ?? [] as $p) Storage::disk('public')->delete($p);
$preview['foto_galeri_temp'] = [];

if ($request->hasFile('foto_galeri_baru')) {
    foreach ($request->file('foto_galeri_baru') as $file) {
        $preview['foto_galeri_temp'][] = $file->store('cleaning-order/temp', 'public');
    }
}

        $preview['hapus_galeri'] = array_map('intval', (array)($request->hapus_galeri ?? []));

        $preview['tarif_cleaning'] = $this->filterRows($request->tarif_cleaning ?? [], ['type','kondisi','tarif','petugas','durasi']);
        $preview['tarif_tambahan'] = $this->filterRows($request->tarif_tambahan ?? [], ['area','tarif','petugas','durasi']);
        $preview['tarif_cuci']     = $this->filterRows($request->tarif_cuci     ?? [], ['nama','satuan','durasi','tarif']);
        $preview['tarif_berkala']  = $this->filterRows($request->tarif_berkala  ?? [], ['nama','satuan','durasi','petugas','tarif']);
        $preview['ketentuan']      = array_values(array_filter(array_map('trim', $request->ketentuan ?? [])));

        session(['co_preview' => $preview]);

        return response()->json(['ok' => true]);
    }

    public function update(Request $request)
{
    $co     = LayananCO::firstOrCreate([]);
    $admin  = auth()->user()->name;
    $logs   = [];

    //Foto Hero
    if ($request->hasFile('foto_hero')) {
        $isUpdate = (bool) $co->foto_hero;
        if ($co->foto_hero && !str_starts_with($co->foto_hero, 'assets/')) {
            Storage::disk('public')->delete($co->foto_hero);
        }
        $co->foto_hero = $request->file('foto_hero')->store('cleaning-order/hero', 'public');
        $logs[] = $isUpdate ? 'Foto hero diperbarui' : 'Foto hero ditambahkan';
    }

    //Foto Slide
    if ($request->hasFile('foto_slide_baru')) {
        $jumlah   = count($request->file('foto_slide_baru'));
        $existing = $co->foto_slide ?? [];
        foreach ($request->file('foto_slide_baru') as $file) {
            $existing[] = $file->store('cleaning-order/slide', 'public');
        }
        $co->foto_slide = $existing;
        $logs[] = "Menambahkan {$jumlah} foto slide";
    }

    if ($request->filled('hapus_slide')) {
        $slides  = $co->foto_slide ?? [];
        $toHapus = array_map('intval', (array)$request->hapus_slide);
        foreach ($toHapus as $idx) {
            if (isset($slides[$idx]) && !str_starts_with($slides[$idx], 'assets/')) {
                Storage::disk('public')->delete($slides[$idx]);
            }
        }
        $co->foto_slide = array_values(array_filter($slides, fn($_, $i) => !in_array($i, $toHapus), ARRAY_FILTER_USE_BOTH));
        $logs[] = 'Menghapus ' . count($toHapus) . ' foto slide';
    }

    //Foto Galeri
    if ($request->hasFile('foto_galeri_baru')) {
        $jumlah   = count($request->file('foto_galeri_baru'));
        $existing = $co->foto_galeri ?? [];
        foreach ($request->file('foto_galeri_baru') as $file) {
            $existing[] = $file->store('cleaning-order/galeri', 'public');
        }
        $co->foto_galeri = $existing;
        $logs[] = "Menambahkan {$jumlah} foto galeri";
    }

    if ($request->filled('hapus_galeri')) {
        $galeri  = $co->foto_galeri ?? [];
        $toHapus = array_map('intval', (array)$request->hapus_galeri);
        foreach ($toHapus as $idx) {
            if (isset($galeri[$idx]) && !str_starts_with($galeri[$idx], 'assets/')) {
                Storage::disk('public')->delete($galeri[$idx]);
            }
        }
        $co->foto_galeri = array_values(array_filter($galeri, fn($_, $i) => !in_array($i, $toHapus), ARRAY_FILTER_USE_BOTH));
        $logs[] = 'Menghapus ' . count($toHapus) . ' foto galeri';
    }

    //Tarif Cleaning
    $tarifCleaningBaru = $this->filterRows($request->tarif_cleaning ?? [], ['type','kondisi','tarif','petugas','durasi']);
    if ($this->tarifBerubah($co->tarif_cleaning ?? [], $tarifCleaningBaru)) {
        $before = count($co->tarif_cleaning ?? []);
        $after  = count($tarifCleaningBaru);
        $logs[] = "Tarif cleaning diperbarui ({$before} → {$after} baris)";
    }
    $co->tarif_cleaning = $tarifCleaningBaru;

    //Tarif Tambahan
    $tarifTambahanBaru = $this->filterRows($request->tarif_tambahan ?? [], ['area','tarif','petugas','durasi']);
    if ($this->tarifBerubah($co->tarif_tambahan ?? [], $tarifTambahanBaru)) {
        $before = count($co->tarif_tambahan ?? []);
        $after  = count($tarifTambahanBaru);
        $logs[] = "Tarif tambahan diperbarui ({$before} → {$after} baris)";
    }
    $co->tarif_tambahan = $tarifTambahanBaru;

    //Tarif Cuci
    $tarifCuciBaru = $this->filterRows($request->tarif_cuci ?? [], ['nama','satuan','durasi','tarif']);
    if ($this->tarifBerubah($co->tarif_cuci ?? [], $tarifCuciBaru)) {
        $before = count($co->tarif_cuci ?? []);
        $after  = count($tarifCuciBaru);
        $logs[] = "Tarif cuci diperbarui ({$before} → {$after} baris)";
    }
    $co->tarif_cuci = $tarifCuciBaru;

    //Tarif Berkala
    $tarifBerkalaBaru = $this->filterRows($request->tarif_berkala ?? [], ['nama','satuan','durasi','petugas','tarif']);
    if ($this->tarifBerubah($co->tarif_berkala ?? [], $tarifBerkalaBaru)) {
        $before = count($co->tarif_berkala ?? []);
        $after  = count($tarifBerkalaBaru);
        $logs[] = "Tarif berkala diperbarui ({$before} → {$after} baris)";
    }
    $co->tarif_berkala = $tarifBerkalaBaru;

    //Ketentuan
    $ketentuanBaru = array_values(array_filter(array_map('trim', $request->ketentuan ?? [])));
    if ($this->ketentuanBerubah($co->ketentuan ?? [], $ketentuanBaru)) {
        $before = count($co->ketentuan ?? []);
        $after  = count($ketentuanBaru);
        $logs[] = "Ketentuan diperbarui ({$before} → {$after} poin)";
    }
    $co->ketentuan = $ketentuanBaru;

    $co->save();
    $this->cleanTempPreview();
    session()->forget('co_preview');

    if (!empty($logs)) {
        foreach ($logs as $log) {
            ActivityLogger::log(
                'Cleaning Order: ' . $log,
                'Admin ' . $admin . ' mengubah Cleaning Order — ' . $log . '.'
            );
        }
    }

    return redirect()->route('admin.layananco.edit')
        ->with('success', 'Konten Cleaning Order berhasil disimpan.');
}

    public function hapusGaleri(Request $request)
    {
        $co     = LayananCO::firstOrFail();
        $idx    = (int)$request->index;
        $galeri = $co->foto_galeri ?? [];

        if (!isset($galeri[$idx])) {
            return response()->json(['ok' => false, 'message' => 'Index tidak ditemukan'], 404);
        }

        if (!str_starts_with($galeri[$idx], 'assets/')) {
            Storage::disk('public')->delete($galeri[$idx]);
        }

        array_splice($galeri, $idx, 1);
        $co->foto_galeri = array_values($galeri);
        $co->save();

        ActivityLogger::log(
            'Cleaning Order: Menghapus 1 foto galeri',
            'Admin ' . auth()->user()->name . ' menghapus foto galeri Cleaning Order (index ' . $idx . ').'
        );

        return response()->json(['ok' => true]);
    }

    public function hapusSlide(Request $request)
    {
        $co     = LayananCO::firstOrFail();
        $idx    = (int)$request->index;
        $slides = $co->foto_slide ?? [];

        if (!isset($slides[$idx])) {
            return response()->json(['ok' => false, 'message' => 'Index tidak ditemukan'], 404);
        }

        if (!str_starts_with($slides[$idx], 'assets/')) {
            Storage::disk('public')->delete($slides[$idx]);
        }

        array_splice($slides, $idx, 1);
        $co->foto_slide = array_values($slides);
        $co->save();

        ActivityLogger::log(
            'Cleaning Order: Menghapus 1 foto slide',
            'Admin ' . auth()->user()->name . ' menghapus foto slide Cleaning Order (index ' . $idx . ').'
        );

        return response()->json(['ok' => true]);
    }

    private function tarifBerubah(array $lama, array $baru): bool
    {
        return json_encode($lama) !== json_encode($baru);
    }

    private function ketentuanBerubah(array $lama, array $baru): bool
    {
        return json_encode(array_values($lama)) !== json_encode(array_values($baru));
    }

    private function cleanTempPreview(): void
    {
        $preview = session('co_preview', []);
        if (!empty($preview['foto_hero_temp'])) Storage::disk('public')->delete($preview['foto_hero_temp']);
        foreach ($preview['foto_slide_temp']  ?? [] as $p) Storage::disk('public')->delete($p);
        foreach ($preview['foto_galeri_temp'] ?? [] as $p) Storage::disk('public')->delete($p);

        foreach (Storage::disk('public')->files('cleaning-order/temp') as $f) {
            Storage::disk('public')->delete($f);
        }
    }

    private function filterRows(array $rows, array $keys): array
    {
        return array_values(array_filter(
            array_map(
                fn($row) => array_intersect_key($row + array_fill_keys($keys, ''), array_flip($keys)),
                $rows
            ),
            fn($row) => !empty(array_filter($row))
        ));
    }
}