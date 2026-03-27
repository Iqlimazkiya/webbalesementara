<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap');

    .login-bg {
        position:fixed; inset:0; z-index:0;
        background:linear-gradient(135deg,#0d3a18 0%,#1a6a28 30%,#2ea84a 65%,#5eb85e 85%,#a8d8a8 100%);
    }
    .login-bg::before {
        content:''; position:absolute; inset:0; opacity:.045; pointer-events:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)'/%3E%3C/svg%3E");
        background-size:160px;
    }
    .blob { position:fixed; border-radius:50%; pointer-events:none; z-index:1; background:rgba(255,255,255,.06); animation:blobpulse ease-in-out infinite alternate; }
    @keyframes blobpulse{0%{transform:scale(1);}100%{transform:scale(1.08);}}
    .login-leaf { position:fixed; pointer-events:none; z-index:1; opacity:.18; animation:lfsway ease-in-out infinite; }
    @keyframes lfsway{0%,100%{transform:rotate(var(--r0)) translateY(0);}50%{transform:rotate(var(--r1)) translateY(-10px);}}
    .login-leaf-fall { position:fixed; top:-30px; pointer-events:none; z-index:1; animation:lffall linear infinite; }
    @keyframes lffall{0%{transform:translateY(0) rotate(0deg);opacity:.6;}100%{transform:translateY(105vh) rotate(360deg);opacity:0;}}

    #rpWrap {
        position:fixed; inset:0; z-index:40;
        display:flex; align-items:center; justify-content:center;
        padding:12px 16px;
    }
    #rpWrap::before {
        content:''; position:absolute; inset:0;
        background:rgba(46,168,74,.12); backdrop-filter:blur(5px);
    }

    .rp-card {
        position:relative; z-index:1;
        width:100%; max-width:440px;
        background:#fff; border-radius:12px; overflow:hidden;
        box-shadow:0 8px 40px rgba(0,0,0,.18) !important;
        animation:cardIn .5s cubic-bezier(0.22,1,0.36,1) both;
    }
    @keyframes cardIn { from{transform:scale(.92);opacity:0;} to{transform:scale(1);opacity:1;} }
    @media (max-width:480px) { .rp-card { max-width:92vw; } }

    .card-top-strip    { height:3px; background:linear-gradient(to right,#2ea84a,#5eb85e,#c5a059); }
    .card-bottom-strip { height:2px; background:linear-gradient(to right,#c5a059,#5eb85e,#2ea84a); }
    .card-body { padding:24px 28px 20px; }
    @media (max-width:480px) { .card-body { padding:16px 18px 14px; } }

    .logo-wrap { text-align:center; margin-bottom:16px; }
    .logo-wrap img { max-height:44px; width:auto; display:block; margin:0 auto 6px; }
    @media (max-width:480px) { .logo-wrap img { max-height:34px; } }
    .logo-divider { width:28px; height:1px; background:linear-gradient(to right,transparent,#c5a059,transparent); margin:0 auto 5px; }
    .page-label { font-size:9px; color:#7ab87a; letter-spacing:.18em; text-transform:uppercase; font-family:sans-serif; }

    .field-group { margin-bottom:12px; }
    .field-label { display:block; font-size:9px; font-weight:600; letter-spacing:.12em; text-transform:uppercase; color:#5aaa6a; margin-bottom:4px; font-family:sans-serif; }
    .field-input-wrap {
        display:flex; align-items:center;
        border:none !important; border-bottom:1px solid #d0e8d0 !important;
        border-radius:0 !important; padding:3px 0;
        background:transparent !important; box-shadow:none !important;
        transition:border-color .2s;
    }
    .field-input-wrap:focus-within { border-bottom-color:#2ea84a !important; }
    .field-input {
        flex:1; border:none !important; outline:none !important; box-shadow:none !important;
        background:transparent; font-size:13px; color:#1a3a1a;
        font-family:'DM Sans',sans-serif; -webkit-appearance:none; min-width:0; padding:0;
        -webkit-tap-highlight-color:transparent;
    }
    .field-input::placeholder { color:#c0d8c0; }
    .field-input:-webkit-autofill,
    .field-input:-webkit-autofill:focus {
        -webkit-box-shadow:0 0 0 100px #fff inset !important;
        -webkit-text-fill-color:#1a3a1a;
        transition:background-color 5000s ease-in-out 0s;
    }
    .field-error { font-size:9px; color:#e05555; margin-top:2px; font-family:sans-serif; }

    .btn-submit {
        width:100%; background:#2ea84a; border:none; border-radius:7px;
        padding:11px; font-size:11px; font-weight:700; color:#fff; cursor:pointer;
        font-family:'DM Sans',sans-serif; letter-spacing:.14em; text-transform:uppercase;
        box-shadow:0 3px 12px rgba(46,168,74,.28) !important;
        transition:transform .2s,box-shadow .2s; margin-top:4px;
    }
    .btn-submit:hover { transform:translateY(-1px); box-shadow:0 6px 18px rgba(46,168,74,.38) !important; }
    .btn-submit:active { transform:translateY(0); }

    *, *:focus, *:focus-visible { outline:none !important; box-shadow:none !important; }
    .btn-submit { box-shadow:0 3px 12px rgba(46,168,74,.28) !important; }
    .rp-card { box-shadow:0 8px 40px rgba(0,0,0,.18) !important; }

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
<div class="login-leaf-fall" style="left:20%;animation-duration:6.5s;font-size:14px;">🍃</div>
<div class="login-leaf-fall" style="left:60%;animation-duration:7.5s;animation-delay:2s;font-size:15px;">🌿</div>

<div id="rpWrap">
    <div class="rp-card">
        <div class="card-top-strip"></div>
        <div class="card-body">

            <div class="logo-wrap">
                <img src="{{ asset('assets/img/logofix.png') }}" alt="Bale Hinggil">
                <div class="logo-divider"></div>
                <div class="page-label">Password Baru</div>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="field-group">
                    <label class="field-label" for="email">Email</label>
                    <div class="field-input-wrap">
                        <input class="field-input" id="email" type="email" name="email"
                               value="{{ old('email', $request->email) }}"
                               placeholder="admin@balehinggil.com"
                               required autocomplete="username">
                    </div>
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="password">Password Baru</label>
                    <div class="field-input-wrap">
                        <input class="field-input" id="password" type="password" name="password"
                               placeholder="••••••••" required autocomplete="new-password">
                    </div>
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label" for="password_confirmation">Konfirmasi Password</label>
                    <div class="field-input-wrap">
                        <input class="field-input" id="password_confirmation" type="password"
                               name="password_confirmation"
                               placeholder="••••••••" required autocomplete="new-password">
                    </div>
                    @error('password_confirmation')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Simpan Password Baru</button>
            </form>

        </div>
        <div class="card-bottom-strip"></div>
    </div>
</div>

</x-guest-layout>