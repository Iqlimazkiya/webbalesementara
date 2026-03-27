{{-- Bagian foto — tidak punya form sendiri, ikut form di update-profile-information-form --}}
<div class="text-center">
    <div class="mb-3" style="position:relative; display:inline-block;">
        <div style="width:110px; height:110px; border-radius:50%;
                    overflow:hidden; margin:0 auto;
                    border:3px solid #335A40;
                    background:#e9ecef;
                    display:flex; align-items:center; justify-content:center;">
            @if(Auth::user()->profile_photo_path)
                <img id="avatarPreview"
                     src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                     alt="Foto Profil"
                     style="width:100%; height:100%; object-fit:cover;">
            @else
                <img id="avatarPreview" src="" alt=""
                     style="width:100%; height:100%; object-fit:cover; display:none;">
                <span id="avatarInitial"
                      style="font-size:2.8rem; font-weight:700; color:#335A40; text-transform:uppercase;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </span>
            @endif
        </div>

        {{-- Tombol kamera --}}
        <label for="photoInput" title="Ganti foto"
               style="position:absolute; bottom:4px; right:4px;
                      width:30px; height:30px; border-radius:50%;
                      background:#335A40; cursor:pointer;
                      display:flex; align-items:center; justify-content:center;
                      border:2px solid white; margin:0;">
            <i class="bi bi-camera-fill" style="color:white; font-size:.7rem;"></i>
        </label>
    </div>

    <p class="fw-semibold mb-0" style="font-size:.9rem;">{{ Auth::user()->name }}</p>
    <p class="text-muted mb-0" style="font-size:.75rem;">{{ Auth::user()->email }}</p>

    {{-- Input file tersembunyi — dikiri submit bareng form utama --}}
    <input type="file" id="photoInput" name="photo"
           accept="image/jpg,image/jpeg,image/png,image/webp"
           style="display:none;">

    {{-- Hapus foto — form terpisah karena method DELETE --}}
    @if(Auth::user()->profile_photo_path)
    <form method="POST" action="{{ route('admin.profile.photo.delete') }}" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger"
                style="font-size:.75rem;"
                onclick="return confirm('Hapus foto profil?')">
            Hapus Foto
        </button>
    </form>
    @endif

    @if(session('photo-deleted'))
    <div class="alert alert-info mt-2 py-1 mb-0" style="font-size:.78rem;">
        Foto berhasil dihapus.
    </div>
    @endif
</div>