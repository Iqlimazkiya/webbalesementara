<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LayananCA extends Model
{
    protected $table = 'layanan_c_a_s';

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_image',
        'gallery',
        'zones',
        'revenue_streams',
        'cta_title',
        'cta_description',
        'whatsapp_number',
        'is_active',
    ];

    protected $casts = [
        'gallery' => 'array',
        'zones' => 'array',
        'revenue_streams' => 'array',
        'is_active' => 'boolean',
    ];

    public function fotoUrl(?string $path): ?string
    {
        if (!$path) return null;

        return str_starts_with($path, 'assets/')
            ? asset($path)
            : Storage::url($path);
    }
}