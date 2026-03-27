@extends('layouts.user.main')

@section('title', 'Layanan Cleaning Order')

@push('styles')
@vite(['resources/css/user/layanan.css'])
@endpush

@push('scripts')
@vite(['resources/js/user/layanan.js'])
@endpush

@section('content')

@php
    $co      = $layanan->first();
 
    $fotoUrl = function(?string $path) {
        if (!$path) return null;
        return str_starts_with($path, 'assets/')
            ? asset($path)
            : \Illuminate\Support\Facades\Storage::url($path);
    };
    $preview     = request()->query('_preview') === '1' ? session('co_preview') : null;
    $isPreview   = !empty($preview);
 
    //Hero
    $heroPath    = ($isPreview && !empty($preview['foto_hero_temp']))
                    ? $preview['foto_hero_temp']
                    : ($co->foto_hero ?? null);
    $fotoHero    = $fotoUrl($heroPath) ?? asset('assets/img/promo.jpg');
 
    //Slideshow
    $rawSlide    = $co->foto_slide ?? [];
    if ($isPreview) {
        $hapusSlide  = array_map('intval', $preview['hapus_slide'] ?? []);
        $rawSlide    = array_values(array_filter(
            $rawSlide,
            fn($_, $i) => !in_array($i, $hapusSlide),
            ARRAY_FILTER_USE_BOTH
        ));
        foreach ($preview['foto_slide_temp'] ?? [] as $p) {
            $rawSlide[] = $p;
        }
    }
    $fotoSlide = array_values(array_filter(array_map(function($p) use ($fotoUrl) {
    if (!$p) return null;
    return $fotoUrl($p);
}, $rawSlide)));
    $adaSlide    = count($fotoSlide) > 0;
 
    //Galeri
    $rawGaleri   = $co->foto_galeri ?? [];
    if ($isPreview) {
        $hapusGaleri = array_map('intval', $preview['hapus_galeri'] ?? []);
        $rawGaleri   = array_values(array_filter(
            $rawGaleri,
            fn($_, $i) => !in_array($i, $hapusGaleri),
            ARRAY_FILTER_USE_BOTH
        ));
        foreach ($preview['foto_galeri_temp'] ?? [] as $p) {
            $rawGaleri[] = $p;
        }
    }
    $fotoGaleri = array_values(array_filter(array_map(function($p) use ($fotoUrl) {
    if (!$p) return null;
    return $fotoUrl($p);
}, $rawGaleri)));
    if (empty($fotoGaleri)) { $fotoGaleri = $fotoSlide; }
 
    //Tarif & Ketentuan 
    $tarifCleaning = $preview['tarif_cleaning'] ?? $co?->tarif_cleaning ?? [];
    $tarifCuci     = $preview['tarif_cuci']     ?? $co?->tarif_cuci     ?? [];
    $tarifTambahan = $preview['tarif_tambahan'] ?? $co?->tarif_tambahan ?? [];
    $tarifBerkala  = $preview['tarif_berkala']  ?? $co?->tarif_berkala  ?? [];
    $ketentuan     = $preview['ketentuan']      ?? $co?->ketentuan      ?? [];
 
    $isPreviewMode = $isPreview;
@endphp

<script>
    (function(){
        document.addEventListener('DOMContentLoaded', function() {
            var nav = document.getElementById('main-nav');
            if (!nav) return;
            nav.querySelectorAll('.nav-link').forEach(function(l){ l.style.color = ''; });
            var hamburger = nav.querySelectorAll('.hamburger-line');
            hamburger.forEach(function(l){ l.style.backgroundColor = ''; });
        });
    })();
</script>

<div style="font-family: 'Palatino Linotype', 'Book Antiqua', 'Palatino', Georgia, serif;">

    @if($isPreviewMode && request()->query('_preview') === '1')
    <div style="position:fixed; top:0; left:0; right:0; z-index:9999; background:#f59e0b; color:#1c1c1c; font-size:11px; font-weight:700; text-align:center; padding:5px; letter-spacing:.05em;">
        PREVIEW MODE — Perubahan belum tersimpan ke database
    </div>
    <div style="height:27px;"></div>
    @endif


    <div style="background:#0f3028;">

        {{-- Hero --}}
        <section class="co-hero relative w-full flex items-center overflow-hidden" style="min-height:62vh;">
            <div class="absolute inset-0 z-0">
                <img src="{{ $fotoHero }}"
                     alt="Cleaning Order Bale Hinggil"
                     class="co-hero-img w-full h-full object-cover object-center">
                
                <div class="absolute inset-0" style="background:rgba(10,18,10,0.52);"></div>
                <div class="absolute inset-0" style="background:linear-gradient(135deg,rgba(10,18,10,0.70) 0%,rgba(10,18,10,0.20) 60%,transparent 100%);"></div>
                
                <div class="absolute bottom-0 left-0 right-0 z-10" style="height:80px;background:linear-gradient(to bottom,transparent,#0f3028);"></div>
            </div>

            <div class="relative z-20 px-5 sm:px-10 md:px-16 lg:px-24 w-full pt-20 pb-16 sm:pt-28 sm:pb-20">
                <div class="max-w-xl space-y-3 sm:space-y-5">
                    <p class="text-[#c5a059]/70 text-[10px] sm:text-xs font-bold tracking-[0.35em] uppercase"
                       style="opacity:0;animation:coFadeUp 0.7s ease forwards 0.8s;">
                        Layanan Bale Hinggil
                    </p>
                    <h1 class="font-serif leading-snug">
                        <span class="block text-xl sm:text-4xl md:text-5xl text-[#d0b068]"
                              style="opacity:0;animation:coFadeUp 0.7s ease forwards 1.1s;">
                            Cleaning Order
                        </span>
                        <span class="block text-sm sm:text-2xl md:text-3xl italic font-light mt-1 text-[#f8f0e0]/85"
                              style="opacity:0;animation:coFadeUp 0.7s ease forwards 1.35s;">
                            Bersih Maksimal, Nyaman Total
                        </span>
                    </h1>
                    <div class="w-14 h-[1px] bg-[#c5a059]/60 origin-left"
                         style="opacity:0;animation:coLineIn 0.6s ease forwards 1.6s;"></div>
                    <p class="text-[#e0d0b0]/75 text-[11px] sm:text-sm md:text-base max-w-sm md:max-w-md leading-relaxed font-light"
                       style="opacity:0;animation:coFadeUp 0.7s ease forwards 1.8s;">
                        Percayakan kebersihan unit Anda kepada tim profesional kami —
                        <span class="text-[#f8f0e0] font-medium">terlatih, bersertifikasi,</span>
                        dan hadir tepat waktu.
                    </p>
                    <div style="opacity:0;animation:coFadeUp 0.7s ease forwards 2.0s;">
                        <a href="https://wa.me/62895324255322?text={{ urlencode('Halo Admin Bale Hinggil, saya ingin menanyakan layanan Cleaning Order.') }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 bg-[#c5a059] text-[#0f3028] font-bold text-[10px] sm:text-xs uppercase tracking-widest px-5 sm:px-7 py-2.5 sm:py-3 rounded-full hover:bg-[#d4b468] transition-all duration-300 shadow-lg hover:scale-[1.03]">
                            Pesan Sekarang
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Yang Kami Kerjakan --}}
        <section id="section-layanan" class="w-full pt-2 pb-10 sm:pb-14 px-5 sm:px-10 md:px-16 lg:px-24 scroll-mt-10">
            <div class="max-w-5xl mx-auto">
                <div class="reveal text-center mb-8 sm:mb-12">
                    <p class="text-[#c5a059]/70 text-[10px] sm:text-xs tracking-[0.3em] uppercase font-medium mb-2">Apa yang Kami Kerjakan</p>
                    <h2 class="text-[#f8f0e0] font-serif text-base sm:text-2xl md:text-3xl italic mb-3">Layanan <span class="text-[#d0b068]">Cleaning Order</span></h2>
                    <div class="w-10 h-[1px] bg-[#c5a059]/40 mx-auto"></div>
                </div>

                <div class="flex justify-center items-start gap-4 sm:gap-8 md:gap-12 lg:gap-16 px-4">
                    @foreach([
                        ['icon'=>'assets/img/co1.svg','text'=>'Pembersihan Menyeluruh',      'sub'=>'Dalam & luar unit',    'bg'=>'#1a4a30','panel'=>1],
                        ['icon'=>'assets/img/co2.svg','text'=>'Cuci Sofa, Kasur, & Furnitur','sub'=>'Dengan mesin blower',  'bg'=>'#234d38','panel'=>2],
                        ['icon'=>'assets/img/co3.svg','text'=>'Perawatan Berkala',            'sub'=>'Terjadwal & terpantau','bg'=>'#2d5c3a','panel'=>3],
                    ] as $index => $item)
                    <div class="reveal co-service-card flex flex-col items-center text-center cursor-pointer group"
                         style="transition-delay:{{ $index*100 }}ms;flex:1 1 0;min-width:0;max-width:200px;gap:12px;"
                         onclick="bukaSpesifikPanel({{ $item['panel'] }});setTimeout(()=>document.getElementById('section-panels').scrollIntoView({behavior:'smooth'}),100);"
                         tabindex="0">
                        <div class="perspective co-card-box" style="aspect-ratio:1;width:clamp(80px,12vw,120px);">
                            <div class="relative w-full h-full duration-700 transform-style preserve-3d group-hover:rotate-y-180">
                                <div class="absolute w-full h-full rounded-2xl flex items-center justify-center backface-hidden border border-[#c5a059]/25 shadow-md transition-all duration-300"
                                     style="background-color:{{ $item['bg'] }}">
                                    <img src="{{ asset($item['icon']) }}" style="width:clamp(28px,4vw,44px);">
                                </div>
                                <div class="absolute w-full h-full rounded-2xl flex items-center justify-center rotate-y-180 backface-hidden bg-[#c5a059] text-[#0f3028] font-bold px-2 text-center leading-tight"
                                     style="font-size:clamp(9px,1.4vw,12px);">
                                    {{ $item['text'] }}
                                </div>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[#f8f0e0] font-medium leading-tight group-hover:text-[#d0b068] transition-colors duration-300 text-xs sm:text-sm md:text-base">{{ $item['text'] }}</p>
                            <p class="text-[#c5a059]/70 italic text-[9px] sm:text-[10px]">{{ $item['sub'] }}</p>
                            <p class="text-[#c5a059]/35 group-hover:text-[#c5a059]/65 transition-colors duration-300 text-[8px] sm:text-[9px] italic tracking-wide mt-1">
                                Ketuk untuk detail
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>

    {{-- Promo Slideshow --}}
    @if($adaSlide)
    <section class="w-full py-8 sm:py-12 earthy-light" style="background:#f2e8d4;">
        <div class="px-5 sm:px-10 md:px-16 lg:px-24">
            <div class="reveal flex items-center gap-3 mb-5">
                <div class="w-5 h-[1px] bg-[#c5a059]/60"></div>
                <p class="text-[#785838] text-[10px] sm:text-xs tracking-[0.4em] uppercase font-bold">Penawaran Terbatas</p>
                <div class="flex-1 h-[1px] bg-[#c5a059]/20"></div>
            </div>
            <div class="reveal relative overflow-hidden rounded-2xl shadow-xl">
                <div id="slides" style="display:flex;transition:transform .5s cubic-bezier(.77,0,.175,1);">
                    @foreach($fotoSlide as $foto)
                    <div class="min-w-full" style="position:relative;overflow:hidden;height:clamp(200px,55vh,65vh);">
                        <img src="{{ $foto }}" class="w-full h-full block" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;">
                    </div>
                    @endforeach
                </div>
                <button onclick="prevSlide()"
                        class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 bg-[#0f3028]/60 text-[#d0b068] w-9 h-9 sm:w-11 sm:h-11 rounded-full flex items-center justify-center hover:bg-[#0f3028] transition-all duration-300 backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="nextSlide()"
                        class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 bg-[#0f3028]/60 text-[#d0b068] w-9 h-9 sm:w-11 sm:h-11 rounded-full flex items-center justify-center hover:bg-[#0f3028] transition-all duration-300 backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2" id="slide-dots">
                    @foreach($fotoSlide as $si => $foto)
                    <button onclick="goToSlide({{ $si }})"
                            class="slide-dot rounded-full transition-all duration-300"
                            style="{{ $si===0?'background:#d0b068;width:18px;height:7px;':'background:rgba(240,232,216,.5);width:7px;height:7px;' }}">
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Panel --}}
    <section id="section-panels" class="relative earthy-light" style="background:#eee0c8;">

        <div class="py-8 sm:py-12 px-5 sm:px-10 md:px-16 lg:px-24">
            <div class="max-w-6xl mx-auto">
                <div class="reveal flex items-center gap-4 mb-3">
                    <div class="w-6 h-[1px] bg-[#c5a059]/60"></div>
                    <p class="text-[#785838] text-[10px] sm:text-xs tracking-[0.35em] uppercase font-bold">Informasi Tarif</p>
                </div>
                <h2 class="reveal text-[#0f3028] font-serif text-lg sm:text-2xl md:text-3xl lg:text-4xl italic">
                    Pilih Layanan <span class="text-[#785838]">Sesuai Kebutuhan</span>
                </h2>
                <p class="reveal text-[#685028]/70 text-[11px] sm:text-sm md:text-base mt-3 max-w-xl leading-relaxed font-light" style="transition-delay:.15s">
                    Klik pada setiap panel untuk melihat detail tarif dan layanan yang tersedia.
                </p>
            </div>
        </div>

        <div class="w-full relative">

            {{-- Panel 1: Tarif Cleaning Unit --}}
            <div id="p1" class="stack-panel panel-h w-full rounded-t-[40px] md:rounded-t-[60px] overflow-hidden" style="background:#183326;">
                <div class="panel-trigger absolute inset-x-0 top-0 bottom-0 flex items-center px-6 md:px-20 lg:px-24 cursor-pointer z-10 select-none"
                     onclick="togglePanel('p1')">
                    <div class="flex items-center justify-between w-full max-w-6xl mx-auto">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-[1px] bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-sm md:text-base uppercase tracking-[0.2em] font-medium">Tarif Cleaning Unit</p>
                        </div>
                        <div class="panel-chevron text-[#c5a059]/60 text-2xl transition-transform duration-500">›</div>
                    </div>
                </div>
                <div class="p1-content opacity-0 transition-opacity duration-500 pt-12 pb-12 px-6 md:px-20 lg:px-24">
                    <div class="max-w-6xl mx-auto">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-[1px] bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-sm sm:text-base uppercase tracking-[0.35em]">Tarif Cleaning Unit</p>
                        </div>
                        @if(count($tarifCleaning))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-12">
                            @foreach($tarifCleaning as $r)
                            <div class="tarif-card group relative rounded-xl px-5 py-4 border border-[#c5a059]/15 hover:border-[#c5a059]/40 transition-all duration-300"
                                 style="background:rgba(255,255,255,0.04);">
                                <div class="absolute left-0 top-4 bottom-4 w-[3px] rounded-full bg-[#c5a059]/40 group-hover:bg-[#c5a059] transition-colors duration-300"></div>
                                <div class="flex items-start justify-between gap-3 mb-2.5 pl-3">
                                    <div>
                                        <p class="text-white font-serif text-sm lg:text-base font-medium leading-tight">{{ $r['type'] }}</p>
                                        <p class="text-[#c5a059]/70 text-xs italic mt-0.5">{{ $r['kondisi'] }}</p>
                                    </div>
                                    <span class="text-[#c5a059] font-serif text-lg lg:text-xl font-semibold shrink-0 leading-tight">{{ $r['tarif'] }}</span>
                                </div>
                                <div class="pl-3 mb-3"><div class="border-t border-dashed border-white/10"></div></div>
                                <div class="flex items-center gap-6 pl-3">
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span class="text-gray-300 text-xs sm:text-sm">{{ $r['petugas'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/></svg>
                                        <span class="text-gray-300 text-xs sm:text-sm">{{ $r['durasi'] }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if(count($tarifTambahan))
                        <div class="flex items-center gap-3 mb-5">
                            <div class="h-[1px] w-5 bg-[#c5a059]/40"></div>
                            <p class="text-[#c5a059]/80 text-xs uppercase tracking-[0.3em]">Tarif Tambahan · per area</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($tarifTambahan as $t)
                            <div class="flex items-center justify-between rounded-xl px-4 py-3 border border-[#c5a059]/12 hover:border-[#c5a059]/35 transition-all duration-300"
                                 style="background:rgba(255,255,255,0.03);">
                                <div>
                                    <p class="text-white text-sm lg:text-base font-medium">{{ $t['area'] }}</p>
                                    <p class="text-gray-400 text-xs mt-0.5">{{ $t['petugas'] ?? '' }}@if(!empty($t['petugas']) && !empty($t['durasi'])) · @endif{{ $t['durasi'] }}</p>
                                </div>
                                <span class="text-[#c5a059] font-serif font-semibold text-base lg:text-lg ml-3 shrink-0">{{ $t['tarif'] }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @if(!count($tarifCleaning) && !count($tarifTambahan))
                        <div class="flex flex-col items-center justify-center text-center py-12 gap-4">
                            <div class="relative flex items-center justify-center mb-2">
                                <div class="absolute w-16 h-16 rounded-full bg-[#c5a059]/10 animate-ping" style="animation-duration:2.5s;"></div>
                                <div class="relative w-14 h-14 rounded-full border border-[#c5a059]/30 flex items-center justify-center">
                                    <svg class="w-7 h-7 text-[#c5a059]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-white font-serif text-base italic">Segera Hadir</p>
                            <p class="text-gray-300 text-sm max-w-xs leading-relaxed mx-auto">Informasi tarif cleaning unit sedang dalam persiapan.</p>
                            <a href="https://wa.me/62895324255322?text={{ urlencode('Halo Admin Bale Hinggil, saya ingin menanyakan layanan Cleaning Unit.') }}" target="_blank"
                               class="border border-[#c5a059]/50 text-[#c5a059] text-sm px-7 py-2.5 rounded-full uppercase tracking-widest hover:bg-[#c5a059] hover:text-black transition-all duration-300">
                                Tanya via WhatsApp
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Panel 2: Cuci Sofa, Bed & Karpet --}}
            <div id="p2" class="stack-panel panel-h panel-overlap w-full rounded-t-[40px] md:rounded-t-[60px] overflow-hidden" style="background:#1f3d2b;">
                <div class="panel-trigger absolute inset-x-0 top-0 bottom-0 flex items-center px-6 md:px-20 lg:px-24 cursor-pointer z-10 select-none"
                     onclick="togglePanel('p2')">
                    <div class="flex items-center justify-between w-full max-w-6xl mx-auto">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-[1px] bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-sm md:text-base uppercase tracking-[0.2em] font-medium">Cuci Sofa, Bed & Karpet</p>
                        </div>
                        <div class="panel-chevron text-[#c5a059]/60 text-2xl transition-transform duration-500">›</div>
                    </div>
                </div>
                <div class="p2-content opacity-0 transition-opacity duration-500 pt-12 pb-12 px-6 md:px-20 lg:px-24">
                    <div class="max-w-6xl mx-auto">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-[1px] bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-sm sm:text-base uppercase tracking-[0.25em]">Cuci Sofa, Bed & Karpet</p>
                        </div>
                        @if(count($tarifCuci))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach($tarifCuci as $item)
                            <div class="tarif-card group relative rounded-xl px-5 py-4 border border-[#c5a059]/15 hover:border-[#c5a059]/40 transition-all duration-300"
                                 style="background:rgba(255,255,255,0.04);">
                                <div class="absolute left-0 top-4 bottom-4 w-[3px] rounded-full bg-[#c5a059]/40 group-hover:bg-[#c5a059] transition-colors duration-300"></div>
                                <div class="flex items-start justify-between gap-3 pl-3">
                                    <div>
                                        <p class="text-white font-serif text-sm lg:text-base font-medium leading-tight">{{ $item['nama'] }}</p>
                                        <p class="text-gray-300 text-xs mt-1 italic">{{ $item['satuan'] }} · {{ $item['durasi'] }}</p>
                                    </div>
                                    <span class="text-[#c5a059] font-serif text-base lg:text-lg font-semibold shrink-0 leading-tight">{{ $item['tarif'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-2 mt-6">
                            <span class="text-[#c5a059]/50 text-sm">✦</span>
                            <p class="text-gray-400 text-xs sm:text-sm italic">Dikerjakan di luar unit menggunakan mesin pengering (blower)</p>
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center text-center py-12 gap-4">
                            <div class="relative flex items-center justify-center mb-2">
                                <div class="absolute w-16 h-16 rounded-full bg-[#c5a059]/10 animate-ping" style="animation-duration:2.5s;"></div>
                                <div class="relative w-14 h-14 rounded-full border border-[#c5a059]/30 flex items-center justify-center">
                                    <svg class="w-7 h-7 text-[#c5a059]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-white font-serif text-base italic">Segera Hadir</p>
                            <p class="text-gray-300 text-sm max-w-xs leading-relaxed mx-auto">Informasi tarif cuci sofa, bed & karpet sedang dalam persiapan.</p>
                            <a href="https://wa.me/62895324255322?text={{ urlencode('Halo Admin Bale Hinggil, saya ingin menanyakan layanan Cuci Sofa, Bed & Karpet.') }}" target="_blank"
                               class="border border-[#c5a059]/50 text-[#c5a059] text-sm px-7 py-2.5 rounded-full uppercase tracking-widest hover:bg-[#c5a059] hover:text-black transition-all duration-300">
                                Tanya via WhatsApp
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Panel 3: Perawatan Berkala --}}
            <div id="p3" class="stack-panel panel-h panel-overlap w-full rounded-t-[40px] md:rounded-t-[60px] overflow-hidden" style="background:#274a34;">
                <div class="panel-trigger absolute inset-x-0 top-0 bottom-0 flex items-center px-6 md:px-20 lg:px-24 cursor-pointer z-10 select-none"
                     onclick="togglePanel('p3')">
                    <div class="flex items-center justify-between w-full max-w-6xl mx-auto">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-[1px] bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-sm md:text-base uppercase tracking-[0.2em] font-medium">Perawatan Berkala</p>
                        </div>
                        <div class="panel-chevron text-[#c5a059]/60 text-2xl transition-transform duration-500">›</div>
                    </div>
                </div>
                <div class="p3-content opacity-0 transition-opacity duration-500 pt-12 pb-12 px-6 md:px-20 lg:px-24">
                    <div class="max-w-6xl mx-auto">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-[1px] bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-sm sm:text-base uppercase tracking-[0.25em]">Perawatan Berkala</p>
                        </div>
                        @if(count($tarifBerkala))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach($tarifBerkala as $item)
                            <div class="tarif-card group relative rounded-xl px-5 py-4 border border-[#c5a059]/15 hover:border-[#c5a059]/40 transition-all duration-300"
                                 style="background:rgba(255,255,255,0.04);">
                                <div class="absolute left-0 top-4 bottom-4 w-[3px] rounded-full bg-[#c5a059]/40 group-hover:bg-[#c5a059] transition-colors duration-300"></div>
                                <div class="flex items-start justify-between gap-3 mb-2.5 pl-3">
                                    <div>
                                        <p class="text-white font-serif text-sm lg:text-base font-medium leading-tight">{{ $item['nama'] }}</p>
                                        <p class="text-gray-300 text-xs mt-1 italic">{{ $item['satuan'] }} · {{ $item['durasi'] }}</p>
                                    </div>
                                    <span class="text-[#c5a059] font-serif text-base lg:text-lg font-semibold shrink-0 leading-tight">{{ $item['tarif'] }}</span>
                                </div>
                                @if(!empty($item['petugas']))
                                <div class="pl-3 mb-3"><div class="border-t border-dashed border-white/10"></div></div>
                                <div class="flex items-center gap-1.5 pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="text-gray-300 text-xs sm:text-sm">{{ $item['petugas'] }}</span>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center text-center py-12 gap-4">
                            <div class="relative flex items-center justify-center mb-2">
                                <div class="absolute w-16 h-16 rounded-full bg-[#c5a059]/10 animate-ping" style="animation-duration:2.5s;"></div>
                                <div class="relative w-14 h-14 rounded-full border border-[#c5a059]/30 flex items-center justify-center">
                                    <svg class="w-7 h-7 text-[#c5a059]/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-white font-serif text-base italic">Segera Hadir</p>
                            <p class="text-gray-300 text-sm max-w-xs leading-relaxed mx-auto">Paket perawatan berkala sedang dalam persiapan.</p>
                            <a href="https://wa.me/62895324255322?text={{ urlencode('Halo Admin Bale Hinggil, saya ingin menanyakan layanan Perawatan Berkala.') }}" target="_blank"
                               class="border border-[#c5a059]/50 text-[#c5a059] text-sm px-7 py-2.5 rounded-full uppercase tracking-widest hover:bg-[#c5a059] hover:text-black transition-all duration-300">
                                Tanya via WhatsApp
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Panel 4: CTA Selengkapnya --}}
            <div id="p4" class="stack-panel panel-overlap w-full rounded-t-[40px] md:rounded-t-[60px] overflow-hidden"
                 style="height:280px;background:linear-gradient(135deg,#f7f0e3 0%,#fdf6e8 60%,#f0e6cc 100%);border-top:1px solid rgba(197,160,89,0.25);">
                <div class="max-w-6xl mx-auto text-center flex flex-col items-center justify-center h-full px-6" style="gap:14px;">
                    <p class="p4-animate text-[#a8852f] text-[10px] sm:text-xs md:text-sm uppercase tracking-[0.3em]"
                       style="opacity:0;transform:translateY(16px);transition:opacity 0.6s ease-out,transform 0.6s ease-out;">
                        Bale Hinggil
                    </p>
                    <p class="p4-animate text-[#1a2e1a] font-serif text-sm sm:text-base md:text-xl lg:text-2xl italic max-w-md leading-relaxed"
                       style="opacity:0;transform:translateY(16px);transition:opacity 0.6s ease-out 0.12s,transform 0.6s ease-out 0.12s;">
                        Satu pintu, terpercaya, dan tanpa khawatir —
                        karena tinggal di apartemen seharusnya lebih mudah.
                    </p>
                    <div class="p4-animate w-10 h-[1px] bg-[#c5a059]"
                         style="opacity:0;transform:translateY(16px);transition:opacity 0.6s ease-out 0.24s,transform 0.6s ease-out 0.24s;"></div>
                    <button id="btn-selengkapnya" onclick="bongkarPanel()"
                            class="p4-animate border border-[#c5a059] text-[#c5a059] px-7 sm:px-9 py-2 sm:py-2.5 rounded-full text-xs sm:text-sm font-medium transition-all duration-300 hover:bg-[#c5a059] hover:text-black tracking-widest uppercase"
                            style="opacity:0;transform:translateY(16px);transition:opacity 0.6s ease-out 0.36s,transform 0.6s ease-out 0.36s,background-color 0.3s,color 0.3s;">
                        Selengkapnya
                    </button>
                </div>
            </div>

        </div>
    </section>

    {{-- Ketentuan --}}
    @if(count($ketentuan))
    <section id="section-ketentuan" class="w-full py-8 px-5 sm:px-10 md:px-16 lg:px-24"
             style="background:#1a1008;opacity:0;transform:translateY(30px);transition:opacity 0.8s ease-out,transform 0.8s cubic-bezier(0.22,1,0.36,1);">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center gap-4 mb-6">
                <div class="h-[1px] w-8 bg-[#c5a059]/50"></div>
                <p class="text-[#c5a059] text-[10px] sm:text-xs uppercase tracking-[0.25em]">Ketentuan & Informasi</p>
            </div>
            <div class="hidden md:grid grid-cols-2 gap-4">
                @foreach($ketentuan as $note)
                <div class="ketentuan-item flex items-start gap-3 text-gray-300 text-xs sm:text-sm leading-relaxed"
                     style="opacity:0;transform:translateY(16px);transition:opacity 0.5s ease-out,transform 0.5s ease-out;transition-delay:{{ $loop->index * 80 }}ms">
                    <span class="text-[#c5a059]/80 mt-0.5 shrink-0">›</span>
                    <span>{{ $note }}</span>
                </div>
                @endforeach
            </div>
            <div class="md:hidden">
                <div id="ketentuan-list-mobile" class="flex flex-col gap-3">
                    @foreach($ketentuan as $i => $note)
                    <div class="ketentuan-item flex items-start gap-2.5 text-gray-300 text-[11px] leading-relaxed{{ $i >= 3 ? ' ketentuan-extra hidden' : '' }}"
                         style="opacity:0;transform:translateY(14px);transition:opacity 0.5s ease-out,transform 0.5s ease-out;transition-delay:{{ $i * 70 }}ms">
                        <span class="text-[#c5a059]/80 mt-0.5 shrink-0">›</span>
                        <span>{{ $note }}</span>
                    </div>
                    @endforeach
                </div>
                @if(count($ketentuan) > 3)
                <button id="btn-ketentuan-toggle" onclick="toggleKetentuan()"
                        class="mt-5 flex items-center gap-2 text-[#c5a059] text-[10px] uppercase tracking-[0.2em] font-medium transition-all duration-300 hover:text-[#d4b468] group">
                    <span id="btn-ketentuan-label">Tampilkan Semua</span>
                    <svg id="btn-ketentuan-icon" class="w-3 h-3 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{--Galeri--}}
    @if(count($fotoGaleri))
    <section class="w-full py-10 sm:py-14 earthy-dark" style="background:#0f3028;">
        <div class="max-w-7xl mx-auto px-5 sm:px-10 md:px-16 lg:px-24">

            <div class="reveal flex items-center justify-between gap-4 mb-8 sm:mb-10">
                <div class="flex items-center gap-4">
                    <div class="w-6 h-[1px] bg-[#c5a059]/60"></div>
                    <div>
                        <p class="text-[#c5a059]/70 text-[10px] sm:text-xs tracking-[0.35em] uppercase font-bold">Dokumentasi</p>
                        <p class="text-[#f8f0e0] font-serif text-lg sm:text-xl lg:text-2xl italic mt-0.5">Hasil Kerja <span class="text-[#d0b068]">Tim Kami</span></p>
                    </div>
                </div>
                <span class="text-[#c5a059]/50 text-xs sm:text-sm font-medium tracking-wider hidden sm:block">{{ count($fotoGaleri) }} foto</span>
            </div>

            @if(count($fotoGaleri) <= 3)
        
            <div class="grid grid-cols-{{ count($fotoGaleri) }} gap-3 lg:gap-4">
                @foreach($fotoGaleri as $gi => $foto)
                <div class="reveal group relative overflow-hidden rounded-xl lg:rounded-2xl cursor-pointer"
                     style="transition-delay:{{ $gi * 80 }}ms"
                     onclick="openGaleriLightbox('{{ $foto }}',{{ $gi }})">
                    <div class="relative w-full" style="padding-bottom:75%;">
                        <img src="{{ $foto }}" alt="Foto kerja {{ $gi+1 }}"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-[#0f3028]/0 group-hover:bg-[#0f3028]/40 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-8 h-8 text-[#d0b068]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else

            <div id="galeri-swipe-hint" class="flex items-center gap-2 mb-4 text-[#c5a059]/50 text-[10px] sm:text-xs tracking-wider" style="transition:opacity 0.5s ease;">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4"/>
                </svg>
                <span>Geser untuk melihat lebih banyak</span>
                <svg class="w-3.5 h-3.5 animate-bounce-x" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>

            <div class="galeri-carousel-outer relative">
                <div id="galeri-track-wrap" class="overflow-hidden rounded-xl" style="cursor:grab;">
                    <div id="galeri-track" class="flex gap-3 lg:gap-4"
                         style="will-change:transform;transition:transform 0.42s cubic-bezier(0.25,0.46,0.45,0.94);">
                        @foreach($fotoGaleri as $gi => $foto)
                        <div class="galeri-slide group relative overflow-hidden rounded-xl lg:rounded-2xl cursor-pointer shrink-0"
                             style="width:calc((100% - 2 * 12px) / 3);"
                             onclick="openGaleriLightbox('{{ $foto }}',{{ $gi }})">
                            <div class="relative w-full" style="padding-bottom:75%;">
                                <img src="{{ $foto }}" alt="Foto kerja {{ $gi+1 }}"
                                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 select-none pointer-events-none">
                                <div class="absolute inset-0 bg-[#0f3028]/0 group-hover:bg-[#0f3028]/40 transition-all duration-300 flex items-center justify-center">
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <svg class="w-8 h-8 text-[#d0b068]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div id="galeri-dots" class="flex justify-center gap-1.5 mt-5"></div>

                <button id="galeri-prev" onclick="galeriCarouselNav(-1)"
                        class="hidden sm:flex absolute left-0 top-1/2 -translate-y-1/2 -translate-x-5 w-10 h-10 bg-[#0f3028] border border-[#c5a059]/30 text-[#d0b068] rounded-full items-center justify-center hover:bg-[#c5a059] hover:text-[#0f3028] transition-all duration-300 shadow-lg z-10"
                        style="margin-top:-20px;">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button id="galeri-next" onclick="galeriCarouselNav(1)"
                        class="hidden sm:flex absolute right-0 top-1/2 -translate-y-1/2 translate-x-5 w-10 h-10 bg-[#0f3028] border border-[#c5a059]/30 text-[#d0b068] rounded-full items-center justify-center hover:bg-[#c5a059] hover:text-[#0f3028] transition-all duration-300 shadow-lg z-10"
                        style="margin-top:-20px;">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
            @endif

        </div>
    </section>

    {{--Lightbox--}}
    <div id="galeri-lightbox" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-8"
         style="background:rgba(10,18,10,0.95);" onclick="closeGaleriLightbox()">
        <button class="absolute top-4 right-4 sm:top-6 sm:right-6 text-[#e0d0b0]/60 hover:text-[#f8f0e0] transition-colors" onclick="closeGaleriLightbox()">
            <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <button id="galeri-lb-prev" class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-[#0f3028]/60 hover:bg-[#c5a059] text-[#d0b068] hover:text-[#0f3028] rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-sm"
                onclick="event.stopPropagation();galeriLightboxNav(-1)">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button id="galeri-lb-next" class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-[#0f3028]/60 hover:bg-[#c5a059] text-[#d0b068] hover:text-[#0f3028] rounded-full flex items-center justify-center transition-all duration-300 backdrop-blur-sm"
                onclick="event.stopPropagation();galeriLightboxNav(1)">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
        <img id="galeri-lb-img" src="" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl" style="transition:opacity 0.2s ease;" onclick="event.stopPropagation()">
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-[#c5a059]/70 text-xs tracking-widest">
            <span id="galeri-lb-counter"></span>
        </div>
    </div>
    @endif

    {{--Keunggulan--}}
    <section class="w-full py-10 sm:py-14 earthy-light" style="background:#faf5ec;">
        <div class="max-w-6xl mx-auto px-5 sm:px-10 md:px-16 lg:px-24">
            <div class="reveal text-center mb-7 sm:mb-10">
                <p class="text-[#a8852f] tracking-[0.3em] uppercase text-xs sm:text-sm font-medium mb-2">Keunggulan Kami</p>
                <h2 class="text-[#0d1a0d] font-serif text-xl sm:text-2xl md:text-3xl lg:text-4xl mb-3">
                    Kenapa Harus Cleaning Order<br>Resmi Bale Hinggil?
                </h2>
                <div class="flex justify-center mb-4">
                    <div class="w-10 h-[1px] bg-[#c5a059]"></div>
                </div>
            </div>

            <div class="md:hidden flex flex-col gap-3 mb-7">
                @foreach([
                    ['img'=>'assets/img/cyber-security.svg','text'=>'Keamanan Terjaga — Petugas Mendapat Pelatihan Khusus'],
                    ['img'=>'assets/img/support.svg',       'text'=>'Mutu Pekerjaan Terjamin'],
                    ['img'=>'assets/img/management.svg',    'text'=>'Tim Handal, Berpengalaman & Bersertifikasi'],
                    ['img'=>'assets/img/notes.svg',         'text'=>'Proses Tercatat Resmi & Transparan'],
                    ['img'=>'assets/img/heart.svg',         'text'=>'Memberikan Rasa Aman & Nyaman Bagi Penghuni'],
                ] as $i => $it)
                <div class="reveal flex items-center gap-4 px-4 py-4 rounded-xl"
                     style="transition-delay:{{ $i*60 }}ms;background:rgba(197,160,89,0.08);border:1px solid rgba(197,160,89,0.18);">
                    <img src="{{ asset($it['img']) }}" class="w-9 shrink-0 opacity-80">
                    <p class="text-[#1a2e1a] text-sm font-medium leading-snug">{{ $it['text'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="hidden md:grid grid-cols-3 items-center gap-16 lg:gap-24">
                <div class="space-y-8 text-center">
                    <div class="reveal">
                        <div class="flex justify-center mb-3"><img src="{{ asset('assets/img/support.svg') }}" class="w-10 lg:w-14"></div>
                        <p class="text-[#1a2e1a] text-sm lg:text-base font-medium">Mutu Pekerjaan<br>Terjamin</p>
                    </div>
                    <div class="reveal">
                        <div class="flex justify-center mb-3"><img src="{{ asset('assets/img/management.svg') }}" class="w-10 lg:w-14"></div>
                        <p class="text-[#1a2e1a] text-sm lg:text-base font-medium">Tim Handal,<br>Berpengalaman, &<br>Bersertifikasi</p>
                    </div>
                </div>
                <div class="reveal flex flex-col items-center gap-4 text-center">
                    <img src="{{ asset('assets/img/conversations.svg') }}" class="w-32 lg:w-44">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/img/cyber-security.svg') }}" class="w-8 lg:w-10 opacity-70">
                        <p class="text-[#3a3a2a] text-sm lg:text-base italic font-light leading-snug">Keamanan Terjaga —<br>Petugas Berlatih Khusus</p>
                    </div>
                </div>
                <div class="space-y-8 text-center">
                    <div class="reveal">
                        <div class="flex mb-3 justify-center"><img src="{{ asset('assets/img/notes.svg') }}" class="w-10 lg:w-14"></div>
                        <p class="text-[#1a2e1a] text-sm lg:text-base font-medium">Proses Tercatat Resmi<br>& Transparan</p>
                    </div>
                    <div class="reveal">
                        <div class="flex mb-3 justify-center"><img src="{{ asset('assets/img/heart.svg') }}" class="w-10 lg:w-14"></div>
                        <p class="text-[#1a2e1a] text-sm lg:text-base font-medium">Memberikan Rasa<br>Aman & Nyaman Bagi<br>Penghuni</p>
                    </div>
                </div>
            </div>

            <div class="reveal flex justify-center mt-8">
                <a href="https://wa.me/62895324255322?text={{ urlencode('Halo Admin Bale Hinggil, saya ingin menanyakan layanan Cleaning Order.') }}"
                   target="_blank"
                   class="bg-[#0d1a0d] text-white px-8 py-3 rounded-full text-xs sm:text-sm font-medium tracking-wider uppercase hover:bg-[#c5a059] hover:text-black transition-all duration-300 shadow-lg">
                    Informasi Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

</div>

<style>
.co-service-card { transition: transform 0.3s ease; }
.co-service-card:hover { transform: translateY(-6px); }
.co-card-box { border-radius: 1rem; transition: box-shadow 0.35s ease, transform 0.35s ease; }
.co-service-card:hover .co-card-box {
    box-shadow:
        0 0 0 1px rgba(197,160,89,0.5),
        0 0 16px 2px rgba(197,160,89,0.35),
        0 0 32px 6px rgba(197,160,89,0.15);
}

@keyframes coFadeUp  { from{opacity:0;transform:translateY(22px);} to{opacity:1;transform:translateY(0);} }
@keyframes coLineIn  { from{opacity:0;transform:scaleX(0);}        to{opacity:1;transform:scaleX(1);}     }
@keyframes coHeroZoom{ from{transform:scale(1.07);}                 to{transform:scale(1);}               }
@keyframes bounceX   { 0%,100%{transform:translateX(0);} 50%{transform:translateX(5px);} }

.co-hero-img { animation:coHeroZoom 1.8s ease forwards; transform-origin:center; }
.animate-bounce-x { animation: bounceX 1.2s ease-in-out infinite; }
.galeri-carousel-outer { position: relative; }

.font-serif,h1,h2,h3 { font-family:'Palatino Linotype','Book Antiqua','Palatino',Georgia,serif; }

.perspective      { perspective:1000px; }
.transform-style  { transform-style:preserve-3d; }
.backface-hidden  { backface-visibility:hidden; }
.rotate-y-180     { transform:rotateY(180deg); }
.hover\:rotate-y-180:hover { transform:rotateY(180deg); }

.panel-h       { height: 200px; }
.panel-overlap { margin-top: -140px; }
@media (min-width: 768px) { .panel-h { height: 220px; } .panel-overlap { margin-top: -155px; } }
@media (max-width: 640px) { .panel-h { height: 150px; } .panel-overlap { margin-top: -100px; } }

.stack-panel {
    opacity:0; transform:translateY(40px);
    transition:opacity 0.5s cubic-bezier(0.22,1,0.36,1), transform 0.5s cubic-bezier(0.22,1,0.36,1), height 0.6s cubic-bezier(0.4,0,0.2,1);
    position:relative;
}
.stack-panel.visible { opacity:1; transform:translateY(0); }
.stack-panel::before {
    content:''; display:block; height:1px;
    background:linear-gradient(to right,transparent,rgba(197,160,89,0.35),transparent);
    position:absolute; top:0; left:8%; right:8%; z-index:2;
}
.panel-trigger { transition:background 0.3s ease; }
.panel-trigger:hover { background:rgba(255,255,255,0.03); }
.stack-panel.expanded .panel-chevron { transform:rotate(90deg); }
.stack-panel.expanded .panel-trigger { pointer-events:none; opacity:0; transition:opacity 0.2s ease; }

.tarif-card {
    box-shadow:inset 0 1px 0 rgba(255,255,255,0.04),0 2px 12px rgba(0,0,0,0.15);
    transition:box-shadow 0.3s ease, border-color 0.3s ease;
}
.tarif-card:hover { box-shadow:inset 0 1px 0 rgba(197,160,89,0.08),0 4px 20px rgba(0,0,0,0.25); }

.reveal { opacity:0; transform:translateY(20px); transition:opacity 0.45s ease-out, transform 0.45s cubic-bezier(0.22,1,0.36,1); }
.reveal.active { opacity:1; transform:translateY(0); }

.earthy-dark,.earthy-panel,.earthy-light { position:relative; }
.earthy-dark::after,.earthy-panel::after,.earthy-light::after {
    content:''; position:absolute; inset:0; pointer-events:none; z-index:1; opacity:0.045;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
    background-size:160px 160px; mix-blend-mode:multiply;
}
.earthy-dark::after  { opacity:0.06; mix-blend-mode:screen; }
.earthy-light::after { opacity:0.055; mix-blend-mode:multiply; }
.earthy-panel::after { opacity:0.05; mix-blend-mode:overlay; }
.earthy-dark>*,.earthy-panel>*,.earthy-light>* { position:relative; z-index:2; }
</style>

<script>
(function(){
    var slidesWrap = document.getElementById('slides');
    if (!slidesWrap) return;

    var realSlides = Array.from(slidesWrap.children);
    var total      = realSlides.length;

    if (total === 0) return;

    var cloneLast  = realSlides[total - 1].cloneNode(true);
    cloneLast.setAttribute('aria-hidden', 'true');
    slidesWrap.insertBefore(cloneLast, slidesWrap.firstChild);

    var cloneFirst = realSlides[0].cloneNode(true);
    cloneFirst.setAttribute('aria-hidden', 'true');
    slidesWrap.appendChild(cloneFirst);
    var current   = 1;
    var timer     = null;
    var AUTO_MS   = 4500;
    var sliding   = false;
    var TRANS     = 'transform .5s cubic-bezier(.77,0,.175,1)';

    function setTransform(idx, animated) {
        slidesWrap.style.transition = animated ? TRANS : 'none';
        slidesWrap.style.transform  = 'translateX(-' + (idx * 100) + '%)';
        if (!animated) {
            void slidesWrap.offsetHeight;
        }
    }
    function updateDots(realIdx) {
        document.querySelectorAll('.slide-dot').forEach(function(d, i) {
            d.style.backgroundColor = i === realIdx ? '#d0b068' : 'rgba(240,232,216,.5)';
            d.style.width  = i === realIdx ? '18px' : '7px';
            d.style.height = '7px';
        });
    }
    
    function toRealIdx(pos) {
        return ((pos - 1) % total + total) % total;
    }

    function goTo(pos, isManual) {
        if (sliding) return;
        sliding = true;
        clearTimeout(timer);

        current = pos;
        setTransform(current, true);
        updateDots(toRealIdx(current));
        setTimeout(function() {
            sliding = false;

            if (current === 0) {
                current = total;
                setTransform(current, false);
            } else if (current === total + 1) {
                current = 1;
                setTransform(current, false);
            }

            timer = setTimeout(autoNext, isManual ? AUTO_MS * 2 : AUTO_MS);
        }, 520); 
    }

    function autoNext() { goTo(current + 1, false); }

    window.prevSlide  = function() { goTo(current - 1, true); };
    window.nextSlide  = function() { goTo(current + 1, true); };
    window.goToSlide  = function(i) { goTo(i + 1, true); }; 

    setTransform(current, false);
    updateDots(0);
    timer = setTimeout(autoNext, AUTO_MS);

    window.rebuildSlideshow = function() {
    clearTimeout(timer);
    sliding = false;

    const allChildren = Array.from(slidesWrap.children);
    const cleanSlides = allChildren.filter(el => el.getAttribute('aria-hidden') !== 'true');
    
    slidesWrap.innerHTML = '';
    cleanSlides.forEach(s => slidesWrap.appendChild(s));

    realSlides = Array.from(slidesWrap.children);
    total = realSlides.length;

    if (total === 0) return;
    const newCloneLast = realSlides[total - 1].cloneNode(true);
    newCloneLast.setAttribute('aria-hidden', 'true');
    slidesWrap.insertBefore(newCloneLast, slidesWrap.firstChild);

    const newCloneFirst = realSlides[0].cloneNode(true);
    newCloneFirst.setAttribute('aria-hidden', 'true');
    slidesWrap.appendChild(newCloneFirst);

    current = 1;
    setTransform(current, false);

    const dotsEl = document.getElementById('slide-dots');
    if (dotsEl) {
        dotsEl.innerHTML = '';
        for (let i = 0; i < total; i++) {
            const btn = document.createElement('button');
            btn.className = 'slide-dot rounded-full transition-all duration-300';
            btn.style.cssText = i === 0
                ? 'background:#d0b068;width:18px;height:7px;'
                : 'background:rgba(240,232,216,.5);width:7px;height:7px;';
            btn.onclick = (function(idx) { return function() { goTo(idx + 1, true); }; })(i);
            dotsEl.appendChild(btn);
        }
    }
    updateDots(0);
    timer = setTimeout(autoNext, AUTO_MS);
};
})();

var revealEls = document.querySelectorAll('.reveal');
var revObs = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting){e.target.classList.add('active');revObs.unobserve(e.target);} });
},{threshold:0.05});
revealEls.forEach(function(el){revObs.observe(el);});

var panelEls = document.querySelectorAll('.stack-panel');
var panelObs = new IntersectionObserver(function(entries){
    entries.forEach(function(e){ if(e.isIntersecting){e.target.classList.add('visible');panelObs.unobserve(e.target);} });
},{threshold:0.04});
panelEls.forEach(function(el){panelObs.observe(el);});

var ketEl = document.getElementById('section-ketentuan');
if(ketEl){
    var ketObs = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if(e.isIntersecting){
                e.target.style.opacity='1'; e.target.style.transform='translateY(0)';
                e.target.querySelectorAll('.ketentuan-item').forEach(function(item){item.style.opacity='1';item.style.transform='translateY(0)';});
                ketObs.unobserve(e.target);
            }
        });
    },{threshold:0.1});
    ketObs.observe(ketEl);
}

var p4El = document.getElementById('p4');
if(p4El){
    var p4Obs = new IntersectionObserver(function(entries){
        entries.forEach(function(e){
            if(e.isIntersecting){
                e.target.querySelectorAll('.p4-animate').forEach(function(el){el.style.opacity='1';el.style.transform='translateY(0)';});
                p4Obs.unobserve(e.target);
            }
        });
    },{threshold:0.2});
    p4Obs.observe(p4El);
}
function togglePanel(id){
    var panel=document.getElementById(id);
    var content=panel.querySelector('.'+id+'-content');
    var isExpanded=panel.classList.contains('expanded');
    ['p1','p2','p3'].forEach(function(pid){
        if(pid!==id){
            var p=document.getElementById(pid),c=p.querySelector('.'+pid+'-content');
            if(p.classList.contains('expanded')){p.classList.remove('expanded');p.style.height='';if(c){c.style.opacity='0';c.style.pointerEvents='none';}}
        }
    });
    if(isExpanded){panel.classList.remove('expanded');panel.style.height='';if(content){content.style.opacity='0';content.style.pointerEvents='none';}}
    else{panel.classList.add('expanded');panel.style.height='auto';if(content){content.style.pointerEvents='auto';setTimeout(function(){content.style.opacity='1';},100);}}
}
function bukaSpesifikPanel(num){ var id='p'+num,panel=document.getElementById(id);if(!panel)return;if(!panel.classList.contains('expanded'))togglePanel(id); }
function bongkarPanel(){ togglePanel('p1'); }

var ketentuanExpanded = false;
function toggleKetentuan(){
    ketentuanExpanded = !ketentuanExpanded;
    var extras = document.querySelectorAll('.ketentuan-extra');
    var label  = document.getElementById('btn-ketentuan-label');
    var icon   = document.getElementById('btn-ketentuan-icon');
    extras.forEach(function(el){
        if(ketentuanExpanded){
            el.classList.remove('hidden');
            requestAnimationFrame(function(){ el.style.opacity='1'; el.style.transform='translateY(0)'; });
        } else {
            el.style.opacity='0'; el.style.transform='translateY(14px)';
            setTimeout(function(){ el.classList.add('hidden'); }, 400);
        }
    });
    if(label) label.textContent = ketentuanExpanded ? 'Sembunyikan' : 'Tampilkan Semua';
    if(icon)  icon.style.transform = ketentuanExpanded ? 'rotate(180deg)' : '';
}

(function(){
    var track = document.getElementById('galeri-track');
    var wrap  = document.getElementById('galeri-track-wrap');
    if(!track || !wrap) return;

    var slides   = track.querySelectorAll('.galeri-slide');
    var total    = slides.length;
    if(total <= 3) return;

    var perPage  = 3;
    var maxIdx   = total - perPage;
    var current  = 0;
    var slideW   = 0;
    var gap      = 12;
    var dragging = false, startX = 0, startOff = 0, dragOff = 0;

    function computeSize(){
        var el = slides[0];
        if(!el) return;
        slideW = el.getBoundingClientRect().width;
        var cs = window.getComputedStyle(track);
        gap = parseFloat(cs.columnGap || cs.gap) || 12;
    }

    function buildDots(){
        var container = document.getElementById('galeri-dots');
        if(!container) return;
        container.innerHTML = '';
        var pages = Math.ceil(total / perPage);
        for(var i=0;i<pages;i++){
            var d = document.createElement('button');
            d.dataset.page = i;
            d.style.cssText = 'border-radius:9999px;transition:all .3s;border:none;cursor:pointer;background:rgba(197,160,89,0.25);width:7px;height:7px;padding:0;';
            d.onclick = (function(page){ return function(){ goToPage(page); }; })(i);
            container.appendChild(d);
        }
        updateDots();
    }

    function updateDots(){
        var container = document.getElementById('galeri-dots');
        if(!container) return;
        var page = Math.round(current / perPage);
        container.querySelectorAll('button').forEach(function(d,i){
            if(i === page){ d.style.background='#d0b068'; d.style.width='22px'; }
            else          { d.style.background='rgba(197,160,89,0.25)'; d.style.width='7px'; }
        });
        var prev = document.getElementById('galeri-prev');
        var next = document.getElementById('galeri-next');
        if(prev) prev.style.opacity = current <= 0 ? '0.3' : '1';
        if(next) next.style.opacity = current >= maxIdx ? '0.3' : '1';
    }

    function applyTransform(animated, offset){
        computeSize();
        var off = offset !== undefined ? offset : current * (slideW + gap);
        track.style.transition = animated
            ? 'transform 0.42s cubic-bezier(0.25,0.46,0.45,0.94)'
            : 'none';
        track.style.transform = 'translateX(-' + off + 'px)';
        if(!animated) track.getBoundingClientRect();
    }

    function goTo(idx){
        current = Math.max(0, Math.min(idx, maxIdx));
        applyTransform(true);
        updateDots();
        var hint = document.getElementById('galeri-swipe-hint');
        if(hint) hint.style.opacity = '0';
    }

    function goToPage(page){ goTo(page * perPage); }
    window.galeriCarouselNav = function(dir){ goTo(current + dir); };

    function onStart(e){
        computeSize(); dragging=true;
        startX   = e.touches ? e.touches[0].clientX : e.clientX;
        startOff = current * (slideW + gap);
        track.style.transition = 'none';
        wrap.style.cursor = 'grabbing';
    }
    function onMove(e){
        if(!dragging) return;
        dragOff = startX - (e.touches ? e.touches[0].clientX : e.clientX);
        var raw = startOff + dragOff;
        var max = maxIdx * (slideW + gap);
        if(raw < 0)   raw = raw / 4;
        if(raw > max) raw = max + (raw - max) / 4;
        track.style.transform = 'translateX(-' + raw + 'px)';
        e.preventDefault();
    }
    function onEnd(){
        if(!dragging) return;
        dragging = false;
        wrap.style.cursor = 'grab';
        computeSize();
        var threshold = slideW * 0.2;
        if(Math.abs(dragOff) > threshold){ goTo(current + (dragOff > 0 ? 1 : -1)); }
        else { applyTransform(true); }
    }

    wrap.addEventListener('mousedown',  onStart);
    wrap.addEventListener('touchstart', onStart, {passive:true});
    document.addEventListener('mousemove', onMove);
    document.addEventListener('touchmove', onMove, {passive:false});
    document.addEventListener('mouseup',   onEnd);
    document.addEventListener('touchend',  onEnd);

    computeSize();
    buildDots();
    applyTransform(false);

    window.addEventListener('resize', function(){ computeSize(); applyTransform(false); });
    setTimeout(function(){
        computeSize();
        track.style.transition = 'transform 0.4s ease';
        track.style.transform  = 'translateX(-' + (slideW * 0.08) + 'px)';
        setTimeout(function(){
            track.style.transform = 'translateX(0)';
            setTimeout(function(){ applyTransform(false); }, 450);
        }, 420);
    }, 900);
})();

(function(){
    var photos=[],current=0;
    function collectPhotos(){
        photos=[];
        document.querySelectorAll('[onclick^="openGaleriLightbox"]').forEach(function(el){
            var match=el.getAttribute('onclick').match(/openGaleriLightbox\('([^']+)'/);
            if(match) photos.push(match[1]);
        });
    }
    function show(idx){
        current=((idx%photos.length)+photos.length)%photos.length;
        var img=document.getElementById('galeri-lb-img'),ctr=document.getElementById('galeri-lb-counter');
        if(!img) return;
        img.style.opacity='0';
        setTimeout(function(){img.src=photos[current];img.style.opacity='1';},150);
        if(ctr) ctr.textContent=(current+1)+' / '+photos.length;
        var prev=document.getElementById('galeri-lb-prev'),next=document.getElementById('galeri-lb-next');
        if(prev) prev.style.display=photos.length>1?'':'none';
        if(next) next.style.display=photos.length>1?'':'none';
    }
    window.openGaleriLightbox=function(src,idx){collectPhotos();var lb=document.getElementById('galeri-lightbox');if(!lb)return;lb.classList.remove('hidden');lb.classList.add('flex');document.body.style.overflow='hidden';show(idx);};
    window.closeGaleriLightbox=function(){var lb=document.getElementById('galeri-lightbox');if(!lb)return;lb.classList.add('hidden');lb.classList.remove('flex');document.body.style.overflow='';};
    window.galeriLightboxNav=function(dir){show(current+dir);};
    document.addEventListener('keydown',function(e){var lb=document.getElementById('galeri-lightbox');if(!lb||lb.classList.contains('hidden'))return;if(e.key==='Escape')closeGaleriLightbox();if(e.key==='ArrowRight')galeriLightboxNav(1);if(e.key==='ArrowLeft')galeriLightboxNav(-1);});
})();
window.addEventListener('message', function(e) {
    if (!e.data || !e.data.type) return;
    if (e.data.type === 'PREVIEW_IMG' && e.data.target === 'hero') {
        const heroImg = document.querySelector('.co-hero-img');
        if (heroImg) {
            heroImg.style.animation  = 'none';
            heroImg.style.transition = 'opacity 0.3s ease';
            heroImg.style.opacity    = '0';
            setTimeout(() => {
                heroImg.src = e.data.src;
                heroImg.style.opacity = '1';
            }, 150);
        }
    }

    if (e.data.type === 'PREVIEW_SLIDES_BARU' && Array.isArray(e.data.slides)) {
    const slidesContainer = document.getElementById('slides');
    if (!slidesContainer) return;
    const slideshowSection = slidesContainer.closest('section');
    if (e.data.slides.length === 0) {
        if (slideshowSection) slideshowSection.style.display = 'none';
        return;
    }
    if (slideshowSection) slideshowSection.style.display = '';

    slidesContainer.innerHTML = '';

    e.data.slides.forEach(src => {
        const div = document.createElement('div');
        div.className = 'min-w-full';
        div.style.cssText = 'min-width:100%;position:relative;overflow:hidden;height:clamp(200px,55vh,65vh);';
        const img = document.createElement('img');
        img.src = src;
        img.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;display:block;';
        div.appendChild(img);
        slidesContainer.appendChild(div);
    });

    if (typeof window.rebuildSlideshow === 'function') window.rebuildSlideshow();
}
});
</script>

@endsection