@extends('layouts.admin.main')

@section('title', 'Control Center Working Order')

@push('styles')
<style>
.admin-card-section {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    margin-bottom: 20px;
    border: 1px solid #edf2f7;
}
.section-header-admin {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 12px;
    margin-bottom: 12px;
}
.section-title-text {
    font-size: 13px;
    font-weight: 700;
    color: #335A40;
    text-transform: uppercase;
    letter-spacing: .8px;
}
.tarif-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
}
.tarif-badge.empty {
    background: #f8fafc;
    border-color: #e2e8f0;
    color: #94a3b8;
}

.tarif-table-wrap {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.tarif-table { width: 100%; border-collapse: collapse; font-size: 12px; }
.tarif-table th {
    background: #f8fafc;
    color: #94a3b8;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 7px 12px;
    border: 1px solid #e2e8f0;
    white-space: nowrap;
}
.tarif-table td {
    padding: 8px 12px;
    border: 1px solid #f1f5f9;
    color: #374151;
    vertical-align: middle;
}
.tarif-table tr:nth-child(even) td { background: #f8fafc; }
.tarif-table tr:hover td { background: #f0fdf4; }
.tarif-table .col-tarif { color: #166534; font-weight: 600; }
.tarif-table .col-muted { color: #94a3b8; }

.foto-thumb-grid { display: flex; gap: 8px; flex-wrap: wrap; }
.foto-thumb {
    width: 72px; height: 50px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}
.foto-thumb-empty {
    width: 72px; height: 50px;
    border-radius: 8px;
    border: 1px dashed #e2e8f0;
    background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: #cbd5e1;
}

.ketentuan-list { list-style: none; padding: 0; margin: 0; }
.ketentuan-list li {
    display: flex;
    gap: 10px;
    padding: 7px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 12px;
    color: #374151;
}
.ketentuan-list li:last-child { border-bottom: none; }
.ketentuan-num {
    width: 20px; height: 20px;
    background: #335A40; color: #fff;
    border-radius: 50%;
    font-size: 10px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px;
}
</style>
@endpush

@section('content')
<div class="page-heading">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0" style="font-size:1.15rem;">Control Center Working Order</h3>
            <p class="text-muted mb-0" style="font-size:12px;">Pantau tarif, foto, dan ketentuan layanan working order.</p>
        </div>
        <a href="{{ route('admin.layananwo.edit') }}"
           class="btn btn-warning btn-sm px-3 py-2 shadow-sm text-white fw-bold d-flex align-items-center gap-2">
            <i class="bi bi-pencil-square"></i>
            <span>Edit Konten</span>
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" style="font-size:13px;">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- ── FOTO ── --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text"><i class="bi bi-images me-1"></i> Foto Carousel & Slideshow</span>
        </div>
        <p class="text-muted mb-2" style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.5px;">Carousel (4 foto)</p>
        <div class="foto-thumb-grid mb-3">
            @foreach([1,2,3,4] as $n)
                @php $path = $wo?->{"foto_carousel_{$n}"}; @endphp
                @if($path)
                    <img src="{{ $wo->fotoUrl($path) }}" class="foto-thumb" alt="Carousel {{ $n }}">
                @else
                    <div class="foto-thumb-empty"><i class="bi bi-image"></i></div>
                @endif
            @endforeach
        </div>
        <p class="text-muted mb-2" style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.5px;">Slideshow (3 foto)</p>
        <div class="foto-thumb-grid">
            @foreach([1,2,3] as $n)
                @php $path = $wo?->{"foto_slide_{$n}"}; @endphp
                @if($path)
                    <img src="{{ $wo->fotoUrl($path) }}" class="foto-thumb" alt="Slide {{ $n }}">
                @else
                    <div class="foto-thumb-empty"><i class="bi bi-image"></i></div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- ── TARIF LISTRIK ── --}}
    <div class="tarif-table-wrap admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text"><i class="bi bi-lightning-charge me-1"></i> Tarif Listrik</span>
            @if(count($wo?->tarif_listrik ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($wo->tarif_listrik) }} Baris</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($wo?->tarif_listrik ?? []))
        <table class="tarif-table">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Kondisi</th>
                    <th>Tarif</th>
                    <th>Petugas</th>
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wo->tarif_listrik as $r)
                <tr>
                    <td class="fw-semibold">{{ $r['jenis'] }}</td>
                    <td class="col-muted">{{ $r['kondisi'] }}</td>
                    <td class="col-tarif">{{ $r['tarif'] }}</td>
                    <td class="col-muted">{{ $r['petugas'] }}</td>
                    <td class="col-muted">{{ $r['durasi'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada data. Klik Edit Konten untuk mengisi.</p>
        @endif
    </div>

    {{-- ── TARIF PLUMBING ── --}}
    <div class="tarif-table-wrap admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text"><i class="bi bi-droplet me-1"></i> Tarif Plumbing</span>
            @if(count($wo?->tarif_plumbing ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($wo->tarif_plumbing) }} Baris</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($wo?->tarif_plumbing ?? []))
        <table class="tarif-table">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Kondisi</th>
                    <th>Tarif</th>
                    <th>Petugas</th>
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wo->tarif_plumbing as $r)
                <tr>
                    <td class="fw-semibold">{{ $r['jenis'] }}</td>
                    <td class="col-muted">{{ $r['kondisi'] }}</td>
                    <td class="col-tarif">{{ $r['tarif'] }}</td>
                    <td class="col-muted">{{ $r['petugas'] }}</td>
                    <td class="col-muted">{{ $r['durasi'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada data. Klik Edit Konten untuk mengisi.</p>
        @endif
    </div>

    {{-- ── TARIF UMUM ── --}}
    <div class="tarif-table-wrap admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text"><i class="bi bi-tools me-1"></i> Tarif Umum</span>
            @if(count($wo?->tarif_umum ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($wo->tarif_umum) }} Baris</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($wo?->tarif_umum ?? []))
        <table class="tarif-table">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Kondisi</th>
                    <th>Tarif</th>
                    <th>Petugas</th>
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wo->tarif_umum as $r)
                <tr>
                    <td class="fw-semibold">{{ $r['jenis'] }}</td>
                    <td class="col-muted">{{ $r['kondisi'] }}</td>
                    <td class="col-tarif">{{ $r['tarif'] }}</td>
                    <td class="col-muted">{{ $r['petugas'] }}</td>
                    <td class="col-muted">{{ $r['durasi'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada data. Klik Edit Konten untuk mengisi.</p>
        @endif
    </div>

    {{-- ── KETENTUAN ── --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text"><i class="bi bi-info-circle me-1"></i> Ketentuan & Informasi</span>
            @if(count($wo?->ketentuan ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($wo->ketentuan) }} Poin</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($wo?->ketentuan ?? []))
        <ul class="ketentuan-list">
            @foreach($wo->ketentuan as $i => $note)
            <li>
                <div class="ketentuan-num">{{ $i + 1 }}</div>
                <span>{{ $note }}</span>
            </li>
            @endforeach
        </ul>
        @else
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada ketentuan.</p>
        @endif
    </div>
</div>
@endsection