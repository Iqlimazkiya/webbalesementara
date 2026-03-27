<?php

namespace App\Helpers;

use App\Models\Activity;
use Illuminate\Support\Facades\Log;

class ActivityLogger
{
    public static function log(string $description, string $details = ''): void
    {
        try {
            Activity::create([
                'description' => $description,
                'details'     => $details,
                'user_id'     => auth()->check() ? auth()->user()->id : null,
                'ip_address'  => request()->ip(),
                'user_agent'  => request()->userAgent(),
            ]);
        } catch (\Exception $e) {
            Log::warning('ActivityLogger gagal: ' . $e->getMessage());
        }
    }
}