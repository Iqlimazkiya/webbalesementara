{{-- resources/views/admin/halaman_home/partials/_berita.blade.php --}}
<div class="section-card">
    <div class="section-card-header">
        <div class="section-icon">📰</div>
        <span class="section-title">Berita & Info</span>
        <i class="bi bi-chevron-down section-chevron"></i>
    </div>
    <div class="section-body">
        <div class="row g-3 mb-3">
            <div class="col-12">
                <label class="form-label">Judul Section</label>
                <input type="text" name="berita_judul" class="form-control"
                       value="{{ old('berita_judul', $hp->berita->judul) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Sub Judul</label>
                <input type="text" name="berita_subjudul" class="form-control"
                       value="{{ old('berita_subjudul', $hp->berita->subjudul) }}">
            </div>
        </div>
        <hr class="my-2">
        <p class="form-label mb-2">Daftar Berita</p>

        <div id="rows-berita">
            @foreach($hp->berita->items as $idx => $item)
            <div class="repeatable-item">
                <div class="repeatable-header">
                    <strong class="small text-muted">Berita #{{ $loop->iteration }}</strong>
                    <button type="button" class="btn-remove-row"><i class="bi bi-trash"></i> Hapus</button>
                </div>
                <input type="hidden" name="berita_items[{{ $idx }}][id]" value="{{ $item->id }}">
                <div class="row g-2">
                    <div class="col-12">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="berita_items[{{ $idx }}][judul]"
                               class="form-control" value="{{ $item->judul }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="berita_items[{{ $idx }}][tanggal]"
                               class="form-control" value="{{ $item->tanggal?->format('Y-m-d') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug (URL)</label>
                        <input type="text" name="berita_items[{{ $idx }}][slug]"
                               class="form-control" value="{{ $item->slug }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="berita_items[{{ $idx }}][ringkasan]"
                                  class="form-control" rows="2">{{ $item->ringkasan }}</textarea>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" name="berita_items[{{ $idx }}][thumbnail]"
                               class="form-control" accept="image/*" data-thumb="thumb-ber-{{ $idx }}">
                        @if($item->thumbnail)
                            <img id="thumb-ber-{{ $idx }}" src="{{ Storage::url($item->thumbnail) }}" class="img-thumb">
                        @else
                            <img id="thumb-ber-{{ $idx }}" src="" class="img-thumb" style="display:none">
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="berita_items[{{ $idx }}][urutan]"
                               class="form-control" value="{{ $item->urutan }}" min="0">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <template id="tmpl-berita">
            <div class="repeatable-item">
                <div class="repeatable-header">
                    <strong class="small text-muted">Berita Baru</strong>
                    <button type="button" class="btn-remove-row"><i class="bi bi-trash"></i> Hapus</button>
                </div>
                <div class="row g-2">
                    <div class="col-12">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="berita_items[__IDX__][judul]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="berita_items[__IDX__][tanggal]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug</label>
                        <input type="text" name="berita_items[__IDX__][slug]" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="berita_items[__IDX__][ringkasan]" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" name="berita_items[__IDX__][thumbnail]" class="form-control" accept="image/*">
                        <img src="" class="img-thumb" style="display:none">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="berita_items[__IDX__][urutan]" class="form-control" value="0" min="0">
                    </div>
                </div>
            </div>
        </template>
        <button type="button" class="btn-add-row mt-2" data-key="berita">
            <i class="bi bi-plus-circle me-1"></i> Tambah Berita
        </button>
    </div>
</div>
