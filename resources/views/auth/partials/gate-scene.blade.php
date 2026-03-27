{{-- resources/views/auth/partials/gate-scene.blade.php --}}
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
html, body { width: 100%; height: 100%; overflow: hidden; font-family: Georgia, serif; }

/* ══ GATE ══ */
#gateLayer {
    position: fixed; inset: 0; z-index: 20;
    background: linear-gradient(180deg,#0a2e12 0%,#155c20 35%,#1e8a30 65%,#28b040 85%,#3ecc55 100%);
    display: flex; align-items: center; justify-content: center;
    transition: opacity 1s ease;
}
#gateLayer.hide { opacity: 0; pointer-events: none; }

.fall-leaf { position: absolute; top: -50px; pointer-events: none; animation: falldown linear infinite; }
@keyframes falldown {
    0%  { transform: translateY(0) rotate(0deg) translateX(0); opacity: .85; }
    50% { transform: translateY(50vh) rotate(200deg) translateX(35px); opacity: .6; }
    100%{ transform: translateY(110vh) rotate(400deg) translateX(-25px); opacity: 0; }
}

.gate-inner { display: flex; flex-direction: column; align-items: center; gap: 18px; z-index: 2; padding: 0 16px; }
.gate-brand-name { font-size: clamp(26px,6vw,38px); color: #fff; font-style: italic; text-shadow: 0 2px 18px rgba(0,0,0,.4); text-align: center; letter-spacing: .02em; }
.gate-brand-sub  { font-size: clamp(9px,2vw,11px); color: rgba(255,255,255,.45); letter-spacing: .35em; text-transform: uppercase; margin-top: 2px; text-align: center; }
.gate-glow { transition: filter .5s; }
.gate-glow.lit { filter: drop-shadow(0 0 22px #ffe066) drop-shadow(0 0 50px #ffd700); }
.gate-svg-wrap svg { width: clamp(160px,50vw,260px); height: auto; }

/* Pintu buka flat ke samping (scaleX collapse, hadap depan) */
#doorL { transition: transform .9s cubic-bezier(.4,0,.2,1), opacity .8s ease; }
#doorR { transition: transform .9s cubic-bezier(.4,0,.2,1), opacity .8s ease; }
#doorL.open { transform: scaleX(0); opacity: 0; }
#doorR.open { transform: scaleX(0); opacity: 0; }

.welcome-line { display: flex; align-items: baseline; margin-top: 4px; flex-wrap: wrap; justify-content: center; }
.welcome-text { font-size: clamp(15px,4vw,22px); color: rgba(255,255,255,.88); font-style: italic; white-space: nowrap; text-shadow: 0 1px 10px rgba(0,0,0,.3); }
/* Input — hapus semua border browser default, hanya border-bottom putih */
.welcome-input {
    background: transparent;
    border: none; border-bottom: 2px solid rgba(255,255,255,.6);
    outline: none !important; box-shadow: none !important;
    -webkit-appearance: none; appearance: none;
    color: #fff; font-size: clamp(15px,4vw,22px);
    font-family: Georgia, serif; font-style: italic;
    width: clamp(110px,35vw,200px); padding: 0 6px 3px;
    caret-color: rgba(255,255,255,.9); transition: border-color .2s;
}
.welcome-input:focus {
    outline: none !important; box-shadow: none !important;
    border-bottom-color: rgba(255,255,255,.95);
}
.welcome-input::placeholder { color: rgba(255,255,255,.22); font-style: italic; }

/* ══ SCENE ══ */
#sceneLayer {
    position: fixed; inset: 0; z-index: 10; overflow: hidden; display: none;
    background: linear-gradient(180deg,#4aa8d8 0%,#72c0e8 22%,#a8daf2 44%,#b8e8c8 62%,#68b83a 74%,#3a8018 86%,#205010 100%);
}
@media (max-width: 768px) {
    /* Mobile: lebih banyak langit biru, hijau mulai lebih bawah */
    #sceneLayer { background: linear-gradient(180deg,#4aa8d8 0%,#72c0e8 28%,#a0d8f0 48%,#b8e8c0 64%,#68b83a 76%,#3a8018 88%,#205010 100%); }
}

.sun { position: absolute; top: 40px; left: 50%; transform: translateX(-60px); width: 72px; height: 72px; border-radius: 50%;
    background: radial-gradient(circle,#fffce0,#ffe866,#ffc820);
    box-shadow: 0 0 50px 18px rgba(255,220,50,.4),0 0 100px 40px rgba(255,200,30,.15);
    animation: sunpulse 4s ease-in-out infinite alternate; z-index: 12; }
@keyframes sunpulse {
    0%  { box-shadow: 0 0 50px 18px rgba(255,220,50,.4),0 0 100px 40px rgba(255,200,30,.15); }
    100%{ box-shadow: 0 0 65px 25px rgba(255,220,50,.5),0 0 120px 50px rgba(255,200,30,.2); }
}
@media (max-width:768px) { .sun { width:38px;height:38px;top:22px;left:50%;transform:translateX(20px); } }
@media (max-width:480px) { .sun { width:26px;height:26px;top:16px;left:50%;transform:translateX(30px); } }

.cloud { position: absolute; animation: drift linear infinite; z-index: 3; }
@keyframes drift { 0%{transform:translateX(-250px);}100%{transform:translateX(115vw);} }
.cb    { border-radius: 50px; background: rgba(255,255,255,.92); }
.cbump { position: absolute; border-radius: 50%; background: rgba(255,255,255,.92); }

/* Gedung */
.bld-wrap { position:absolute; z-index:4; left:50%; display:flex; align-items:flex-end; gap:10px; filter:drop-shadow(0 8px 24px rgba(0,0,0,.3)); }
.tower { border-radius:5px 5px 0 0; position:relative; overflow:hidden; background:linear-gradient(180deg,#2e6848 0%,#1e4a32 60%,#163820 100%); }
.tower::after { content:''; position:absolute; inset:0;
    background: repeating-linear-gradient(0deg,transparent,transparent 14px,rgba(255,255,255,.05) 14px,rgba(255,255,255,.05) 15px),
                repeating-linear-gradient(90deg,transparent,transparent 12px,rgba(255,255,255,.04) 12px,rgba(255,255,255,.04) 13px); }
.tw { position:absolute; background:rgba(255,255,220,.4); border-radius:2px; animation:winblink 3s ease-in-out infinite; }
@keyframes winblink{0%,100%{opacity:.4;}50%{opacity:.85;}}
.connector { background:linear-gradient(180deg,#2a6040,#1a4028); border-radius:4px 4px 0 0; align-self:flex-end; position:relative; overflow:hidden; }
.connector::after { content:''; position:absolute; inset:0; background:repeating-linear-gradient(0deg,transparent,transparent 14px,rgba(255,255,255,.04) 14px,rgba(255,255,255,.04) 15px); }
.podium { height:30px; background:#163820; border-radius:2px; width:100%; }

/* Sungai */
.river { position:absolute; z-index:4; left:0; right:0; background:linear-gradient(180deg,#5ab8e8 0%,#3a98c8 100%); overflow:hidden; }
.river::after { content:''; position:absolute; top:6px; left:5%; right:5%; height:5px; background:rgba(255,255,255,.22); border-radius:50%; }
.river-ripple { position:absolute; border:1.5px solid rgba(255,255,255,.35); border-radius:50%; animation:rripple 3s ease-out infinite; transform:translate(-50%,-50%); }
@keyframes rripple{0%{width:4px;height:8px;opacity:.8;}100%{width:120px;height:24px;opacity:0;}}

/* Bench — membelakangi layar (hadap sungai) */
.bench-wrap { position:absolute; z-index:6; }
.bench-seat { position:absolute; border-radius:2px 2px 1px 1px; }
.bench-back { position:absolute; border-radius:1px; }
.bench-leg  { position:absolute; border-radius:1px 1px 2px 2px; }

/* Pohon besar */
.big-trunk { position:fixed; bottom:0; z-index:8; }
.big-c     { position:fixed; z-index:9; animation:swaytree ease-in-out infinite; transform-origin:bottom center; }
@keyframes swaytree{0%,100%{transform:rotate(0deg);}40%{transform:rotate(-1.5deg);}70%{transform:rotate(1deg);}}

/* Dahan — no canopy, plain branch */
.big-branch { position:fixed; z-index:8; }

/* Sarang */
.nest { position:fixed; z-index:10; border-radius:0 0 14px 14px;
    background:radial-gradient(ellipse at center,#a07848 0%,#7a5028 60%,#5a3810 100%);
    box-shadow:inset 0 3px 6px rgba(0,0,0,.3); border:2px solid #4a2808; }

/* Pohon depan (baris sungai, z-index:7 = di depan semak) */
.ft-wrap { position:absolute; z-index:7; }
.ft-trunk { position:absolute; bottom:0; left:50%; transform:translateX(-50%); background:linear-gradient(180deg,#7a4820,#5a3010); border-radius:3px; }
.ft-c { position:absolute; left:50%; transform:translateX(-50%); animation:swaysmall ease-in-out infinite; transform-origin:bottom center; border-radius:50% 50% 44% 44%; }
@keyframes swaysmall{0%,100%{transform:translateX(-50%) rotate(0deg);}40%{transform:translateX(-50%) rotate(-2deg);}70%{transform:translateX(-50%) rotate(1.5deg);}}

/* Rumput */
.grass-main { position:absolute; bottom:0; left:0; right:0; z-index:6;
    background:linear-gradient(180deg,#50b830 0%,#38a020 40%,#208010 100%);
    animation:gway 5s ease-in-out infinite; }
@keyframes gway{0%,100%{border-radius:65% 55% 0 0/35px 25px 0 0;}50%{border-radius:60% 60% 0 0/30px 30px 0 0;}}

/*
 * Semak — z-index:4 (di bawah pohon tengah z:5, di atas sungai z:4 → sama, tapi
 * semak diposisikan JS di atas garis sungai (bottom = grassH + rvH).
 * Di mobile: shrub-row.hide → display none untuk beberapa row.
 */
.shrub-row { position:absolute; z-index:4; display:flex; align-items:flex-end; overflow:visible; }
.shrub { position:relative; border-radius:55% 55% 38% 38%; animation:swaysmall2 ease-in-out infinite; transform-origin:bottom center; flex-shrink:0; }
@keyframes swaysmall2{0%,100%{transform:rotate(0deg);}50%{transform:rotate(1.5deg);}}
.shrub-flower { position:absolute; border-radius:50%; animation:flblink 2s ease-in-out infinite alternate; }
@keyframes flblink{0%{opacity:.7;transform:scale(1);}100%{opacity:1;transform:scale(1.2);}}

/* Blade */
.blade { position:absolute; z-index:7; border-radius:3px 3px 0 0; transform-origin:bottom center; animation:bladesway ease-in-out infinite alternate; }
@keyframes bladesway{0%{transform:rotate(-10deg);}100%{transform:rotate(10deg);}}

/* Bunga */
.ground-flower { position:absolute; z-index:7; }
.gf-stem { background:#2a9018; border-radius:2px; margin:0 auto; }
.gf-head  { border-radius:50%; margin:0 auto; animation:flblink 2.5s ease-in-out infinite alternate; }

/* Daun jatuh */
.scene-leaf { position:absolute; top:-40px; pointer-events:none; z-index:15; animation:sceneleaf linear infinite; }
@keyframes sceneleaf{0%{transform:translateY(0) rotate(0deg) translateX(0);opacity:.75;}60%{transform:translateY(55vh) rotate(220deg) translateX(25px);opacity:.5;}100%{transform:translateY(110vh) rotate(420deg) translateX(-20px);opacity:0;}}

/* Kupu */
.butterfly { position:absolute; z-index:13; animation:bfpath ease-in-out infinite; }
@keyframes bfpath{0%{transform:translate(0,0);}25%{transform:translate(70px,-50px);}50%{transform:translate(130px,15px);}75%{transform:translate(65px,60px);}100%{transform:translate(0,0);}}
.wing-l { display:inline-block; animation:wflap .28s ease-in-out infinite alternate; transform-origin:right center; }
.wing-r { display:inline-block; animation:wflap .28s ease-in-out infinite alternate-reverse; transform-origin:left center; }
@keyframes wflap{0%{transform:scaleX(1);}100%{transform:scaleX(.15);}}

/* Capung */
.drfly { position:absolute; z-index:13; animation:dfpath linear infinite; }
@keyframes dfpath{0%{transform:translate(0,0);}20%{transform:translate(90px,-35px);}40%{transform:translate(50px,-70px);}60%{transform:translate(-35px,-50px);}80%{transform:translate(-70px,15px);}100%{transform:translate(0,0);}}
.dfw { animation:dfwflap .18s linear infinite alternate; transform-origin:center; }
@keyframes dfwflap{0%{transform:scaleY(1);}100%{transform:scaleY(.2);}}

/* Burung langit — satu per satu, jarak delay jauh */
.fly-bird { position:absolute; opacity:0; pointer-events:none; z-index:3; animation:flyacross linear infinite; }
@keyframes flyacross {
    0%   { transform:translateX(-80px) translateY(0);   opacity:0; }
    2%   { opacity:.7; }
    48%  { transform:translateX(50vw) translateY(-12px); opacity:.7; }
    98%  { opacity:.7; }
    100% { transform:translateX(115vw) translateY(0);   opacity:0; }
}

/* Burung hinggap */
.bird-wrap { position:fixed; cursor:pointer; z-index:14; }
@keyframes headbob{0%,100%{transform:rotate(0deg);}30%{transform:rotate(-4deg);}65%{transform:rotate(3deg);}}

/* TV */
#tvOverlay { position:fixed; inset:0; z-index:50; background:#000; opacity:0; pointer-events:none; display:none; align-items:center; justify-content:center; }
#tvOverlay::before { content:''; position:absolute; inset:0; background:repeating-linear-gradient(0deg,transparent,transparent 2px,rgba(0,0,0,.1) 2px,rgba(0,0,0,.1) 4px); }
.tv-dot { width:6px; height:6px; background:#fff; border-radius:50%; opacity:0; box-shadow:0 0 12px 6px rgba(255,255,255,.7); transition:all .3s; }

/* Mobile hide */
@media (max-width:768px) {
    .sl-desktop { display:none; }
}
@media (max-width:480px) {
    .ground-flower { display:none; }
    .blade { display:none; }
    .butterfly { display:none; }
    .drfly { display:none; }
}
</style>

<!-- ══ GATE ══ -->
<div id="gateLayer">
    <div class="fall-leaf" style="left:5%;animation-duration:5s;font-size:22px;">🍃</div>
    <div class="fall-leaf" style="left:14%;animation-duration:7s;animation-delay:1.5s;font-size:18px;">🌿</div>
    <div class="fall-leaf" style="left:26%;animation-duration:6s;animation-delay:0.4s;font-size:24px;">🍂</div>
    <div class="fall-leaf" style="left:42%;animation-duration:8s;animation-delay:2.8s;font-size:16px;">🍃</div>
    <div class="fall-leaf" style="left:58%;animation-duration:5.5s;animation-delay:1s;font-size:20px;">🌿</div>
    <div class="fall-leaf" style="left:72%;animation-duration:7.5s;animation-delay:3.5s;font-size:18px;">🍃</div>
    <div class="fall-leaf" style="left:84%;animation-duration:6.5s;animation-delay:0.8s;font-size:22px;">🍂</div>
    <div class="fall-leaf" style="left:93%;animation-duration:8.5s;animation-delay:4.5s;font-size:16px;">🍃</div>

    <div class="gate-inner">
        <div>
            <div class="gate-brand-name">Bale Hinggil</div>
            <div class="gate-brand-sub">apartement @ surabaya</div>
        </div>
        <div class="gate-glow gate-svg-wrap" id="gateGlow">
            <svg width="260" height="310" viewBox="0 0 228 278">
                <rect x="4"   y="20" width="24" height="248" rx="6" fill="#4a2a08"/>
                <rect x="200" y="20" width="24" height="248" rx="6" fill="#4a2a08"/>
                <path d="M28 76 Q114 8 200 76" stroke="#4a2a08" stroke-width="13" fill="none" stroke-linecap="round"/>
                <circle cx="114" cy="62" r="13" fill="#c5a059"/>
                <circle cx="114" cy="62" r="6.5" fill="#f0d484"/>
                <circle cx="114" cy="62" r="3" fill="#c5a059"/>
                <!-- Pintu kiri: origin kiri-tengah → scaleX(0) collapse ke kiri -->
                <g id="doorL" style="transform-box:fill-box;transform-origin:left center;">
                    <rect x="30" y="76" width="80" height="172" rx="4" fill="#1e5a12" stroke="#123a08" stroke-width="1.5"/>
                    <rect x="38" y="86"  width="28" height="72" rx="3" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.4"/>
                    <rect x="38" y="166" width="28" height="72" rx="3" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.4"/>
                    <rect x="72" y="86"  width="28" height="72" rx="3" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.4"/>
                    <rect x="72" y="166" width="28" height="72" rx="3" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.4"/>
                    <circle cx="106" cy="162" r="7" fill="#c5a059"/>
                    <circle cx="106" cy="162" r="3" fill="#f0d484"/>
                </g>
                <!-- Pintu kanan: origin kanan-tengah → scaleX(0) collapse ke kanan -->
                <g id="doorR" style="transform-box:fill-box;transform-origin:right center;">
                    <rect x="118" y="76" width="80" height="172" rx="4" fill="#1e5a12" stroke="#123a08" stroke-width="1.5"/>
                    <rect x="126" y="86"  width="28" height="72" rx="3" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.4"/>
                    <rect x="126" y="166" width="28" height="72" rx="3" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.4"/>
                    <rect x="160" y="86"  width="28" height="72" rx="3" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.4"/>
                    <rect x="160" y="166" width="28" height="72" rx="3" fill="none" stroke="rgba(255,255,255,.2)" stroke-width="1.4"/>
                    <circle cx="122" cy="162" r="7" fill="#c5a059"/>
                    <circle cx="122" cy="162" r="3" fill="#f0d484"/>
                </g>
            </svg>
        </div>
        <div class="welcome-line">
            <span class="welcome-text">Selamat datang,&nbsp;</span>
            <input class="welcome-input" id="codeInput" type="text" maxlength="10"
                   autocomplete="off" autocorrect="off" autocapitalize="off"
                   spellcheck="false" oninput="checkCode()">
        </div>
    </div>
</div>

<!-- ══ SCENE ══ -->
<div id="sceneLayer">
    <div class="sun"></div>

    <div class="cloud" style="top:30px;left:-260px;animation-duration:28s;"><div style="position:relative;"><div class="cb" style="width:140px;height:40px;"></div><div class="cbump" style="width:62px;height:62px;top:-36px;left:40px;"></div><div class="cbump" style="width:44px;height:44px;top:-22px;left:8px;"></div><div class="cbump" style="width:44px;height:44px;top:-22px;left:90px;"></div></div></div>
    <div class="cloud" style="top:58px;left:-260px;animation-duration:44s;animation-delay:10s;opacity:.8;"><div style="position:relative;"><div class="cb" style="width:105px;height:30px;"></div><div class="cbump" style="width:46px;height:46px;top:-28px;left:30px;"></div><div class="cbump" style="width:32px;height:32px;top:-18px;left:6px;"></div><div class="cbump" style="width:32px;height:32px;top:-18px;left:68px;"></div></div></div>
    <div class="cloud" style="top:16px;left:-260px;animation-duration:60s;animation-delay:22s;opacity:.65;"><div style="position:relative;"><div class="cb" style="width:175px;height:48px;"></div><div class="cbump" style="width:76px;height:76px;top:-46px;left:50px;"></div><div class="cbump" style="width:52px;height:52px;top:-30px;left:10px;"></div><div class="cbump" style="width:52px;height:52px;top:-30px;left:116px;"></div></div></div>
    <div class="cloud" style="top:80px;left:-260px;animation-duration:36s;animation-delay:5s;opacity:.7;"><div style="position:relative;"><div class="cb" style="width:88px;height:24px;"></div><div class="cbump" style="width:38px;height:38px;top:-22px;left:25px;"></div><div class="cbump" style="width:26px;height:26px;top:-14px;left:4px;"></div><div class="cbump" style="width:26px;height:26px;top:-14px;left:58px;"></div></div></div>
    <div class="cloud" style="top:45px;left:-260px;animation-duration:52s;animation-delay:16s;opacity:.75;"><div style="position:relative;"><div class="cb" style="width:120px;height:32px;"></div><div class="cbump" style="width:52px;height:52px;top:-32px;left:34px;"></div><div class="cbump" style="width:36px;height:36px;top:-18px;left:6px;"></div><div class="cbump" style="width:36px;height:36px;top:-18px;left:78px;"></div></div></div>

    <div class="scene-leaf" style="left:10%;animation-duration:6s;font-size:18px;">🍃</div>
    <div class="scene-leaf sl-desktop" style="left:25%;animation-duration:8s;animation-delay:2s;font-size:15px;">🍂</div>
    <div class="scene-leaf sl-desktop" style="left:48%;animation-duration:7s;animation-delay:4s;font-size:17px;">🌿</div>
    <div class="scene-leaf" style="left:68%;animation-duration:9s;animation-delay:1.5s;font-size:16px;">🍃</div>
    <div class="scene-leaf sl-desktop" style="left:85%;animation-duration:6.5s;animation-delay:5s;font-size:14px;">🍂</div>

    <!-- Burung terbang — giliran, delay = durasi bird sebelumnya agar tidak tabrakan -->
    <div class="fly-bird" style="top:8%;animation-duration:14s;animation-delay:0s;font-size:13px;">🐦</div>
    <div class="fly-bird" style="top:6%;animation-duration:18s;animation-delay:14s;font-size:10px;">🐦</div>
    <div class="fly-bird" style="top:10%;animation-duration:15s;animation-delay:32s;font-size:11px;">🐦</div>

    <!-- Gedung -->
    <div class="bld-wrap" id="bldWrap">
        <div style="display:flex;flex-direction:column;align-items:center;gap:0;">
            <div class="tower" id="towerL" style="width:88px;height:240px;">
                <div class="tw" style="width:12px;height:16px;top:20px;left:12px;"></div><div class="tw" style="width:12px;height:16px;top:20px;left:32px;animation-delay:.4s;"></div><div class="tw" style="width:12px;height:16px;top:20px;left:52px;animation-delay:.8s;"></div>
                <div class="tw" style="width:12px;height:16px;top:48px;left:12px;animation-delay:.2s;"></div><div class="tw" style="width:12px;height:16px;top:48px;left:32px;animation-delay:.6s;"></div><div class="tw" style="width:12px;height:16px;top:48px;left:52px;animation-delay:1s;"></div>
                <div class="tw" style="width:12px;height:16px;top:76px;left:12px;animation-delay:.3s;"></div><div class="tw" style="width:12px;height:16px;top:76px;left:32px;animation-delay:.7s;"></div><div class="tw" style="width:12px;height:16px;top:76px;left:52px;animation-delay:1.2s;"></div>
                <div class="tw" style="width:12px;height:16px;top:104px;left:12px;animation-delay:.5s;"></div><div class="tw" style="width:12px;height:16px;top:104px;left:32px;animation-delay:.9s;"></div><div class="tw" style="width:12px;height:16px;top:104px;left:52px;animation-delay:1.4s;"></div>
                <div class="tw" style="width:12px;height:16px;top:132px;left:12px;animation-delay:.1s;"></div><div class="tw" style="width:12px;height:16px;top:132px;left:32px;animation-delay:.5s;"></div><div class="tw" style="width:12px;height:16px;top:132px;left:52px;animation-delay:.9s;"></div>
                <div class="tw" style="width:12px;height:16px;top:160px;left:12px;animation-delay:.3s;"></div><div class="tw" style="width:12px;height:16px;top:160px;left:32px;animation-delay:.7s;"></div><div class="tw" style="width:12px;height:16px;top:160px;left:52px;animation-delay:1.1s;"></div>
                <div class="tw" style="width:12px;height:16px;top:188px;left:12px;animation-delay:.4s;"></div><div class="tw" style="width:12px;height:16px;top:188px;left:32px;animation-delay:.8s;"></div><div class="tw" style="width:12px;height:16px;top:188px;left:52px;animation-delay:1.3s;"></div>
            </div>
            <div class="podium" id="podiumL"></div>
        </div>
        <div class="connector" id="connectorEl" style="width:56px;height:96px;">
            <div class="tw" style="width:14px;height:18px;top:16px;left:21px;animation-delay:.3s;"></div>
            <div class="tw" style="width:14px;height:18px;top:46px;left:21px;animation-delay:.8s;"></div>
        </div>
        <div style="display:flex;flex-direction:column;align-items:center;gap:0;">
            <div class="tower" id="towerR" style="width:88px;height:280px;">
                <div class="tw" style="width:12px;height:16px;top:20px;left:12px;animation-delay:.1s;"></div><div class="tw" style="width:12px;height:16px;top:20px;left:32px;animation-delay:.5s;"></div><div class="tw" style="width:12px;height:16px;top:20px;left:52px;animation-delay:.9s;"></div>
                <div class="tw" style="width:12px;height:16px;top:48px;left:12px;animation-delay:.3s;"></div><div class="tw" style="width:12px;height:16px;top:48px;left:32px;animation-delay:.7s;"></div><div class="tw" style="width:12px;height:16px;top:48px;left:52px;animation-delay:1.1s;"></div>
                <div class="tw" style="width:12px;height:16px;top:76px;left:12px;animation-delay:.2s;"></div><div class="tw" style="width:12px;height:16px;top:76px;left:32px;animation-delay:.6s;"></div><div class="tw" style="width:12px;height:16px;top:76px;left:52px;animation-delay:1s;"></div>
                <div class="tw" style="width:12px;height:16px;top:104px;left:12px;animation-delay:.4s;"></div><div class="tw" style="width:12px;height:16px;top:104px;left:32px;animation-delay:.8s;"></div><div class="tw" style="width:12px;height:16px;top:104px;left:52px;animation-delay:1.3s;"></div>
                <div class="tw" style="width:12px;height:16px;top:132px;left:12px;animation-delay:.2s;"></div><div class="tw" style="width:12px;height:16px;top:132px;left:32px;animation-delay:.6s;"></div><div class="tw" style="width:12px;height:16px;top:132px;left:52px;animation-delay:1s;"></div>
                <div class="tw" style="width:12px;height:16px;top:160px;left:12px;animation-delay:.5s;"></div><div class="tw" style="width:12px;height:16px;top:160px;left:32px;animation-delay:.9s;"></div><div class="tw" style="width:12px;height:16px;top:160px;left:52px;animation-delay:1.4s;"></div>
                <div class="tw" style="width:12px;height:16px;top:188px;left:12px;animation-delay:.3s;"></div><div class="tw" style="width:12px;height:16px;top:188px;left:32px;animation-delay:.7s;"></div><div class="tw" style="width:12px;height:16px;top:188px;left:52px;animation-delay:1.2s;"></div>
                <div class="tw" style="width:12px;height:16px;top:216px;left:12px;animation-delay:.1s;"></div><div class="tw" style="width:12px;height:16px;top:216px;left:32px;animation-delay:.5s;"></div><div class="tw" style="width:12px;height:16px;top:216px;left:52px;animation-delay:.9s;"></div>
            </div>
            <div class="podium" id="podiumR"></div>
        </div>
    </div>

    <!-- Pohon tengah dihapus — diganti pohon kecil di baris depan via JS -->

    <!-- Pohon depan kiri & kanan (baris sama dengan bench, di atas sungai) -->
    <div id="frontTreeL"></div>
    <div id="frontTreeR"></div>

    <!-- Sungai (NO jembatan) -->
    <div class="river" id="riverEl">
        <div class="river-ripple" style="top:50%;left:25%;animation-delay:0s;"></div>
        <div class="river-ripple" style="top:50%;left:55%;animation-delay:1.5s;"></div>
        <div class="river-ripple" style="top:50%;left:75%;animation-delay:3s;"></div>
    </div>

    <!-- Bench (membelakangi layar = hadap sungai, sandaran ke arah kita) -->
    <div class="bench-wrap" id="benchEl">
        <div class="bench-seat" id="benchSeat"></div>
        <div class="bench-back" id="benchBack"></div>
        <div class="bench-leg"  id="benchLeg1"></div>
        <div class="bench-leg"  id="benchLeg2"></div>
        <div class="bench-leg"  id="benchLeg3"></div>
        <div class="bench-leg"  id="benchLeg4"></div>
    </div>

    <!-- Rumput -->
    <div class="grass-main" id="grassMain"></div>

    <!-- Semak kiri & kanan (z:4, di atas sungai, bawah pohon) -->
    <div class="shrub-row" id="shrubRowL"></div>
    <div class="shrub-row" id="shrubRowR"></div>

    <!-- Bunga -->
    <div class="ground-flower" style="left:30%;"><div class="gf-stem" style="width:3px;height:18px;"></div><div class="gf-head" style="width:12px;height:12px;background:#ffcc00;margin-top:-6px;"></div></div>
    <div class="ground-flower" style="left:47%;"><div class="gf-stem" style="width:3px;height:14px;"></div><div class="gf-head" style="width:12px;height:12px;background:#ff7040;margin-top:-6px;"></div></div>
    <div class="ground-flower" style="left:63%;"><div class="gf-stem" style="width:3px;height:20px;"></div><div class="gf-head" style="width:12px;height:12px;background:#ff4090;margin-top:-6px;"></div></div>
    <div class="ground-flower" style="left:38%;"><div class="gf-stem" style="width:2px;height:12px;"></div><div class="gf-head" style="width:10px;height:10px;background:#cc44ff;margin-top:-5px;"></div></div>
    <div class="ground-flower" style="left:55%;"><div class="gf-stem" style="width:2px;height:16px;"></div><div class="gf-head" style="width:10px;height:10px;background:#ff8844;margin-top:-5px;"></div></div>

    <!-- Blade -->
    <div class="blade" style="left:20%;height:26px;width:4px;background:#3aaa18;animation-duration:1.1s;"></div>
    <div class="blade" style="left:23%;height:22px;width:3px;background:#2a9010;animation-duration:1.4s;animation-delay:.3s;"></div>
    <div class="blade" style="left:34%;height:28px;width:4px;background:#3aaa18;animation-duration:1.2s;animation-delay:.6s;"></div>
    <div class="blade" style="left:52%;height:24px;width:3px;background:#2a9010;animation-duration:1.3s;animation-delay:.2s;"></div>
    <div class="blade" style="left:58%;height:26px;width:4px;background:#3aaa18;animation-duration:1.5s;animation-delay:.8s;"></div>
    <div class="blade" style="left:72%;height:22px;width:3px;background:#2a9010;animation-duration:1.1s;animation-delay:.4s;"></div>

    <!-- Kupu -->
    <div class="butterfly" style="left:28%;top:38%;animation-duration:8s;"><svg width="26" height="16" viewBox="0 0 26 16"><ellipse class="wing-l" cx="6" cy="8" rx="6" ry="7" fill="#ff88cc" opacity=".85"/><ellipse class="wing-r" cx="20" cy="8" rx="6" ry="7" fill="#ff88cc" opacity=".85"/><ellipse cx="13" cy="8" rx="2" ry="6" fill="#442244"/></svg></div>
    <div class="butterfly" style="left:52%;top:30%;animation-duration:12s;animation-delay:3s;"><svg width="24" height="14" viewBox="0 0 26 16"><ellipse class="wing-l" cx="6" cy="8" rx="6" ry="7" fill="#88ccff" opacity=".85"/><ellipse class="wing-r" cx="20" cy="8" rx="6" ry="7" fill="#88ccff" opacity=".85"/><ellipse cx="13" cy="8" rx="2" ry="6" fill="#224466"/></svg></div>
    <div class="butterfly" style="left:70%;top:42%;animation-duration:10s;animation-delay:5s;"><svg width="22" height="14" viewBox="0 0 26 16"><ellipse class="wing-l" cx="6" cy="8" rx="6" ry="7" fill="#ffdd44" opacity=".85"/><ellipse class="wing-r" cx="20" cy="8" rx="6" ry="7" fill="#ffdd44" opacity=".85"/><ellipse cx="13" cy="8" rx="2" ry="6" fill="#444422"/></svg></div>

    <!-- Capung -->
    <div class="drfly" style="left:38%;top:46%;animation-duration:7s;"><svg width="32" height="12" viewBox="0 0 32 12"><ellipse class="dfw" cx="9" cy="6" rx="8" ry="4" fill="rgba(180,220,255,.75)"/><ellipse class="dfw" cx="23" cy="6" rx="8" ry="4" fill="rgba(180,220,255,.75)"/><rect x="11" y="3" width="10" height="5" rx="2.5" fill="#2a8a4a"/></svg></div>
    <div class="drfly" style="left:62%;top:36%;animation-duration:11s;animation-delay:4s;"><svg width="28" height="10" viewBox="0 0 32 12"><ellipse class="dfw" cx="9" cy="6" rx="8" ry="4" fill="rgba(180,255,200,.75)"/><ellipse class="dfw" cx="23" cy="6" rx="8" ry="4" fill="rgba(180,255,200,.75)"/><rect x="11" y="3" width="10" height="5" rx="2.5" fill="#2a6a8a"/></svg></div>

    <!-- Pohon besar KIRI (batang + canopy + dahan tanpa canopy) -->
    <div class="big-trunk" id="bigTrunkL"></div>
    <div class="big-c" id="bigC1L"></div><div class="big-c" id="bigC2L"></div><div class="big-c" id="bigC3L"></div><div class="big-c" id="bigC4L"></div>
    <div class="big-branch" id="branchL"></div>
    <div class="nest" id="nestL"></div>

    <!-- Pohon besar KANAN -->
    <div class="big-trunk" id="bigTrunkR"></div>
    <div class="big-c" id="bigC1R"></div><div class="big-c" id="bigC2R"></div><div class="big-c" id="bigC3R"></div><div class="big-c" id="bigC4R"></div>
    <div class="big-branch" id="branchR"></div>

    <!-- Burung kiri — viewBox dipotong ketat, kaki di batas bawah -->
    <div class="bird-wrap" id="birdLeft" onclick="birdLeftClick()">
        <svg id="birdLeftSvg" viewBox="0 0 38 28" fill="none" style="display:block;overflow:visible;">
            <ellipse cx="18" cy="13" rx="12" ry="8" fill="#1a1a2e"/>
            <ellipse cx="15" cy="14" rx="9" ry="5" fill="#2a2a4a" transform="rotate(-10 15 14)"/>
            <ellipse cx="22" cy="14" rx="6" ry="5" fill="#e8e8f0"/>
            <circle cx="28" cy="7" r="7" fill="#1a1a2e"/>
            <circle cx="30" cy="6" r="1.8" fill="#fff"/>
            <circle cx="30.5" cy="6" r=".9" fill="#111"/>
            <path d="M34 7 L38 6 L34 8 Z" fill="#e8a020"/>
            <path d="M6 13 L0 17 L4 11 Z" fill="#1a1a2e"/>
            <!-- kaki: y_max = 27 = batas bawah viewBox 28 -->
            <line x1="19" y1="21" x2="16" y2="27" stroke="#888" stroke-width="1.4"/>
            <line x1="16" y1="27" x2="11" y2="27" stroke="#888" stroke-width="1.2"/>
            <line x1="22" y1="21" x2="25" y2="27" stroke="#888" stroke-width="1.4"/>
            <line x1="25" y1="27" x2="30" y2="27" stroke="#888" stroke-width="1.2"/>
        </svg>
    </div>

    <!-- Burung kanan — ukuran & posisi 100% via JS -->
    <div class="bird-wrap" id="birdRight" onclick="birdRightClick()">
        <svg id="birdRightSvg" viewBox="0 0 56 46" fill="none" style="display:block;overflow:visible;transform:scaleX(-1);">
            <ellipse cx="26" cy="24" rx="18" ry="12" fill="#e8a030"/>
            <ellipse cx="22" cy="25" rx="14" ry="8" fill="#c07818" transform="rotate(-8 22 25)"/>
            <ellipse cx="33" cy="25" rx="9" ry="8" fill="#ffd080"/>
            <circle cx="40" cy="14" r="10" fill="#e8a030"/>
            <path d="M38 5 Q42 0 44 6" stroke="#c07818" stroke-width="2.5" fill="none" stroke-linecap="round"/>
            <circle cx="43" cy="13" r="2.5" fill="#fff"/>
            <circle cx="43.5" cy="13" r="1.2" fill="#111"/>
            <path d="M49 14 L56 12 L49 16 Z" fill="#e06010"/>
            <path d="M8 24 L0 30 L5 20 Z" fill="#c07818"/>
            <path d="M8 26 L1 34 L6 23 Z" fill="#a06010"/>
            <!-- kaki: y_max = 44 dalam viewBox tinggi 46 -->
            <line x1="26" y1="36" x2="22" y2="44" stroke="#888" stroke-width="1.8"/>
            <line x1="22" y1="44" x2="14" y2="44" stroke="#888" stroke-width="1.5"/>
            <line x1="30" y1="36" x2="34" y2="44" stroke="#888" stroke-width="1.8"/>
            <line x1="34" y1="44" x2="42" y2="44" stroke="#888" stroke-width="1.5"/>
        </svg>
    </div>
</div>

<!-- TV overlay -->
<div id="tvOverlay" style="display:none;align-items:center;justify-content:center;">
    <div class="tv-dot" id="tvDot"></div>
</div>

<script>
(function() {
var SECRET    = '{{ env("GATE_SECRET","bh2025") }}';
var gating    = false;
var birdRBusy = false;

/* ══════════════════════════════════════════
   LAYOUT
══════════════════════════════════════════ */
function layoutScene() {
    var W        = window.innerWidth;
    var H        = window.innerHeight;
    var isMobile = W < 768;
    var isSmall  = W < 480;

    var grassH = isSmall ? 80  : isMobile ? 100 : 120;
    var trunkW = isSmall ? 32  : isMobile ? 44  : 68;
    var trunkH = isSmall ? H*.44 : isMobile ? H*.48 : H*.60;
    var rvH    = isSmall ? 22 : isMobile ? 30 : 40;

    /* Rumput */
    var gm = document.getElementById('grassMain');
    if (gm) gm.style.height = grassH + 'px';

    /* Sungai — bottom flush ke atas rumput */
    var river = document.getElementById('riverEl');
    if (river) { river.style.bottom = grassH + 'px'; river.style.height = rvH + 'px'; }

    /* Gedung — bottom pas di atas sungai */
    var bld = document.getElementById('bldWrap');
    if (bld) {
        bld.style.bottom          = (grassH + rvH) + 'px';
        bld.style.transform       = 'translateX(-50%) scale(' + (isSmall?.58:isMobile?.76:1) + ')';
        bld.style.transformOrigin = 'bottom center';
    }

    /* Dekorasi blade & bunga */
    document.querySelectorAll('.blade').forEach(function(b) { b.style.bottom = (grassH + rvH) + 'px'; });
    document.querySelectorAll('.ground-flower').forEach(function(f) { f.style.bottom = (grassH + rvH + 6) + 'px'; });

    /*
     * SEMAK — di seberang/belakang sungai: bottom = grassH + rvH.
     * z-index:4 (di bawah pohon depan z:7, di belakang sungai).
     * 1 row penuh lebar layar.
     */
    var shrubBottom = grassH + rvH;
    buildShrubs('shrubRowL', 0, W, shrubBottom, isMobile, isSmall);
    var rowR = document.getElementById('shrubRowR');
    if (rowR) rowR.style.display = 'none';

    /* BENCH */
    buildBench(W, H, grassH, rvH, isMobile, isSmall);

    /*
     * POHON DEPAN — 2 pohon kecil di baris depan (bottom = grassH, z-index:7).
     * Posisi X: kiri ~20%, kanan ~72%.
     * Tidak menghalangi gedung karena pohon besar ada di tepi layar.
     */
    /* Pohon depan — baris sama dengan bench (bottom=grassH), lebih pendek di mobile */
    buildFrontTree('frontTreeL', W*.18, grassH, isMobile, isSmall);
    buildFrontTree('frontTreeR', W*.74, grassH, isMobile, isSmall);

    /* ── POHON BESAR ── */
    var c1s = isSmall?120:isMobile?160:260;
    var c2s = isSmall? 92:isMobile?122:200;
    var c3s = isSmall? 68:isMobile? 92:154;
    var c4s = isSmall? 48:isMobile? 65:114;
    var trunkTop = H - grassH - trunkH;

    /* Batang kiri */
    setEl('bigTrunkL', {
        left:'0', bottom:'0', width:trunkW+'px', height:trunkH+'px',
        background:'linear-gradient(180deg,#7a5028,#5a3810 60%,#4a2808)',
        borderRadius:'0 12px 0 0'
    });
    /* Canopy mulai dari puncak batang (trunkTop) — tidak ada gap */
    setCanopy('bigC1L',{left:(-c1s*.28)+'px', top:(trunkTop)+'px', w:c1s, h:c1s*.84, bg:'#186010', br:'48% 58% 52% 44%/55% 48% 58% 42%', dur:'5.5s'});
    setCanopy('bigC2L',{left:(-c2s*.16)+'px', top:(trunkTop-c2s*.46)+'px', w:c2s, h:c2s*.87, bg:'#1e7818', br:'54% 44% 48% 56%/44% 58% 42% 58%', dur:'6.5s'});
    setCanopy('bigC3L',{left:(-c3s*.08)+'px', top:(trunkTop-c2s*.40-c3s*.46)+'px', w:c3s, h:c3s*.90, bg:'#289020', br:'44% 56% 58% 44%/58% 44% 56% 42%', dur:'7s'});
    setCanopy('bigC4L',{left:(trunkW*.14)+'px', top:(trunkTop-c2s*.36-c3s*.40-c4s*.46)+'px', w:c4s, h:c4s*.92, bg:'#32a828', br:'56% 44% 42% 58%/42% 56% 44% 58%', dur:'4.5s'});

    /*
     * DAHAN KIRI
     * - Mulai dari dalam batang (left = trunkW - overlap) agar terlihat menyatu.
     * - Y = 55% dari puncak batang = di area coklat, jauh di bawah canopy.
     * - Tidak ada border-radius besar supaya tidak ada gap visual.
     */
    var overlap = Math.round(trunkW * .35); /* dahan overlap ke dalam batang */
    var bLW = isSmall ? Math.round(W*.16) : isMobile ? Math.round(W*.18) : Math.round(W*.16);
    var bLH = isSmall ? 7 : isMobile ? 10 : 13;
    var bLY = trunkTop + trunkH * .55;
    var bLX = trunkW - overlap; /* mulai dari dalam batang */

    setEl('branchL', {
        position:'fixed', left:bLX+'px', top:bLY+'px',
        width:(bLW+overlap)+'px', height:bLH+'px',
        background:'linear-gradient(90deg,#7a5028 0%,#7a5028 '+(overlap/(bLW+overlap)*100)+'%,#5a3810 100%)',
        borderRadius:'0 4px 4px 0', zIndex:'8',
        transform:'rotate(-7deg)', transformOrigin:'left center'
    });

    /* Sarang di dahan kiri */
    /* Batang kanan */
    setEl('bigTrunkR', {
        right:'0', bottom:'0', width:trunkW+'px', height:trunkH+'px',
        background:'linear-gradient(180deg,#7a5028,#5a3810 60%,#4a2808)',
        borderRadius:'12px 0 0 0'
    });
    setCanopy('bigC1R',{right:(-c1s*.28)+'px', top:(trunkTop)+'px', w:c1s, h:c1s*.84, bg:'#186010', br:'58% 48% 44% 52%/48% 55% 42% 58%', dur:'5s'});
    setCanopy('bigC2R',{right:(-c2s*.16)+'px', top:(trunkTop-c2s*.46)+'px', w:c2s, h:c2s*.87, bg:'#1e7818', br:'44% 54% 56% 48%/58% 44% 58% 42%', dur:'6s'});
    setCanopy('bigC3R',{right:(-c3s*.08)+'px', top:(trunkTop-c2s*.40-c3s*.46)+'px', w:c3s, h:c3s*.90, bg:'#289020', br:'56% 44% 44% 56%/44% 58% 42% 56%', dur:'6.8s'});
    setCanopy('bigC4R',{right:(trunkW*.14)+'px', top:(trunkTop-c2s*.36-c3s*.40-c4s*.46)+'px', w:c4s, h:c4s*.92, bg:'#32a828', br:'44% 56% 58% 44%/56% 42% 58% 44%', dur:'4.8s'});

    /* Dahan kanan (overlap ke kiri dari batang kanan) */
    var bRW = isSmall ? Math.round(W*.16) : isMobile ? Math.round(W*.18) : Math.round(W*.16);
    var bRH = isSmall ? 7 : isMobile ? 10 : 13;
    var bRY = trunkTop + trunkH * .53;
    /* Ujung kanan dahan masuk ke dalam batang kanan */
    var bRX = W - trunkW - bRW + overlap; /* = W - trunkW - (bRW - overlap) */

    setEl('branchR', {
        position:'fixed', left:bRX+'px', top:bRY+'px',
        width:(bRW+overlap)+'px', height:bRH+'px',
        background:'linear-gradient(90deg,#5a3810 0%,#7a5028 '+(bRW/(bRW+overlap)*100)+'%,#7a5028 100%)',
        borderRadius:'4px 0 0 4px', zIndex:'8',
        transform:'rotate(5deg)', transformOrigin:'right center'
    });

    /* Posisi burung — kaki tepat di atas dahan */
    positionBirds(trunkW, overlap, bLX, bLY, bLW, bLH, bRX, bRY, bRW, bRH, isSmall, isMobile);
}

/* ── Bench membelakangi layar (hadap sungai) ── */
function buildBench(W, H, grassH, rvH, isMobile, isSmall) {
    var bw   = isSmall?52 :isMobile?72 :100;  /* lebih lebar */
    var sh   = isSmall?6  :isMobile?9  :13;
    var legH = isSmall?12 :isMobile?17 :25;
    var legW = isSmall?4  :isMobile?5  :7;
    var backH= isSmall?13 :isMobile?18 :26;
    var backT= isSmall?4  :isMobile?5  :6;
    var li   = Math.round(bw*.10);

    var bx = W*.35 - bw/2;
    var bench = document.getElementById('benchEl');
    if (!bench) return;
    bench.style.cssText = 'position:absolute;left:'+bx+'px;bottom:'+grassH+'px;width:'+bw+'px;height:'+(legH+sh+backH+4)+'px;z-index:6;';

    /* Seat */
    setE('benchSeat',{position:'absolute',bottom:legH+'px',left:'0',width:bw+'px',height:sh+'px',background:'#a06830',borderRadius:'2px'});
    /* Hanya 2 kaki saja (kiri & kanan), tidak ada kaki tengah */
    setE('benchLeg1',{position:'absolute',bottom:'0',left:li+'px',width:legW+'px',height:legH+'px',background:'#7a4820',borderRadius:'1px 1px 2px 2px'});
    setE('benchLeg2',{position:'absolute',bottom:'0',right:li+'px',width:legW+'px',height:legH+'px',background:'#7a4820',borderRadius:'1px 1px 2px 2px'});
    /* Leg3 & Leg4 disembunyikan */
    setE('benchLeg3',{display:'none'});
    setE('benchLeg4',{display:'none'});
    /* Backrest — palang di atas seat */
    setE('benchBack',{position:'absolute',bottom:(legH+sh)+'px',left:li+'px',width:(bw-li*2)+'px',height:backT+'px',background:'#8b5828',borderRadius:'2px'});
}

/* ── Semak — pas di atas sungai ── */
function buildShrubs(rowId, xStart, xEnd, shrubBottom, isMobile, isSmall) {
    var row = document.getElementById(rowId);
    if (!row) return;
    row.innerHTML = '';
    row.style.cssText = 'position:absolute;z-index:4;display:flex;align-items:flex-end;overflow:visible;left:'+xStart+'px;bottom:'+shrubBottom+'px;width:'+(xEnd-xStart)+'px;';

    var colors   = ['#1e7010','#258818','#2a9820','#207810','#1e6810'];
    var flColors = ['#e83030','#f04848','#cc2020','#e84040','#f05050'];
    var shrubW   = isSmall?22:isMobile?30:46;
    var count    = Math.ceil((xEnd-xStart)/shrubW) + 6;

    for (var i = 0; i < count; i++) {
        var h   = (isSmall?18:isMobile?26:40) + (i%3)*(isSmall?5:8);
        var w   = shrubW + (i%4)*(isSmall?3:5);
        var div = document.createElement('div');
        div.className = 'shrub';
        div.style.cssText = 'width:'+w+'px;height:'+h+'px;background:'+colors[i%colors.length]+
            ';margin-left:'+(i===0?0:-Math.round(w*.30))+'px'+
            ';animation-duration:'+(3+i*.4)+'s;animation-delay:'+(i*.3)+'s;';
        /* Bunga: posisi DALAM semak, di bagian atas (top 8-25% dari height) */
        var numF = 2+(i%3);
        for (var f=0; f<numF; f++) {
            var fsize = isSmall?5:isMobile?6:8;
            var fl=document.createElement('div');
            fl.className='shrub-flower';
            /* top: di dalam semak, bukan negatif */
            var ftop = Math.round(h * (.08 + f*.10));
            var fleft= Math.round(w*.15 + f * Math.round(w*.65/numF));
            fl.style.cssText='width:'+fsize+'px;height:'+fsize+'px;'+
                'background:'+flColors[(i+f)%flColors.length]+
                ';top:'+ftop+'px;left:'+fleft+'px;animation-delay:'+(f*.3+i*.2)+'s;';
            div.appendChild(fl);
        }
        row.appendChild(div);
    }
}

/* Pohon depan — baris sama bench, lebih pendek di mobile */
function buildFrontTree(id, xCenter, grassH, isMobile, isSmall) {
    var wrap = document.getElementById(id);
    if (!wrap) return;
    wrap.innerHTML = '';

    /* Lebih pendek di mobile agar tidak menjulang */
    var tw  = isSmall?9 :isMobile?12:18;
    var th  = isSmall?28:isMobile?42:78;
    var c1w = isSmall?44:isMobile?62:98;
    var c1h = isSmall?46:isMobile?66:104;
    var c2w = isSmall?32:isMobile?46:72;
    var c2h = isSmall?34:isMobile?50:76;
    var c3w = isSmall?22:isMobile?32:50;
    var c3h = isSmall?24:isMobile?34:52;

    wrap.className = 'ft-wrap';
    wrap.style.cssText = 'position:absolute;z-index:7;left:'+(xCenter-tw/2)+'px;bottom:'+grassH+'px;width:'+tw+'px;height:'+(th+c1h*.75)+'px;';

    var trunk = document.createElement('div');
    trunk.className = 'ft-trunk';
    trunk.style.cssText = 'width:'+tw+'px;height:'+th+'px;border-radius:3px;';
    wrap.appendChild(trunk);

    var layers=[
        {w:c1w,h:c1h,b:th*.50,bg:'#1a5e0e',br:'50% 50% 44% 44%'},
        {w:c2w,h:c2h,b:th*.50+c1h*.40,bg:'#22780e',br:'52% 48% 46% 46%'},
        {w:c3w,h:c3h,b:th*.50+c1h*.36+c2h*.40,bg:'#2a9018',br:'54% 46% 48% 44%'}
    ];
    layers.forEach(function(l,i){
        var c=document.createElement('div');
        c.className='ft-c';
        c.style.cssText='position:absolute;width:'+l.w+'px;height:'+l.h+'px;bottom:'+l.b+'px;'+
            'background:'+l.bg+';border-radius:'+l.br+';animation-duration:'+(5+i)+'s;animation-delay:'+(i*.8)+'s;';
        wrap.appendChild(c);
    });
}

function setEl(id,s){var e=document.getElementById(id);if(!e)return;Object.keys(s).forEach(function(k){e.style[k]=s[k];});}
function setE(id,s){setEl(id,s);}
function setCanopy(id,s){
    var el=document.getElementById(id); if(!el)return;
    el.style.position='fixed';
    el.style.left  =s.left ||'auto';
    el.style.right =s.right||'auto';
    el.style.top   =s.top;
    el.style.width =s.w+'px'; el.style.height=s.h+'px';
    el.style.background=s.bg; el.style.borderRadius=s.br;
    el.style.animationDuration=s.dur||'5s';
}

/*
 * positionBirds — kaki burung tepat DI ATAS dahan.
 * Burung kiri: SVG 48x40, viewBox 38x32. Kaki di y=31 dalam viewBox.
 * footOffset = renderedHeight * (kakyY/viewH) * scale = 40*(31/32)*sL
 * Burung kanan: SVG 68x56, viewBox 56x46. Kaki di y=44.
 * footOffset = 56*(44/46)*sR
 */
function positionBirds(trunkW, overlap, bLX, bLY, bLW, bLH, bRX, bRY, bRW, bRH, isSmall, isMobile) {
    var bl   = document.getElementById('birdLeft');
    var br   = document.getElementById('birdRight');
    var svgL = document.getElementById('birdLeftSvg');
    var svgR = document.getElementById('birdRightSvg');
    if (!bl||!br||!svgL||!svgR) return;

    /*
     * PENDEKATAN BARU — tidak pakai CSS scale sama sekali.
     * SVG width/height di-set langsung → rendered size = persis ukuran itu.
     * viewBox kiri  = "0 0 38 32", kaki di y=31/32 → kaki di 31/32 × height dari atas.
     * viewBox kanan = "0 0 56 46", kaki di y=44/46 → kaki di 44/46 × height dari atas.
     *
     * Posisi wrapper div (position:fixed):
     *   left = X_hinggap - width/2          (center horizontal di titik hinggap)
     *   top  = Y_hinggap - height*(31/32)   (kaki tepat di Y_hinggap)
     *
     * Y_hinggap = Y permukaan atas dahan di titik tsb, memperhitungkan rotasi.
     */

    /* ── Ukuran burung ── */
    var bLW_px = isSmall ? 20 : isMobile ? 28 : 52;
    var bLH_px = Math.round(bLW_px * 28/38); /* viewBox 38x28 */
    svgL.setAttribute('width',  bLW_px);
    svgL.setAttribute('height', bLH_px);

    var bRW_px = isSmall ? 24 : isMobile ? 34 : 62;
    var bRH_px = Math.round(bRW_px * 46/56); /* viewBox 56x46 */
    svgR.setAttribute('width',  bRW_px);
    svgR.setAttribute('height', bRH_px);

    /* ── Titik hinggap kiri ── */
    var bLtotalW = bLW + overlap;
    var posL     = 0.62;
    var hX_L     = bLX + bLtotalW * posL;
    /*
     * Dahan kiri rotate(-7°) dari left center (bLX, bLY+bLH/2).
     * Tepi ATAS dahan di posL:
     *   Y = bLY - sin(7°)×bLtotalW×posL   ← dikurangi!
     * (rotate(-7°) → ujung kanan turun, tapi tepi ATAS di posL justru naik relatif center)
     * Kaki SVG: viewBox 0 0 38 28, kaki di y=27 → ratio 27/28
     */
    var hY_L = bLY - Math.sin(7 * Math.PI/180) * bLtotalW * posL;
    bl.style.position  = 'fixed';
    bl.style.transform = 'none';
    bl.style.left      = (hX_L - bLW_px / 2) + 'px';
    bl.style.top       = (hY_L - bLH_px * 27/28) + 'px';
    bl.style.animation = 'headbob 4s ease-in-out infinite';

    /* ── Sarang ── */
    var nL = document.getElementById('nestL');
    if (nL) {
        var nw = isSmall?18:isMobile?24:32, nh = isSmall?10:isMobile?13:17;
        var nPos = 0.28;
        var nX   = bLX + bLtotalW * nPos;
        var nY   = bLY - Math.sin(7 * Math.PI/180) * bLtotalW * nPos;
        nL.style.left   = (nX - nw/2) + 'px';
        nL.style.top    = (nY - nh) + 'px';
        nL.style.width  = nw + 'px';
        nL.style.height = nh + 'px';
    }

    /* ── Titik hinggap kanan ── */
    var bRtotalW = bRW + overlap;
    var posR     = 0.38;
    var hX_R     = bRX + bRtotalW * posR;
    /* Dahan rotate(5°) dari right center → ujung kiri lebih tinggi */
    var hY_R     = bRY - Math.sin(5 * Math.PI/180) * bRtotalW * (1 - posR);

    br.style.position  = 'fixed';
    br.style.transform = 'none';
    br.style.left      = (hX_R - bRW_px / 2) + 'px';
    br.style.right     = 'auto';
    /* kaki di 44/46 dari atas */
    br.style.top       = (hY_R - bRH_px * 44/46) + 'px';
    br.style.animation = 'headbob 3.2s ease-in-out infinite';
}

/* ── Cek kode ── */
function checkCode() {
    if (gating) return;
    if (document.getElementById('codeInput').value !== SECRET) return;
    gating = true;
    document.getElementById('codeInput').disabled = true;
    document.getElementById('gateGlow').classList.add('lit');
    setTimeout(function(){
        document.getElementById('doorL').classList.add('open');
        document.getElementById('doorR').classList.add('open');
    }, 500);
    setTimeout(function(){
        document.getElementById('gateLayer').classList.add('hide');
        var sl = document.getElementById('sceneLayer');
        sl.style.display = 'block';
        layoutScene();
        gating = false;
    }, 1500);
}

/* ── Burung kiri — muter pelan smooth lalu zoom ke depan ── */
function birdLeftClick() {
    if (gating) return;
    gating = true;
    var bird = document.getElementById('birdLeft');
    bird.style.animation = 'none';
    bird.style.transform = 'none';

    var r   = bird.getBoundingClientRect();
    var cx  = window.innerWidth  / 2;
    var cy  = window.innerHeight / 2;
    var tx0 = cx - r.left - r.width  / 2;
    var ty0 = cy - r.top  - r.height / 2;

    var t0 = null;
    /*
     * ph1 (0–1800ms) : muter 1 lingkaran penuh, pelan & smooth
     * ph2 (1800–2600ms): gerak ke tengah + rotateY 0→90°
     * ph3 (2600–3200ms): zoom nutup layar
     */
    var ph1=1800, ph2=800, ph3=600, total=ph1+ph2+ph3;

    var diag = Math.sqrt(cx*cx + cy*cy);
    var R    = diag * .50;

    /* Ease lebih smooth — cubic ease in-out */
    function ease(t){ return t<.5 ? 4*t*t*t : 1-Math.pow(-2*t+2,3)/2; }

    function tick(ts) {
        if (!t0) t0 = ts;
        var el = ts - t0;
        var p  = Math.min(el/total, 1);

        if (el < ph1) {
            var t   = el/ph1;
            var et  = ease(t);
            var ang = et * Math.PI * 2 - Math.PI/2;
            var amp = Math.sin(t * Math.PI); /* radius membesar lalu mengecil */
            var dx  = Math.cos(ang) * R * amp;
            var dy  = Math.sin(ang) * R * amp * .60;
            var sx  = Math.cos(ang) >= 0 ? 1 : -1;
            bird.style.transform = 'translate('+dx+'px,'+dy+'px) scaleX('+sx+')';

        } else if (el < ph1+ph2) {
            var t2  = ease((el-ph1)/ph2);
            var dx2 = tx0 * t2;
            var dy2 = ty0 * t2;
            var ry  = t2 * 90;
            bird.style.transform = 'translate('+dx2+'px,'+dy2+'px) rotateY('+ry+'deg)';

        } else {
            var t3  = ease((el-ph1-ph2)/ph3);
            var sc  = 1 + t3 * 40;
            bird.style.transform = 'translate('+tx0+'px,'+ty0+'px) scale('+sc+') rotateY(90deg)';
        }

        if (p < 1) requestAnimationFrame(tick);
        else doTvOff();
    }
    requestAnimationFrame(tick);
}

/* ── TV mati → login (dipercepat, total ~900ms) ── */
function doTvOff() {
    var tv=document.getElementById('tvOverlay'),dot=document.getElementById('tvDot'),sc=document.getElementById('sceneLayer');
    if(!tv||!dot||!sc) return;
    tv.style.display='flex'; tv.style.opacity='0';
    setTimeout(function(){tv.style.transition='opacity .4s ease';tv.style.opacity='1';},20);
    setTimeout(function(){sc.style.transition='clip-path .3s cubic-bezier(.4,0,.2,1)';sc.style.clipPath='inset(49.5% 0 49.5% 0)';},450);
    setTimeout(function(){sc.style.clipPath='inset(50% 47% 50% 47%)';},780);
    setTimeout(function(){dot.style.transition='opacity .15s';dot.style.opacity='1';},860);
    setTimeout(function(){dot.style.width='1px';dot.style.height='1px';dot.style.opacity='0';},1000);
    setTimeout(function(){
        tv.style.opacity='0'; sc.style.clipPath='none'; sc.style.display='none';
        var wrap=document.getElementById('loginWrap'),card=document.getElementById('loginCard');
        if(!wrap||!card) return;
        wrap.style.display='flex';
        setTimeout(function(){card.classList.add('show');},30);
    },1100);
}

/* ── Burung kanan — muter ── */
function birdRightClick() {
    if (birdRBusy) return;
    birdRBusy = true;
    var bird=document.getElementById('birdRight');
    bird.style.animation='none';
    var diag=Math.sqrt(Math.pow(window.innerWidth,2)+Math.pow(window.innerHeight,2));
    var R=diag/2.3, t0=null, dur=3200;
    function ease(t){return t<.5?2*t*t:-1+(4-2*t)*t;}
    function tick(ts){
        if(!t0)t0=ts;
        var p=Math.min((ts-t0)/dur,1),ep=ease(p);
        var ang=ep*Math.PI*2-Math.PI/2,amp=Math.sin(p*Math.PI);
        bird.style.transform='translate('+(Math.cos(ang)*R*amp)+'px,'+(Math.sin(ang)*R*amp*.65)+'px) scaleX('+(Math.cos(ang)>0?-1:1)+')';
        if(p<1) requestAnimationFrame(tick);
        else {
            bird.style.transition='transform .45s ease'; bird.style.transform='scaleX(-1)';
            setTimeout(function(){bird.style.transition='';bird.style.animation='headbob 3.2s ease-in-out infinite';birdRBusy=false;},460);
        }
    }
    requestAnimationFrame(tick);
}

window.addEventListener('resize', function(){
    if(document.getElementById('sceneLayer').style.display!=='none') layoutScene();
});

/* Expose ke global agar bisa dipanggil dari HTML attribute */
window.checkCode      = checkCode;
window.birdLeftClick  = birdLeftClick;
window.birdRightClick = birdRightClick;

})();
</script>