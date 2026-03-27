@extends('layouts.admin.main')

@section('title', 'Edit Cleaning Order')

@push('styles')
<style>
.edit-layout {
    display: grid;
    grid-template-columns: 440px 1fr;
    gap: 0;
    height: calc(100vh - 70px);
    overflow: hidden;
}
.edit-form-panel {
    overflow-y: auto;
    border-right: 1px solid #e5e7eb;
    background: #fff;
    display: flex;
    flex-direction: column;
}
.edit-preview-panel {
    overflow: hidden;
    background: #e9ecef;
    position: relative;
    display: flex;
    flex-direction: column;
}
.form-panel-header {
    position: sticky;
    top: 0;
    z-index: 10;
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
}
.form-scroll-area {
    flex: 1;
    overflow-y: auto;
    min-height: 0;
    padding-bottom: 0;
}
.section-accordion { border-bottom: 1px solid #e5e7eb; }
.section-accordion-header {
    padding: 14px 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    background: transparent;
    user-select: none;
    transition: background .15s;
}
.section-accordion-header:hover { background: #f9fafb; }
.section-accordion-title { font-size: 13px; font-weight: 600; color: #1f2937; flex: 1; }
.accordion-chevron { color: #9ca3af; transition: transform .25s; font-size: 13px; }
.accordion-chevron.open { transform: rotate(90deg); }
.section-accordion-body { display: none; padding: 16px 20px; }
.section-accordion-body.open { display: block; }

.field-label {
    font-size: 11px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px;
    color: #6b7280; margin-bottom: 5px;
}
.field-input {
    width: 100%;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 13px;
    color: #1f2937;
    transition: border-color .15s;
    outline: none;
}
.field-input:focus { border-color: #335A40; }
.field-group { margin-bottom: 14px; }
.foto-upload-hero {
    border: 2px dashed #d1d5db;
    border-radius: 10px;
    overflow: hidden;
    background: #f8fafc;
    position: relative;
    cursor: pointer;
    transition: border-color .2s, box-shadow .2s;
}
.foto-upload-hero:hover {
    border-color: #335A40;
    box-shadow: 0 0 0 3px rgba(51,90,64,.08);
}
.foto-hero-wrap {
    position: relative;
    width: 100%;
    height: 120px;
}
.foto-hero-wrap img {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
}
.foto-hero-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.45);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 4px; color: #fff;
    opacity: 0; transition: opacity .2s;
    font-size: 12px; font-weight: 600;
    pointer-events: none;
}
.foto-upload-hero:hover .foto-hero-overlay { opacity: 1; }
.foto-placeholder-hero {
    height: 120px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 6px; color: #9ca3af; font-size: 12px;
}
.foto-hero-badge {
    display: inline-flex; align-items: center; gap: 4px;
    background: #f0fdf4; color: #166534;
    border: 1px solid #bbf7d0;
    border-radius: 20px; padding: 3px 10px;
    font-size: 10px; font-weight: 700;
    margin-top: 8px;
}
.galeri-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    margin-bottom: 10px;
}
.galeri-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    aspect-ratio: 1;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
}
.galeri-item img {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
    transition: opacity .2s;
}
.galeri-item .hapus-btn {
    position: absolute;
    top: 4px; right: 4px;
    width: 20px; height: 20px;
    background: rgba(239,68,68,0.9);
    color: #fff;
    border: none;
    border-radius: 50%;
    font-size: 11px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    line-height: 1;
    transition: background .15s;
    z-index: 2;
}
.galeri-item .hapus-btn:hover { background: #dc2626; }
.galeri-item .hapus-overlay {
    position: absolute; inset: 0;
    background: rgba(239,68,68,0.4);
    display: none; align-items: center; justify-content: center;
    z-index: 1;
}
.galeri-item.marked-hapus .hapus-overlay { display: flex; }
.galeri-item.marked-hapus img { opacity: 0.4; }

.foto-upload-slot {
    border: 1px dashed #d1d5db;
    border-radius: 10px;
    overflow: hidden;
    background: #f8fafc;
    position: relative;
    cursor: pointer;
    transition: border-color .2s;
}
.foto-upload-slot:hover { border-color: #335A40; }
.foto-upload-slot .foto-placeholder {
    height: 70px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 4px; color: #9ca3af; font-size: 11px;
    pointer-events: none;
}
.tarif-row {
    display: grid;
    gap: 6px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 10px 12px;
    margin-bottom: 8px;
    position: relative;
}
.tarif-row-cleaning { grid-template-columns: 1.2fr 1fr 1fr 1fr 1fr 28px; }
.tarif-row-tambahan { grid-template-columns: 1.2fr 1fr 1fr 1fr 28px; }
.tarif-row-cuci     { grid-template-columns: 1.5fr 1fr 1fr 1fr 28px; }
.tarif-row-berkala  { grid-template-columns: 1.5fr 1fr 1fr 1fr 1fr 28px; }
.tarif-mini-input {
    width: 100%;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 5px 8px;
    font-size: 12px;
    outline: none;
    transition: border-color .15s;
}
.tarif-mini-input:focus { border-color: #335A40; }
.btn-remove-row {
    width: 28px; height: 28px;
    border: none; background: #fef2f2;
    border-radius: 6px; color: #ef4444;
    cursor: pointer; display: flex;
    align-items: center; justify-content: center;
    align-self: end; flex-shrink: 0;
    transition: background .15s;
}
.btn-remove-row:hover { background: #fee2e2; }
.btn-add-row {
    width: 100%;
    border: 1px dashed #d1d5db;
    background: #f8fafc;
    border-radius: 8px;
    padding: 7px;
    font-size: 12px; color: #335A40;
    font-weight: 600; cursor: pointer;
    transition: all .15s;
    text-align: center;
}
.btn-add-row:hover { border-color: #335A40; background: #f0fdf4; }

.ketentuan-row { display: flex; gap: 6px; align-items: center; margin-bottom: 6px; }
.ketentuan-num {
    width: 22px; height: 22px;
    background: #335A40; color: #fff;
    border-radius: 50%;
    font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

.submit-bar {
    background: #fff;
    border-top: 1px solid #e5e7eb;
    padding: 12px 20px;
    display: flex;
    gap: 10px;
    align-items: center;
    flex-shrink: 0;
}

.preview-panel-header {
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    padding: 10px 16px;
    display: flex; align-items: center;
    gap: 8px; flex-shrink: 0;
}
.preview-iframe-wrap { flex: 1; overflow: hidden; position: relative; }
.preview-iframe-wrap iframe { width: 100%; height: 100%; border: none; }
.iframe-loading {
    position: absolute; inset: 0;
    background: #e9ecef;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 10px; z-index: 5;
    transition: opacity .3s;
}
.iframe-loading.hidden { opacity: 0; pointer-events: none; }

@media (max-width: 768px) {
    .edit-layout { grid-template-columns: 1fr; height: auto; overflow: visible; }
    .edit-form-panel { height: auto; overflow-y: visible; border-right: none; border-bottom: 2px solid #e5e7eb; }
    .edit-preview-panel { height: 500px; }
    .galeri-grid { grid-template-columns: repeat(3, 1fr); }
}
</style>
@endpush

@section('content')
<div class="edit-layout">

    {{-- Form Panel Kiri --}}
    <div class="edit-form-panel">

        <div class="form-panel-header">
            <a href="{{ route('admin.layananco.index') }}"
               class="btn btn-sm btn-light border" style="padding:5px 10px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <div style="font-size:13px; font-weight:700; color:#1f2937;">Edit Cleaning Order</div>
                <div style="font-size:11px; color:#9ca3af;">Preview langsung di kanan</div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success mx-3 mt-3 mb-0 py-2" style="font-size:12px;">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
        </div>
        @endif

        <form id="mainForm"
              action="{{ route('admin.layananco.update') }}"
              method="POST"
              enctype="multipart/form-data"
              style="display:flex; flex-direction:column; flex:1; min-height:0;">

            @csrf
            @method('PUT')
            <div id="hapus-galeri-inputs"></div>
            <div id="hapus-slide-inputs"></div>
            <div class="form-scroll-area">

            {{--Hero--}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Foto Hero</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <p style="font-size:11px; color:#9ca3af; margin-bottom:10px;">
                        Background foto di bagian hero atas halaman. Klik area foto untuk menggantinya.
                    </p>
                    <div class="foto-upload-hero" id="heroUploadZone">
                        @if($co->foto_hero)
                            <div class="foto-hero-wrap">
                                <img id="thumb_hero" src="{{ $co->fotoUrl($co->foto_hero) }}" alt="Foto Hero">
                                <div class="foto-hero-overlay">
                                    <i class="bi bi-camera" style="font-size:20px;"></i>
                                    <span>Klik untuk ganti foto</span>
                                </div>
                            </div>
                        @else
                            <div class="foto-placeholder-hero" id="heroPlaceholder">
                                <i class="bi bi-image" style="font-size:28px; color:#d1d5db;"></i>
                                <span style="font-weight:600; color:#6b7280;">Belum ada foto hero</span>
                                <span style="font-size:10px; color:#9ca3af;">Klik untuk upload</span>
                            </div>
                        @endif
                    </div>

                    <div style="margin-top:8px; display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                        @if($co->foto_hero)
                            <span class="foto-hero-badge" id="heroBadge">
                                <i class="bi bi-check-circle-fill"></i> Foto terpasang
                            </span>
                        @else
                            <span class="foto-hero-badge" id="heroBadge"
                                  style="background:#fffbeb; color:#92400e; border-color:#fde68a;">
                                <i class="bi bi-exclamation-circle"></i> Belum ada foto
                            </span>
                        @endif
                        <span id="heroFileName" style="font-size:11px; color:#9ca3af; display:none;"></span>
                    </div>
                    <input type="file" name="foto_hero" id="inputFotoHero"
                           accept="image/*" style="display:none;"
                           onchange="handleHeroUpload(this)">
                </div>
            </div>

            {{--Foto Slideshow--}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Foto Slideshow</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <p style="font-size:11px; color:#9ca3af; margin-bottom:12px;">
                        Foto slideshow promo full-width. Klik <strong>×</strong> untuk tandai hapus (bisa di-undo),
                        hapus baru berlaku setelah klik Simpan.
                    </p>

                    @php $slideSaved = $co->foto_slide ?? []; @endphp
                    <div class="galeri-grid" id="slide-saved-grid">
                        @foreach($slideSaved as $si => $foto)
                        <div class="galeri-item" id="slide-item-{{ $si }}" data-index="{{ $si }}">
                            <img src="{{ $co->fotoUrl($foto) }}" alt="Slide {{ $si+1 }}">
                            <button type="button" class="hapus-btn"
                                    onclick="tandaiHapusSlide({{ $si }}, this)"
                                    title="Hapus foto ini">×</button>
                            <div class="hapus-overlay">
                                <span style="color:#fff; font-size:10px; font-weight:700; text-align:center; padding:4px;">Akan<br>dihapus</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="foto-upload-slot" id="slideUploadZone">
                        <div class="foto-placeholder">
                            <i class="bi bi-plus-circle" style="font-size:22px;"></i>
                            <span>Tambah foto slide baru (bisa pilih banyak sekaligus)</span>
                        </div>
                    </div>
                    <input type="file" name="foto_slide_baru[]" id="inputSlide"
                           accept="image/*" multiple style="display:none;"
                           onchange="previewSlideBaru(this)">

                    <div class="galeri-grid mt-2" id="slide-preview-baru" style="display:none;"></div>
                </div>
            </div>

            {{--Galeri Hasil Kerja--}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Galeri Hasil Kerja</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <p style="font-size:11px; color:#9ca3af; margin-bottom:12px;">
                        Foto-foto hasil kerja tim. Klik <strong>×</strong> untuk tandai hapus (bisa di-undo),
                        hapus baru berlaku setelah klik Simpan.
                    </p>

                    @php $galeriSaved = $co->foto_galeri ?? []; @endphp
                    <div class="galeri-grid" id="galeri-saved-grid">
                        @foreach($galeriSaved as $gi => $foto)
                        <div class="galeri-item" id="galeri-item-{{ $gi }}" data-index="{{ $gi }}">
                            <img src="{{ $co->fotoUrl($foto) }}" alt="Galeri {{ $gi+1 }}">
                            <button type="button" class="hapus-btn"
                                    onclick="tandaiHapusGaleri({{ $gi }}, this)"
                                    title="Hapus foto ini">×</button>
                            <div class="hapus-overlay">
                                <span style="color:#fff; font-size:10px; font-weight:700; text-align:center; padding:4px;">Akan<br>dihapus</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="foto-upload-slot" id="galeriUploadZone">
                        <div class="foto-placeholder">
                            <i class="bi bi-plus-circle" style="font-size:22px;"></i>
                            <span>Tambah foto baru (bisa pilih banyak sekaligus)</span>
                        </div>
                    </div>
                    <input type="file" name="foto_galeri_baru[]" id="inputGaleri"
                           accept="image/*" multiple style="display:none;"
                           onchange="previewGaleriBaru(this)">

                    <div class="galeri-grid mt-2" id="galeri-preview-baru" style="display:none;"></div>
                </div>
            </div>

            {{--Tarif Cleaning Unit--}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Tarif Cleaning Unit</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div style="display:grid; grid-template-columns: 1.2fr 1fr 1fr 1fr 1fr 28px; gap:6px; padding:0 0 6px; margin-bottom:6px; border-bottom:1px solid #f1f5f9;">
                        @foreach(['Type','Kondisi','Tarif','Petugas','Durasi',''] as $h)
                        <span style="font-size:9px; font-weight:700; color:#9ca3af; text-transform:uppercase;">{{ $h }}</span>
                        @endforeach
                    </div>
                    <div id="rows_cleaning">
                        @forelse($co->tarif_cleaning ?? [] as $i => $r)
                        <div class="tarif-row tarif-row-cleaning">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[{{ $i }}][type]"    value="{{ $r['type'] }}"    placeholder="Studio"        oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[{{ $i }}][kondisi]" value="{{ $r['kondisi'] }}" placeholder="Bersih Ringan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[{{ $i }}][tarif]"   value="{{ $r['tarif'] }}"   placeholder="Rp 150.000"   oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[{{ $i }}][petugas]" value="{{ $r['petugas'] }}" placeholder="2 org"        oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[{{ $i }}][durasi]"  value="{{ $r['durasi'] }}"  placeholder="2–3 jam"      oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_cleaning',1)"><i class="bi bi-x"></i></button>
                        </div>
                        @empty
                        <div class="tarif-row tarif-row-cleaning">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[0][type]"    placeholder="Studio"        oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[0][kondisi]" placeholder="Bersih Ringan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[0][tarif]"   placeholder="Rp 150.000"   oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[0][petugas]" placeholder="2 org"        oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cleaning[0][durasi]"  placeholder="2–3 jam"      oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_cleaning',1)"><i class="bi bi-x"></i></button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-row" onclick="addRowCleaning()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Baris
                    </button>
                </div>
            </div>

            {{--Tarif Tambahan --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Tarif Tambahan (per area)</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div style="display:grid; grid-template-columns: 1.2fr 1fr 1fr 1fr 28px; gap:6px; padding:0 0 6px; margin-bottom:6px; border-bottom:1px solid #f1f5f9;">
                        @foreach(['Area','Tarif','Petugas','Durasi',''] as $h)
                        <span style="font-size:9px; font-weight:700; color:#9ca3af; text-transform:uppercase;">{{ $h }}</span>
                        @endforeach
                    </div>
                    <div id="rows_tambahan">
                        @forelse($co->tarif_tambahan ?? [] as $i => $t)
                        <div class="tarif-row tarif-row-tambahan">
                            <input class="tarif-mini-input" type="text" name="tarif_tambahan[{{ $i }}][area]"    value="{{ $t['area'] }}"    placeholder="Balkon"    oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_tambahan[{{ $i }}][tarif]"   value="{{ $t['tarif'] }}"   placeholder="Rp 25.000" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_tambahan[{{ $i }}][petugas]" value="{{ $t['petugas'] }}" placeholder="1 org"     oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_tambahan[{{ $i }}][durasi]"  value="{{ $t['durasi'] }}"  placeholder="30 mnt"    oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_tambahan',1)"><i class="bi bi-x"></i></button>
                        </div>
                        @empty
                        <div class="tarif-row tarif-row-tambahan">
                            <input class="tarif-mini-input" type="text" name="tarif_tambahan[0][area]"    placeholder="Balkon"    oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_tambahan[0][tarif]"   placeholder="Rp 25.000" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_tambahan[0][petugas]" placeholder="1 org"     oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_tambahan[0][durasi]"  placeholder="30 mnt"    oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_tambahan',1)"><i class="bi bi-x"></i></button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-row" onclick="addRowTambahan()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Area
                    </button>
                </div>
            </div>

            {{--Tarif Cuci --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Cuci Sofa, Bed & Karpet</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div style="display:grid; grid-template-columns: 1.5fr 1fr 1fr 1fr 28px; gap:6px; padding:0 0 6px; margin-bottom:6px; border-bottom:1px solid #f1f5f9;">
                        @foreach(['Nama Item','Satuan','Durasi','Tarif',''] as $h)
                        <span style="font-size:9px; font-weight:700; color:#9ca3af; text-transform:uppercase;">{{ $h }}</span>
                        @endforeach
                    </div>
                    <div id="rows_cuci">
                        @forelse($co->tarif_cuci ?? [] as $i => $item)
                        <div class="tarif-row tarif-row-cuci">
                            <input class="tarif-mini-input" type="text" name="tarif_cuci[{{ $i }}][nama]"   value="{{ $item['nama'] }}"   placeholder="Sofa 3 Seater" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cuci[{{ $i }}][satuan]" value="{{ $item['satuan'] }}" placeholder="per unit"      oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cuci[{{ $i }}][durasi]" value="{{ $item['durasi'] }}" placeholder="3–4 jam"       oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cuci[{{ $i }}][tarif]"  value="{{ $item['tarif'] }}"  placeholder="Rp 200.000"    oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_cuci',1)"><i class="bi bi-x"></i></button>
                        </div>
                        @empty
                        <div class="tarif-row tarif-row-cuci">
                            <input class="tarif-mini-input" type="text" name="tarif_cuci[0][nama]"   placeholder="Sofa 3 Seater" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cuci[0][satuan]" placeholder="per unit"      oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cuci[0][durasi]" placeholder="3–4 jam"       oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_cuci[0][tarif]"  placeholder="Rp 200.000"    oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_cuci',1)"><i class="bi bi-x"></i></button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-row" onclick="addRowCuci()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Item
                    </button>
                </div>
            </div>

            {{-- Tarif Perawatan Berkala --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">
                        Perawatan Berkala
                        @if(empty($co->tarif_berkala))
                        <span style="font-size:10px; color:#f59e0b; font-weight:600; margin-left:6px;">Belum terisi</span>
                        @endif
                    </span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    @if(empty($co->tarif_berkala))
                    <div class="alert alert-warning py-2 mb-3" style="font-size:12px; border-radius:8px;">
                        <i class="bi bi-info-circle me-1"></i>
                        Paket perawatan berkala belum diisi. Tambahkan paket di bawah ini.
                    </div>
                    @endif
                    <div style="display:grid; grid-template-columns: 1.5fr 1fr 1fr 1fr 1fr 28px; gap:6px; padding:0 0 6px; margin-bottom:6px; border-bottom:1px solid #f1f5f9;">
                        @foreach(['Nama Paket','Satuan','Durasi','Petugas','Tarif',''] as $h)
                        <span style="font-size:9px; font-weight:700; color:#9ca3af; text-transform:uppercase;">{{ $h }}</span>
                        @endforeach
                    </div>
                    <div id="rows_berkala">
                        @foreach($co->tarif_berkala ?? [] as $i => $item)
                        <div class="tarif-row tarif-row-berkala">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][nama]"    value="{{ $item['nama'] }}"          placeholder="Paket Bulanan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][satuan]"  value="{{ $item['satuan'] }}"         placeholder="per bulan"     oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][durasi]"  value="{{ $item['durasi'] }}"         placeholder="4x/bulan"      oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][petugas]" value="{{ $item['petugas'] ?? '' }}"  placeholder="2 org"         oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][tarif]"   value="{{ $item['tarif'] }}"          placeholder="Rp 500.000"    oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_berkala',0)"><i class="bi bi-x"></i></button>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn-add-row" onclick="addRowBerkala()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Paket
                    </button>
                </div>
            </div>

            {{--Ketentuan--}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Ketentuan & Informasi</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <p style="font-size:11px; color:#9ca3af; margin-bottom:12px;">
                        Muncul di bagian bawah halaman sebagai catatan/syarat layanan.
                    </p>
                    <div id="rows_ketentuan">
                        @forelse($co->ketentuan ?? [] as $i => $note)
                        <div class="ketentuan-row">
                            <div class="ketentuan-num">{{ $i + 1 }}</div>
                            <input class="field-input" type="text" name="ketentuan[]"
                                   value="{{ $note }}" placeholder="Tulis ketentuan..."
                                   oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeKetentuan(this)">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        @empty
                        <div class="ketentuan-row">
                            <div class="ketentuan-num">1</div>
                            <input class="field-input" type="text" name="ketentuan[]"
                                   placeholder="Tulis ketentuan..." oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeKetentuan(this)">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-row mt-2" onclick="addKetentuan()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Poin
                    </button>
                </div>
            </div>

            </div>

            <div class="submit-bar">
                <button type="submit" class="btn btn-success btn-sm px-4 py-2 fw-bold">
                    <i class="bi bi-floppy me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.layananco.index') }}"
                   class="btn btn-light btn-sm border px-3">Batal</a>
                <span id="saved-indicator" style="font-size:11px; color:#10b981; display:none;">
                    <i class="bi bi-check-circle me-1"></i>Tersimpan
                </span>
            </div>

        </form>
    </div>

    {{-- Panel Kanan --}}
    <div class="edit-preview-panel" id="previewPanel">

        <div class="preview-panel-header">
            <span style="font-size:11px; font-weight:700; color:#6b7280; letter-spacing:.5px; text-transform:uppercase;">
                Live Preview
            </span>
            <div class="ms-auto d-flex align-items-center gap-2">
                <span id="preview-syncing" style="display:none; align-items:center; gap:5px; font-size:11px; color:#f59e0b; font-weight:600;">
                    <span class="spinner-border spinner-border-sm" style="width:10px;height:10px;border-width:2px;"></span>
                    Menyinkronkan...
                </span>
                <span id="preview-synced" style="display:none; align-items:center; gap:5px; font-size:11px; color:#10b981; font-weight:600;">
                    <i class="bi bi-check-circle-fill"></i> Tersinkron
                </span>
                <a href="{{ route('layanan.co') }}" target="_blank"
                   class="btn btn-sm btn-light border"
                   style="font-size:11px; padding:3px 10px;">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Buka
                </a>
            </div>
        </div>

        <div class="preview-iframe-wrap">
            <div class="iframe-loading" id="iframeLoading">
                <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                <span style="font-size:12px; color:#9ca3af;">Memuat preview...</span>
            </div>
            <iframe id="previewIframe"
                src="{{ route('layanan.co') }}?_preview=1"
                onload="iframeLoaded()">
            </iframe>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
// accordion
function toggleAccordion(header) {
    const chevron = header.querySelector('.accordion-chevron');
    const body    = header.nextElementSibling;
    const isOpen  = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    chevron.classList.toggle('open', !isOpen);
}

// iframe
function iframeLoaded() {
    document.getElementById('iframeLoading').classList.add('hidden');
    const iframe = document.getElementById('previewIframe');
    if (iframe?._pendingHeroSrc) {
        setTimeout(() => {
            try {
                iframe.contentWindow.postMessage(
                    { type: 'PREVIEW_IMG', target: 'hero', src: iframe._pendingHeroSrc },
                    '*'
                );
            } catch(e) {}
        }, 400);
    }
}

function reloadIframe() {
    const iframe  = document.getElementById('previewIframe');
    const loading = document.getElementById('iframeLoading');
    loading.classList.remove('hidden');
    const pendingHero   = iframe._pendingHeroSrc;
    const pendingSlides = iframe._pendingNewSlides;

    iframe.onload = () => {
        loading.classList.add('hidden');
        showSynced();

        if (pendingHero) {
            setTimeout(() => {
                try {
                    iframe.contentWindow.postMessage(
                        { type: 'PREVIEW_IMG', target: 'hero', src: pendingHero },
                        '*'
                    );
                } catch(e) {}
            }, 400);
        }

        if (pendingSlides !== undefined && pendingSlides !== null) {
            setTimeout(() => {
                try {
                    iframe.contentWindow.postMessage(
                        { type: 'PREVIEW_SLIDES_BARU', slides: pendingSlides },
                        '*'
                    );
                } catch(e) {}
            }, 500);
        }

        iframe.onload = null;
    };

    iframe.src = '{{ route("layanan.co") }}?_preview=1&_t=' + Date.now();
}

let previewTimer   = null;
let hasPendingSave = false;
const PREVIEW_URL  = '{{ route("admin.layananco.preview") }}';
const CSRF_TOKEN   = '{{ csrf_token() }}';

function schedulePreview() {
    hasPendingSave = true;
    showSyncing();
    clearTimeout(previewTimer);
    previewTimer = setTimeout(sendPreview, 1200);
}

function sendPreview() {
    const formData = new FormData(document.getElementById('mainForm'));
    formData.delete('_method');
    formData.delete('foto_galeri_baru[]');
    Array.from(accumulatedGaleriFiles.files).forEach(f => {
        formData.append('foto_galeri_baru[]', f);
    });
    
    formData.delete('foto_slide_baru[]');
    Array.from(accumulatedSlideFiles.files).forEach(f => {
        formData.append('foto_slide_baru[]', f);
    });
    fetch(PREVIEW_URL, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
        body: formData,
    })
    .then(r => r.json())
    .then(data => {
        if (data.ok) {
            reloadIframe();
            showSynced();
            hasPendingSave = false;
        }
    })
    .catch(() => hideSyncStatus());
}

function showSyncing() {
    document.getElementById('preview-syncing').style.display = 'flex';
    document.getElementById('preview-synced').style.display  = 'none';
}
function showSynced() {
    document.getElementById('preview-syncing').style.display = 'none';
    document.getElementById('preview-synced').style.display  = 'flex';
    setTimeout(() => { document.getElementById('preview-synced').style.display = 'none'; }, 2500);
}
function hideSyncStatus() {
    document.getElementById('preview-syncing').style.display = 'none';
    document.getElementById('preview-synced').style.display  = 'none';
}
function markPending() { schedulePreview(); }

document.addEventListener('DOMContentLoaded', () => {
    const heroZone  = document.getElementById('heroUploadZone');
    const heroInput = document.getElementById('inputFotoHero');
    if (heroZone && heroInput) {
        heroZone.addEventListener('click', () => heroInput.click());
    }
    const slideZone  = document.getElementById('slideUploadZone');
    const slideInput = document.getElementById('inputSlide');
    if (slideZone && slideInput) {
        slideZone.addEventListener('click', () => slideInput.click());
    }
    const galeriZone  = document.getElementById('galeriUploadZone');
    const galeriInput = document.getElementById('inputGaleri');
    if (galeriZone && galeriInput) {
        galeriZone.addEventListener('click', () => galeriInput.click());
    }
});

//foto hero
function handleHeroUpload(input) {
    if (!input.files?.[0]) return;
    const file   = input.files[0];
    const objUrl = URL.createObjectURL(file);
    const zone   = document.getElementById('heroUploadZone');

    zone.innerHTML = `
        <div class="foto-hero-wrap">
            <img id="thumb_hero" src="${objUrl}" alt="Foto Hero">
            <div class="foto-hero-overlay">
                <i class="bi bi-camera" style="font-size:20px;"></i>
                <span>Klik untuk ganti foto</span>
            </div>
        </div>`;

    const badge    = document.getElementById('heroBadge');
    const nameSpan = document.getElementById('heroFileName');
    if (badge) {
        badge.style.background  = '#f0fdf4';
        badge.style.color       = '#166534';
        badge.style.borderColor = '#bbf7d0';
        badge.innerHTML         = '<i class="bi bi-check-circle-fill"></i> Foto terpasang';
    }
    if (nameSpan) {
        nameSpan.textContent   = file.name;
        nameSpan.style.display = 'inline';
    }
    const reader = new FileReader();
    reader.onload = (e) => { sendHeroToIframe(e.target.result); };
    reader.readAsDataURL(file);

    schedulePreview();
}

function sendHeroToIframe(src) {
    const iframe = document.getElementById('previewIframe');
    if (!iframe) return;
    try {
        iframe.contentWindow.postMessage(
            { type: 'PREVIEW_IMG', target: 'hero', src },
            '*'
        );
    } catch (e) {}
    iframe._pendingHeroSrc = src;
}

// foto slideshow
const hapusSlideIndices = new Set();

function tandaiHapusSlide(index, btn) {
    const item = document.getElementById('slide-item-' + index);
    if (!item) return;

    if (hapusSlideIndices.has(index)) {
        hapusSlideIndices.delete(index);
        item.classList.remove('marked-hapus');
        btn.title       = 'Hapus foto ini';
        btn.textContent = '×';
    } else {
        hapusSlideIndices.add(index);
        item.classList.add('marked-hapus');
        btn.title       = 'Batal hapus';
        btn.textContent = '↺';
    }
    syncHapusInputs('hapus-slide-inputs', 'hapus_slide[]', hapusSlideIndices);
    sendSlidesToIframe();
    schedulePreview();
}

let accumulatedSlideFiles = new DataTransfer();

function previewSlideRender() {
    const grid = document.getElementById('slide-preview-baru');
    grid.innerHTML = '';
    grid.style.display = accumulatedSlideFiles.files.length ? 'grid' : 'none';

    Array.from(accumulatedSlideFiles.files).forEach((file, index) => {
        const objUrl = URL.createObjectURL(file);
        const div    = document.createElement('div');
        div.className = 'galeri-item';
        const img    = document.createElement('img');
        img.src      = objUrl;
        const hapusBtn = document.createElement('button');
        hapusBtn.type        = 'button';
        hapusBtn.className   = 'hapus-btn';
        hapusBtn.textContent = '×';
        hapusBtn.title       = 'Batal pilih foto ini';
        hapusBtn.onclick     = function() {
            const newDT = new DataTransfer();
            Array.from(accumulatedSlideFiles.files).forEach((f, i) => {
                if (i !== index) newDT.items.add(f);
            });
            accumulatedSlideFiles = newDT;
            document.getElementById('inputSlide').files = accumulatedSlideFiles.files;
            previewSlideRender();
            sendSlidesToIframe();
            schedulePreview();
        };
        div.appendChild(img);
        div.appendChild(hapusBtn);
        grid.appendChild(div);
    });
}

function sendSlidesToIframe() {
    const originalUrls = [];
    document.querySelectorAll('#slide-saved-grid .galeri-item').forEach(item => {
        if (!item.classList.contains('marked-hapus')) {
            const img = item.querySelector('img');
            if (img) originalUrls.push(img.src);
        }
    });
    const promises = Array.from(accumulatedSlideFiles.files).map(file => new Promise(resolve => {
        const reader = new FileReader();
        reader.onload = e => resolve(e.target.result);
        reader.readAsDataURL(file);
    }));

    Promise.all(promises).then(base64List => {
        const allSlides = [...originalUrls, ...base64List];
        const iframe    = document.getElementById('previewIframe');
        iframe._pendingNewSlides = allSlides;
        try {
            iframe.contentWindow.postMessage(
                { type: 'PREVIEW_SLIDES_BARU', slides: allSlides }, '*'
            );
        } catch(e) {}
    });
}

function previewSlideBaru(input) {
    if (!input.files?.length) return;
    Array.from(input.files).forEach(file => {
        accumulatedSlideFiles.items.add(file);
    });
    input.files = accumulatedSlideFiles.files;
    previewSlideRender();
    sendSlidesToIframe();
    schedulePreview();
}

// galeri hasil kerja
const hapusGaleriIndices = new Set();

function tandaiHapusGaleri(index, btn) {
    const item = document.getElementById('galeri-item-' + index);
    if (!item) return;

    if (hapusGaleriIndices.has(index)) {
        hapusGaleriIndices.delete(index);
        item.classList.remove('marked-hapus');
        btn.title       = 'Hapus foto ini';
        btn.textContent = '×';
    } else {
        hapusGaleriIndices.add(index);
        item.classList.add('marked-hapus');
        btn.title       = 'Batal hapus';
        btn.textContent = '↺';
    }
    syncHapusInputs('hapus-galeri-inputs', 'hapus_galeri[]', hapusGaleriIndices);
    schedulePreview();
}

let accumulatedGaleriFiles = new DataTransfer();

function previewGaleriRender() {
    const grid = document.getElementById('galeri-preview-baru');
    grid.innerHTML = '';
    grid.style.display = accumulatedGaleriFiles.files.length ? 'grid' : 'none';

    Array.from(accumulatedGaleriFiles.files).forEach((file, index) => {
        const objUrl = URL.createObjectURL(file);
        const div    = document.createElement('div');
        div.className = 'galeri-item';
        const img    = document.createElement('img');
        img.src      = objUrl;
        const hapusBtn = document.createElement('button');
        hapusBtn.type        = 'button';
        hapusBtn.className   = 'hapus-btn';
        hapusBtn.textContent = '×';
        hapusBtn.title       = 'Batal pilih foto ini';
        hapusBtn.onclick     = function() {
            const newDT = new DataTransfer();
            Array.from(accumulatedGaleriFiles.files).forEach((f, i) => {
                if (i !== index) newDT.items.add(f);
            });
            accumulatedGaleriFiles = newDT;

            const input = document.getElementById('inputGaleri');
            if (input) input.files = accumulatedGaleriFiles.files;

            previewGaleriRender();
            setTimeout(() => schedulePreview(), 0); 
        };
        div.appendChild(img);
        div.appendChild(hapusBtn);
        grid.appendChild(div);
    });
}

function previewGaleriBaru(input) {
    if (!input.files?.length) return;
    Array.from(input.files).forEach(file => {
        accumulatedGaleriFiles.items.add(file);
    });
    input.files = accumulatedGaleriFiles.files;
    previewGaleriRender();
    schedulePreview();
}

function syncHapusInputs(containerId, fieldName, indexSet) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';
    indexSet.forEach(idx => {
        const inp   = document.createElement('input');
        inp.type    = 'hidden';
        inp.name    = fieldName;
        inp.value   = idx;
        container.appendChild(inp);
    });
}

// tarif
function addRowCleaning() {
    const i   = Date.now();
    const row = document.createElement('div');
    row.className = 'tarif-row tarif-row-cleaning';
    row.innerHTML = `
        <input class="tarif-mini-input" type="text" name="tarif_cleaning[${i}][type]"    placeholder="Studio"        oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_cleaning[${i}][kondisi]" placeholder="Bersih Ringan" oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_cleaning[${i}][tarif]"   placeholder="Rp 150.000"   oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_cleaning[${i}][petugas]" placeholder="2 org"        oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_cleaning[${i}][durasi]"  placeholder="2–3 jam"      oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_cleaning',1)"><i class="bi bi-x"></i></button>`;
    document.getElementById('rows_cleaning').appendChild(row);
    schedulePreview();
}

function addRowTambahan() {
    const i   = Date.now();
    const row = document.createElement('div');
    row.className = 'tarif-row tarif-row-tambahan';
    row.innerHTML = `
        <input class="tarif-mini-input" type="text" name="tarif_tambahan[${i}][area]"    placeholder="Balkon"    oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_tambahan[${i}][tarif]"   placeholder="Rp 25.000" oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_tambahan[${i}][petugas]" placeholder="1 org"     oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_tambahan[${i}][durasi]"  placeholder="30 mnt"    oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_tambahan',1)"><i class="bi bi-x"></i></button>`;
    document.getElementById('rows_tambahan').appendChild(row);
    schedulePreview();
}

function addRowCuci() {
    const i   = Date.now();
    const row = document.createElement('div');
    row.className = 'tarif-row tarif-row-cuci';
    row.innerHTML = `
        <input class="tarif-mini-input" type="text" name="tarif_cuci[${i}][nama]"   placeholder="Sofa 3 Seater" oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_cuci[${i}][satuan]" placeholder="per unit"      oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_cuci[${i}][durasi]" placeholder="3–4 jam"       oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_cuci[${i}][tarif]"  placeholder="Rp 200.000"    oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_cuci',1)"><i class="bi bi-x"></i></button>`;
    document.getElementById('rows_cuci').appendChild(row);
    schedulePreview();
}

function addRowBerkala() {
    const i   = Date.now();
    const row = document.createElement('div');
    row.className = 'tarif-row tarif-row-berkala';
    row.innerHTML = `
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][nama]"    placeholder="Paket Bulanan" oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][satuan]"  placeholder="per bulan"     oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][durasi]"  placeholder="4x/bulan"      oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][petugas]" placeholder="2 org"         oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][tarif]"   placeholder="Rp 500.000"    oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_berkala',0)"><i class="bi bi-x"></i></button>`;
    document.getElementById('rows_berkala').appendChild(row);
    schedulePreview();
}

function removeRow(btn, containerId, minRows) {
    const container = document.getElementById(containerId);
    const rows      = container.querySelectorAll('.tarif-row');
    if (rows.length <= minRows) return;
    btn.closest('.tarif-row').remove();
    schedulePreview();
}

// ketentuan
function addKetentuan() {
    const container = document.getElementById('rows_ketentuan');
    const count     = container.querySelectorAll('.ketentuan-row').length + 1;
    const row       = document.createElement('div');
    row.className   = 'ketentuan-row';
    row.innerHTML   = `
        <div class="ketentuan-num">${count}</div>
        <input class="field-input" type="text" name="ketentuan[]"
               placeholder="Tulis ketentuan..." oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeKetentuan(this)">
            <i class="bi bi-x"></i>
        </button>`;
    container.appendChild(row);
    schedulePreview();
}

function removeKetentuan(btn) {
    const container = document.getElementById('rows_ketentuan');
    if (container.querySelectorAll('.ketentuan-row').length <= 1) return;
    btn.closest('.ketentuan-row').remove();
    container.querySelectorAll('.ketentuan-num').forEach((el, i) => { el.textContent = i + 1; });
    schedulePreview();
}

window.addEventListener('beforeunload', (e) => {
    if (hasPendingSave) { e.preventDefault(); e.returnValue = ''; }
});
</script>
@endpush