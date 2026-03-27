<?php
// app/Models/Setting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'type'
    ];

    protected $casts = [
        'value' => 'string'
    ];

    // Helper untuk get setting
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        // Parse berdasarkan type
        return match($setting->type) {
            'json' => json_decode($setting->value, true) ?? $default,
            'image', 'video' => $setting->value ? asset($setting->value) : $default,
            default => $setting->value ?? $default,
        };
    }

    // Helper untuk get banyak settings sekaligus
    public static function getMany(array $keys)
    {
        $settings = self::whereIn('key', $keys)->get()->keyBy('key');
        
        return collect($keys)->mapWithKeys(function($key) use ($settings) {
            $setting = $settings->get($key);
            $value = $setting->value ?? null;
            
            // Parse berdasarkan type
            if ($setting) {
                $value = match($setting->type) {
                    'json' => json_decode($setting->value, true),
                    default => $setting->value,
                };
            }
            
            return [$key => $value];
        })->toArray();
    }
}