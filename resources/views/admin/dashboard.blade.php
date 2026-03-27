@extends('layouts.admin.main')

@section('title', 'Dashboard')

@push('styles')
@vite(['resources/css/admin/dashboard.css'])
<style>
    .guide-body { display: none; }
</style>
@endpush

@section('content')
<div class="dash-wrap">

    <div class="dash-header">
        <div class="dash-header-left">
            <h1>Dashboard</h1>
            <p>Selamat datang kembali, Admin Bale Hinggil</p>
        </div>
        <span class="dash-header-badge">
            <i class="bi bi-circle-fill me-1" style="font-size:7px; color:#4ade80;"></i>
            {{ now()->translatedFormat('d F Y') }}
        </span>
    </div>

    <div class="stat-grid">

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Pengunjung Hari Ini</span>
                <div class="stat-icon-wrap green"><i class="bi bi-eye"></i></div>
            </div>
            <div class="stat-number">{{ number_format($visitorsToday) }}</div>
            <div class="stat-bottom">
                @if($visitorsToday == 0)
                    <span class="stat-change neu">Belum ada data</span>
                @elseif($visitorsIncrease > 0)
                    <span class="stat-change up"><i class="bi bi-arrow-up-short"></i>+{{ $visitorsIncrease }}%</span>
                    <span class="stat-period">vs kemarin</span>
                @elseif($visitorsIncrease < 0)
                    <span class="stat-change down"><i class="bi bi-arrow-down-short"></i>{{ $visitorsIncrease }}%</span>
                    <span class="stat-period">vs kemarin</span>
                @else
                    <span class="stat-change neu">Tidak ada perubahan</span>
                @endif
            </div>
        </div>

        <div class="stat-card stat-gold">
    <div class="stat-top">
        <span class="stat-label">Klik Booking Unit</span>
        <div class="stat-icon-wrap wa"><i class="bi bi-calendar-check"></i></div>
    </div>
    <div class="stat-number">{{ number_format($bookingClicks) }}</div>
    <div class="stat-bottom">
        <span class="stat-period">
            {{ $bookingClicksToday > 0 ? '+' . $bookingClicksToday . ' hari ini' : 'Total klik booking' }}
        </span>
    </div>
</div>

        <div class="stat-card stat-red">
            <div class="stat-top">
                <span class="stat-label">Pesan Masuk</span>
                <div class="stat-icon-wrap red"><i class="bi bi-envelope-heart"></i></div>
            </div>
            <div class="stat-number">{{ number_format($messagesCount) }}</div>
            <div class="stat-bottom">
                <a href="{{ route('admin.messages.index') }}" class="stat-link">
                    Lihat Inbox <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="chart-row">

        <div class="dash-card">
            <div class="dash-card-header">
                <h6 class="dash-card-title">Statistik Pengunjung</h6>
                <select class="period-select" onchange="changeChart(this.value)">
                    <option value="daily">Harian</option>
                    <option value="weekly">Mingguan</option>
                    <option value="monthly" selected>Bulanan</option>
                </select>
            </div>
            <div class="dash-card-body">
                @php $totalVisitors = array_sum($chartDataDaily['data']) + array_sum($chartDataWeekly['data']) + array_sum($chartDataMonthly['data']); @endphp
                @if($totalVisitors > 0)
                <div class="chart-scroll-wrap">
                    <div class="chart-scroll-inner">
                        <canvas id="visitorChart"></canvas>
                    </div>
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-graph-up"></i>
                    <p>Belum ada data pengunjung</p>
                </div>
                @endif
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-header">
                <h6 class="dash-card-title">Unit Terpopuler</h6>
            </div>
            <div class="dash-card-body">
                @if(array_sum($unitChartData['data']) > 0)
                <div style="position:relative; height:230px;">
                    <canvas id="unitChart"></canvas>
                </div>
                @else
                <div class="empty-state">
                    <i class="bi bi-bar-chart-line"></i>
                    <p>Belum ada data inquiry unit</p>
                </div>
                @endif
            </div>
        </div>

    </div>

    <div class="bottom-row">

        <div class="dash-card">
            <div class="dash-card-header">
                <h6 class="dash-card-title">Aktivitas Terakhir</h6>
                <a href="{{ route('admin.activities') }}" class="stat-link" style="font-size:12px;">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="dash-card-body" style="padding-top:4px; padding-bottom:4px;">
                <div class="timeline">
                    @forelse($recentActivities as $activity)
                    <div class="tl-item">
                        <div class="tl-dot"></div>
                        <div class="tl-content">
                            <div class="tl-title">{{ $activity->description }}</div>
                            <div class="tl-detail">{{ $activity->details }}</div>
                        </div>
                        <div class="tl-time">{{ $activity->created_at->diffForHumans() }}</div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Belum ada aktivitas</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="dash-card">
            <div class="dash-card-header">
                <h6 class="dash-card-title">Panduan Cepat</h6>
            </div>
            <div class="dash-card-body" style="padding-top: 12px;">

                {{-- Upload Foto & Video --}}
