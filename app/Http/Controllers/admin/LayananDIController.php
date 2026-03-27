<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananDI;
use Illuminate\Http\Request;

class LayananDIController extends Controller
{
    public function index()
    {
        $di = LayananDI::first();
        return view('admin.layanandi.index', compact('di'));
    }

    public function showUser()
    {
        $di = LayananDI::first();
        return view('user.layanan.di', compact('di'));
    }

    public function edit()
    {
        $di = LayananDI::firstOrCreate([], [
            'tarif_konsultasi' => [],
            'tarif_desain'     => [],
            'tarif_renovasi'   => [],
            'ketentuan'        => [],
        ]);

        session()->forget('di_preview');

        return view('admin.layananid.edit', compact('di'));
    }

    public function preview(Request $request)
    {
        session(['di_preview' => [
            'tarif_konsultasi' => $this->filterRows($request->tarif_konsultasi ?? [], ['jenis','kondisi','tarif','petugas','durasi']),
            'tarif_desain'     => $this->filterRows($request->tarif_desain     ?? [], ['jenis','kondisi','tarif','petugas','durasi']),
            'tarif_renovasi'   => $this->filterRows($request->tarif_renovasi   ?? [], ['jenis','kondisi','tarif','petugas','durasi']),
            'ketentuan'        => array_values(array_filter(array_map('trim', $request->ketentuan ?? []))),
        ]]);

        return response()->json(['ok' => true]);
    }

    public function update(Request $request)
    {
        $di = LayananDI::firstOrCreate([]);

        foreach ([1, 2, 3, 4] as $n) {
            $key = "foto_carousel_{$n}";
            if ($request->hasFile($key)) {
                $di->$key = $request->file($key)->store("design-interior/carousel", 'public');
            }
        }

        foreach ([1, 2, 3] as $n) {
            $key = "foto_slide_{$n}";
            if ($request->hasFile($key)) {
                $di->$key = $request->file($key)->store("design-interior/slide", 'public');
            }
        }

        $di->tarif_konsultasi = $this->filterRows($request->tarif_konsultasi ?? [], ['jenis','kondisi','tarif','petugas','durasi']);
        $di->tarif_desain     = $this->filterRows($request->tarif_desain     ?? [], ['jenis','kondisi','tarif','petugas','durasi']);
        $di->tarif_renovasi   = $this->filterRows($request->tarif_renovasi   ?? [], ['jenis','kondisi','tarif','petugas','durasi']);
        $di->ketentuan        = array_values(array_filter(array_map('trim', $request->ketentuan ?? [])));

        $di->save();
        session()->forget('di_preview');

        return redirect()
            ->route('admin.layanandi.edit')
            ->with('success', 'Konten Design Interior berhasil disimpan.');
    }

    private function filterRows(array $rows, array $keys): array
    {
        return array_values(array_filter(
            array_map(fn($row) => array_intersect_key($row + array_fill_keys($keys, ''), array_flip($keys)), $rows),
            fn($row) => !empty(array_filter($row))
        ));
    }
}