<?php
    $decodeField = fn($val) => is_array($val) ? $val : json_decode($val ?? '[]', true);

    $fasItems     = $home ? $decodeField($home->fasilitas_items)      : [];
    $aksesList    = $home ? $decodeField($home->lokasi_akses_items)   : [];
    $layananBtns  = $home ? $decodeField($home->layanan_buttons)      : [];
    $jamList      = $home ? $decodeField($home->kontak_jam_items)     : [];
    $divisiList   = $home ? $decodeField($home->kontak_divisi_items)  : [];
    $sosmedList   = $home ? $decodeField($home->kontak_sosmed_items)  : [];
    $misiItems    = $home ? $decodeField($home->about_misi_items)     : [];
    $ytItems      = $home ? $decodeField($home->berita_yt_items)      : [];
    $artikelItems = $home ? $decodeField($home->berita_artikel_items) : [];
?>

<?php $__env->startSection('content'); ?>


<section class="relative min-h-screen flex items-center px-8 md:px-20 lg:px-28 overflow-hidden bg-[#0a0f0a]">
    <?php
        $heroIsImage = !empty($home->hero_video) && 
            preg_match('/\.(jpg|jpeg|png|webp)$/i', $home->hero_video);
    ?>
    
    <?php if(!empty($home->hero_video) && $heroIsImage): ?>
    <img src="<?php echo e(asset('storage/' . $home->hero_video)); ?>" 
         class="absolute inset-0 w-full h-full object-cover z-0" alt="Hero">
    <?php elseif(!empty($home->hero_video)): ?>
    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
        <source src="<?php echo e(asset('storage/' . $home->hero_video)); ?>" type="video/mp4">
    </video>
    <?php else: ?>
    <video autoplay loop muted playsinline poster="<?php echo e(asset('assets/images/home-poster.jpg')); ?>" class="absolute inset-0 w-full h-full object-cover z-0">
        <source src="<?php echo e(asset('assets/video/home.mp4')); ?>" type="video/mp4">
    </video>
    <?php endif; ?>
    <div class="absolute inset-0 bg-black/40 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent z-10"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_75%_40%,rgba(197,160,89,0.12),transparent_60%)] z-10"></div>

    
<div id="hero-content" class="relative z-20 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center opacity-0 transition-opacity duration-1000">
<div class="lg:col-span-7 space-y-6">
            <div class="space-y-2">
                <p class="animate-fadeUp text-gray-400 tracking-[0.3em] uppercase text-[15px] font-medium">
                    <?php echo e($home->hero_teks_baris1 ?? 'Welcome To'); ?>

                </p>
                <h1 class="animate-fadeUp animation-delay-200 font-serif leading-tight tracking-tight">
                    <span class="text-[#c5a059] text-4xl md:text-5xl lg:text-6xl block"><?php echo e($home->hero_teks_baris2 ?? 'Bale Hinggil'); ?></span>
                    <span class="text-white text-3xl md:text-4xl lg:text-5xl font-light block italic"><?php echo e($home->hero_teks_baris3 ?? 'Apartment'); ?></span>
                </h1>
            </div>
            <div class="animate-fadeUp animation-delay-400 w-24 h-[1.5px] bg-gradient-to-r from-[#c5a059] to-transparent my-6"></div>
            <p class="animate-fadeUp animation-delay-600 text-gray-300 text-sm md:text-base max-w-xl leading-relaxed font-light">
                <?php echo nl2br(e($home->hero_subjudul ?? 'Apartemen 31 lantai yang dirancang dengan konsep adequate apartment.')); ?>

            </p>
            <div class="animate-fadeUp animation-delay-800 flex flex-row gap-3 pt-6 w-full max-w-xs sm:max-w-sm md:max-w-none">
    <a href="<?php echo e($home->hero_btn1_link ?? route('user.tipeunit')); ?>"
       class="hero-btn-glow flex-1 text-center bg-[#c5a059] text-black px-4 py-3 md:px-6 md:py-4 font-semibold uppercase text-[11px] md:text-sm flex items-center justify-center gap-2 tracking-wider md:tracking-widest rounded-xl transition-all duration-300 hover:bg-[#d4af6a] hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-[0_0_12px_rgba(197,160,89,0.5)] relative overflow-hidden">
        <?php echo e($home->hero_btn1_teks ?? 'Jelajahi Unit'); ?> <span>→</span>
    </a>
    <?php
        $waNum = preg_replace('/[^0-9]/', '', $home->hero_btn2_nomor ?? '6282334466773');
    ?>
        <a href="https://wa.me/<?php echo e($waNum); ?>" target="_blank"
       class="hero-btn-glow flex-1 text-center border-2 border-[#c5a059] text-[#c5a059] rounded-xl px-4 py-3 md:px-6 md:py-4 font-semibold uppercase text-[11px] md:text-sm tracking-wider md:tracking-widest transition-all duration-300 flex items-center justify-center hover:bg-[#c5a059] hover:text-black hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-[0_0_12px_rgba(197,160,89,0.45)] relative overflow-hidden">
        <?php echo e($home->hero_btn2_teks ?? 'Hubungi Kami'); ?>

    </a>
</div>

<div class="lg:hidden col-span-1 grid grid-cols-3 gap-2 mt-2">

    <div class="hero-card-mobile bg-[#0f2a1f] border border-[#c5a059]/20 rounded-lg px-3 py-3 flex flex-col items-center justify-center gap-2 text-center" style="opacity:0; transform:translateY(20px);">
        <div class="w-7 h-7 rounded-md bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
        </div>
        <p class="text-white text-[10px] font-bold leading-tight">Lokasi Strategis</p>
    </div>

    <div class="hero-card-mobile bg-[#0f2a1f] border border-[#c5a059]/20 rounded-lg px-3 py-3 flex flex-col items-center justify-center gap-2 text-center" style="opacity:0; transform:translateY(20px);">
        <div class="w-7 h-7 rounded-md bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
        </div>
        <p class="text-white text-[10px] font-bold leading-tight">Investasi & Passive Income</p>
    </div>

    <div class="hero-card-mobile bg-[#0f2a1f] border border-[#c5a059]/20 rounded-lg px-3 py-3 flex flex-col items-center justify-center gap-2 text-center" style="opacity:0; transform:translateY(20px);">
        <div class="w-7 h-7 rounded-md bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
        </div>
        <p class="text-white text-[10px] font-bold leading-tight">Kenaikan Nilai Properti</p>
    </div>

</div>
<style>
.hero-btn-glow::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent 20%, rgba(255,255,255,0.18) 50%, transparent 80%);
    transform: translateX(-100%);
    transition: transform 0.55s ease;
    pointer-events: none;
    border-radius: inherit;
}
.hero-btn-glow:hover::before {
    transform: translateX(100%);
}
</style>
        </div>
    </div>
    
<div class="lg:col-span-5 hidden lg:flex flex-col gap-3 justify-center pt-6 lg:pt-0">

    <div class="hero-card bg-[#0f2a1f] border border-[#c5a059]/20 rounded-lg px-5 py-5 flex items-start justify-between gap-4 hover:border-[#c5a059]/50 transition-colors duration-300" style="opacity:0; transform:translateY(30px);">
        <div>
            <p class="text-white text-lg font-bold leading-tight">Lokasi Strategis</p>
            <p class="text-gray-400 text-xs mt-1">Akses mudah ke pusat kota, bisnis, pendidikan, dan hiburan.</p>
        </div>
        <div class="w-8 h-8 rounded-lg bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
        </div>
    </div>

    <div class="hero-card bg-[#0f2a1f] border border-[#c5a059]/20 rounded-lg px-5 py-5 flex items-start justify-between gap-4 hover:border-[#c5a059]/50 transition-colors duration-300" style="opacity:0; transform:translateY(30px);">
        <div>
            <p class="text-white text-lg font-bold leading-tight">Cocok untuk Investasi & Passive Income</p>
            <p class="text-gray-400 text-xs mt-1">Didukung sistem persewaan profesional (short & long stay).</p>
        </div>
        <div class="w-8 h-8 rounded-lg bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
        </div>
    </div>

    <div class="hero-card bg-[#0f2a1f] border border-[#c5a059]/20 rounded-lg px-5 py-5 flex items-start justify-between gap-4 hover:border-[#c5a059]/50 transition-colors duration-300" style="opacity:0; transform:translateY(30px);">
        <div>
            <p class="text-white text-lg font-bold leading-tight">Potensi Kenaikan Nilai Properti</p>
            <p class="text-gray-400 text-xs mt-1">Berada di kawasan berkembang dengan prospek tinggi.</p>
        </div>
        <div class="w-8 h-8 rounded-lg bg-[#c5a059]/10 border border-[#c5a059]/20 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
        </div>
    </div>

</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const hero = document.getElementById('hero-content');
    window.onload = () => {
        setTimeout(() => {
            hero.classList.remove('opacity-0');
            hero.classList.add('opacity-100');
        }, 100);

        // Desktop cards
        document.querySelectorAll('.hero-card').forEach((card, i) => {
            setTimeout(() => {
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                card.style.transform = 'translateY(0)';
                card.style.opacity = '1';
            }, 400 + (i * 200));
        });

        // Mobile cards
        document.querySelectorAll('.hero-card-mobile').forEach((card, i) => {
            setTimeout(() => {
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                card.style.transform = 'translateY(0)';
                card.style.opacity = '1';
            }, 800 + (i * 150));
        });
    };
});
</script>
</section>




