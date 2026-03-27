<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananCO;

class LayananCOController extends Controller
{
    public function index()
    {
        $layanan = LayananCO::all();

        return view('user.layananco', compact('layanan'));
    }
}
