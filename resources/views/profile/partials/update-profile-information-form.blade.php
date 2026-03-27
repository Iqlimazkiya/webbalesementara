<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-group mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" id="name" name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name) }}"
               required autofocus autocomplete="name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email) }}"
               required autocomplete="username">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex align-items-center gap-3 flex-wrap">
        <button type="submit" class="btn" style="background:#335A40; color:white;">
            Simpan Perubahan
        </button>
        <a href="{{ route('admin.profile.show') }}"
           class="btn btn-outline-secondary">
            Kembali
        </a>

        @if(session('status') === 'profile-updated')
        <span class="text-success" style="font-size:.85rem;">
            Tersimpan!
        </span>
        @endif
    </div>
</form>