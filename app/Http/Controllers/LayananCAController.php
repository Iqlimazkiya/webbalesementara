<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananCA;

class LayananCAController extends Controller
{
    public function index()
    {
        $layanan = LayananCA::first();

        return view('user.layananca', compact('layanan'));
    }
}
