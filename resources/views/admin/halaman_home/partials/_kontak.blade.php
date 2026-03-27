{{-- resources/views/admin/halaman_home/partials/_kontak.blade.php --}}
<div class="section-card">
    <div class="section-card-header">
        <div class="section-icon">📞</div>
        <span class="section-title">Kontak</span>
        <i class="bi bi-chevron-down section-chevron"></i>
    </div>
    <div class="section-body">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Judul</label>
                <input type="text" name="kontak_judul" class="form-control"
                       value="{{ old('kontak_judul', $hp->kontak->judul) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Sub Judul</label>
                <input type="text" name="kontak_subjudul" class="form-control"
                       value="{{ old('kontak_subjudul', $hp->kontak->subjudul) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="kontak_nomor_telepon" class="form-control"
                       value="{{ old('kontak_nomor_telepon', $hp->kontak->nomor_telepon) }}"
                       placeholder="+62 21 xxxx xxxx">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor WhatsApp</label>
                <input type="text" name="kontak_nomor_whatsapp" class="form-control"
                       value="{{ old('kontak_nomor_whatsapp', $hp->kontak->nomor_whatsapp) }}"
                       placeholder="+62 8xx xxxx xxxx">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="kontak_email" class="form-control"
                       value="{{ old('kontak_email', $hp->kontak->email) }}">
                @error('kontak_email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Jam Operasional</label>
                <input type="text" name="kontak_jam_operasional" class="form-control"
                       value="{{ old('kontak_jam_operasional', $hp->kontak->jam_operasional) }}"
                       placeholder="Senin–Jumat, 08.00–17.00">
            </div>
            <div class="col-md-6">
                <label class="form-label">Instagram URL</label>
                <input type="url" name="kontak_instagram" class="form-control"
                       value="{{ old('kontak_instagram', $hp->kontak->instagram) }}"
                       placeholder="https://instagram.com/...">
                @error('kontak_instagram')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Facebook URL</label>
                <input type="url" name="kontak_facebook" class="form-control"
                       value="{{ old('kontak_facebook', $hp->kontak->facebook) }}"
                       placeholder="https://facebook.com/...">
                @error('kontak_facebook')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
