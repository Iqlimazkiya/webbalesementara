<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user    = $request->user();
        $changes = [];

        // ── Foto profil ──────────────────────────────────────────
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            ]);

            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $user->profile_photo_path = $request->file('photo')->store('profile-photos', 'public');
            $changes[] = 'foto profil';
        }

        // ── Nama & email ─────────────────────────────────────────
        if ($user->name !== $request->name)   $changes[] = 'nama';
        if ($user->email !== $request->email) $changes[] = 'email';

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if (!empty($changes)) {
            ActivityLogger::log(
                'Memperbarui profil: ' . implode(', ', $changes),
                'Admin ' . $user->name . ' mengubah ' . implode(', ', $changes) . ' pada profilnya.'
            );
        }

        return Redirect::route('admin.profile.show')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}