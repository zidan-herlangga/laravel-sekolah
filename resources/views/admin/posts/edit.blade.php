@extends('admin.layouts.app')

@section('page_title', 'Edit Berita')
@section('breadcrumb', " > " . "Kelola Berita > Edit Berita")

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title font-weight-bold"><i class="fas fa-edit mr-2 text-info"></i>Edit Berita</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="form-control @error('title') is-invalid @enderror">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="form-control @error('slug') is-invalid @enderror">
                        @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Konten <span class="text-danger">*</span></label>
                        <textarea name="content" required class="form-control tinymce @error('content') is-invalid @enderror" rows="12">{{ old('content', $post->content) }}</textarea>
                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Ringkasan</label>
                        <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    @if($post->image)
                    <div class="mb-3">
                        <img src="{{ Storage::url($post->image) }}" alt="" class="img-thumb-lg">
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Ganti Gambar</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="form-control-file @error('image') is-invalid @enderror">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah.</small>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group mt-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_published" value="1" id="is_published" class="custom-control-input" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-semibold" for="is_published">Publikasikan</label>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Perbarui Berita</button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-default btn-block mt-2"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection