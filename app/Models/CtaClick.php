<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtaClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'clicked_at'
    ];

    protected $casts = [
        'clicked_at' => 'datetime'
    ];
}