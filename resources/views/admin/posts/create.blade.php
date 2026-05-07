@extends('admin.layouts.app')

@section('page_title', 'Tambah Berita')
@section('breadcrumb', ' > ' . 'Kelola Berita > Tambah Berita')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle mr-2 text-info"></i>Tambah Berita Baru</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                class="form-control @error('title') is-invalid @enderror" placeholder="Judul berita">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Slug (Opsional)</label>
                            <input type="text" name="slug" value="{{ old('slug') }}"
                                class="form-control @error('slug') is-invalid @enderror"
                                placeholder="auto-generate dari judul">
                            <small class="text-muted">Kosongkan untuk auto-generate dari judul.</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kategori (Opsional)</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach (\App\Models\Category::orderBy('name')->get() as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') ?? $post->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Konten <span class="text-danger">*</span></label>
                            <textarea name="content" required class="form-control tinymce @error('content') is-invalid @enderror" rows="12">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ringkasan (Opsional)</label>
                            <textarea name="excerpt" class="form-control" rows="3" placeholder="Ringkasan singkat berita">{{ old('excerpt') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                                class="form-control-file @error('image') is-invalid @enderror">
                            <small class="text-muted">Format: JPEG, PNG, WebP. Maks: 2MB.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_published" value="1" id="is_published"
                                    class="custom-control-input" {{ old('is_published') ? 'checked' : '' }}>
                                <label class="custom-control-label font-weight-semibold"
                                    for="is_published">Publikasikan</label>
                            </div>
                            <small class="text-muted">Aktifkan untuk menampilkan berita di website.</small>
                        </div>

                        <div class="mt-5 pt-4 border-top">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan
                                Berita</button>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-default btn-block mt-2"><i
                                    class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