<section class="relative bg-[#0f2a1f] py-24 px-8 md:px-20 lg:px-28">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start mb-12">
            <div class="lg:col-span-5 relative fade-up-scroll flex flex-col gap-6">
                <?php if(!empty($home->about_foto)): ?>
                <img id="about-foto-img" src="<?php echo e(asset('storage/' . $home->about_foto)); ?>" alt="About"
                     class="rounded-[0.5rem] w-full aspect-[3/3] object-cover border border-[#c5a059]/20 shadow-2xl">
                <?php else: ?>
                <img id="about-foto-img" src="<?php echo e(asset('assets/img/rating.jpeg')); ?>" alt="About"
                     class="rounded-[0.5rem] w-full aspect-[3/3] object-cover border border-[#c5a059]/20 shadow-2xl">
                <?php endif; ?>

                
                <div class="bg-[#1a3d2a] p-6 rounded-md border border-[#c5a059]/20 flex items-center justify-between shadow-xl">
                    <div class="flex items-center gap-4">
                        <span class="text-4xl font-serif text-white"><?php echo e($home->about_review_rating ?? '3,6'); ?></span>
                        <div class="flex flex-col">
                            <div class="text-[#c5a059] text-sm tracking-tighter">★★★★★</div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-widest leading-none mt-1">
                                <?php echo e($home->about_review_jumlah ?? '383 Reviews on Google'); ?>

                            </p>
                        </div>
                    </div>
                    <a href="<?php echo e($home->about_review_link ?? '#'); ?>" target="_blank"
                       class="bg-[#c5a059] text-black px-6 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest border border-[#c5a059]/20 hover:bg-white hover:text-[#c5a059] transition duration-300">
                        More Review
                    </a>
                </div>
            </div>

    
            <div class="lg:col-span-7 flex flex-col h-full space-y-8">

                <div class="fade-up-scroll space-y-2">
                    <h2 class="text-white text-4xl md:text-5xl font-serif tracking-tight">
                        <?php echo e($home->about_judul ?? 'Who Are We?'); ?>

                    </h2>
                    <div class="mt-2">
                        <p class="text-[#c5a059] text-[10px] uppercase tracking-[0.4em] font-bold">Developer di Balik Apartemen Bale Hinggil</p>
                    </div>
                <div class="w-20 h-[2px] bg-[#c5a059] mt-4"></div>
                </div>
                <div class="fade-up-scroll">
                    <p class="text-gray-400 text-sm leading-relaxed">
                        PT Tlatah Gema Anugrah (TGA) adalah perusahaan pengembang properti yang berkomitmen menghadirkan hunian modern dengan standar kualitas tinggi, konsep inovatif, serta nilai investasi yang berkelanjutan. Berbekal pengalaman dan visi jangka panjang di industri properti, TGA hadir sebagai developer terpercaya yang tidak hanya membangun hunian, tetapi juga menciptakan ekosistem kehidupan yang nyaman, produktif, dan bernilai tinggi.
                    </p>
                </div>
                <div class="fade-up-scroll">
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Apartemen Balehinggil merupakan salah satu proyek unggulan dari PT TGA yang dirancang sebagai hunian modern dengan konsep <span class="text-[#c5a059] italic font-medium">smart living &amp; lifestyle integrated</span>. Menghadirkan lebih dari sekadar tempat tinggal, Balehinggil adalah solusi bagi:
                    </p>
                </div>
                <div class="fade-up-scroll w-full py-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 w-full">
                        <div class="flex flex-col items-center text-center px-4 py-5">
                            <div class="mb-4">
                                <svg viewBox="0 0 56 56" class="w-8 h-8 drop-shadow-[0_0_8px_rgba(197,160,89,0.5)] animate-pulse" style="animation-duration:3s;" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="8" y="8" width="40" height="40" rx="8" fill="rgba(197,160,89,0.15)" stroke="#c5a059" stroke-width="1.2" transform="rotate(45 28 28)"/>
                                    <rect x="14" y="14" width="28" height="28" rx="6" fill="rgba(197,160,89,0.08)" stroke="#c5a059" stroke-width="0.6" stroke-dasharray="3 3" transform="rotate(45 28 28)"/>
                                </svg>
                            </div>
                            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug">Profesional<br>Muda</p>
                            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">Karir &amp; Gaya Hidup</p>
                        </div>
                        <div class="flex flex-col items-center text-center px-4 py-5 relative">
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-[85%] w-[1px] bg-[#c5a059]/20"></span>
                            <div class="mb-4">
                                <svg viewBox="0 0 56 56" class="w-8 h-8 drop-shadow-[0_0_8px_rgba(197,160,89,0.5)] animate-pulse" style="animation-duration:3s; animation-delay:0.75s;" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="8" y="8" width="40" height="40" rx="8" fill="rgba(197,160,89,0.15)" stroke="#c5a059" stroke-width="1.2" transform="rotate(45 28 28)"/>
                                    <rect x="14" y="14" width="28" height="28" rx="6" fill="rgba(197,160,89,0.08)" stroke="#c5a059" stroke-width="0.6" stroke-dasharray="3 3" transform="rotate(45 28 28)"/>
                                </svg>
                            </div>
                            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug">Keluarga<br>Modern</p>
                            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">Hunian Nyaman</p>
                        </div>
                        <div class="flex flex-col items-center text-center px-4 py-5 relative">
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-[85%] w-[1px] bg-[#c5a059]/20"></span>
                            <div class="mb-4">
                                <svg viewBox="0 0 56 56" class="w-8 h-8 drop-shadow-[0_0_8px_rgba(197,160,89,0.5)] animate-pulse" style="animation-duration:3s; animation-delay:1.5s;" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="8" y="8" width="40" height="40" rx="8" fill="rgba(197,160,89,0.15)" stroke="#c5a059" stroke-width="1.2" transform="rotate(45 28 28)"/>
                                    <rect x="14" y="14" width="28" height="28" rx="6" fill="rgba(197,160,89,0.08)" stroke="#c5a059" stroke-width="0.6" stroke-dasharray="3 3" transform="rotate(45 28 28)"/>
                                </svg>
                            </div>
                            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug">Investor<br>Properti</p>
                            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">Nilai Investasi</p>
                        </div>
                        <div class="flex flex-col items-center text-center px-4 py-5 relative">
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-[85%] w-[1px] bg-[#c5a059]/20"></span>
                            <div class="mb-4">
                                <svg viewBox="0 0 56 56" class="w-8 h-8 drop-shadow-[0_0_8px_rgba(197,160,89,0.5)] animate-pulse" style="animation-duration:3s; animation-delay:2.25s;" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="8" y="8" width="40" height="40" rx="8" fill="rgba(197,160,89,0.15)" stroke="#c5a059" stroke-width="1.2" transform="rotate(45 28 28)"/>
                                    <rect x="14" y="14" width="28" height="28" rx="6" fill="rgba(197,160,89,0.08)" stroke="#c5a059" stroke-width="0.6" stroke-dasharray="3 3" transform="rotate(45 28 28)"/>
                                </svg>
                            </div>
                            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug">Content<br>Creator</p>
                            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">Digital Entrepreneur</p>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>

       
        <div class="fade-up-scroll grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

            <div class="flex flex-col gap-6">

                
                <div class="bg-[#1a3d2a]/60 border border-[#c5a059]/15 rounded-2xl p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-[#0f2a1f] border border-[#c5a059]/20 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[#c5a059] text-[10px] uppercase tracking-[0.3em] font-bold">Our Vision</p>
                            <h3 class="text-white text-2xl font-serif">Visi</h3>
                        </div>
                    </div>
                    <div class="w-10 h-[1px] bg-[#c5a059]/40 mb-6"></div>
                    <div class="space-y-4">
                        <?php $__currentLoopData = ['Menjadi developer properti terpercaya yang menghadirkan hunian berkualitas, bernilai investasi tinggi, dan berkontribusi terhadap pertumbuhan kawasan modern di Indonesia.']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="text-gray-400 text-sm leading-relaxed"><?php echo e($visi); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div class="bg-[#1a3d2a]/60 border border-[#c5a059]/15 rounded-2xl p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-xl bg-[#0f2a1f] border border-[#c5a059]/20 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[#c5a059] text-[10px] uppercase tracking-[0.3em] font-bold">Our Mission</p>
                            <h3 class="text-white text-2xl font-serif">Misi</h3>
                        </div>
                    </div>
                    <div class="w-10 h-[1px] bg-[#c5a059]/40 mb-6"></div>
                    <div class="space-y-4">
                        <?php $__currentLoopData = [
                            'Mengembangkan proyek properti dengan desain modern dan fungsional',
                            'Memberikan kualitas bangunan terbaik dengan standar tinggi',
                            'Menciptakan lingkungan hunian yang nyaman, aman, dan bernilai jual tinggi',
                            'Memberikan pelayanan profesional kepada seluruh customer dan investor',
                            'Menghadirkan inovasi dalam pengelolaan apartemen dan kawasan komersial'
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $misi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 w-5 h-5 rounded-md bg-[#0f2a1f] border border-[#c5a059]/20 flex items-center justify-center shrink-0 text-[#c5a059] text-[10px] font-bold"><?php echo e($i + 1); ?></span>
                            <p class="text-gray-400 text-sm leading-relaxed"><?php echo e($misi); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

            </div>

            
            <div class="flex flex-col">
                <div class="mb-4 flex items-center justify-center gap-4">
                    <div class="h-[1px] w-16 bg-gradient-to-r from-transparent to-[#c5a059]"></div>
                    <p class="text-[#c5a059] text-[10px] uppercase tracking-[0.4em] font-bold">Why Choose Us</p>
                    <div class="h-[1px] w-16 bg-gradient-to-l from-transparent to-[#c5a059]"></div>
                </div>

                <div class="flex flex-col gap-3">

                    <div class="why-item group flex items-start gap-5 py-5 px-6 transition-all duration-300 hover:bg-[#1a3d2a] cursor-default relative">
                        <span class="absolute left-0 top-3 bottom-3 w-[2.5px]" style="background: rgba(197,160,89,0.35);"></span>
                        <div class="w-10 h-10 flex items-center justify-center shrink-0 transition-all duration-300 border border-transparent group-hover:bg-[#0f2a1f] group-hover:border-[#c5a059]/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-[0.15em] mb-1">Developer Berpengalaman & Terpercaya</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Dikelola oleh tim profesional yang memahami pasar properti dan kebutuhan modern lifestyle.</p>
                        </div>
                    </div>

                    <div class="why-item group flex items-start gap-5 py-5 px-6 transition-all duration-300 hover:bg-[#1a3d2a] cursor-default relative">
                        <span class="absolute left-0 top-3 bottom-3 w-[2.5px]" style="background: rgba(197,160,89,0.35);"></span>
                        <div class="w-10 h-10 flex items-center justify-center shrink-0 transition-all duration-300 border border-transparent group-hover:bg-[#0f2a1f] group-hover:border-[#c5a059]/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-[0.15em] mb-1">Fasilitas Fokus Pada Nilai Investasi</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Setiap proyek dirancang tidak hanya sebagai tempat tinggal, tetapi juga sebagai aset investasi yang terus berkembang.</p>
                        </div>
                    </div>

                    <div class="why-item group flex items-start gap-5 py-5 px-6 transition-all duration-300 hover:bg-[#1a3d2a] cursor-default relative">
                        <span class="absolute left-0 top-3 bottom-3 w-[2.5px]" style="background: rgba(197,160,89,0.35);"></span>
                        <div class="w-10 h-10 flex items-center justify-center shrink-0 transition-all duration-300 border border-transparent group-hover:bg-[#0f2a1f] group-hover:border-[#c5a059]/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" /></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-[0.15em] mb-1">Konsep Terintegrasi</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Menggabungkan hunian, area komersial, dan fasilitas lifestyle dalam satu kawasan.</p>
                        </div>
                    </div>

                    <div class="why-item group flex items-start gap-5 py-5 px-6 transition-all duration-300 hover:bg-[#1a3d2a] cursor-default relative">
                        <span class="absolute left-0 top-3 bottom-3 w-[2.5px]" style="background: rgba(197,160,89,0.35);"></span>
                        <div class="w-10 h-10 flex items-center justify-center shrink-0 transition-all duration-300 border border-transparent group-hover:bg-[#0f2a1f] group-hover:border-[#c5a059]/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-[0.15em] mb-1">Kualitas Dan Detail</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Mengutamakan kualitas konstruksi, desain interior, serta kenyamanan penghuni.</p>
                        </div>
                    </div>

                    <div class="why-item group flex items-start gap-5 py-5 px-6 transition-all duration-300 hover:bg-[#1a3d2a] cursor-default relative">
                        <span class="absolute left-0 top-3 bottom-3 w-[2.5px]" style="background: rgba(197,160,89,0.35);"></span>
                        <div class="w-10 h-10 flex items-center justify-center shrink-0 transition-all duration-300 border border-transparent group-hover:bg-[#0f2a1f] group-hover:border-[#c5a059]/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" /></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-xs uppercase tracking-[0.15em] mb-1">After Sales & Manajemen Support</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Didukung dengan sistem pengelolaan apartemen profesional (rental, cleaning, maintenance).</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        
<div class="fade-up-scroll mt-10 w-full border border-[#c5a059]/20 rounded-lg overflow-hidden">
    <div class=" bg-[#1a3d2a]  px-8 py-4 border-b border-[#c5a059]/15 flex items-center justify-center gap-4">
        <div class="h-[1px] w-16 bg-gradient-to-r from-transparent to-[#c5a059]"></div>
        <span class="text-[#c5a059] text-[10px] uppercase tracking-[0.4em] font-bold">Kenapa Harus Investasi di Balehinggil?</span>
        <div class="h-[1px] w-16 bg-gradient-to-l from-transparent to-[#c5a059]"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-[#c5a059]/10 bg-[#0f2a1f]/80">

        <div class="flex flex-col items-center text-center px-4 py-5 hover:bg-[#1a3d2a]/60 transition-all duration-300 group">
            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug mb-1">Developer<br>Terpercaya</p>
            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">PT TGA</p>
        </div>

        <div class="flex flex-col items-center text-center px-4 py-5 hover:bg-[#1a3d2a]/60 transition-all duration-300 group">
            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug mb-1">Manajemen<br>Siap Jalan</p>
            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">Tanpa Repot</p>
        </div>

        <div class="flex flex-col items-center text-center px-4 py-5 hover:bg-[#1a3d2a]/60 transition-all duration-300 group">
            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug mb-1">Income<br>Pasif</p>
            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">Harian / Bulanan</p>
        </div>

        <div class="flex flex-col items-center text-center px-4 py-5 hover:bg-[#1a3d2a]/60 transition-all duration-300 group">
            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug mb-1">Konsep<br>Kekinian</p>
            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">Lifestyle + Bisnis</p>
        </div>

        <div class="flex flex-col items-center text-center px-4 py-5 hover:bg-[#1a3d2a]/60 transition-all duration-300 group">
            <p class="text-white text-[11px] font-bold uppercase tracking-[0.18em] leading-snug mb-1">Market<br>Luas</p>
            <p class="text-gray-500 text-[9px] uppercase tracking-widest mt-1">Tenant & Expat</p>
        </div>

    </div>
</div>
            </div>
        </div>

        <script>
        document.querySelectorAll('.why-item').forEach(function(item) {
            var line = item.querySelector('.why-line');
            item.addEventListener('mouseenter', function() {
                line.style.background = 'rgba(197,160,89,0.35)';
            });
            item.addEventListener('mouseleave', function() {
                line.style.background = 'transparent';
            });
        });
        </script>
</section>


<section id="layanan" class="bg-[#fff6e5] text-[#0f2a1f]">
    <div class="max-w-7xl mx-auto px-8 md:px-20 lg:px-28 py-20">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div class="fade-left-scroll space-y-4 text-center md:text-left">
               <div class="flex items-center gap-4 justify-center md:justify-start">
                    <div class="w-10 h-[1px] bg-[#c6a85b]"></div>
                    <p class="text-xs tracking-[4px] uppercase text-[#c6a85b]">
                        <b><?php echo e($home->layanan_tag ?? 'Our Services'); ?></b>
                    </p>
                </div>
                <h2 class="font-serif leading-[1.1]">
                    <span class="block text-[#0f2a1f] text-5xl md:text-6xl italic">
                        <?php echo e($home->layanan_judul ?? 'Layanan'); ?>

                    </span>
                </h2>
            </div>
            <div class="fade-right-scroll text-center md:text-left">
    <p class="text-[#0f2a1f] leading-relaxed text-lg">
                    <?php echo e($home->layanan_deskripsi ?? ''); ?>

                </p>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="h-auto min-h-[480px] bg-cover bg-center relative"
            style="background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.55)), url('<?php echo e(!empty($home->layanan_foto_bg) ? asset('storage/' . $home->layanan_foto_bg) : asset('assets/img/layanan.jpg')); ?>');">

            <div class="absolute inset-0 flex items-center justify-center px-8 md:px-20 py-14">
                <div class="fade-up-scroll grid grid-cols-2 md:grid-cols-3 w-full max-w-3xl" style="gap: 10px 28px;">

                    <?php
                    $layananSvgIcons = [
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" /></svg>',
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>',
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" /></svg>',
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>',
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>',
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" /></svg>',
                    ];
                    ?>

                   <?php $__currentLoopData = $layananBtns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $btn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<a href="<?php echo e($btn['teks'] === 'Commercial Area' ? route('commercial-area') : ($btn['link'] ?? '#')); ?>"
   class="layanan-btn group relative overflow-hidden flex flex-col gap-3 rounded-xl no-underline transition-all duration-300"
   style="
       background: rgba(10, 38, 24, 0.88);
       border: 1px solid rgba(197,160,89,0.22);
       padding: 18px 18px 16px;
       min-height: 110px;
       animation-delay: <?php echo e($index * 80); ?>ms;
   ">
    <span class="layanan-shimmer"></span>
    <div class="flex items-center gap-3 relative z-10">
        <span class="layanan-icon flex items-center justify-center w-9 h-9 rounded-xl flex-shrink-0 transition-all duration-300"
              style="background: rgba(197,160,89,0.12); color: #c5a059; border: 1px solid rgba(197,160,89,0.25);">
            <?php echo $layananSvgIcons[$index % count($layananSvgIcons)]; ?>

        </span>
        <span class="text-[11px] font-bold tracking-[0.18em] uppercase leading-tight transition-colors duration-300 layanan-title"
              style="color: #f0e8d8;">
            <?php echo e($btn['teks'] ?? ''); ?>

        </span>
    </div>
    <?php if(!empty($btn['deskripsi'])): ?>
    <p class="layanan-desc text-[11px] leading-relaxed font-serif m-0 relative z-10 transition-colors duration-300 pl-[48px]"
       style="color: rgba(197,160,89,0.55);">
        <?php echo e($btn['deskripsi']); ?>

    </p>
    <?php endif; ?>
</a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            </div>
        </div>
    </div>

    <style>
.layanan-btn:hover {
    background: rgba(12, 46, 28, 0.97) !important;
    border-color: rgba(197,160,89,0.6) !important;
    transform: translateY(-4px) scale(1.012);
    box-shadow:
        0 0 24px 6px rgba(197,160,89,0.22),
        0 12px 32px rgba(197,160,89,0.12);
}

.layanan-btn:hover .layanan-icon {
    background: rgba(197,160,89,0.2) !important;
    border-color: rgba(197,160,89,0.5) !important;
    box-shadow: 0 0 18px 4px rgba(197,160,89,0.45);
    transform: scale(1.12);
    color: #d4af6a !important;
}

.layanan-btn:hover .layanan-title {
    color: #f8e9b8 !important;
}

.layanan-btn:hover .layanan-desc {
    color: rgba(197,160,89,0.85) !important;
}

.layanan-shimmer {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent 20%, rgba(197,160,89,0.07) 50%, transparent 80%);
    transform: translateX(-100%);
    transition: transform 0.55s ease;
    pointer-events: none;
    border-radius: inherit;
}

.layanan-btn:hover .layanan-shimmer {
    transform: translateX(100%);
}
</style>

    <script>
    document.addEventListener("DOMContentLoaded", function(){
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) e.target.classList.add("show");
            });
        }, { threshold: 0.2 });

        document.querySelectorAll(".fade-up-scroll, .fade-left-scroll, .fade-right-scroll")
            .forEach(el => obs.observe(el));
    });
    </script>
</section>


<section id="fasilitas" class="relative bg-[#0f2a1f] pt-10 pb-12 scroll-mt-70">
    <div class="max-w-7xl mx-auto px-8 md:px-20 lg:px-28">
        <div class="fade-up-scroll text-center mb-16">
            <p class="text-sm tracking-[4px] text-[#c6a85b] uppercase mb-4"><?php echo e($home->fasilitas_tag ?? 'Fasilitas'); ?></p>
            <h2 class="text-white text-4xl md:text-5xl lg:text-6xl font-serif font-light leading-tight">
                <?php echo e($home->fasilitas_judul1 ?? 'Hidup Lebih dari'); ?>

                <span class="italic text-[#c6a85b]"><?php echo e($home->fasilitas_judul2 ?? 'Sekadar Hunian'); ?></span>
            </h2>
            <div class="w-20 h-[2px] bg-[#c6a85b] mx-auto my-6"></div>
            <p class="text-white max-w-2xl mx-auto text-lg leading-relaxed">
                <?php echo e($home->fasilitas_deskripsi ?? ''); ?>

            </p>
        </div>

        <?php if(!empty($fasItems)): ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <?php $firstItem = $fasItems[0] ?? null; ?>
            <?php if($firstItem): ?>
            <div class="fade-up-scroll relative lg:col-span-2 group overflow-hidden rounded-2xl">
                <?php
    $firstFotoUrl = !empty($firstItem['foto_preview']) ? $firstItem['foto_preview']
        : (!empty($firstItem['foto'])
            ? (str_starts_with($firstItem['foto'],'assets/') ? asset($firstItem['foto']) : asset('storage/'.$firstItem['foto']))
            : asset('assets/img/kolam.jpg'));
