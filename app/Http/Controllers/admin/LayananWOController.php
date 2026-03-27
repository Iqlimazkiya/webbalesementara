<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananWO;
use Illuminate\Http\Request;

class LayananWOController extends Controller
{
    public function index()
    {
        $wo = LayananWO::first();
        return view('admin.layananwo.index', compact('wo'));
    }

    public function showUser()
    {
        $wo = LayananWO::first();
        return view('user.layanan.wo', compact('wo'));
    }

    public function edit()
    {
        $wo = LayananWO::firstOrCreate([], [
            'tarif_listrik'  => [],
            'tarif_plumbing' => [],
            'tarif_umum'     => [],
            'ketentuan'      => [],
        ]);

        session()->forget('wo_preview');

        return view('admin.layananwo.edit', compact('wo'));
    }

    public function preview(Request $request)
    {
        session(['wo_preview' => [
            'tarif_listrik'  => $this->filterRows($request->tarif_listrik  ?? [], ['jenis','kondisi','tarif','petugas','durasi']),
            'tarif_plumbing' => $this->filterRows($request->tarif_plumbing ?? [], ['jenis','kondisi','tarif','petugas','durasi']),
            'tarif_umum'     => $this->filterRows($request->tarif_umum     ?? [], ['jenis','kondisi','tarif','petugas','durasi']),
            'ketentuan'      => array_values(array_filter(array_map('trim', $request->ketentuan ?? []))),
        ]]);

        return response()->json(['ok' => true]);
    }

    public function update(Request $request)
    {
        $wo = LayananWO::firstOrCreate([]);

        foreach ([1, 2, 3, 4] as $n) {
            $key = "foto_carousel_{$n}";
            if ($request->hasFile($key)) {
                $wo->$key = $request->file($key)->store("working-order/carousel", 'public');
            }
        }

        foreach ([1, 2, 3] as $n) {
            $key = "foto_slide_{$n}";
            if ($request->hasFile($key)) {
                $wo->$key = $request->file($key)->store("working-order/slide", 'public');
            }
        }

        $wo->tarif_listrik  = $this->filterRows($request->tarif_listrik  ?? [], ['jenis','kondisi','tarif','petugas','durasi']);
        $wo->tarif_plumbing = $this->filterRows($request->tarif_plumbing ?? [], ['jenis','kondisi','tarif','petugas','durasi']);
        $wo->tarif_umum     = $this->filterRows($request->tarif_umum     ?? [], ['jenis','kondisi','tarif','petugas','durasi']);
        $wo->ketentuan      = array_values(array_filter(array_map('trim', $request->ketentuan ?? [])));

        $wo->save();
        session()->forget('wo_preview');

        return redirect()
            ->route('admin.layananwo.edit')
            ->with('success', 'Konten Working Order berhasil disimpan.');
    }

    private function filterRows(array $rows, array $keys): array
    {
        return array_values(array_filter(
            array_map(fn($row) => array_intersect_key($row + array_fill_keys($keys, ''), array_flip($keys)), $rows),
            fn($row) => !empty(array_filter($row))
        ));
    }
}