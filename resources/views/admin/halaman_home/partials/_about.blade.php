{{-- resources/views/admin/halaman_home/partials/_about.blade.php --}}
<div class="section-card">
    <div class="section-card-header">
        <div class="section-icon">👥</div>
        <span class="section-title">About Us / Tentang Kami</span>
        <i class="bi bi-chevron-down section-chevron"></i>
    </div>
    <div class="section-body">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Judul</label>
                <input type="text" name="about_judul" class="form-control"
                       value="{{ old('about_judul', $hp->about->judul) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Sub Judul</label>
                <input type="text" name="about_subjudul" class="form-control"
                       value="{{ old('about_subjudul', $hp->about->subjudul) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="about_deskripsi" class="form-control" rows="4">{{ old('about_deskripsi', $hp->about->deskripsi) }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tahun Berdiri</label>
                <input type="text" name="about_tahun_berdiri" class="form-control"
                       value="{{ old('about_tahun_berdiri', $hp->about->tahun_berdiri) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Jumlah Unit</label>
                <input type="text" name="about_jumlah_unit" class="form-control"
                       value="{{ old('about_jumlah_unit', $hp->about->jumlah_unit) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Jumlah Penghuni</label>
                <input type="text" name="about_jumlah_penghuni" class="form-control"
                       value="{{ old('about_jumlah_penghuni', $hp->about->jumlah_penghuni) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Foto <span class="form-text ms-1">(maks 3MB)</span></label>
                <input type="file" name="about_foto" class="form-control" accept="image/*" data-thumb="thumb-about">
                @if($hp->about->foto)
                    <img id="thumb-about" src="{{ Storage::url($hp->about->foto) }}" class="img-thumb">
                @else
                    <img id="thumb-about" src="" class="img-thumb" style="display:none">
                @endif
            </div>
        </div>
    </div>
</div>