?>
                <img src="<?php echo e($firstFotoUrl); ?>" class="w-full h-[235px] lg:h-[500px] object-cover transition duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                <div class="absolute bottom-8 left-8 text-white">
                    <h3 class="text-3xl font-serif mb-2"><?php echo e($firstItem['judul'] ?? ''); ?></h3>
                    <p class="text-gray-200 max-w-md"><?php echo e($firstItem['keterangan'] ?? ''); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php
                $fasDefaults = ['assets/img/gym.jpg', 'assets/img/playground.jpg', 'assets/img/kolam.jpg'];
            ?>
            <div class="flex flex-col gap-6">
                <?php $__currentLoopData = array_slice($fasItems, 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fasIdx => $fas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="fade-up-scroll relative group overflow-hidden rounded-2xl">
                    <?php
                        $fasFotoUrl = '';
                        if (!empty($fas['foto'])) {
                            $fasFotoUrl = str_starts_with($fas['foto'], 'assets/')
                                ? asset($fas['foto'])
                                : asset('storage/' . $fas['foto']);
                        } else {
                            $fasFotoUrl = asset($fasDefaults[$fasIdx] ?? 'assets/img/gym.jpg');
                        }
                    ?>
                    <img src="<?php echo e($fasFotoUrl); ?>" class="w-full h-[235px] object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h3 class="text-xl font-serif mb-1"><?php echo e($fas['judul'] ?? ''); ?></h3>
                        <p class="text-gray-200 text-sm"><?php echo e($fas['keterangan'] ?? ''); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>



<section id="lokasi" class="py-12 bg-[#fff6e5] font-sans">
    <div class="max-w-7xl mx-auto px-8 md:px-20 lg:px-28">
        <div class="text-center mb-10 fade-up-scroll">
            <div class="flex items-center justify-center gap-3 mb-2">
                <div class="h-[1px] w-10 bg-[#c5a059]"></div>
                <span class="text-[#c5a059] font-bold tracking-[0.2em] uppercase text-xs"><?php echo e($home->lokasi_tag ?? 'Lokasi'); ?></span>
                <div class="h-[1px] w-10 bg-[#c5a059]"></div>
            </div>
            <h2 class="text-3xl md:text-5xl font-serif text-[#0f2a1f] leading-tight">
                <?php echo e($home->lokasi_judul1 ?? 'Strategis di Jantung'); ?><br>
                <span class="italic text-[#c5a059]"><?php echo e($home->lokasi_judul2 ?? 'Surabaya Timur'); ?></span>
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
            
            <div class="fade-up-scroll relative rounded-2xl overflow-hidden shadow-xl" style="min-height:480px; position:relative;">
    <?php if(!empty($home->lokasi_gmaps_embed)): ?>
        <?php echo $home->lokasi_gmaps_embed; ?>

    <?php else: ?>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.3915759719225!2d112.77882707431479!3d-7.309830771868249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7faf4046567bd%3A0x53447890bfbd91bc!2sApartemen%20Bale%20Hinggil!5e0!3m2!1sid!2sid!4v1774510063999!5m2!1sid!2sid" class="absolute inset-0 w-full h-full border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <?php endif; ?>
            </div>

            <div class="flex flex-col gap-5">
                
                <div class="fade-up-scroll bg-[#0f2a1f] p-8 rounded-[1rem] shadow-lg">
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-5 h-5 text-[#c5a059]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-[#c5a059] text-xs font-black uppercase tracking-widest">Alamat</span>
                    </div>
                    <h3 class="text-white text-2xl md:text-3xl font-bold mb-2"><?php echo e($home->lokasi_nama_gedung ?? 'Apartement Bale Hinggil'); ?></h3>
                    <p class="text-gray-400 text-xs leading-relaxed"><?php echo e($home->lokasi_alamat_lengkap ?? ''); ?></p>
                </div>

                
                <?php if(!empty($aksesList)): ?>
                <div class="fade-up-scroll bg-[#1a352a] p-6 rounded-2xl shadow-md flex-1">
                    <span class="text-[#c5a059] text-xs font-black uppercase tracking-widest mb-5 block">Akses Terdekat</span>
                    <?php
                        $aksesIcons = ['🛍️','🏥','🎓','🎓','✈️','🏢','🏫','🏪','⛪','🚉'];
                    ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $aksesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ai => $akses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex justify-between items-center text-xs group">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 flex items-center justify-center bg-[#0f2a1f] rounded text-sm flex-shrink-0"><?php echo e($aksesIcons[$ai] ?? '📍'); ?></span>
                                <span class="text-white group-hover:text-[#c5a059] transition"><?php echo e($akses['nama'] ?? ''); ?></span>
                            </div>
                            <span class="text-[#c5a059] font-medium ml-3 flex-shrink-0"><?php echo e($akses['waktu'] ?? ''); ?></span>
                        </div>
                        <?php if(!$loop->last): ?><div class="h-[1px] w-full bg-white/5"></div><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<section id="berita" class="bg-[#f2e8d0] py-12 scroll-mt-70">
    <div class="max-w-7xl mx-auto px-8 md:px-20 lg:px-28">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12 gap-4">
            <div>
                <p class="fade-left-scroll text-[#c5a059] font-medium tracking-[0.3em] uppercase text-sm mb-4">
                    <?php echo e($home->berita_tag ?? 'BERITA'); ?>

                </p>
                <h2 class="fade-left-scroll font-serif leading-[1.1] text-gray-900">
                    <span class="block text-4xl md:text-5xl"><?php echo e($home->berita_judul1 ?? 'Update Terkini'); ?></span>
                    <span class="block text-[#c5a059] italic text-3xl md:text-4xl mt-2"><?php echo e($home->berita_judul2 ?? 'Bale Hinggil'); ?></span>
                </h2>
            </div>
            <?php if(!empty($home->berita_link_semua)): ?>
            <a href="<?php echo e($home->berita_link_semua); ?>" target="_blank"
               class="fade-right-scroll md:self-auto self-start rounded-[0.5rem] border-2 border-[#c5a059] text-[#c5a059] px-8 py-3 font-semibold uppercase text-xs tracking-widest hover:bg-[#c5a059] hover:text-white transition-all duration-300 inline-block">
                Semua Berita
            </a>
            <?php endif; ?>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php $__currentLoopData = $ytItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $ytId = '';
                if (!empty($yt['url'])) {
                    preg_match('/(?:youtu\.be\/|watch\?v=|embed\/)([a-zA-Z0-9_-]{11})/', $yt['url'], $m);
                    $ytId = $m[1] ?? '';
                }
                $ytLink = !empty($yt['link']) ? $yt['link'] : ($yt['url'] ?? '#');
            ?>
            <div class="fade-up-scroll bg-[#0f2a1f] rounded-2xl overflow-hidden shadow-lg hover:-translate-y-2 hover:shadow-2xl transition duration-300 group flex flex-col h-full">
                <div class="relative">
                    <div class="aspect-video">
                        <?php if($ytId): ?>
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/<?php echo e($ytId); ?>" allowfullscreen></iframe>
                        <?php endif; ?>
                    </div>
                    <span class="absolute top-4 left-4 bg-[#c5a059] text-white text-xs font-bold px-4 py-1 rounded-full">YOUTUBE</span>
                </div>
                <div class="p-6 text-white flex-1 flex flex-col">
                    <p class="text-sm text-gray-300 mb-2"><?php echo e($yt['tanggal'] ?? ''); ?><?php echo e(!empty($yt['tanggal']) && !empty($yt['durasi']) ? ' • ' : ''); ?><?php echo e($yt['durasi'] ?? ''); ?></p>
                    <h3 class="text-xl font-semibold leading-snug mb-3"><?php echo e($yt['judul'] ?? ''); ?></h3>
                    <p class="text-gray-300 text-sm mb-6"><?php echo e(Str::limit($yt['deskripsi'] ?? '', 100)); ?></p>
                    <div class="mt-auto flex items-center justify-between text-sm">
                        <span class="text-gray-400"><?php echo e($yt['channel'] ?? ''); ?></span>
                        <a href="<?php echo e($ytLink); ?>" target="_blank" class="text-[#c5a059] font-semibold hover:text-white transition-all duration-300">Tonton →</a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php $__currentLoopData = $artikelItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="fade-up-scroll bg-[#0f2a1f] rounded-2xl overflow-hidden shadow-lg hover:-translate-y-2 hover:shadow-2xl transition duration-300 flex flex-col h-full">
                <div class="relative">
                    <?php
                        $artFotoUrl = '';
                        if (!empty($art['foto'])) {
                            $artFotoUrl = str_starts_with($art['foto'], 'assets/')
                                ? asset($art['foto'])
                                : asset('storage/' . $art['foto']);
                        } else {
                            $artFotoUrl = asset('assets/img/berita3.jpg');
                        }
                    ?>
                    <img src="<?php echo e($artFotoUrl); ?>" class="w-full h-56 object-cover" />
                    <span class="absolute top-4 left-4 bg-[#c5a059] text-white text-xs font-bold px-4 py-1 rounded-full">BERITA</span>
                </div>
                <div class="p-6 text-white flex-1 flex flex-col">
                    <p class="text-sm text-gray-300 mb-2"><?php echo e($art['tanggal'] ?? ''); ?><?php echo e(!empty($art['tanggal']) && !empty($art['jam']) ? ' • ' : ''); ?><?php echo e($art['jam'] ?? ''); ?></p>
                    <h3 class="text-xl font-semibold mb-3"><?php echo e($art['judul'] ?? ''); ?></h3>
                    <p class="text-gray-300 text-sm mb-6"><?php echo e(Str::limit($art['ringkasan'] ?? '', 120)); ?></p>
                    <div class="mt-auto flex items-center justify-between text-sm">
                        <span class="text-gray-400"><?php echo e($art['penerbit'] ?? ''); ?></span>
                        <?php if(!empty($art['link'])): ?>
                        <a href="<?php echo e($art['link']); ?>" target="_blank" class="text-[#c5a059] font-semibold hover:text-white transition-all duration-300">Baca →</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>



<section id="kontak" class="bg-[#fff6e5] pb-0 px-0 scroll-mt-78">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12">
            <div class="lg:col-span-4 bg-[#0d2118] px-8 md:px-24 lg:px-28 py-10 md:py-14 text-white flex flex-col justify-between">
    <div>
        <h2 class="text-2xl font-serif mb-2"><?php echo e($home->kontak_judul ?? 'Informasi Kontak'); ?></h2>
                    <div class="w-12 h-[1px] bg-[#c5a059] mb-10"></div>
                    <div class="space-y-8">
                        
                        <?php if(!empty($home->kontak_telepon)): ?>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full border border-[#c5a059]/30 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Telepon</p>
                                <p class="text-lg font-light"><?php echo e($home->kontak_telepon); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                       
                        <?php if(!empty($jamList)): ?>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full border border-[#c5a059]/30 flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Jam Operasional</p>
                                <p class="text-base font-light leading-relaxed">
                                    <?php $__currentLoopData = $jamList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($jam); ?><br><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if(!empty($sosmedList)): ?>
                <div class="mt-12 lg:mt-0">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 mb-4 font-bold">Ikuti Kami</p>
                    <?php
                        $sosmedSvgs = [
                            'bi-instagram' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>',
                            'bi-tiktok'    => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5" /></svg>',
                            'bi-youtube'   => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33 2.78 2.78 0 001.94 2C5.12 19.5 12 19.5 12 19.5s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.33 29 29 0 00-.46-5.33z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 15.02l5.75-3.27-5.75-3.27v6.54z" /></svg>',
                            'bi-facebook'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" /></svg>',
                        ];
                    ?>
                    <div class="flex gap-4">
                        <?php $__currentLoopData = $sosmedList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($s['icon'])): ?>
                        <a href="<?php echo e(!empty($s['link']) ? $s['link'] : '#'); ?>"
                           <?php echo e(!empty($s['link']) ? 'target=_blank' : ''); ?>

                           class="w-10 h-10 rounded-xl border border-white/10 flex items-center justify-center hover:border-[#c5a059] transition group">
                            <?php echo $sosmedSvgs[$s['icon']] ?? '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101" /></svg>'; ?>

                        </a>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            
            <div class="lg:col-span-8 bg-[#132b21] px-8 md:px-14 lg:px-20 pr-8 md:pr-24 lg:pr-28 py-10 md:py-14 border-l border-white/5">
                <?php if(session('contact_success') || session('success')): ?>
                <div id="alert-success" class="mb-6 flex items-start gap-4 bg-[#1a3d2a] border border-[#c5a059]/30 rounded-xl px-5 py-4">
                    <div class="w-9 h-9 rounded-full bg-[#c5a059]/20 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c5a059]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-white font-semibold text-sm mb-1">Pesan berhasil dikirim!</p>
                        <p class="text-gray-400 text-xs leading-relaxed">Terima kasih telah menghubungi kami. Tim Bale Hinggil akan merespons dalam 1×24 jam kerja.</p>
                    </div>
                    <button onclick="document.getElementById('alert-success').remove()" class="ml-auto text-gray-500 hover:text-white transition shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                <div class="mb-6 bg-red-900/30 border border-red-500/30 rounded-xl px-5 py-4">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="text-red-300 text-xs">• <?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>

                <form action="<?php echo e(route('home.store')); ?>" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-[0.2em] text-gray-400">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Budi Santoso" required
                                value="<?php echo e(old('nama')); ?>"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#c5a059] transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-[0.2em] text-gray-400">Email</label>
                            <input type="email" name="email" placeholder="xxx@gmail.com"
                                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#c5a059] transition">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-[0.2em] text-gray-400">Divisi</label>
                        <select name="divisi" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 text-white focus:outline-none focus:border-[#c5a059] transition appearance-none">
                            <option value="" class="bg-[#132b21]">Pilih Tujuan</option>
                            <?php $__currentLoopData = $divisiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($div); ?>" class="bg-[#132b21]"><?php echo e($div); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-[0.2em] text-gray-400">Pesan (Opsional)</label>
                        <textarea name="pesan" rows="4" placeholder="Ceritakan kebutuhan hunian Anda..."
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 text-white placeholder:text-gray-600 focus:outline-none focus:border-[#c5a059] transition resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#c5a059] text-black font-bold uppercase tracking-[0.3em] text-xs py-5 rounded-xl hover:bg-[#d4af6a] hover:scale-[1.01] transition-all duration-300 flex items-center justify-center gap-3">
                        Kirim Pesan <span>→</span>
                    </button>
                    <p class="text-center text-[11px] text-gray-500 leading-relaxed max-w-md mx-auto">
                        Dengan mengirim formulir ini, Anda menyetujui tim kami menghubungi Anda. Data Anda aman dan tidak akan dibagikan.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php if(session('contact_success') || session('success') || $errors->any()): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('kontak');
    if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
});
</script>
<?php endif; ?>


<script>
(function() {
    function applyPreviewVideo(src) {
        const heroSection = document.querySelector('section.relative.min-h-screen');
        if (!heroSection) return;
        const isImage = src.startsWith('data:image') || (!src.startsWith('data:video') && /\.(jpg|jpeg|png|webp)$/i.test(src));
        
        if (isImage) {
            heroSection.querySelectorAll('video').forEach(v => v.style.display = 'none');
            let imgEl = heroSection.querySelector('#preview-hero-img');
            if (!imgEl) {
                imgEl = document.createElement('img');
                imgEl.id = 'preview-hero-img';
                imgEl.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;';
                heroSection.prepend(imgEl);
            }
            imgEl.src = src;
            imgEl.style.display = 'block';
        } else {
            let imgEl = heroSection.querySelector('#preview-hero-img');
            if (imgEl) imgEl.style.display = 'none';
            heroSection.querySelectorAll('video').forEach(vid => {
                vid.style.display = 'block';
                const source = vid.querySelector('source');
                if (source) { source.src = src; source.type = 'video/mp4'; }
                else vid.src = src;
                vid.load();
                vid.play().catch(() => {});
            });
        }
    }

    window.addEventListener('message', function(event) {
        if (event.data?.type === 'PREVIEW_VIDEO' && event.data.src) {
            applyPreviewVideo(event.data.src);
        }
        if (event.data?.type === 'PREVIEW_ABOUT_FOTO' && event.data.src) {
            const img = document.getElementById('about-foto-img');
            if (img) img.src = event.data.src;
        }
        if (event.data?.type === 'PREVIEW_FAS_FOTOS' && event.data.data) {
    const fasSection = document.getElementById('fasilitas');
    if (!fasSection) return;
    const fasImgs = fasSection.querySelectorAll('.rounded-2xl > img');
    Object.entries(event.data.data).forEach(([idx, src]) => {
        const img = fasImgs[parseInt(idx)];
        if (img) img.src = src;
    });
}
if (event.data?.type === 'PREVIEW_BERITA_FOTOS' && event.data.data) {
    const beritaSection = document.getElementById('berita');
    if (!beritaSection) return;
    const artikelImgs = beritaSection.querySelectorAll('.fade-up-scroll:not(:has(iframe)) .relative > img.w-full');
    Object.entries(event.data.data).forEach(([idx, src]) => {
        const img = artikelImgs[parseInt(idx)];
        if (img) img.src = src;
    });
}
if (event.data?.type === 'PREVIEW_LAYANAN_BG' && event.data.src) {
    const bgDiv = document.getElementById('layanan-bg-div');
    if (bgDiv) bgDiv.style.backgroundImage = `url('${event.data.src}')`;
}
    });

    if (window.parent && window.parent !== window) {
        try { window.parent.postMessage({ type: 'IFRAME_READY' }, '*'); } catch(e) {}
    }
})();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\WebsiteBaleHinggil\resources\views/home.blade.php ENDPATH**/ ?>