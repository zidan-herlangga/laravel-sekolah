@extends('admin.layouts.app')

@section('page_title', 'Kelola Berita')
@section('breadcrumb', ' > ' . 'Kelola Berita')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold"><i class="fas fa-newspaper mr-2 text-info"></i>Daftar Berita</h3>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>
                    Tambah Berita</a>
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
            <form method="GET" action="{{ route('admin.posts.index') }}" class="row mb-4">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari judul berita...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            @if (request('search'))
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-default"><i
                                        class="fas fa-times"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Terbit</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:60px" class="text-center">Gambar</th>
                            <th>Judul & Slug</th>
                            <th style="width:150px">Kategori</th>
                            <th style="width:90px" class="text-center">Status</th>
                            <th style="width:120px">Tanggal</th>
                            <th style="width:100px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $post->image ? Storage::url($post->image) : 'https://via.placeholder.com/50x50?text=No+Img' }}"
                                        alt=""
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                </td>
                                <td>
                                    <a href="{{ route('berita.detail', $post->slug) }}" target="_blank"
                                        class="font-weight-semibold text-dark d-block">
                                        {{ Str::limit($post->title, 60) }}
                                    </a>
                                    <small class="text-muted"><i class="fas fa-link mr-1"></i>{{ $post->slug }}</small>
                                </td>
                                <td>
                                    @if ($post->category)
                                        <span class="badge badge-outline-info text-info border border-info px-2">
                                            <i class="fas fa-tag mr-1 small"></i>{{ $post->category->name }}
                                        </span>
                                    @else
                                        <small class="text-secondary italic">Tanpa Kategori</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($post->is_published)
                                        <span class="badge badge-success px-2">Terbit</span>
                                    @else
                                        <span class="badge badge-secondary px-2">Draft</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $post->created_at->format('d M Y') }}</small></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.posts.edit', $post) }}"
                                            class="btn btn-info btn-xs btn-flat" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus berita ini?')">
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
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 d-block opacity-50"></i>
                                    Tidak ada data berita yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
