@extends('layouts.admin.main')

@section('title', 'Pesan Masuk')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0 fw-bold">Pesan Masuk</h6>
                    <small class="text-muted" style="font-size:11px;">Daftar pesan dari pengunjung website</small>
                </div>
                @php $unread = $messages->where('is_read', false)->count(); @endphp
                @if($unread > 0)
                    <span class="badge bg-danger" style="font-size:11px;">{{ $unread }} belum dibaca</span>
                @endif
            </div>
            <div class="card-body p-0">
                @if($messages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size:13px;">
                        <thead class="table-light">
                            <tr>
                                <th style="width:36px;"></th>
                                <th>Nama</th>
                                <th class="d-none d-md-table-cell">Email</th>
                                <th class="d-none d-sm-table-cell">Divisi</th>
                                <th>Pesan</th>
                                <th class="d-none d-sm-table-cell">Waktu</th>
                                <th style="width:80px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                            <tr class="{{ !$message->is_read ? 'table-warning' : '' }}">
                                <td class="text-center align-middle">
                                    @if(!$message->is_read)
                                        <span class="badge bg-danger" style="font-size:10px;">Baru</span>
                                    @else
                                        <i class="bi bi-check2 text-muted"></i>
                                    @endif
                                </td>
                                <td class="fw-semibold align-middle">{{ $message->name }}</td>
                                <td class="d-none d-md-table-cell align-middle text-muted">{{ $message->email }}</td>
                                <td class="d-none d-sm-table-cell align-middle text-muted">{{ $message->divisi ?? '-' }}</td>
                                <td class="align-middle">
                                    <span class="text-truncate d-inline-block text-muted" style="max-width:160px;">
                                        {{ $message->message }}
                                    </span>
                                </td>
                                <td class="d-none d-sm-table-cell align-middle text-muted" style="font-size:12px; white-space:nowrap;">
                                    {{ $message->created_at->diffForHumans() }}
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.messages.show', $message->id) }}"
                                           class="btn btn-sm btn-light" title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.messages.destroy', $message->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus pesan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light text-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-3 py-2" style="font-size:13px;">
                    {{ $messages->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox fs-2 text-muted"></i>
                    <p class="text-muted mt-2 mb-0" style="font-size:13px;">Belum ada pesan masuk</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection