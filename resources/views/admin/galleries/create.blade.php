@extends('admin.layouts.app')

@section('page_title', 'Tambah Foto Galeri')
@section('breadcrumb', " > " . "Kelola Galeri > Tambah Foto")

@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle mr-2 text-purple"></i>Tambah Foto</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Foto <span class="text-danger">*</span></label>
                <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" required class="form-control-file @error('image') is-invalid @enderror">
                <small class="text-muted">JPEG/PNG/WebP, maks 5MB.</small>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Judul foto">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection