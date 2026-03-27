<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 bg-transparent backdrop-blur-md border-b border-white/5 transition-all duration-500 ease-in-out h-[70px] md:h-[80px]">
    <div class="w-full h-full mx-auto px-6 md:px-10 flex justify-between items-center" style="font-family: 'Montserrat', sans-serif;">
        <div class="flex items-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logofix.png') }}" alt="Bale Hinggil" class="h-[45px] md:h-[60px] w-auto object-contain cursor-pointer">
            </a>
        </div>
        <div class="hidden lg:flex items-center gap-10 text-white font-medium text-[12px] uppercase tracking-[2px]">
            @php
                $menus = ['tipe-unit'=>'Tipe Unit','fasilitas'=>'Fasilitas','layanan'=>'Layanan','lokasi'=>'Lokasi','berita'=>'Berita','kontak'=>'Kontak'];
                $isLayananActive = Request::is('layanan-co') || Request::is('layanan-wo') || Request::is('layanan-di');
            @endphp
            @foreach($menus as $url => $label)
                @if($url == 'layanan')
                    <div class="relative group">
                        <a href="{{ Request::is('/') ? '#layanan' : url('/').'#layanan' }}" class="nav-link cursor-pointer {{ $isLayananActive ? 'active' : '' }}">{{ $label }}</a>
                        <div class="absolute top-full left-1/2 -translate-x-1/2 mt-4 w-52 bg-white rounded-xl shadow-xl opacity-0 invisible scale-95 group-hover:opacity-100 group-hover:visible group-hover:scale-100 transition-all duration-300 ease-out">
                            <a href="{{ route('layanan.wo') }}" class="block px-5 py-3 text-[#2d8c3e] hover:bg-gray-100 rounded-t-xl">Working Order</a>
                            <a href="{{ route('layanan.co') }}" class="block px-5 py-3 text-[#2d8c3e] hover:bg-gray-100">Cleaning Order</a>
                            <a href="{{ route('layanan.di') }}" class="block px-5 py-3 text-[#2d8c3e] hover:bg-gray-100 rounded-b-xl">Design Interior</a>
                        </div>
                    </div>
                @elseif(in_array($url, ['fasilitas','lokasi','berita','kontak']))
                    <a href="{{ Request::is('/') ? '#'.$url : url('/').'#'.$url }}" class="nav-link">{{ $label }}</a>
                @else
                    <a href="/{{ $url }}" class="nav-link {{ Request::is($url) || Request::is($url.'/*') ? 'active' : '' }}">{{ $label }}</a>
                @endif
            @endforeach
        </div>

        <button id="menu-btn" class="flex lg:hidden flex-col gap-1.5 z-[70] relative outline-none p-2">
            <span class="hamburger-line w-6 h-0.5 bg-white transition-all duration-300"></span>
            <span class="hamburger-line w-6 h-0.5 bg-white transition-all duration-300"></span>
            <span class="hamburger-line w-6 h-0.5 bg-white transition-all duration-300"></span>
        </button>
    </div>

    {{-- MOBILE MENU --}}
    <div id="mobile-menu"
         class="fixed top-0 right-0 h-screen w-full transform translate-x-full transition-transform duration-500 ease-in-out z-[55] flex flex-col overflow-y-auto"
         style="background-color:#0f3028;font-family:'Montserrat',sans-serif;">

        {{-- Header mobile: logo + close --}}
        <div class="flex items-center justify-between px-5 shrink-0" style="height:70px;border-bottom:1px solid rgba(208,176,104,0.2);">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logofix.png') }}" alt="Bale Hinggil" class="h-[38px] w-auto object-contain">
            </a>
            <button id="close-menu-btn" class="w-9 h-9 flex items-center justify-center rounded-full transition-all active:scale-90" style="background:rgba(208,176,104,0.15);position:relative;z-index:80;">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#d0b068" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Nav items --}}
        <div class="flex flex-col px-5 py-2 flex-1">
            @foreach($menus as $url => $label)
                @if($url == 'layanan')
                    <div class="mobile-menu-item" style="border-bottom:1px solid rgba(208,176,104,0.1);">
                        <div class="flex items-center justify-between">
                            <a href="{{ Request::is('/') ? '#layanan' : url('/').'#layanan' }}"
                               class="mobile-link py-4 flex-1 {{ $isLayananActive ? 'mobile-active' : '' }}"
                               data-mobile-link>{{ $label }}</a>
                            <button class="mobile-dropdown-btn w-8 h-8 flex items-center justify-center" style="color:rgba(208,176,104,0.5);">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                        <div class="mobile-submenu hidden flex-col gap-0 pb-3 pl-2">
                            <a href="{{ route('layanan.wo') }}" class="mobile-sublink py-2.5" data-mobile-link>
                                <span class="dot"></span>Working Order
                            </a>
                            <a href="{{ route('layanan.co') }}" class="mobile-sublink py-2.5" data-mobile-link>
                                <span class="dot"></span>Cleaning Order
                            </a>
                            <a href="{{ route('layanan.di') }}" class="mobile-sublink py-2.5" data-mobile-link>
                                <span class="dot"></span>Design Interior
                            </a>
                        </div>
                    </div>
                @elseif(in_array($url, ['fasilitas','lokasi','berita','kontak']))
                    <a href="{{ Request::is('/') ? '#'.$url : url('/').'#'.$url }}"
                       class="mobile-link py-4"
                       style="border-bottom:1px solid rgba(208,176,104,0.1);"
                       data-mobile-link>{{ $label }}</a>
                @else
                    <a href="/{{ $url }}"
                       class="mobile-link py-4 {{ Request::is($url) || Request::is($url.'/*') ? 'mobile-active' : '' }}"
                       style="border-bottom:1px solid rgba(208,176,104,0.1);"
                       data-mobile-link>{{ $label }}</a>
                @endif
            @endforeach

            {{-- WhatsApp CTA --}}
            <div class="mt-7 mb-4">
                <a href="https://wa.me/628XXXXXXXXXX" target="_blank"
                   class="flex items-center justify-center gap-2.5 w-full rounded-xl font-bold uppercase transition-all active:scale-[0.98]"
                   style="background:#d0b068;color:#0f3028;padding:14px;font-size:10px;letter-spacing:2px;">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.857L.057 23.57a.5.5 0 00.612.612l5.713-1.476A11.95 11.95 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.9a9.9 9.9 0 01-5.031-1.373l-.361-.214-3.741.966.99-3.633-.236-.374A9.86 9.86 0 012.1 12C2.1 6.534 6.534 2.1 12 2.1c5.467 0 9.9 4.434 9.9 9.9 0 5.467-4.433 9.9-9.9 9.9z"/>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </div>

        {{-- Footer dekorasi --}}
        <div class="px-5 pb-8 text-center shrink-0" style="color:rgba(208,176,104,0.2);font-size:8px;letter-spacing:3px;text-transform:uppercase;">
            Bale Hinggil Apartment
        </div>
    </div>
</nav>

<style>
    html { scroll-behavior: smooth; }

    /* DESKTOP */
    .nav-link { position:relative; padding:4px 0; color:white; transition:color .3s; }
    .nav-link::after { content:''; position:absolute; left:0; bottom:-4px; width:0; height:2px; background:#2d8c3e; transition:width .3s; }
    .nav-link:hover { color:#2d8c3e; }
    .nav-link:hover::after { width:100%; }
    .nav-link.active { color:#2d8c3e !important; font-weight:700; }
    .nav-link.active::after { width:100%; }

    /* MOBILE MAIN LINK */
    .mobile-link {
        display: block;
        color: rgba(248,240,224,0.8);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        text-decoration: none;
        transition: color .25s;
    }
    .mobile-link:hover, .mobile-link:active { color: #d0b068; }
    .mobile-active { color: #d0b068 !important; font-weight: 700; }

    /* MOBILE SUBLINK */
    .mobile-sublink {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(248,240,224,0.45);
        font-size: 9px;
        font-weight: 500;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        text-decoration: none;
        transition: color .25s;
    }
    .mobile-sublink:hover { color: #d0b068; }
    .mobile-sublink .dot {
        width: 4px; height: 4px;
        border-radius: 50%;
        background: #d0b068;
        opacity: .5;
        flex-shrink: 0;
    }

    /* HAMBURGER */
    .menu-open .hamburger-line:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .menu-open .hamburger-line:nth-child(2) { opacity: 0; }
    .menu-open .hamburger-line:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* NAV SCROLL BG */
    .nav-active-bg { background-color:#f2e8d4 !important; backdrop-filter:none !important; border-color:#d4c4a0 !important; box-shadow:0 2px 20px rgba(0,0,0,.06) !important; }
    .nav-active-bg .nav-link { color:#1a1a1a !important; }
    .nav-active-bg .nav-link:hover { color:#2d8c3e !important; }
    .nav-active-bg .nav-link.active { color:#2d8c3e !important; }
    .nav-active-bg .hamburger-line { background-color:#1a1a1a !important; }
    .nav-active-bg .group .absolute { background-color:#f2e8d4 !important; border:1px solid #d4c4a0; }

    .navbar-hidden { transform: translateY(-100%); }

    /* DROPDOWN ARROW */
    .mobile-dropdown-btn { transition: transform .3s ease; }
    .mobile-dropdown-btn.open { transform: rotate(180deg); }
</style>

<script>
    const navbar       = document.getElementById('main-nav');
    const menuBtn      = document.getElementById('menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileMenu   = document.getElementById('mobile-menu');
    const mobileLinks  = document.querySelectorAll('[data-mobile-link]');
    const navLinks     = document.querySelectorAll('.nav-link');

    function openMenu()  {
        mobileMenu.classList.remove('translate-x-full');
        menuBtn.classList.add('menu-open');
        menuBtn.style.visibility = 'hidden';
        document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
        mobileMenu.classList.add('translate-x-full');
        menuBtn.classList.remove('menu-open');
        menuBtn.style.visibility = 'visible';
        document.body.style.overflow = '';
    }

    if (menuBtn)      menuBtn.addEventListener('click', openMenu);
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
    mobileLinks.forEach(l => l.addEventListener('click', closeMenu));

    // Dropdown Layanan
    document.querySelectorAll('.mobile-dropdown-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault(); e.stopPropagation();
            btn.classList.toggle('open');
            const sub = btn.closest('.mobile-menu-item').querySelector('.mobile-submenu');
            if (sub) {
                const hidden = sub.classList.contains('hidden');
                sub.classList.toggle('hidden', !hidden);
                sub.classList.toggle('flex', hidden);
            }
        });
    });

    // Active section tracking
    const sections = ['tipe-unit','fasilitas','layanan','lokasi','berita','kontak'];
    function updateActiveNav() {
        const pos = window.scrollY + 100;
        sections.forEach(id => {
            const sec = document.getElementById(id);
            const lnk = document.querySelector(`.nav-link[href*="#${id}"]`);
            if (sec && pos >= sec.offsetTop && pos < sec.offsetTop + sec.offsetHeight) {
                navLinks.forEach(l => l.classList.remove('active'));
                if (lnk) lnk.classList.add('active');
            }
        });
    }
    if (location.pathname === '/' || location.pathname === '') {
        window.addEventListener('scroll', updateActiveNav);
        updateActiveNav();
    }

    // Navbar hide/show
    let lastY = 0;
    window.addEventListener('scroll', () => {
        const y = window.scrollY;
        if (Math.abs(y - lastY) > 10) {
            if (y > 50) navbar.classList.toggle('navbar-hidden', y > lastY);
            else navbar.classList.remove('navbar-hidden');
            lastY = y;
        }
        if (y > 80) navbar.classList.add('nav-active-bg');
        else if (mobileMenu.classList.contains('translate-x-full')) navbar.classList.remove('nav-active-bg');
    }, { passive: true });
</script>