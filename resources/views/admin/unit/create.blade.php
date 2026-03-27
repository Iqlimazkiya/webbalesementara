@extends('layouts.admin.main')

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
    background: #fff;
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
.foto-upload-hero input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }

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
.foto-upload-slot input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }

/* galeri preview — new style */
.galeri-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    margin-top: 10px;
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
.galeri-item .btn-remove-galeri {
    position: absolute;
    top: 4px; right: 4px;
    width: 22px; height: 22px;
    background: #ef4444; color: #fff;
    border: none; border-radius: 50%;
    font-size: 12px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; line-height: 1;
    padding: 0;
    box-shadow: 0 1px 4px rgba(0,0,0,.25);
}
.galeri-item .btn-remove-galeri:hover { background: #b91c1c; }
.galeri-add-slot {
    aspect-ratio: 1;
    border: 1px dashed #d1d5db;
    border-radius: 8px;
    background: #f8fafc;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 4px; color: #9ca3af; font-size: 11px;
    cursor: pointer; position: relative;
    transition: border-color .2s;
}
.galeri-add-slot:hover { border-color: #335A40; color: #335A40; }
.galeri-add-slot input[type="file"] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer;
}
.galeri-note {
    font-size: 11px; color: #ef4444;
    margin-top: 8px; line-height: 1.6;
}
/* foto single upload — remove button */
.foto-upload-wrap { position: relative; }
.foto-upload-wrap .btn-remove-foto {
    position: absolute;
    top: 6px; right: 6px;
    width: 22px; height: 22px;
    background: #ef4444; color: #fff;
    border: none; border-radius: 50%;
    font-size: 12px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; z-index: 5;
    box-shadow: 0 1px 4px rgba(0,0,0,.25);
    line-height: 1; padding: 0;
}
.foto-upload-wrap .btn-remove-foto:hover { background: #b91c1c; }
.foto-note {
    font-size: 11px; color: #ef4444;
    margin-top: 6px; line-height: 1.6;
}

/* fasilitas */
.fasilitas-row { display: flex; gap: 6px; align-items: center; margin-bottom: 6px; }
.fasilitas-num {
    width: 22px; height: 22px;
    background: #335A40; color: #fff;
    border-radius: 50%; font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
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

   {{-- panel kiri, form --}}
    <div class="edit-form-panel">

        <div class="form-panel-header">
            <a href="{{ route('admin.unit.index') }}"
               class="btn btn-sm btn-light border" style="padding:5px 10px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <div style="font-size:13px; font-weight:700; color:#1f2937;">Tambah Unit Baru</div>
                <div style="font-size:11px; color:#9ca3af;">Preview unit yang sudah ada di kanan</div>
            </div>
        </div>

        @if($errors->any())
        <div class="alert alert-danger mx-3 mt-3 mb-0 py-2" style="font-size:12px;">
            <i class="bi bi-exclamation-circle me-1"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="mainForm"
              action="{{ route('admin.unit.store') }}"
              method="POST"
              enctype="multipart/form-data"
              style="display:flex; flex-direction:column; flex:1; min-height:0;">
            @csrf

            <input type="hidden" name="unit_id" value="">
            <div class="form-scroll-area">

            {{-- informasi --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Informasi Dasar</span>
                    <i class="bi bi-chevron-right accordion-chevron open"></i>
                </div>
                <div class="section-accordion-body open">
                    <div class="field-group">
                        <div class="field-label">Nama Tipe <span class="text-danger">*</span></div>
                        <input type="text" name="nama_tipe" class="field-input @error('nama_tipe') border-danger @enderror"
                               value="{{ old('nama_tipe') }}" required placeholder="Studio"
                               oninput="markPending()">
                        @error('nama_tipe')<div style="font-size:11px;color:#ef4444;margin-top:3px;">{{ $message }}</div>@enderror
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                        <div class="field-group">
                            <div class="field-label">Luas Unit <span class="text-danger">*</span></div>
                            <input type="text" name="luas_unit" class="field-input @error('luas_unit') border-danger @enderror"
                                   value="{{ old('luas_unit') }}" required placeholder="25 m²"
                                   oninput="markPending()">
                        </div>
                        <div class="field-group">
                            <div class="field-label">Kapasitas</div>
                            <input type="text" name="kapasitas" class="field-input"
                                   value="{{ old('kapasitas') }}" placeholder="1-2 Orang"
                                   oninput="markPending()">
                        </div>
                        <div class="field-group">
                            <div class="field-label">Tower</div>
                            <input type="text" name="tower" class="field-input"
                                   value="{{ old('tower') }}" placeholder="A & B"
                                   oninput="markPending()">
                        </div>
                        <div class="field-group">
                            <div class="field-label">View</div>
                            <input type="text" name="view" class="field-input"
                                   value="{{ old('view') }}" placeholder="City"
                                   oninput="markPending()">
                        </div>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Urutan Tampil</div>
                        <input type="number" name="order" class="field-input"
                               value="{{ old('order', $nextOrder) }}" min="1" style="width:100px;"
                               oninput="markPending()">
                        <div style="font-size:11px; color:#9ca3af; margin-top:3px;">Angka terkecil tampil paling atas</div>
                    </div>
                </div>
            </div>

            {{-- deskripsi --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Deskripsi</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div class="field-group">
                        <div class="field-label">Subtitle</div>
                        <input type="text" name="subtitle" class="field-input"
                               value="{{ old('subtitle', 'Elegant & Modern') }}" placeholder="Elegant & Modern"
                               oninput="markPending()">
                    </div>
                    <div class="field-group">
                        <div class="field-label">Deskripsi Lengkap</div>
                        <textarea name="deskripsi" class="field-input" rows="4"
                                  placeholder="Unit studio dengan desain modern yang mengutamakan efisiensi ruang tanpa mengurangi kenyamanan..."
                                  oninput="markPending()">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="field-group">
                        <div class="field-label">Deskripsi Singkat</div>
                        <textarea name="deskripsi_singkat" class="field-input" rows="2"
                                  placeholder="Cocok untuk pelajar, mahasiswa, atau professional muda yang aktif dan penuh semangat."
                                  oninput="markPending()">{{ old('deskripsi_singkat') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- foto card --}}
<div class="section-accordion">
    <div class="section-accordion-header" onclick="toggleAccordion(this)">
        <span class="section-accordion-title">Foto Card</span>
        <i class="bi bi-chevron-right accordion-chevron"></i>
    </div>
    <div class="section-accordion-body">
        <p style="font-size:11px; color:#9ca3af; margin-bottom:10px;">
            Foto yang muncul di card pilihan unit. Ukuran rekomendasi: 400×300px.
        </p>
        <div class="foto-upload-wrap">
            <div class="foto-upload-hero" id="wrap_foto_card">
                <div class="foto-placeholder" id="thumb_foto_card">
                    <i class="bi bi-image" style="font-size:22px;"></i>
                    <span>Klik untuk upload foto card</span>
                </div>
                <input type="file" name="foto_card"
                       accept="image/webp,image/jpeg,image/png,image/jpg"
                       id="input_foto_card"
                       onchange="handleSingleUpload(this, 'thumb_foto_card')"
                       style="position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;">
            </div>
            <button type="button" class="btn-remove-foto" id="remove_foto_card"
                    style="display:none;" onclick="removeSingleFoto('foto_card')"
                    title="Batalkan pilihan">×</button>
        </div>
        <div class="foto-note">Format: WebP, JPG, PNG. Maks 10MB.</div>
        @error('foto_card')<div style="font-size:11px;color:#ef4444;margin-top:3px;">{{ $message }}</div>@enderror
    </div>
</div>

            {{-- denah 3d --}}
<div class="section-accordion">
    <div class="section-accordion-header" onclick="toggleAccordion(this)">
        <span class="section-accordion-title">Foto Denah 3D</span>
        <i class="bi bi-chevron-right accordion-chevron"></i>
    </div>
    <div class="section-accordion-body">
        <p style="font-size:11px; color:#9ca3af; margin-bottom:10px;">
            Foto denah/layout unit yang ditampilkan di detail unit.
        </p>
        <div class="foto-upload-wrap">
            <div class="foto-upload-hero" id="wrap_foto_3d">
                <div class="foto-placeholder" id="thumb_foto_3d">
                    <i class="bi bi-grid-3x3" style="font-size:22px;"></i>
                    <span>Klik untuk upload foto denah</span>
                </div>
                <input type="file" name="foto_3d"
                       accept="image/webp,image/jpeg,image/png,image/jpg"
                       id="input_foto_3d"
                       onchange="handleSingleUpload(this, 'thumb_foto_3d')"
                       style="position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;">
            </div>
            <button type="button" class="btn-remove-foto" id="remove_foto_3d"
                    style="display:none;" onclick="removeSingleFoto('foto_3d')"
                    title="Batalkan pilihan">×</button>
        </div>
        <div class="foto-note">Format: WebP, JPG, PNG. Maks 10MB.</div>
        @error('foto_3d')<div style="font-size:11px;color:#ef4444;margin-top:3px;">{{ $message }}</div>@enderror
    </div>
</div>
            {{-- galeri --}}
<div class="section-accordion">
    <div class="section-accordion-header" onclick="toggleAccordion(this)">
        <span class="section-accordion-title">Galeri Foto</span>
        <i class="bi bi-chevron-right accordion-chevron"></i>
    </div>
    <div class="section-accordion-body">
        <div style="font-size:11px; color:#6b7280; margin-bottom:4px;">
            <span id="galeri-count">0</span>/10 foto dipilih
        </div>
        <div class="galeri-grid" id="galeri-grid">
            {{-- slot tambah selalu ada di paling akhir --}}
            <div class="galeri-add-slot" id="galeri-add-slot">
                <i class="bi bi-plus-circle" style="font-size:20px;"></i>
                <span>Tambah</span>
                <input type="file" name="galeri_foto[]"
                       accept="image/webp,image/jpeg,image/png,image/jpg"
                       multiple id="galeri-file-input"
                       onchange="handleGaleriPick(this)">
            </div>
        </div>
        <div class="galeri-note">
            Format: WebP, JPG, PNG. Maks 10MB per foto.
        </div>
        @error('galeri_foto.*')
            <div style="font-size:11px;color:#ef4444;margin-top:3px;">{{ $message }}</div>
        @enderror
    </div>
</div>

            {{-- fasilitas --}}
            <div class="section-accordion">
                <div class="section-accordion-header" onclick="toggleAccordion(this)">
                    <span class="section-accordion-title">Fasilitas Unit</span>
                    <i class="bi bi-chevron-right accordion-chevron"></i>
                </div>
                <div class="section-accordion-body">
                    <div id="rows_fasilitas">
                        @if(old('fasilitas'))
                            @foreach(old('fasilitas') as $i => $fas)
                            <div class="fasilitas-row">
                                <div class="fasilitas-num">{{ $i + 1 }}</div>
                                <input class="field-input" type="text" name="fasilitas[]" value="{{ $fas }}" placeholder="Nama fasilitas...">
                                <button type="button" class="btn-remove-row" onclick="removeFasilitas(this)"><i class="bi bi-x"></i></button>
                            </div>
                            @endforeach
                        @else
                            @foreach(['Entrance', 'Bathroom', 'Kitchen'] as $i => $placeholder)
                            <div class="fasilitas-row">
                                <div class="fasilitas-num">{{ $i + 1 }}</div>
                                <input class="field-input" type="text" name="fasilitas[]" placeholder="{{ $placeholder }}" oninput="schedulePreview()">
                                <button type="button" class="btn-remove-row" onclick="removeFasilitas(this)"><i class="bi bi-x"></i></button>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn-add-row mt-1" onclick="addFasilitas()">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Fasilitas
                    </button>
                </div>
            </div>

            </div>

            <div class="submit-bar">
                <button type="submit" class="btn btn-success btn-sm px-4 py-2 fw-bold">
                    <i class="bi bi-floppy me-1"></i> Simpan Unit
                </button>
                <a href="{{ route('admin.unit.index') }}"
                   class="btn btn-light btn-sm border px-3">Batal</a>
            </div>
        </form>
    </div>

    {{-- panel kanan, preview --}}
    <div class="edit-preview-panel">

        <div class="preview-panel-header">
            <span style="font-size:11px; font-weight:700; color:#6b7280; letter-spacing:.5px; text-transform:uppercase;">
                Preview Halaman Unit
            </span>
            <div class="ms-auto d-flex align-items-center gap-2">
                <span id="preview-syncing" style="display:none; align-items:center; gap:5px; font-size:11px; color:#f59e0b; font-weight:600;">
                    <span class="spinner-border spinner-border-sm" style="width:10px;height:10px;border-width:2px;"></span>
                    Menyinkronkan...
                </span>
                <span id="preview-synced" style="display:none; align-items:center; gap:5px; font-size:11px; color:#10b981; font-weight:600;">
                    <i class="bi bi-check-circle-fill"></i> Tersinkron
                </span>
                <span style="font-size:11px; color:#9ca3af;">Unit baru tampil setelah disimpan</span>
                <a href="{{ route('user.tipeunit') }}" target="_blank"
                   class="btn btn-sm btn-light border"
                   style="font-size:11px; padding:3px 10px;">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Buka
                </a>
            </div>
        </div>

        <div class="preview-iframe-wrap">
            <div id="previewPlaceholder" style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;background:#f8fafc;z-index:4;">
                <i class="bi bi-eye" style="font-size:36px;color:#d1d5db;"></i>
                <p style="font-size:12px;color:#9ca3af;text-align:center;max-width:200px;line-height:1.5;">Preview akan muncul setelah kamu mulai mengisi form</p>
            </div>
            <div class="iframe-loading" id="iframeLoading" style="display:none;">
                <div class="spinner-border spinner-border-sm text-secondary" role="status"></div>
                <span style="font-size:12px; color:#9ca3af;">Memuat preview...</span>
            </div>
            <iframe id="previewIframe"
                    src="about:blank">
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
    document.getElementById('iframeLoading').style.display = 'none';
    const iframe = document.getElementById('previewIframe');
    setTimeout(() => {
        if (iframe?.contentWindow && Object.keys(previewImgState).length > 0) {
            Object.values(previewImgState).forEach(msg => {
                iframe.contentWindow.postMessage(msg, '*');
            });
        }
    }, 500);
}

function reloadIframe() {
    const iframe      = document.getElementById('previewIframe');
    const loading     = document.getElementById('iframeLoading');
    const placeholder = document.getElementById('previewPlaceholder');
    if (placeholder) placeholder.style.display = 'none';
    loading.style.display = 'flex';
    iframe.src = '{{ route("user.tipeunit") }}?_preview=1&_t=' + Date.now();
}

function sendPreview() {
    const formData = new FormData(document.getElementById('mainForm'));

    const newFormData = new FormData();
    for (const [key, val] of formData.entries()) {
        if (key !== 'fasilitas[]' && key !== 'galeri_foto[]') newFormData.append(key, val);
    }
    document.querySelectorAll('#rows_fasilitas input[type="text"]').forEach(input => {
        if (input.value.trim()) newFormData.append('fasilitas[]', input.value.trim());
    });
    Array.from(galeriFiles.files).forEach(file => {
        newFormData.append('galeri_foto[]', file);
    });

    fetch(PREVIEW_URL, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
        body: newFormData,
    })
    .then(r => r.json())
    .then(data => {
        if (data.ok) { reloadIframe(); showSynced(); hasPendingSave = false; }
    })
    .catch(() => hideSyncStatus());
}

// live preview
let previewTimer   = null;
let hasPendingSave = false;
const PREVIEW_URL  = '{{ route("admin.unit-page.preview") }}';
const CSRF_TOKEN   = '{{ csrf_token() }}';

function schedulePreview() {
    hasPendingSave = true;
    showSyncing();
    clearTimeout(previewTimer);
    previewTimer = setTimeout(sendPreview, 600);
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

const previewImgState = {}; 

function handleSingleUpload(input, thumbId) {
    if (!input.files?.[0]) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        const src = e.target.result;

        const el = document.getElementById(thumbId);
        if (el) {
            if (el.tagName === 'IMG') { el.src = src; }
            else {
                const img = document.createElement('img');
                img.id = thumbId; img.src = src;
                img.style.cssText = 'width:100%;height:100px;object-fit:cover;display:block;';
                el.replaceWith(img);
            }
        }
        const key = thumbId === 'thumb_foto_card' ? 'foto_card' : 'foto_3d';
        const removeBtn = document.getElementById('remove_' + key);
        if (removeBtn) removeBtn.style.display = 'flex';

        if (thumbId === 'thumb_foto_card') {
            previewImgState['card'] = { type:'PREVIEW_IMG', key:'dummy', src, target:'card' };
        } else if (thumbId === 'thumb_foto_3d') {
            previewImgState['denah'] = { type:'PREVIEW_IMG', key:'dummy', src, target:'denah' };
        }

        schedulePreview();
    };
    reader.readAsDataURL(input.files[0]);
}

function removeSingleFoto(key) {
    const input = document.getElementById('input_' + key);
    if (input) { input.value = ''; }
    const thumbId = 'thumb_' + key;
    const existing = document.getElementById(thumbId);
    const isCard = key === 'foto_card';

    if (existing) {
        const placeholder = document.createElement('div');
        placeholder.className = 'foto-placeholder';
        placeholder.id = thumbId;
        placeholder.innerHTML = isCard
            ? '<i class="bi bi-image" style="font-size:22px;"></i><span>Klik untuk upload foto card</span>'
            : '<i class="bi bi-grid-3x3" style="font-size:22px;"></i><span>Klik untuk upload foto denah</span>';
        existing.replaceWith(placeholder);
    }
    const removeBtn = document.getElementById('remove_' + key);
    if (removeBtn) removeBtn.style.display = 'none';
    if (key === 'foto_card') delete previewImgState['card'];
    if (key === 'foto_3d')   delete previewImgState['denah'];

    schedulePreview();
}

// galeri
let galeriFiles = new DataTransfer();
const MAX_GALERI = 10;

function updateGaleriCount() {
    document.getElementById('galeri-count').textContent = galeriFiles.items.length;
    const slot = document.getElementById('galeri-add-slot');
    if (slot) slot.style.display = galeriFiles.items.length >= MAX_GALERI ? 'none' : '';
}

function syncGaleriInput() {
    const input = document.getElementById('galeri-file-input');
    if (input) input.files = galeriFiles.files;
}

function renderGaleri() {
    const grid = document.getElementById('galeri-grid');
    const slot = document.getElementById('galeri-add-slot');
    grid.querySelectorAll('.galeri-item').forEach(el => el.remove());

    Array.from(galeriFiles.files).forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'galeri-item';
            div.dataset.idx = idx;
            div.innerHTML = `
                <img src="${e.target.result}" alt="">
                <button type="button" class="btn-remove-galeri"
                        onclick="removeGaleriItem(${idx})" title="Batalkan">×</button>`;
            grid.insertBefore(div, slot);
        };
        reader.readAsDataURL(file);
    });

    updateGaleriCount();
    syncGaleriInput();
}

function handleGaleriPick(input) {
    if (!input.files?.length) return;
    const sisa = MAX_GALERI - galeriFiles.items.length;
    if (sisa <= 0) { alert('Maksimal ' + MAX_GALERI + ' foto galeri.'); input.value = ''; return; }

    Array.from(input.files).slice(0, sisa).forEach(f => galeriFiles.items.add(f));
    input.value = '';  

    renderGaleri();
    schedulePreview();
}

function removeGaleriItem(idx) {
    const newDT = new DataTransfer();
    Array.from(galeriFiles.files).forEach((f, i) => {
        if (i !== idx) newDT.items.add(f);
    });
    galeriFiles = newDT;
    renderGaleri();
    schedulePreview();
}

// fasilitas
function addFasilitas() {
    const container = document.getElementById('rows_fasilitas');
    const count     = container.querySelectorAll('.fasilitas-row').length + 1;
    const row       = document.createElement('div');
    row.className   = 'fasilitas-row';
    row.innerHTML   = `
        <div class="fasilitas-num">${count}</div>
        <input class="field-input" type="text" name="fasilitas[]"
               placeholder="Nama fasilitas..." oninput="schedulePreview()">
        <button type="button" class="btn-remove-row" onclick="removeFasilitas(this)">
            <i class="bi bi-x"></i>
        </button>`;
    container.appendChild(row);
    schedulePreview();
}
function removeFasilitas(btn) {
    const container = document.getElementById('rows_fasilitas');
    if (container.querySelectorAll('.fasilitas-row').length <= 1) return;
    btn.closest('.fasilitas-row').remove();
    container.querySelectorAll('.fasilitas-num').forEach((el, i) => { el.textContent = i + 1; });
    schedulePreview();
}

document.getElementById('mainForm').addEventListener('submit', () => { hasPendingSave = false; });
window.addEventListener('beforeunload', (e) => { if (hasPendingSave) { e.preventDefault(); e.returnValue = ''; } });
document.getElementById('previewIframe').addEventListener('load', iframeLoaded);
</script>
@endpush