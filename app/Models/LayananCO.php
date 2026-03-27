<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LayananCO extends Model
{
    protected $table = 'layanan_c_o_s';

    protected $fillable = [
        'title',
        'description',
        'foto_hero',
        'foto_slide',
        'foto_galeri',
        'tarif_cleaning',
        'tarif_cuci',
        'tarif_tambahan',
        'tarif_berkala',
        'ketentuan',
        'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'foto_slide'     => 'array',
        'foto_galeri'    => 'array',
        'tarif_cleaning' => 'array',
        'tarif_cuci'     => 'array',
        'tarif_tambahan' => 'array',
        'tarif_berkala'  => 'array',
        'ketentuan'      => 'array',
    ];

    public function fotoUrl(?string $path): ?string
{
    if (!$path) return null;
    return str_starts_with($path, 'assets/')
        ? asset($path)
        : Storage::url($path);
}
}