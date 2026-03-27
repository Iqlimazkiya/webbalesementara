@extends('layouts.user.main')

@section('title', 'Layanan Working Order')

@push('styles')
@vite(['resources/css/user/layanan.css'])
@endpush

@push('scripts')
@vite(['resources/js/user/layanan.js'])
@endpush

@section('content')

@php
    $wo = $wo ?? ($layanan->first() ?? null);

    $fotoUrl = function(?string $path) {
        if (!$path) return null;
        return str_starts_with($path, 'storage/') || str_starts_with($path, 'public/')
            ? Storage::url(str_replace('storage/', '', $path))
            : asset($path);
    };

    $fotoCarousel = $wo ? array_values(array_filter([
        $fotoUrl($wo->foto_carousel_1),
        $fotoUrl($wo->foto_carousel_2),
        $fotoUrl($wo->foto_carousel_3),
        $fotoUrl($wo->foto_carousel_4),
    ])) : [];

    $fotoSlide = $wo ? array_values(array_filter([
        $fotoUrl($wo->foto_slide_1),
        $fotoUrl($wo->foto_slide_2),
        $fotoUrl($wo->foto_slide_3),
    ])) : [];

    $adaCarousel = count($fotoCarousel) > 0;
    $adaSlide    = count($fotoSlide)    > 0;

    $preview = request()->query('_preview') === '1' ? session('wo_preview') : null;

    $tarifListrik  = $preview['tarif_listrik']  ?? $wo?->tarif_listrik  ?? [];
    $tarifPlumbing = $preview['tarif_plumbing'] ?? $wo?->tarif_plumbing ?? [];
    $tarifUmum     = $preview['tarif_umum']     ?? $wo?->tarif_umum     ?? [];
    $ketentuan     = $preview['ketentuan']      ?? $wo?->ketentuan      ?? [];

    $isPreviewMode = !empty($preview);
@endphp

<div class="bg-[#fff6e5] min-h-screen overflow-x-hidden" style="font-family: 'Palatino Linotype', 'Book Antiqua', 'Palatino', Georgia, serif;">

    {{-- ── HEADER + CAROUSEL ── --}}
    <div class="pt-20 md:pt-28 px-6 md:px-10 pb-6">

        <div class="max-w-5xl mb-8 md:mb-10">
            <p class="hdr-label text-[#a8852f] tracking-[0.35em] uppercase text-[13px] font-medium mb-3"
               style="opacity:0; transform:translateY(18px);">
                Layanan Bale Hinggil
            </p>
            <h1 class="hdr-title text-[#0d1a0d] font-serif text-[32px] md:text-[48px] leading-tight mb-1"
                style="opacity:0; transform:translateY(22px);">
                Working Order
            </h1>
            <p class="typing-text text-[#6b6b5a] text-sm md:text-lg font-light italic mb-4">
                Solusi Perbaikan Teknis Unit Anda
            </p>
            <div class="hdr-divider w-12 h-[1px] bg-[#c5a059] mb-4"
                 style="opacity:0; transform:scaleX(0); transform-origin:left;"></div>
            <p class="hdr-desc text-[#4a4a3a] text-base md:text-[17px] leading-relaxed font-light max-w-xl"
               style="opacity:0; transform:translateY(14px);">
                Percayakan perbaikan unit Anda kepada teknisi profesional kami —
                bersertifikasi, responsif, dan hadir tepat waktu.
            </p>
        </div>

        @if($adaCarousel)
        <div id="carousel" class="reveal overflow-x-auto scroll-smooth hide-scrollbar pb-12 md:pb-16">
            <div class="flex gap-5 w-max" id="carousel-content">
                @foreach($fotoCarousel as $foto)
                <div class="min-w-[260px] md:min-w-[300px] h-[220px] md:h-[260px] rounded-2xl overflow-hidden shadow-md hover:scale-[1.02] transition duration-300 border border-[#c5a059]/10">
                    <img src="{{ $foto }}" class="w-full h-full object-cover">
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- ── SLIDESHOW ── --}}
    @if($adaSlide)
    <div class="px-6 md:px-10 pb-0">
        <div class="relative overflow-hidden rounded-2xl">
            <div id="slides" class="flex transition-transform duration-700">
                @foreach($fotoSlide as $foto)
                <div class="min-w-full">
                    <img src="{{ $foto }}" class="w-full object-contain rounded-2xl">
                </div>
                @endforeach
            </div>
            <button onclick="prevSlide()" class="absolute left-3 top-1/2 -translate-y-1/2 bg-[#0d1a0d]/70 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#c5a059] hover:text-black transition-all duration-300" aria-label="Sebelumnya">‹</button>
            <button onclick="nextSlide()" class="absolute right-3 top-1/2 -translate-y-1/2 bg-[#0d1a0d]/70 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#c5a059] hover:text-black transition-all duration-300" aria-label="Berikutnya">›</button>
        </div>
    </div>
    @endif

    {{-- ── ICON CARDS ── --}}
    <div class="mt-10 w-full">
        <div class="max-w-6xl mx-auto py-16 px-6 md:px-10">
            <div class="reveal flex items-center gap-4 justify-center mb-10 flex-nowrap">
                <div class="hidden sm:block h-[1px] w-10 bg-[#c5a059]"></div>
                <p class="text-[#a8852f] text-[12px] uppercase tracking-[0.35em] font-medium">Layanan Kami</p>
                <div class="hidden sm:block h-[1px] w-10 bg-[#c5a059]"></div>
            </div>
            <div class="flex flex-wrap justify-center gap-6 md:gap-16 items-start">
                @foreach([
                    ['icon' => 'assets/img/wo1.svg', 'text' => 'Perbaikan Kerusakan Ringan Hingga Sedang', 'bg' => '#2d3d1e'],
                    ['icon' => 'assets/img/wo2.svg', 'text' => 'Pengecekan & perbaikan instalasi listrik', 'bg' => '#3d2b1f'],
                    ['icon' => 'assets/img/wo3.svg', 'text' => 'Pengecekan & perbaikan air, plumbing, dan sanitasi', 'bg' => '#4a5c2e'],
                ] as $index => $item)
                <div class="reveal w-32 md:w-40 h-32 md:h-40 perspective cursor-pointer"
                     style="transition-delay: {{ $index * 120 }}ms"
                     onclick="bukaSpesifikPanel({{ $index + 1 }})"
                     tabindex="0"
                     onkeypress="if(event.key==='Enter') bukaSpesifikPanel({{ $index + 1 }})">
                    <div class="relative w-full h-full duration-700 transform-style preserve-3d hover:rotate-y-180">
                        <div class="absolute w-full h-full rounded-2xl flex items-center justify-center backface-hidden border border-[#c5a059]/30 shadow-lg"
                             style="background-color: {{ $item['bg'] }}">
                            <img src="{{ asset($item['icon']) }}" class="w-14">
                        </div>
                        <div class="absolute w-full h-full rounded-2xl flex items-center justify-center rotate-y-180 backface-hidden bg-[#c5a059] text-black font-medium text-center px-4 text-base leading-snug">
                            {{ $item['text'] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── PANEL STACK ── --}}
    <section id="section-panels" class="relative mt-10">
        <div class="w-full relative">

            {{-- p1: Perbaikan Kerusakan Ringan Hingga Sedang --}}
            <div id="p1" class="stack-panel panel-h w-full rounded-t-[40px] md:rounded-t-[60px] overflow-hidden" style="background: #2d3d1e;">
                <div class="panel-trigger absolute inset-x-0 top-0 h-[220px] flex items-center px-8 md:px-16 cursor-pointer z-10 select-none"
                     onclick="togglePanel('p1')">
                    <div class="flex items-center justify-between w-full max-w-5xl mx-auto">
                        <div class="flex items-center gap-4">
                            <div class="h-[1px] w-8 bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-[12px] uppercase tracking-[0.35em]">Perbaikan Kerusakan Ringan Hingga Sedang</p>
                        </div>
                        <div class="panel-chevron text-[#c5a059]/60 text-lg transition-transform duration-500">›</div>
                    </div>
                </div>
                <div class="p1-content opacity-0 transition-opacity duration-500 pt-16 pb-12 px-6 md:px-16">
                    <div class="max-w-5xl mx-auto">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-[1px] w-8 bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-[12px] uppercase tracking-[0.35em]">Tarif Perbaikan Kerusakan Ringan Hingga Sedang</p>
                        </div>
                        @if(count($tarifUmum))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                            @foreach($tarifUmum as $r)
                            <div class="tarif-card group relative rounded-2xl px-6 py-5 border border-[#c5a059]/15 hover:border-[#c5a059]/40 transition-all duration-300"
                                 style="background: rgba(255,255,255,0.04);">
                                <div class="absolute left-0 top-4 bottom-4 w-[3px] rounded-full bg-[#c5a059]/40 group-hover:bg-[#c5a059] transition-colors duration-300"></div>
                                <div class="flex items-start justify-between gap-4 mb-3 pl-3">
                                    <div>
                                        <p class="text-white font-serif text-[15px] font-medium leading-tight">{{ $r['jenis'] }}</p>
                                        <p class="text-[#c5a059]/70 text-xs italic mt-0.5">{{ $r['kondisi'] }}</p>
                                    </div>
                                    <span class="text-[#c5a059] font-serif text-xl font-semibold shrink-0 leading-tight">{{ $r['tarif'] }}</span>
                                </div>
                                <div class="pl-3 mb-3"><div class="border-t border-dashed border-white/10"></div></div>
                                <div class="flex items-center gap-5 pl-3">
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span class="text-gray-300 text-xs">{{ $r['petugas'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/></svg>
                                        <span class="text-gray-300 text-xs">{{ $r['durasi'] }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center text-center py-10 gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-white/5 border border-[#c5a059]/20 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                </svg>
                            </div>
                            <p class="text-white font-serif text-lg italic">Segera Hadir</p>
                            <p class="text-gray-300 text-sm max-w-xs leading-relaxed">Informasi perbaikan kerusakan sedang dalam persiapan.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- p2: Pengecekan & perbaikan instalasi listrik --}}
            <div id="p2" class="stack-panel panel-h panel-overlap w-full rounded-t-[40px] md:rounded-t-[60px] overflow-hidden" style="background: #3d2b1f;">
                <div class="panel-trigger absolute inset-x-0 top-0 h-[220px] flex items-center px-8 md:px-16 cursor-pointer z-10 select-none"
                     onclick="togglePanel('p2')">
                    <div class="flex items-center justify-between w-full max-w-5xl mx-auto">
                        <div class="flex items-center gap-4">
                            <div class="h-[1px] w-8 bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-[12px] uppercase tracking-[0.35em]">Pengecekan & perbaikan instalasi listrik</p>
                        </div>
                        <div class="panel-chevron text-[#c5a059]/60 text-lg transition-transform duration-500">›</div>
                    </div>
                </div>
                <div class="p2-content opacity-0 transition-opacity duration-500 pt-16 pb-12 px-6 md:px-16">
                    <div class="max-w-5xl mx-auto">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-[1px] w-8 bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-[12px] uppercase tracking-[0.35em]">Tarif Pengecekan & perbaikan instalasi listrik</p>
                        </div>
                        @if(count($tarifListrik))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                            @foreach($tarifListrik as $r)
                            <div class="tarif-card group relative rounded-2xl px-6 py-5 border border-[#c5a059]/15 hover:border-[#c5a059]/40 transition-all duration-300"
                                 style="background: rgba(255,255,255,0.04);">
                                <div class="absolute left-0 top-4 bottom-4 w-[3px] rounded-full bg-[#c5a059]/40 group-hover:bg-[#c5a059] transition-colors duration-300"></div>
                                <div class="flex items-start justify-between gap-4 mb-3 pl-3">
                                    <div>
                                        <p class="text-white font-serif text-[15px] font-medium leading-tight">{{ $r['jenis'] }}</p>
                                        <p class="text-[#c5a059]/70 text-xs italic mt-0.5">{{ $r['kondisi'] }}</p>
                                    </div>
                                    <span class="text-[#c5a059] font-serif text-xl font-semibold shrink-0 leading-tight">{{ $r['tarif'] }}</span>
                                </div>
                                <div class="pl-3 mb-3"><div class="border-t border-dashed border-white/10"></div></div>
                                <div class="flex items-center gap-5 pl-3">
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span class="text-gray-300 text-xs">{{ $r['petugas'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/></svg>
                                        <span class="text-gray-300 text-xs">{{ $r['durasi'] }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center text-center py-10 gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-white/5 border border-[#c5a059]/20 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                </svg>
                            </div>
                            <p class="text-white font-serif text-lg italic">Segera Hadir</p>
                            <p class="text-gray-300 text-sm max-w-xs leading-relaxed">Informasi pengecekan & perbaikan instalasi listrik sedang dalam persiapan.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- p3: Pengecekan & perbaikan air, plumbing, dan sanitasi --}}
            <div id="p3" class="stack-panel panel-h panel-overlap w-full rounded-t-[40px] md:rounded-t-[60px] overflow-hidden" style="background: #4a5c2e;">
                <div class="panel-trigger absolute inset-x-0 top-0 h-[220px] flex items-center px-8 md:px-16 cursor-pointer z-10 select-none"
                     onclick="togglePanel('p3')">
                    <div class="flex items-center justify-between w-full max-w-5xl mx-auto">
                        <div class="flex items-center gap-4">
                            <div class="h-[1px] w-8 bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-[12px] uppercase tracking-[0.35em]">Pengecekan & perbaikan air, plumbing, dan sanitasi</p>
                        </div>
                        <div class="panel-chevron text-[#c5a059]/60 text-lg transition-transform duration-500">›</div>
                    </div>
                </div>
                <div class="p3-content opacity-0 transition-opacity duration-500 pt-16 pb-12 px-6 md:px-16">
                    <div class="max-w-5xl mx-auto">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-[1px] w-8 bg-[#c5a059]"></div>
                            <p class="text-[#c5a059] text-[12px] uppercase tracking-[0.35em]">Tarif Pengecekan & perbaikan air, plumbing, dan sanitasi</p>
                        </div>
                        @if(count($tarifPlumbing))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                            @foreach($tarifPlumbing as $r)
                            <div class="tarif-card group relative rounded-2xl px-6 py-5 border border-[#c5a059]/15 hover:border-[#c5a059]/40 transition-all duration-300"
                                 style="background: rgba(255,255,255,0.04);">
                                <div class="absolute left-0 top-4 bottom-4 w-[3px] rounded-full bg-[#c5a059]/40 group-hover:bg-[#c5a059] transition-colors duration-300"></div>
                                <div class="flex items-start justify-between gap-4 mb-3 pl-3">
                                    <div>
                                        <p class="text-white font-serif text-[15px] font-medium leading-tight">{{ $r['jenis'] }}</p>
                                        <p class="text-[#c5a059]/70 text-xs italic mt-0.5">{{ $r['kondisi'] }}</p>
                                    </div>
                                    <span class="text-[#c5a059] font-serif text-xl font-semibold shrink-0 leading-tight">{{ $r['tarif'] }}</span>
                                </div>
                                <div class="pl-3 mb-3"><div class="border-t border-dashed border-white/10"></div></div>
                                <div class="flex items-center gap-5 pl-3">
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span class="text-gray-300 text-xs">{{ $r['petugas'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/></svg>
                                        <span class="text-gray-300 text-xs">{{ $r['durasi'] }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center text-center py-10 gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-white/5 border border-[#c5a059]/20 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                </svg>
                            </div>
                            <p class="text-white font-serif text-lg italic">Segera Hadir</p>
                            <p class="text-gray-300 text-sm max-w-xs leading-relaxed">Informasi pengecekan & perbaikan air, plumbing, dan sanitasi sedang dalam persiapan.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- p4: CTA --}}
            <div id="p4"
                 class="stack-panel panel-overlap w-full rounded-t-[40px] md:rounded-t-[60px] overflow-hidden"
                 style="height: 300px; background: linear-gradient(135deg, #f7f0e3 0%, #fdf6e8 60%, #f0e6cc 100%); border-top: 1px solid rgba(197,160,89,0.25);">
                <div class="max-w-6xl mx-auto text-center flex flex-col items-center justify-center h-full gap-4 px-6">
                    <p class="p4-animate text-[#a8852f] text-[11px] uppercase tracking-[0.3em]"
                       style="opacity:0; transform:translateY(20px); transition: opacity 0.6s ease-out, transform 0.6s ease-out;">
                        Bale Hinggil
                    </p>
                    <p class="p4-animate text-[#1a2e1a] font-serif text-base md:text-lg italic max-w-md leading-relaxed"
                       style="opacity:0; transform:translateY(20px); transition: opacity 0.6s ease-out 0.12s, transform 0.6s ease-out 0.12s;">
                        Laporan sekali, langsung ditangani teknisi bersertifikasi —<br>
                        karena tinggal di apartemen seharusnya lebih mudah.
                    </p>
                    <div class="p4-animate w-10 h-[1px] bg-[#c5a059]"
                         style="opacity:0; transform:translateY(20px); transition: opacity 0.6s ease-out 0.24s, transform 0.6s ease-out 0.24s;"></div>
                    <button id="btn-selengkapnya" onclick="bongkarPanel()"
                            class="p4-animate border border-[#c5a059] text-[#c5a059] px-8 py-2 rounded-full text-sm font-medium
                                   transition-all duration-300 hover:bg-[#c5a059] hover:text-black tracking-widest uppercase"
                            style="opacity:0; transform:translateY(20px); transition: opacity 0.6s ease-out 0.36s, transform 0.6s ease-out 0.36s, background-color 0.3s, color 0.3s;">
                        Selengkapnya
                    </button>
                </div>
            </div>

        </div>
    </section>

    {{-- ── KETENTUAN ── --}}
    @if(count($ketentuan))
    <section id="section-ketentuan" class="w-full py-16 bg-[#1a1008]">
        <div class="max-w-4xl mx-auto px-6 md:px-10">
            <div class="reveal flex items-center gap-4 mb-8">
                <div class="h-[1px] w-8 bg-[#c5a059]"></div>
                <p class="text-[#a8852f] text-[12px] uppercase tracking-[0.35em]">Ketentuan & Informasi</p>
            </div>
            <ul class="space-y-3">
                @foreach($ketentuan as $i => $note)
                <li class="ketentuan-item reveal flex items-start gap-3" style="transition-delay: {{ $i * 80 }}ms">
                    <span class="mt-1 w-5 h-5 rounded-full bg-[#2d3d1e] text-[#c5a059] text-[10px] font-bold flex items-center justify-center shrink-0">{{ $i + 1 }}</span>
                    <p class="text-[#3a3a2a] text-sm leading-relaxed">{{ $note }}</p>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    @endif

    {{-- ── KENAPA WO RESMI ── --}}
    <section class="w-full py-20">
        <div class="max-w-6xl mx-auto px-6 md:px-20">
            <div class="reveal text-center mb-16">
                <p class="text-[#a8852f] tracking-[0.3em] uppercase text-[13px] font-medium mb-3">Keunggulan Kami</p>
                <h2 class="text-[#0d1a0d] font-serif text-3xl md:text-4xl mb-3">
                    Kenapa Harus Working Order<br>Resmi Bale Hinggil?
                </h2>
                <div class="flex justify-center mb-4">
                    <div class="w-12 h-[1px] bg-[#c5a059]"></div>
                </div>
                <div class="flex justify-center mb-2">
                    <img src="{{ asset('assets/img/cyber-security.svg') }}" class="w-12">
                </div>
                <p class="text-[#3a3a2a] text-base italic font-light leading-relaxed">
                    Keamanan Terjaga — Karena Teknisi Mendapat Pelatihan Khusus
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-10 md:gap-16">
                <div class="space-y-10 md:space-y-16 text-center">
                    <div class="reveal">
                        <div class="flex justify-center mb-3"><img src="{{ asset('assets/img/support.svg') }}" class="w-10"></div>
                        <p class="text-[#1a2e1a] text-sm font-medium">Kualitas Pekerjaan<br>Terjamin & Bergaransi</p>
                    </div>
                    <div class="reveal">
                        <div class="flex justify-center mb-3"><img src="{{ asset('assets/img/management.svg') }}" class="w-10"></div>
                        <p class="text-[#1a2e1a] text-sm font-medium">Teknisi Handal &<br>Berpengalaman di<br>Bidangnya</p>
                    </div>
                </div>
                <div class="reveal flex justify-center order-first md:order-none">
                    <img src="{{ asset('assets/img/conversations.svg') }}" class="w-32">
                </div>
                <div class="space-y-10 md:space-y-16 text-center">
                    <div class="reveal">
                        <div class="flex mb-3 justify-center"><img src="{{ asset('assets/img/notes.svg') }}" class="w-10"></div>
                        <p class="text-[#1a2e1a] text-sm font-medium">Setiap Pekerjaan<br>Tercatat & Transparan</p>
                    </div>
                    <div class="reveal">
                        <div class="flex mb-3 justify-center"><img src="{{ asset('assets/img/heart.svg') }}" class="w-10"></div>
                        <p class="text-[#1a2e1a] text-sm font-medium">Respons Cepat,<br>Unit Kembali<br>Berfungsi Normal</p>
                    </div>
                </div>
            </div>

            <div class="reveal flex justify-center mt-20">
                <a href="https://wa.me/62895324255322?text={{ urlencode('Halo Admin Bale Hinggil, saya ingin menanyakan layanan Working Order.') }}"
                   target="_blank"
                   class="text-center bg-[#0d1a0d] text-white px-6 py-3 rounded-full text-sm font-medium tracking-wider uppercase max-w-[90vw]
                          hover:bg-[#c5a059] hover:text-black transition-all duration-300 shadow-lg">
                    Informasi Lebih Lanjut
                </a>
            </div>
        </div>
    </section>
</div>

<style>
@media (max-width: 640px) {
    .pb-6  { padding-bottom: 1rem !important; }
    .py-16 { padding-top: 2rem !important; padding-bottom: 2rem !important; }
    .py-20 { padding-top: 2.5rem !important; padding-bottom: 2.5rem !important; }
    .py-12 { padding-top: 1.5rem !important; padding-bottom: 1.5rem !important; }
    .mt-10 { margin-top: 1.5rem !important; }
    .mt-20 { margin-top: 1.5rem !important; }
    .mb-8  { margin-bottom: 1rem !important; }
    .mb-10 { margin-bottom: 1.5rem !important; }
    .mb-16 { margin-bottom: 1.5rem !important; }
    .gap-10 { gap: 1.5rem !important; }
    .space-y-10 > * + * { margin-top: 1.5rem !important; }
    .space-y-16 > * + * { margin-top: 1.5rem !important; }
    .reveal.flex.items-center.justify-center { justify-content: center !important; width: 100%; }
}
@media (max-width: 640px) {
    #section-panels, #section-ketentuan, .hdr-desc, .typing-text { font-size: 13px; }
    h1 { font-size: 28px !important; }
    h2 { font-size: 22px !important; }
    .tarif-card p, .tarif-card span { font-size: 13px; }
    .hdr-label, .hdr-title, .hdr-desc, .typing-text { text-align: center; }
    .hdr-divider { margin-left: auto; margin-right: auto; }
    #section-ketentuan .ketentuan-item { text-align: left; }
}
.font-serif, h1, h2, h3 { font-family: 'Palatino Linotype', 'Book Antiqua', 'Palatino', Georgia, serif; }
.perspective { perspective: 1000px; }
.transform-style { transform-style: preserve-3d; }
.backface-hidden { backface-visibility: hidden; }
.rotate-y-180 { transform: rotateY(180deg); }
.hover\:rotate-y-180:hover { transform: rotateY(180deg); }
@keyframes hdrFadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes hdrDivider {
    from { opacity: 0; transform: scaleX(0); }
    to   { opacity: 1; transform: scaleX(1); }
}
.hdr-label  { animation: hdrFadeUp 0.9s cubic-bezier(0.22,1,0.36,1) 0.2s forwards; }
.hdr-title  { animation: hdrFadeUp 1s cubic-bezier(0.22,1,0.36,1) 0.45s forwards; }
.hdr-divider { transform-origin: left; animation: hdrDivider 0.8s cubic-bezier(0.22,1,0.36,1) 1.6s forwards; }
.hdr-desc   { animation: hdrFadeUp 0.9s cubic-bezier(0.22,1,0.36,1) 1.85s forwards; }
@keyframes typing {
    from { width: 0; }
    to   { width: 100%; }
}
.typing-text { display: block; white-space: nowrap; overflow: hidden; width: 0; animation: typing 2.2s steps(30, end) 1.0s forwards; }
.hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
.hide-scrollbar::-webkit-scrollbar { display: none; }
.panel-h { height: 220px; }
.panel-overlap { margin-top: -128px; }
@media (max-width: 640px) {
    .panel-h { height: 160px; }
    .panel-overlap { margin-top: -96px; }
}
.stack-panel {
    opacity: 0;
    transform: translateY(80px);
    transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1), height 0.9s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}
.stack-panel.visible { opacity: 1; transform: translateY(0); }
.stack-panel::before {
    content: '';
    display: block;
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(197,160,89,0.35), transparent);
    position: absolute;
    top: 0; left: 8%; right: 8%;
    z-index: 2;
}
.tarif-card {
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.04), 0 2px 12px rgba(0,0,0,0.15);
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}
.tarif-card:hover { box-shadow: inset 0 1px 0 rgba(197,160,89,0.08), 0 4px 20px rgba(0,0,0,0.25); }
.panel-trigger { transition: background 0.3s ease; }
.panel-trigger:hover { background: rgba(255,255,255,0.03); }
.stack-panel.expanded .panel-chevron { transform: rotate(90deg); }
.stack-panel.expanded .panel-trigger { pointer-events: none; opacity: 0; transition: opacity 0.2s ease; }
.reveal { opacity: 0; transform: translateY(40px); transition: opacity 1.1s ease-out, transform 1.1s cubic-bezier(0.22, 1, 0.36, 1); }
.reveal.active { opacity: 1; transform: translateY(0); }
</style>

@endsection