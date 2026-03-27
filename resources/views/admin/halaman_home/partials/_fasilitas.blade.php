{{-- resources/views/admin/halaman_home/partials/_fasilitas.blade.php --}}
<div class="section-card">
    <div class="section-card-header">
        <div class="section-icon">🏊</div>
        <span class="section-title">Fasilitas</span>
        <i class="bi bi-chevron-down section-chevron"></i>
    </div>
    <div class="section-body">
        <div class="row g-3 mb-3">
            <div class="col-12">
                <label class="form-label">Judul Section</label>
                <input type="text" name="fasilitas_judul" class="form-control"
                       value="{{ old('fasilitas_judul', $hp->fasilitas->judul) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Sub Judul</label>
                <input type="text" name="fasilitas_subjudul" class="form-control"
                       value="{{ old('fasilitas_subjudul', $hp->fasilitas->subjudul) }}">
            </div>
        </div>
        <hr class="my-2">
        <p class="form-label mb-2">Daftar Fasilitas</p>

        <div id="rows-fasilitas">
            @foreach($hp->fasilitas->items as $idx => $item)
            <div class="repeatable-item">
                <div class="repeatable-header">
                    <strong class="small text-muted">Fasilitas #{{ $loop->iteration }}</strong>
                    <button type="button" class="btn-remove-row"><i class="bi bi-trash"></i> Hapus</button>
                </div>
                <input type="hidden" name="fasilitas_items[{{ $idx }}][id]" value="{{ $item->id }}">
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="fasilitas_items[{{ $idx }}][nama]"
                               class="form-control" value="{{ $item->nama }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Icon</label>
                        <select name="fasilitas_items[{{ $idx }}][icon]" class="form-select">
                            @foreach(['wifi'=>'WiFi','pool'=>'Kolam Renang','gym'=>'Gym','parking'=>'Parkir','security'=>'Security 24 Jam','garden'=>'Taman','laundry'=>'Laundry','restaurant'=>'Restoran','other'=>'Lainnya'] as $v => $l)
                                <option value="{{ $v }}" @selected($item->icon === $v)>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi Singkat</label>
                        <input type="text" name="fasilitas_items[{{ $idx }}][deskripsi]"
                               class="form-control" value="{{ $item->deskripsi }}">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Foto</label>
                        <input type="file" name="fasilitas_items[{{ $idx }}][foto]"
                               class="form-control" accept="image/*" data-thumb="thumb-fas-{{ $idx }}">
                        @if($item->foto)
                            <img id="thumb-fas-{{ $idx }}" src="{{ Storage::url($item->foto) }}" class="img-thumb">
                        @else
                            <img id="thumb-fas-{{ $idx }}" src="" class="img-thumb" style="display:none">
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="fasilitas_items[{{ $idx }}][urutan]"
                               class="form-control" value="{{ $item->urutan }}" min="0">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <template id="tmpl-fasilitas">
            <div class="repeatable-item">
                <div class="repeatable-header">
                    <strong class="small text-muted">Fasilitas Baru</strong>
                    <button type="button" class="btn-remove-row"><i class="bi bi-trash"></i> Hapus</button>
                </div>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="fasilitas_items[__IDX__][nama]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Icon</label>
                        <select name="fasilitas_items[__IDX__][icon]" class="form-select">
                            <option value="wifi">WiFi</option>
                            <option value="pool">Kolam Renang</option>
                            <option value="gym">Gym</option>
                            <option value="parking">Parkir</option>
                            <option value="security">Security 24 Jam</option>
                            <option value="garden">Taman</option>
                            <option value="laundry">Laundry</option>
                            <option value="restaurant">Restoran</option>
                            <option value="other" selected>Lainnya</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi Singkat</label>
                        <input type="text" name="fasilitas_items[__IDX__][deskripsi]" class="form-control">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Foto</label>
                        <input type="file" name="fasilitas_items[__IDX__][foto]" class="form-control" accept="image/*">
                        <img src="" class="img-thumb" style="display:none">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="fasilitas_items[__IDX__][urutan]" class="form-control" value="0" min="0">
                    </div>
                </div>
            </div>
        </template>
        <button type="button" class="btn-add-row mt-2" data-key="fasilitas">
            <i class="bi bi-plus-circle me-1"></i> Tambah Fasilitas
        </button>
    </div>
</div>
