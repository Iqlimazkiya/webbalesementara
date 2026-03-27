@extends('layouts.admin.main')

@section('title', 'Edit Halaman Unit')

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
    border: 1px dashed #d1d5db;
    border-radius: 10px;
    overflow: hidden;
    background: #f8fafc;
    position: relative;
    cursor: pointer;
    transition: border-color .2s;
}
.foto-upload-hero:hover { border-color: #335A40; }
.foto-upload-hero img { width: 100%; height: 100px; object-fit: cover; display: block; }
.foto-upload-hero .foto-placeholder {
    height: 100px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 4px; color: #9ca3af; font-size: 11px;
}
.foto-upload-hero input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }

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
}
.foto-upload-slot input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }

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
.galeri-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
.galeri-item .hapus-btn {
    position: absolute; top: 4px; right: 4px;
    width: 20px; height: 20px;
    background: rgba(239,68,68,0.9); color: #fff;
    border: none; border-radius: 50%; font-size: 11px;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: background .15s;
}
.galeri-item .hapus-btn:hover { background: #dc2626; }
.galeri-item .hapus-overlay {
    position: absolute; inset: 0;
    background: rgba(239,68,68,0.4);
    display: none; align-items: center; justify-content: center;
    flex-direction: column; gap: 4px;
}
.galeri-item.marked-hapus .hapus-overlay { display: flex; }
.galeri-item.marked-hapus img { opacity: .5; }
.galeri-item .restore-btn {
    background: rgba(255,255,255,0.9); color: #374151;
    border: none; border-radius: 6px; font-size: 9px; font-weight: 700;
    padding: 3px 8px; cursor: pointer;
}

.galeri-add-slot {
    border: 1px dashed #d1d5db;
    border-radius: 8px;
    aspect-ratio: 1;
    background: #f8fafc;
    position: relative;
    cursor: pointer;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 3px; color: #9ca3af; font-size: 10px;
    transition: border-color .2s;
}
.galeri-add-slot:hover { border-color: #335A40; color: #335A40; }
.galeri-add-slot input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }

.fasilitas-row { display: flex; gap: 6px; align-items: center; margin-bottom: 6px; }
.fasilitas-num {
    width: 22px; height: 22px;
    background: #335A40; color: #fff;
    border-radius: 50%; font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.btn-remove-row {
    width: 28px; height: 28px;
    border: none; background: #fef2f2;
    border-radius: 6px; color: #ef4444;
    cursor: pointer; display: flex;
    align-items: center; justify-content: center; flex-shrink: 0;
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
    transition: all .15s; text-align: center;
}
.btn-add-row:hover { border-color: #335A40; background: #f0fdf4; }

.unit-hapus-btn {
    padding: 3px 10px;
    background: #fef2f2; border: 1px solid #fecaca;
    border-radius: 6px; color: #ef4444;
    font-size: 11px; font-weight: 600; cursor: pointer;
    transition: background .15s; white-space: nowrap;
}
.unit-hapus-btn:hover { background: #fee2e2; }
.unit-restore-btn {
    padding: 3px 10px;
    background: #f0fdf4; border: 1px solid #bbf7d0;
    border-radius: 6px; color: #166534;
    font-size: 11px; font-weight: 600; cursor: pointer;
    transition: background .15s; white-space: nowrap;
}
.unit-restore-btn:hover { background: #dcfce7; }
.unit-marked-hapus { opacity: .5; }
.unit-marked-hapus .section-accordion-title { text-decoration: line-through; }

.submit-bar {
    background: #fff;
    border-top: 1px solid #e5e7eb;
    padding: 12px 20px;
    display: flex; gap: 10px;
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
    gap: 10px; z-index: 5; transition: opacity .3s;
}
.iframe-loading.hidden { opacity: 0; pointer-events: none; }

.video-preview-box {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    background: #000;
    margin-bottom: 10px;
}
.video-preview-box video {
    width: 100%; display: block; max-height: 140px; object-fit: cover;
}

/* File size error toast */
.filesize-toast {
    position: fixed;
    bottom: 24px; left: 50%; transform: translateX(-50%);
    z-index: 9999;
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 10px 18px;
    border-radius: 10px;
    font-size: 12px; font-weight: 600;
    box-shadow: 0 4px 16px rgba(0,0,0,.12);
    animation: toastIn .25s ease;
    white-space: nowrap;
}
@keyframes toastIn  { from { opacity:0; transform: translateX(-50%) translateY(8px); } to { opacity:1; transform: translateX(-50%) translateY(0); } }
@keyframes toastOut { from { opacity:1; } to { opacity:0; } }

@media (max-width: 768px) {
    .edit-layout { grid-template-columns: 1fr; height: auto; overflow: visible; }
    .edit-form-panel { height: auto; overflow-y: visible; border-right: none; border-bottom: 2px solid #e5e7eb; }
    .edit-preview-panel { height: 500px; }
    .galeri-grid { grid-template-columns: repeat(3, 1fr); }
}
</style>
@endpush

@section('content')
{{-- Data unit untuk JS order-swap --}}
<script>
    window.UNIT_LIST = [
        @foreach($units as $unit)
        { id: {{ $unit->id }}, nama: @json($unit->nama_tipe), order: {{ $unit->order }} },
        @endforeach
    ];
    window.UNIT_COUNT = {{ $units->count() }};
</script>

<div class="edit-layout">

{{-- panel kiri form --}}
    <div class="edit-form-panel">

        <div class="form-panel-header">
            <a href="{{ route('admin.unit.index') }}"
               class="btn btn-sm btn-light border" style="padding:5px 10px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <div style="font-size:13px; font-weight:700; color:#1f2937;">Edit Halaman Tipe Unit</div>
                <div style="font-size:11px; color:#9ca3af;">Preview langsung di kanan</div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success mx-3 mt-3 mb-0 py-2" style="font-size:12px;">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger mx-3 mt-3 mb-0 py-2" style="font-size:12px;">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
        @endif

        <form id="mainForm"
              action="{{ route('admin.unit-page.update') }}"
              method="POST"
              enctype="multipart/form-data"
              style="display:flex; flex-direction:column; flex:1; min-height:0;">
            @csrf
            @method('PUT')
            <div id="hapus-promo-inputs"></div>
            <div id="hapus-unit-inputs"></div>

            <div class="form-scroll-area">

            {{-- hero --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Foto Hero</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    @php $heroImgVal = \App\Models\Setting::where('key','hero_image')->value('value'); @endphp
                    <div class="foto-upload-hero field-group">
                        @if($heroImgVal)
                            <img id="thumb_hero_image" src="{{ asset($heroImgVal) }}" alt="">
                        @else
                            <div class="foto-placeholder" id="thumb_hero_image"><i class="bi bi-image" style="font-size:22px;"></i><span>Klik untuk upload foto hero</span></div>
                        @endif
                        <input type="file" name="hero_image" accept="image/webp,image/jpeg,image/jpg,image/png" onchange="handleSingleUpload(this,'thumb_hero_image',10)">
                    </div>
                    <div style="font-size:11px;color:red;margin-top:3px;margin-bottom:8px;">Format: WebP, JPG, PNG. Maks 10MB.</div>
                    <div class="field-group"><div class="field-label">Tag</div>
                        <input type="text" name="hero_tag" class="field-input" value="{{ $s['hero_tag'] ?? '' }}" placeholder="Bale Hinggil Apartment" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Line 1</div>
                        <input type="text" name="hero_line_1" class="field-input" value="{{ $s['hero_line_1'] ?? '' }}" placeholder="Temukan Sudut Favorit" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Line 2</div>
                        <input type="text" name="hero_line_2" class="field-input" value="{{ $s['hero_line_2'] ?? '' }}" placeholder="Hunian Impianmu" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Deskripsi</div>
                        <textarea name="hero_desc" class="field-input" rows="2" oninput="markPending()">{{ $s['hero_desc'] ?? '' }}</textarea></div>
                </div>
            </div>

            {{-- perhitungan --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Counting & Stats</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    @php $countImgVal = \App\Models\Setting::where('key','counting_image')->value('value'); @endphp
                    <div class="foto-upload-hero field-group">
                        @if($countImgVal)
                            <img id="thumb_counting_image" src="{{ asset($countImgVal) }}" alt="">
                        @else
                            <div class="foto-placeholder" id="thumb_counting_image"><i class="bi bi-image" style="font-size:22px;"></i><span>Klik untuk upload foto counting</span></div>
                        @endif
                        <input type="file" name="counting_image" accept="image/webp,image/jpeg,image/jpg,image/png" onchange="handleSingleUpload(this,'thumb_counting_image',10)">
                    </div>
                    <div style="font-size:11px;color:red;margin-top:3px;margin-bottom:8px;">Format: WebP, JPG, PNG. Maks 10MB.</div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                        <div class="field-group"><div class="field-label">Judul 1</div>
                            <input type="text" name="counting_title_1" class="field-input" value="{{ $s['counting_title_1'] ?? '' }}" placeholder="Rumah Nyaman," oninput="markPending()"></div>
                        <div class="field-group"><div class="field-label">Judul 2</div>
                            <input type="text" name="counting_title_2" class="field-input" value="{{ $s['counting_title_2'] ?? '' }}" placeholder="Investasi Masa Depan" oninput="markPending()"></div>
                    </div>
                    <div class="field-group"><div class="field-label">Deskripsi</div>
                        <textarea name="counting_desc" class="field-input" rows="2" oninput="markPending()">{{ $s['counting_desc'] ?? '' }}</textarea></div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                        <div class="field-group"><div class="field-label">Lantai</div><input type="text" name="stat_floors" class="field-input" value="{{ $s['stat_floors'] ?? '' }}" placeholder="31" oninput="markPending()"></div>
                        <div class="field-group"><div class="field-label">Unit</div><input type="text" name="stat_units" class="field-input" value="{{ $s['stat_units'] ?? '' }}" placeholder="200" oninput="markPending()"></div>
                        <div class="field-group"><div class="field-label">Jam Security</div><input type="text" name="stat_security" class="field-input" value="{{ $s['stat_security'] ?? '' }}" placeholder="24" oninput="markPending()"></div>
                        <div class="field-group"><div class="field-label">Jumlah Keluarga</div><input type="text" name="family_count" class="field-input" value="{{ $s['family_count'] ?? '' }}" placeholder="150" oninput="markPending()"></div>
                    </div>
                </div>
            </div>

            {{-- promo --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Promo Slideshow</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    @php $promoImagesRaw = $s['promo_images'] ?? []; if(!is_array($promoImagesRaw)) $promoImagesRaw = []; @endphp
                    <div class="galeri-grid" id="promo-saved-grid">
                        @foreach($promoImagesRaw as $pi => $pfoto)
                        <div class="galeri-item" id="promo-item-{{ $pi }}">
                            <img src="{{ asset($pfoto) }}" alt="">
                            <button type="button" class="hapus-btn" onclick="tandaiHapusPromo({{ $pi }},this)">×</button>
                            <div class="hapus-overlay">
                                <span style="color:#fff;font-size:9px;font-weight:700;">Akan dihapus</span>
                                <button type="button" class="restore-btn" onclick="tandaiHapusPromo({{ $pi }},document.querySelector('#promo-item-{{ $pi }} .hapus-btn'))">↺ Batal</button>
                            </div>
                        </div>
                        @endforeach
                        <div class="galeri-add-slot" id="promo-add-slot">
                            <i class="bi bi-plus-circle" style="font-size:18px;"></i>
                            <span>Tambah</span>
                            <input type="file" name="promo_images_baru[]" accept="image/webp,image/jpeg,image/jpg,image/png" multiple onchange="tambahPromo(this)">
                        </div>
                    </div>
                    <div style="font-size:11px;color:#9ca3af;margin-bottom:14px;" id="promo-baru-preview-wrap" style="display:none;">
                        <div id="promo-baru-grid" class="galeri-grid" style="display:none;"></div>
                    </div>
                    <p style="font-size:11px; color:red; margin-bottom:12px;">Klik × untuk tandai hapus. <br>Klik ↺ untuk batalkan. <br> Berlaku setelah Simpan.</p>
                    <div style="font-size:11px;color:red;margin-top:-4px;margin-bottom:8px;">Format: WebP, JPG, PNG. Maks 10MB per foto.</div>
                    <div class="field-group"><div class="field-label">Badge</div><input type="text" name="promo_badge" class="field-input" value="{{ $s['promo_badge'] ?? '' }}" placeholder="Penawaran Terbatas" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Judul</div><input type="text" name="promo_title" class="field-input" value="{{ $s['promo_title'] ?? '' }}" placeholder="Harga Spesial Early Bird" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Subtitle</div><input type="text" name="promo_subtitle" class="field-input" value="{{ $s['promo_subtitle'] ?? '' }}" placeholder="Penawaran terbatas..." oninput="markPending()"></div>
                </div>
            </div>

            {{-- unit section text --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Section Pilihan Unit</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div class="field-group"><div class="field-label">Badge</div><input type="text" name="unit_section_badge" class="field-input" value="{{ $s['unit_section_badge'] ?? '' }}" placeholder="Pilihan Unit" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Judul 1</div><input type="text" name="unit_section_title_1" class="field-input" value="{{ $s['unit_section_title_1'] ?? '' }}" placeholder="Pilih Tipe Unit yang" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Judul 2</div><input type="text" name="unit_section_title_2" class="field-input" value="{{ $s['unit_section_title_2'] ?? '' }}" placeholder="Sesuai Gaya Hidup Anda" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Deskripsi</div><textarea name="unit_section_desc" class="field-input" rows="2" oninput="markPending()">{{ $s['unit_section_desc'] ?? '' }}</textarea></div>
                </div>
            </div>

            {{-- daftar unit --}}
            @foreach($units as $unit)
            <div class="section-accordion" id="accordion-unit-{{ $unit->id }}">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">
                        Unit: {{ $unit->nama_tipe }}
                        <span style="font-size:11px;color:#9ca3af;font-weight:400;">— {{ $unit->luas_unit }}</span>
                    </span>
                    <button type="button" class="unit-hapus-btn ms-2" id="btn-hapus-unit-{{ $unit->id }}"
                            onclick="event.stopPropagation(); tandaiHapusUnit({{ $unit->id }}, '{{ $unit->nama_tipe }}')">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                    <i class="bi bi-chevron-right accordion-chevron ms-2"></i>
                </div>
                <div class="section-accordion-body">
                    <input type="hidden" name="unit_ids[]" value="{{ $unit->id }}">

                    <div class="field-group"><div class="field-label">Nama Tipe</div>
                        <input type="text" name="units[{{ $unit->id }}][nama_tipe]" class="field-input" value="{{ $unit->nama_tipe }}" placeholder="Studio" oninput="markPending()"></div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                        <div class="field-group"><div class="field-label">Luas Unit</div>
                            <input type="text" name="units[{{ $unit->id }}][luas_unit]" class="field-input" value="{{ $unit->luas_unit }}" placeholder="25 m²" oninput="markPending()"></div>
                        <div class="field-group"><div class="field-label">Kapasitas</div>
                            <input type="text" name="units[{{ $unit->id }}][kapasitas]" class="field-input" value="{{ $unit->kapasitas }}" placeholder="1-2 Orang" oninput="markPending()"></div>
                        <div class="field-group"><div class="field-label">Tower</div>
                            <input type="text" name="units[{{ $unit->id }}][tower]" class="field-input" value="{{ $unit->tower }}" placeholder="A & B" oninput="markPending()"></div>
                        <div class="field-group"><div class="field-label">View</div>
                            <input type="text" name="units[{{ $unit->id }}][view]" class="field-input" value="{{ $unit->view }}" placeholder="City" oninput="markPending()"></div>
                    </div>

                    {{-- Order input dengan swap otomatis --}}
                    <div class="field-group">
                        <div class="field-label">Urutan</div>
                        <input type="number"
                               name="units[{{ $unit->id }}][order]"
                               id="order-input-{{ $unit->id }}"
                               class="field-input"
                               value="{{ $unit->order }}"
                               min="1"
                               max="{{ $units->count() }}"
                               style="width:80px;"
                               data-unit-id="{{ $unit->id }}"
                               data-prev-order="{{ $unit->order }}"
                               onchange="handleOrderChange(this)"
                               oninput="markPending()">
                        <div style="font-size:11px;color:#9ca3af;margin-top:3px;">Min 1 — Maks {{ $units->count() }}</div>
                    </div>

                    <div class="field-group"><div class="field-label">Subtitle</div>
                        <input type="text" name="units[{{ $unit->id }}][subtitle]" class="field-input" value="{{ $unit->subtitle }}" placeholder="Elegant & Modern" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Deskripsi Lengkap</div>
                        <textarea name="units[{{ $unit->id }}][deskripsi]" class="field-input" rows="3" oninput="markPending()">{{ $unit->deskripsi }}</textarea></div>
                    <div class="field-group"><div class="field-label">Deskripsi Singkat</div>
                        <textarea name="units[{{ $unit->id }}][deskripsi_singkat]" class="field-input" rows="2" oninput="markPending()">{{ $unit->deskripsi_singkat }}</textarea></div>

                    <div class="field-group">
                        <div class="field-label">Foto Card</div>
                        <div class="foto-upload-hero">
                            @if($unit->foto_card)
                                <img id="thumb_card_{{ $unit->id }}" src="{{ $unit->foto_card_url }}" alt="">
                            @else
                                <div class="foto-placeholder" id="thumb_card_{{ $unit->id }}"><i class="bi bi-image" style="font-size:22px;"></i><span>Klik untuk upload foto card</span></div>
                            @endif
                            <input type="file" name="unit_foto_card[{{ $unit->id }}]" accept="image/webp,image/jpeg,image/jpg,image/png" onchange="handleSingleUpload(this,'thumb_card_{{ $unit->id }}',10)">
                        </div>
                        <div style="font-size:11px;color:red;margin-top:3px;">Format: WebP, JPG, PNG. Maks 10MB.</div>
                    </div>

                    <div class="field-group">
                        <div class="field-label">Foto Denah 3D</div>
                        <div class="foto-upload-hero">
                            @if($unit->foto_3d)
                                <img id="thumb_3d_{{ $unit->id }}" src="{{ $unit->foto_3d_url }}" alt="">
                            @else
                                <div class="foto-placeholder" id="thumb_3d_{{ $unit->id }}"><i class="bi bi-grid-3x3" style="font-size:22px;"></i><span>Klik untuk upload foto denah</span></div>
                            @endif
                            <input type="file" name="unit_foto_3d[{{ $unit->id }}]" accept="image/webp,image/jpeg,image/jpg,image/png" onchange="handleSingleUpload(this,'thumb_3d_{{ $unit->id }}',10)">
                        </div>
                        <div style="font-size:11px;color:red;margin-top:3px;">Format: WebP, JPG, PNG. Maks 10MB.</div>
                    </div>

                    <div class="field-group">
                        <div class="field-label">Fasilitas</div>
                        <div id="rows_fasilitas_{{ $unit->id }}">
                            @if(count($unit->fasilitas_array) > 0)
                                @foreach($unit->fasilitas_array as $fi => $fas)
                                <div class="fasilitas-row">
                                    <div class="fasilitas-num">{{ $fi+1 }}</div>
                                    <input class="field-input" type="text" name="units[{{ $unit->id }}][fasilitas][]" value="{{ $fas }}" placeholder="Nama fasilitas..." oninput="markPending()">
                                    <button type="button" class="btn-remove-row" onclick="removeFasilitas(this,'rows_fasilitas_{{ $unit->id }}')"><i class="bi bi-x"></i></button>
                                </div>
                                @endforeach
                            @else
                            <div class="fasilitas-row">
                                <div class="fasilitas-num">1</div>
                                <input class="field-input" type="text" name="units[{{ $unit->id }}][fasilitas][]" placeholder="Nama fasilitas..." oninput="markPending()">
                                <button type="button" class="btn-remove-row" onclick="removeFasilitas(this,'rows_fasilitas_{{ $unit->id }}')"><i class="bi bi-x"></i></button>
                            </div>
                            @endif
                        </div>
                        <button type="button" class="btn-add-row mt-1" onclick="addFasilitas('rows_fasilitas_{{ $unit->id }}','{{ $unit->id }}')">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Fasilitas
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- kontak --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Kontak & Booking</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div class="field-group"><div class="field-label">Nomor WhatsApp</div>
                        <input type="text" name="whatsapp_number" class="field-input" value="{{ $s['whatsapp_number'] ?? '' }}" placeholder="628xxxxxxxxxx" oninput="markPending()">
                        <div style="font-size:11px;color:#9ca3af;margin-top:3px;">Format internasional tanpa +, contoh: 6282334466773</div></div>
                    <div class="field-group"><div class="field-label">Pesan Default WA</div>
                        <textarea name="whatsapp_message" class="field-input" rows="2" oninput="markPending()">{{ $s['whatsapp_message'] ?? '' }}</textarea></div>
                    <div class="field-group"><div class="field-label">Link Booking Unit</div>
                        <input type="text" name="rental_url" class="field-input" value="{{ $s['rental_url'] ?? '' }}" placeholder="https://dev.hotelify.id" oninput="markPending()">
                        <div style="font-size:11px;color:#9ca3af;margin-top:3px;">Kosongkan jika tombol Booking Unit tidak ingin ditampilkan.</div></div>
                </div>
            </div>

            {{-- video --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Video</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    @php $videoVal = \App\Models\Setting::where('key','main_video')->value('value'); @endphp
                    <div class="field-group">
                        <div class="field-label">Upload Video</div>
                        @if($videoVal)
                        <div class="video-preview-box" id="video-preview-box">
                            <video id="video-preview-player" src="{{ asset($videoVal) }}" muted controls style="width:100%;max-height:140px;display:block;"></video>
                        </div>
                        @else
                        <div class="video-preview-box" id="video-preview-box" style="display:none;">
                            <video id="video-preview-player" muted controls style="width:100%;max-height:140px;display:block;"></video>
                        </div>
                        @endif
                        <div class="foto-upload-slot" style="width:100%;border-radius:10px;">
                            <div class="foto-placeholder">
                                <i class="bi bi-camera-video" style="font-size:22px;"></i>
                                <span id="video-filename">{{ $videoVal ? basename($videoVal) : 'Klik untuk ganti video' }}</span>
                            </div>
                            <input type="file" name="main_video" accept="video/mp4,video/webm"
                                   style="position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;"
                                   onchange="handleVideoUpload(this)">
                        </div>
                        <div style="font-size:11px;color:red;margin-top:3px;">Format: MP4, WebM. Maks 50MB.</div>
                    </div>
                    <div class="field-group"><div class="field-label">Subtitle Video</div>
                        <input type="text" name="video_subtitle" class="field-input" value="{{ $s['video_subtitle'] ?? '' }}" placeholder="Cinematic Tour" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Judul Video</div>
                        <input type="text" name="video_title" class="field-input" value="{{ $s['video_title'] ?? '' }}" placeholder="Bale Hinggil Experience" oninput="markPending()"></div>
                </div>
            </div>

            {{-- galeri --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Galeri</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div class="field-group"><div class="field-label">Badge</div>
                        <input type="text" name="gallery_badge" class="field-input" value="{{ $s['gallery_badge'] ?? '' }}" placeholder="Galeri" oninput="markPending()"></div>
                    <div class="field-group"><div class="field-label">Judul</div>
                        <input type="text" name="gallery_title" class="field-input" value="{{ $s['gallery_title'] ?? '' }}" placeholder="Lihat Lebih Dekat" oninput="markPending()"></div>

                    @foreach($units as $unit)
                    @php
                        $galeriFoto = $unit->galeri_foto;
                        if (is_string($galeriFoto)) $galeriFoto = json_decode($galeriFoto, true) ?? [];
                        if (!is_array($galeriFoto)) $galeriFoto = [];
                        $galeriCount = count($galeriFoto);
                    @endphp
                    <div style="border-top:1px solid #f1f5f9;padding-top:14px;margin-top:6px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                            <div class="field-label" style="margin-bottom:0;">{{ $unit->nama_tipe }}</div>
                            <span id="galeri-count-{{ $unit->id }}" style="font-size:11px;font-weight:700;color:#374151;">{{ $galeriCount }}/10</span>
                        </div>
                        <div class="galeri-grid" id="galeri-grid-{{ $unit->id }}">
                            @foreach($galeriFoto as $gi => $foto)
                            <div class="galeri-item" id="galeri-{{ $unit->id }}-{{ $gi }}">
                                <img src="{{ asset($foto) }}" alt="">
                                <button type="button" class="hapus-btn" onclick="tandaiHapusGaleri({{ $unit->id }},{{ $gi }})">×</button>
                                <input type="hidden" name="unit_existing_galeri[{{ $unit->id }}][]" value="{{ $foto }}" id="galeri-input-{{ $unit->id }}-{{ $gi }}">
                                <div class="hapus-overlay">
                                    <span style="color:#fff;font-size:9px;font-weight:700;">Akan dihapus</span>
                                    <button type="button" class="restore-btn" onclick="tandaiHapusGaleri({{ $unit->id }},{{ $gi }})">↺ Batal</button>
                                </div>
                            </div>
                            @endforeach
                            @if($galeriCount < 10)
                            <div class="galeri-add-slot" id="galeri-add-{{ $unit->id }}">
                                <i class="bi bi-plus-circle" style="font-size:16px;"></i>
                                <span>Tambah</span>
                                <input type="file" name="unit_galeri_baru[{{ $unit->id }}][]" accept="image/webp,image/jpeg,image/jpg,image/png" multiple onchange="tambahGaleri(this, {{ $unit->id }})">
                            </div>
                            @endif
                        </div>
                        <div id="galeri-baru-preview-{{ $unit->id }}" style="display:none;font-size:11px;color:#9ca3af;margin-top:4px;"></div>
                    </div>
                    <p style="font-size:11px;color:red;margin-bottom:8px;">Klik × untuk tandai hapus. <br>↺ untuk batalkan.<br> Berlaku setelah Simpan.</p>
                    <div style="font-size:11px;color:red;margin-top:3px;margin-bottom:4px;">Format: WebP, JPG, PNG. Maks 10MB per foto.</div>
                    @endforeach
                </div>
            </div>

            </div>{{-- end form-scroll-area --}}

            <div class="submit-bar">
                <button type="submit" class="btn btn-success btn-sm px-4 py-2 fw-bold">
                    <i class="bi bi-floppy me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.unit.index') }}"
                   class="btn btn-light btn-sm border px-3">Batal</a>
                <span id="saved-indicator" style="font-size:11px; color:#10b981; display:none;">
                    <i class="bi bi-check-circle me-1"></i>Tersimpan
                </span>
            </div>
        </form>
    </div>

    {{-- panel kanan, live preview --}}
    <div class="edit-preview-panel">
        <div class="preview-panel-header">
            <span style="font-size:11px;font-weight:700;color:#6b7280;letter-spacing:.5px;text-transform:uppercase;">Live Preview</span>
            <div class="ms-auto d-flex align-items-center gap-2">
                <span id="preview-syncing" style="display:none;align-items:center;gap:5px;font-size:11px;color:#f59e0b;font-weight:600;">
                    <span class="spinner-border spinner-border-sm" style="width:10px;height:10px;border-width:2px;"></span> Menyinkronkan...
                </span>
                <span id="preview-synced" style="display:none;align-items:center;gap:5px;font-size:11px;color:#10b981;font-weight:600;">
                    <i class="bi bi-check-circle-fill"></i> Tersinkron
                </span>
                <a href="{{ route('user.tipeunit') }}" target="_blank"
                   class="btn btn-sm btn-light border" style="font-size:11px;padding:3px 10px;">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Buka
                </a>
            </div>
        </div>
        <div class="preview-iframe-wrap">
            <div class="iframe-loading" id="iframeLoading">
                <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                <span style="font-size:12px;color:#9ca3af;">Memuat preview...</span>
            </div>
            <iframe id="previewIframe" src="{{ route('user.tipeunit') }}?_preview_page=1"></iframe>
        </div>
    </div>

</div>

@foreach($units as $unit)
<form id="delete-unit-{{ $unit->id }}"
      action="{{ route('admin.unit.destroy', $unit->id) }}"
      method="POST" style="display:none;">
    @csrf @method('DELETE')
</form>
@endforeach

@endsection

@push('scripts')
<script>
// ─── accordion ───────────────────────────────────────────────
function toggleAccordion(header) {
    const chevron = header.querySelector('.accordion-chevron');
    const body    = header.nextElementSibling;
    const isOpen  = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    chevron.classList.toggle('open', !isOpen);
}

// ─── iframe ──────────────────────────────────────────────────
let isTextReload = false;

function iframeLoaded() {
    document.getElementById('iframeLoading').classList.add('hidden');
    const iframe = document.getElementById('previewIframe');
    isTextReload = false;
    if (!iframe?.contentWindow) return;
    setTimeout(() => {
        Object.values(previewImgState).forEach(msg => {
            iframe.contentWindow.postMessage(msg, '*');
        });
        Object.keys(hapusGaleriSet).forEach(unitId => {
            rebuildAndSendGaleriPreview(unitId);
        });
        rebuildAndSendPromoPreview();
    }, 800);
}
document.getElementById('previewIframe').addEventListener('load', iframeLoaded);

// ─── preview sync ─────────────────────────────────────────────
let previewTimer = null, hasPendingSave = false, isSyncing = false;
const PREVIEW_URL = '{{ route("admin.unit-page.preview-settings") }}';
const CSRF_TOKEN  = '{{ csrf_token() }}';

function schedulePreview() {
    hasPendingSave = true;
    if (!isSyncing) { showSyncing(); isSyncing = true; }
    clearTimeout(previewTimer);
    previewTimer = setTimeout(sendPreview, 800);
}
function sendPreview() {
    const fd = new FormData(document.getElementById('mainForm'));
    fd.delete('_method');
    for (const [key] of [...fd.entries()]) {
        if (fd.get(key) instanceof File) fd.delete(key);
    }
    hapusUnitSet.forEach(id => fd.append('hapus_unit_preview[]', id));

    fetch(PREVIEW_URL, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF_TOKEN}, body:fd })
        .then(r => r.json())
        .then(d => {
            if (d.ok) {
                showSynced();
                hasPendingSave = false;
                isTextReload = true;
                const iframe = document.getElementById('previewIframe');
                document.getElementById('iframeLoading').classList.remove('hidden');
                iframe.src = '{{ route("user.tipeunit") }}?_preview_page=1&_t=' + Date.now();
            }
        })
        .catch(() => hideSyncStatus());
}
function showSyncing() { document.getElementById('preview-syncing').style.display='flex'; document.getElementById('preview-synced').style.display='none'; }
function showSynced()  {
    isSyncing = false;
    document.getElementById('preview-syncing').style.display='none';
    document.getElementById('preview-synced').style.display='flex';
    setTimeout(() => { document.getElementById('preview-synced').style.display='none'; }, 2000);
}
function hideSyncStatus() { document.getElementById('preview-syncing').style.display='none'; document.getElementById('preview-synced').style.display='none'; }
function markPending() { schedulePreview(); }

// ─── file size validation ─────────────────────────────────────
const MAX_IMG_MB  = 10;
const MAX_VID_MB  = 50;

function showFilesizeToast(msg) {
    const existing = document.querySelector('.filesize-toast');
    if (existing) existing.remove();
    const el = document.createElement('div');
    el.className = 'filesize-toast';
    el.innerHTML = `<i class="bi bi-exclamation-circle me-1"></i>${msg}`;
    document.body.appendChild(el);
    setTimeout(() => {
        el.style.animation = 'toastOut .3s ease forwards';
        setTimeout(() => el.remove(), 300);
    }, 3500);
}

function checkFileSize(file, maxMb) {
    return file.size <= maxMb * 1024 * 1024;
}

// ─── single image upload ──────────────────────────────────────
const previewImgState = {};

function handleSingleUpload(input, thumbId, maxMb = 10) {
    if (!input.files?.[0]) return;
    const file = input.files[0];
    if (!checkFileSize(file, maxMb)) {
        showFilesizeToast(`Ukuran file terlalu besar! Maks ${maxMb}MB (file ini: ${(file.size/1024/1024).toFixed(1)}MB)`);
        input.value = '';
        return;
    }
    const reader = new FileReader();
    reader.onload = (e) => {
        const src = e.target.result;
        const el = document.getElementById(thumbId);
        if (el) {
            if (el.tagName === 'IMG') { el.src = src; }
            else { const img = document.createElement('img'); img.id=thumbId; img.src=src; el.replaceWith(img); }
        }
        let msg = null;
        if      (thumbId === 'thumb_hero_image')    { msg = { type:'PREVIEW_IMG', src, target:'hero' };    previewImgState['hero']           = msg; }
        else if (thumbId === 'thumb_counting_image') { msg = { type:'PREVIEW_IMG', src, target:'counting' }; previewImgState['counting']       = msg; }
        else if (thumbId.startsWith('thumb_card_')) { const uid = thumbId.replace('thumb_card_',''); msg = { type:'PREVIEW_IMG', key:uid, src, target:'card' };  previewImgState['card_'+uid]  = msg; }
        else if (thumbId.startsWith('thumb_3d_'))   { const uid = thumbId.replace('thumb_3d_','');  msg = { type:'PREVIEW_IMG', key:uid, src, target:'denah' }; previewImgState['denah_'+uid] = msg; }
        const iframe = document.getElementById('previewIframe');
        if (msg && iframe?.contentWindow) iframe.contentWindow.postMessage(msg, '*');
        schedulePreview();
    };
    reader.readAsDataURL(file);
}

// ─── video upload ─────────────────────────────────────────────
function handleVideoUpload(input) {
    if (!input.files?.[0]) return;
    const file = input.files[0];
    if (!checkFileSize(file, MAX_VID_MB)) {
        showFilesizeToast(`Ukuran video terlalu besar! Maks ${MAX_VID_MB}MB (file ini: ${(file.size/1024/1024).toFixed(1)}MB)`);
        input.value = '';
        return;
    }
    const url = URL.createObjectURL(file);
    const el = document.getElementById('video-filename');
    if (el) el.textContent = file.name;
    const box = document.getElementById('video-preview-box');
    const player = document.getElementById('video-preview-player');
    if (box && player) { box.style.display = ''; player.src = url; player.load(); }
    const msg = { type:'PREVIEW_IMG', src:url, target:'video' };
    previewImgState['video'] = msg;
    const iframe = document.getElementById('previewIframe');
    if (iframe?.contentWindow) iframe.contentWindow.postMessage(msg, '*');
    schedulePreview();
}

// ─── order swap ───────────────────────────────────────────────
// unitOrders: { unitId: currentOrder } — sumber kebenaran live di form
const unitOrders = {};
window.UNIT_LIST.forEach(u => { unitOrders[u.id] = u.order; });

function handleOrderChange(input) {
    const unitId   = parseInt(input.dataset.unitId);
    const newOrder = parseInt(input.value);
    const maxOrder = window.UNIT_COUNT;

    // Clamp nilai
    if (isNaN(newOrder) || newOrder < 1) { input.value = unitOrders[unitId]; return; }
    if (newOrder > maxOrder)             { input.value = maxOrder; handleOrderChange(input); return; }

    const oldOrder = unitOrders[unitId];
    if (newOrder === oldOrder) return;

    // Cari unit lain yang sekarang pakai order newOrder
    let swapId = null;
    for (const [id, ord] of Object.entries(unitOrders)) {
        if (parseInt(id) !== unitId && ord === newOrder) { swapId = parseInt(id); break; }
    }

    if (swapId !== null) {
        // Swap di unitOrders
        unitOrders[swapId]  = oldOrder;
        unitOrders[unitId]  = newOrder;

        // Update input form yang lain secara live
        const swapInput = document.getElementById('order-input-' + swapId);
        if (swapInput) {
            swapInput.value = oldOrder;
            swapInput.dataset.prevOrder = oldOrder;
        }
    } else {
        unitOrders[unitId] = newOrder;
    }

    input.dataset.prevOrder = newOrder;
    schedulePreview();
}

// ─── promo: soft delete & tambah ─────────────────────────────
const hapusPromoSet = new Set();
let promoBaru = new DataTransfer();
let _cachedNewPromoSrcs = [];

function updateHapusPromoInputs() {
    const container = document.getElementById('hapus-promo-inputs');
    container.innerHTML = '';
    hapusPromoSet.forEach(idx => {
        const inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = 'hapus_promo[]'; inp.value = idx;
        container.appendChild(inp);
    });
}

function tandaiHapusPromo(index, btn) {
    const item = document.getElementById('promo-item-' + index);
    if (!item) return;
    if (hapusPromoSet.has(index)) {
        hapusPromoSet.delete(index); item.classList.remove('marked-hapus'); btn.textContent = '×';
    } else {
        hapusPromoSet.add(index);   item.classList.add('marked-hapus');    btn.textContent = '↺';
    }
    updateHapusPromoInputs();
    rebuildAndSendPromoPreview();
    schedulePreview();
}

function tambahPromo(input) {
    if (!input.files?.length) return;
    const oversized = Array.from(input.files).filter(f => !checkFileSize(f, MAX_IMG_MB));
    if (oversized.length) {
        showFilesizeToast(`${oversized.length} file melebihi batas 10MB dan dilewati.`);
    }
    const valid = Array.from(input.files).filter(f => checkFileSize(f, MAX_IMG_MB));
    if (!valid.length) { input.value = ''; return; }
    valid.forEach(file => promoBaru.items.add(file));
    input.files = promoBaru.files;

    const grid = document.getElementById('promo-baru-grid');
    const wrap = document.getElementById('promo-baru-preview-wrap');
    grid.innerHTML = '';
    grid.style.display = 'grid';

    let resetBtn = document.getElementById('promo-baru-reset');
    if (!resetBtn) {
        resetBtn = document.createElement('button');
        resetBtn.type = 'button'; resetBtn.id = 'promo-baru-reset';
        resetBtn.style.cssText = 'font-size:11px;color:#ef4444;background:none;border:none;cursor:pointer;margin-top:4px;padding:0;display:block;';
        resetBtn.textContent = '× Batalkan semua foto baru';
        resetBtn.onclick = () => {
            promoBaru = new DataTransfer(); _cachedNewPromoSrcs = [];
            const pi = document.querySelector('input[name="promo_images_baru[]"]');
            if (pi) pi.value = '';
            grid.innerHTML = ''; grid.style.display = 'none'; resetBtn.remove();
            rebuildAndSendPromoPreview();
        };
        wrap.appendChild(resetBtn);
    }

    let loaded = 0;
    const total = promoBaru.files.length;
    const newBase64Srcs = new Array(total);

    Array.from(promoBaru.files).forEach((file, idx) => {
        const r = new FileReader();
        r.onload = e => {
            const imgEl = new Image();
            imgEl.onload = () => {
                const canvas = document.createElement('canvas');
                const maxW = 1200, ratio = Math.min(1, maxW / imgEl.naturalWidth);
                canvas.width  = Math.round(imgEl.naturalWidth  * ratio);
                canvas.height = Math.round(imgEl.naturalHeight * ratio);
                canvas.getContext('2d').drawImage(imgEl, 0, 0, canvas.width, canvas.height);
                const resized = canvas.toDataURL('image/jpeg', 0.85);

                const d = document.createElement('div');
                d.className = 'galeri-item'; d.dataset.idx = idx;
                const img = document.createElement('img'); img.src = resized; d.appendChild(img);
                const hb = document.createElement('button');
                hb.type = 'button'; hb.className = 'hapus-btn'; hb.textContent = '×';
                hb.onclick = () => {
                    const ci = parseInt(d.dataset.idx);
                    const newDT = new DataTransfer();
                    Array.from(promoBaru.files).forEach((f, i) => { if (i !== ci) newDT.items.add(f); });
                    promoBaru = newDT;
                    const pi2 = document.querySelector('input[name="promo_images_baru[]"]');
                    if (pi2) pi2.files = promoBaru.files;
                    d.remove();
                    grid.querySelectorAll('.galeri-item').forEach((el, i) => { el.dataset.idx = i; });
                    _cachedNewPromoSrcs = Array.from(grid.querySelectorAll('img')).map(i => i.src);
                    rebuildAndSendPromoPreview();
                    schedulePreview();
                    if (promoBaru.files.length === 0) { grid.style.display='none'; const rb=document.getElementById('promo-baru-reset'); if(rb) rb.remove(); }
                };
                d.appendChild(hb); grid.appendChild(d);
                newBase64Srcs[idx] = resized; loaded++;
                if (loaded === total) { rebuildAndSendPromoPreview(newBase64Srcs); schedulePreview(); }
            };
            imgEl.src = e.target.result;
        };
        r.readAsDataURL(file);
    });
}

function rebuildAndSendPromoPreview(newBase64Srcs) {
    if (newBase64Srcs) _cachedNewPromoSrcs = [...newBase64Srcs];
    const existingSrcs = [];
    document.querySelectorAll('#promo-saved-grid .galeri-item:not(.galeri-add-slot)').forEach((item, i) => {
        if (!hapusPromoSet.has(i)) { const img = item.querySelector('img'); if (img) existingSrcs.push(img.src); }
    });
    const allSrcs = [...existingSrcs, ..._cachedNewPromoSrcs];
    const msg = { type:'PREVIEW_IMG', target:'promo_baru', srcs:allSrcs };
    previewImgState['promo'] = msg;
    const iframe = document.getElementById('previewIframe');
    if (iframe?.contentWindow) { try { iframe.contentWindow.postMessage(msg, '*'); } catch(e) {} }
}

// ─── hapus unit (soft) ────────────────────────────────────────
const hapusUnitSet = new Set();

function tandaiHapusUnit(id, nama) {
    const accordion = document.getElementById('accordion-unit-' + id);
    const btn       = document.getElementById('btn-hapus-unit-' + id);
    if (!accordion) return;
    if (hapusUnitSet.has(id)) {
        hapusUnitSet.delete(id);
        accordion.classList.remove('unit-marked-hapus');
        btn.className = 'unit-hapus-btn ms-2';
        btn.innerHTML = '<i class="bi bi-trash"></i> Hapus';
        btn.onclick = (e) => { e.stopPropagation(); tandaiHapusUnit(id, nama); };
        const existing = document.querySelector(`input[name="unit_ids[]"][value="${id}"]`);
        if (!existing) {
            const inp = document.createElement('input');
            inp.type='hidden'; inp.name='unit_ids[]'; inp.value=id;
            accordion.querySelector('.section-accordion-body').prepend(inp);
        }
        document.getElementById('hapus-unit-inp-' + id)?.remove();
    } else {
        if (!confirm('Tandai unit "' + nama + '" untuk dihapus? Berlaku setelah Simpan.')) return;
        hapusUnitSet.add(id);
        accordion.classList.add('unit-marked-hapus');
        btn.className = 'unit-restore-btn ms-2';
        btn.innerHTML = '<i class="bi bi-arrow-counterclockwise"></i> Batalkan';
        btn.onclick = (e) => { e.stopPropagation(); tandaiHapusUnit(id, nama); };
        document.querySelector(`input[name="unit_ids[]"][value="${id}"]`)?.remove();
        const inp = document.createElement('input');
        inp.type='hidden'; inp.name='hapus_unit[]'; inp.value=id;
        inp.id = 'hapus-unit-inp-' + id;
        document.getElementById('hapus-unit-inputs').appendChild(inp);
    }
    schedulePreview();
}

// ─── galeri unit: soft delete & tambah ───────────────────────
const hapusGaleriSet = {};
const galeriBaru     = {};
const MAX_GALERI     = 10;

function tandaiHapusGaleri(unitId, index) {
    unitId = String(unitId);
    if (!hapusGaleriSet[unitId]) hapusGaleriSet[unitId] = new Set();
    const item = document.getElementById('galeri-' + unitId + '-' + index);
    const inp  = document.getElementById('galeri-input-' + unitId + '-' + index);
    if (!item) return;
    if (hapusGaleriSet[unitId].has(index)) {
        hapusGaleriSet[unitId].delete(index);
        item.classList.remove('marked-hapus');
        if (inp) inp.disabled = false;
    } else {
        hapusGaleriSet[unitId].add(index);
        item.classList.add('marked-hapus');
        if (inp) inp.disabled = true;
    }
    updateGaleriCount(unitId);
    rebuildAndSendGaleriPreview(unitId);
    schedulePreview();
}

function rebuildGaleriBaru(unitId) {
    const previewWrap = document.getElementById('galeri-baru-preview-' + unitId);
    if (!previewWrap) return;
    if (!galeriBaru[unitId] || galeriBaru[unitId].files.length === 0) {
        previewWrap.innerHTML = ''; previewWrap.style.display = 'none'; return;
    }
    previewWrap.innerHTML = `<div class="galeri-grid" style="margin-top:6px;"></div>`;
    const grid = previewWrap.querySelector('.galeri-grid');
    Array.from(galeriBaru[unitId].files).forEach((file, idx) => {
        const r = new FileReader();
        r.onload = e => {
            const d = document.createElement('div');
            d.className = 'galeri-item'; d.dataset.idx = String(idx);
            const img = document.createElement('img'); img.src = e.target.result; d.appendChild(img);
            const hb = document.createElement('button');
            hb.type = 'button'; hb.className = 'hapus-btn'; hb.textContent = '×';
            hb.onclick = () => {
                const ci = parseInt(d.dataset.idx);
                const newDT = new DataTransfer();
                Array.from(galeriBaru[unitId].files).forEach((f, i) => { if (i !== ci) newDT.items.add(f); });
                galeriBaru[unitId] = newDT;
                const fi = document.querySelector(`input[name="unit_galeri_baru[${unitId}][]"]`);
                if (fi) fi.files = galeriBaru[unitId].files;
                rebuildGaleriBaru(unitId);
                updateGaleriCount(unitId);
                rebuildAndSendGaleriPreview(unitId);
                schedulePreview();
            };
            d.appendChild(hb); grid.appendChild(d);
            grid.querySelectorAll('.galeri-item').forEach((el, i) => el.dataset.idx = String(i));
        };
        r.readAsDataURL(file);
    });
    previewWrap.style.display = '';
}

function tambahGaleri(input, unitId) {
    if (!galeriBaru[unitId]) galeriBaru[unitId] = new DataTransfer();

    const oversized = Array.from(input.files).filter(f => !checkFileSize(f, MAX_IMG_MB));
    if (oversized.length) {
        showFilesizeToast(`${oversized.length} file melebihi batas 10MB dan dilewati.`);
    }
    const validFiles = Array.from(input.files).filter(f => checkFileSize(f, MAX_IMG_MB));
    if (!validFiles.length) { input.value = ''; return; }

    const existingCount = document.querySelectorAll(`#galeri-grid-${unitId} .galeri-item:not(.galeri-add-slot)`).length;
    const hapusCount    = hapusGaleriSet[unitId]?.size ?? 0;
    const baruCount     = galeriBaru[unitId].files.length;
    const aktif         = existingCount - hapusCount + baruCount;
    const sisa          = MAX_GALERI - aktif;

    if (sisa <= 0) { alert('Maksimal ' + MAX_GALERI + ' foto galeri.'); input.value = ''; return; }

    const filesToAdd = validFiles.slice(0, sisa);
    if (validFiles.length > sisa) {
        showFilesizeToast(`Hanya ${sisa} foto lagi yang bisa ditambahkan (maks 10).`);
    }
    filesToAdd.forEach(file => galeriBaru[unitId].items.add(file));
    input.files = galeriBaru[unitId].files;

    updateGaleriCount(unitId);
    rebuildGaleriBaru(unitId);

    // Kirim ke preview setelah semua file dibaca
    let loaded = 0;
    const newSrcs = [];
    filesToAdd.forEach((file, idx) => {
        const r = new FileReader();
        r.onload = e => {
            newSrcs[idx] = e.target.result;
            loaded++;
            if (loaded === filesToAdd.length) {
                // Rebuild dengan semua foto baru termasuk yang baru ditambahkan
                rebuildAndSendGaleriPreview(unitId);
                schedulePreview();
            }
        };
        r.readAsDataURL(file);
    });
}

function rebuildAndSendGaleriPreview(unitId) {
    unitId = String(unitId);

    // Foto existing yang tidak ditandai hapus
    const existing = [];
    document.querySelectorAll('#galeri-grid-' + unitId + ' .galeri-item:not(.galeri-add-slot)').forEach(item => {
        if (item.classList.contains('marked-hapus')) return;
        const imgEl = item.querySelector('img');
        if (imgEl?.src) existing.push(imgEl.src);
    });

    // Foto baru dari galeriBaru — baca semua sebagai base64 dulu
    if (!galeriBaru[unitId] || galeriBaru[unitId].files.length === 0) {
        _sendGaleriPreview(unitId, existing, []);
        return;
    }

    const baruSrcs = [];
    let loaded = 0;
    const total = galeriBaru[unitId].files.length;

    // Cek apakah preview wrap sudah punya img (sudah di-render)
    const previewWrap = document.getElementById('galeri-baru-preview-' + unitId);
    const renderedImgs = previewWrap ? previewWrap.querySelectorAll('img') : [];

    if (renderedImgs.length === total) {
        // Ambil dari DOM yang sudah ada
        renderedImgs.forEach(img => baruSrcs.push(img.src));
        _sendGaleriPreview(unitId, existing, baruSrcs);
    } else {
        // Baca ulang dari file
        Array.from(galeriBaru[unitId].files).forEach((file, idx) => {
            const r = new FileReader();
            r.onload = e => {
                baruSrcs[idx] = e.target.result;
                loaded++;
                if (loaded === total) _sendGaleriPreview(unitId, existing, baruSrcs);
            };
            r.readAsDataURL(file);
        });
    }
}

function _sendGaleriPreview(unitId, existing, baru) {
    const all = [...existing, ...baru];
    const msg = { type:'PREVIEW_IMG', target:'galeri_unit', unitId: String(unitId), srcs: all };
    const iframe = document.getElementById('previewIframe');
    if (iframe?.contentWindow) {
        try { iframe.contentWindow.postMessage(msg, '*'); } catch(e) {}
    }
}

function updateGaleriCount(unitId) {
    unitId = String(unitId);
    const totalExisting = document.querySelectorAll(`#galeri-grid-${unitId} .galeri-item:not(.galeri-add-slot)`).length;
    const hapusCount    = hapusGaleriSet[unitId]?.size ?? 0;
    const baruCount     = galeriBaru[unitId]?.files.length ?? 0;
    const total         = totalExisting - hapusCount + baruCount;
    const counter = document.getElementById('galeri-count-' + unitId);
    if (counter) counter.textContent = total + '/10';
    const addSlot = document.getElementById('galeri-add-' + unitId);
    if (addSlot) addSlot.style.display = total >= MAX_GALERI ? 'none' : '';
}

// ─── fasilitas ────────────────────────────────────────────────
function addFasilitas(containerId, unitId) {
    const container = document.getElementById(containerId);
    const count = container.querySelectorAll('.fasilitas-row').length + 1;
    const row = document.createElement('div'); row.className = 'fasilitas-row';
    row.innerHTML = `<div class="fasilitas-num">${count}</div>
        <input class="field-input" type="text" name="units[${unitId}][fasilitas][]" placeholder="Nama fasilitas..." oninput="markPending()">
        <button type="button" class="btn-remove-row" onclick="removeFasilitas(this,'${containerId}')"><i class="bi bi-x"></i></button>`;
    container.appendChild(row);
    schedulePreview();
}
function removeFasilitas(btn, containerId) {
    const container = document.getElementById(containerId);
    if (container.querySelectorAll('.fasilitas-row').length <= 1) return;
    btn.closest('.fasilitas-row').remove();
    container.querySelectorAll('.fasilitas-num').forEach((el, i) => el.textContent = i + 1);
    schedulePreview();
}

window.addEventListener('beforeunload', e => { if (hasPendingSave) { e.preventDefault(); e.returnValue = ''; } });
</script>
@endpush