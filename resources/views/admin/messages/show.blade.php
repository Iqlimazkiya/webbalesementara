@extends('layouts.admin.main')

@section('title', 'Detail Pesan')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0 fw-bold">Detail Pesan</h6>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-light" style="font-size:12px;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body" style="font-size:13px;">
                <table class="table table-borderless mb-0" style="font-size:13px;">
                    <tr>
                        <td class="fw-semibold text-muted ps-0" style="width:90px;">Nama</td>
                        <td class="ps-0">{{ $message->name }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold text-muted ps-0">Email</td>
                        <td class="ps-0"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></td>
                    </tr>
                    <tr>
                        <td class="fw-semibold text-muted ps-0">Waktu</td>
                        <td class="ps-0">{{ $message->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold text-muted ps-0">Status</td>
                        <td class="ps-0">
                            @if($message->is_read)
                                <span class="badge bg-success" style="font-size:11px;">Sudah dibaca</span>
                            @else
                                <span class="badge bg-danger" style="font-size:11px;">Belum dibaca</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <hr class="my-3">

                <label class="fw-semibold text-muted d-block mb-2" style="font-size:12px;">Pesan:</label>
                <div class="p-3 bg-light rounded" style="white-space:pre-wrap; line-height:1.7; font-size:13px;">{{ $message->message }}</div>

                <div class="mt-3 d-flex flex-wrap gap-2">
                    <a href="mailto:{{ $message->email }}" class="btn btn-primary btn-sm" style="font-size:12px;">
                        <i class="bi bi-envelope me-1"></i> Balas Via Email
                    </a>
                    <form action="{{ route('admin.messages.destroy', $message->id) }}"
                          method="POST" class="ms-auto"
                          onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" style="font-size:12px;">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection