@extends('layouts.admin.main')

@section('title', 'Edit Profil')

@push('styles')
<style>
    .profile-form .form-label {
        font-size: .75rem;
        font-weight: 700;
        color: #1a1a1a;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 6px;
    }

    .profile-form .form-control {
        font-size: .875rem;
        color: #6c757d;
        background: #f8f9fa;
        border: 1.5px solid #e9ecef;
        border-radius: 10px;
        padding: 10px 14px;
        transition: border-color .2s, box-shadow .2s;
    }

    .profile-form .form-control:focus {
        border-color: #335A40;
        box-shadow: 0 0 0 3px rgba(51, 90, 64, .12);
        background: #fff;
        color: #2d2d2d;
    }

    .profile-form .btn-save {
        background: #335A40;
        color: white;
        border-radius: 10px;
        padding: 9px 20px;
        font-size: .875rem;
        font-weight: 600;
        border: none;
        transition: background .2s, transform .15s, box-shadow .15s;
    }

    .profile-form .btn-save:hover {
        background: #274832;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(51, 90, 64, .3);
    }

    .profile-form .btn-save:active {
        transform: translateY(0);
    }

    /* Mobile font scaling */
    @media (max-width: 576px) {
        .edit-card .section-title { font-size: .78rem !important; }
        .edit-card .section-icon { width: 26px !important; height: 26px !important; border-radius: 7px !important; }
        .edit-card .section-icon i { font-size: .75rem !important; }

        .profile-form .form-label { font-size: .62rem !important; }
        .profile-form .form-control { font-size: .78rem !important; padding: 8px 10px !important; }

        /* Semua button di dalam form */
        .profile-form .btn,
        .profile-form .btn-save,
        .profile-form button[type="submit"],
        .profile-form a.btn {
            font-size: .68rem !important;
            padding: 6px 12px !important;
        }
    }
</style>
@endpush

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Profil</h3>
                <p class="text-subtitle text-muted">Kelola informasi akun dan foto profil</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.profile.show') }}">Profil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 edit-card" style="border-radius: 16px; overflow: hidden;">

                    {{-- Banner --}}
                    <div style="height: 72px; background: linear-gradient(135deg, #335A40, #4e8a5e);"></div>

                    <div class="card-body px-3 px-md-4 pb-4" style="padding-top: 1.25rem;">

                        {{-- Bagian atas: foto + info akun --}}
                        <div class="d-flex flex-column flex-md-row gap-4 align-items-start">

                            {{-- Kolom kiri: foto --}}
                            <div class="mx-auto mx-md-0" style="min-width: 160px; max-width: 180px; width: 100%;">
                                @include('profile.partials.update-photo-form')
                            </div>

                            {{-- Kolom kanan: info akun --}}
                            <div class="profile-form" style="flex: 1; min-width: 0; width: 100%;">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="section-icon" style="width: 32px; height: 32px; border-radius: 8px; background: #e8f5ea; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="bi bi-person-fill" style="color: #335A40; font-size: .85rem;"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold section-title" style="color: #1a1a1a; font-size: .9rem;">Informasi Akun</h6>
                                </div>
                                @include('profile.partials.update-profile-information-form')
                            </div>

                        </div>

                        {{-- Garis pemisah --}}
                        <hr style="border-color: #e9ecef; margin: 1.75rem 0;">

                        {{-- Bagian bawah: ubah password --}}
                        <div class="d-flex flex-column flex-md-row gap-4 align-items-start">

                            {{-- Spacer kiri sejajar foto (hanya desktop) --}}
                            <div class="d-none d-md-block" style="min-width: 160px; max-width: 180px;"></div>

                            {{-- Kolom kanan: password --}}
                            <div class="profile-form" style="flex: 1; min-width: 0; width: 100%;">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="section-icon" style="width: 32px; height: 32px; border-radius: 8px; background: #e8f5ea; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="bi bi-shield-lock-fill" style="color: #335A40; font-size: .85rem;"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold section-title" style="color: #1a1a1a; font-size: .9rem;">Ubah Password</h6>
                                </div>
                                @include('profile.partials.update-password-form')
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    const photoInput = document.getElementById('photoInput');
    if (photoInput) {
        photoInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('avatarPreview');
                const initial = document.getElementById('avatarInitial');
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (initial) initial.style.display = 'none';
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endpush