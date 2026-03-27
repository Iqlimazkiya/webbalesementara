<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap');

    .login-bg {
        position: fixed; inset: 0; z-index: 0;
        background: linear-gradient(135deg, #0d3a18 0%, #1a6a28 30%, #2ea84a 65%, #5eb85e 85%, #a8d8a8 100%);
    }
    .login-bg::before {
        content:''; position:absolute; inset:0; opacity:.045; pointer-events:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)'/%3E%3C/svg%3E");
        background-size:160px;
    }
    .login-bg::after {
        content:''; position:absolute; inset:0; opacity:.055; pointer-events:none;
        background-image:radial-gradient(circle,rgba(255,255,255,.5) 1px,transparent 1px);
        background-size:28px 28px;
    }

    .blob {
        position:fixed; border-radius:50%; pointer-events:none; z-index:1;
        background:rgba(255,255,255,.06);
        animation:blobpulse ease-in-out infinite alternate;
    }
    @keyframes blobpulse{0%{transform:scale(1);}100%{transform:scale(1.08);}}

    .login-leaf {
        position:fixed; pointer-events:none; z-index:1; opacity:.18;
        animation:lfsway ease-in-out infinite;
    }
    @keyframes lfsway{0%,100%{transform:rotate(var(--r0)) translateY(0);}50%{transform:rotate(var(--r1)) translateY(-10px);}}

    .login-leaf-fall {
        position:fixed; top:-30px; pointer-events:none; z-index:1;
        animation:lffall linear infinite;
    }
    @keyframes lffall{0%{transform:translateY(0) rotate(0deg);opacity:.6;}100%{transform:translateY(105vh) rotate(360deg);opacity:0;}}

    /* ── Login wrap ── */
    #loginWrap {
        position:fixed; inset:0; z-index:40;
        display:none; align-items:center; justify-content:center;
        padding: 12px 16px;
    }
    #loginWrap::before {
        content:''; position:absolute; inset:0;
        background:rgba(46,168,74,.12);
        backdrop-filter:blur(5px);
    }

    /* ── Card — lebih besar desktop, compact mobile ── */
    .login-card {
        position:relative; z-index:1;
        width:100%; max-width:440px;
        background:#fff; border-radius:12px; overflow:hidden;
        transform:scale(0);
        transition:transform .5s cubic-bezier(0.22,1,0.36,1);
        max-height:calc(100svh - 24px); overflow-y:auto;
        box-shadow:0 8px 40px rgba(0,0,0,.18);
    }
    .login-card.show { transform:scale(1); }
    @media (max-width:480px) { .login-card { max-width:92vw; } }

    .card-top-strip    { height:3px; background:linear-gradient(to right,#2ea84a,#5eb85e,#c5a059); }
    .card-bottom-strip { height:2px; background:linear-gradient(to right,#c5a059,#5eb85e,#2ea84a); }
    .card-body { padding:24px 28px 20px; }
    @media (max-width:480px) { .card-body { padding:16px 18px 14px; } }

    /* ── Logo ── */
    .logo-wrap { text-align:center; margin-bottom:16px; }
    .logo-wrap img { max-height:44px; width:auto; display:block; margin:0 auto 6px; }
    @media (max-width:480px) { .logo-wrap img { max-height:34px; } }
    .logo-divider { width:28px; height:1px; background:linear-gradient(to right,transparent,#c5a059,transparent); margin:0 auto 5px; }
    .admin-label  { font-size:9px; color:#7ab87a; letter-spacing:.18em; text-transform:uppercase; font-family:sans-serif; }

    /* ── Fields — NO box, NO background, plain underline, NO blue ring ── */
    .field-group  { margin-bottom:12px; }
    .field-label  { display:block; font-size:9px; font-weight:600; letter-spacing:.12em; text-transform:uppercase; color:#5aaa6a; margin-bottom:4px; font-family:sans-serif; }
    .field-input-wrap {
        display:flex; align-items:center;
        border:none !important; border-bottom:1px solid #d0e8d0 !important;
        border-radius:0 !important; padding:3px 0;
        background:transparent !important;
        box-shadow:none !important; outline:none !important;
        transition:border-color .2s;
    }
    .field-input-wrap:focus-within { border-bottom-color:#2ea84a !important; box-shadow:none !important; }
    .field-input-wrap svg { display:none; } /* hapus icon */
    .field-input {
        flex:1; border:none !important; outline:none !important;
        box-shadow:none !important; -webkit-tap-highlight-color:transparent;
        background:transparent; font-size:13px; color:#1a3a1a;
        font-family:'DM Sans',sans-serif; -webkit-appearance:none;
        min-width:0; padding:0;
    }
    .field-input:focus,
    .field-input:focus-visible { outline:none !important; box-shadow:none !important; border:none !important; }
    .field-input::placeholder { color:#c0d8c0; }
    .field-input:-webkit-autofill,
    .field-input:-webkit-autofill:hover,
    .field-input:-webkit-autofill:focus {
        -webkit-box-shadow:0 0 0 100px #fff inset !important;
        -webkit-text-fill-color:#1a3a1a;
        transition:background-color 5000s ease-in-out 0s;
    }
    .field-error { font-size:9px; color:#e05555; margin-top:2px; font-family:sans-serif; }

    /* ── Remember ── */
    .remember-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; flex-wrap:wrap; gap:4px; }
    .remember-left { display:flex; align-items:center; gap:6px; }
    .remember-checkbox { width:13px; height:13px; border-radius:3px; border:1px solid #a8d4a8; accent-color:#2ea84a; cursor:pointer; flex-shrink:0; }
    .remember-checkbox:focus { outline:none !important; }
    .remember-label { font-size:11px; color:#7ab87a; cursor:pointer; font-family:sans-serif; }
    .forgot-link    { font-size:10px; color:#c5a059; text-decoration:none; font-family:sans-serif; }
    .forgot-link:hover { color:#a8852f; }

    /* ── Button ── */
    .btn-login {
        width:100%; background:#2ea84a; border:none; border-radius:7px;
        padding:11px; font-size:11px; font-weight:700; color:#fff; cursor:pointer;
        font-family:'DM Sans',sans-serif; letter-spacing:.14em; text-transform:uppercase;
        box-shadow:0 3px 12px rgba(46,168,74,.28); transition:transform .2s,box-shadow .2s;
    }
    .btn-login:focus { outline:none !important; }
    .btn-login:hover { transform:translateY(-1px); box-shadow:0 6px 18px rgba(46,168,74,.38); }
    .btn-login:active { transform:translateY(0); }

    /* ── Session ── */
    .session-status { background:#f4faf4; border-left:2px solid #2ea84a; padding:7px 10px; font-size:11px; color:#2d7a1a; margin-bottom:12px; font-family:sans-serif; border-radius:0 4px 4px 0; }

    /* Nuclear option: hapus semua focus ring dari semua elemen */
    *, *:focus, *:focus-visible, *:focus-within {
        outline:none !important;
        box-shadow:none !important;
    }
    /* Tapi kembalikan box-shadow untuk yang memang perlu */
    .btn-login { box-shadow:0 3px 12px rgba(46,168,74,.28) !important; }
    .btn-login:hover { box-shadow:0 6px 18px rgba(46,168,74,.38) !important; }
    .login-card { box-shadow:0 8px 40px rgba(0,0,0,.18) !important; }

    @media (max-width:380px) { .blob{display:none;} .login-leaf{display:none;} }
    @media (max-width:480px) { .login-leaf{font-size:14px!important;} .login-leaf-fall{font-size:9px!important;} }
</style>

<div class="login-bg"></div>
<div class="blob" style="width:360px;height:360px;top:-100px;left:-60px;animation-duration:7s;"></div>
<div class="blob" style="width:280px;height:280px;bottom:-80px;right:-60px;animation-duration:9s;animation-delay:2s;"></div>

<div class="login-leaf" style="top:5%;left:3%;--r0:-15deg;--r1:-22deg;animation-duration:5s;font-size:28px;">🌿</div>
<div class="login-leaf" style="top:8%;right:4%;--r0:18deg;--r1:12deg;animation-duration:6.5s;font-size:22px;">🍃</div>
<div class="login-leaf" style="bottom:12%;left:5%;--r0:10deg;--r1:16deg;animation-duration:7s;font-size:34px;">🌿</div>
<div class="login-leaf" style="bottom:8%;right:3%;--r0:-12deg;--r1:-6deg;animation-duration:5.5s;font-size:26px;">🍂</div>
<div class="login-leaf" style="top:42%;left:1%;--r0:25deg;--r1:18deg;animation-duration:8s;font-size:20px;">🌱</div>
<div class="login-leaf" style="top:38%;right:2%;--r0:-20deg;--r1:-28deg;animation-duration:6s;font-size:24px;">🍃</div>

<div class="login-leaf-fall" style="left:15%;animation-duration:6s;font-size:15px;">🍃</div>
<div class="login-leaf-fall" style="left:35%;animation-duration:8s;animation-delay:2.5s;font-size:13px;">🍂</div>
<div class="login-leaf-fall" style="left:58%;animation-duration:7s;animation-delay:1s;font-size:16px;">🌿</div>
<div class="login-leaf-fall" style="left:78%;animation-duration:9s;animation-delay:4s;font-size:14px;">🍃</div>
<div class="login-leaf-fall" style="left:90%;animation-duration:6.5s;animation-delay:6s;font-size:12px;">🍂</div>

{{-- Gate scene --}}
@include('auth.partials.gate-scene')

{{-- Login form --}}
<div id="loginWrap">
    <div class="login-card" id="loginCard">
        <div class="card-top-strip"></div>
        <div class="card-body">
            <div class="logo-wrap">
                <img src="{{ asset('assets/img/logofix.png') }}" alt="Bale Hinggil">
                <div class="logo-divider"></div>
                <div class="admin-label">Admin Panel</div>
            </div>

            @if(session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field-group">
                    <label class="field-label" for="email">Email</label>
                    <div class="field-input-wrap">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#a8d4a8" stroke-width="1.8">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <input class="field-input" id="email" type="email" name="email"
                               value="{{ old('email') }}" placeholder="admin@balehinggil.com"
                               required autofocus autocomplete="username">
                    </div>
                    @error('email')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-input-wrap">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#a8d4a8" stroke-width="1.8">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                        <input class="field-input" id="password" type="password" name="password"
                               placeholder="••••••••" required autocomplete="current-password">
                    </div>
                    @error('password')<div class="field-error">{{ $message }}</div>@enderror
                </div>

                <div class="remember-row">
                    <div class="remember-left">
                        <input id="remember_me" type="checkbox" class="remember-checkbox" name="remember">
                        <label for="remember_me" class="remember-label">Ingat saya</label>
                    </div>
                    @if(Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">Masuk ke Dashboard</button>
            </form>
        </div>
        <div class="card-bottom-strip"></div>
    </div>
</div>

</x-guest-layout>