<div class="guide-item">
    <button class="guide-toggle" onclick="toggleGuide(this)">
        <i class="bi bi-images icon"></i>
        Upload Foto & Video
        <i class="bi bi-chevron-down chev"></i>
    </button>
    <div class="guide-body">
        <table class="spec-table">
            <thead>
                <tr>
                    <th style="font-size:10px;color:var(--muted);font-weight:600;padding-bottom:6px;">Jenis File</th>
                    <th style="font-size:10px;color:var(--muted);font-weight:600;padding-bottom:6px;">Resolusi</th>
                    <th style="font-size:10px;color:var(--muted);font-weight:600;padding-bottom:6px;">Maks</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Foto Hero</td><td>1920 × 1080px</td><td><span class="spec-badge">10 MB</span></td></tr>
                <tr><td>Foto About</td><td>800 × 800px</td><td><span class="spec-badge">10 MB</span></td></tr>
                <tr><td>Foto Fasilitas</td><td>1200 × 800px</td><td><span class="spec-badge">10 MB</span></td></tr>
                <tr><td>Foto Background Layanan</td><td>1920 × 1080px</td><td><span class="spec-badge">10 MB</span></td></tr>
                <tr><td>Thumbnail Berita</td><td>800 × 600px</td><td><span class="spec-badge">10 MB</span></td></tr>
                <tr><td>Foto Card Unit</td><td>800 × 600px</td><td><span class="spec-badge">10 MB</span></td></tr>
                <tr><td>Foto Galeri Unit</td><td>1600 × 900px</td><td><span class="spec-badge">10 MB</span></td></tr>
                <tr><td>Foto 3D / Denah Unit</td><td>1200 × 800px</td><td><span class="spec-badge">10 MB</span></td></tr>
                <tr><td>Video Hero (MP4/WebM)</td><td>1920 × 1080px</td><td><span class="spec-badge warn">50 MB</span></td></tr>
            </tbody>
        </table>
        <div class="guide-note" style="margin-top:10px;">
            <i class="bi bi-lightbulb-fill"></i>
            Kompres foto terlebih dahulu agar loading website lebih cepat.
        </div>
        <div class="guide-note" style="margin-top:6px; background:#fff7ed; border-color:#fed7aa;">
            <i class="bi bi-exclamation-triangle-fill" style="color:#f59e0b;"></i>
            Format foto yang didukung: <strong>JPG, PNG, WebP</strong>. Format video: <strong>MP4, WebM</strong>.
        </div>
    </div>
</div>

{{-- Cara Edit Konten --}}
<div class="guide-item">
    <button class="guide-toggle" onclick="toggleGuide(this)">
        <i class="bi bi-pencil-square icon"></i>
        Cara Edit Konten
        <i class="bi bi-chevron-down chev"></i>
    </button>
    <div class="guide-body">

        <p style="font-size:11px;color:var(--muted);margin-bottom:10px;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
            Halaman Utama
        </p>
        <div class="guide-step">
            <div class="guide-step-num">1</div>
            <div class="guide-step-text">
                <strong>Buka Halaman Utama di sidebar</strong>
                <span>Klik "Edit Konten" untuk masuk ke mode edit</span>
            </div>
        </div>
        <div class="guide-step">
            <div class="guide-step-num">2</div>
            <div class="guide-step-text">
                <strong>Edit di panel kiri</strong>
                <span>Klik section accordion (Hero, About, Fasilitas, dll.) lalu ubah isi field</span>
            </div>
        </div>
        <div class="guide-step">
            <div class="guide-step-num">3</div>
            <div class="guide-step-text">
                <strong>Pantau preview real-time di kanan</strong>
                <span>Perubahan teks otomatis tampil di panel preview setelah 1 detik</span>
            </div>
        </div>
        <div class="guide-step">
            <div class="guide-step-num">4</div>
            <div class="guide-step-text">
                <strong>Klik "Simpan Perubahan"</strong>
                <span>Perubahan langsung live di website pengunjung</span>
            </div>
        </div>

        <div style="border-top:1px solid #e5e7eb;margin:12px 0;"></div>

        <p style="font-size:11px;color:var(--muted);margin-bottom:10px;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
    Tipe Unit
</p>
<div class="guide-step">
    <div class="guide-step-num">1</div>
    <div class="guide-step-text">
        <strong>Buka Tipe Unit di sidebar</strong>
        <span>Klik "Edit Konten" untuk masuk ke mode edit halaman tipe unit</span>
        <br><span>Klik "Tambah Unit" untuk masuk ke mode tambah tipe unit baru</span>
    </div>
</div>
<div class="guide-step">
    <div class="guide-step-num">2</div>
    <div class="guide-step-text">
        <strong>Edit di panel kiri</strong>
        <span>Ubah atau isi field sesuai yang diinginkan</span>
    </div>
</div>
<div class="guide-step">
            <div class="guide-step-num">3</div>
            <div class="guide-step-text">
                <strong>Pantau preview real-time di kanan</strong>
                <span>Perubahan teks otomatis tampil di panel preview setelah 1 detik</span>
            </div>
        </div>
<div class="guide-step">
    <div class="guide-step-num">4</div>
    <div class="guide-step-text">
        <strong>Klik "Simpan Perubahan"</strong>
        <span>Data langsung diperbarui di halaman Tipe Unit website pengunjung</span>
    </div>
</div>

        <div style="border-top:1px solid #e5e7eb;margin:12px 0;"></div>

        <p style="font-size:11px;color:var(--muted);margin-bottom:10px;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
            Layanan
        </p>
        <div class="guide-step">
            <div class="guide-step-num">1</div>
            <div class="guide-step-text">
                <strong>Buka menu Layanan di sidebar</strong>
                <span>Pilih layanan yang ingin diedit (Working Order, Cleaning, dll.)</span>
            </div>
        </div>
        <div class="guide-step">
            <div class="guide-step-num">2</div>
            <div class="guide-step-text">
                <strong>Edit konten dan simpan</strong>
                <span>Ubah judul, deskripsi, foto, dan tombol CTA layanan</span>
            </div>
        </div>

        <div class="guide-note" style="margin-top:10px;">
            <i class="bi bi-info-circle-fill"></i>
            Jika ada perubahan yang belum tersimpan dan halaman ditutup, browser akan menampilkan peringatan otomatis.
        </div>
    </div>
</div>

{{--  Nomor WhatsApp CTA --}}
<div class="guide-item">
    <button class="guide-toggle" onclick="toggleGuide(this)">
        <i class="bi bi-whatsapp icon"></i>
        Nomor WhatsApp CTA
        <i class="bi bi-chevron-down chev"></i>
    </button>
    <div class="guide-body">
        <p style="font-size:12px; color:var(--muted); margin-bottom:10px;">
    Nomor WA yang aktif saat ini:
</p>

{{-- Nomor Humas --}}
<div style="margin-bottom:8px;">
    <div style="font-size:10px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:4px;">
        <i class="bi bi-megaphone-fill me-1" style="color:var(--forest);"></i> Humas
    </div>
    <div style="background:#e8f5ee; border-radius:8px; padding:8px 12px; font-size:13px; font-weight:700; color:var(--forest); font-family:monospace;">
        {{ $settings['whatsapp_number'] ?? $ctaNumber ?? '—' }}
    </div>
    <p style="font-size:11px; color:var(--muted); margin-top:4px; margin-bottom:0;">
        Ganti di <strong>Halaman Utama → Edit Konten → Hero Section → Tombol CTA</strong>
    </p>
</div>

{{-- Nomor Admin Resident Relation --}}
<div style="margin-bottom:12px;">
    <div style="font-size:10px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:4px;">
        <i class="bi bi-person-badge-fill me-1" style="color:var(--forest);"></i> Admin Resident Relation
    </div>
    <div style="background:#e8f5ee; border-radius:8px; padding:8px 12px; font-size:13px; font-weight:700; color:var(--forest); font-family:monospace;">
        {{$settings['whatsapp_resident'] = \App\Models\LayananWO::first()?->whatsapp_number ?? \App\Models\HomePage::first()?->working_order_wa?? '—'; }}
    </div>
    <p style="font-size:11px; color:var(--muted); margin-top:4px; margin-bottom:0;">
        Ganti di <strong>Layanan → Working Order → Edit → Nomor WhatsApp</strong>
    </p>
</div>

        <div style="border-top:1px solid #e5e7eb;margin-bottom:12px;"></div>

        <p style="font-size:11px;color:var(--muted);margin-bottom:8px;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
            Format Nomor yang Benar
        </p>
        <table class="spec-table">
            <tbody>
                <tr>
                    <td><span style="color:#ef4444;font-weight:600;">✗ Salah</span></td>
                    <td style="font-family:monospace; color:#ef4444;">+62 823-3446-6773</td>
                </tr>
                <tr>
                    <td><span style="color:#ef4444;font-weight:600;">✗ Salah</span></td>
                    <td style="font-family:monospace; color:#ef4444;">08233446773</td>
                </tr>
                <tr>
                    <td><span style="color:#16a34a;font-weight:600;">✓ Benar</span></td>
                    <td style="font-family:monospace; color:var(--forest);font-weight:700;">6282334466773</td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top:10px; background:#fffbeb; border:1px solid #fde68a; border-radius:8px; padding:10px 12px; font-size:12px; color:#92400e; line-height:1.8;">
    💡 <strong>Tips format nomor:</strong><br>
    • Format internasional <strong>tanpa tanda +</strong><br>
    • Ganti awalan <strong>0</strong> dengan <strong>62</strong><br>
    • Contoh: <span style="font-family:monospace;">0823xxxx</span> → <span style="font-family:monospace; font-weight:700;">6282xxxx</span>
</div>
    </div>
</div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    window.CHART_DATA_DAILY   = @json($chartDataDaily);
    window.CHART_DATA_WEEKLY  = @json($chartDataWeekly);
    window.CHART_DATA_MONTHLY = @json($chartDataMonthly);
    window.UNIT_CHART_DATA    = @json($unitChartData);

    function toggleGuide(btn) {
        const body = btn.nextElementSibling;
        const chev = btn.querySelector('.chev');
        const isOpen = body.style.display === 'block';
        body.style.display = isOpen ? 'none' : 'block';
        if (chev) chev.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
    }
</script>
@vite(['resources/js/admin/dashboard.js'])
@endpush