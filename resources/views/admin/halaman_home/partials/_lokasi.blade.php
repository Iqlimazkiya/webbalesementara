{{-- resources/views/admin/halaman_home/partials/_lokasi.blade.php --}}
<div class="section-card">
    <div class="section-card-header">
        <div class="section-icon">📍</div>
        <span class="section-title">Lokasi</span>
        <i class="bi bi-chevron-down section-chevron"></i>
    </div>
    <div class="section-body">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Judul</label>
                <input type="text" name="lokasi_judul" class="form-control"
                       value="{{ old('lokasi_judul', $hp->lokasi->judul) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Sub Judul</label>
                <input type="text" name="lokasi_subjudul" class="form-control"
                       value="{{ old('lokasi_subjudul', $hp->lokasi->subjudul) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="lokasi_alamat_lengkap" class="form-control" rows="2">{{ old('lokasi_alamat_lengkap', $hp->lokasi->alamat_lengkap) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">URL Embed Google Maps
                    <span class="form-text ms-1">(paste nilai src dari iframe embed)</span>
                </label>
                <textarea name="lokasi_embed_maps_url" class="form-control" rows="2"
                          placeholder="https://www.google.com/maps/embed?pb=...">{{ old('lokasi_embed_maps_url', $hp->lokasi->embed_maps_url) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Keterangan 1</label>
                <input type="text" name="lokasi_keterangan_1" class="form-control"
                       value="{{ old('lokasi_keterangan_1', $hp->lokasi->keterangan_1) }}"
                       placeholder="Misal: 5 menit ke pusat kota">
            </div>
            <div class="col-12">
                <label class="form-label">Keterangan 2</label>
                <input type="text" name="lokasi_keterangan_2" class="form-control"
                       value="{{ old('lokasi_keterangan_2', $hp->lokasi->keterangan_2) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Keterangan 3</label>
                <input type="text" name="lokasi_keterangan_3" class="form-control"
                       value="{{ old('lokasi_keterangan_3', $hp->lokasi->keterangan_3) }}">
            </div>
        </div>
    </div>
</div>
