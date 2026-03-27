{{-- resources/views/admin/unit/index.blade.php --}}
@extends('layouts.admin.main')

@push('styles')
<style>
.admin-card-section {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    margin-bottom: 20px;
    border: 1px solid #edf2f7;
}
.section-header-admin {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 12px;
    margin-bottom: 14px;
}
.section-title-text {
    font-size: 13px;
    font-weight: 700;
    color: #335A40;
    text-transform: uppercase;
    letter-spacing: .8px;
}
.info-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
}
.info-badge.empty {
    background: #f8fafc;
    border-color: #e2e8f0;
    color: #94a3b8;
}
.foto-thumb-hero {
    width: 100%; max-width: 320px; height: 90px;
    object-fit: cover; border-radius: 8px;
    border: 1px solid #e2e8f0; display: block;
}
.foto-thumb-empty-hero {
    width: 100%; max-width: 320px; height: 90px;
    border-radius: 8px; border: 1px dashed #e2e8f0;
    background: #f8fafc; display: flex;
    align-items: center; justify-content: center;
    color: #cbd5e1; font-size: 12px; gap: 6px;
}
.foto-thumb-grid { display: flex; gap: 8px; flex-wrap: wrap; }
.foto-thumb {
    width: 80px; height: 56px;
    object-fit: cover; border-radius: 8px;
    border: 1px solid #e2e8f0;
}
.stat-mini {
    display: inline-flex; flex-direction: column;
    align-items: center; background: #f8fafc;
    border: 1px solid #e5e7eb; border-radius: 10px;
    padding: 10px 18px; text-align: center; min-width: 80px;
}
.stat-mini .num { font-size: 20px; font-weight: 800; color: #0f3028; line-height: 1; }
.stat-mini .lbl { font-size: 9px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: .5px; margin-top: 3px; }

/* unit list */
.unit-list-item {
    display: flex; align-items: center; gap: 14px;
    padding: 12px 0; border-bottom: 1px solid #f1f5f9;
}
.unit-list-item:last-child { border-bottom: none; }
.unit-thumb {
    width: 72px; height: 52px; border-radius: 8px;
    object-fit: cover; border: 1px solid #e2e8f0; flex-shrink: 0;
}
.unit-thumb-empty {
    width: 72px; height: 52px; border-radius: 8px;
    border: 1px dashed #e2e8f0; background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    color: #cbd5e1; font-size: 20px; flex-shrink: 0;
}
.unit-info { flex: 1; min-width: 0; }
.unit-name { font-size: 13px; font-weight: 700; color: #1f2937; }
.unit-meta { font-size: 11px; color: #9ca3af; margin-top: 3px; display: flex; gap: 10px; flex-wrap: wrap; }
.fasilitas-tags { display: flex; flex-wrap: wrap; gap: 4px; margin-top: 5px; }
.fasilitas-tag {
    font-size: 9px; font-weight: 600; padding: 2px 7px;
    border-radius: 10px; background: #f0fdf4;
    color: #166534; border: 1px solid #bbf7d0;
}
.fasilitas-more {
    font-size: 9px; font-weight: 600; padding: 2px 7px;
    border-radius: 10px; background: #f1f5f9;
    color: #64748b; border: 1px solid #e2e8f0;
}
.order-wrap { display: flex; flex-direction: column; align-items: center; gap: 3px; flex-shrink: 0; }
.order-badge-box {
    width: 26px; height: 26px; background: #0f3028; color: #fff;
    border-radius: 6px; font-size: 11px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
}
.btn-order {
    width: 22px; height: 22px; border: 1px solid #e5e7eb;
    border-radius: 4px; background: #f8fafc; color: #6b7280;
    cursor: pointer; display: flex; align-items: center;
    justify-content: center; font-size: 10px;
    transition: all .15s; padding: 0;
}
.btn-order:hover { background: #335A40; color: #fff; border-color: #335A40; }
.btn-order:disabled { opacity: .3; cursor: not-allowed; }

/* galeri mini */
.galeri-mini-grid { display: flex; gap: 6px; flex-wrap: wrap; }
.galeri-mini-thumb {
    width: 52px; height: 52px; object-fit: cover;
    border-radius: 6px; border: 1px solid #e2e8f0;
}

/* video preview */
.video-preview {
    width: 100%; max-width: 320px;
    border-radius: 8px; border: 1px solid #e2e8f0;
    display: block; background: #000;
    max-height: 120px;
}
</style>
@endpush

@section('content')
<div class="page-heading">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0" style="font-size:1.15rem;">Halaman Tipe Unit</h3>
            <p class="text-muted mb-0" style="font-size:12px;">Overview seluruh konten halaman tipe unit.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.unit-page.edit') }}"
               class="btn btn-warning btn-sm px-3 py-2 shadow-sm text-white fw-bold d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square"></i>
                <span>Edit Konten</span>
            </a>
            <a href="{{ route('admin.unit.create') }}"
               class="btn btn-success btn-sm px-3 py-2 shadow-sm fw-bold d-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Unit</span>
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" style="font-size:13px;">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @php
    // Pakai Setting::get() supaya type image/video otomatis jadi asset URL
    $heroImg        = \App\Models\Setting::get('hero_image');
    $heroLine1      = \App\Models\Setting::get('hero_line_1')  ?? 'Temukan Sudut Favorit';
    $heroLine2      = \App\Models\Setting::get('hero_line_2')  ?? 'Hunian Impianmu';
    $heroDesc       = \App\Models\Setting::get('hero_desc')    ?? '-';
    $heroTag        = \App\Models\Setting::get('hero_tag')     ?? '-';

    $countingImg    = \App\Models\Setting::get('counting_image');
    $countingTitle1 = \App\Models\Setting::get('counting_title_1') ?? 'Rumah Nyaman,';
    $countingTitle2 = \App\Models\Setting::get('counting_title_2') ?? 'Investasi Masa Depan';
    $countingDesc   = \App\Models\Setting::get('counting_desc')    ?? '-';
    $statFloors     = \App\Models\Setting::get('stat_floors')      ?? '-';
    $statUnits      = \App\Models\Setting::get('stat_units')       ?? '-';
    $statSecurity   = \App\Models\Setting::get('stat_security')    ?? '-';
    $familyCount    = \App\Models\Setting::get('family_count')     ?? '-';

    $promoImagesRaw = \App\Models\Setting::get('promo_images');
    $promoImages    = is_array($promoImagesRaw) ? $promoImagesRaw : [];
    // promo_images type json, value-nya array of path — perlu asset() manual
    $promoImageUrls = array_map(function($p) {
        return str_starts_with($p, 'http') ? $p : asset($p);
    }, $promoImages);
    $promoTitle     = \App\Models\Setting::get('promo_title')    ?? '-';
    $promoSubtitle  = \App\Models\Setting::get('promo_subtitle') ?? '-';
    $promoBadge     = \App\Models\Setting::get('promo_badge')    ?? '-';

    $unitTitle1 = \App\Models\Setting::get('unit_section_title_1') ?? '-';
    $unitTitle2 = \App\Models\Setting::get('unit_section_title_2') ?? '-';
    $unitDesc   = \App\Models\Setting::get('unit_section_desc')    ?? '-';
    $unitBadge  = \App\Models\Setting::get('unit_section_badge')   ?? '-';

    $whatsappNumber  = \App\Models\Setting::get('whatsapp_number')  ?? '-';
    $whatsappMessage = \App\Models\Setting::get('whatsapp_message') ?? '-';
    $rentalUrl       = \App\Models\Setting::get('rental_url')       ?? null;

    $mainVideo     = \App\Models\Setting::get('main_video');   // type video → sudah asset URL
    $videoTitle    = \App\Models\Setting::get('video_title')    ?? '-';
    $videoSubtitle = \App\Models\Setting::get('video_subtitle') ?? '-';

    $galleryTitle = \App\Models\Setting::get('gallery_title') ?? '-';
    $galleryBadge = \App\Models\Setting::get('gallery_badge') ?? '-';
    $totalGaleri  = $units->sum(function($u) {
        $g = $u->galeri_foto;
        if (is_string($g)) $g = json_decode($g, true) ?? [];
        return is_array($g) ? count($g) : 0;
    });
    @endphp

    {{-- HERO --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Hero</span>
            @if($heroImg)
                <span class="info-badge"><i class="bi bi-check-circle"></i> Ada foto</span>
            @else
                <span class="info-badge empty"><i class="bi bi-clock"></i> Belum ada foto</span>
            @endif
        </div>
        <div class="d-flex gap-4 flex-wrap align-items-start">
            @if($heroImg)
                <img src="{{ $heroImg }}" class="foto-thumb-hero" alt="Hero">
            @else
                <div class="foto-thumb-empty-hero"><i class="bi bi-image"></i> Belum diisi</div>
            @endif
            <div style="font-size:12px; color:#374151; line-height:2;">
                <div><span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Tag</span>&nbsp; {{ $heroTag }}</div>
                <div><span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Line 1</span>&nbsp; <strong>{{ $heroLine1 }}</strong></div>
                <div><span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Line 2</span>&nbsp; <em>{{ $heroLine2 }}</em></div>
                <div><span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Deskripsi</span>&nbsp; <span style="color:#6b7280;">{{ Str::limit($heroDesc, 100) }}</span></div>
            </div>
        </div>
    </div>

    {{-- COUNTING --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Counting & Stats</span>
        </div>
        <div class="d-flex gap-4 flex-wrap align-items-start">
            @if($countingImg)
                <img src="{{ $countingImg }}" class="foto-thumb-hero" alt="Counting">
            @else
                <div class="foto-thumb-empty-hero"><i class="bi bi-image"></i> Belum ada foto</div>
            @endif
            <div>
                <div style="font-size:12px; color:#374151; line-height:2; margin-bottom:12px;">
                    <strong>{{ $countingTitle1 }} {{ $countingTitle2 }}</strong><br>
                    <span style="color:#6b7280; font-size:11px;">{{ Str::limit($countingDesc, 100) }}</span>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <div class="stat-mini"><span class="num">{{ $statFloors }}</span><span class="lbl">Lantai</span></div>
                    <div class="stat-mini"><span class="num">{{ $statUnits }}+</span><span class="lbl">Unit</span></div>
                    <div class="stat-mini"><span class="num">{{ $statSecurity }}</span><span class="lbl">Jam Security</span></div>
                    <div class="stat-mini"><span class="num">{{ $familyCount }}+</span><span class="lbl">Keluarga</span></div>
                </div>
            </div>
        </div>
    </div>

    {{-- PROMO --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Promo Slideshow</span>
            @if(count($promoImageUrls))
                <span class="info-badge"><i class="bi bi-check-circle"></i> {{ count($promoImageUrls) }} Foto</span>
            @else
                <span class="info-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($promoImageUrls))
        <div class="foto-thumb-grid mb-3">
            @foreach($promoImageUrls as $purl)
            <img src="{{ $purl }}" class="foto-thumb" alt="Promo">
            @endforeach
        </div>
        @endif
        <div style="font-size:12px; color:#374151; line-height:2;">
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Badge</span>&nbsp; {{ $promoBadge }}<br>
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Judul</span>&nbsp; <strong>{{ $promoTitle }}</strong><br>
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Subtitle</span>&nbsp; <span style="color:#6b7280;">{{ $promoSubtitle }}</span>
        </div>
    </div>

    {{-- SECTION PILIHAN UNIT --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Section Pilihan Unit</span>
        </div>
        <div style="font-size:12px; color:#374151; line-height:2;">
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Badge</span>&nbsp; {{ $unitBadge }}<br>
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Judul</span>&nbsp; <strong>{{ $unitTitle1 }} {{ $unitTitle2 }}</strong><br>
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Deskripsi</span>&nbsp; <span style="color:#6b7280;">{{ Str::limit($unitDesc, 120) }}</span>
        </div>
    </div>

    {{-- DAFTAR UNIT --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Daftar Tipe Unit</span>
            @if($units->count())
                <span class="info-badge"><i class="bi bi-check-circle"></i> {{ $units->count() }} Unit</span>
            @else
                <span class="info-badge empty"><i class="bi bi-clock"></i> Belum ada unit</span>
            @endif
        </div>

        @forelse($units as $unit)
        <div class="unit-list-item">
            @if($unit->foto_card)
                <img src="{{ $unit->foto_card_url }}" class="unit-thumb" alt="{{ $unit->nama_tipe }}">
            @else
                <div class="unit-thumb-empty"><i class="bi bi-image"></i></div>
            @endif

            <div class="unit-info">
                <div class="unit-name">{{ $unit->nama_tipe }}
                    @if($unit->subtitle)
                    <span style="font-size:11px; color:#9ca3af; font-weight:400;"> — {{ $unit->subtitle }}</span>
                    @endif
                </div>
                <div class="unit-meta">
                    <span><i class="bi bi-arrows-angle-expand"></i> {{ $unit->luas_unit }}</span>
                    @if($unit->kapasitas)<span><i class="bi bi-people"></i> {{ $unit->kapasitas }}</span>@endif
                    @if($unit->tower)<span><i class="bi bi-building"></i> {{ $unit->tower }}</span>@endif
                    @if($unit->view)<span><i class="bi bi-eye"></i> {{ $unit->view }}</span>@endif
                </div>
                @php $fasilitas = $unit->fasilitas_array; @endphp
                @if(count($fasilitas))
                <div class="fasilitas-tags">
                    @foreach(array_slice($fasilitas, 0, 4) as $f)
                    <span class="fasilitas-tag">{{ $f }}</span>
                    @endforeach
                    @if(count($fasilitas) > 4)
                    <span class="fasilitas-more">+{{ count($fasilitas) - 4 }} lainnya</span>
                    @endif
                </div>
                @endif
            </div>

            @php
                $gRaw = $unit->galeri_foto;
                if (is_string($gRaw)) $gRaw = json_decode($gRaw, true) ?? [];
                $galeriCount = is_array($gRaw) ? count($gRaw) : 0;
            @endphp
            <div style="flex-shrink:0; text-align:center; min-width:44px;">
                <div style="font-size:16px; font-weight:800; color:#335A40; line-height:1;">{{ $galeriCount }}</div>
                <div style="font-size:9px; color:#9ca3af; font-weight:600; text-transform:uppercase; letter-spacing:.4px;">Galeri</div>
            </div>

            <div class="order-wrap">
                <div class="order-badge-box">{{ $unit->order }}</div>
                <div class="d-flex gap-1">
                    @if(!$loop->first)
                    <form action="{{ route('admin.unit.move-up', $unit->id) }}" method="POST">
                        @csrf @method('PUT')
                        <button type="submit" class="btn-order" title="Naik"><i class="bi bi-chevron-up"></i></button>
                    </form>
                    @else
                    <button class="btn-order" disabled><i class="bi bi-chevron-up"></i></button>
                    @endif

                    @if(!$loop->last)
                    <form action="{{ route('admin.unit.move-down', $unit->id) }}" method="POST">
                        @csrf @method('PUT')
                        <button type="submit" class="btn-order" title="Turun"><i class="bi bi-chevron-down"></i></button>
                    </form>
                    @else
                    <button class="btn-order" disabled><i class="bi bi-chevron-down"></i></button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5" style="color:#9ca3af;">
            <i class="bi bi-inbox" style="font-size:36px;"></i>
            <p class="mt-2 mb-3" style="font-size:13px;">Belum ada unit. Silakan tambah unit baru.</p>
            <a href="{{ route('admin.unit.create') }}" class="btn btn-success btn-sm px-4">
                <i class="bi bi-plus-lg me-1"></i> Tambah Unit Pertama
            </a>
        </div>
        @endforelse
    </div>

    {{-- KONTAK & BOOKING --}}
<div class="admin-card-section">
    <div class="section-header-admin">
        <span class="section-title-text">Kontak & Booking</span>
    </div>
    <div style="font-size:12px; color:#374151; line-height:2;">
        <div>
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">WhatsApp</span>&nbsp;
            <strong>{{ $whatsappNumber }}</strong>
        </div>
        <div>
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Pesan Default</span>&nbsp;
            <span style="color:#6b7280;">{{ Str::limit($whatsappMessage, 80) }}</span>
        </div>
        <div>
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Link Booking</span>&nbsp;
            @if($rentalUrl)
                <a href="{{ $rentalUrl }}" target="_blank" style="color:#335A40;">{{ $rentalUrl }}</a>
            @else
                <span style="color:#9ca3af; font-style:italic;">Tidak ditampilkan</span>
            @endif
        </div>
    </div>
</div>

    {{-- VIDEO --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Video</span>
            @if($mainVideo)
                <span class="info-badge"><i class="bi bi-check-circle"></i> Ada video</span>
            @else
                <span class="info-badge empty"><i class="bi bi-clock"></i> Belum ada video</span>
            @endif
        </div>
        <div class="d-flex gap-4 flex-wrap align-items-start">
            @if($mainVideo)
                <video src="{{ $mainVideo }}" class="video-preview" muted controls></video>
            @else
                <div class="foto-thumb-empty-hero" style="background:#0f0f0f; color:#555; border-color:#333;">
                    <i class="bi bi-camera-video"></i> Belum ada video
                </div>
            @endif
            <div style="font-size:12px; color:#374151; line-height:2;">
                <div><span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Subtitle</span>&nbsp; {{ $videoSubtitle }}</div>
                <div><span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Judul</span>&nbsp; <strong>{{ $videoTitle }}</strong></div>
            </div>
        </div>
    </div>

    {{-- GALERI --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Galeri</span>
            @if($totalGaleri)
                <span class="info-badge"><i class="bi bi-check-circle"></i> {{ $totalGaleri }} Total Foto</span>
            @else
                <span class="info-badge empty"><i class="bi bi-clock"></i> Belum ada foto galeri</span>
            @endif
        </div>
        <div style="font-size:12px; color:#374151; margin-bottom:14px; line-height:2;">
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Badge</span>&nbsp; {{ $galleryBadge }}<br>
            <span style="color:#9ca3af; font-size:10px; font-weight:700; text-transform:uppercase;">Judul</span>&nbsp; <strong>{{ $galleryTitle }}</strong>
        </div>
        @foreach($units as $unit)
        @php $galeriUrls = $unit->galeri_foto_urls; @endphp
        @if(count($galeriUrls))
        <div class="mb-3">
            <div style="font-size:11px; font-weight:700; color:#374151; margin-bottom:6px;">
                {{ $unit->nama_tipe }}
                <span style="font-size:10px; color:#9ca3af; font-weight:400;">— {{ count($galeriUrls) }} foto</span>
            </div>
            <div class="galeri-mini-grid">
                @foreach(array_slice($galeriUrls, 0, 8) as $gurl)
                <img src="{{ $gurl }}" class="galeri-mini-thumb" alt="Galeri">
                @endforeach
                @if(count($galeriUrls) > 8)
                <div class="galeri-mini-thumb d-flex align-items-center justify-content-center"
                     style="background:#f1f5f9; color:#64748b; font-size:11px; font-weight:700; border-radius:6px; border:1px solid #e2e8f0;">
                    +{{ count($galeriUrls) - 8 }}
                </div>
                @endif
            </div>
        </div>
        @endif
        @endforeach
        @if(!$totalGaleri)
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada foto galeri di semua unit.</p>
        @endif
    </div>

</div>
@endsection