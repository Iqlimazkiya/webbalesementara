<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LayananWO extends Model
{
    protected $table = 'layanan_w_o_s';

    protected $fillable = [
        'title', 'description',
        'foto_carousel_1', 'foto_carousel_2', 'foto_carousel_3', 'foto_carousel_4',
        'foto_slide_1', 'foto_slide_2', 'foto_slide_3',
        'tarif_listrik', 'tarif_plumbing', 'tarif_umum', 'ketentuan',
        'is_active',
    ];

    protected $casts = [
        'tarif_listrik'  => 'array',
        'tarif_plumbing' => 'array',
        'tarif_umum'     => 'array',
        'ketentuan'      => 'array',
        'is_active'      => 'boolean',
    ];

    public function fotoUrl(?string $path): ?string
    {
        if (!$path) return null;
        return str_starts_with($path, 'assets/')
            ? asset($path)
            : Storage::url($path);
    }
}