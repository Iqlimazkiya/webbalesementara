<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_line_1'        => 'nullable|string|max:255',
            'hero_line_2'        => 'nullable|string|max:255',
            'hero_image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'unit_section_title' => 'nullable|string|max:255',
            'unit_section_desc'  => 'nullable|string',
            'main_video'         => 'nullable|mimes:mp4,mov,avi|max:20480',
            'cta_title'          => 'nullable|string|max:255',
            'cta_desc'           => 'nullable|string',
            'cta_image'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'family_count'       => 'nullable|string|max:50',
            'whatsapp_number'    => 'nullable|string|max:20',
        ]);

        $textFields = [
            'hero_line_1', 'hero_line_2',
            'unit_section_title', 'unit_section_desc',
            'cta_title', 'cta_desc',
            'family_count', 'whatsapp_number',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                Setting::updateOrCreate(['key' => $field], ['value' => $request->$field, 'type' => 'text']);
            }
        }

        $changedFiles = [];

        if ($request->hasFile('hero_image')) {
            $old = Setting::where('key', 'hero_image')->first();
            if ($old?->value) Storage::disk('public')->delete($old->value);
            $path = $request->file('hero_image')->store('settings/hero', 'public');
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => $path, 'type' => 'image']);
            $changedFiles[] = 'hero image';
        }

        if ($request->hasFile('cta_image')) {
            $old = Setting::where('key', 'cta_image')->first();
            if ($old?->value) Storage::disk('public')->delete($old->value);
            $path = $request->file('cta_image')->store('settings/cta', 'public');
            Setting::updateOrCreate(['key' => 'cta_image'], ['value' => $path, 'type' => 'image']);
            $changedFiles[] = 'CTA image';
        }

        if ($request->hasFile('main_video')) {
            $old = Setting::where('key', 'main_video')->first();
            if ($old?->value) Storage::disk('public')->delete($old->value);
            $path = $request->file('main_video')->store('settings/videos', 'public');
            Setting::updateOrCreate(['key' => 'main_video'], ['value' => $path, 'type' => 'video']);
            $changedFiles[] = 'video utama';
        }

        $detail = empty($changedFiles)
            ? 'Teks pengaturan diperbarui'
            : 'Teks diperbarui, file diubah: ' . implode(', ', $changedFiles);

        ActivityLogger::log('Pengaturan website diperbarui', $detail);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function destroy($key)
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting) {
            if ($setting->value) Storage::disk('public')->delete($setting->value);
            $setting->update(['value' => null]);

            ActivityLogger::log(
                'File pengaturan dihapus',
                'Key "' . $key . '" dikosongkan dari pengaturan'
            );

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}