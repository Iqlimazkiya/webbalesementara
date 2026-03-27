<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label for="update_password_current_password" class="form-label">
            Password Saat Ini
        </label>
        <input type="password"
               id="update_password_current_password"
               name="current_password"
               class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
               autocomplete="current-password">
        @error('current_password', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="update_password_password" class="form-label">Password Baru</label>
        <input type="password"
               id="update_password_password"
               name="password"
               class="form-control @error('password', 'updatePassword') is-invalid @enderror"
               autocomplete="new-password">
        @error('password', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label for="update_password_password_confirmation" class="form-label">
            Konfirmasi Password Baru
        </label>
        <input type="password"
               id="update_password_password_confirmation"
               name="password_confirmation"
               class="form-control"
               autocomplete="new-password">
    </div>

    <button type="submit" class="btn" style="background:#335A40; color:white;">
        Perbarui Password
    </button>

    @if(session('status') === 'password-updated')
    <span class="ms-3 text-success" style="font-size:.85rem;">
        Password berhasil diubah!
    </span>
    @endif
</form>