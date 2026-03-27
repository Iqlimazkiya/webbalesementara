{{-- resources/views/admin/halaman_home/partials/_layanan.blade.php --}}
<div class="section-card">
    <div class="section-card-header">
        <div class="section-icon">⭐</div>
        <span class="section-title">Layanan</span>
        <i class="bi bi-chevron-down section-chevron"></i>
    </div>
    <div class="section-body">
        <div class="row g-3 mb-3">
            <div class="col-12">
                <label class="form-label">Judul Section</label>
                <input type="text" name="layanan_judul" class="form-control"
                       value="{{ old('layanan_judul', $hp->layanan->judul) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Sub Judul</label>
                <input type="text" name="layanan_subjudul" class="form-control"
                       value="{{ old('layanan_subjudul', $hp->layanan->subjudul) }}">
            </div>
        </div>
        <hr class="my-2">
        <p class="form-label mb-2">Daftar Layanan</p>

        <div id="rows-layanan">
            @foreach($hp->layanan->items as $idx => $item)
            <div class="repeatable-item">
                <div class="repeatable-header">
                    <strong class="small text-muted">Layanan #{{ $loop->iteration }}</strong>
                    <button type="button" class="btn-remove-row"><i class="bi bi-trash"></i> Hapus</button>
                </div>
                <input type="hidden" name="layanan_items[{{ $idx }}][id]" value="{{ $item->id }}">
                <div class="row g-2">
                    <div class="col-md-8">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" name="layanan_items[{{ $idx }}][nama]"
                               class="form-control" value="{{ $item->nama }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="layanan_items[{{ $idx }}][urutan]"
                               class="form-control" value="{{ $item->urutan }}" min="0">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="layanan_items[{{ $idx }}][deskripsi]"
                                  class="form-control" rows="2">{{ $item->deskripsi }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Foto <span class="form-text ms-1">(opsional)</span></label>
                        <input type="file" name="layanan_items[{{ $idx }}][foto]"
                               class="form-control" accept="image/*" data-thumb="thumb-lay-{{ $idx }}">
                        @if($item->foto)
                            <img id="thumb-lay-{{ $idx }}" src="{{ Storage::url($item->foto) }}" class="img-thumb">
                        @else
                            <img id="thumb-lay-{{ $idx }}" src="" class="img-thumb" style="display:none">
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <template id="tmpl-layanan">
            <div class="repeatable-item">
                <div class="repeatable-header">
                    <strong class="small text-muted">Layanan Baru</strong>
                    <button type="button" class="btn-remove-row"><i class="bi bi-trash"></i> Hapus</button>
                </div>
                <div class="row g-2">
                    <div class="col-md-8">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" name="layanan_items[__IDX__][nama]" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="layanan_items[__IDX__][urutan]" class="form-control" value="0" min="0">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="layanan_items[__IDX__][deskripsi]" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Foto</label>
                        <input type="file" name="layanan_items[__IDX__][foto]" class="form-control" accept="image/*">
                        <img src="" class="img-thumb" style="display:none">
                    </div>
                </div>
            </div>
        </template>
        <button type="button" class="btn-add-row mt-2" data-key="layanan">
            <i class="bi bi-plus-circle me-1"></i> Tambah Layanan
        </button>
    </div>
</div>
