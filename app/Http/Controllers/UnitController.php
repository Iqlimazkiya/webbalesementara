<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Setting;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('id', 'asc')->get();
        $settings = Setting::pluck('value', 'key')->toArray();
    
        return view('user.tipeunit', compact('units', 'settings'));
    }

    public function indextest()
    {
        $units = Unit::orderBy('id', 'asc')->get();
        $settings = Setting::pluck('value', 'key')->toArray();
    
        return view('user.test', compact('units', 'settings'));
    }
    
    public function store(Request $request)
    {
        $file = $request->file('file_konten');
        $namaFile = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/uploads'), $namaFile);

        Unit::create([
            'nama_tipe' => $request->nama_tipe,
            'file_konten' => $namaFile,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->back()->with('success', 'Konten berhasil diupdate!');
    }
}
