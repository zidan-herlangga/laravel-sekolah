@extends('admin.layouts.app')

@section('page_title', 'Kelola Galeri')
@section('breadcrumb', " >  " ."Kelola Galeri")

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h3 class="card-title font-weight-bold"><i class="fas fa-images mr-2 text-purple"></i>Galeri Foto</h3>
            <div class="d-flex gap-2">
                <button type="submit" form="bulk-delete-form" id="bulk-delete-btn" class="btn btn-danger btn-sm"
                    style="display:none;" onclick="return confirm('Yakin hapus foto yang dipilih?')">
                    <i class="fas fa-trash mr-1"></i> Hapus Terpilih
                </button>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Tambah Foto</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="bulk-delete-form" method="POST" action="{{ route('admin.galleries.bulk-delete') }}">
            @csrf
        <div class="row">
            @forelse($galleries as $gallery)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card card-outline card-hover" style="border-radius:12px;">
                    <div class="card-img-top text-center pt-2">
                        <input type="checkbox" class="row-checkbox" name="ids[]" value="{{ $gallery->id }}">
                    </div>
                    <img src="{{ Storage::url($gallery->image) }}" class="card-img-top" style="height:160px;object-fit:cover;" alt="{{ $gallery->title }}">
                    <div class="card-body p-3">
                        <h6 class="font-weight-bold mb-0">{{ $gallery->title ?? 'Tanpa Judul' }}</h6>
                        <small class="text-muted">Urutan: {{ $gallery->order }}</small>
                        <div class="mt-2">
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-info btn-xs btn-flat"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" class="d-inline" onsubmit="return confirm('Yakin hapus foto ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs btn-flat"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-10 text-muted">Belum ada foto galeri.</div>
            @endforelse
        </div>
        </form>
        <div class="mt-3">{{ $galleries->links() }}</div>
    </div>
</div>
@endsection