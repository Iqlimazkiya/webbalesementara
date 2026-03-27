@extends('layouts.admin.main')

@section('title', 'Riwayat Aktivitas')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Riwayat Aktivitas</h3>
                <p class="text-subtitle text-muted">Histori lengkap semua aktivitas perubahan di sistem</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Log Aktivitas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="padding:1.5rem;">
                        @forelse($activities as $activity)

                        @php
                            $desc = strtolower($activity->description);
                            if (str_contains($desc, 'login')) {
                                $color = '#198754'; $icon = 'bi-box-arrow-in-right';
                            } elseif (str_contains($desc, 'logout')) {
                                $color = '#6c757d'; $icon = 'bi-box-arrow-right';
                            } elseif (str_contains($desc, 'hapus') || str_contains($desc, 'dihapus')) {
                                $color = '#dc3545'; $icon = 'bi-trash-fill';
                            } elseif (str_contains($desc, 'tambah') || str_contains($desc, 'unggah') || str_contains($desc, 'mengunggah')) {
                                $color = '#0d6efd'; $icon = 'bi-plus-circle-fill';
                            } elseif (str_contains($desc, 'password')) {
                                $color = '#fd7e14'; $icon = 'bi-shield-lock-fill';
                            } elseif (str_contains($desc, 'foto')) {
                                $color = '#6f42c1'; $icon = 'bi-image-fill';
                            } elseif (str_contains($desc, 'pesan')) {
                                $color = '#0dcaf0'; $icon = 'bi-envelope-fill';
                            } else {
                                $color = '#335A40'; $icon = 'bi-pencil-fill';
                            }
                        @endphp

                        <div class="d-flex gap-3 mb-4">
                            {{-- Icon bulat --}}
                            <div style="width:36px; height:36px; border-radius:50%;
                                        background:{{ $color }}20;
                                        border:2px solid {{ $color }}40;
                                        display:flex; align-items:center; justify-content:center;
                                        flex-shrink:0; margin-top:2px;">
                                <i class="bi {{ $icon }}" style="color:{{ $color }}; font-size:.8rem;"></i>
                            </div>

                            {{-- Konten --}}
                            <div style="flex:1; min-width:0; padding-bottom:1rem;
                                        border-bottom:1px solid #f0f0f0;">
                                <div class="d-flex justify-content-between align-items-start gap-2 flex-wrap">
                                    <span class="fw-semibold" style="font-size:.875rem; color:#2d2d2d;">
                                        {{ $activity->description }}
                                    </span>
                                    <small class="text-muted text-nowrap" style="font-size:.75rem;">
                                        {{ $activity->created_at->locale('id')->diffForHumans() }}
                                    </small>
                                </div>

                                @if($activity->details)
                                <p class="text-muted mb-1 mt-1" style="font-size:.8rem; line-height:1.4;">
                                    {{ $activity->details }}
                                </p>
                                @endif

                                <small style="font-size:.72rem; color:#aaa;">
                                    {{ $activity->created_at->locale('id')->translatedFormat('d M Y, H:i') }}
                                    @if($activity->ip_address)
                                        &middot; {{ $activity->ip_address }}
                                    @endif
                                </small>
                            </div>
                        </div>

                        @empty
                        <div class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                            <p class="text-muted mb-0" style="font-size:.875rem;">Belum ada aktivitas tercatat</p>
                        </div>
                        @endforelse

                        {{-- Pagination --}}
                        @if($activities->hasPages())
                        <div class="mt-2" style="font-size:.85rem;">
                            {{ $activities->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection