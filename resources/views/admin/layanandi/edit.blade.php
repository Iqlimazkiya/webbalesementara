@extends('layouts.admin.main')

@section('title', 'Edit Design Interior')

@push('styles')
<style>
/* ── LAYOUT ── */
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
    background: #f8f9fa;
    padding: 0 0 0 0;
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

/* ── FORM HEADER ── */
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

/* ── FORM SCROLL AREA ── */
.form-scroll-area {
    flex: 1;
    overflow-y: auto;
    padding-bottom: 0;
}

/* ── ACCORDION ── */
.section-accordion { border-bottom: 1px solid #e5e7eb; }
.section-accordion-header {
    padding: 14px 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    user-select: none;
    transition: background .15s;
}
.section-accordion-header:hover { background: #f9fafb; }
.section-accordion-icon {
    width: 30px; height: 30px;
    border-radius: 8px;
    background: #f0fdf4;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.section-accordion-title { font-size: 13px; font-weight: 600; color: #1f2937; flex: 1; }
.accordion-chevron {
    color: #9ca3af;
    transition: transform .25s;
    font-size: 13px;
}
.accordion-chevron.open { transform: rotate(90deg); }
.section-accordion-body {
    display: none;
    padding: 16px 20px;
    background: #fafafa;
}
.section-accordion-body.open { display: block; }

/* ── FORM ELEMENTS ── */
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
    background: #fff;
    color: #1f2937;
    transition: border-color .15s;
    outline: none;
}
.field-input:focus { border-color: #335A40; }
.field-group { margin-bottom: 14px; }

/* ── FOTO UPLOAD ── */
.foto-upload-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
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
.foto-upload-slot img {
    width: 100%; height: 80px;
    object-fit: cover; display: block;
}
.foto-upload-slot .foto-placeholder {
    height: 80px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 4px; color: #9ca3af; font-size: 11px;
}
.foto-upload-slot input[type="file"] {
    position: absolute; inset: 0;
    opacity: 0; cursor: pointer;
}
.foto-slot-label {
    font-size: 10px; font-weight: 700;
    color: #9ca3af; text-transform: uppercase;
    text-align: center; padding: 3px 0;
    background: #f1f5f9;
}

/* ── TARIF ROWS ── */
.tarif-section { margin-bottom: 8px; }
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
.tarif-mini-label {
    font-size: 9px; font-weight: 700;
    text-transform: uppercase; color: #9ca3af;
    margin-bottom: 3px; display: block;
}
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

/* ── KETENTUAN ── */
.ketentuan-row {
    display: flex; gap: 6px;
    align-items: center;
    margin-bottom: 6px;
}
.ketentuan-num {
    width: 22px; height: 22px;
    background: #335A40; color: #fff;
    border-radius: 50%;
    font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

/* ── SUBMIT BAR ── */
.submit-bar {
    position: sticky;
    bottom: 0;
    background: #fff;
    border-top: 2px solid #e5e7eb;
    padding: 12px 20px;
    display: flex;
    gap: 10px;
    align-items: center;
    z-index: 20;
    box-shadow: 0 -4px 12px rgba(0,0,0,0.06);
    flex-shrink: 0;
}

/* ── PREVIEW PANEL (KANAN) ── */
.preview-panel-header {
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    padding: 10px 16px;
    display: flex; align-items: center;
    gap: 8px; flex-shrink: 0;
}
.preview-iframe-wrap {
    flex: 1;
    overflow: hidden;
    position: relative;
}
.preview-iframe-wrap iframe {
    width: 100%; height: 100%;
    border: none;
    transform-origin: top left;
}

/* ── IFRAME LOADING OVERLAY ── */
.iframe-loading {
    position: absolute; inset: 0;
    background: #e9ecef;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 10px; z-index: 5;
    transition: opacity .3s;
}
.iframe-loading.hidden { opacity: 0; pointer-events: none; }

/* ── MOBILE ── */
@media (max-width: 768px) {
    .edit-layout { grid-template-columns: 1fr; height: auto; overflow: visible; }
    .edit-form-panel { height: auto; overflow-y: visible; border-right: none; border-bottom: 2px solid #e5e7eb; }
    .edit-preview-panel { height: 500px; }
}
</style>
@endpush

@section('content')
<div class="edit-layout">

    {{-- ══════════════════════════════════
         PANEL KIRI — FORM
    ══════════════════════════════════ --}}
    <div class="edit-form-panel">

        {{-- Header --}}
        <div class="form-panel-header">
            <a href="{{ route('admin.layanandi.index') }}"
               class="btn btn-sm btn-light border" style="padding:5px 10px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <div style="font-size:13px; font-weight:700; color:#1f2937;">Edit Design Interior</div>
                <div style="font-size:11px; color:#9ca3af;">Preview langsung di kanan</div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success mx-3 mt-3 mb-0 py-2" style="font-size:12px;">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
        </div>
        @endif

        <form id="mainForm"
              action="{{ route('admin.layanandi.update') }}"
              method="POST"
              enctype="multipart/form-data"
              style="display:flex; flex-direction:column; flex:1;">

            @csrf
            @method('PUT')

            <div class="form-scroll-area">

            {{-- ── 1. FOTO CAROUSEL ── --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <div class="section-accordion-icon">
                        <i class="bi bi-images" style="color:#335A40; font-size:14px;"></i>
                    </div>
                    <span class="section-accordion-title">Foto Carousel</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <p style="font-size:11px; color:#9ca3af; margin-bottom:12px;">
                        Tampil di header halaman sebagai strip foto horizontal. Maks 4 foto.
                    </p>
                    <div class="foto-upload-grid">
                        @foreach([1,2,3,4] as $n)
                        <div>
                            <div class="foto-slot-label">Foto {{ $n }}</div>
                            <div class="foto-upload-slot" onclick="this.querySelector('input').click()">
                                @php $path = $co->{"foto_carousel_{$n}"}; @endphp
                                @if($path)
                                    <img id="thumb_carousel_{{ $n }}"
                                         src="{{ $co->fotoUrl($path) }}" alt="">
                                @else
                                    <div class="foto-placeholder" id="thumb_carousel_{{ $n }}">
                                        <i class="bi bi-plus-circle" style="font-size:20px;"></i>
                                        <span>Upload</span>
                                    </div>
                                @endif
                                <input type="file" name="foto_carousel_{{ $n }}"
                                       accept="image/*"
                                       onchange="handleCarouselUpload(this, {{ $n }})">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ── 2. FOTO SLIDESHOW ── --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <div class="section-accordion-icon">
                        <i class="bi bi-play-circle" style="color:#335A40; font-size:14px;"></i>
                    </div>
                    <span class="section-accordion-title">Foto Slideshow</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <p style="font-size:11px; color:#9ca3af; margin-bottom:12px;">
                        Slideshow full-width di bawah carousel. Maks 3 foto.
                    </p>
                    <div class="foto-upload-grid">
                        @foreach([1,2,3] as $n)
                        <div>
                            <div class="foto-slot-label">Slide {{ $n }}</div>
                            <div class="foto-upload-slot" onclick="this.querySelector('input').click()">
                                @php $path = $co->{"foto_slide_{$n}"}; @endphp
                                @if($path)
                                    <img id="thumb_slide_{{ $n }}"
                                         src="{{ $co->fotoUrl($path) }}" alt="">
                                @else
                                    <div class="foto-placeholder" id="thumb_slide_{{ $n }}">
                                        <i class="bi bi-plus-circle" style="font-size:20px;"></i>
                                        <span>Upload</span>
                                    </div>
                                @endif
                                <input type="file" name="foto_slide_{{ $n }}"
                                       accept="image/*"
                                       onchange="handleSlideUpload(this, {{ $n }})">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ── 3. TARIF LISTRIK ── --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <div class="section-accordion-icon">
                        <i class="bi bi-lightbulb" style="color:#335A40; font-size:14px;"></i>
                    </div>
                    <span class="section-accordion-title">Tarif Konsultasi</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div style="display:grid; grid-template-columns: 1.2fr 1fr 1fr 1fr 1fr 28px; gap:6px; padding:0 0 6px; margin-bottom:6px; border-bottom:1px solid #f1f5f9;">
                        @foreach(['Jenis','Kondisi','Tarif','Petugas','Durasi',''] as $h)
                        <span style="font-size:9px; font-weight:700; color:#9ca3af; text-transform:uppercase;">{{ $h }}</span>
                        @endforeach
                    </div>
                    <div id="rows_konsultasi">
                        @forelse($di->tarif_konsultasi ?? [] as $i => $r)
                        <div class="tarif-row tarif-row-listrik">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[{{ $i }}][jenis]" value="{{ $r['jenis'] }}" placeholder="Konsultasi Awal" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[{{ $i }}][kondisi]" value="{{ $r['kondisi'] }}" placeholder="Ringan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[{{ $i }}][tarif]" value="{{ $r['tarif'] }}" placeholder="Rp 75.000" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[{{ $i }}][petugas]" value="{{ $r['petugas'] }}" placeholder="1 org" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[{{ $i }}][durasi]" value="{{ $r['durasi'] }}" placeholder="1 jam" oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this, 'rows_konsultasi')"><i class="bi bi-x"></i></button>
                        </div>
                        @empty
                        <div class="tarif-row tarif-row-listrik">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[0][jenis]" placeholder="Konsultasi Awal" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[0][kondisi]" placeholder="Ringan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[0][tarif]" placeholder="Rp 75.000" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[0][petugas]" placeholder="1 org" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_konsultasi[0][durasi]" placeholder="1 jam" oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this, 'rows_konsultasi')"><i class="bi bi-x"></i></button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-row" onclick="addRowKonsultasi()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Baris
                    </button>
                </div>
            </div>

            {{-- ── 4. TARIF PLUMBING ── --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <div class="section-accordion-icon">
                        <i class="bi bi-rulers" style="color:#335A40; font-size:14px;"></i>
                    </div>
                    <span class="section-accordion-title">Tarif Desain 2D/3D</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div style="display:grid; grid-template-columns: 1.2fr 1fr 1fr 1fr 1fr 28px; gap:6px; padding:0 0 6px; margin-bottom:6px; border-bottom:1px solid #f1f5f9;">
                        @foreach(['Jenis','Kondisi','Tarif','Petugas','Durasi',''] as $h)
                        <span style="font-size:9px; font-weight:700; color:#9ca3af; text-transform:uppercase;">{{ $h }}</span>
                        @endforeach
                    </div>
                    <div id="rows_desain">
                        @forelse($di->tarif_desain ?? [] as $i => $r)
                        <div class="tarif-row tarif-row-plumbing">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[{{ $i }}][jenis]" value="{{ $r['jenis'] }}" placeholder="Desain 2D Ruangan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[{{ $i }}][kondisi]" value="{{ $r['kondisi'] }}" placeholder="Ringan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[{{ $i }}][tarif]" value="{{ $r['tarif'] }}" placeholder="Rp 100.000" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[{{ $i }}][petugas]" value="{{ $r['petugas'] }}" placeholder="1 org" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[{{ $i }}][durasi]" value="{{ $r['durasi'] }}" placeholder="1–2 jam" oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this, 'rows_desain')"><i class="bi bi-x"></i></button>
                        </div>
                        @empty
                        <div class="tarif-row tarif-row-plumbing">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[0][jenis]" placeholder="Desain 2D Ruangan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[0][kondisi]" placeholder="Ringan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[0][tarif]" placeholder="Rp 100.000" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[0][petugas]" placeholder="1 org" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_desain[0][durasi]" placeholder="1–2 jam" oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this, 'rows_desain')"><i class="bi bi-x"></i></button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-row" onclick="addRowDesain()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Baris
                    </button>
                </div>
            </div>

            {{-- ── 5. TARIF UMUM ── --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <div class="section-accordion-icon">
                        <i class="bi bi-hammer" style="color:#335A40; font-size:14px;"></i>
                    </div>
                    <span class="section-accordion-title">Tarif Renovasi & Eksekusi</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div style="display:grid; grid-template-columns: 1.2fr 1fr 1fr 1fr 1fr 28px; gap:6px; padding:0 0 6px; margin-bottom:6px; border-bottom:1px solid #f1f5f9;">
                        @foreach(['Jenis','Kondisi','Tarif','Petugas','Durasi',''] as $h)
                        <span style="font-size:9px; font-weight:700; color:#9ca3af; text-transform:uppercase;">{{ $h }}</span>
                        @endforeach
                    </div>
                    <div id="rows_renovasi">
                        @forelse($di->tarif_renovasi ?? [] as $i => $r)
                        <div class="tarif-row tarif-row-umum">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[{{ $i }}][jenis]" value="{{ $r['jenis'] }}" placeholder="Renovasi Kamar Mandi" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[{{ $i }}][kondisi]" value="{{ $r['kondisi'] }}" placeholder="Ringan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[{{ $i }}][tarif]" value="{{ $r['tarif'] }}" placeholder="Rp 50.000" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[{{ $i }}][petugas]" value="{{ $r['petugas'] }}" placeholder="1 org" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[{{ $i }}][durasi]" value="{{ $r['durasi'] }}" placeholder="30 mnt" oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this, 'rows_renovasi')"><i class="bi bi-x"></i></button>
                        </div>
                        @empty
                        <div class="tarif-row tarif-row-umum">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[0][jenis]" placeholder="Renovasi Kamar Mandi" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[0][kondisi]" placeholder="Ringan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[0][tarif]" placeholder="Rp 50.000" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[0][petugas]" placeholder="1 org" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_renovasi[0][durasi]" placeholder="30 mnt" oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this, 'rows_renovasi')"><i class="bi bi-x"></i></button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-row" onclick="addRowRenovasi()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Baris
                    </button>
                </div>
            </div>

            {{-- ── 6. TARIF PERAWATAN BERKALA ── --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <div class="section-accordion-icon">
                        <i class="bi bi-arrow-repeat" style="color:#335A40; font-size:14px;"></i>
                    </div>
                    <span class="section-accordion-title">
                        Perawatan Berkala
                        @if(empty($di->tarif_berkala))
                        <span style="font-size:10px; color:#f59e0b; font-weight:600; margin-left:6px;">
                            <i class="bi bi-clock me-1"></i>Belum terisi
                        </span>
                        @endif
                    </span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    @if(empty($di->tarif_berkala))
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
                        @forelse($di->tarif_berkala ?? [] as $i => $item)
                        <div class="tarif-row tarif-row-berkala">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][nama]" value="{{ $item['nama'] }}" placeholder="Paket Bulanan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][satuan]" value="{{ $item['satuan'] }}" placeholder="per bulan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][durasi]" value="{{ $item['durasi'] }}" placeholder="4x/bulan" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][petugas]" value="{{ $item['petugas'] ?? '' }}" placeholder="2 org" oninput="markPending()">
                            <input class="tarif-mini-input" type="text" name="tarif_berkala[{{ $i }}][tarif]" value="{{ $item['tarif'] }}" placeholder="Rp 500.000" oninput="markPending()">
                            <button type="button" class="btn-remove-row" onclick="removeRow(this, 'rows_berkala')"><i class="bi bi-x"></i></button>
                        </div>
                        @empty
                        {{-- Tidak ada baris default — user harus klik Tambah --}}
                        @endforelse
                    </div>
                    <button type="button" class="btn-add-row" onclick="addRowBerkala()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Paket
                    </button>
                </div>
            </div>{{-- end form-scroll-area --}}

            {{-- Submit bar — sticky bottom, tidak ngambang --}}
            <div class="submit-bar">
                <button type="submit" class="btn btn-success btn-sm px-4 py-2 fw-bold">
                    <i class="bi bi-floppy me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.layanandi.index') }}"
                   class="btn btn-light btn-sm border px-3">Batal</a>
                <span id="saved-indicator"
                      style="font-size:11px; color:#10b981; display:none;">
                    <i class="bi bi-check-circle me-1"></i>Tersimpan
                </span>
            </div>

        </form>
    </div>

    {{-- ══════════════════════════════════
         PANEL KANAN — LIVE PREVIEW
    ══════════════════════════════════ --}}
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
                <a href="{{ route('layanan.di') }}" target="_blank"
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
                    src="{{ route('layanan.di') }}"
                    onload="iframeLoaded()">
            </iframe>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
/* ════════════════════════════════════════════
   ACCORDION
════════════════════════════════════════════ */
function toggleAccordion(header) {
    const chevron = header.querySelector('.accordion-chevron');
    const body    = header.nextElementSibling;
    const isOpen  = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    chevron.classList.toggle('open', !isOpen);
}

/* ════════════════════════════════════════════
   IFRAME
════════════════════════════════════════════ */
function iframeLoaded() {
    document.getElementById('iframeLoading').classList.add('hidden');
}

function reloadIframe() {
    const iframe  = document.getElementById('previewIframe');
    const loading = document.getElementById('iframeLoading');
    loading.classList.remove('hidden');
    iframe.src = '{{ route("layanan.di") }}?_preview=1&_t=' + Date.now();
}

/* ════════════════════════════════════════════
   LIVE PREVIEW
════════════════════════════════════════════ */
let previewTimer   = null;
let hasPendingSave = false;

const PREVIEW_URL = '{{ route("admin.layanandi.preview") }}';
const CSRF_TOKEN  = '{{ csrf_token() }}';

function schedulePreview() {
    hasPendingSave = true;
    showSyncing();
    clearTimeout(previewTimer);
    previewTimer = setTimeout(sendPreview, 600);
}

function sendPreview() {
    const formData = new FormData(document.getElementById('mainForm'));
    formData.delete('_method');

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
    setTimeout(() => {
        document.getElementById('preview-synced').style.display = 'none';
    }, 2500);
}
function hideSyncStatus() {
    document.getElementById('preview-syncing').style.display = 'none';
    document.getElementById('preview-synced').style.display  = 'none';
}

function markPending() { schedulePreview(); }

/* ════════════════════════════════════════════
   FOTO UPLOAD
════════════════════════════════════════════ */
function handleCarouselUpload(input, n) {
    if (!input.files?.[0]) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        const el = document.getElementById(`thumb_carousel_${n}`);
        if (el.tagName === 'IMG') { el.src = e.target.result; }
        else {
            const img = document.createElement('img');
            img.id = `thumb_carousel_${n}`; img.src = e.target.result;
            el.replaceWith(img);
        }
    };
    reader.readAsDataURL(input.files[0]);
    schedulePreview();
}

function handleSlideUpload(input, n) {
    if (!input.files?.[0]) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        const el = document.getElementById(`thumb_slide_${n}`);
        if (el.tagName === 'IMG') { el.src = e.target.result; }
        else {
            const img = document.createElement('img');
            img.id = `thumb_slide_${n}`; img.src = e.target.result;
            el.replaceWith(img);
        }
    };
    reader.readAsDataURL(input.files[0]);
    schedulePreview();
}

/* ════════════════════════════════════════════
   TARIF ROWS
════════════════════════════════════════════ */
let counterKonsultasi = {{ count($di->tarif_konsultasi ?? []) ?: 1 }};
let counterDesain = {{ count($di->tarif_desain ?? []) ?: 1 }};
let counterRenovasi     = {{ count($co->tarif_cuci     ?? []) ?: 1 }};
let counterBerkala  = {{ count($co->tarif_berkala  ?? []) ?: 0 }};

function addRowKonsultasi() {
    const i = counterKonsultasi++;
    const row = document.createElement('div');
    row.className = 'tarif-row tarif-row-listrik';
    row.innerHTML = `
        <input class="tarif-mini-input" type="text" name="tarif_konsultasi[${i}][jenis]"   placeholder="Konsultasi Awal" oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_konsultasi[${i}][kondisi]" placeholder="Ringan"            oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_konsultasi[${i}][tarif]"   placeholder="Rp 75.000"         oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_konsultasi[${i}][petugas]" placeholder="1 org"             oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_konsultasi[${i}][durasi]"  placeholder="1 jam"             oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_konsultasi')"><i class="bi bi-x"></i></button>`;
    document.getElementById('rows_konsultasi').appendChild(row);
    schedulePreview();
}

function addRowDesain() {
    const i = counterDesain++;
    const row = document.createElement('div');
    row.className = 'tarif-row tarif-row-plumbing';
    row.innerHTML = `
        <input class="tarif-mini-input" type="text" name="tarif_desain[${i}][jenis]"   placeholder="Desain 2D Ruangan" oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_desain[${i}][kondisi]" placeholder="Ringan"            oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_desain[${i}][tarif]"   placeholder="Rp 100.000"        oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_desain[${i}][petugas]" placeholder="1 org"             oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_desain[${i}][durasi]"  placeholder="1–2 jam"           oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_desain')"><i class="bi bi-x"></i></button>`;
    document.getElementById('rows_desain').appendChild(row);
    schedulePreview();
}

function addRowRenovasi() {
    const i = counterRenovasi++;
    const row = document.createElement('div');
    row.className = 'tarif-row tarif-row-umum';
    row.innerHTML = `
        <input class="tarif-mini-input" type="text" name="tarif_renovasi[${i}][jenis]"   placeholder="Renovasi Kamar Mandi" oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_renovasi[${i}][kondisi]" placeholder="Ringan"             oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_renovasi[${i}][tarif]"   placeholder="Rp 50.000"          oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_renovasi[${i}][petugas]" placeholder="1 org"              oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_renovasi[${i}][durasi]"  placeholder="30 mnt"             oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_renovasi')"><i class="bi bi-x"></i></button>`;
    document.getElementById('rows_renovasi').appendChild(row);
    schedulePreview();
}

function addRowBerkala() {
    const i = counterBerkala++;
    const row = document.createElement('div');
    row.className = 'tarif-row tarif-row-berkala';
    row.innerHTML = `
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][nama]"    placeholder="Paket Bulanan" oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][satuan]"  placeholder="per bulan"     oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][durasi]"  placeholder="4x/bulan"      oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][petugas]" placeholder="2 org"         oninput="schedulePreview()">
        <input class="tarif-mini-input" type="text" name="tarif_berkala[${i}][tarif]"   placeholder="Rp 500.000"    oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeRow(this,'rows_berkala')"><i class="bi bi-x"></i></button>`;
    document.getElementById('rows_berkala').appendChild(row);
    schedulePreview();
}

function removeRow(btn, containerId) {
    const container = document.getElementById(containerId);
    const rows = container.querySelectorAll('.tarif-row');
    if (!['rows_berkala','rows_konsultasi','rows_desain','rows_renovasi'].includes(containerId) || rows.length <= 1) {
        if (rows.length <= 1 && containerId !== 'rows_berkala') return;
    }
    btn.closest('.tarif-row').remove();
    schedulePreview();
}


function removeKetentuan(btn) {
    const container = document.getElementById('rows_ketentuan');
    if (container.querySelectorAll('.ketentuan-row').length <= 1) return;
    btn.closest('.ketentuan-row').remove();
    container.querySelectorAll('.ketentuan-num').forEach((el, i) => {
        el.textContent = i + 1;
    });
    schedulePreview();
}

/* ════════════════════════════════════════════
   WARN sebelum leave
════════════════════════════════════════════ */
window.addEventListener('beforeunload', (e) => {
    if (hasPendingSave) {
        e.preventDefault();
        e.returnValue = '';
    }
});
</script>
@endpush