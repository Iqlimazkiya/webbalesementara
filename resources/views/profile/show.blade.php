@extends('layouts.admin.main')

@section('title', 'Profil Saya')

@push('styles')
<style>
    .btn-edit-profil:hover {
        background: #274832 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(51, 90, 64, .3);
    }
    .btn-edit-profil:active {
        transform: translateY(0);
    }

    /* Mobile font scaling */
    @media (max-width: 576px) {
        .profile-card h3 { font-size: .95rem !important; }
        .profile-card .user-name { font-size: .8rem !important; }
        .profile-card .badge-role { font-size: .6rem !important; padding: 3px 8px !important; }
        .profile-card .field-label { font-size: .58rem !important; }
        .profile-card .field-value { font-size: .75rem !important; }
        .profile-card .icon-box { width: 28px !important; height: 28px !important; border-radius: 8px !important; }
        .profile-card .icon-box i { font-size: .75rem !important; }
        .profile-card .avatar-wrap { width: 64px !important; height: 64px !important; }
        .profile-card .avatar-initial { font-size: 1.4rem !important; }
        .profile-card .btn-sm { font-size: .75rem !important; padding: 8px 12px !important; }
    }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profil Saya</h3>
                <p class="text-subtitle text-muted">Panel Admin Bale Hinggil</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 profile-card" style="border-radius: 16px; overflow: hidden;">

                    {{-- Banner --}}
                    <div style="height: 80px; background: linear-gradient(135deg, #335A40, #4e8a5e);"></div>

                    <div class="card-body px-4 pb-4" style="padding-top: 0;">

                        {{-- Avatar --}}
                        <div class="text-center" style="margin-top: -40px; margin-bottom: 12px;">
                            <div class="avatar-wrap" style="
                                width: 80px; height: 80px;
                                border-radius: 50%;
                                overflow: hidden;
                                margin: 0 auto;
                                border: 4px solid white;
                                background: #e9ecef;
                                display: flex; align-items: center; justify-content: center;
                                box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                            ">
                                @if($user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                         alt="Foto Profil"
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <span class="avatar-initial" style="font-size: 2rem; font-weight: 700; color: #335A40; text-transform: uppercase;">
                                        {{ substr($user->name, 0, 1) }}
                                    </span>
                                @endif
                            </div>
                            <p class="fw-bold mt-2 mb-0 user-name" style="font-size: 1rem; color: #1a1a1a;">{{ $user->name }}</p>
                            <span class="badge mt-1 badge-role" style="background: #e8f5ea; color: #335A40; font-size: .7rem; font-weight: 600; padding: 4px 10px; border-radius: 20px;">
                                Admin
                            </span>
                        </div>

                        <hr style="border-color: #f0f0f0; margin: 16px 0;">

                        {{-- Info Fields --}}
                        <div class="d-flex flex-column gap-3">

                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-box" style="width: 36px; height: 36px; border-radius: 10px; background: #e8f5ea; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="bi bi-person-fill" style="color: #335A40; font-size: .9rem;"></i>
                                </div>
                                <div style="min-width: 0;">
                                    <p class="mb-0 field-label" style="font-size: .68rem; color: #adb5bd; text-transform: uppercase; letter-spacing: .6px; font-weight: 600;">Nama Lengkap</p>
                                    <p class="mb-0 fw-semibold text-truncate field-value" style="font-size: .875rem; color: #2d2d2d;">{{ $user->name }}</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-box" style="width: 36px; height: 36px; border-radius: 10px; background: #e8f5ea; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="bi bi-envelope-fill" style="color: #335A40; font-size: .9rem;"></i>
                                </div>
                                <div style="min-width: 0;">
                                    <p class="mb-0 field-label" style="font-size: .68rem; color: #adb5bd; text-transform: uppercase; letter-spacing: .6px; font-weight: 600;">Email</p>
                                    <p class="mb-0 fw-semibold field-value" style="font-size: .875rem; color: #2d2d2d; word-break: break-all;">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-box" style="width: 36px; height: 36px; border-radius: 10px; background: #e8f5ea; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="bi bi-calendar-check-fill" style="color: #335A40; font-size: .9rem;"></i>
                                </div>
                                <div style="min-width: 0;">
                                    <p class="mb-0 field-label" style="font-size: .68rem; color: #adb5bd; text-transform: uppercase; letter-spacing: .6px; font-weight: 600;">Bergabung Sejak</p>
                                    <p class="mb-0 fw-semibold field-value" style="font-size: .875rem; color: #2d2d2d;">
                                        {{ $user->created_at->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-box" style="width: 36px; height: 36px; border-radius: 10px; background: #e8f5ea; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="bi bi-clock-fill" style="color: #335A40; font-size: .9rem;"></i>
                                </div>
                                <div style="min-width: 0;">
                                    <p class="mb-0 field-label" style="font-size: .68rem; color: #adb5bd; text-transform: uppercase; letter-spacing: .6px; font-weight: 600;">Terakhir Diperbarui</p>
                                    <p class="mb-0 fw-semibold field-value" style="font-size: .875rem; color: #2d2d2d;">
                                        {{ $user->updated_at->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }}
                                    </p>
                                </div>
                            </div>

                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                            <a href="{{ route('admin.profile.edit') }}"
                               class="btn btn-sm flex-fill btn-edit-profil"
                               style="background: #335A40; color: white; border-radius: 10px; padding: 10px 16px; font-weight: 600;">
                                <i class="bi bi-pencil-fill me-1"></i> Edit Profil
                            </a>
                            <a href="{{ route('admin.dashboard') }}"
                               class="btn btn-sm btn-outline-secondary flex-fill"
                               style="border-radius: 10px; padding: 10px 16px; font-weight: 600;">
                                Kembali
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection