@extends('layouts.admin.main')

@section('title', 'Control Center Cleaning Order')

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
.tarif-table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
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
.foto-thumb-hero {
    width: 100%; max-width: 280px; height: 80px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    display: block;
}
.foto-thumb-empty {
    width: 72px; height: 50px;
    border-radius: 8px;
    border: 1px dashed #e2e8f0;
    background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: #cbd5e1;
}
.foto-thumb-empty-hero {
    width: 100%; max-width: 280px; height: 80px;
    border-radius: 8px;
    border: 1px dashed #e2e8f0;
    background: #f8fafc;
    display: flex; align-items: center; justify-content: center;
    color: #cbd5e1; font-size: 12px; gap: 6px;
}
.foto-galeri-grid { display: flex; gap: 8px; flex-wrap: wrap; }
.foto-galeri-thumb {
    width: 64px; height: 64px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0" style="font-size:1.15rem;">Control Center Cleaning Order</h3>
            <p class="text-muted mb-0" style="font-size:12px;">Pantau tarif, foto, dan ketentuan layanan cleaning.</p>
        </div>
        <a href="{{ route('admin.layananco.edit') }}"
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

    {{-- FOTO HERO --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Foto Hero</span>
        </div>
        @if($co?->foto_hero)
            <img src="{{ $co->fotoUrl($co->foto_hero) }}" class="foto-thumb-hero" alt="Hero">
        @else
            <div class="foto-thumb-empty-hero">
                <i class="bi bi-image"></i> Belum diisi
            </div>
        @endif
    </div>

    {{-- FOTO SLIDESHOW --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Foto Slideshow</span>
            @php $slideCount = count($co?->foto_slide ?? []); @endphp
            @if($slideCount)
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ $slideCount }} Foto</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if($slideCount)
            <div class="foto-thumb-grid">
                @foreach($co->foto_slide as $foto)
                    <img src="{{ $co->fotoUrl($foto) }}" class="foto-thumb" alt="Slide">
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada foto slideshow.</p>
        @endif
    </div>

    {{-- FOTO GALERI --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Galeri Hasil Kerja</span>
            @php $galeriCount = count($co?->foto_galeri ?? []); @endphp
            @if($galeriCount)
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ $galeriCount }} Foto</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if($galeriCount)
            <div class="foto-galeri-grid">
                @foreach($co->foto_galeri as $foto)
                    <img src="{{ $co->fotoUrl($foto) }}" class="foto-galeri-thumb" alt="Galeri">
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada foto galeri.</p>
        @endif
    </div>

    {{-- TARIF CLEANING UNIT --}}
    <div class="tarif-table-wrap admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Tarif Cleaning Unit</span>
            @if(count($co?->tarif_cleaning ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($co->tarif_cleaning) }} Baris</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($co?->tarif_cleaning ?? []))
        <table class="tarif-table">
            <thead>
                <tr>
                    <th>Type</th><th>Kondisi</th><th>Tarif</th><th>Petugas</th><th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($co->tarif_cleaning as $r)
                <tr>
                    <td class="fw-semibold">{{ $r['type'] }}</td>
                    <td class="col-muted">{{ $r['kondisi'] }}</td>
                    <td class="col-tarif">{{ $r['tarif'] }}</td>
                    <td class="col-muted">{{ $r['petugas'] }}</td>
                    <td class="col-muted">{{ $r['durasi'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada data.</p>
        @endif
    </div>

    {{-- TARIF TAMBAHAN --}}
    <div class="tarif-table-wrap admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Tarif Tambahan (per area)</span>
            @if(count($co?->tarif_tambahan ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($co->tarif_tambahan) }} Area</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($co?->tarif_tambahan ?? []))
        <table class="tarif-table">
            <thead>
                <tr>
                    <th>Area</th><th>Tarif</th><th>Petugas</th><th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($co->tarif_tambahan as $t)
                <tr>
                    <td class="fw-semibold">{{ $t['area'] }}</td>
                    <td class="col-tarif">{{ $t['tarif'] }}</td>
                    <td class="col-muted">{{ $t['petugas'] }}</td>
                    <td class="col-muted">{{ $t['durasi'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada data.</p>
        @endif
    </div>

    {{-- TARIF CUCI --}}
    <div class="tarif-table-wrap admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Cuci Sofa, Bed & Karpet</span>
            @if(count($co?->tarif_cuci ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($co->tarif_cuci) }} Item</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($co?->tarif_cuci ?? []))
        <table class="tarif-table">
            <thead>
                <tr>
                    <th>Nama Item</th><th>Satuan</th><th>Durasi</th><th>Tarif</th>
                </tr>
            </thead>
            <tbody>
                @foreach($co->tarif_cuci as $item)
                <tr>
                    <td class="fw-semibold">{{ $item['nama'] }}</td>
                    <td class="col-muted">{{ $item['satuan'] }}</td>
                    <td class="col-muted">{{ $item['durasi'] }}</td>
                    <td class="col-tarif">{{ $item['tarif'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada data.</p>
        @endif
    </div>

    {{-- TARIF BERKALA --}}
    <div class="tarif-table-wrap admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Perawatan Berkala</span>
            @if(count($co?->tarif_berkala ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($co->tarif_berkala) }} Paket</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($co?->tarif_berkala ?? []))
        <table class="tarif-table">
            <thead>
                <tr>
                    <th>Nama Paket</th><th>Satuan</th><th>Durasi</th><th>Petugas</th><th>Tarif</th>
                </tr>
            </thead>
            <tbody>
                @foreach($co->tarif_berkala as $item)
                <tr>
                    <td class="fw-semibold">{{ $item['nama'] }}</td>
                    <td class="col-muted">{{ $item['satuan'] }}</td>
                    <td class="col-muted">{{ $item['durasi'] }}</td>
                    <td class="col-muted">{{ $item['petugas'] ?? '-' }}</td>
                    <td class="col-tarif">{{ $item['tarif'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-muted mb-0" style="font-size:12px; font-style:italic;">Belum ada data.</p>
        @endif
    </div>

    {{-- KETENTUAN --}}
    <div class="admin-card-section">
        <div class="section-header-admin">
            <span class="section-title-text">Ketentuan & Informasi</span>
            @if(count($co?->ketentuan ?? []))
                <span class="tarif-badge"><i class="bi bi-check-circle"></i> {{ count($co->ketentuan) }} Poin</span>
            @else
                <span class="tarif-badge empty"><i class="bi bi-clock"></i> Belum diisi</span>
            @endif
        </div>
        @if(count($co?->ketentuan ?? []))
        <ul class="ketentuan-list">
            @foreach($co->ketentuan as $i => $note)
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