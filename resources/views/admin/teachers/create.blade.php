@extends('admin.layouts.app')

@section('page_title', 'Tambah Guru/Staff')
@section('breadcrumb', " > " . "Kelola Guru/Staff > Tambah Data")

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-plus-circle mr-2 text-success"></i>Tambah Data</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.teachers.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="form-control @error('name') is-invalid @enderror">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="position" value="{{ old('position') }}" class="form-control" placeholder="Contoh: Kepala Sekolah">
                    </div>
                    <div class="form-group">
                        <label>Bio</label>
                        <textarea name="bio" class="form-control" rows="4">{{ old('bio') }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="photo" accept="image/jpeg,image/png,image/jpg,image/webp" class="form-control-file @error('photo') is-invalid @enderror">
                        <small class="text-muted">JPEG/PNG/WebP, maks 2MB.</small>
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Tipe <span class="text-danger">*</span></label>
                        <select name="type" required class="form-control @error('type') is-invalid @enderror">
                            <option value="">Pilih Tipe</option>
                            <option value="guru" {{ old('type') === 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="staff" {{ old('type') === 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Urutan Tampil</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="form-control">
                        <small class="text-muted">Angka kecil = tampil lebih dulu.</small>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan</button>
                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-default btn-block mt-2">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection