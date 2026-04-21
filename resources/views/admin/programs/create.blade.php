@extends('admin.layouts.app')

@section('page_title', 'Tambah Program')
@section('breadcrumb', " > " . "Kelola Program > Tambah Program")

@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle mr-2 text-amber-500"></i>Tambah Program</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.programs.store') }}">
            @csrf
            <div class="form-group">
                <label>Judul <span class="text-danger">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="form-control @error('title') is-invalid @enderror">
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label>Ikon (Font Awesome)</label>
                <input type="text" name="icon" value="{{ old('icon', 'fas fa-star') }}" class="form-control" placeholder="fas fa-star">
                <small class="text-muted">Contoh: fas fa-book-open, fas fa-flask</small>
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="form-control">
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="is_active" value="1" id="is_active" class="custom-control-input" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="custom-control-label font-weight-semibold" for="is_active">Aktif</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
            <a href="{{ route('admin.programs.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection