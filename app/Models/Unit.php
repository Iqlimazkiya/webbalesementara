<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'nama_tipe',
        'subtitle',
        'luas_unit',
        'kapasitas',
        'tower',
        'view',
        'foto_card',
        'foto_3d',
        'deskripsi',
        'deskripsi_singkat',
        'fasilitas',
        'galeri_foto',
        'order',
    ];

    protected $casts = [
        'fasilitas'   => 'array',
        'galeri_foto' => 'array',
    ];

    public function getFotoCardUrlAttribute()
    {
        if (!$this->foto_card) {
            return asset('assets/img/headerunit.jpg');
        }
        if (str_starts_with($this->foto_card, 'data:')) return $this->foto_card;
        if (str_starts_with($this->foto_card, 'assets/')) {
            return asset($this->foto_card);
        }
        $path = ltrim(str_replace('storage/', '', $this->foto_card), '/');
        return asset('storage/' . $path);
    }
    public function getFoto3dUrlAttribute()
    {
        if (!$this->foto_3d) return null;
        if (str_starts_with($this->foto_3d, 'data:')) return $this->foto_3d;
        if (str_starts_with($this->foto_3d, 'assets/')) {
            return asset($this->foto_3d);
        }
        $path = ltrim(str_replace('storage/', '', $this->foto_3d), '/');
        return asset('storage/' . $path);
    }

    public function getGaleriFotoUrlsAttribute(): array
    {
        $arr = $this->galeri_foto;
        if (is_string($arr)) $arr = json_decode($arr, true) ?? [];
        if (!is_array($arr)) return [];

        return array_map(function ($foto) {
            if (str_starts_with($foto, 'data:')) return $foto;
            if (str_starts_with($foto, 'assets/')) return asset($foto);
            return asset($foto);
        }, $arr);
    }

    public function getFasilitasArrayAttribute()
    {
        $val = $this->fasilitas;
        if (is_array($val)) return $val;
        if (is_string($val)) {
            $decoded = json_decode($val, true);
            if (is_array($decoded)) return $decoded;
        }
        return [];
    }

    public function contactMessages()
    {
        return $this->hasMany(\App\Models\ContactMessage::class, 'unit_id');
    }
}