<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananWO;

class LayananWOController extends Controller
{
    public function index()
    {
        $layanan = LayananWO::all();

        return view('user.layananwo', compact('layanan'));
    }
}
