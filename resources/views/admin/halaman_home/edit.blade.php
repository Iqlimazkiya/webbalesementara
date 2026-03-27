@extends('layouts.admin.main')

@section('title', 'Edit Halaman Utama')

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
    box-sizing: border-box;
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
.foto-upload-hero img { width: 100%; height: 140px; object-fit: cover; display: block; }
.foto-upload-hero .foto-placeholder {
    height: 140px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 4px; color: #9ca3af; font-size: 11px;
}
.foto-upload-hero input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
.foto-hint { font-size: 11px; color: #9ca3af; margin-top: 6px; }

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
    display: block;
}
.btn-add-row:hover { border-color: #335A40; background: #f0fdf4; }

.akses-row {
    display: flex;
    gap: 6px;
    align-items: center;
    margin-bottom: 6px;
}
.sosmed-row {
    display: flex;
    gap: 6px;
    align-items: center;
    margin-bottom: 6px;
}
.sosmed-icon-preview {
    width: 32px; height: 32px;
    background: #335A40; color: #fff;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.fas-item-card {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 10px;
    background: #fff;
}
.fas-item-header {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    cursor: default;
}
.fas-item-badge {
    width: 20px; height: 20px;
    background: #335A40; color: #fff;
    border-radius: 50%; font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.fas-item-title-preview {
    font-size: 12px; font-weight: 600; color: #374151;
    flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.fas-item-body { padding: 12px; }
.fas-foto-slot {
    border: 1px dashed #d1d5db;
    border-radius: 8px;
    background: #f8fafc;
    cursor: pointer;
    transition: border-color .2s;
    overflow: hidden;
}
.fas-foto-slot:hover { border-color: #335A40; }
.fas-foto-placeholder {
    height: 80px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 4px; color: #9ca3af; font-size: 11px;
}

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

@media (max-width: 768px) {
    .edit-layout { grid-template-columns: 1fr; height: auto; overflow: visible; }
    .edit-form-panel { height: auto; overflow-y: visible; border-right: none; border-bottom: 2px solid #e5e7eb; }
    .edit-preview-panel { height: 500px; }
}
</style>
@endpush

@section('content')
<div class="edit-layout">

    {{-- form sebelah kiri --}}
    <div class="edit-form-panel">

        <div class="form-panel-header">
            <a href="{{ route('admin.home.index') }}"
               class="btn btn-sm btn-light border" style="padding:5px 10px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <div style="font-size:13px; font-weight:700; color:#1f2937;">Edit Halaman Utama</div>
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
              action="{{ route('admin.home.update') }}"
              method="POST"
              enctype="multipart/form-data"
              style="display:flex; flex-direction:column; flex:1; min-height:0;">

            @csrf
            @method('PUT')

            <div class="form-scroll-area">

                {{-- section hero --}}
                <div class="section-accordion">
                    <div class="section-accordion-header" onclick="toggleAccordion(this)">
                        <span class="section-accordion-title">Hero Section</span>
                        <i class="bi bi-chevron-right accordion-chevron"></i>
                    </div>
                    <div class="section-accordion-body">

                        <div class="field-group">
                            <div class="field-label">Video / Foto Hero</div>
                            <div class="foto-upload-hero" id="video-upload-area" style="position:relative;">
    @if(!empty($hp->hero_video))
        @php $heroIsImg = preg_match('/\.(jpg|jpeg|png|webp)$/i', $hp->hero_video); @endphp
        @if($heroIsImg)
            <img id="prev_hero_image" src="{{ asset('storage/' . $hp->hero_video) }}"
                 style="width:100%;height:140px;object-fit:cover;display:block;" alt="Hero">
        @else
            <video id="prev_hero_video"
                   style="width:100%;height:140px;object-fit:cover;display:block;"
                   src="{{ asset('storage/' . $hp->hero_video) }}"
                   muted autoplay loop playsinline></video>
        @endif
        <button type="button" id="btn-clear-hero"
                onclick="clearHeroMedia()"
                style="position:absolute;top:6px;right:6px;z-index:10;width:22px;height:22px;border-radius:50%;background:rgba(239,68,68,0.9);color:#fff;border:none;font-size:13px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;">
            ×
        </button>
    @else
        <div class="foto-placeholder" id="prev_hero_video_placeholder"
             onclick="document.getElementById('inp_hero_video').click()"
             style="cursor:pointer;">
            <i class="bi bi-camera-video" style="font-size:22px;"></i>
            <span>Klik untuk upload video / foto hero</span>
        </div>
        <button type="button" id="btn-clear-hero"
                onclick="clearHeroMedia()"
                style="position:absolute;top:6px;right:6px;z-index:10;width:22px;height:22px;border-radius:50%;background:rgba(239,68,68,0.9);color:#fff;border:none;font-size:13px;line-height:1;cursor:pointer;display:none;align-items:center;justify-content:center;">
            ×
        </button>
    @endif
    <input type="file" id="inp_hero_video" name="hero_video"
           accept="video/*,image/webp,image/jpeg,image/jpg,image/png" style="display:none;"
           onchange="handleVideoPreview(this)">
    <input type="hidden" name="hero_video_clear" id="hero_video_clear" value="0">
</div>
                            <div class="foto-hint">
                                <span id="video-filename">
                                     @if(!empty($hp->hero_video))
                                        {{ basename($hp->hero_video) }}
                                    @endif
                                </span>
                                <div style="color:red;font-size:11px;margin-top:2px;">
                                    Format MP4, WebM, JPG, PNG, WebP. Video max 50MB, Foto max 10MB.
                                </div>
                            </div>
                        </div>

                        <div class="field-group">
                            <div class="field-label">Baris 1 <span style="font-weight:400;text-transform:none;color:#9ca3af;">(contoh: "Welcome to")</span></div>
                            <input type="text" name="hero_teks_baris1" class="field-input"
                                   value="{{ $hp->hero_teks_baris1 ?? '' }}"
                                   placeholder="Welcome to"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Baris 2 <span style="font-weight:400;text-transform:none;color:#9ca3af;">(contoh: "Bale Hinggil")</span></div>
                            <input type="text" name="hero_teks_baris2" class="field-input"
                                   value="{{ $hp->hero_teks_baris2 ?? '' }}"
                                   placeholder="Bale Hinggil"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Baris 3 <span style="font-weight:400;text-transform:none;color:#9ca3af;">(contoh: "Apartment")</span></div>
                            <input type="text" name="hero_teks_baris3" class="field-input"
                                   value="{{ $hp->hero_teks_baris3 ?? '' }}"
                                   placeholder="Apartment"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Deskripsi</div>
                            <textarea name="hero_subjudul" class="field-input" rows="3"
                                      placeholder="Apartemen 31 lantai yang dirancang dengan konsep..."
                                      oninput="markPending()">{{ $hp->hero_subjudul ?? '' }}</textarea>
                        </div>

                        {{-- CTA 1 --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-cursor me-1" style="color:#335A40;"></i> Tombol Utama (Jelajahi Unit)
                            </div>
                            <div class="field-group" style="margin-bottom:10px;">
                                <div class="field-label">Teks Tombol</div>
                                <input type="text" name="hero_btn1_teks" class="field-input"
                                       value="{{ $hp->hero_btn1_teks ?? 'Jelajahi Unit' }}"
                                       placeholder="Jelajahi Unit"
                                       oninput="markPending()">
                            </div>
                            <div class="field-group" style="margin-bottom:0;">
                                <div class="field-label">Link / URL Tujuan</div>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:12px;">
                                        <i class="bi bi-link-45deg"></i>
                                    </span>
                                    <input type="text" name="hero_btn1_link" class="field-input"
                                           style="padding-left:28px;"
                                           value="{{ $hp->hero_btn1_link ?? '' }}"
                                           placeholder="/tipe-unit  atau  https://..."
                                           oninput="markPending()">
                                </div>
                                <div class="foto-hint">Bisa relative (/tipe-unit) atau URL lengkap.</div>
                            </div>
                        </div>

                        {{-- CTA --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-telephone me-1" style="color:#335A40;"></i> Tombol CTA (Hubungi Kami)
                            </div>
                            <div class="field-group" style="margin-bottom:10px;">
                                <div class="field-label">Teks Tombol</div>
                                <input type="text" name="hero_btn2_teks" class="field-input"
                                       value="{{ $hp->hero_btn2_teks ?? 'Hubungi Kami' }}"
                                       placeholder="Hubungi Kami"
                                       oninput="markPending()">
                            </div>
                            <div class="field-group" style="margin-bottom:0;">
                                <div class="field-label">Nomor WhatsApp / Telepon</div>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:12px;">
                                        <i class="bi bi-whatsapp"></i>
                                    </span>
                                    <input type="text" name="hero_btn2_nomor" class="field-input"
                                           style="padding-left:28px;"
                                           value="{{ $hp->hero_btn2_nomor ?? '' }}"
                                           placeholder="628xxxxxxxxxx"
                                           oninput="markPending()">
                                </div>
                                <div class="foto-hint">Format internasional tanpa + (misal: 6281234567890). Otomatis diarahkan ke WhatsApp.</div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- section tentang kami --}}
                <div class="section-accordion">
                    <div class="section-accordion-header" onclick="toggleAccordion(this)">
                        <span class="section-accordion-title">About</span>
                        <i class="bi bi-chevron-right accordion-chevron"></i>
                    </div>
                    <div class="section-accordion-body">

                        {{-- foto tentang kami --}}
                        <div class="field-group">
                            <div class="field-label">Foto About</div>
                            <div class="foto-upload-hero">
                                @if(!empty($hp->about_foto))
                                    <img id="prev_about_foto"
                                         src="{{ asset('storage/' . $hp->about_foto) }}"
                                         style="width:100%;height:140px;object-fit:cover;display:block;" alt="About">
                                @else
                                    <div class="foto-placeholder" id="prev_about_foto_placeholder">
                                        <i class="bi bi-image" style="font-size:22px;"></i>
                                        <span>Klik untuk upload foto</span>
                                    </div>
                                @endif
                                <input type="file" id="inp_about_foto" name="about_foto" accept="image/*"
                                       onchange="handleImgPreview(this, 'prev_about_foto', 'prev_about_foto_placeholder')">
                            </div>
                            <div class="foto-hint">Foto/gambar yang tampil di bagian About halaman utama.</div>
                                <div style="color:red;font-size:11px;margin-top:2px;">Format JPG, PNG, WebP. Maks 10MB.</div>
                        </div>

                        {{-- review --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-star-fill me-1" style="color:#f59e0b;"></i> Google Review
                            </div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                                <div class="field-group" style="margin-bottom:0;">
                                    <div class="field-label">Rating <span style="font-weight:400;text-transform:none;">(contoh: 3,6)</span></div>
                                    <input type="text" name="about_review_rating" class="field-input"
                                           value="{{ $hp->about_review_rating ?? '' }}"
                                           placeholder="3,6"
                                           oninput="markPending()">
                                </div>
                                <div class="field-group" style="margin-bottom:0;">
                                    <div class="field-label">Jumlah Review</div>
                                    <input type="text" name="about_review_jumlah" class="field-input"
                                           value="{{ $hp->about_review_jumlah ?? '' }}"
                                           placeholder="383 Reviews on Google"
                                           oninput="markPending()">
                                </div>
                            </div>
                            <div class="field-group" style="margin-bottom:0;">
                                <div class="field-label">Link Tombol "More Review"</div>
                                <div style="position:relative;">
                                    <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:12px;">
                                        <i class="bi bi-link-45deg"></i>
                                    </span>
                                    <input type="text" name="about_review_link" class="field-input"
                                           style="padding-left:28px;"
                                           value="{{ $hp->about_review_link ?? '' }}"
                                           placeholder="https://g.page/r/..."
                                           oninput="markPending()">
                                </div>
                                <div class="foto-hint">URL Google Maps / Google Review halaman ini.</div>
                            </div>
                        </div>

                        <div class="field-group">
                            <div class="field-label">Judul <span style="font-weight:400;text-transform:none;color:#9ca3af;">(contoh: "Who Are We?")</span></div>
                            <input type="text" name="about_judul" class="field-input"
                                   value="{{ $hp->about_judul ?? '' }}"
                                   placeholder="Who Are We?"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Deskripsi</div>
                            <textarea name="about_deskripsi" class="field-input" rows="4"
                                      placeholder="PT Tlatah Gema Anugrah merupakan..."
                                      oninput="markPending()">{{ $hp->about_deskripsi ?? '' }}</textarea>
                        </div>

                        {{-- visi --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-eye me-1" style="color:#335A40;"></i> Visi
                            </div>
                            <div class="field-group" style="margin-bottom:10px;">
                                <div class="field-label">Judul Visi</div>
                                <input type="text" name="about_visi_judul" class="field-input"
                                       value="{{ $hp->about_visi_judul ?? '' }}"
                                       placeholder="Visi Kami"
                                       oninput="markPending()">
                            </div>
                            <div class="field-group" style="margin-bottom:0;">
                                <div class="field-label">Isi Visi</div>
                                <textarea name="about_visi_isi" class="field-input" rows="3"
                                          placeholder="Menjadi perusahaan properti terkemuka..."
                                          oninput="markPending()">{{ $hp->about_visi_isi ?? '' }}</textarea>
                            </div>
                        </div>

                        {{-- misi --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:4px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-list-check me-1" style="color:#335A40;"></i> Misi
                            </div>
                            <div class="field-group" style="margin-bottom:10px;">
                                <div class="field-label">Judul Misi</div>
                                <input type="text" name="about_misi_judul" class="field-input"
                                       value="{{ $hp->about_misi_judul ?? '' }}"
                                       placeholder="Misi Kami"
                                       oninput="markPending()">
                            </div>
                            <div id="misi-list">
                                @php $misiArr = is_array($hp->about_misi_items) ? $hp->about_misi_items : json_decode($hp->about_misi_items ?? '[]', true); @endphp
                                @if(!empty($misiArr))
                                    @foreach($misiArr as $i => $misi)
                                    <div class="fasilitas-row" id="misi-row-{{ $i }}">
                                        <div class="fasilitas-num">{{ $i + 1 }}</div>
                                        <input type="text" name="about_misi_items[]" class="field-input"
                                               value="{{ $misi }}"
                                               placeholder="Poin misi..."
                                               oninput="markPending()">
                                        <button type="button" class="btn-remove-row"
                                                onclick="removeMisiRow(this)" title="Hapus">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="fasilitas-row" id="misi-row-0">
                                        <div class="fasilitas-num">1</div>
                                        <input type="text" name="about_misi_items[]" class="field-input"
                                               placeholder="Poin misi..."
                                               oninput="markPending()">
                                        <button type="button" class="btn-remove-row"
                                                onclick="removeMisiRow(this)" title="Hapus">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn-add-row mt-2" onclick="addMisiRow()">
                                <i class="bi bi-plus me-1"></i> Tambah Poin Misi
                            </button>
                        </div>

                    </div>
                </div>

                {{-- fasilitas --}}
                <div class="section-accordion">
                    <div class="section-accordion-header" onclick="toggleAccordion(this)">
                        <span class="section-accordion-title">Fasilitas</span>
                        <i class="bi bi-chevron-right accordion-chevron"></i>
                    </div>
                    <div class="section-accordion-body">

                        <div class="field-group">
                            <div class="field-label">Tag Label <span style="font-weight:400;text-transform:none;color:#9ca3af;">(contoh: "FASILITAS")</span></div>
                            <input type="text" name="fasilitas_tag" class="field-input"
                                   value="{{ $hp->fasilitas_tag ?? '' }}"
                                   placeholder="FASILITAS"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Judul Baris 1</div>
                            <input type="text" name="fasilitas_judul1" class="field-input"
                                   value="{{ $hp->fasilitas_judul1 ?? '' }}"
                                   placeholder="Hidup Lebih dari"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Judul Baris 2 <span style="font-weight:400;text-transform:none;color:#9ca3af;">(italic/emas)</span></div>
                            <input type="text" name="fasilitas_judul2" class="field-input"
                                   value="{{ $hp->fasilitas_judul2 ?? '' }}"
                                   placeholder="Sekadar Hunian"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Deskripsi</div>
                            <textarea name="fasilitas_deskripsi" class="field-input" rows="3"
                                      placeholder="Fasilitas yang tersedia dirancang untuk..."
                                      oninput="markPending()">{{ $hp->fasilitas_deskripsi ?? '' }}</textarea>
                        </div>

                        <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px;padding-top:4px;">
                            <i class="bi bi-grid me-1" style="color:#335A40;"></i> Item Fasilitas (Foto + Judul + Keterangan)
                        </div>
                        <div style="font-size:11px;color:#9ca3af;margin-bottom:12px;">
                            Layout: item pertama tampil besar (kiri), item selanjutnya tampil kecil bertumpuk (kanan).
                        </div>

                        <div id="fasilitas-list">
                            @php
                                $fasItems = [];
                                if (!empty($hp->fasilitas_items)) {
                                    $fasItems = is_array($hp->fasilitas_items)
                                        ? $hp->fasilitas_items
                                        : json_decode($hp->fasilitas_items ?? '[]', true);
                                }
                                if (empty($fasItems)) {
                                    $fasItems = [
                                        ['judul' => 'Swimming Pool', 'keterangan' => 'Kolam renang modern untuk relaksasi dan olahraga penghuni.', 'foto' => ''],
                                        ['judul' => 'Gym',           'keterangan' => 'Fasilitas gym lengkap untuk menunjang gaya hidup sehat Anda.', 'foto' => ''],
                                        ['judul' => 'Playground',    'keterangan' => 'Area bermain anak yang aman dan nyaman untuk aktivitas keluarga.', 'foto' => ''],
                                    ];
                                }
                            @endphp

                            @foreach($fasItems as $fi => $fas)
                            <div class="fas-item-card" id="fas-card-{{ $fi }}" data-index="{{ $fi }}">
                                <div class="fas-item-header">
                                    <span class="fas-item-badge">{{ $fi + 1 }}</span>
                                    <span class="fas-item-title-preview">{{ $fas['judul'] ?? 'Item '.($fi+1) }}</span>
                                    @if($fi === 0)
                                        <span style="font-size:10px;color:#f59e0b;font-weight:600;margin-left:4px;">★ Utama</span>
                                    @endif
                                    <button type="button" class="btn-remove-row ms-auto"
                                            onclick="removeFasItem(this)" title="Hapus item">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                                <div class="fas-item-body">
                                    
                                    <div class="field-group">
                                        <div class="field-label">Foto</div>
                                        <div class="fas-foto-slot" onclick="this.querySelector('input[type=file]').click()">
                                            @if(!empty($fas['foto']))
                                                <img src="{{ asset('storage/' . $fas['foto']) }}"
                                                     style="width:100%;height:80px;object-fit:cover;display:block;border-radius:6px;" alt="">
                                            @else
                                                <div class="fas-foto-placeholder">
                                                    <i class="bi bi-image" style="font-size:16px;"></i>
                                                    <span>Upload foto</span>
                                                </div>
                                            @endif
                                            <input type="file" name="fasilitas_foto[]" accept="image/*"
                                                   onchange="handleFasFoto(this)" style="display:none;">
                                            <input type="hidden" name="fasilitas_foto_existing[]"
                                                   value="{{ $fas['foto'] ?? '' }}">
                                        </div>
                                        <div style="color:red;font-size:10px;margin-top:3px;">Format JPG, PNG, WebP. Maks 10MB.</div>
                                    </div>
                                    
                                    <div class="field-group">
                                        <div class="field-label">Judul Fasilitas</div>
                                        <input type="text" name="fasilitas_judul[]" class="field-input"
                                               value="{{ $fas['judul'] ?? '' }}"
                                               placeholder="Swimming Pool"
                                               oninput="updateFasTitle(this); markPending()">
                                    </div>
                                    <div class="field-group" style="margin-bottom:0;">
                                        <div class="field-label">Keterangan</div>
                                        <textarea name="fasilitas_keterangan[]" class="field-input" rows="2"
                                                  placeholder="Deskripsi singkat fasilitas..."
                                                  oninput="markPending()">{{ $fas['keterangan'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn-add-row mt-2" onclick="addFasItem()">
                            <i class="bi bi-plus me-1"></i> Tambah Item Fasilitas
                        </button>

                    </div>
                </div>

                {{-- lokasi --}}
                <div class="section-accordion">
                    <div class="section-accordion-header" onclick="toggleAccordion(this)">
                        <span class="section-accordion-title">Lokasi</span>
                        <i class="bi bi-chevron-right accordion-chevron"></i>
                    </div>
                    <div class="section-accordion-body">

                        <div class="field-group">
                            <div class="field-label">Tag Label <span style="font-weight:400;text-transform:none;color:#9ca3af;">(contoh: "LOKASI")</span></div>
                            <input type="text" name="lokasi_tag" class="field-input"
                                   value="{{ $hp->lokasi_tag ?? '' }}"
                                   placeholder="LOKASI"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Judul Baris 1 <span style="font-weight:400;text-transform:none;color:#9ca3af;">(hitam)</span></div>
                            <input type="text" name="lokasi_judul1" class="field-input"
                                   value="{{ $hp->lokasi_judul1 ?? '' }}"
                                   placeholder="Strategis di Jantung"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Judul Baris 2 <span style="font-weight:400;text-transform:none;color:#9ca3af;">(italic/emas)</span></div>
                            <input type="text" name="lokasi_judul2" class="field-input"
                                   value="{{ $hp->lokasi_judul2 ?? '' }}"
                                   placeholder="Surabaya Timur"
                                   oninput="markPending()">
                        </div>

                        {{-- gmaps --}}
                        <div class="field-group">
                            <div class="field-label">Link Embed Google Maps</div>
                            <textarea name="lokasi_gmaps_embed" class="field-input" rows="3"
                                      placeholder='&lt;iframe src="https://www.google.com/maps/embed?pb=..." ...&gt;&lt;/iframe&gt;'
                                      oninput="markPending()">{{ $hp->lokasi_gmaps_embed ?? '' }}</textarea>
                            <div class="foto-hint">
                                Buka Google Maps → Share → Embed a map → salin seluruh kode &lt;iframe&gt;.
                            </div>
                        </div>

                        {{-- card alamat --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-geo-alt me-1" style="color:#335A40;"></i> Kartu Alamat
                            </div>
                            <div class="field-group" style="margin-bottom:10px;">
                                <div class="field-label">Nama Gedung / Properti</div>
                                <input type="text" name="lokasi_nama_gedung" class="field-input"
                                       value="{{ $hp->lokasi_nama_gedung ?? '' }}"
                                       placeholder="Apartement Bale Hinggil"
                                       oninput="markPending()">
                            </div>
                            <div class="field-group" style="margin-bottom:0;">
                                <div class="field-label">Alamat Lengkap</div>
                                <textarea name="lokasi_alamat_lengkap" class="field-input" rows="2"
                                          placeholder="Jl. Dr. Ir. H. Soekarno Jl. Medokan Semampir Indah No.63..."
                                          oninput="markPending()">{{ $hp->lokasi_alamat_lengkap ?? '' }}</textarea>
                            </div>
                        </div>

                        {{-- akses terdekat --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:4px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-signpost-2 me-1" style="color:#335A40;"></i> Akses Terdekat
                            </div>
                            <div style="font-size:11px;color:#9ca3af;margin-bottom:10px;">
                                Setiap baris: nama tempat dan estimasi waktu tempuh.
                            </div>
                            <div id="akses-list">
                                @php
                                    $aksesList = [];
                                    if (!empty($hp->lokasi_akses_items)) {
                                        $aksesList = is_array($hp->lokasi_akses_items) ? $hp->lokasi_akses_items : json_decode($hp->lokasi_akses_items ?? '[]', true);
                                    }
                                    if (empty($aksesList)) {
                                        $aksesList = [
                                            ['nama' => 'Galaxy Mall 3',                    'waktu' => '± 5 menit'],
                                            ['nama' => 'RS. Gotong Royong',                'waktu' => '± 8 menit'],
                                            ['nama' => 'Institut Teknologi Sepuluh November','waktu' => '± 8 menit'],
                                            ['nama' => 'Universitas Airlangga',            'waktu' => '± 12 menit'],
                                            ['nama' => 'Juanda Int. Airport',              'waktu' => '± 25 menit'],
                                        ];
                                    }
                                @endphp

                                @foreach($aksesList as $ai => $akses)
                                <div class="akses-row" id="akses-row-{{ $ai }}">
                                    <div class="fasilitas-num">{{ $ai + 1 }}</div>
                                    <input type="text" name="akses_nama[]" class="field-input"
                                           value="{{ $akses['nama'] ?? '' }}"
                                           placeholder="Nama tempat..."
                                           style="flex:1;"
                                           oninput="markPending()">
                                    <input type="text" name="akses_waktu[]" class="field-input"
                                           value="{{ $akses['waktu'] ?? '' }}"
                                           placeholder="± 5 menit"
                                           style="width:90px;flex-shrink:0;"
                                           oninput="markPending()">
                                    <button type="button" class="btn-remove-row"
                                            onclick="removeAksesRow(this)" title="Hapus">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn-add-row mt-2" onclick="addAksesRow()">
                                <i class="bi bi-plus me-1"></i> Tambah Akses
                            </button>
                        </div>

                    </div>
                </div>

                {{-- layanan --}}
                <div class="section-accordion">
                    <div class="section-accordion-header" onclick="toggleAccordion(this)">
                        <span class="section-accordion-title">Layanan</span>
                        <i class="bi bi-chevron-right accordion-chevron"></i>
                    </div>
                    <div class="section-accordion-body">

                        <div class="field-group">
                            <div class="field-label">Tag Label <span style="font-weight:400;text-transform:none;color:#9ca3af;">(contoh: "OUR SERVICES")</span></div>
                            <input type="text" name="layanan_tag" class="field-input"
                                   value="{{ $hp->layanan_tag ?? '' }}"
                                   placeholder="OUR SERVICES"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Judul</div>
                            <input type="text" name="layanan_judul" class="field-input"
                                   value="{{ $hp->layanan_judul ?? '' }}"
                                   placeholder="Layanan"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Deskripsi</div>
                            <textarea name="layanan_deskripsi" class="field-input" rows="3"
                                      placeholder="Menghadirkan layanan eksklusif yang mendukung gaya hidup modern Anda..."
                                      oninput="markPending()">{{ $hp->layanan_deskripsi ?? '' }}</textarea>
                        </div>
                        {{-- foto background layanan --}}
<div class="field-group">
    <div class="field-label">Foto Background Layanan</div>
    <div class="fas-foto-slot" onclick="this.querySelector('input[type=file]').click()">
        @if(!empty($hp->layanan_foto_bg))
            <img src="{{ asset('storage/' . $hp->layanan_foto_bg) }}"
                 style="width:100%;height:80px;object-fit:cover;display:block;border-radius:6px;" alt="">
        @else
            <div class="fas-foto-placeholder">
                <i class="bi bi-image" style="font-size:16px;"></i>
                <span>Upload foto background</span>
            </div>
        @endif
        <input type="file" name="layanan_foto_bg" accept="image/*"
               onchange="handleLayananBg(this)" style="display:none;">
    </div>
    <div class="foto-hint">Foto background section layanan. Default: assets/img/layanan.jpg</div>
<div style="color:red;font-size:11px;margin-top:2px;">Format JPG, PNG, WebP. Maks 10MB.</div>
</div>
                        {{-- button layanan --}}
                        <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:8px;text-transform:uppercase;letter-spacing:.4px;">
                            <i class="bi bi-cursor me-1" style="color:#335A40;"></i> Tombol Layanan
                        </div>
                        <div style="font-size:11px;color:#9ca3af;margin-bottom:10px;">
                            Setiap tombol memiliki nama dan link halaman tujuan.
                        </div>

                        <div id="layanan-btn-list">
                            @php
                                $layananBtns = [];
                                if (!empty($hp->layanan_buttons)) {
                                    $layananBtns = is_array($hp->layanan_buttons) ? $hp->layanan_buttons : json_decode($hp->layanan_buttons ?? '[]', true);
                                }
                                if (empty($layananBtns)) {
                                    $layananBtns = [
                                        ['teks' => 'Working Order', 'link' => ''],
                                        ['teks' => 'Cleaning Order','link' => ''],
                                        ['teks' => 'Design Interior','link' => ''],
                                    ];
                                }
                            @endphp

                            @foreach($layananBtns as $li => $btn)
                            <div class="akses-row layanan-btn-row" id="layanan-btn-{{ $li }}">
                                <div class="fasilitas-num">{{ $li + 1 }}</div>
                                <input type="text" name="layanan_btn_teks[]" class="field-input"
                                       value="{{ $btn['teks'] ?? '' }}"
                                       placeholder="Nama tombol..."
                                       style="flex:1;"
                                       oninput="markPending()">
                                <div style="position:relative;flex:1;">
                                    <span style="position:absolute;left:8px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:11px;">
                                        <i class="bi bi-link-45deg"></i>
                                    </span>
                                    <input type="text" name="layanan_btn_link[]" class="field-input"
                                           value="{{ $btn['link'] ?? '' }}"
                                           placeholder="/layanan atau https://..."
                                           style="padding-left:24px;"
                                           oninput="markPending()">
                                </div>
                                <button type="button" class="btn-remove-row"
                                        onclick="removeLayananBtn(this)" title="Hapus">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn-add-row mt-2" onclick="addLayananBtn()">
                            <i class="bi bi-plus me-1"></i> Tambah Tombol Layanan
                        </button>

                    </div>
                </div>

                {{-- section berita --}}
                <div class="section-accordion">
                    <div class="section-accordion-header" onclick="toggleAccordion(this)">
                        <span class="section-accordion-title">Berita</span>
                        <i class="bi bi-chevron-right accordion-chevron"></i>
                    </div>
                    <div class="section-accordion-body">

                        <div class="field-group">
                            <div class="field-label">Tag Label <span style="font-weight:400;text-transform:none;color:#9ca3af;">(contoh: "BERITA")</span></div>
                            <input type="text" name="berita_tag" class="field-input"
                                   value="{{ $hp->berita_tag ?? '' }}"
                                   placeholder="BERITA"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Judul Baris 1 <span style="font-weight:400;text-transform:none;color:#9ca3af;">(hijau)</span></div>
                            <input type="text" name="berita_judul1" class="field-input"
                                   value="{{ $hp->berita_judul1 ?? '' }}"
                                   placeholder="Update Terkini"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Judul Baris 2 <span style="font-weight:400;text-transform:none;color:#9ca3af;">(italic/emas)</span></div>
                            <input type="text" name="berita_judul2" class="field-input"
                                   value="{{ $hp->berita_judul2 ?? '' }}"
                                   placeholder="Bale Hinggil"
                                   oninput="markPending()">
                        </div>

                        <div class="field-group">
                            <div class="field-label">Link Tombol "Semua Berita"</div>
                            <div style="position:relative;">
                                <span style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:12px;">
                                    <i class="bi bi-link-45deg"></i>
                                </span>
                                <input type="text" name="berita_link_semua" class="field-input"
                                       style="padding-left:28px;"
                                       value="{{ $hp->berita_link_semua ?? '' }}"
                                       placeholder="/berita atau https://..."
                                       oninput="markPending()">
                            </div>
                        </div>

                        {{-- card atas yt --}}
                        <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:12px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-youtube me-1" style="color:#ef4444;"></i> 3 Card Atas — YouTube
                            </div>
                            @for($y = 0; $y < 3; $y++)
                            <div style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;margin-bottom:10px;background:#fff;">
                                
                                <div style="background:#fef2f2;padding:7px 12px;border-bottom:1px solid #fee2e2;display:flex;align-items:center;gap:6px;">
                                    <i class="bi bi-youtube" style="color:#ef4444;font-size:13px;"></i>
                                    <span style="font-size:11px;font-weight:700;color:#991b1b;">Card YouTube {{ $y + 1 }}</span>
                                </div>
                                <div style="padding:12px;">
                                    
                                    <div class="field-group" style="margin-bottom:8px;">
                                        <div class="field-label">URL YouTube</div>
                                        <div style="position:relative;">
                                            <span style="position:absolute;left:8px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:11px;"><i class="bi bi-youtube"></i></span>
                                            <input type="text" name="berita_yt_url[{{ $y }}]" class="field-input"
                                                   style="padding-left:24px;"
                                                   value="{{ $hp->{'berita_yt_url_'.$y} ?? '' }}"
                                                   placeholder="https://youtu.be/xxx atau https://www.youtube.com/watch?v=xxx"
                                                   oninput="markPending()">
                                        </div>
                                    </div>
                                    
                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:8px;">
                                        <div class="field-group" style="margin-bottom:0;">
                                            <div class="field-label">Tanggal Upload</div>
                                            <input type="text" name="berita_yt_tanggal[{{ $y }}]" class="field-input"
                                                   value="{{ $hp->{'berita_yt_tanggal_'.$y} ?? '' }}"
                                                   placeholder="24 Feb 2025"
                                                   oninput="markPending()">
                                        </div>
                                        <div class="field-group" style="margin-bottom:0;">
                                            <div class="field-label">Durasi</div>
                                            <input type="text" name="berita_yt_durasi[{{ $y }}]" class="field-input"
                                                   value="{{ $hp->{'berita_yt_durasi_'.$y} ?? '' }}"
                                                   placeholder="7 menit"
                                                   oninput="markPending()">
                                        </div>
                                    </div>
                                    
                                    <div class="field-group" style="margin-bottom:8px;">
                                        <div class="field-label">Judul Video</div>
                                        <input type="text" name="berita_yt_judul[{{ $y }}]" class="field-input"
                                               value="{{ $hp->{'berita_yt_judul_'.$y} ?? '' }}"
                                               placeholder="Bale Hinggil Apartement"
                                               oninput="markPending()">
                                    </div>
                                    
                                    <div class="field-group" style="margin-bottom:8px;">
                                        <div class="field-label">Deskripsi Singkat</div>
                                        <textarea name="berita_yt_deskripsi[{{ $y }}]" class="field-input" rows="2"
                                                  placeholder="Mencari hunian yang tepat?? Baleh Hinggil Apartment solusinya..."
                                                  oninput="markPending()">{{ $hp->{'berita_yt_deskripsi_'.$y} ?? '' }}</textarea>
                                    </div>
                                    
                                    <div class="field-group" style="margin-bottom:8px;">
                                        <div class="field-label">Nama Channel / Akun</div>
                                        <input type="text" name="berita_yt_channel[{{ $y }}]" class="field-input"
                                               value="{{ $hp->{'berita_yt_channel_'.$y} ?? '' }}"
                                               placeholder="Bale Hinggil Apartement"
                                               oninput="markPending()">
                                    </div>
                                    
                                    <div class="field-group" style="margin-bottom:0;">
                                        <div class="field-label">Link "Tonton →"</div>
                                        <div style="position:relative;">
                                            <span style="position:absolute;left:8px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:11px;"><i class="bi bi-link-45deg"></i></span>
                                            <input type="text" name="berita_yt_link[{{ $y }}]" class="field-input"
                                                   style="padding-left:24px;"
                                                   value="{{ $hp->{'berita_yt_link_'.$y} ?? '' }}"
                                                   placeholder="https://youtu.be/xxx"
                                                   oninput="markPending()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>

                        {{-- card berita bawah --}}
                        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:12px 14px;margin-bottom:4px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:12px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-newspaper me-1" style="color:#335A40;"></i> 3 Card Bawah — Berita / Artikel
                            </div>
                            @for($b = 0; $b < 3; $b++)
                            <div style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;margin-bottom:10px;background:#fff;">
                                
                                <div style="background:#f0fdf4;padding:7px 12px;border-bottom:1px solid #bbf7d0;display:flex;align-items:center;gap:6px;">
                                    <i class="bi bi-newspaper" style="color:#335A40;font-size:12px;"></i>
                                    <span style="font-size:11px;font-weight:700;color:#166534;">Card Berita {{ $b + 1 }}</span>
                                </div>
                                <div style="padding:12px;">
                                    
                                    <div class="field-group" style="margin-bottom:8px;">
                                        <div class="field-label">Foto Thumbnail</div>
                                        <div class="fas-foto-slot" onclick="this.querySelector('input[type=file]').click()">
                                            @if(!empty($hp->{'berita_foto_'.$b}))
                                                <img src="{{ asset('storage/' . $hp->{'berita_foto_'.$b}) }}"
                                                     style="width:100%;height:70px;object-fit:cover;display:block;border-radius:6px;" alt="">
                                            @else
                                                <div class="fas-foto-placeholder">
                                                    <i class="bi bi-image" style="font-size:16px;"></i>
                                                    <span>Upload thumbnail berita</span>
                                                </div>
                                            @endif
                                            <input type="file" name="berita_foto[{{ $b }}]" accept="image/*"
                                                   onchange="handleFasFoto(this)" style="display:none;">
                                        </div>
                                        <div style="color:red;font-size:10px;margin-top:3px;">Format JPG, PNG, WebP. Maks 10MB.</div>
                                    </div>
                                    
                                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:8px;">
                                        <div class="field-group" style="margin-bottom:0;">
                                            <div class="field-label">Tanggal Berita</div>
                                            <input type="text" name="berita_tanggal[{{ $b }}]" class="field-input"
                                                   value="{{ $hp->{'berita_tanggal_'.$b} ?? '' }}"
                                                   placeholder="27 Feb 2025"
                                                   oninput="markPending()">
                                        </div>
                                        <div class="field-group" style="margin-bottom:0;">
                                            <div class="field-label">Jam Upload</div>
                                            <input type="text" name="berita_jam[{{ $b }}]" class="field-input"
                                                   value="{{ $hp->{'berita_jam_'.$b} ?? '' }}"
                                                   placeholder="20.58 WIB"
                                                   oninput="markPending()">
                                        </div>
                                    </div>
                                    
                                    <div class="field-group" style="margin-bottom:8px;">
                                        <div class="field-label">Judul Berita</div>
                                        <input type="text" name="berita_judul_item[{{ $b }}]" class="field-input"
                                               value="{{ $hp->{'berita_judul_item_'.$b} ?? '' }}"
                                               placeholder="Konflik Penghuni dan Pengelola Apartemen..."
                                               oninput="markPending()">
                                    </div>
                                    
                                    <div class="field-group" style="margin-bottom:8px;">
                                        <div class="field-label">Deskripsi / Ringkasan</div>
                                        <textarea name="berita_ringkasan[{{ $b }}]" class="field-input" rows="2"
                                                  placeholder="Konflik antara penghuni dan pengelola Apartemen Bale Hinggil Surabaya akhirnya..."
                                                  oninput="markPending()">{{ $hp->{'berita_ringkasan_'.$b} ?? '' }}</textarea>
                                    </div>
                                    
                                    <div class="field-group" style="margin-bottom:8px;">
                                        <div class="field-label">Penerbit / Penulis</div>
                                        <input type="text" name="berita_penerbit[{{ $b }}]" class="field-input"
                                               value="{{ $hp->{'berita_penerbit_'.$b} ?? '' }}"
                                               placeholder="Bicara Indonesia"
                                               oninput="markPending()">
                                    </div>
                                    
                                    <div class="field-group" style="margin-bottom:0;">
                                        <div class="field-label">Link "Baca →"</div>
                                        <div style="position:relative;">
                                            <span style="position:absolute;left:8px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:11px;"><i class="bi bi-link-45deg"></i></span>
                                            <input type="text" name="berita_link_item[{{ $b }}]" class="field-input"
                                                   style="padding-left:24px;"
                                                   value="{{ $hp->{'berita_link_item_'.$b} ?? '' }}"
                                                   placeholder="https://... atau /berita/slug"
                                                   oninput="markPending()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>

                    </div>
                </div>

                {{-- section kontak --}}
                <div class="section-accordion">
                    <div class="section-accordion-header" onclick="toggleAccordion(this)">
                        <span class="section-accordion-title">Kontak</span>
                        <i class="bi bi-chevron-right accordion-chevron"></i>
                    </div>
                    <div class="section-accordion-body">

                        <div class="field-group">
                            <div class="field-label">Judul Section</div>
                            <input type="text" name="kontak_judul" class="field-input"
                                   value="{{ $hp->kontak_judul ?? '' }}"
                                   placeholder="Informasi Kontak"
                                   oninput="markPending()">
                        </div>

                        {{-- kontak--}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:10px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-telephone me-1" style="color:#335A40;"></i> Info Kontak &amp; Jam Operasional
                            </div>

                            {{-- telepon --}}
                            <div class="field-group" style="margin-bottom:12px;">
                                <div class="field-label">Nomor Telepon</div>
                                <input type="text" name="kontak_telepon" class="field-input"
                                       value="{{ $hp->kontak_telepon ?? '' }}"
                                       placeholder="0823-3446-6773"
                                       oninput="markPending()">
                            </div>

                            <div style="border-top:1px solid #e5e7eb;margin-bottom:12px;"></div>

                            {{-- jam operasional --}}
                            <div style="font-size:11px;font-weight:600;color:#374151;margin-bottom:6px;">
                                <i class="bi bi-clock me-1" style="color:#335A40;"></i> Jam Operasional
                                <span style="font-weight:400;color:#9ca3af;margin-left:4px;">— setiap baris = satu poin</span>
                            </div>
                            <div id="jam-list">
                                @php
                                    $jamList = [];
                                    if (!empty($hp->kontak_jam_items)) {
                                        $jamList = is_array($hp->kontak_jam_items) ? $hp->kontak_jam_items : json_decode($hp->kontak_jam_items ?? '[]', true);
                                    }
                                    if (empty($jamList)) {
                                        $jamList = [
                                            'Senin – Jumat',
                                            '09.00 – 15.00 WIB',
                                            'Sabtu',
                                            '09.00 – 12.00 WIB',
                                        ];
                                    }
                                @endphp
                                @foreach($jamList as $ji => $jam)
                                <div class="akses-row jam-row" id="jam-row-{{ $ji }}">
                                    <div class="fasilitas-num">{{ $ji + 1 }}</div>
                                    <input type="text" name="kontak_jam_items[]" class="field-input"
                                           value="{{ $jam }}"
                                           placeholder="Senin – Jumat  atau  09.00 – 15.00 WIB"
                                           style="flex:1;"
                                           oninput="markPending()">
                                    <button type="button" class="btn-remove-row"
                                            onclick="removeJamRow(this)" title="Hapus">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn-add-row mt-2" onclick="addJamRow()">
                                <i class="bi bi-plus me-1"></i> Tambah Baris Jam
                            </button>
                        </div>

                        {{-- sosial media --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:4px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-share me-1" style="color:#335A40;"></i> Ikuti Kami — Sosial Media
                            </div>
                            <div style="font-size:11px;color:#9ca3af;margin-bottom:10px;">
                                Pilih icon Bootstrap Icons (bi-instagram, bi-tiktok, bi-youtube, bi-facebook, dst.) dan isi link-nya.
                            </div>
                            <div id="sosmed-list">
                                @php
                                    $sosmedList = [];
                                    if (!empty($hp->kontak_sosmed_items)) {
                                        $sosmedList = is_array($hp->kontak_sosmed_items) ? $hp->kontak_sosmed_items : json_decode($hp->kontak_sosmed_items ?? '[]', true);
                                    }
                                    if (empty($sosmedList)) {
                                        $sosmedList = [
                                            ['icon' => 'bi-instagram', 'link' => ''],
                                            ['icon' => 'bi-tiktok',    'link' => ''],
                                            ['icon' => 'bi-youtube',   'link' => ''],
                                        ];
                                    }
                                @endphp
                                @foreach($sosmedList as $si => $sosmed)
                                <div class="sosmed-row" id="sosmed-row-{{ $si }}">
                                    <div class="fasilitas-num">{{ $si + 1 }}</div>
                                    
                                    <div class="sosmed-icon-preview" id="sosmed-icon-prev-{{ $si }}">
                                        <i class="bi {{ $sosmed['icon'] ?? 'bi-link' }}"></i>
                                    </div>
                                    
                                    <input type="text" name="sosmed_icon[]" class="field-input"
                                           value="{{ $sosmed['icon'] ?? '' }}"
                                           placeholder="bi-instagram"
                                           style="width:130px;flex-shrink:0;"
                                           oninput="updateSosmedIcon(this, {{ $si }}); markPending()">
                                    
                                    <div style="position:relative;flex:1;">
                                        <span style="position:absolute;left:8px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:11px;">
                                            <i class="bi bi-link-45deg"></i>
                                        </span>
                                        <input type="text" name="sosmed_link[]" class="field-input"
                                               value="{{ $sosmed['link'] ?? '' }}"
                                               placeholder="https://instagram.com/..."
                                               style="padding-left:24px;"
                                               oninput="markPending()">
                                    </div>
                                    <button type="button" class="btn-remove-row"
                                            onclick="removeSosmedRow(this)" title="Hapus">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn-add-row mt-2" onclick="addSosmedRow()">
                                <i class="bi bi-plus me-1"></i> Tambah Sosial Media
                            </button>
                            <div style="font-size:10px;color:#9ca3af;margin-top:6px;">
                                Referensi icon: <a href="https://icons.getbootstrap.com/" target="_blank" style="color:#335A40;">icons.getbootstrap.com</a>
                                — cari nama icon lalu tulis lengkap (contoh: bi-facebook, bi-twitter-x, bi-linkedin)
                            </div>
                        </div>
                        {{-- divisi tujuan --}}
                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                            <div style="font-size:11px;font-weight:700;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:.4px;">
                                <i class="bi bi-diagram-3 me-1" style="color:#335A40;"></i> Opsi Divisi Tujuan
                            </div>
                            <div style="font-size:11px;color:#9ca3af;margin-bottom:10px;">
                                Daftar pilihan yang muncul di dropdown "Divisi" pada form kontak halaman utama.
                            </div>
                            <div id="divisi-list">
                                @php
                                    $divisiList = [];
                                    if (!empty($hp->kontak_divisi_items)) {
                                        $divisiList = is_array($hp->kontak_divisi_items) ? $hp->kontak_divisi_items : json_decode($hp->kontak_divisi_items ?? '[]', true);
                                    }
                                    if (empty($divisiList)) {
                                        $divisiList = ['Pengelola', 'Developer'];
                                    }
                                @endphp
                                @foreach($divisiList as $di => $divisi)
                                <div class="akses-row divisi-row" id="divisi-row-{{ $di }}">
                                    <div class="fasilitas-num">{{ $di + 1 }}</div>
                                    <input type="text" name="kontak_divisi_items[]" class="field-input"
                                           value="{{ $divisi }}"
                                           placeholder="Nama divisi..."
                                           style="flex:1;"
                                           oninput="markPending()">
                                    <button type="button" class="btn-remove-row"
                                            onclick="removeDivisiRow(this)" title="Hapus">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn-add-row mt-2" onclick="addDivisiRow()">
                                <i class="bi bi-plus me-1"></i> Tambah Opsi Divisi
                            </button>
                        </div>


                    </div>
                </div>

            </div>

            <div class="submit-bar">
                <button type="submit" class="btn btn-success btn-sm px-4 py-2 fw-bold">
                    <i class="bi bi-floppy me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.home.index') }}"
                   class="btn btn-light btn-sm border px-3">Batal</a>
            </div>

        </form>
    </div>

    {{-- live preview di kanan --}}
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
                <a href="{{ route('home') }}" target="_blank"
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
            <iframe id="previewIframe" src="{{ route('home') }}?_preview_page=1" onload="iframeLoaded()"></iframe>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
let previewTimer   = null;
let hasPendingSave = false;
let iframeLoading  = false;

const PREVIEW_URL = '{{ route("admin.home.preview") }}';
const CSRF_TOKEN  = '{{ csrf_token() }}';

function iframeLoaded() {
    iframeLoading = false;
    document.getElementById('iframeLoading')?.classList.add('hidden');
}

let pendingVideoBlobUrl = null;

function toggleAccordion(header) {

    const body    = header.nextElementSibling;
    const chevron = header.querySelector('.accordion-chevron');
    const isOpen  = body.classList.contains('open');

    body.classList.toggle('open', !isOpen);
    chevron.classList.toggle('open', !isOpen);
}
window.addEventListener('message', function(event) {
    if (event.data?.type !== 'IFRAME_READY' || !pendingVideoBlobUrl) return;
    const iframe = document.getElementById('previewIframe');
    if (!iframe) return;
    try {
        iframe.contentWindow?.postMessage(
            { type: 'PREVIEW_VIDEO', src: pendingVideoBlobUrl },
            '*'
        );
    } catch(e) {}
});


function handleImgPreview(input, imgId, placeholderId) {
    if (!input.files?.[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        let img = document.getElementById(imgId);
        if (!img) {
            const ph = document.getElementById(placeholderId);
            if (ph) {
                img = document.createElement('img');
                img.id = imgId;
                img.style.cssText = 'width:100%;height:140px;object-fit:cover;display:block;';
                ph.parentNode.insertBefore(img, ph);
                ph.style.display = 'none';
            }
        } else {
            img.style.display = 'block';
            const ph = document.getElementById(placeholderId);
            if (ph) ph.style.display = 'none';
        }
        if (img) img.src = e.target.result;
        if (imgId === 'prev_about_foto') {
            window._pendingAboutFoto = e.target.result;
        }
    };
    reader.readAsDataURL(input.files[0]);
    schedulePreview();
}


function handleFasFoto(input) {
    if (!input.files?.[0]) return;
    const file = input.files[0];
    if (!file.type.startsWith('image/')) {
        alert('File harus berupa gambar (JPG, PNG, WebP, dll).');
        input.value = '';
        return;
    }
    const slot = input.closest('.fas-foto-slot');
    if (!slot) return;
    const reader = new FileReader();
    reader.onload = e => {
    let img = slot.querySelector('img');
    if (!img) {
        img = document.createElement('img');
        img.style.cssText = 'width:100%;height:80px;object-fit:cover;display:block;border-radius:6px;';
        const ph = slot.querySelector('.fas-foto-placeholder');
        if (ph) { ph.style.display = 'none'; slot.insertBefore(img, ph); }
        else slot.insertBefore(img, input);
    }
    img.src = e.target.result;
    img.style.display = 'block';

    const isBerita = input.name.startsWith('berita_foto[');
    if (isBerita) {
        const match = input.name.match(/\[(\d+)\]/);
        if (match) {
            if (!window._pendingBeritaFotos) window._pendingBeritaFotos = {};
            window._pendingBeritaFotos[parseInt(match[1])] = e.target.result;
        }
    } else {
        const card = slot.closest('.fas-item-card');
        let fasIdx = 0;
        document.querySelectorAll('#fasilitas-list .fas-item-card').forEach((c, i) => {
            if (c === card) fasIdx = i;
        });
        if (!window._pendingFasFotos) window._pendingFasFotos = {};
        window._pendingFasFotos[fasIdx] = e.target.result;
    }

    schedulePreview();
};
    reader.readAsDataURL(file);
}

function handleLayananBg(input) {
    if (!input.files?.[0]) return;
    const file = input.files[0];
    if (!file.type.startsWith('image/')) {
        alert('File harus berupa gambar.');
        input.value = '';
        return;
    }
    const slot = input.closest('.fas-foto-slot');
    const reader = new FileReader();
    reader.onload = e => {
        let img = slot.querySelector('img');
        if (!img) {
            img = document.createElement('img');
            img.style.cssText = 'width:100%;height:80px;object-fit:cover;display:block;border-radius:6px;';
            const ph = slot.querySelector('.fas-foto-placeholder');
            if (ph) { ph.style.display = 'none'; slot.insertBefore(img, ph); }
        }
        img.src = e.target.result;
        img.style.display = 'block';
        window._pendingLayananBg = e.target.result;
        schedulePreview();
    };
    reader.readAsDataURL(file);
}
// misi
let misiCount = document.querySelectorAll('#misi-list .fasilitas-row').length || 1;

function addMisiRow() {
    misiCount++;
    const list = document.getElementById('misi-list');
    const div  = document.createElement('div');
    div.className = 'fasilitas-row';
    div.id = 'misi-row-' + misiCount;
    div.innerHTML = `
        <div class="fasilitas-num">${misiCount}</div>
        <input type="text" name="about_misi_items[]" class="field-input"
               placeholder="Poin misi..." oninput="markPending()">
        <button type="button" class="btn-remove-row" onclick="removeMisiRow(this)" title="Hapus">
            <i class="bi bi-x"></i>
        </button>`;
    list.appendChild(div);
    renumberMisi();
    schedulePreview();
}

function removeMisiRow(btn) {
    const row = btn.closest('.fasilitas-row');
    if (document.querySelectorAll('#misi-list .fasilitas-row').length <= 1) return;
    row.remove();
    renumberMisi();
    schedulePreview();
}

function renumberMisi() {
    document.querySelectorAll('#misi-list .fasilitas-row').forEach((row, i) => {
        const num = row.querySelector('.fasilitas-num');
        if (num) num.textContent = i + 1;
    });
}

function handleVideoPreview(input) {
    if (!input.files?.[0]) return;
    const file = input.files[0];
    const isImage = file.type.startsWith('image/');

    const fnEl = document.getElementById('video-filename');
    if (fnEl) fnEl.textContent = file.name;

    const blobUrl = URL.createObjectURL(file);
    const area = document.getElementById('video-upload-area');
    if (area) {
        let vid = document.getElementById('prev_hero_video');
        let img = document.getElementById('prev_hero_image');
        const ph = document.getElementById('prev_hero_video_placeholder');

        const clearBtn = document.getElementById('btn-clear-hero');
if (clearBtn) clearBtn.style.display = 'flex';
document.getElementById('hero_video_clear').value = '0';

        if (isImage) {
            if (vid) vid.style.display = 'none';
            if (!img) {
                img = document.createElement('img');
                img.id = 'prev_hero_image';
                img.style.cssText = 'width:100%;height:140px;object-fit:cover;display:block;';
                if (ph) ph.parentNode.insertBefore(img, ph);
            }
            if (ph) ph.style.display = 'none';
            img.style.display = 'block';
            img.src = blobUrl;
        } else {
            if (img) img.style.display = 'none';
            if (!vid) {
                vid = document.createElement('video');
                vid.id = 'prev_hero_video';
                vid.style.cssText = 'width:100%;height:140px;object-fit:cover;display:block;';
                vid.muted = true; vid.autoplay = true; vid.loop = true; vid.playsInline = true;
                vid.onclick = (e) => { e.stopPropagation(); document.getElementById('inp_hero_video').click(); };
                if (ph) ph.parentNode.insertBefore(vid, ph);
            }
            if (ph) ph.style.display = 'none';
            vid.style.display = 'block';
            vid.src = blobUrl;
            vid.load();
            vid.play().catch(() => {});
        }
    }

    showSyncing();
    const reader = new FileReader();
    reader.onload = function(e) {
        pendingVideoBlobUrl = e.target.result;
        schedulePreview();
    };
    reader.readAsDataURL(file);
}

function reloadIframe() {
    const iframe = document.getElementById('previewIframe');
    if (!iframe) return;
    iframeLoading = true;
    document.getElementById('iframeLoading')?.classList.remove('hidden');
    const videoToInject = pendingVideoBlobUrl;
    if (iframe._onloadHandler) iframe.removeEventListener('load', iframe._onloadHandler);
    iframe._onloadHandler = function () {
    iframeLoaded();
    if (videoToInject) {
        const tryInject = (attempt = 0) => {
            try {
                iframe.contentWindow?.postMessage(
                    { type: 'PREVIEW_VIDEO', src: videoToInject }, '*'
                );
            } catch(e) {}
            if (attempt < 3) setTimeout(() => tryInject(attempt + 1), 500);
        };
        setTimeout(() => tryInject(), 300);
    }

    if (window._pendingAboutFoto) {
        const aboutSrc = window._pendingAboutFoto;
        const tryInjectAbout = (attempt = 0) => {
            try {
                iframe.contentWindow?.postMessage(
                    { type: 'PREVIEW_ABOUT_FOTO', src: aboutSrc }, '*'
                );
            } catch(e) {}
            if (attempt < 3) setTimeout(() => tryInjectAbout(attempt + 1), 500);
        };
        setTimeout(() => tryInjectAbout(), 300);
    }
if (window._pendingFasFotos && Object.keys(window._pendingFasFotos).length > 0) {
    const fasData = { ...window._pendingFasFotos };
    const tryInjectFas = (attempt = 0) => {
        try {
            iframe.contentWindow?.postMessage(
                { type: 'PREVIEW_FAS_FOTOS', data: fasData }, '*'
            );
        } catch(e) {}
        if (attempt < 3) setTimeout(() => tryInjectFas(attempt + 1), 500);
    };
    setTimeout(() => tryInjectFas(), 300);
}
if (window._pendingBeritaFotos && Object.keys(window._pendingBeritaFotos).length > 0) {
    const beritaData = { ...window._pendingBeritaFotos };
    const tryInjectBerita = (attempt = 0) => {
        try {
            iframe.contentWindow?.postMessage(
                { type: 'PREVIEW_BERITA_FOTOS', data: beritaData }, '*'
            );
        } catch(e) {}
        if (attempt < 3) setTimeout(() => tryInjectBerita(attempt + 1), 500);
    };
    setTimeout(() => tryInjectBerita(), 300);
}
if (window._pendingLayananBg) {
    const bgSrc = window._pendingLayananBg;
    const tryInjectBg = (attempt = 0) => {
        try {
            iframe.contentWindow?.postMessage(
                { type: 'PREVIEW_LAYANAN_BG', src: bgSrc }, '*'
            );
        } catch(e) {}
        if (attempt < 3) setTimeout(() => tryInjectBg(attempt + 1), 500);
    };
    setTimeout(() => tryInjectBg(), 300);
}
};
    iframe.addEventListener('load', iframe._onloadHandler);
    iframe.src = '{{ route("home") }}?_preview_page=1&_t=' + Date.now();
}

function schedulePreview() {
    hasPendingSave = true;
    showSyncing();
    clearTimeout(previewTimer);
    previewTimer = setTimeout(sendPreview, 1000);
}

function sendPreview() {
    const form = document.getElementById('mainForm');
    if (!form) return;
    const fd = new FormData(form);
    fd.delete('_method');
    for (const key of [...fd.keys()]) {
        if (fd.get(key) instanceof File) fd.delete(key);
    }

    fetch(PREVIEW_URL, {
        method : 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
        body   : fd
    })
    .then(r => {
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
    })
    .then(res => {
        if (res.ok) {
            reloadIframe();
            hasPendingSave = false;
            showSynced();
        } else {
            hideSyncStatus();
        }
    })
    .catch(err => {
        console.warn('[preview] fetch error:', err);
        hideSyncStatus();
    });
}

function markPending() { schedulePreview(); }

function showSyncing() {
    document.getElementById('preview-syncing')?.style.setProperty('display','flex');
    document.getElementById('preview-synced')?.style.setProperty('display','none');
}
function showSynced() {
    document.getElementById('preview-syncing')?.style.setProperty('display','none');
    document.getElementById('preview-synced')?.style.setProperty('display','flex');
    setTimeout(() => {
        document.getElementById('preview-synced')?.style.setProperty('display','none');
    }, 2500);
}
function hideSyncStatus() {
    document.getElementById('preview-syncing')?.style.setProperty('display','none');
    document.getElementById('preview-synced')?.style.setProperty('display','none');
}

// jam operasional
function addJamRow() {
    const list = document.getElementById('jam-list');
    const count = list.querySelectorAll('.jam-row').length + 1;
    const div = document.createElement('div');
    div.className = 'akses-row jam-row';
    div.innerHTML = `
        <div class="fasilitas-num">${count}</div>
        <input type="text" name="kontak_jam_items[]" class="field-input"
               placeholder="Senin – Jumat  atau  09.00 – 15.00 WIB"
               style="flex:1;" oninput="markPending()">
        <button type="button" class="btn-remove-row" onclick="removeJamRow(this)" title="Hapus">
            <i class="bi bi-x"></i>
        </button>`;
    list.appendChild(div);
    renumberRows('jam-list', '.jam-row');
    schedulePreview();
}
function removeJamRow(btn) {
    const row = btn.closest('.jam-row');
    const list = document.getElementById('jam-list');
    if (list.querySelectorAll('.jam-row').length <= 1) return;
    row.remove();
    renumberRows('jam-list', '.jam-row');
    schedulePreview();
}

// divisi tujuan
function addDivisiRow() {
    const list = document.getElementById('divisi-list');
    const count = list.querySelectorAll('.divisi-row').length + 1;
    const div = document.createElement('div');
    div.className = 'akses-row divisi-row';
    div.innerHTML = `
        <div class="fasilitas-num">${count}</div>
        <input type="text" name="kontak_divisi_items[]" class="field-input"
               placeholder="Nama divisi..." style="flex:1;" oninput="markPending()">
        <button type="button" class="btn-remove-row" onclick="removeDivisiRow(this)" title="Hapus">
            <i class="bi bi-x"></i>
        </button>`;
    list.appendChild(div);
    renumberRows('divisi-list', '.divisi-row');
    schedulePreview();
}
function removeDivisiRow(btn) {
    const row = btn.closest('.divisi-row');
    const list = document.getElementById('divisi-list');
    if (list.querySelectorAll('.divisi-row').length <= 1) return;
    row.remove();
    renumberRows('divisi-list', '.divisi-row');
    schedulePreview();
}

// sosial media
let sosmedCount = 0;
function addSosmedRow() {
    const list = document.getElementById('sosmed-list');
    sosmedCount = list.querySelectorAll('.sosmed-row').length;
    const idx = sosmedCount;
    const div = document.createElement('div');
    div.className = 'sosmed-row';
    div.id = 'sosmed-row-' + idx;
    div.innerHTML = `
        <div class="fasilitas-num">${idx + 1}</div>
        <div class="sosmed-icon-preview" id="sosmed-icon-prev-${idx}">
            <i class="bi bi-link"></i>
        </div>
        <input type="text" name="sosmed_icon[]" class="field-input"
               placeholder="bi-instagram" style="width:130px;flex-shrink:0;"
               oninput="updateSosmedIcon(this, ${idx}); markPending()">
        <div style="position:relative;flex:1;">
            <span style="position:absolute;left:8px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:11px;">
                <i class="bi bi-link-45deg"></i>
            </span>
            <input type="text" name="sosmed_link[]" class="field-input"
                   placeholder="https://instagram.com/..." style="padding-left:24px;"
                   oninput="markPending()">
        </div>
        <button type="button" class="btn-remove-row" onclick="removeSosmedRow(this)" title="Hapus">
            <i class="bi bi-x"></i>
        </button>`;
    list.appendChild(div);
    renumberRows('sosmed-list', '.sosmed-row');
    schedulePreview();
}
function removeSosmedRow(btn) {
    const row = btn.closest('.sosmed-row');
    const list = document.getElementById('sosmed-list');
    if (list.querySelectorAll('.sosmed-row').length <= 1) return;
    row.remove();
    renumberRows('sosmed-list', '.sosmed-row');
    schedulePreview();
}
function updateSosmedIcon(input, idx) {
    const preview = document.getElementById('sosmed-icon-prev-' + idx);
    if (!preview) return;
    const iconClass = input.value.trim() || 'bi-link';
    preview.innerHTML = `<i class="bi ${iconClass}"></i>`;
}

function renumberRows(listId, rowSelector) {
    document.querySelectorAll('#' + listId + ' ' + rowSelector).forEach((row, i) => {
        const num = row.querySelector('.fasilitas-num');
        if (num) num.textContent = i + 1;
    });
}

// layanan button
let layananBtnCount = 0;

window.addEventListener('DOMContentLoaded', () => {
    layananBtnCount = document.querySelectorAll('#layanan-btn-list .layanan-btn-row').length || 0;
    aksesCount = document.querySelectorAll('#akses-list .akses-row').length || 0;
});

function addLayananBtn() {
    layananBtnCount++;
    const list = document.getElementById('layanan-btn-list');
    const div  = document.createElement('div');
    div.className = 'akses-row layanan-btn-row';
    div.id = 'layanan-btn-' + layananBtnCount;
    div.innerHTML = `
        <div class="fasilitas-num">${layananBtnCount}</div>
        <input type="text" name="layanan_btn_teks[]" class="field-input"
               placeholder="Nama tombol..." style="flex:1;" oninput="markPending()">
        <div style="position:relative;flex:1;">
            <span style="position:absolute;left:8px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:11px;">
                <i class="bi bi-link-45deg"></i>
            </span>
            <input type="text" name="layanan_btn_link[]" class="field-input"
                   placeholder="/layanan atau https://..." style="padding-left:24px;" oninput="markPending()">
        </div>
        <button type="button" class="btn-remove-row" onclick="removeLayananBtn(this)" title="Hapus">
            <i class="bi bi-x"></i>
        </button>`;
    list.appendChild(div);
    renumberLayananBtn();
    schedulePreview();
}

function removeLayananBtn(btn) {
    const row = btn.closest('.layanan-btn-row');
    if (document.querySelectorAll('#layanan-btn-list .layanan-btn-row').length <= 1) return;
    row.remove();
    renumberLayananBtn();
    schedulePreview();
}

function renumberLayananBtn() {
    document.querySelectorAll('#layanan-btn-list .layanan-btn-row').forEach((row, i) => {
        const num = row.querySelector('.fasilitas-num');
        if (num) num.textContent = i + 1;
    });
    layananBtnCount = document.querySelectorAll('#layanan-btn-list .layanan-btn-row').length;
}

// akses terdekat
let aksesCount = 0;

window.addEventListener('DOMContentLoaded', () => {
    aksesCount = document.querySelectorAll('#akses-list .akses-row').length || 0;
});

function addAksesRow() {
    aksesCount++;
    const list = document.getElementById('akses-list');
    const div  = document.createElement('div');
    div.className = 'akses-row';
    div.id = 'akses-row-' + aksesCount;
    div.innerHTML = `
        <div class="fasilitas-num">${aksesCount + 1}</div>
        <input type="text" name="akses_nama[]" class="field-input"
               placeholder="Nama tempat..." style="flex:1;" oninput="markPending()">
        <input type="text" name="akses_waktu[]" class="field-input"
               placeholder="± 5 menit" style="width:90px;flex-shrink:0;" oninput="markPending()">
        <button type="button" class="btn-remove-row" onclick="removeAksesRow(this)" title="Hapus">
            <i class="bi bi-x"></i>
        </button>`;
    list.appendChild(div);
    renumberAkses();
    schedulePreview();
}

function removeAksesRow(btn) {
    const row = btn.closest('.akses-row');
    if (document.querySelectorAll('#akses-list .akses-row').length <= 1) return;
    row.remove();
    renumberAkses();
    schedulePreview();
}

function renumberAkses() {
    document.querySelectorAll('#akses-list .akses-row').forEach((row, i) => {
        const num = row.querySelector('.fasilitas-num');
        if (num) num.textContent = i + 1;
    });
    aksesCount = document.querySelectorAll('#akses-list .akses-row').length;
}
let fasCount = document.querySelectorAll('#fasilitas-list .fas-item-card').length || 0;

function addFasItem() {
    fasCount++;
    const idx  = fasCount - 1;
    const list = document.getElementById('fasilitas-list');
    const div  = document.createElement('div');
    div.className = 'fas-item-card';
    div.id = 'fas-card-' + idx;
    div.dataset.index = idx;
    div.innerHTML = `
        <div class="fas-item-header">
            <span class="fas-item-badge">${fasCount}</span>
            <span class="fas-item-title-preview">Item Baru</span>
            <button type="button" class="btn-remove-row ms-auto" onclick="removeFasItem(this)" title="Hapus">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="fas-item-body">
            <div class="field-group">
                <div class="field-label">Foto</div>
                <div class="fas-foto-slot" onclick="this.querySelector('input[type=file]').click()">
                    <div class="fas-foto-placeholder">
                        <i class="bi bi-image" style="font-size:16px;"></i>
                        <span>Upload foto</span>
                    </div>
                    <input type="file" name="fasilitas_foto[]" accept="image/*"
                           onchange="handleFasFoto(this)" style="display:none;">
                    <input type="hidden" name="fasilitas_foto_existing[]" value="">
                </div>
            </div>
            <div class="field-group">
                <div class="field-label">Judul Fasilitas</div>
                <input type="text" name="fasilitas_judul[]" class="field-input"
                       placeholder="Nama fasilitas..."
                       oninput="updateFasTitle(this); markPending()">
            </div>
            <div class="field-group" style="margin-bottom:0;">
                <div class="field-label">Keterangan</div>
                <textarea name="fasilitas_keterangan[]" class="field-input" rows="2"
                          placeholder="Deskripsi singkat fasilitas..."
                          oninput="markPending()"></textarea>
            </div>
        </div>`;
    list.appendChild(div);
    renumberFas();
    schedulePreview();
}

function removeFasItem(btn) {
    const card = btn.closest('.fas-item-card');
    if (document.querySelectorAll('#fasilitas-list .fas-item-card').length <= 1) return;
    card.remove();
    renumberFas();
    schedulePreview();
}

function renumberFas() {
    document.querySelectorAll('#fasilitas-list .fas-item-card').forEach((card, i) => {
        const badge = card.querySelector('.fas-item-badge');
        if (badge) badge.textContent = i + 1;
        
        const header = card.querySelector('.fas-item-header');
        let starEl = card.querySelector('.fas-star-badge');
        if (i === 0) {
            if (!starEl) {
                starEl = document.createElement('span');
                starEl.className = 'fas-star-badge';
                starEl.style.cssText = 'font-size:10px;color:#f59e0b;font-weight:600;margin-left:4px;';
                starEl.textContent = '★ Utama';
                const titleEl = header.querySelector('.fas-item-title-preview');
                if (titleEl) titleEl.after(starEl);
            }
        } else {
            if (starEl) starEl.remove();
        }
    });
    fasCount = document.querySelectorAll('#fasilitas-list .fas-item-card').length;
}

function updateFasTitle(input) {
    const card = input.closest('.fas-item-card');
    if (!card) return;
    const preview = card.querySelector('.fas-item-title-preview');
    if (preview) preview.textContent = input.value || 'Item Baru';
}
function clearHeroMedia() {
    const vid = document.getElementById('prev_hero_video');
    const img = document.getElementById('prev_hero_image');
    const ph  = document.getElementById('prev_hero_video_placeholder');
    const btn = document.getElementById('btn-clear-hero');
    const inp = document.getElementById('inp_hero_video');
    const fnEl = document.getElementById('video-filename');

    if (vid) { vid.src = ''; vid.style.display = 'none'; }
    if (img) img.style.display = 'none';
    if (ph)  ph.style.display = 'flex';
    if (btn) btn.style.display = 'none';
    if (inp) inp.value = '';
    if (fnEl) fnEl.innerHTML = '<span style="color:red;">Format MP4, WebM, JPG, PNG, WebP.<br>Video max 50MB, Foto max 10MB.</span>';

    pendingVideoBlobUrl = null;
    document.getElementById('hero_video_clear').value = '1';
    schedulePreview();
}
window.addEventListener('beforeunload', e => {
    if (hasPendingSave) { e.preventDefault(); e.returnValue = ''; }
});
</script>
@endpush