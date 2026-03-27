@extends('layouts.admin.main')

@section('title','Control Center Halaman Home')

@section('content')
@php
    $fasItems    = is_array($hp->fasilitas_items)      ? $hp->fasilitas_items      : json_decode($hp->fasilitas_items      ?? '[]', true);
    $misiItems   = is_array($hp->about_misi_items)     ? $hp->about_misi_items     : json_decode($hp->about_misi_items     ?? '[]', true);
    $aksesList   = is_array($hp->lokasi_akses_items)   ? $hp->lokasi_akses_items   : json_decode($hp->lokasi_akses_items   ?? '[]', true);
    $layananBtns = is_array($hp->layanan_buttons)      ? $hp->layanan_buttons      : json_decode($hp->layanan_buttons      ?? '[]', true);
    $jamList     = is_array($hp->kontak_jam_items)     ? $hp->kontak_jam_items     : json_decode($hp->kontak_jam_items     ?? '[]', true);
    $divisiList  = is_array($hp->kontak_divisi_items)  ? $hp->kontak_divisi_items  : json_decode($hp->kontak_divisi_items  ?? '[]', true);
    $sosmedList  = is_array($hp->kontak_sosmed_items)  ? $hp->kontak_sosmed_items  : json_decode($hp->kontak_sosmed_items  ?? '[]', true);
    $ytItems     = is_array($hp->berita_yt_items)      ? $hp->berita_yt_items      : json_decode($hp->berita_yt_items      ?? '[]', true);
    $artItems    = is_array($hp->berita_artikel_items) ? $hp->berita_artikel_items : json_decode($hp->berita_artikel_items ?? '[]', true);
@endphp

<div class="container-fluid p-4">

    {{-- header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Control Center Halaman Home</h4>
            <p class="text-muted small mb-0">Pantau semua konten halaman depan website</p>
        </div>
        <a href="{{ route('admin.home.edit') }}" class="btn btn-warning btn-sm px-3 py-2 shadow-sm text-white fw-bold d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square"></i>
                <span>Edit Konten</span>
            </a>
    </div>

    {{-- section hero --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex align-items-center gap-2 py-2">
            <i class="bi bi-camera-video text-success"></i><b>Hero Section</b>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    @if(!empty($hp->hero_video))
                    <div class="bg-dark rounded text-center p-3 text-white" style="font-size:12px;">
                        <i class="bi bi-camera-video" style="font-size:28px;"></i><br>
                        <span class="text-success mt-1 d-block">{{ basename($hp->hero_video) }}</span>
                    </div>
                    @else
                    <div class="bg-light text-center p-4 border rounded small text-muted" style="height:80px;line-height:60px;">Belum ada video</div>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="mb-1">
                        <span class="fw-semibold ms-1">{{ $hp->hero_teks_baris1 ?? '-' }}</span>
                    </div>
                    <div class="mb-1">
                        <span class="fw-semibold ms-1 text-warning">{{ $hp->hero_teks_baris2 ?? '-' }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="fw-semibold ms-1">{{ $hp->hero_teks_baris3 ?? '-' }}</span>
                    </div>
                    <p class="text-muted small mb-2">{{ Str::limit($hp->hero_subjudul ?? '-', 120) }}</p>
                    <div class="d-flex gap-2 flex-wrap">
                        @if(!empty($hp->hero_btn1_teks))
                        <span class="badge bg-success px-2 py-1">
                            <i class="bi bi-cursor me-1"></i>{{ $hp->hero_btn1_teks }} → {{ $hp->hero_btn1_link }}
                        </span>
                        @endif
                        @if(!empty($hp->hero_btn2_teks))
                        <span class="badge bg-secondary px-2 py-1">
                            <i class="bi bi-whatsapp me-1"></i>{{ $hp->hero_btn2_teks }} ({{ $hp->hero_btn2_nomor }})
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- section tentang kami --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex align-items-center gap-2 py-2">
            <i class="bi bi-person-circle text-success"></i><b>About</b>
        </div>
        <div class="card-body">
            <div class="row g-3">
                {{-- gambar --}}
                <div class="col-md-2">
                    @if(!empty($hp->about_foto))
                    <img src="{{ asset('storage/'.$hp->about_foto) }}" class="img-fluid rounded border" style="height:100px;object-fit:cover;width:100%;">
                    @else
<div class="bg-light text-center border rounded small text-muted d-flex flex-column align-items-center justify-content-center" style="height:100px;">
    <i class="bi bi-image mb-1" style="font-size:20px;"></i>
    <span>Belum ada foto</span>
</div>
@endif
                </div>
                {{-- header about --}}
                <div class="col-md-5">
                    <h6 class="fw-bold mb-1">{{ $hp->about_judul ?? '-' }}</h6>
                    <p class="text-muted small mb-2">{{ Str::limit($hp->about_deskripsi ?? '', 140) }}</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>{{ $hp->about_review_rating ?? '-' }}</span>
                        <span class="badge bg-light text-dark border">{{ $hp->about_review_jumlah ?? '-' }}</span>
                    </div>
                </div>
                {{-- visi misi --}}
                <div class="col-md-5">
                    <div class="mb-2">
                        <span class="badge bg-success mb-1">{{ $hp->about_visi_judul ?? 'Visi' }}</span>
                        <p class="text-muted small mb-0">{{ Str::limit($hp->about_visi_isi ?? '-', 100) }}</p>
                    </div>
                    <div>
                        <span class="badge bg-success mb-1">{{ $hp->about_misi_judul ?? 'Misi' }}</span>
                        <ul class="mb-0 ps-3" style="font-size:12px;">
                            @foreach(array_slice($misiItems ?? [], 0, 3) as $poin)
                            <li class="text-muted">{{ $poin }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- section fasilitas --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex align-items-center gap-2 py-2">
            <i class="bi bi-grid text-success"></i><b>Fasilitas</b>
        </div>
        <div class="card-body">
            <p class="fw-semibold mb-1">
                {{ $hp->fasilitas_judul1 ?? '' }}
                <span class="text-warning fst-italic">{{ $hp->fasilitas_judul2 ?? '' }}</span>
            </p>
            <p class="text-muted small mb-3">{{ Str::limit($hp->fasilitas_deskripsi ?? '', 120) }}</p>
            <div class="row g-3">
                @foreach($fasItems ?? [] as $i => $fas)
                <div class="col-md-4">
                    <div class="border rounded overflow-hidden" style="height:140px;position:relative;">
                        @php
                            $fasDefaults = ['assets/img/kolam.jpg','assets/img/gym.jpg','assets/img/playground.jpg'];
                            $fUrl = !empty($fas['foto'])
                                ? (str_starts_with($fas['foto'],'assets/') ? asset($fas['foto']) : asset('storage/'.$fas['foto']))
                                : asset($fasDefaults[$i] ?? 'assets/img/kolam.jpg');
                        @endphp
                        <img src="{{ $fUrl }}" style="width:100%;height:100%;object-fit:cover;">
                        <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,0.55);padding:6px 10px;">
                            <div class="text-white fw-semibold" style="font-size:12px;">{{ $fas['judul'] ?? '' }}</div>
                            <div class="text-white-50" style="font-size:10px;">{{ Str::limit($fas['keterangan'] ?? '', 50) }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- section lokasi --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex align-items-center gap-2 py-2">
            <i class="bi bi-geo-alt text-success"></i><b>Lokasi</b>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-1">
                        <span class="text-muted small">Judul:</span>
                        <span class="fw-semibold ms-1">{{ $hp->lokasi_judul1 ?? '' }}
                        <span class="text-warning fst-italic">{{ $hp->lokasi_judul2 ?? '' }}</span></span>
                    </div>
                    <div class="mb-1">
                        <span class="text-muted small"><i class="bi bi-building me-1"></i></span>
                        <span class="fw-semibold">{{ $hp->lokasi_nama_gedung ?? '-' }}</span>
                    </div>
                    <p class="text-muted small mb-0">{{ $hp->lokasi_alamat_lengkap ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <div class="fw-semibold small mb-2 text-muted"><i class="bi bi-signpost-2 me-1"></i>Akses Terdekat</div>
                    <table class="table table-sm table-borderless mb-0" style="font-size:12px;">
                        @foreach($aksesList ?? [] as $akses)
                        <tr>
                            <td class="text-muted py-0">{{ $akses['nama'] ?? '' }}</td>
                            <td class="text-success fw-semibold py-0 text-end">{{ $akses['waktu'] ?? '' }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- section layanan --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex align-items-center gap-2 py-2">
            <i class="bi bi-briefcase text-success"></i><b>Layanan</b>
        </div>
        <div class="card-body">
            <div class="mb-1">
                <span class="badge bg-light text-dark border me-1">{{ $hp->layanan_tag ?? '' }}</span>
                <span class="fw-semibold">{{ $hp->layanan_judul ?? '-' }}</span>
            </div>
            <p class="text-muted small mb-2">{{ Str::limit($hp->layanan_deskripsi ?? '', 120) }}</p>
            <div class="d-flex gap-2 flex-wrap">
                @foreach($layananBtns ?? [] as $btn)
                <span class="badge bg-success px-2 py-1">
                    <i class="bi bi-cursor me-1"></i>{{ $btn['teks'] ?? '' }}
                    <span class="text-white-50 ms-1" style="font-size:10px;">{{ $btn['link'] ?? '' }}</span>
                </span>
                @endforeach
            </div>
        </div>
    </div>

    {{-- section berita --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex align-items-center gap-2 py-2">
            <i class="bi bi-newspaper text-success"></i><b>Berita</b>
        </div>
        <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <span class="badge bg-light text-dark border me-1">{{ $hp->berita_tag ?? '' }}</span>
            <span class="fw-semibold">{{ $hp->berita_judul1 ?? '' }}</span>
            <span class="text-warning fst-italic ms-1">{{ $hp->berita_judul2 ?? '' }}</span>
        </div>
        @if(!empty($hp->berita_link_semua))
<span class="badge bg-success px-2 py-1">
    <i class="bi bi-newspaper me-1"></i>Semua Berita
    <span class="text-white-50 ms-1" style="font-size:10px;">{{ Str::limit($hp->berita_link_semua, 30) }}</span>
</span>
@endif
    </div>
            {{-- yt cards --}}
            <div class="fw-semibold small text-muted mb-2"><i class="bi bi-youtube text-danger me-1"></i>Card YouTube</div>
            <div class="row g-2 mb-3">
                @foreach($ytItems ?? [] as $yt)
                <div class="col-md-4">
                    <div class="border rounded p-2" style="font-size:12px;">
                        <div class="fw-semibold text-truncate">{{ $yt['judul'] ?? '-' }}</div>
                        <div class="text-muted">{{ $yt['tanggal'] ?? '' }} • {{ $yt['durasi'] ?? '' }}</div>
                        <div class="text-muted text-truncate">{{ $yt['channel'] ?? '' }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- artikel cards --}}
            <div class="fw-semibold small text-muted mb-2"><i class="bi bi-newspaper text-success me-1"></i>Card Berita</div>
            <div class="row g-2">
                @foreach($artItems ?? [] as $art)
                <div class="col-md-4">
                    <div class="border rounded p-2" style="font-size:12px;">
                        <div class="fw-semibold text-truncate">{{ $art['judul'] ?? '-' }}</div>
                        <div class="text-muted">{{ $art['tanggal'] ?? '' }} • {{ $art['jam'] ?? '' }}</div>
                        <div class="text-muted text-truncate">{{ $art['penerbit'] ?? '' }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- section kontak --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white d-flex align-items-center gap-2 py-2">
            <i class="bi bi-telephone text-success"></i><b>Kontak</b>
        </div>
        <div class="card-body">
            <div class="row g-3">
                {{-- info kontak & jam operasional --}}
                <div class="col-md-4">
                    <div class="mb-2">
                        <span class="fw-semibold">{{ $hp->kontak_judul ?? 'Informasi Kontak' }}</span>
                    </div>
                    <div class="mb-1 small">
                        <i class="bi bi-telephone text-success me-1"></i>
                        {{ $hp->kontak_telepon ?? '-' }}
                    </div>
                    <div class="small text-muted mb-1"><i class="bi bi-clock text-success me-1"></i>Jam Operasional:</div>
                    @foreach($jamList ?? [] as $jam)
                    <div class="small text-muted ps-3">{{ $jam }}</div>
                    @endforeach
                </div>
                
                {{-- sosial media --}}
                <div class="col-md-4">
                    <div class="fw-semibold small text-muted mb-2"><i class="bi bi-share me-1"></i>Sosial Media</div>
                    @foreach($sosmedList ?? [] as $s)
                    <div class="small mb-1">
                        <i class="bi {{ $s['icon'] ?? 'bi-link' }} text-success me-1"></i>
                        @if(!empty($s['link']))
                        <a href="{{ $s['link'] }}" target="_blank" class="text-muted text-decoration-none" style="font-size:11px;">
                            {{ Str::limit($s['link'], 40) }}
                        </a>
                        @else
                        <span class="text-muted" style="font-size:11px;">{{ $s['icon'] ?? '' }} (link belum diisi)</span>
                        @endif
                    </div>
                    @endforeach
                </div>
                {{-- divisi --}}
                <div class="col-md-4">
                    <div class="fw-semibold small text-muted mb-2"><i class="bi bi-diagram-3 me-1"></i>Opsi Divisi</div>
                    @foreach($divisiList ?? [] as $d)
                    <span class="badge bg-light text-dark border me-1 mb-1">{{ $d }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection