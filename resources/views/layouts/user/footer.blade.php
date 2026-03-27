<footer style="background:#0a2018;font-family:'Montserrat',sans-serif;position:relative;overflow:hidden;">

    {{-- Dekorasi background --}}
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(208,176,104,0.4),transparent);"></div>
    <div style="position:absolute;top:-120px;right:-80px;width:320px;height:320px;border-radius:50%;background:radial-gradient(circle,rgba(208,176,104,0.04) 0%,transparent 70%);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-80px;left:-60px;width:260px;height:260px;border-radius:50%;background:radial-gradient(circle,rgba(208,176,104,0.03) 0%,transparent 70%);pointer-events:none;"></div>

    {{-- Main footer content --}}
    <div style="max-width:1280px;margin:0 auto;padding:48px 24px 32px;">

        {{-- Top: 3 kolom --}}
        <div style="display:grid;grid-template-columns:1fr;gap:36px;" class="footer-grid">

            {{-- Kolom 1: Brand --}}
            <div>
                <img src="{{ asset('assets/img/logofix.png') }}" alt="Bale Hinggil" style="height:56px;width:auto;margin-bottom:16px;filter:brightness(1.3);">
                <p style="color:rgba(248,240,224,0.5);font-size:12px;line-height:1.9;max-width:280px;font-weight:400;">
                    Hunian premium di jantung Surabaya. Dirancang untuk gaya hidup modern yang nyaman, elegan, dan bernilai.
                </p>
                {{-- Social icons --}}
                <div style="display:flex;gap:8px;margin-top:20px;flex-wrap:wrap;">
                    <a href="#" style="width:34px;height:34px;border-radius:50%;background:rgba(208,176,104,0.1);border:1px solid rgba(208,176,104,0.2);display:flex;align-items:center;justify-content:center;transition:all .25s;text-decoration:none;"
                       onmouseover="this.style.background='rgba(208,176,104,0.25)';this.style.borderColor='rgba(208,176,104,0.5)';"
                       onmouseout="this.style.background='rgba(208,176,104,0.1)';this.style.borderColor='rgba(208,176,104,0.2)';">
                        <img src="{{ asset('assets/img/iconfb.png') }}" alt="Facebook" style="width:15px;height:15px;filter:brightness(10);">
                    </a>
                    <a href="#" style="width:34px;height:34px;border-radius:50%;background:rgba(208,176,104,0.1);border:1px solid rgba(208,176,104,0.2);display:flex;align-items:center;justify-content:center;transition:all .25s;text-decoration:none;"
                       onmouseover="this.style.background='rgba(208,176,104,0.25)';this.style.borderColor='rgba(208,176,104,0.5)';"
                       onmouseout="this.style.background='rgba(208,176,104,0.1)';this.style.borderColor='rgba(208,176,104,0.2)';">
                        <img src="{{ asset('assets/img/icontiktok.png') }}" alt="TikTok" style="width:15px;height:15px;filter:brightness(10);">
                    </a>
                    <a href="#" style="width:34px;height:34px;border-radius:50%;background:rgba(208,176,104,0.1);border:1px solid rgba(208,176,104,0.2);display:flex;align-items:center;justify-content:center;transition:all .25s;text-decoration:none;"
                       onmouseover="this.style.background='rgba(208,176,104,0.25)';this.style.borderColor='rgba(208,176,104,0.5)';"
                       onmouseout="this.style.background='rgba(208,176,104,0.1)';this.style.borderColor='rgba(208,176,104,0.2)';">
                        <img src="{{ asset('assets/img/iconinsta.png') }}" alt="Instagram" style="width:15px;height:15px;filter:brightness(10);">
                    </a>
                    <a href="#" style="width:34px;height:34px;border-radius:50%;background:rgba(208,176,104,0.1);border:1px solid rgba(208,176,104,0.2);display:flex;align-items:center;justify-content:center;transition:all .25s;text-decoration:none;"
                       onmouseover="this.style.background='rgba(208,176,104,0.25)';this.style.borderColor='rgba(208,176,104,0.5)';"
                       onmouseout="this.style.background='rgba(208,176,104,0.1)';this.style.borderColor='rgba(208,176,104,0.2)';">
                        <img src="{{ asset('assets/img/iconyt.png') }}" alt="YouTube" style="width:15px;height:15px;filter:brightness(10);">
                    </a>
                    <a href="#" style="width:34px;height:34px;border-radius:50%;background:rgba(208,176,104,0.1);border:1px solid rgba(208,176,104,0.2);display:flex;align-items:center;justify-content:center;transition:all .25s;text-decoration:none;"
                       onmouseover="this.style.background='rgba(208,176,104,0.25)';this.style.borderColor='rgba(208,176,104,0.5)';"
                       onmouseout="this.style.background='rgba(208,176,104,0.1)';this.style.borderColor='rgba(208,176,104,0.2)';">
                        <img src="{{ asset('assets/img/iconwa.png') }}" alt="WhatsApp" style="width:15px;height:15px;filter:brightness(10);">
                    </a>
                </div>
            </div>

            {{-- Kolom 2: Quick Links — tanpa garis --}}
            <div>
                <p style="color:rgba(208,176,104,0.7);font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;margin-bottom:18px;">Navigasi</p>
                <div style="display:flex;flex-direction:column;gap:2px;">
                    @foreach(['tipe-unit'=>'Tipe Unit','fasilitas'=>'Fasilitas','layanan'=>'Layanan','lokasi'=>'Lokasi','berita'=>'Berita','kontak'=>'Kontak'] as $url=>$label)
                    <a href="{{ in_array($url,['fasilitas','lokasi','berita','kontak','layanan']) ? url('/').'#'.$url : url('/'.$url) }}"
                       style="color:rgba(248,240,224,0.5);font-size:13px;font-weight:500;letter-spacing:0.5px;text-decoration:none;padding:6px 0;display:block;transition:color .2s;"
                       onmouseover="this.style.color='#d0b068';"
                       onmouseout="this.style.color='rgba(248,240,224,0.5)';">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Kolom 3: Kontak --}}
            <div>
                <p style="color:rgba(208,176,104,0.7);font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;margin-bottom:18px;">Kontak</p>
                <div style="display:flex;flex-direction:column;gap:14px;">
                    {{-- Alamat --}}
                    <div style="display:flex;gap:10px;align-items:flex-start;">
                        <div style="width:28px;height:28px;border-radius:8px;background:rgba(208,176,104,0.1);border:1px solid rgba(208,176,104,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="rgba(208,176,104,0.8)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p style="color:rgba(248,240,224,0.35);font-size:8px;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:3px;">Alamat</p>
                            <p style="color:rgba(248,240,224,0.6);font-size:12px;line-height:1.8;font-weight:400;">
                                Jl. Dr. Ir. H. Soekarno, Medokan Semampir Indah No.63,<br>Sukolilo, Surabaya 60119
                            </p>
                        </div>
                    </div>
                    {{-- PT --}}
                    <div style="display:flex;gap:10px;align-items:flex-start;">
                        <div style="width:28px;height:28px;border-radius:8px;background:rgba(208,176,104,0.1);border:1px solid rgba(208,176,104,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="rgba(208,176,104,0.8)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <p style="color:rgba(248,240,224,0.35);font-size:8px;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:3px;">Perusahaan</p>
                            <p style="color:rgba(248,240,224,0.6);font-size:13px;font-weight:500;">PT. Tlatah Gema Anugerah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div style="height:1px;background:linear-gradient(to right,transparent,rgba(208,176,104,0.15),transparent);margin:32px 0 20px;"></div>

        {{-- Bottom bar --}}
        <div style="display:flex;flex-direction:column;align-items:center;gap:8px;text-align:center;" class="footer-bottom">
            <p style="color:rgba(248,240,224,0.25);font-size:10px;letter-spacing:1.5px;">
                © 2026 <span style="color:rgba(208,176,104,0.5);font-weight:600;">Bale Hinggil</span> · PT. Tlatah Gema Anugerah · All rights reserved
            </p>
            <p style="color:rgba(248,240,224,0.15);font-size:9px;letter-spacing:1px;">Developed by IT Bahelinggil</p>
        </div>
    </div>
</footer>

<style>
@media (min-width: 768px) {
    .footer-grid {
        grid-template-columns: 1.4fr 1fr 1.4fr !important;
        gap: 48px !important;
    }
    .footer-bottom {
        flex-direction: row !important;
        justify-content: space-between !important;
        text-align: left !important;
    }
}
</style>