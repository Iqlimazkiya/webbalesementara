<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LayananDI;

class LayananDIController extends Controller
{
    public function index()
    {
        $layanan = LayananDI::all();

        return view('user.layanandi', compact('layanan'));
    }
}
