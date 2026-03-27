

<?php $__env->startSection('content'); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Outfit:wght@300;400;500;600;700&display=swap');

:root {
    --gold:        #c5a059;
    --gold-light:  #d4af6a;
    --gold-pale:   rgba(197,160,89,0.15);
    --gold-border: rgba(197,160,89,0.25);
    --dark:        #0a0f0a;
    --dark-green:  #0f2a1f;
    --mid-green:   #1a3d2a;
    --muted:       rgba(200,210,200,0.65);
}
.ca-wrap  { font-family:'Outfit',sans-serif; background:var(--dark); color:#fff; overflow-x:hidden; }
.ca-serif { font-family:'Cormorant Garamond',serif; }


.sr { opacity:0; transform:translateY(44px); transition:opacity .75s ease,transform .75s ease; }
.sr.visible { opacity:1; transform:none; }
.sr-d1{transition-delay:.1s} .sr-d2{transition-delay:.2s}
.sr-d3{transition-delay:.3s} .sr-d4{transition-delay:.4s}

.gold-tag {
    display:inline-flex;align-items:center;gap:12px;
    font-size:10px;letter-spacing:.4em;text-transform:uppercase;color:var(--gold);
}
.gold-tag::before,.gold-tag::after{content:'';width:28px;height:1px;background:var(--gold);}
.ca-hero{position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;background:var(--dark-green);}
.ca-hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 70% 40%,rgba(197,160,89,.15) 0%,transparent 60%),radial-gradient(ellipse 60% 50% at 20% 80%,rgba(15,42,31,.6) 0%,transparent 60%),linear-gradient(135deg,#0d2018 0%,#1a3d2a 55%,#122b1c 100%);}
.ca-hero-grid{position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(rgba(197,160,89,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(197,160,89,.04) 1px,transparent 1px);background-size:60px 60px;}
.ca-hero-orb{position:absolute;border-radius:50%;filter:blur(80px);pointer-events:none;}
.ca-hero-orb-1{width:500px;height:500px;background:rgba(197,160,89,.07);top:-100px;right:-100px;animation:orbFloat 8s ease-in-out infinite;}
.ca-hero-orb-2{width:300px;height:300px;background:rgba(15,42,31,.8);bottom:0;left:0;animation:orbFloat 10s ease-in-out infinite reverse;}
@keyframes orbFloat{0%,100%{transform:translate(0,0)}50%{transform:translate(20px,-30px)}}
.ca-hero-content{
    position:relative;z-index:10;
    text-align:center;
    padding:2rem;
    max-width:820px;
    width:100%;
    margin:0 auto;
}
.ca-hero-title{
    font-family:'Cormorant Garamond',serif;
    font-size:clamp(3rem,6vw,5.5rem);
    line-height:1.1;
    margin-bottom:.5rem;
    animation:fadeUp .8s .1s ease both;
}
.ca-hero-title .ln1{
    display:block;
    color:var(--gold);
    font-weight:600;
    font-style:normal;
}
.ca-hero-title .ln2{
    display:block;
    color:#fff;
    font-style:italic;
    font-weight:500;
}
.ca-hero-divider{
    width:60px;height:2px;
    background:var(--gold);
    margin:.9rem auto 1.6rem;
    animation:fadeUp .8s .3s ease both;
}
.ca-pills{display:flex;flex-wrap:wrap;justify-content:center;gap:10px;margin-bottom:2.5rem;animation:fadeUp .8s .5s ease both;}
.ca-pill{padding:7px 18px;border:1px solid var(--gold-border);border-radius:100px;font-size:11px;color:var(--gold);letter-spacing:.1em;text-transform:uppercase;background:rgba(197,160,89,.05);transition:all .3s;}
.ca-pill:hover{background:var(--gold);color:#000;border-color:var(--gold);}
.ca-cta{display:flex;flex-wrap:wrap;justify-content:center;gap:16px;animation:fadeUp .8s .6s ease both;}
.ca-btn-primary{display:inline-flex;align-items:center;gap:10px;background:var(--gold);color:#000;padding:14px 32px;font-size:11px;font-weight:700;letter-spacing:.22em;text-transform:uppercase;border-radius:10px;text-decoration:none;position:relative;overflow:hidden;transition:all .3s;}
.ca-btn-primary::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,transparent 30%,rgba(255,255,255,.2) 50%,transparent 70%);transform:translateX(-100%);transition:transform .5s;}
.ca-btn-primary:hover::before{transform:translateX(100%);}
.ca-btn-primary:hover{background:var(--gold-light);transform:translateY(-2px);box-shadow:0 8px 30px rgba(197,160,89,.35);}

.ca-hero-tagline{
    font-size:clamp(.75rem,1.4vw,.9rem);
    color:rgba(200,210,200,.7);
    letter-spacing:.3em;
    text-transform:uppercase;
    margin-bottom:2rem;
    animation:fadeUp .8s .4s ease both;
}

.ca-scroll{position:absolute;bottom:38px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:8px;z-index:10;animation:fadeUp 1s 1s ease both;text-decoration:none;cursor:pointer;}
.ca-scroll span{font-size:9px;letter-spacing:.3em;color:var(--gold);text-transform:uppercase;transition:opacity .3s;}
.ca-scroll:hover span{opacity:.7;}
.ca-scroll-line{width:1px;height:50px;background:linear-gradient(to bottom,var(--gold),transparent);animation:scrollPulse 2s ease-in-out infinite;}
@keyframes scrollPulse{0%,100%{opacity:.4;transform:scaleY(1)}50%{opacity:1;transform:scaleY(1.1)}}
@keyframes fadeUp{from{opacity:0;transform:translateY(32px)}to{opacity:1;transform:none}}

.ca-section{padding:100px 2rem;}
.ca-container{max-width:1280px;margin:0 auto;}
.ca-sec-hd{text-align:center;margin-bottom:70px;}
.ca-sec-title{font-size:clamp(2.5rem,5vw,4rem);line-height:1.1;margin-bottom:18px;}
.ca-sec-sub{font-size:1rem;color:var(--muted);max-width:600px;margin:0 auto;line-height:1.85;}

.ca-zones{background:#fff6e5;}
.ca-sec-title{color:#0f2a1f;}
.ca-zones .gold-tag{color:#c5a059;}
.ca-zones .ca-sec-sub{color:#4a6355;}
.ca-zones-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
.ca-zones-grid .z-featured{grid-column:span 2;}
.z-card{
    position:relative;overflow:hidden;
    min-height:auto;
    display:flex;flex-direction:column;justify-content:flex-start;
    padding:32px;cursor:default;
    background:#1a3d2a;
    border:1px solid rgba(197,160,89,0.15);
    border-radius:16px;
    transition:border-color .3s,box-shadow .3s;
}
.z-card:hover{border-color:rgba(197,160,89,0.45);box-shadow:0 12px 40px rgba(0,0,0,.15);}
.z-card::before{display:none;}
.z-shimmer{display:none;}
.z-bg{display:none;}
.z-num{display:none;}
.z-content{position:relative;z-index:1;}
.z-icon{width:48px;height:48px;border:1px solid rgba(197,160,89,0.25);border-radius:12px;display:flex;align-items:center;justify-content:center;background:rgba(197,160,89,.1);margin-bottom:16px;}
.z-icon svg{width:22px;height:22px;color:var(--gold);}
.z-label{font-size:10px;letter-spacing:.3em;text-transform:uppercase;color:var(--gold);margin-bottom:8px;}
.z-title{font-family:'Cormorant Garamond',serif;font-size:clamp(1.3rem,2vw,1.8rem);font-weight:400;margin-bottom:12px;line-height:1.2;color:#fff;}
.z-desc{font-size:13px;color:rgba(200,220,210,.75);line-height:1.75;margin-bottom:12px;}
.z-tags{display:flex;flex-wrap:wrap;gap:8px;margin-top:8px;}
.z-tag{padding:4px 12px;border:1px solid rgba(197,160,89,0.25);border-radius:100px;font-size:10px;color:var(--gold);letter-spacing:.1em;background:rgba(197,160,89,.06);}

.ca-revenue{background:var(--dark);}
.ca-rev-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:24px;}
.rev-card{border:1px solid var(--gold-border);border-radius:18px;padding:38px;background:rgba(10,15,10,.6);position:relative;overflow:hidden;transition:all .4s;}
.rev-card::after{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:linear-gradient(to right,transparent,var(--gold),transparent);opacity:0;transition:opacity .4s;}
.rev-card:hover{background:rgba(26,61,42,.6);border-color:rgba(197,160,89,.5);transform:translateY(-5px);box-shadow:0 20px 50px rgba(0,0,0,.35);}
.rev-card:hover::after{opacity:1;}
.rev-num{font-family:'Cormorant Garamond',serif;font-size:3.5rem;color:rgba(197,160,89,.13);line-height:1;margin-bottom:8px;font-weight:300;}
.rev-title{font-size:16px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fff;margin-bottom:18px;}
.rev-badge{display:inline-block;color:var(--gold);font-size:9px;letter-spacing:.12em;border:1px solid var(--gold-border);padding:2px 8px;border-radius:100px;margin-left:8px;vertical-align:middle;}
.rev-list{list-style:none;padding:0;margin:0;}
.rev-list li{display:flex;align-items:flex-start;gap:10px;font-size:13px;color:var(--muted);padding:7px 0;border-bottom:1px solid rgba(197,160,89,.07);line-height:1.55;}
.rev-list li:last-child{border-bottom:none;}
.rev-list li::before{content:'→';color:var(--gold);flex-shrink:0;margin-top:1px;}

.ca-market{background:var(--dark-green);}
.ca-mkt-grid{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;}
.ca-mkt-group-title{font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--gold);margin-bottom:24px;display:flex;align-items:center;gap:16px;}
.ca-mkt-group-title::after{content:'';flex:1;height:1px;background:var(--gold-border);}
.mkt-item{display:flex;align-items:center;gap:16px;padding:16px 20px;border:1px solid transparent;border-radius:12px;margin-bottom:12px;transition:all .3s;cursor:default;position:relative;}
.mkt-item::before{content:'';position:absolute;left:0;top:10%;bottom:10%;width:2px;background:rgba(197,160,89,.25);border-radius:2px;transition:background .3s;}
.mkt-item:hover{border-color:var(--gold-border);background:rgba(197,160,89,.04);}
.mkt-item:hover::before{background:var(--gold);}
.mkt-icon{width:44px;height:44px;border-radius:10px;background:var(--gold-pale);border:1px solid var(--gold-border);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .3s;}
.mkt-item:hover .mkt-icon{background:var(--gold);border-color:var(--gold);}
.mkt-item:hover .mkt-icon svg{color:#000;}
.mkt-icon svg{width:20px;height:20px;color:var(--gold);transition:color .3s;}
.mkt-name{font-size:14px;font-weight:600;}
.mkt-sub{font-size:11px;color:var(--muted);margin-top:3px;letter-spacing:.05em;}

.ca-adv{background:var(--dark);}
.ca-adv-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;}
.adv-card{padding:38px 28px;border:1px solid var(--gold-border);border-radius:18px;background:linear-gradient(135deg,rgba(197,160,89,.03) 0%,transparent 100%);text-align:center;transition:all .4s;position:relative;overflow:hidden;}
.adv-card::before{content:'';position:absolute;bottom:0;left:0;right:0;height:0;background:linear-gradient(to top,rgba(197,160,89,.06),transparent);transition:height .4s;}
.adv-card:hover::before{height:100%;}
.adv-card:hover{border-color:rgba(197,160,89,.55);transform:translateY(-6px);box-shadow:0 22px 60px rgba(0,0,0,.4);}
.adv-icon{width:60px;height:60px;border-radius:16px;background:var(--gold-pale);border:1px solid var(--gold-border);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;transition:all .3s;}
.adv-card:hover .adv-icon{background:var(--gold);border-color:var(--gold);}
.adv-card:hover .adv-icon svg{color:#000;}
.adv-icon svg{width:28px;height:28px;color:var(--gold);transition:color .3s;}
.adv-title{font-size:12px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;margin-bottom:12px;}
.adv-desc{font-size:12px;color:var(--muted);line-height:1.75;}

.ca-design{background:var(--dark-green);}
.ca-design-inner{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;}
.ca-palette{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:30px;}
.ca-color{aspect-ratio:1;border-radius:12px;display:flex;flex-direction:column;align-items:center;justify-content:flex-end;padding:10px 8px;font-size:9px;letter-spacing:.15em;text-transform:uppercase;font-weight:700;}
.ca-kws{display:flex;flex-wrap:wrap;gap:10px;margin-top:26px;}
.ca-kw{padding:7px 18px;border:1px solid var(--gold-border);border-radius:100px;font-size:11px;color:var(--gold);letter-spacing:.1em;transition:all .3s;}
.ca-kw:hover{background:var(--gold);color:#000;}
.ca-mockup-wrap{position:relative;height:500px;border-radius:20px;overflow:hidden;}
.ca-mockup{width:100%;height:100%;background:linear-gradient(135deg,#0a0f0a 0%,#1a2a15 50%,#0a0f0a 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:22px;padding:40px;}
.ca-mockup-lights{display:flex;gap:20px;}
.ca-mlight{width:8px;height:8px;border-radius:50%;animation:lPulse 2s ease-in-out infinite;}
.ca-mlight:nth-child(1){background:var(--gold);animation-delay:0s}
.ca-mlight:nth-child(2){background:#fff;animation-delay:.5s}
.ca-mlight:nth-child(3){background:rgba(197,160,89,.5);animation-delay:1s}
@keyframes lPulse{0%,100%{opacity:.4;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
.ca-mockup-stage{width:100%;max-width:280px;height:160px;border:1px solid rgba(197,160,89,.3);border-radius:10px;background:rgba(197,160,89,.03);display:flex;align-items:center;justify-content:center;}
.ca-mockup-stage-lbl{font-family:'Cormorant Garamond',serif;font-size:1.8rem;color:rgba(197,160,89,.4);letter-spacing:.2em;text-transform:uppercase;}
.ca-mockup-dots{display:flex;gap:8px;}
.ca-mdot{width:40px;height:4px;border-radius:2px;background:rgba(197,160,89,.2);}
.ca-mdot.active{background:var(--gold);}
.ca-mockup-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;width:100%;max-width:280px;}
.ca-mockup-cell{height:60px;border:1px solid rgba(197,160,89,.2);border-radius:8px;background:rgba(197,160,89,.03);display:flex;align-items:center;justify-content:center;}
.ca-mockup-cell span{font-size:9px;color:rgba(197,160,89,.4);letter-spacing:.2em;text-transform:uppercase;}

.ca-branding{background:var(--dark);}
.ca-brand-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
.brand-card{background:rgba(10,15,10,.7);border:1px solid var(--gold-border);border-radius:18px;padding:38px;transition:all .4s;position:relative;overflow:hidden;}
.brand-card::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,transparent 30%,rgba(197,160,89,.05) 50%,transparent 70%);transform:translateX(-100%);transition:transform .5s;pointer-events:none;}
.brand-card:hover::after{transform:translateX(100%);}
.brand-card:hover{background:var(--mid-green);border-color:rgba(197,160,89,.55);transform:translateY(-5px);box-shadow:0 20px 50px rgba(0,0,0,.3);}
.brand-icon{width:52px;height:52px;border-radius:14px;background:var(--gold-pale);border:1px solid var(--gold-border);display:flex;align-items:center;justify-content:center;margin-bottom:20px;transition:all .3s;}
.brand-card:hover .brand-icon{background:var(--gold);border-color:var(--gold);}
.brand-card:hover .brand-icon svg{color:#000;}
.brand-icon svg{width:24px;height:24px;color:var(--gold);transition:color .3s;}
.brand-title{font-size:14px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;margin-bottom:18px;}
.brand-list{list-style:none;padding:0;margin:0;}
.brand-list li{font-size:13px;color:var(--muted);padding:7px 0;border-bottom:1px solid rgba(197,160,89,.07);display:flex;align-items:center;gap:10px;}
.brand-list li:last-child{border-bottom:none;}
.brand-list li::before{content:'✦';color:var(--gold);font-size:8px;flex-shrink:0;}

.ca-cta-sec{background:var(--dark-green);position:relative;overflow:hidden;padding:120px 2rem;text-align:center;}
.ca-cta-sec-bg{position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 50% 50%,rgba(197,160,89,.07) 0%,transparent 70%),linear-gradient(to bottom,var(--dark-green),#0a1a10);}
.ca-cta-content{position:relative;z-index:1;}
.ca-cta-title{font-size:clamp(2.5rem,6vw,5rem);line-height:1.1;margin-bottom:24px;}
.ca-cta-sub{font-size:1rem;color:var(--muted);margin-bottom:40px;line-height:1.85;}
.ca-cta-divider{width:60px;height:2px;background:var(--gold);margin:0 auto 40px;}

@media(max-width:1024px){
    .ca-zones-grid{grid-template-columns:1fr 1fr}
    .ca-zones-grid .z-featured{grid-column:span 2}
    .ca-adv-grid{grid-template-columns:repeat(2,1fr)}
    .ca-design-inner{grid-template-columns:1fr}
    .ca-mockup-wrap{height:360px}
}
@media(max-width:768px){
    .ca-section{padding:70px 1.5rem}
    .ca-zones-grid,.ca-rev-grid,.ca-mkt-grid,.ca-brand-grid{grid-template-columns:1fr}
    .ca-zones-grid .z-featured{grid-column:span 1}
    .ca-adv-grid{grid-template-columns:1fr 1fr}
    .z-card{min-height:310px}
}
@media(max-width:480px){
    .ca-adv-grid{grid-template-columns:1fr}
}
</style>

<div class="ca-wrap">


<section class="ca-hero">
    <div class="ca-hero-bg"></div>
    <div class="ca-hero-grid"></div>
    <div class="ca-hero-orb ca-hero-orb-1"></div>
    <div class="ca-hero-orb ca-hero-orb-2"></div>
    <div class="ca-hero-content">
        <h1 class="ca-hero-title ca-serif">
            <span class="ln1">Bale Hinggil</span>
            <span class="ln2">Commercial Area</span>
        </h1>
        <div class="ca-hero-divider"></div>
        <p class="ca-hero-tagline">One Space, Unlimited Possibilities</p>
        <div class="ca-pills">
            <span class="ca-pill">Business</span>
            <span class="ca-pill">Education</span>
            <span class="ca-pill">Creative</span>
            <span class="ca-pill">Event</span>
        </div>
    </div>
    <a href="#zoning" class="ca-scroll"><span>Scroll</span><div class="ca-scroll-line"></div></a>
</section>


<section id="zoning" class="ca-section ca-zones">
    <div class="ca-container">
        <div class="ca-sec-hd sr">
            <div class="gold-tag" style="margin-bottom:16px;">Zoning Area</div>
            <h2 class="ca-sec-title ca-serif"><span style="color:#0f2a1f;">Pembagian</span><span style="color:var(--gold);font-style:italic;"> Ruang</span></h2>
            <p class="ca-sec-sub" style="color:#4a6355;">Lima zona premium yang dirancang untuk memaksimalkan fleksibilitas dan pengalaman pengguna di setiap sesi.</p>
        </div>
        <div class="ca-zones-grid">

            <div class="z-card z-featured sr">
                <div class="z-content">
                    <div class="z-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg></div>
                    <div class="z-label">Zone 01</div>
                    <h3 class="z-title ca-serif">Grand Ballroom <small style="font-size:.6em;opacity:.7;">— Main Hall</small></h3>
                    <p class="z-desc">Kapasitas 200–500 pax dengan partisi fleksibel. LED Videotron besar, sound system premium, lighting concert style, panggung modular, dan AC central luxury. Ballroom serbaguna paling fleksibel di Surabaya Timur.</p>
                    <div class="z-tags"><span class="z-tag">Graduation</span><span class="z-tag">Wedding</span><span class="z-tag">Seminar</span><span class="z-tag">Mini Konser</span><span class="z-tag">Community</span></div>
                </div>
            </div>

            <div class="z-card sr sr-d1">
                <div class="z-content">
                    <div class="z-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" /></svg></div>
                    <div class="z-label">Zone 02</div>
                    <h3 class="z-title ca-serif">Executive<br>Meeting Room</h3>
                    <p class="z-desc">Smart TV, Zoom ready, whiteboard digital, coffee & snack station. Ideal untuk corporate meeting, presentasi bisnis, training, dan interview profesional.</p>
                    <div class="z-tags"><span class="z-tag">Corporate</span><span class="z-tag">Training</span><span class="z-tag">Interview</span></div>
                </div>
            </div>

            <div class="z-card sr sr-d2">
                <div class="z-content">
                    <div class="z-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" /></svg></div>
                    <div class="z-label">Zone 03</div>
                    <h3 class="z-title ca-serif">Content Creator<br>Studio</h3>
                    <p class="z-desc">Konten siap produksi tanpa ribet setup. Studio Podcast, TikTok Live (vertical setup), mini green screen. Lighting profesional, mic condenser, internet dedicated high speed.</p>
                    <div class="z-tags"><span class="z-tag">Podcast</span><span class="z-tag">TikTok Live</span><span class="z-tag">YouTube</span></div>
                </div>
            </div>

            <div class="z-card sr sr-d1">
                <div class="z-content">
                    <div class="z-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" /></svg></div>
                    <div class="z-label">Zone 04</div>
                    <h3 class="z-title ca-serif">Multi Purpose<br>Creative Room</h3>
                    <p class="z-desc">Background tematik rotasi, properti foto, natural + artificial light. Photoshoot prewed, maternity, produk, workshop kreatif, dan private event kecil.</p>
                    <div class="z-tags"><span class="z-tag">Photoshoot</span><span class="z-tag">Workshop</span><span class="z-tag">Private Event</span></div>
                </div>
            </div>

            <div class="z-card sr sr-d2">
                <div class="z-content">
                    <div class="z-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg></div>
                    <div class="z-label">Zone 05</div>
                    <h3 class="z-title ca-serif">Lounge &amp;<br>Networking Area</h3>
                    <p class="z-desc">Semi café, instagramable corner, mini coffee meeting. Santai sebelum/setelah event. Bisa disewakan untuk brand activation komunitas.</p>
                    <div class="z-tags"><span class="z-tag">Networking</span><span class="z-tag">Brand Activation</span></div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="ca-section ca-revenue">
    <div class="ca-container">
        <div class="ca-sec-hd sr">
            <div class="gold-tag" style="margin-bottom:16px;">Model Bisnis</div>
            <h2 class="ca-sec-title ca-serif"><span style="color:#fff;">Revenue</span><span style="color:var(--gold);font-style:italic;"> Streams</span></h2>
            <p class="ca-sec-sub">Empat aliran pendapatan yang saling melengkapi untuk memaksimalkan potensi bisnis.</p>
        </div>
        <div class="ca-rev-grid">
            <div class="rev-card sr"><div class="rev-num">01</div><div class="rev-title">Sewa Ruangan</div><ul class="rev-list"><li>Ballroom — per event / per jam</li><li>Meeting Room — per jam</li><li>Studio — per jam / paket</li></ul></div>
            <div class="rev-card sr sr-d1"><div class="rev-num">02</div><div class="rev-title">Paket Bundling</div><ul class="rev-list"><li>Graduation Package</li><li>Content Creator Package</li><li>Wedding / Engagement Package</li><li>Corporate Package</li></ul></div>
            <div class="rev-card sr sr-d2"><div class="rev-num">03</div><div class="rev-title">Add-On Services <span class="rev-badge">HIGH PROFIT</span></div><ul class="rev-list"><li>WO / EO Internal Team Balehinggil</li><li>Catering</li><li>Dekorasi</li><li>Foto &amp; Video</li><li>Live Streaming</li></ul></div>
            <div class="rev-card sr sr-d3"><div class="rev-num">04</div><div class="rev-title">Membership / Subscription</div><ul class="rev-list"><li>Creator Membership Bulanan</li><li>Corporate Meeting Package Bulanan</li></ul></div>
        </div>
    </div>
</section>


<section class="ca-section ca-market">
    <div class="ca-container">
        <div class="ca-sec-hd sr">
            <div class="gold-tag" style="margin-bottom:16px;">Target Market</div>
            <h2 class="ca-sec-title ca-serif"><span style="color:#fff;">Siapa</span><span style="color:var(--gold);font-style:italic;"> Pelanggan Kami?</span></h2>
        </div>
        <div class="ca-mkt-grid">
            <div class="sr">
                <div class="ca-mkt-group-title ca-serif">Internal</div>
                <div class="mkt-item">
                    <div class="mkt-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" /></svg></div>
                    <div><div class="mkt-name">Penghuni Apartemen</div><div class="mkt-sub">Kemudahan akses fasilitas premium</div></div>
                </div>
                <div class="mkt-item">
                    <div class="mkt-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614" /></svg></div>
                    <div><div class="mkt-name">Tenant Bisnis</div><div class="mkt-sub">Ekosistem bisnis terintegrasi</div></div>
                </div>
            </div>
            <div class="sr sr-d2">
                <div class="ca-mkt-group-title ca-serif">External</div>
                <?php $exts=[['Sekolah & Kampus','Wisuda & acara akademik'],['UMKM & Brand Lokal','Ruang presentasi & branding'],['Content Creator','Studio konten profesional'],['Komunitas','Gathering & event berkala'],['Perusahaan / Corporate','Meeting & training rutin']]; ?>
                <?php $__currentLoopData = $exts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ext): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mkt-item">
                    <div class="mkt-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg></div>
                    <div><div class="mkt-name"><?php echo e($ext[0]); ?></div><div class="mkt-sub"><?php echo e($ext[1]); ?></div></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<section class="ca-section ca-adv">
    <div class="ca-container">
        <div class="ca-sec-hd sr">
            <div class="gold-tag" style="margin-bottom:16px;">Keunggulan Kompetitif</div>
            <h2 class="ca-sec-title ca-serif"><span style="color:#fff;">Mengapa Memilih</span><span style="color:var(--gold);font-style:italic;"> Balehinggil Hub?</span></h2>
        </div>
        <div class="ca-adv-grid">
            <?php
            $advs=[
                ['All-In-One Space','Shooting, meeting, event, penginapan — semua dalam satu lokasi tanpa perlu berpindah tempat.','<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />'],
                ['Hybrid Offline + Online','Event bisa live streaming sekaligus. Studio konten tersedia untuk setiap kebutuhan digital.','<path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />'],
                ['Repeat Business Tinggi','Creator datang rutin, corporate meeting rutin, event komunitas berkala — pendapatan stabil dan berkelanjutan.','<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />'],
                ['Lokasi Apartemen','Praktis untuk tamu yang datang dari jauh. Bisa bundling langsung dengan sewa unit hunian.','<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />'],
            ];
            ?>
            <?php $__currentLoopData = $advs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="adv-card sr sr-d<?php echo e($i+1); ?>">
                <div class="adv-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><?php echo $a[2]; ?></svg></div>
                <div class="adv-title"><?php echo e($a[0]); ?></div>
                <div class="adv-desc"><?php echo e($a[1]); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="ca-section ca-design">
    <div class="ca-container">
        <div class="ca-design-inner">
            <div class="sr">
                <div class="gold-tag" style="justify-content:flex-start;margin-bottom:18px;">Konsep Desain Interior</div>
                <h2 class="ca-sec-title ca-serif" style="text-align:left;"><span style="color:#fff;display:block;">Modern Luxury</span><span style="color:var(--gold);font-style:italic;display:block;">+ Creative Industrial</span></h2>
                <p style="color:var(--muted);line-height:1.85;margin-bottom:28px;font-size:.95rem;">Desain interior yang memadukan kemewahan modern dengan sentuhan industrial kreatif — menciptakan atmosfer premium yang mendorong produktivitas dan inspirasi.</p>
                <div class="ca-palette">
                    <div class="ca-color" style="background:#0a0f0a;border:1px solid rgba(197,160,89,.2);color:rgba(197,160,89,.6);">Hitam</div>
                    <div class="ca-color" style="background:#c5a059;color:#000;">Gold</div>
                    <div class="ca-color" style="background:#f5f5f0;color:#0a0f0a;">Putih</div>
                    <div class="ca-color" style="background:#5a5a5a;border:1px solid rgba(197,160,89,.2);color:rgba(197,160,89,.6);">Abu</div>
                </div>
                <div class="ca-kws">
                    <span class="ca-kw">Dramatic Lighting</span>
                    <span class="ca-kw">RGB Accent</span>
                    <span class="ca-kw">Instagramable</span>
                    <span class="ca-kw">Clean Premium</span>
                    <span class="ca-kw">Warm + Gold</span>
                </div>
            </div>
            <div class="ca-mockup-wrap sr sr-d2">
                <div class="ca-mockup">
                    <div class="ca-mockup-lights"><div class="ca-mlight"></div><div class="ca-mlight"></div><div class="ca-mlight"></div></div>
                    <div class="ca-mockup-stage"><span class="ca-mockup-stage-lbl">Stage</span></div>
                    <p style="font-size:10px;color:rgba(197,160,89,.4);letter-spacing:.3em;text-transform:uppercase;">Grand Ballroom</p>
                    <div class="ca-mockup-dots"><div class="ca-mdot active"></div><div class="ca-mdot active"></div><div class="ca-mdot"></div><div class="ca-mdot"></div></div>
                    <div class="ca-mockup-grid">
                        <div class="ca-mockup-cell"><span>Studio</span></div>
                        <div class="ca-mockup-cell"><span>Meeting</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="ca-section ca-branding">
    <div class="ca-container">
        <div class="ca-sec-hd sr">
            <div class="gold-tag" style="margin-bottom:16px;">Marketing</div>
            <h2 class="ca-sec-title ca-serif"><span style="color:#fff;">Ide Branding</span><span style="color:var(--gold);font-style:italic;"> &amp; Marketing</span></h2>
        </div>
        <div class="ca-brand-grid">
            <?php
            $brands=[
                ['Konten Harian','"1 Hari di Balehinggil Hub"','Behind the scene podcast','Event highlight reels','Teaser zona premium'],
                ['Kolaborasi Strategis','Influencer Surabaya','Komunitas kreator lokal','Kampus & institusi pendidikan','Brand lokal Surabaya'],
                ['Program Viral','FREE 1 jam studio (first user)','Event TikTok Live bareng creator','Referral program member','Graduation challenge konten'],
            ];
            $brandIcons=['<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />','<path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />','<path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84" />'];
            ?>
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="brand-card sr sr-d<?php echo e($i+1); ?>">
                <div class="brand-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><?php echo $brandIcons[$i]; ?></svg></div>
                <div class="brand-title"><?php echo e($b[0]); ?></div>
                <ul class="brand-list">
                    <?php $__currentLoopData = array_slice($b,1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($item); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section id="kontak" class="ca-cta-sec">
    <div class="ca-cta-sec-bg"></div>
    <div class="ca-cta-content sr">
        <div class="gold-tag" style="justify-content:center;margin-bottom:24px;">Reservasi</div>
        <h2 class="ca-cta-title ca-serif">
            <span style="color:#fff;display:block;">Wujudkan Event</span>
            <span style="color:var(--gold);font-style:italic;display:block;">Impian Anda</span>
        </h2>
        <div class="ca-cta-divider"></div>
        <p class="ca-cta-sub" style="max-width:520px;margin:0 auto 40px;">Hubungi tim kami untuk konsultasi, penawaran paket, dan reservasi ruangan. Kami siap mewujudkan setiap acara Anda menjadi pengalaman tak terlupakan.</p>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:16px;">
            <?php $waNum=preg_replace('/[^0-9]/','',($setting->whatsapp_number??'6282334466773')); ?>
            <a href="https://wa.me/<?php echo e($waNum); ?>" target="_blank" class="ca-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" /></svg>
                Hubungi via WhatsApp
            </a>
            <a href="<?php echo e(route('home')); ?>#kontak" class="ca-btn-outline" style="display:inline-flex;align-items:center;gap:10px;border:2px solid var(--gold-border);color:var(--gold);padding:14px 36px;font-size:12px;font-weight:600;letter-spacing:.22em;text-transform:uppercase;border-radius:10px;text-decoration:none;transition:all .3s;">Kirim Pesan</a>
        </div>
    </div>
</section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.12 });
    document.querySelectorAll('.sr').forEach(el => obs.observe(el));

    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', function(e) {
            const t = document.querySelector(this.getAttribute('href'));
            if (t) { e.preventDefault(); t.scrollIntoView({ behavior:'smooth', block:'start' }); }
        });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\WebsiteBaleHinggil\resources\views/user/layananca.blade.php ENDPATH**/ ?>