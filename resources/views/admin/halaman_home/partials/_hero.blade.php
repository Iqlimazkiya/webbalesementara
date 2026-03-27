<div class="section-card">
    <div class="section-card-header">
        <div class="section-icon"><i class="bi bi-image"></i></div>
        <div class="section-title">Hero Section</div>
        <i class="bi bi-chevron-down section-chevron"></i>
    </div>
    <div class="section-body">
        {{-- Teks Baris 1: Welcome To --}}
<div class="mb-3">
    <label class="form-label">Teks Baris 1</label>
    <input type="text" name="hero_teks_baris1" class="form-control form-control-sm" value="">
    <div class="form-text">Contoh: Welcome to</div>
</div>

{{-- Teks Baris 2: Bale Hinggil --}}
<div class="mb-3">
    <label class="form-label">Teks Baris 2</label>
    <input type="text" name="hero_teks_baris2" class="form-control form-control-sm" value="">
    <div class="form-text">Contoh: Bale Hinggil</div>
</div>

{{-- Teks Baris 3: Apartemen --}}
<div class="mb-3">
    <label class="form-label">Teks Baris 3</label>
    <input type="text" name="hero_teks_baris3" class="form-control form-control-sm" value="">
    <div class="form-text">Contoh: Apartment</div>
</div>

{{-- Teks Baris 4: Deskripsi --}}
<div class="mb-3">
    <label class="form-label">Teks Baris 4 (Deskripsi)</label>
    <textarea name="hero_subjudul" class="form-control form-control-sm" rows="3"></textarea>
    <div class="form-text">Kalimat panjang di bawah judul utama</div>
</div>

        <hr>

        {{-- Teks Tombol & Nomor CTA --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Teks Tombol</label>
                <input type="text" name="hero_teks_tombol" class="form-control form-control-sm" value="{{ $hp->hero->teks_tombol }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nomor WhatsApp (CTA)</label>
                <input type="text" name="hero_nomor_wa" class="form-control form-control-sm" value="{{ $hp->hero->nomor_wa ?? '' }}">
                <div class="form-text">Gunakan format 628xxx</div>
            </div>
        </div>

        {{-- Video Hero --}}
<div class="mb-3">
    <label class="form-label">Video Hero (MP4)</label>
    <input type="file" name="hero_video" class="form-control form-control-sm" accept="video/mp4">
    <div class="form-text text-danger">Maksimal 100MB. Format MP4 sangat disarankan untuk performa web.</div>
    
    @if($hp->hero->video_path)
        <div class="mt-2 p-2 border rounded bg-white">
            <span class="small d-block mb-1 text-muted">Video saat ini:</span>
            <video width="200" controls class="rounded shadow-sm">
                <source src="{{ asset('storage/' . $hp->hero->video_path) }}" type="video/mp4">
            </video>
        </div>
    @endif
</div>
    </div>
</div>