@extends('layouts.user.main')

@section('content')

@php
$setting = App\Models\Setting::getMany([
    'hero_image', 'hero_line_1', 'hero_line_2', 'hero_desc', 'hero_tag',
    'counting_image', 'counting_desc', 'counting_title_1', 'counting_title_2',
    'stat_floors', 'stat_units', 'stat_security', 'family_count',
    'promo_images', 'promo_title', 'promo_subtitle', 'promo_badge',
    'unit_section_title_1', 'unit_section_title_2', 'unit_section_desc', 'unit_section_badge',
    'main_video', 'video_title', 'video_subtitle',
    'gallery_title', 'gallery_badge',
    'whatsapp_number', 'whatsapp_message',
    'rental_url',
]);

$heroImg = $setting['hero_image'] ?? asset('assets/img/headerunit.jpg');
$heroLine1 = $setting['hero_line_1'] ?? 'Temukan Sudut Favorit';
$heroLine2 = $setting['hero_line_2'] ?? 'Hunian Impianmu';
$heroDesc = $setting['hero_desc'] ?? 'Ruang untuk bernafas, ruang untuk hidup — hadirkan ketenangan di setiap sudut hunian Anda.';
$heroTag = $setting['hero_tag'] ?? 'Bale Hinggil Apartment';

$countingImg = $setting['counting_image'] ?? asset('assets/img/headerunit.jpg');
$countingDesc = $setting['counting_desc'] ?? 'Bale Hinggil hadir bukan sekadar tempat tinggal — melainkan ruang di mana setiap pagi terasa lebih hangat, setiap pulang terasa lebih berarti.';
$countingTitle1 = $setting['counting_title_1'] ?? 'Rumah Nyaman,';
$countingTitle2 = $setting['counting_title_2'] ?? 'Investasi Masa Depan';
$statFloors = $setting['stat_floors'] ?? 31;
$statUnits = $setting['stat_units'] ?? 200;
$statSecurity = $setting['stat_security'] ?? 24;
$familyCount = $setting['family_count'] ?? 150;

$promoImages = $setting['promo_images'] ?? ['assets/img/promo.jpg'];
$promoCount = count($promoImages);
$promoTitle = $setting['promo_title'] ?? 'Harga Spesial Early Bird';
$promoSubtitle = $setting['promo_subtitle'] ?? 'Penawaran terbatas — hubungi kami untuk info lebih lanjut';
$promoBadge = $setting['promo_badge'] ?? 'Penawaran Terbatas';

$unitTitle1 = $setting['unit_section_title_1'] ?? 'Pilih Tipe Unit yang';
$unitTitle2 = $setting['unit_section_title_2'] ?? 'Sesuai Gaya Hidup Anda';
$unitDesc = $setting['unit_section_desc'] ?? 'Setiap sudut dirancang dengan cermat — dari Studio kompak hingga 3BR yang lapang, semua tersedia untuk melengkapi ritme hidup Anda.';
$unitBadge = $setting['unit_section_badge'] ?? 'Pilihan Unit';

$videoSrc = $setting['main_video'] ?? asset('assets/video/tipeunitvideo.mp4');
$videoTitle = $setting['video_title'] ?? 'Bale Hinggil Experience';
$videoSubtitle = $setting['video_subtitle'] ?? 'Cinematic Tour';

$galleryTitle = $setting['gallery_title'] ?? 'Lihat Lebih Dekat';
$galleryBadge = $setting['gallery_badge'] ?? 'Galeri';

$whatsapp  = $setting['whatsapp_number']  ?? '6282334466773';
$waMessage = $setting['whatsapp_message'] ?? 'Halo, saya tertarik dengan unit di Bale Hinggil Apartment';
$rentalUrl = $setting['rental_url']       ?? null;

$units = App\Models\Unit::orderBy('order')->get();

if (request()->query('_preview') === '1' && session('unit_preview')) {
    $p = session('unit_preview');
    if (!empty($p['unit_id'])) {
        $units = $units->map(function ($u) use ($p) {
            if ($u->id == $p['unit_id']) {
                $u->nama_tipe         = $p['nama_tipe']         ?? $u->nama_tipe;
                $u->subtitle          = $p['subtitle']          ?? $u->subtitle;
                $u->luas_unit         = $p['luas_unit']         ?? $u->luas_unit;
                $u->kapasitas         = $p['kapasitas']         ?? $u->kapasitas;
                $u->tower             = $p['tower']             ?? $u->tower;
                $u->view              = $p['view']              ?? $u->view;
                $u->deskripsi         = $p['deskripsi']         ?? $u->deskripsi;
                $u->deskripsi_singkat = $p['deskripsi_singkat'] ?? $u->deskripsi_singkat;
                $u->fasilitas         = $p['fasilitas']         ?? $u->fasilitas;
                $u->order             = $p['order']             ?? $u->order;
            }
            return $u;
        });
        $units     = $units->sortBy('order')->values();
        $unitTotal = $units->count();
    } else {
        $dummy = new App\Models\Unit();
        $dummy->id                = null;
        $dummy->nama_tipe         = !empty($p['nama_tipe']) ? $p['nama_tipe'] : 'Unit Baru';
        $dummy->subtitle          = $p['subtitle']          ?? '';
        $dummy->luas_unit         = !empty($p['luas_unit']) ? $p['luas_unit'] : '— m²';
        $dummy->kapasitas         = $p['kapasitas']         ?? '-';
        $dummy->tower             = $p['tower']             ?? '-';
        $dummy->view              = $p['view']              ?? '-';
        $dummy->deskripsi         = $p['deskripsi']         ?? '';
        $dummy->deskripsi_singkat = $p['deskripsi_singkat'] ?? '';
        $dummy->fasilitas         = $p['fasilitas']         ?? [];
        $dummy->foto_card = $p['foto_card_base64'] ?? null;
        $dummy->foto_3d   = $p['foto_3d_base64']   ?? null;
        $dummy->galeri_foto       = $p['galeri_foto'] ?? [];
        $dummy->order             = (int)($p['order'] ?? 9999);
        $dummyOrder = $dummy->order;
        $units = $units->map(function ($u) use ($dummyOrder) {
            if ($u->order >= $dummyOrder) $u->order = $u->order + 1;
            return $u;
        });
        $units->push($dummy);
        $units     = $units->sortBy('order')->values();
        $unitTotal = $units->count();
    }
}

if (request()->query('_preview_page') === '1' && session('page_preview')) {
    $pp = session('page_preview');
    $heroTag        = $pp['hero_tag']             ?? $heroTag;
    $heroLine1      = $pp['hero_line_1']          ?? $heroLine1;
    $heroLine2      = $pp['hero_line_2']          ?? $heroLine2;
    $heroDesc       = $pp['hero_desc']            ?? $heroDesc;
    $countingTitle1 = $pp['counting_title_1']     ?? $countingTitle1;
    $countingTitle2 = $pp['counting_title_2']     ?? $countingTitle2;
    $countingDesc   = $pp['counting_desc']        ?? $countingDesc;
    $statFloors     = $pp['stat_floors']          ?? $statFloors;
    $statUnits      = $pp['stat_units']           ?? $statUnits;
    $statSecurity   = $pp['stat_security']        ?? $statSecurity;
    $familyCount    = $pp['family_count']         ?? $familyCount;
    $promoBadge     = $pp['promo_badge']          ?? $promoBadge;
    $promoTitle     = $pp['promo_title']          ?? $promoTitle;
    $promoSubtitle  = $pp['promo_subtitle']       ?? $promoSubtitle;
    $unitBadge      = $pp['unit_section_badge']   ?? $unitBadge;
    $unitTitle1     = $pp['unit_section_title_1'] ?? $unitTitle1;
    $unitTitle2     = $pp['unit_section_title_2'] ?? $unitTitle2;
    $unitDesc       = $pp['unit_section_desc']    ?? $unitDesc;
    $videoTitle     = $pp['video_title']          ?? $videoTitle;
    $videoSubtitle  = $pp['video_subtitle']       ?? $videoSubtitle;
    $galleryBadge   = $pp['gallery_badge']        ?? $galleryBadge;
    $galleryTitle   = $pp['gallery_title']        ?? $galleryTitle;

    $ppUnitsData = $pp['units_data'] ?? [];
    if (!empty($ppUnitsData)) {
        $units = $units->map(function ($u) use ($ppUnitsData) {
            $d = $ppUnitsData[$u->id] ?? null;
            if ($d) {
                $u->fasilitas         = array_values(array_filter((array)($d['fasilitas'] ?? []), fn($v) => !empty(trim($v))));
                $u->nama_tipe         = $d['nama_tipe']         ?? $u->nama_tipe;
                $u->subtitle          = $d['subtitle']          ?? $u->subtitle;
                $u->luas_unit         = $d['luas_unit']         ?? $u->luas_unit;
                $u->kapasitas         = $d['kapasitas']         ?? $u->kapasitas;
                $u->tower             = $d['tower']             ?? $u->tower;
                $u->view              = $d['view']              ?? $u->view;
                $u->deskripsi         = $d['deskripsi']         ?? $u->deskripsi;
                $u->deskripsi_singkat = $d['deskripsi_singkat'] ?? $u->deskripsi_singkat;
                $u->order             = $d['order']             ?? $u->order;
            }
            return $u;
        });
        $units     = $units->sortBy('order')->values();
        $unitTotal = $units->count();
    }
    $hapusUnitPreview = $pp['hapus_unit_preview'] ?? [];
if (!empty($hapusUnitPreview)) {
    $units = $units->filter(fn($u) => !in_array($u->id, $hapusUnitPreview))->values();
    $unitTotal = $units->count();
}

if (isset($pp['promo_images'])) {
        $promoImages = array_map(fn($p) => str_starts_with($p, 'http') ? $p : asset($p), $pp['promo_images']);
        $promoCount  = count($promoImages);
    }
}

$unitTotal = $units->count();

$iconLuas  = 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6';
$iconKap   = 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z';
$iconTower = 'M3 12h18M3 10.5V18a2 2 0 002 2h14a2 2 0 002-2v-7.5M3 10.5V6a2 2 0 012-2h14a2 2 0 012 2v4.5M3 10.5l9 6 9-6';
$iconView  = 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.921-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z';
@endphp

@if((request()->query('_preview') === '1' && session('unit_preview')) || (request()->query('_preview_page') === '1' && session('page_preview')))
<div style="position:fixed;top:0;left:0;right:0;z-index:9999;background:#f59e0b;color:#1c1c1c;font-size:11px;font-weight:700;text-align:center;padding:5px;letter-spacing:.05em;">
    ⚡ PREVIEW MODE — Perubahan belum tersimpan ke database
</div>
<div style="height:27px;"></div>
@endif

{{-- hero --}}
<section class="relative min-h-screen w-full flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ $heroImg }}" alt="Interior Bale Hinggil" class="w-full h-full object-cover hero-img" id="img_hero">
        <div class="absolute inset-0 bg-[#1a0f06]/60 hero-overlay"></div>
        <div class="absolute inset-0" style="background:radial-gradient(ellipse 60% 100% at 0% 50%,rgba(10,5,2,.50) 0%,transparent 70%);"></div>
    </div>
    <div class="relative z-20 w-full px-4 sm:px-10 md:px-16 lg:px-24 pt-16 pb-20 sm:pt-24 sm:pb-28">
        <div class="max-w-3xl space-y-2 sm:space-y-4">
            <p class="hero-tag text-[#c0a058]/70 text-[8px] sm:text-[10px] font-bold tracking-[0.3em] uppercase opacity-0">{{ $heroTag }}</p>
            <h1 class="font-serif leading-[1.1]">
                <span class="hero-title-1 block text-xl sm:text-3xl md:text-4xl lg:text-5xl text-[#d0b068] opacity-0">{{ $heroLine1 }}</span>
                <span class="hero-title-2 block text-xl sm:text-3xl md:text-4xl lg:text-5xl italic font-light mt-0.5 sm:mt-1 text-[#f8f0e0]/90 opacity-0">{{ $heroLine2 }}</span>
            </h1>
            <div class="hero-line w-12 sm:w-24 h-[1px] bg-[#c0a058]/60 my-3 sm:my-6 opacity-0 scale-x-0 origin-left"></div>
            <p class="hero-desc text-[#e0d0b0]/70 text-[11px] sm:text-sm max-w-[260px] sm:max-w-md leading-relaxed font-light opacity-0">{{ $heroDesc }}</p>
        </div>
    </div>
    <div style="position:absolute;bottom:24px;left:0;right:0;display:flex;flex-direction:column;align-items:center;gap:4px;z-index:20;" class="hero-scroll cursor-pointer"
         onclick="window.scrollTo({top:document.getElementById('tipe-unit').offsetTop,behavior:'smooth'})">
        <p class="scroll-label" style="color:rgba(192,160,88,.6);font-size:8px;font-weight:700;letter-spacing:.4em;text-transform:uppercase;transition:color .3s ease;">Scroll</p>
        <div class="scroll-line" style="width:1px;height:16px;background:rgba(192,160,88,.4);transition:height .3s ease,background .3s ease;"></div>
        <svg class="scroll-arrow" style="width:12px;height:12px;animation:bounce 1s infinite;transition:stroke .3s ease;" fill="none" viewBox="0 0 24 24" stroke="rgba(192,160,88,.6)" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- perhitungan --}}
<section class="py-8 sm:py-14 px-3 sm:px-10 md:px-16 lg:px-24 bg-[#fff6e5]">
    <div class="w-full max-w-7xl mx-auto">
        <div class="sm:hidden space-y-4">
            <div>
                <p class="text-[8px] tracking-[3px] uppercase text-[#785838] font-semibold mb-1.5">Mulai Perjalanan Anda</p>
                <h2 class="text-lg font-serif italic text-[#0f3028] leading-tight">{{ $countingTitle1 }}<br>{{ $countingTitle2 }}</h2>
                <div class="w-8 h-[1px] bg-[#c0a058]/50 mt-2.5"></div>
            </div>
            <img src="{{ $countingImg }}" alt="Interior" class="rounded-lg shadow-lg w-full object-cover" id="img_counting">
            <p class="text-[#3a2818]/80 text-[11px] leading-relaxed">
                {{ $countingDesc }} Bergabunglah dengan <b><span id="counter-families">0</span>+ keluarga</b> yang telah mempercayakan hunian mereka bersama kami.
            </p>
            <div class="grid grid-cols-3 gap-2">
                <div class="bg-white/70 border border-[#c0a058]/15 rounded-lg p-3 text-center">
                    <div class="text-[#0f3028] text-base font-bold font-serif"><span id="counter-floors-m">0</span></div>
                    <p class="text-[#785838] text-[8px] uppercase tracking-wider mt-0.5 font-semibold">Lantai</p>
                </div>
                <div class="bg-white/70 border border-[#c0a058]/15 rounded-lg p-3 text-center">
                    <div class="text-[#0f3028] text-base font-bold font-serif"><span id="counter-units-m">0</span>+</div>
                    <p class="text-[#785838] text-[8px] uppercase tracking-wider mt-0.5 font-semibold">Unit Tersedia</p>
                </div>
                <div class="bg-white/70 border border-[#c0a058]/15 rounded-lg p-3 text-center">
                    <div class="text-[#0f3028] text-base font-bold font-serif"><span id="counter-security-m">0</span></div>
                    <p class="text-[#785838] text-[8px] uppercase tracking-wider mt-0.5 font-semibold">Jam Keamanan</p>
                </div>
            </div>
        </div>
        <div class="hidden sm:grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <div class="reveal-left">
                <img src="{{ $countingImg }}" alt="Interior Bale Hinggil" class="rounded-[1rem] shadow-xl w-full object-cover" id="img_counting_d">
            </div>
            <div class="space-y-6 sm:space-y-8">
                <div class="reveal-right" style="transition-delay:.1s">
                    <p class="text-xs tracking-[4px] uppercase text-[#785838] font-semibold mb-3">Mulai Perjalanan Anda</p>
                    <h2 class="letter-stagger text-3xl sm:text-4xl md:text-5xl font-serif italic text-[#0f3028] leading-tight">
                        <span class="ls-line">{{ $countingTitle1 }}</span>
                        <span class="ls-line">{{ $countingTitle2 }}</span>
                    </h2>
                    <div class="w-12 h-[1px] bg-[#c0a058]/50 mt-5"></div>
                </div>
                <p class="reveal-up text-[#3a2818]/80 leading-relaxed text-sm sm:text-base max-w-lg" style="transition-delay:.2s">
                    {{ $countingDesc }} Bergabunglah dengan <b><span id="counter-families-d">0</span>+ keluarga</b> yang telah mempercayakan hunian mereka bersama kami.
                </p>
                <div class="grid grid-cols-3 gap-3 sm:gap-4">
                    <div class="reveal-up bg-white/60 border border-[#c0a058]/15 rounded-xl sm:rounded-2xl p-4 sm:p-5 text-center hover:border-[#c0a058]/40 hover:-translate-y-1 transition-all group" style="transition-delay:.3s">
                        <div class="text-[#0f3028] text-xl sm:text-2xl font-bold font-serif mb-1 group-hover:text-[#785838] transition-colors"><span id="counter-floors-d">0</span></div>
                        <p class="text-[#785838] text-[9px] sm:text-[10px] uppercase tracking-widest font-semibold">Lantai</p>
                    </div>
                    <div class="reveal-up bg-white/60 border border-[#c0a058]/15 rounded-xl sm:rounded-2xl p-4 sm:p-5 text-center hover:border-[#c0a058]/40 hover:-translate-y-1 transition-all group" style="transition-delay:.45s">
                        <div class="text-[#0f3028] text-xl sm:text-2xl font-bold font-serif mb-1 group-hover:text-[#785838] transition-colors"><span id="counter-units-d">0</span>+</div>
                        <p class="text-[#785838] text-[9px] sm:text-[10px] uppercase tracking-widest font-semibold">Unit Tersedia</p>
                    </div>
                    <div class="reveal-up bg-white/60 border border-[#c0a058]/15 rounded-xl sm:rounded-2xl p-4 sm:p-5 text-center hover:border-[#c0a058]/40 hover:-translate-y-1 transition-all group" style="transition-delay:.6s">
                        <div class="text-[#0f3028] text-xl sm:text-2xl font-bold font-serif mb-1 group-hover:text-[#785838] transition-colors"><span id="counter-security-d">0</span></div>
                        <p class="text-[#785838] text-[9px] sm:text-[10px] uppercase tracking-widest font-semibold">Jam Keamanan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- promo --}}
<section class="bg-[#f2e8d4] py-5 sm:py-8 lg:py-10 px-3 sm:px-10 md:px-16 lg:px-24">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
            <div class="w-5 sm:w-8 h-[1px] bg-[#c0a058]/60"></div>
            <p class="text-[#785838] text-[8px] sm:text-[10px] font-bold tracking-[0.4em] uppercase">{{ $promoBadge }}</p>
            <div class="flex-1 h-[1px] bg-[#c0a058]/20"></div>
        </div>
        <div class="reveal-scale relative rounded-xl shadow-xl" style="overflow:hidden;isolation:isolate;">
            <div class="promo-frame" style="border-radius:.75rem;width:100%;position:relative;aspect-ratio:16/9;overflow:hidden;">
                <div id="promo-track" style="display:flex;height:100%;transition:transform .7s cubic-bezier(.77,0,.175,1);transform:translateX({{ $promoCount>1 ? '-100%' : '0%' }});">
                    @if($promoCount > 1)
                    <div style="min-width:100%;height:100%;flex-shrink:0;"><img src="{{ $promoImages[$promoCount-1] }}" style="width:100%;height:100%;object-fit:cover;display:block;"></div>
                    @endif
                    @foreach($promoImages as $pi => $pimg)
                    <div style="min-width:100%;height:100%;flex-shrink:0;"><img src="{{ $pimg }}" alt="Promo" style="width:100%;height:100%;object-fit:cover;display:block;"></div>
                    @endforeach
                    @if($promoCount > 1)
                    <div style="min-width:100%;height:100%;flex-shrink:0;"><img src="{{ $promoImages[0] }}" style="width:100%;height:100%;object-fit:cover;display:block;"></div>
                    @endif
                </div>
            </div>
            <div class="absolute inset-0 pointer-events-none" style="background:linear-gradient(to top,rgba(20,14,8,.75) 0%,rgba(20,14,8,.1) 50%,transparent 100%);"></div>
            <button id="promo-btn-prev" onclick="promoNav(-1)" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-7 h-7 sm:w-9 sm:h-9 bg-[#0f3028]/50 hover:bg-[#0f3028]/80 text-[#f8f0e0] rounded-full flex items-center justify-center transition-all backdrop-blur-sm" style="{{ $promoCount <= 1 ? 'display:none;' : '' }}">
    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
</button>
<button id="promo-btn-next" onclick="promoNav(1)" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-7 h-7 sm:w-9 sm:h-9 bg-[#0f3028]/50 hover:bg-[#0f3028]/80 text-[#f8f0e0] rounded-full flex items-center justify-center transition-all backdrop-blur-sm" style="{{ $promoCount <= 1 ? 'display:none;' : '' }}">
    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
</button>
<div class="absolute bottom-2 sm:bottom-4 right-4 sm:right-8 flex gap-1.5" id="promo-dots">
    @foreach($promoImages as $pi => $pimg)
    <button onclick="promoGoTo({{ $pi }})" class="promo-dot rounded-full transition-all duration-300"
            style="{{ $pi===0?'background:#d0b068;width:16px;height:6px;':'background:rgba(240,232,216,.3);width:6px;height:6px;' }}"></button>
    @endforeach
</div>
            <div class="absolute bottom-4 sm:bottom-8 left-4 sm:left-8 right-4 sm:right-8 pointer-events-none">
                <p class="text-[#e0d0b0]/60 text-[8px] sm:text-[10px] font-bold tracking-[0.3em] uppercase mb-0.5">{{ $heroTag }}</p>
                <h3 class="text-[#f8f0e0] text-sm sm:text-2xl md:text-3xl font-serif italic">{!! $promoTitle !!}</h3>
                <p class="text-[#e0d0b0]/50 text-[9px] sm:text-xs mt-0.5 sm:mt-2">{{ $promoSubtitle }}</p>
            </div>
        </div>
    </div>
</section>

{{-- pilihan unit --}}
<section id="tipe-unit" class="min-h-screen flex flex-col justify-center py-6 sm:py-10 px-3 sm:px-10 md:px-16 lg:px-24 bg-[#eee0c8] scroll-mt-16 sm:scroll-mt-20">
    <div class="text-center mb-4 sm:mb-8 space-y-1">
        <p class="reveal-up text-[#785838] text-[8px] sm:text-[11px] tracking-[0.35em] uppercase font-medium">{{ $unitBadge }}</p>
        <h2 class="letter-stagger text-lg sm:text-2xl md:text-3xl lg:text-4xl leading-tight" style="transition-delay:.1s">
            <span class="ls-line text-[#0f3028] font-semibold">{{ $unitTitle1 }}</span>
            <span class="ls-line italic text-[#785838] font-serif">{{ $unitTitle2 }}</span>
        </h2>
        <div class="reveal-up w-10 sm:w-16 h-[1px] bg-[#c0a058]/50 mx-auto mt-2 sm:mt-4" style="transition-delay:.2s"></div>
        <p class="reveal-up text-[#685028]/70 max-w-xs sm:max-w-xl mx-auto text-[10px] sm:text-sm leading-relaxed pt-2 sm:pt-3 font-light" style="transition-delay:.3s">{{ $unitDesc }}</p>
    </div>

    @if($unitTotal > 0)
    @php
        $rows = [];
        if ($unitTotal <= 3) {
            $rows[] = $units->all();
        } elseif ($unitTotal === 4) {
            $rows[] = $units->slice(0, 2)->all();
            $rows[] = $units->slice(2, 2)->all();
        } else {
            $allUnits  = $units->all();
            $remainder = $unitTotal % 3;
            $fullRows  = (int) floor($unitTotal / 3);
            for ($r = 0; $r < $fullRows; $r++) {
                $rows[] = array_slice($allUnits, $r * 3, 3);
            }
            if ($remainder > 0) $rows[] = array_slice($allUnits, $fullRows * 3);
        }
        $jumlahBaris = count($rows);
        $gapTotal    = ($jumlahBaris - 1) * 2;
        $cardVh      = (int) floor((100 - 32 - 10 - $gapTotal) / $jumlahBaris);
        $rowStartIdx = 0;
    @endphp

    {{-- desktop --}}
    <div class="hidden sm:flex flex-col gap-4 lg:gap-5" style="flex:1;min-height:0;">
        @foreach($rows as $rowIndex => $rowUnits)
        @php $colCount = count($rowUnits); @endphp
        <div class="flex justify-center gap-4 lg:gap-5" style="flex:1;min-height:0;">
            @foreach($rowUnits as $j => $unit)
            @php
                $globalIdx = $rowStartIdx + $j;
                $isDummy   = is_null($unit->id);
                $unitKey   = $isDummy ? 'dummy' : $unit->id;
            @endphp
            <div onclick="unitGoTo({{ $globalIdx }});setTimeout(()=>document.getElementById('detail-studio').scrollIntoView({behavior:'smooth'}),50);"
                 class="unit-card group relative overflow-hidden rounded-xl cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500"
                 data-unit-id="{{ $unitKey }}"
                 style="flex:0 0 calc({{ 100 / max($colCount, 1) }}% - 1.25rem);height:{{ $cardVh }}vh;transition-delay:{{ $globalIdx * .15 }}s;{{ $isDummy ? 'outline:3px dashed #c0a058;outline-offset:-3px;' : '' }}">
                <div style="position:absolute;inset:0;" class="overflow-hidden bg-[#1a3a2a]">
                    <img src="{{ $unit->foto_card_url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" id="img_card_{{ $unitKey }}">
                </div>
                @if($isDummy)
                <div class="absolute top-0 left-0 right-0 z-10 text-center py-1" style="background:rgba(192,160,88,0.85);">
                    <span style="font-size:9px;font-weight:700;color:#1a0f06;letter-spacing:.15em;text-transform:uppercase;">✦ Preview — Belum Tersimpan</span>
                </div>
                @endif
                <div class="absolute top-0 right-0">
                    <div class="bg-[#0f3028] text-[#d0b068] text-[10px] font-bold px-4 py-2.5 rounded-bl-2xl">{{ $unit->luas_unit }}</div>
                </div>
                <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(20,10,5,.88) 0%,rgba(20,10,5,.1) 50%,transparent 100%);"></div>
                <div class="absolute bottom-6 left-0 w-full text-center px-4">
                    <p class="text-[#d0b068]/70 text-[8px] tracking-widest uppercase mb-1 font-semibold">Tipe</p>
                    <h3 class="text-[#f8f0e0] text-lg font-serif italic group-hover:text-[#d0b068] transition-colors duration-300">{{ $unit->nama_tipe }}</h3>
                </div>
            </div>
            @endforeach
        </div>
        @php $rowStartIdx += count($rowUnits); @endphp
        @endforeach
    </div>

    {{-- mobile --}}
    <div class="sm:hidden -mx-3 px-3">
        <div class="flex gap-3 overflow-x-auto pb-3 snap-x snap-mandatory scrollbar-hide">
            @foreach($units as $i => $unit)
            @php
                $isDummy = is_null($unit->id);
                $unitKey = $isDummy ? 'dummy' : $unit->id;
            @endphp
            <div onclick="unitGoTo({{ $i }});setTimeout(()=>document.getElementById('detail-studio').scrollIntoView({behavior:'smooth'}),50);"
                 class="snap-start shrink-0 w-[55vw] relative overflow-hidden rounded-lg cursor-pointer shadow-md"
                 data-unit-id="{{ $unitKey }}"
                 style="{{ $isDummy ? 'outline:3px dashed #c0a058;outline-offset:-3px;' : '' }}">
                <div class="aspect-[3/4] w-full overflow-hidden bg-[#1a3a2a]">
                    <img src="{{ $unit->foto_card_url }}" class="w-full h-full object-cover" id="img_card_m_{{ $unitKey }}">
                </div>
                @if($isDummy)
                <div class="absolute top-0 left-0 right-0 z-10 text-center py-1" style="background:rgba(192,160,88,0.85);">
                    <span style="font-size:8px;font-weight:700;color:#1a0f06;letter-spacing:.1em;text-transform:uppercase;">✦ Preview</span>
                </div>
                @endif
                <div class="absolute top-0 right-0">
                    <div class="bg-[#0f3028] text-[#d0b068] text-[8px] font-bold px-2.5 py-1.5 rounded-bl-xl">{{ $unit->luas_unit }}</div>
                </div>
                <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(20,10,5,.88) 0%,transparent 55%);"></div>
                <div class="absolute bottom-3 left-0 w-full text-center px-2">
                    <p class="text-[#d0b068]/70 text-[7px] tracking-widest uppercase mb-0.5 font-semibold">Tipe</p>
                    <h3 class="text-[#f8f0e0] text-sm font-serif italic">{{ $unit->nama_tipe }}</h3>
                </div>
            </div>
            @endforeach
        </div>
        <p class="text-center text-[#785838]/40 text-[8px] tracking-widest uppercase mt-1.5">← Geser →</p>
    </div>
    @endif
</section>

{{-- video --}}
<section class="relative w-full overflow-hidden bg-black">
    <div class="video-wrapper relative w-full">
        <video class="absolute inset-0 w-full h-full object-cover video-fade" autoplay muted loop playsinline>
            <source src="{{ $videoSrc }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="absolute bottom-3 sm:bottom-8 left-4 sm:left-10 text-[#f8f0e0] z-10">
            <p class="text-[8px] sm:text-[10px] tracking-[0.4em] uppercase text-[#d0b068]/70 mb-0.5 font-bold">{{ $videoSubtitle }}</p>
            <h4 class="text-sm sm:text-2xl md:text-3xl font-serif italic">{{ $videoTitle }}</h4>
        </div>
    </div>
</section>
{{-- detail unit --}}
<section id="detail-studio" class="py-7 sm:py-12 lg:py-16 px-3 sm:px-10 md:px-16 lg:px-24 scroll-mt-14 bg-[#f2e8d4]">
    <div class="flex gap-4 sm:gap-8 border-b border-[#c0a058]/20 mb-6 sm:mb-10 overflow-x-auto scrollbar-hide">
        @foreach($units as $i => $unit)
        <button id="btn-unit-{{ $i }}" onclick="unitGoTo({{ $i }})"
                class="unit-nav-btn pb-2.5 sm:pb-4 text-[10px] sm:text-sm font-bold uppercase tracking-wider sm:tracking-widest whitespace-nowrap transition-all
                       {{ $i===0 ? 'border-b-2 border-[#0f3028] text-[#0f3028]' : 'text-[#785838]/50 hover:text-[#0f3028]' }}">
            {{ $unit->nama_tipe }}
            @if(is_null($unit->id))<span style="font-size:8px;color:#c0a058;margin-left:3px;">✦</span>@endif
        </button>
        @endforeach
    </div>

    <div class="relative px-3 sm:px-10 md:px-14">
        <button onclick="unitNav(-1)" class="unit-arrow absolute left-0 top-1/2 -translate-y-1/2 z-30 w-7 h-7 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all border border-[#c0a058]/20 bg-transparent sm:bg-[#0f3028] sm:shadow-lg sm:hover:bg-[#1a3a2a] text-[#0f3028] sm:text-[#d0b068] active:bg-[#0f3028] active:text-[#d0b068]">
            <svg class="h-3 w-3 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button onclick="unitNav(1)" class="unit-arrow absolute right-0 top-1/2 -translate-y-1/2 z-30 w-7 h-7 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-all border border-[#c0a058]/20 bg-transparent sm:bg-[#0f3028] sm:shadow-lg sm:hover:bg-[#1a3a2a] text-[#0f3028] sm:text-[#d0b068] active:bg-[#0f3028] active:text-[#d0b068]">
            <svg class="h-3 w-3 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </button>

        <div style="overflow:hidden;width:100%;">
            <div id="unit-track" style="display:flex;transition:transform .7s cubic-bezier(.77,0,.175,1);transform:translateX(-100%);">
                @php
                $slideList = [];
                if($unitTotal > 0) $slideList[] = ['unit'=>$units->last(), 'sid'=>'clone-last', 'clone'=>true, 'idx'=>null];
                foreach($units as $_i => $_u) $slideList[] = ['unit'=>$_u, 'sid'=>'desc-'.$_i, 'clone'=>false, 'idx'=>$_i];
                if($unitTotal > 0) $slideList[] = ['unit'=>$units->first(), 'sid'=>'clone-first', 'clone'=>true, 'idx'=>null];
                @endphp

                @foreach($slideList as $slide)
                @php
                $unit      = $slide['unit'];
                $sid       = $slide['sid'];
                $isDummy   = is_null($unit->id);
                $unitKey   = $isDummy ? 'dummy' : $unit->id;
                $fasilitas = $unit->fasilitas_array;
                $half      = (int)ceil(count($fasilitas)/2);
                $specs = [
                    ['icon'=>$iconLuas,  'label'=>'Luas',     'value'=>$unit->luas_unit ?? '-'],
                    ['icon'=>$iconKap,   'label'=>'Kapasitas', 'value'=>$unit->kapasitas ?? '-'],
                    ['icon'=>$iconTower, 'label'=>'Tower',     'value'=>$unit->tower ?? '-'],
                    ['icon'=>$iconView,  'label'=>'View',      'value'=>$unit->view ?? '-'],
                ];
                @endphp

                <div @if(!$slide['clone']) id="content-unit-{{ $slide['idx'] }}" @else aria-hidden="true" @endif class="w-full shrink-0">

                    @if($isDummy)
                    <div class="mb-4 sm:mb-6 text-center">
                        <span style="display:inline-block;background:rgba(192,160,88,0.15);border:1px dashed #c0a058;color:#785838;font-size:10px;font-weight:700;letter-spacing:.15em;text-transform:uppercase;padding:4px 14px;border-radius:999px;">
                            ✦ Preview Unit Baru — Belum Tersimpan
                        </span>
                    </div>
                    @endif

                    {{-- mobile --}}
                    <div class="sm:hidden space-y-4">
                        <div>
                            <h2 class="text-xl font-bold text-[#0f3028] tracking-tight font-serif italic leading-tight">{{ strtoupper($unit->nama_tipe) }}</h2>
                            <p class="text-[#785838] text-[10px] font-medium font-serif mt-0.5">{{ $unit->subtitle ?? 'Elegant & Modern' }}</p>
                        </div>
                        <div class="bg-[#1a3a2a] rounded-lg p-3 border border-[#d0b068]/30">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-[8px] font-bold text-[#d0b068]/70 uppercase tracking-wider">Denah Unit</span>
                                <div class="h-[1px] flex-1 bg-gradient-to-r from-[#d0b068]/40 to-transparent"></div>
                            </div>
                            @if($unit->foto_3d_url)
                            <img src="{{ $unit->foto_3d_url }}" alt="Denah {{ $unit->nama_tipe }}" class="w-full h-auto rounded-md" id="img_3d_m_{{ $unitKey }}">
                            @else
                            <div class="h-32 flex items-center justify-center text-[#d0b068]/30 text-xs" id="img_3d_m_{{ $unitKey }}">
                                {{ $isDummy ? 'Upload foto denah di form kiri' : 'Denah belum tersedia' }}
                            </div>
                            @endif
                        </div>
                        <div>
                            <p id="{{ $sid }}-short" class="text-[#3a2818] text-[11px] leading-relaxed">{{ Str::limit($unit->deskripsi ?? '', 80) }}</p>
                            <p id="{{ $sid }}-full" class="text-[#3a2818] text-[11px] leading-relaxed hidden">
                                {{ $unit->deskripsi }}
                                @if($unit->deskripsi_singkat)<span class="block mt-1 text-[#785838] italic text-[10px]">{{ $unit->deskripsi_singkat }}</span>@endif
                            </p>
                            <button onclick="toggleDesc('{{ $sid }}')" class="mt-1 flex items-center gap-1 text-[#785838] text-[10px] font-bold tracking-wider uppercase">
                                <span id="{{ $sid }}-btn-text">Selengkapnya</span>
                                <svg id="{{ $sid }}-btn-icon" class="w-2.5 h-2.5 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>
                        <div>
                            <p class="text-[8px] font-bold text-[#785838]/60 uppercase tracking-widest mb-2">Spesifikasi</p>
                            <div class="flex gap-2 overflow-x-auto scrollbar-hide pb-1">
                                @foreach($specs as $spec)
                                <div class="shrink-0 bg-[#1a3a2a] border-l-2 border-[#d0b068] rounded-lg p-2.5 flex flex-col items-center min-w-[64px]">
                                    <svg class="w-3.5 h-3.5 text-[#d0b068]/80 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $spec['icon'] }}"/></svg>
                                    <p class="text-[7px] font-bold text-[#d0b068]/70 uppercase tracking-wider leading-tight text-center">{{ $spec['label'] }}</p>
                                    <p class="text-[9px] font-bold text-[#f8f0e0] mt-0.5 text-center">{{ $spec['value'] }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @if(count($fasilitas) > 0)
                        <div>
                            <p class="text-[8px] font-bold text-[#785838]/60 uppercase tracking-widest mb-2">Fasilitas</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($fasilitas as $fi => $feat)
                                <span class="inline-flex items-center gap-1 bg-[#0f3028]/10 border border-[#0f3028]/15 text-[#0f3028] text-[9px] font-medium px-2 py-0.5 rounded-full">
                                    <span class="w-3 h-3 rounded-full bg-[#0f3028]/20 text-[6px] flex items-center justify-center font-bold">{{ $fi+1 }}</span>{{ $feat }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <a href="{{ route('contact.redirect', ['unit_id' => $unit->id, 'unit_nama' => $unit->nama_tipe]) }}"target="_blank" class="w-full bg-[#0f3028] text-[#d0b068] font-bold text-[10px] uppercase tracking-widest py-2.5 rounded-lg flex items-center justify-center border border-[#c0a058]/20 hover:bg-[#1a3a2a] transition-all">Hubungi Kami</a>
                        @if($rentalUrl)
<a href="{{ route('booking.redirect', ['unit_id' => $unit->id, 'unit_nama' => $unit->nama_tipe]) }}"
   target="_blank"   
   class="w-full bg-[#785838] text-[#f8f0e0] font-bold text-[10px] uppercase tracking-widest py-2.5 rounded-lg flex items-center justify-center hover:bg-[#6b4e30] transition-all">
   Booking Unit
</a>
@endif
                    </div>

                    {{-- desktop --}}
                    <div class="hidden sm:grid lg:grid-cols-12 gap-8 lg:gap-10">
                        <div class="lg:col-span-7 space-y-6 sm:space-y-8">
                            <div>
                                <h2 class="reveal-up text-4xl sm:text-5xl md:text-6xl font-bold text-[#0f3028] tracking-tighter font-serif italic">{{ strtoupper($unit->nama_tipe) }}</h2>
                                <p class="reveal-up text-[#785838] font-medium text-sm font-serif mt-1" style="transition-delay:.1s">{{ $unit->subtitle ?? 'Elegant & Modern' }}</p>
                            </div>
                            <p class="reveal-up text-[#3a2818] leading-relaxed text-sm lg:text-base" style="transition-delay:.2s">
                                {{ $unit->deskripsi }}
                                @if($unit->deskripsi_singkat)<span class="block mt-2 text-[#785838] italic text-xs">{{ $unit->deskripsi_singkat }}</span>@endif
                            </p>
                            <div class="grid grid-cols-4 gap-3">
                                @foreach($specs as $si2 => $spec)
                                <div class="reveal-scale bg-[#1a3a2a] border-l-[3px] border-[#d0b068] p-4 rounded-xl text-center shadow-md hover:-translate-y-1 transition-all" style="transition-delay:{{ .3+$si2*.1 }}s">
                                    <svg class="w-6 h-6 text-[#d0b068]/80 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $spec['icon'] }}"/></svg>
                                    <p class="text-[9px] font-bold text-[#d0b068]/80 tracking-widest uppercase mb-1">{{ $spec['label'] }}</p>
                                    <p class="text-xs font-bold text-[#f8f0e0]">{{ $spec['value'] }}</p>
                                </div>
                                @endforeach
                            </div>
                            @if(count($fasilitas) > 0)
                            <div class="space-y-3">
                                <p class="reveal-up font-bold text-[#0f3028] font-serif text-base flex items-center gap-2" style="transition-delay:.3s">Dilengkapi <span class="h-[1px] w-6 bg-[#c0a058]/40 inline-block"></span></p>
                                <div class="grid grid-cols-2 gap-y-3">
                                    <div class="flex flex-col gap-3">
                                        @foreach(array_slice($fasilitas,0,$half) as $fi=>$feat)
                                        <div class="reveal-up flex items-center gap-2" style="transition-delay:{{ .35+$fi*.07 }}s">
                                            <span class="w-6 h-6 rounded-full border-2 border-[#0f3028]/40 text-[#0f3028] text-[10px] flex items-center justify-center font-bold shrink-0">{{ $fi+1 }}</span>
                                            <span class="text-[#3a2818] text-sm font-medium">{{ $feat }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        @foreach(array_slice($fasilitas,$half) as $fi=>$feat)
                                        <div class="reveal-up flex items-center gap-2" style="transition-delay:{{ .35+($fi+$half)*.07 }}s">
                                            <span class="w-6 h-6 rounded-full border-2 border-[#0f3028]/40 text-[#0f3028] text-[10px] flex items-center justify-center font-bold shrink-0">{{ $fi+$half+1 }}</span>
                                            <span class="text-[#3a2818] text-sm font-medium">{{ $feat }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="lg:col-span-5 flex flex-col justify-center gap-5 sm:gap-8">
                            <div class="reveal-right" style="transition-delay:.2s">
                                <div class="bg-[#1a3a2a] rounded-[1rem] p-5 sm:p-8 border border-[#d0b068]/30 shadow-xl overflow-hidden group">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="text-[10px] font-bold text-[#d0b068]/70 uppercase tracking-[0.2em]">Denah Unit</span>
                                        <div class="h-[1px] flex-1 bg-gradient-to-r from-[#d0b068]/40 to-transparent"></div>
                                    </div>
                                    @if($unit->foto_3d_url)
                                    <img src="{{ $unit->foto_3d_url }}" alt="Denah {{ $unit->nama_tipe }}" class="w-full h-auto rounded-xl group-hover:scale-105 transition-transform duration-700" id="img_3d_{{ $unitKey }}">
                                    @else
                                    <div class="h-40 flex items-center justify-center text-[#d0b068]/30 text-xs rounded-xl" id="img_3d_{{ $unitKey }}">
                                        {{ $isDummy ? 'Upload foto denah di form kiri' : 'Denah belum tersedia' }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="reveal-up" style="transition-delay:.4s">
                                <a href="{{ route('contact.redirect', ['unit_id' => $unit->id, 'unit_nama' => $unit->nama_tipe]) }}"target="_blank" class="w-full bg-[#0f3028] text-[#d0b068] font-bold text-xs uppercase tracking-widest px-6 py-4 rounded-xl flex items-center justify-center hover:bg-[#1a3a2a] hover:scale-[1.02] transition-all border border-[#c0a058]/20 shadow-lg">Hubungi Kami</a>
                            </div>
                            @if($rentalUrl)
<div class="reveal-up" style="transition-delay:.5s">
    <a href="{{ route('booking.redirect', ['unit_id' => $unit->id, 'unit_nama' => $unit->nama_tipe]) }}"
       target="_blank" 
       class="w-full bg-[#785838] text-[#f8f0e0] font-bold text-xs uppercase tracking-widest px-6 py-4 rounded-xl flex items-center justify-center hover:bg-[#6b4e30] hover:scale-[1.02] transition-all shadow-lg">
       Booking Unit
    </a>
</div>
@endif
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- galeri --}}
<section class="pt-8 sm:pt-14 lg:pt-16 px-3 sm:px-10 md:px-16 lg:px-24 bg-[#0f3028]">
    <div class="max-w-7xl mx-auto pb-8 sm:pb-14">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 sm:gap-4 mb-5 sm:mb-10">
            <div class="reveal-up">
                <p class="text-[#d0b068]/60 text-[8px] sm:text-[10px] font-bold tracking-[0.4em] uppercase mb-1">{{ $galleryBadge }}</p>
                <h2 class="text-base sm:text-2xl md:text-3xl lg:text-4xl font-serif text-[#f8f0e0] leading-tight">{{ $galleryTitle }}</h2>
            </div>
            <div class="flex gap-1.5 sm:gap-2">
                @foreach($units as $i => $unit)
                <button onclick="switchGaleriUnit({{ $i }})" id="galeriBtnUnit-{{ $i }}"
                        class="galeri-unit-tab px-2.5 sm:px-4 py-1 sm:py-2 rounded-full text-[9px] sm:text-xs font-bold uppercase tracking-widest transition-all
                               {{ $i===0 ? 'bg-[#d0b068] text-[#0f3028]' : 'bg-[#f8f0e0]/10 text-[#e0d0b0]/50 hover:bg-[#f8f0e0]/20' }}">
                    {{ $unit->nama_tipe }}
                </button>
                @endforeach
            </div>
        </div>
        @foreach($units as $i => $unit)
        @php
            $isDummy     = is_null($unit->id);
            $galeriUrls  = $unit->galeri_foto_urls;
            $galeriCount = count($galeriUrls);
        @endphp
        <div id="galeriGrid-{{ $i }}" data-unit-id="{{ $unit->id ?? 'dummy' }}" class="{{ $i!==0 ? 'hidden' : '' }}">
            @if($galeriCount > 0)
            <div class="reveal-scale relative overflow-hidden rounded-xl galeri-frame">
                <div id="galeri-slides-{{ $i }}" class="flex h-full" style="transition:transform .7s cubic-bezier(.77,0,.175,1);transform:translateX(-100%);">
                    <div class="w-full h-full shrink-0 cursor-pointer" onclick="openLightbox('{{ $galeriUrls[$galeriCount-1] }}')">
                        <img src="{{ $galeriUrls[$galeriCount-1] }}" class="w-full h-full object-cover">
                    </div>
                    @foreach($galeriUrls as $gurl)
                    <div class="w-full h-full shrink-0 cursor-pointer" onclick="openLightbox('{{ $gurl }}')">
                        <img src="{{ $gurl }}" alt="Galeri {{ $unit->nama_tipe }}" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                    <div class="w-full h-full shrink-0 cursor-pointer" onclick="openLightbox('{{ $galeriUrls[0] }}')">
                        <img src="{{ $galeriUrls[0] }}" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="absolute inset-0 pointer-events-none" style="background:linear-gradient(to top,rgba(20,10,5,.3) 0%,transparent 40%);"></div>
                <button onclick="galeriPrev({{ $i }},{{ $galeriCount }})" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-7 h-7 sm:w-10 sm:h-10 bg-[#0f3028]/50 hover:bg-[#0f3028]/80 text-[#f8f0e0] rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="galeriNext({{ $i }},{{ $galeriCount }})" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-7 h-7 sm:w-10 sm:h-10 bg-[#0f3028]/50 hover:bg-[#0f3028]/80 text-[#f8f0e0] rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
                <div class="absolute top-2 sm:top-4 right-2 sm:right-4 bg-[#0f3028]/50 backdrop-blur-sm text-[#f8f0e0] text-[9px] sm:text-xs px-2 py-0.5 sm:px-3 sm:py-1 rounded-full">
                    <span id="galeri-counter-{{ $i }}">1</span>/{{ $galeriCount }}
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3 mt-2.5 sm:mt-4">
                <div class="flex gap-1 sm:gap-2">
                    @foreach($galeriUrls as $gi => $gurl)
                    <button onclick="galeriGoTo({{ $i }},{{ $gi }},{{ $galeriCount }},true)" class="galeri-dot-{{ $i }} rounded-full transition-all duration-300"
                            style="{{ $gi===0 ? 'background:#d0b068;width:16px;height:6px;' : 'background:rgba(240,232,216,.25);width:6px;height:6px;' }}"></button>
                    @endforeach
                </div>
                <div class="flex-1 h-[1px] bg-[#f8f0e0]/15 rounded-full overflow-hidden">
                    <div id="galeri-progress-{{ $i }}" style="width:0%;height:100%;background:#d0b068;opacity:.6;border-radius:9999px;transition:width linear;"></div>
                </div>
            </div>
            @else
            <div class="galeri-frame flex flex-col items-center justify-center rounded-xl bg-[#1a3a2a] gap-2">
                <svg class="w-10 h-10 text-[#d0b068]/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-[#d0b068]/50 text-sm">{{ $isDummy ? 'Upload foto galeri di form kiri' : 'Belum ada foto galeri' }}</p>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</section>

<div id="lightbox" class="fixed inset-0 bg-[#0f3028]/96 z-50 hidden items-center justify-center p-3" onclick="closeLightbox()">
    <button class="absolute top-3 right-3 sm:top-6 sm:right-6 text-[#e0d0b0]/60 hover:text-[#f8f0e0] text-xl sm:text-3xl" onclick="closeLightbox()">✕</button>
    <img id="lightbox-img" src="" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl" onclick="event.stopPropagation()">
</div>



<style>
.hero-img     { animation: heroZoom 1.8s ease forwards; transform-origin: center; }
.hero-overlay { animation: overlayIn 1.4s ease forwards; opacity: 0; }
@keyframes heroZoom  { from{transform:scale(1.08);}to{transform:scale(1);} }
@keyframes overlayIn { from{opacity:0;}to{opacity:1;} }
.hero-tag     { animation: fadeUp .7s ease forwards 1.2s; }
.hero-title-1 { animation: fadeUp .7s ease forwards 1.5s; }
.hero-title-2 { animation: fadeUp .7s ease forwards 1.8s; }
.hero-line    { animation: lineIn  .6s ease forwards 2.0s; }
.hero-desc    { animation: fadeUp .7s ease forwards 2.2s; }
.hero-scroll  { animation: fadeUp .6s ease forwards 2.5s; opacity: 0; }
.hero-scroll:hover .scroll-label { color: rgba(208,176,104,1) !important; }
.hero-scroll:hover .scroll-line  { height: 26px !important; background: rgba(208,176,104,.75) !important; }
.hero-scroll:hover .scroll-arrow { stroke: rgba(208,176,104,1) !important; }
@keyframes fadeUp { from{opacity:0;transform:translateY(18px);}to{opacity:1;transform:translateY(0);} }
@keyframes lineIn  { from{opacity:0;transform:scaleX(0);}to{opacity:1;transform:scaleX(1);} }
@keyframes bounce  { 0%,100%{transform:translateY(0);}50%{transform:translateY(4px);} }
.video-wrapper { aspect-ratio:16/9; min-height:160px; }
@media(min-width:768px){ .video-wrapper{min-height:320px;} }
.video-fade { opacity:0; transition:opacity 1.8s ease; }
.video-fade.visible { opacity:1; }
.galeri-frame { height:200px; }
@media(min-width:640px) { .galeri-frame{height:320px;} }
@media(min-width:1024px){ .galeri-frame{height:420px;} }
.reveal-up    { opacity:0;transform:translateY(24px);transition:opacity 1s ease,transform 1s cubic-bezier(.22,1,.36,1); }
.reveal-left  { opacity:0;transform:translateX(-40px);transition:opacity 1.1s ease,transform 1.1s cubic-bezier(.22,1,.36,1); }
.reveal-right { opacity:0;transform:translateX(40px);transition:opacity 1.1s ease,transform 1.1s cubic-bezier(.22,1,.36,1); }
.reveal-scale { opacity:0;transform:scale(.96);transition:opacity 1.1s ease,transform 1.1s cubic-bezier(.22,1,.36,1); }
.unit-card    { opacity:0;transform:translateY(32px);transition:opacity 1s ease,transform .9s cubic-bezier(.22,1,.36,1),box-shadow .3s; }
.reveal-up.visible,.reveal-left.visible,.reveal-right.visible,.reveal-scale.visible,.unit-card.visible { opacity:1!important;transform:none!important; }
.ls-line { display:block;overflow:hidden; }
.letter  { display:inline-block;transform:translateY(110%);opacity:0;transition:transform .8s cubic-bezier(.22,1,.36,1),opacity .6s ease; }
.letter.space { display:inline-block;width:.28em; }
.letter-stagger.visible .letter { transform:translateY(0);opacity:1; }
.scrollbar-hide::-webkit-scrollbar { display:none; }
.scrollbar-hide { -ms-overflow-style:none;scrollbar-width:none; }
.promo-frame { width:100%; overflow:hidden; }

@media (max-width:639px) {
    .unit-arrow { background: transparent !important; box-shadow: none !important; }
    .unit-arrow:active, .unit-arrow.tapped { background: rgba(15,48,40,.75) !important; color: #d0b068 !important; }
}
</style>




<script>
const UNIT_TOTAL  = {{ $unitTotal }};
const PROMO_COUNT = {{ $promoCount }};

const revealObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); revealObs.unobserve(e.target); } });
}, { threshold: 0.1 });

function makeInfinite(trackId, total, onJump) {
    return {
        real:0, total, sliding:false,
        track: document.getElementById(trackId),
        go(idx, animate=true) {
            if(this.sliding&&animate) return;
            this.real = ((idx%total)+total)%total;
            this.track.style.transition = animate?'transform .7s cubic-bezier(.77,0,.175,1)':'none';
            this.track.style.transform  = `translateX(-${(this.real+1)*100}%)`;
            if(onJump) onJump(this.real);
            if(animate){ this.sliding=true; setTimeout(()=>this.sliding=false,750); }
        },
        nav(dir) {
            if(this.sliding) return;
            this.sliding = true;
            const next    = ((this.real+dir)%total+total)%total;
            const isWrapR = dir>0 && this.real===total-1;
            const isWrapL = dir<0 && this.real===0;
            this.track.style.transition = 'transform .7s cubic-bezier(.77,0,.175,1)';
            if     (isWrapR) this.track.style.transform = `translateX(-${(total+1)*100}%)`;
            else if(isWrapL) this.track.style.transform = `translateX(0%)`;
            else             this.track.style.transform = `translateX(-${(next+1)*100}%)`;
            if(onJump) onJump(next);
            setTimeout(()=>{ this.real=next; this.track.style.transition='none'; this.track.style.transform=`translateX(-${(this.real+1)*100}%)`; this.sliding=false; },750);
        }
    };
}

function triggerDetailAnimations() {
    const track = document.getElementById('unit-track');
    if(!track) return;
    const slide = track.children[unitC.real+1];
    if(!slide) return;
    slide.querySelectorAll('.reveal-up,.reveal-right,.reveal-scale').forEach(el=>{
        el.classList.remove('visible'); void el.offsetWidth; revealObs.observe(el);
    });
}
const unitC = makeInfinite('unit-track', UNIT_TOTAL, idx => {
    document.querySelectorAll('.unit-nav-btn').forEach(b=>{ b.classList.remove('border-b-2','border-[#0f3028]','text-[#0f3028]'); b.classList.add('text-[#785838]/50'); });
    const btn = document.getElementById('btn-unit-'+idx);
    if(btn){ btn.classList.add('border-b-2','border-[#0f3028]','text-[#0f3028]'); btn.classList.remove('text-[#785838]/50'); }
    setTimeout(triggerDetailAnimations, 760);
});
function unitNav(dir){ unitC.nav(dir); }
function unitGoTo(idx){ unitC.go(idx); }

let promoReal = 0, promoSliding = false;
let promoDynamicCount = PROMO_COUNT; 
const promoTrack = document.getElementById('promo-track');

function promoUpdateDots(idx) {
    document.querySelectorAll('.promo-dot').forEach((d,i) => {
        d.style.background = i===idx ? '#d0b068' : 'rgba(240,232,216,.3)';
        d.style.width = i===idx ? '16px' : '6px';
    });
}
function promoGoTo(idx) {
    if (!promoTrack || promoDynamicCount <= 1) return;
    promoReal = idx;
    promoTrack.style.transition = 'transform .7s cubic-bezier(.77,0,.175,1)';
    promoTrack.style.transform = `translateX(-${(promoReal+1)*100}%)`;
    promoUpdateDots(idx);
}
function promoNav(dir) {
    if (!promoTrack || promoDynamicCount <= 1 || promoSliding) return;
    promoSliding = true;
    const next = ((promoReal+dir) % promoDynamicCount + promoDynamicCount) % promoDynamicCount;
    promoTrack.style.transition = 'transform .7s cubic-bezier(.77,0,.175,1)';
    if (dir>0 && promoReal===promoDynamicCount-1) promoTrack.style.transform = `translateX(-${(promoDynamicCount+1)*100}%)`;
    else if (dir<0 && promoReal===0)              promoTrack.style.transform = `translateX(0%)`;
    else                                          promoTrack.style.transform = `translateX(-${(next+1)*100}%)`;
    promoUpdateDots(next);
    setTimeout(() => {
        promoReal = next;
        promoTrack.style.transition = 'none';
        promoTrack.style.transform = `translateX(-${(promoReal+1)*100}%)`;
        promoSliding = false;
    }, 750);
}
const GALERI_AUTO=5000, GALERI_MANUAL=15000, galeriState={};
function galeriInit(key,total){ galeriState[key]={idx:0,total,timer:null,dur:GALERI_AUTO,sliding:false}; galeriStartProgress(key); }
function galeriUpdateDots(key,idx){
    document.querySelectorAll('.galeri-dot-'+key).forEach((d,i)=>{ d.style.backgroundColor=i===idx?'#d0b068':'rgba(240,232,216,.25)'; d.style.width=i===idx?'16px':'6px'; });
    const c=document.getElementById('galeri-counter-'+key); if(c) c.textContent=idx+1;
}
function galeriNav(key,total,dir){
    const s=galeriState[key]; if(!s||s.sliding) return; s.sliding=true; clearTimeout(s.timer);
    const next=((s.idx+dir)%total+total)%total;
    const track=document.getElementById('galeri-slides-'+key);
    if(!track){ s.sliding=false; return; }
    track.style.transition='transform .7s cubic-bezier(.77,0,.175,1)';
    if(dir>0&&s.idx===total-1) track.style.transform=`translateX(-${(total+1)*100}%)`;
    else if(dir<0&&s.idx===0)  track.style.transform=`translateX(0%)`;
    else                       track.style.transform=`translateX(-${(next+1)*100}%)`;
    galeriUpdateDots(key,next); s.dur=GALERI_MANUAL;
    setTimeout(()=>{ s.idx=next; track.style.transition='none'; track.style.transform=`translateX(-${(s.idx+1)*100}%)`; s.sliding=false; galeriStartProgress(key); },750);
}
function galeriGoTo(key,idx,total,isManual=false){
    const s=galeriState[key]; if(!s||s.sliding) return; s.sliding=true; clearTimeout(s.timer);
    const track=document.getElementById('galeri-slides-'+key);
    track.style.transition='transform .7s cubic-bezier(.77,0,.175,1)'; track.style.transform=`translateX(-${(idx+1)*100}%)`;
    galeriUpdateDots(key,idx); s.dur=isManual?GALERI_MANUAL:GALERI_AUTO;
    setTimeout(()=>{ s.idx=idx; track.style.transition='none'; track.style.transform=`translateX(-${(s.idx+1)*100}%)`; s.sliding=false; galeriStartProgress(key); },750);
}
function galeriNext(key,total){ galeriNav(key,total,1); }
function galeriPrev(key,total){ galeriNav(key,total,-1); }
function galeriStartProgress(key){
    const s=galeriState[key]; if(!s) return;
    const bar=document.getElementById('galeri-progress-'+key); if(!bar) return;
    bar.style.transition='none'; bar.style.width='0%';
    requestAnimationFrame(()=>requestAnimationFrame(()=>{ bar.style.transition=`width ${s.dur}ms linear`; bar.style.width='100%'; }));
    s.timer=setTimeout(()=>{ s.dur=GALERI_AUTO; galeriNav(key,s.total,1); },s.dur);
}
function switchGaleriUnit(idx){
    document.querySelectorAll('[id^="galeriGrid-"]').forEach(el=>el.classList.add('hidden'));
    document.getElementById('galeriGrid-'+idx).classList.remove('hidden');
    document.querySelectorAll('.galeri-unit-tab').forEach(b=>{ b.classList.remove('bg-[#d0b068]','text-[#0f3028]'); b.classList.add('bg-[#f8f0e0]/10','text-[#e0d0b0]/50'); });
    const ab=document.getElementById('galeriBtnUnit-'+idx);
    if(ab){ ab.classList.add('bg-[#d0b068]','text-[#0f3028]'); ab.classList.remove('bg-[#f8f0e0]/10','text-[#e0d0b0]/50'); }
    const s=galeriState[idx];
    if(s){ clearTimeout(s.timer); s.dur=GALERI_AUTO; s.idx=0; s.sliding=false;
        const track=document.getElementById('galeri-slides-'+idx);
        if(track){ track.style.transition='none'; track.style.transform='translateX(-100%)'; }
        galeriUpdateDots(idx,0); galeriStartProgress(idx); }
}
@foreach($units as $i => $unit)
@php $galeriFotoRaw = $unit->galeri_foto; if(is_string($galeriFotoRaw)) $galeriFotoRaw=json_decode($galeriFotoRaw,true)??[]; if(!is_array($galeriFotoRaw)) $galeriFotoRaw=[]; @endphp
@if(count($galeriFotoRaw) > 0)
galeriInit({{ $i }}, {{ count($galeriFotoRaw) }});
@endif
@endforeach

function openLightbox(src){ document.getElementById('lightbox-img').src=src; const lb=document.getElementById('lightbox'); lb.classList.remove('hidden'); lb.classList.add('flex'); document.body.style.overflow='hidden'; }
function closeLightbox(){ const lb=document.getElementById('lightbox'); lb.classList.add('hidden'); lb.classList.remove('flex'); document.body.style.overflow=''; }
document.addEventListener('keydown',e=>{ if(e.key==='Escape') closeLightbox(); });

function initLetterStagger(el){
    el.querySelectorAll('.ls-line').forEach(lineEl=>{
        const text=lineEl.textContent; lineEl.textContent='';
        Array.from(text).forEach((char,i)=>{
            const span=document.createElement('span');
            span.className=char===' '?'letter space':'letter';
            if(char!==' ') span.textContent=char;
            span.style.transitionDelay=Math.min(i*28,900)+'ms';
            lineEl.appendChild(span);
        });
    });
}
document.querySelectorAll('.letter-stagger').forEach(el=>initLetterStagger(el));
document.querySelectorAll('.reveal-up,.reveal-left,.reveal-right,.reveal-scale,.unit-card,.letter-stagger,.video-fade').forEach(el=>revealObs.observe(el));

function animateCount(el,target,dur){
    const start=performance.now();
    function step(now){ const p=Math.min((now-start)/dur,1),ease=1-Math.pow(1-p,4); el.textContent=Math.round(ease*target); if(p<1) requestAnimationFrame(step); else el.textContent=target; }
    requestAnimationFrame(step);
}
let countersCounted=false;
const countersObs=new IntersectionObserver(entries=>{
    entries.forEach(e=>{ if(e.isIntersecting&&!countersCounted){ countersCounted=true;
        [{ids:['counter-families','counter-families-d'],val:{{ $familyCount }},dur:2400},
         {ids:['counter-floors-m','counter-floors-d'],val:{{ $statFloors }},dur:1800},
         {ids:['counter-units-m','counter-units-d'],val:{{ $statUnits }},dur:2200},
         {ids:['counter-security-m','counter-security-d'],val:{{ $statSecurity }},dur:1600}]
        .forEach(t=>t.ids.forEach(id=>{ const el=document.getElementById(id); if(el) animateCount(el,t.val,t.dur); }));
    }});
},{threshold:0.3});
['counter-families','counter-families-d'].forEach(id=>{ const el=document.getElementById(id); if(el) countersObs.observe(el); });

document.querySelectorAll('.unit-arrow').forEach(btn => {
    btn.addEventListener('touchstart', () => btn.classList.add('tapped'), { passive: true });
    btn.addEventListener('touchend',   () => setTimeout(() => btn.classList.remove('tapped'), 300), { passive: true });
});

function toggleDesc(sid){
    const s=document.getElementById(sid+'-short'), f=document.getElementById(sid+'-full'),
          btn=document.getElementById(sid+'-btn-text'), icon=document.getElementById(sid+'-btn-icon');
    const open=!f.classList.contains('hidden');
    if(open){ f.classList.add('hidden'); s.classList.remove('hidden'); btn.textContent='Selengkapnya'; icon.style.transform='rotate(0deg)'; }
    else    { s.classList.add('hidden'); f.classList.remove('hidden'); btn.textContent='Sembunyikan';  icon.style.transform='rotate(180deg)'; }
}

window.addEventListener('message', function(e) {
    if (!e.data || e.data.type !== 'PREVIEW_IMG') return;
    const { key, src, target } = e.data;

    if (target === 'hero') {
        document.querySelectorAll('#img_hero').forEach(img => img.src = src);

    } else if (target === 'counting') {
        document.querySelectorAll('#img_counting, #img_counting_d').forEach(img => img.src = src);

    } else if (target === 'card') {
        const el  = document.getElementById('img_card_' + key);
        const elM = document.getElementById('img_card_m_' + key);
        if (el)  el.src = src;
        if (elM) elM.src = src;

    } else if (target === 'denah') {
        ['img_3d_' + key, 'img_3d_m_' + key].forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            if (el.tagName === 'IMG') {
                el.src = src;
            } else {
                const img = document.createElement('img');
                img.id = id; img.src = src;
                img.className = el.className;
                img.style.cssText = 'width:100%;height:auto;border-radius:.75rem;';
                el.replaceWith(img);
            }
        });
    } 
    else if (target === 'video') {
        document.querySelectorAll('.video-wrapper video').forEach(video => {
            video.src = src;
            video.load();
            video.play().catch(() => {});
        });

   } else if (target === 'promo_baru') {
    const srcs = e.data.srcs;
    const track = document.getElementById('promo-track');
    if (!track || !srcs || srcs.length === 0) return;

    const count = srcs.length;
    const frame = track.parentElement;

    frame.style.removeProperty('min-height');
    frame.style.aspectRatio = '16/9';

    track.innerHTML = '';
    track.style.cssText = 'display:flex;height:100%;transition:none;';

    const imgStyle = 'width:100%;height:100%;object-fit:cover;display:block;';
    const makeSlide = (src) => {
        const d = document.createElement('div');
        d.style.cssText = 'min-width:100%;height:100%;flex-shrink:0;';
        d.innerHTML = `<img src="${src}" style="${imgStyle}">`;
        return d;
    };

    if (count > 1) track.appendChild(makeSlide(srcs[count - 1]));
    srcs.forEach(s => track.appendChild(makeSlide(s)));
    if (count > 1) track.appendChild(makeSlide(srcs[0]));

    requestAnimationFrame(() => {
        track.style.transition = 'none';
        track.style.transform = count > 1 ? 'translateX(-100%)' : 'translateX(0%)';
        void track.offsetWidth;
    });

    
const btnPrev = document.getElementById('promo-btn-prev');
const btnNext = document.getElementById('promo-btn-next');
if (btnPrev) btnPrev.style.display = count > 1 ? '' : 'none';
if (btnNext) btnNext.style.display = count > 1 ? '' : 'none';

promoDynamicCount = count;
promoReal = 0;
promoSliding = false;

    const dotsContainer = document.getElementById('promo-dots');
    if (dotsContainer) {
        dotsContainer.innerHTML = '';
        if (count > 1) {
            srcs.forEach((_, i) => {
                const btn = document.createElement('button');
                btn.onclick = () => promoGoTo(i);
                btn.className = 'promo-dot rounded-full transition-all duration-300';
                btn.style.cssText = i === 0
                    ? 'background:#d0b068;width:16px;height:6px;'
                    : 'background:rgba(240,232,216,.3);width:6px;height:6px;';
                dotsContainer.appendChild(btn);
            });
        }
    }

    } else if (target === 'galeri_dummy') {
        const srcs = e.data.srcs;
        if (!srcs?.length) return;
        const count = srcs.length;
        const galeriGrid = document.getElementById('galeriGrid-' + (UNIT_TOTAL - 1));
        if (!galeriGrid) return;

        if (galeriState['dummy']) clearTimeout(galeriState['dummy'].timer);
        delete galeriState['dummy'];

        galeriGrid.classList.remove('hidden');
        document.querySelectorAll('[id^="galeriGrid-"]').forEach(el => {
            if (el !== galeriGrid) el.classList.add('hidden');
        });
        document.querySelectorAll('.galeri-unit-tab').forEach(b => {
            b.classList.remove('bg-[#d0b068]', 'text-[#0f3028]');
            b.classList.add('bg-[#f8f0e0]/10', 'text-[#e0d0b0]/50');
        });
        const dummyTab = document.getElementById('galeriBtnUnit-' + (UNIT_TOTAL - 1));
        if (dummyTab) {
            dummyTab.classList.add('bg-[#d0b068]', 'text-[#0f3028]');
            dummyTab.classList.remove('bg-[#f8f0e0]/10', 'text-[#e0d0b0]/50');
        }

        galeriGrid.innerHTML = `
            <div class="relative overflow-hidden rounded-xl galeri-frame">
                <div id="galeri-slides-dummy" class="flex" style="height:200px;transition:transform .7s cubic-bezier(.77,0,.175,1);transform:translateX(-100%);">
                    <div style="width:100%;height:200px;flex-shrink:0;"><img src="${srcs[count-1] || srcs[0]}" style="width:100%;height:200px;object-fit:cover;display:block;"></div>
                    ${srcs.map(s => `<div style="width:100%;height:200px;flex-shrink:0;cursor:pointer;"><img src="${s}" style="width:100%;height:200px;object-fit:cover;display:block;"></div>`).join('')}
                    <div style="width:100%;height:200px;flex-shrink:0;"><img src="${srcs[0] || ''}" style="width:100%;height:200px;object-fit:cover;display:block;"></div>
                </div>
                <div class="absolute inset-0 pointer-events-none" style="background:linear-gradient(to top,rgba(20,10,5,.3) 0%,transparent 40%);"></div>
                <button onclick="galeriPrev('dummy',${count})" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-7 h-7 sm:w-10 sm:h-10 bg-[#0f3028]/50 hover:bg-[#0f3028]/80 text-[#f8f0e0] rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="galeriNext('dummy',${count})" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-7 h-7 sm:w-10 sm:h-10 bg-[#0f3028]/50 hover:bg-[#0f3028]/80 text-[#f8f0e0] rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
                <div class="absolute top-2 sm:top-4 right-2 sm:right-4 bg-[#0f3028]/50 backdrop-blur-sm text-[#f8f0e0] text-[9px] sm:text-xs px-2 py-0.5 sm:px-3 sm:py-1 rounded-full">
                    <span id="galeri-counter-dummy">1</span>/${count}
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3 mt-2.5 sm:mt-4">
                <div class="flex gap-1 sm:gap-2" id="galeri-dots-dummy">
                    ${srcs.map((_, i) => `<button onclick="galeriGoTo('dummy',${i},${count},true)" class="galeri-dot-dummy rounded-full transition-all duration-300" style="${i===0?'background:#d0b068;width:16px;height:6px;':'background:rgba(240,232,216,.25);width:6px;height:6px;'}"></button>`).join('')}
                </div>
                <div class="flex-1 h-[1px] bg-[#f8f0e0]/15 rounded-full overflow-hidden">
                    <div id="galeri-progress-dummy" style="width:0%;height:100%;background:#d0b068;opacity:.6;border-radius:9999px;transition:width linear;"></div>
                </div>
            </div>`;

        requestAnimationFrame(() => galeriInit('dummy', count));

    } else if (target === 'galeri_unit') {
        const srcs = e.data.srcs;
        const unitId = String(e.data.unitId);

        const grid = document.querySelector(`[data-unit-id="${unitId}"][id^="galeriGrid-"]`);
        if (!grid) return;

        const targetIdx = parseInt(grid.id.replace('galeriGrid-', ''));

        if (!srcs || srcs.length === 0) {
            grid.innerHTML = `
                <div class="galeri-frame flex flex-col items-center justify-center rounded-xl bg-[#1a3a2a] gap-2">
                    <p class="text-[#d0b068]/50 text-sm">Belum ada foto galeri</p>
                </div>`;
            if (galeriState[targetIdx]) {
                clearTimeout(galeriState[targetIdx].timer);
                delete galeriState[targetIdx];
            }
            return;
        }

        const count = srcs.length;
        if (galeriState[targetIdx]) {
            clearTimeout(galeriState[targetIdx].timer);
            delete galeriState[targetIdx];
        }

        grid.innerHTML = `
    <div style="position:relative;overflow:hidden;border-radius:.75rem;height:200px;" class="galeri-frame">
        <div id="galeri-slides-${targetIdx}" style="display:flex;height:200px;transition:transform .7s cubic-bezier(.77,0,.175,1);transform:translateX(-100%);">
            <div style="min-width:100%;height:200px;flex-shrink:0;"><img src="${srcs[count-1]}" style="width:100%;height:200px;object-fit:cover;display:block;"></div>
            ${srcs.map(s => `<div style="min-width:100%;height:200px;flex-shrink:0;cursor:pointer;"><img src="${s}" style="width:100%;height:200px;object-fit:cover;display:block;"></div>`).join('')}
            <div style="min-width:100%;height:200px;flex-shrink:0;"><img src="${srcs[0]}" style="width:100%;height:200px;object-fit:cover;display:block;"></div>
        </div>
        <button onclick="galeriPrev(${targetIdx},${count})" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-7 h-7 sm:w-10 sm:h-10 bg-[#0f3028]/50 hover:bg-[#0f3028]/80 text-[#f8f0e0] rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button onclick="galeriNext(${targetIdx},${count})" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-7 h-7 sm:w-10 sm:h-10 bg-[#0f3028]/50 hover:bg-[#0f3028]/80 text-[#f8f0e0] rounded-full flex items-center justify-center backdrop-blur-sm transition-all">
            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
        <div class="absolute top-2 sm:top-4 right-2 sm:right-4 bg-[#0f3028]/50 backdrop-blur-sm text-[#f8f0e0] text-[9px] sm:text-xs px-2 py-0.5 sm:px-3 sm:py-1 rounded-full">
            <span id="galeri-counter-${targetIdx}">1</span>/${count}
        </div>
    </div>
    <div class="flex items-center gap-2 sm:gap-3 mt-2.5 sm:mt-4">
        <div class="flex gap-1 sm:gap-2">
            ${srcs.map((_,i) => `<button onclick="galeriGoTo(${targetIdx},${i},${count},true)" class="galeri-dot-${targetIdx} rounded-full transition-all duration-300" style="${i===0?'background:#d0b068;width:16px;height:6px;':'background:rgba(240,232,216,.25);width:6px;height:6px;'}"></button>`).join('')}
        </div>
        <div class="flex-1 h-[1px] bg-[#f8f0e0]/15 rounded-full overflow-hidden">
            <div id="galeri-progress-${targetIdx}" style="width:0%;height:100%;background:#d0b068;opacity:.6;border-radius:9999px;transition:width linear;"></div>
        </div>
    </div>`;

        requestAnimationFrame(() => galeriInit(targetIdx, count));
    }   
});  
</script>

@endsection