<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingClick extends Model
{
    protected $fillable = [
        'unit_id', 'unit_nama', 'click_date', 'month', 'year',
    ];

    protected $casts = [
        'click_date' => 'date',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}