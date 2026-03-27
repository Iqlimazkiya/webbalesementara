{{-- OVERLAY: klik luar untuk tutup --}}
<div id="sb-overlay"></div>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active d-flex flex-column" style="background-color:#335A40 !important; height:100%;">

        {{-- HEADER --}}
        <div class="sidebar-header" style="padding:1.2rem 1.2rem 0.8rem !important;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-white mb-0" style="font-size:.9rem; letter-spacing:.3px;">PANEL ADMIN BALE HINGGIL</h5>
                <button id="sb-close" onclick="sbClose()" aria-label="Tutup"
                    style="background:rgba(255,255,255,.1); border:none; cursor:pointer; padding:6px; border-radius:8px; line-height:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- PROFILE CARD --}}
        <div style="padding:0 1rem 0.85rem;">
            <a href="{{ route('admin.profile.show') }}"
               style="display:flex; align-items:center; gap:12px; padding:12px 14px;
                      border-radius:10px;
                      background:rgba(255,255,255,.07);
                      border:1px solid rgba(255,255,255,.1);
                      text-decoration:none; transition:all .2s;"
               onmouseover="this.style.background='rgba(255,255,255,.13)'; this.style.borderColor='rgba(255,255,255,.2)'"
               onmouseout="this.style.background='rgba(255,255,255,.07)'; this.style.borderColor='rgba(255,255,255,.1)'">

                {{-- Avatar --}}
                <div style="width:40px; height:40px; border-radius:50%;
                            background:rgba(255,255,255,.15);
                            border:2px solid rgba(255,255,255,.35);
                            display:flex; align-items:center; justify-content:center;
                            flex-shrink:0; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.2);">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                             alt="Foto Profil"
                             style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <span style="color:white; font-weight:700; font-size:.9rem; line-height:1; text-transform:uppercase;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    @endif
                </div>

                {{-- Nama & Email --}}
                <div style="flex:1; min-width:0;">
                    <p class="mb-0 fw-semibold text-white"
                       style="font-size:.82rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; line-height:1.3;">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="mb-0"
                       style="font-size:.69rem; color:rgba(255,255,255,.5);
                              white-space:nowrap; overflow:hidden; text-overflow:ellipsis; line-height:1.4;">
                        {{ Auth::user()->email }}
                    </p>
                </div>

                {{-- Arrow --}}
                <i class="bi bi-chevron-right" style="color:rgba(255,255,255,.3); font-size:.7rem; flex-shrink:0;"></i>
            </a>
        </div>

        <div class="px-3">
            <hr style="border-top:1px solid rgba(255,255,255,.12) !important; margin:0 0 8px !important; opacity:1 !important;">
        </div>

        {{-- MENU --}}
        <div class="sidebar-menu" style="padding:0 1rem !important; overflow-y:auto; flex:1;">
            <ul class="menu">
                <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link custom-tight">
                        <i class="bi bi-grid-fill"></i><span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-title custom-title">Konten Website</li>

                <li class="sidebar-item {{ request()->routeIs('admin.home.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.home.index') }}" class="sidebar-link custom-tight">
                        <i class="bi bi-window-stack"></i><span>Halaman Utama</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.unit.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.unit.index') }}" class="sidebar-link custom-tight">
                        <i class="bi bi-door-open-fill"></i><span>Tipe Unit</span>
                    </a>
                </li>

                @php
                    $layananActive = request()->routeIs('admin.layananco.*')
                                  || request()->routeIs('admin.layananwo.*')
                                  || request()->routeIs('admin.layanandi.*');
                @endphp
                <li class="sidebar-item {{ $layananActive ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="sidebar-link custom-tight" onclick="toggleLayanan()">
                        <i class="bi bi-stars"></i><span>Layanan</span>
                        <i class="bi bi-chevron-down ms-auto" id="layananChevron" style="font-size:.7rem !important; transition:transform .25s;"></i>
                    </a>
                    <div id="layananSubmenu" style="display:none;">
                        <a href="{{ route('admin.layananco.index') }}" class="sidebar-link custom-tight" style="padding-left:2rem !important; font-size:.85rem;">
                            <i class="bi bi-droplet-fill" style="font-size:.8rem !important; opacity:.85;"></i><span>CO (Cleaning Order)</span>
                        </a>
                        <a href="{{ route('admin.layananwo.index') }}" class="sidebar-link custom-tight" style="padding-left:2rem !important; font-size:.85rem;">
                            <i class="bi bi-tools" style="font-size:.8rem !important; opacity:.85;"></i><span>WO (Working Order)</span>
                        </a>
                        <a href="{{ route('admin.layanandi.index') }}" class="sidebar-link custom-tight" style="padding-left:2rem !important; font-size:.85rem;">
                            <i class="bi bi-palette-fill" style="font-size:.8rem !important; opacity:.85;"></i><span>DI (Desain Interior)</span>
                        </a>
                    </div>
                </li>

                <li class="sidebar-title custom-title">Laporan</li>

                <li class="sidebar-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.messages.index') }}" class="sidebar-link custom-tight">
                        <i class="bi bi-envelope-paper-fill"></i><span>Pesan Masuk</span>
                        <span id="sidebar-unread-badge"
                            class="badge bg-danger ms-auto"
                            style="font-size:10px; display:none;">0</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('admin.activities') ? 'active' : '' }}">
                    <a href="{{ route('admin.activities') }}" class="sidebar-link custom-tight">
                        <i class="bi bi-clock-history"></i><span>Log Aktivitas</span>
                    </a>
                </li>

                <li class="sidebar-title custom-title">Eksternal</li>
                <li class="sidebar-item">
                    <a href="{{ url('/') }}" target="_blank" class="sidebar-link custom-tight">
                        <i class="bi bi-box-arrow-up-right"></i><span>Lihat Website</span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- FOOTER --}}
        <div style="padding:1rem 1.5rem !important;">
            <hr style="border-top:1px solid rgba(255,255,255,.12) !important; margin-bottom:10px !important; opacity:1 !important;">
            <div class="text-white small text-center">
                <p class="mb-0 fw-bold" style="font-size:.8rem;">© {{ date('Y') }} Bale Hinggil</p>
                <p class="mb-0" style="color:rgba(255,255,255,.5) !important; font-size:.7rem;">v1.0.0</p>
            </div>
        </div>
    </div>
</div>

@vite(['resources/css/admin/sidebar.css'])
@vite(['resources/js/admin/sidebar.js'])

@if($layananActive)
<script>
    document.addEventListener('DOMContentLoaded', window.initLayananSubmenu);
</script>
@endif