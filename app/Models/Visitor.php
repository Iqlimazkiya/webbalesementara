<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visitor extends Model
{
    protected $fillable = [
        'visit_date',
        'hour',
        'day_of_week',
        'week_of_year',
        'month',
        'year',
        'count'
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function scopeCurrentWeek($query)
    {
        $now = Carbon::now();
        return $query->where('year', $now->year)
                     ->where('week_of_year', $now->weekOfYear);
    }

    public function scopeCurrentMonth($query)
    {
        $now = Carbon::now();
        return $query->where('year', $now->year)
                     ->where('month', $now->month);
    }

    public function scopeCurrentYear($query)
    {
        $now = Carbon::now();
        return $query->where('year', $now->year);
    }
}
