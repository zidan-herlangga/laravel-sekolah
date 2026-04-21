@extends('admin.layouts.app')

@section('page_title', 'Kelola Berita')
@section('breadcrumb', " > " . "Kelola Berita")

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title font-weight-bold"><i class="fas fa-newspaper mr-2 text-info"></i>Daftar Berita</h3>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Tambah Berita</a>
        </div>
    </div>
    <div class="card-body">
        <!-- Search & Filter -->
        <form method="GET" action="{{ route('admin.posts.index') }}" class="row mb-4">
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul berita...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        @if(request('search'))
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-default"><i class="fas fa-times"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Terbit</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th style="width:60px">Gambar</th>
                        <th>Judul</th>
                        <th style="width:90px">Status</th>
                        <th style="width:120px">Tanggal</th>
                        <th style="width:140px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td>
                            <img src="{{ $post->image ? Storage::url($post->image) : 'https://via.placeholder.com/50x50?text=No+Img' }}" alt="" class="img-thumb">
                        </td>
                        <td>
                            <a href="{{ route('berita.detail', $post->slug) }}" target="_blank" class="font-weight-semibold text-dark">{{ Str::limit($post->title, 50) }}</a>
                            <br><small class="text-muted">{{ $post->slug }}</small>
                        </td>
                        <td>
                            @if($post->is_published)
                            <span class="badge badge-status badge-success">Terbit</span>
                            @else
                            <span class="badge badge-status badge-secondary">Draft</span>
                            @endif
                        </td>
                        <td><small>{{ $post->created_at->format('d M Y') }}</small></td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-info btn-xs btn-flat" title="Edit"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="d-inline" onsubmit="return confirm('Yakin hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs btn-flat" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada data berita.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $posts->links() }}</div>
    </div>
</div>
@endsection