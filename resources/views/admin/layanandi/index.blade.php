@extends('layouts.admin.main')
@section('title', 'Design Interior')
@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h5 class="fw-bold mb-0">Design Interior</h5>
            <p class="text-muted small mb-0">Kelola konten halaman layanan Design Interior</p>
        </div>
        <a href="{{ route('admin.layanandi.edit') }}" class="btn btn-success btn-sm px-4">
            <i class="bi bi-pencil me-1"></i> Edit Konten
        </a>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4">
                    <div class="fw-bold fs-4 text-success">{{ count($di?->tarif_konsultasi ?? []) }}</div>
                    <div class="text-muted small">Tarif Konsultasi</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4">
                    <div class="fw-bold fs-4 text-success">{{ count($di?->tarif_desain ?? []) }}</div>
                    <div class="text-muted small">Tarif Desain</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4">
                    <div class="fw-bold fs-4 text-success">{{ count($di?->tarif_renovasi ?? []) }}</div>
                    <div class="text-muted small">Tarif Renovasi</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4">
                    <div class="fw-bold fs-4 text-success">{{ count($di?->tarif_paket ?? []) }}</div>
                    <div class="text-muted small">Tarif Paket</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('layanan.di') }}" target="_blank" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-eye me-1"></i> Lihat Halaman User
        </a>
    </div>
</div>
@endsection