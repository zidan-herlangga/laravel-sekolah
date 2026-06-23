@extends('admin.layouts.app')

@section('page_title', 'Kelola Komentar')
@section('breadcrumb', ' > ' . 'Kelola Komentar')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="card-title font-weight-bold"><i class="fas fa-comments mr-2 text-info"></i>Daftar Komentar</h3>
            </div>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Search & Filter -->
            <form method="GET" action="{{ route('admin.comments.index') }}" class="row mb-4">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari nama atau isi komentar...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            @if (request('search'))
                                <a href="{{ route('admin.comments.index') }}" class="btn btn-default"><i
                                        class="fas fa-times"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:50px">#</th>
                            <th>Nama</th>
                            <th>Komentar</th>
                            <th style="width:200px">Berita</th>
                            <th style="width:90px" class="text-center">Status</th>
                            <th style="width:100px">Tanggal</th>
                            <th style="width:120px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $comment)
                            <tr class="{{ !$comment->is_approved ? 'table-warning' : '' }}">
                                <td class="text-muted small">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-{{ $comment->user_id ? 'primary' : 'secondary' }} text-white d-flex align-items-center justify-content-center"
                                            style="width:32px;height:32px;font-size:13px;font-weight:700;flex-shrink:0;">
                                            {{ strtoupper(substr($comment->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong>{{ $comment->name }}</strong>
                                            @if ($comment->user_id)
                                                <small class="text-info d-block"><i class="fas fa-user-check"></i> Terdaftar</small>
                                            @else
                                                <small class="text-muted d-block">Tamu</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-wrap" style="max-width:300px;">
                                        <p class="mb-1">{{ $comment->body }}</p>
                                        @if ($comment->parent_id)
                                            <small class="text-muted"><i class="fas fa-reply mr-1"></i>Balasan</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if ($comment->post)
                                        <a href="{{ route('berita.detail', $comment->post->slug) }}" target="_blank"
                                            class="small">
                                            {{ Str::limit($comment->post->title, 40) }}
                                        </a>
                                    @else
                                        <small class="text-muted">(berita dihapus)</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($comment->is_approved)
                                        <span class="badge badge-success px-2">Disetujui</span>
                                    @else
                                        <span class="badge badge-warning px-2">Menunggu</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $comment->created_at->format('d M Y H:i') }}</small></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if (!$comment->is_approved)
                                            <form method="POST" action="{{ route('admin.comments.approve', $comment) }}"
                                                class="d-inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-xs btn-flat" title="Setujui">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus komentar ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs btn-flat" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-comment-slash fa-3x mb-3 d-block opacity-50"></i>
                                    Belum ada komentar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
