<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomePage;
use App\Models\ContactMessage;

class HomeController extends Controller
{
    public function index()
    {
        
        if (request()->has('_preview_page') && session()->has('homepage_preview')) {
            $home = (object) session('homepage_preview');
        } else {
            $home = HomePage::first();
        }

        return view('home', compact('home'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'divisi' => 'required|string|max:255',
            'pesan'  => 'nullable|string',
        ]);

        $fillable = (new \App\Models\ContactMessage)->getFillable();
        $data = [];

        if (in_array('name', $fillable))         $data['name']    = $request->nama;
        elseif (in_array('nama', $fillable))      $data['nama']    = $request->nama;

        if (in_array('email', $fillable))         $data['email']   = $request->email;

        if (in_array('divisi', $fillable))        $data['divisi']  = $request->divisi;
        elseif (in_array('division', $fillable))  $data['division']= $request->divisi;

        if (in_array('pesan', $fillable))         $data['pesan']   = $request->pesan ?? '';
        elseif (in_array('message', $fillable))   $data['message'] = $request->pesan ?? '';
        elseif (in_array('messages', $fillable))  $data['messages']= $request->pesan ?? '';
        elseif (in_array('msg', $fillable))       $data['msg']     = $request->pesan ?? '';

        ContactMessage::create($data);

        return back()->with('contact_success', true);
    }
}