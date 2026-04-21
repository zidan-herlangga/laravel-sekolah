@extends('admin.layouts.app')

@section('page_title', 'Edit Foto Galeri')
@section('breadcrumb', " > " . "Kelola Galeri > Edit Foto")

@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-edit mr-2 text-purple"></i>Edit Foto</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <img src="{{ Storage::url($gallery->image) }}" class="img-thumb-lg mb-3" alt="">
            <div class="form-group">
                <label>Ganti Foto</label>
                <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="form-control-file @error('image') is-invalid @enderror">
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="title" value="{{ old('title', $gallery->title) }}" class="form-control">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $gallery->description) }}</textarea>
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="order" value="{{ old('order', $gallery->order) }}" min="0" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Perbarui</button>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection