<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        /** @var User $user */
        $user     = Auth::user();
        $isUpdate = (bool) $user->profile_photo_path;

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');
        $user->update(['profile_photo_path' => $path]);

        ActivityLogger::log(
            $isUpdate ? 'Memperbarui foto profil' : 'Mengunggah foto profil',
            'Admin ' . $user->name . ' ' . ($isUpdate ? 'mengganti' : 'menambahkan') . ' foto profil.'
        );

        return back()->with('photo-updated', true);
    }

    public function deletePhoto()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->update(['profile_photo_path' => null]);

            ActivityLogger::log(
                'Menghapus foto profil',
                'Admin ' . $user->name . ' menghapus foto profilnya.'
            );
        }

        return back()->with('photo-deleted', true);
    }
}