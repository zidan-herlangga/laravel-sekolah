@extends('admin.layouts.app')

@section('page_title', 'Pengaturan Situs')
@section('breadcrumb', " > " ."Kelola Pengaturan")

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-cog mr-2 text-gray-600"></i>Pengaturan Situs
        </h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf @method('PUT')

            <ul class="nav nav-tabs mb-4">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#general">Umum</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact-info">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#social">Media Sosial</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ppdb-settings">PPDB</a></li>
            </ul>

            <div class="tab-content">

                <!-- General -->
                <div class="tab-pane active" id="general">
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" name="school_name"
                            value="{{ old('school_name', $settings->get('school_name')) }}"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Singkat</label>
                        <input type="text" name="school_short_name"
                            value="{{ old('school_short_name', $settings->get('school_short_name')) }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Motto</label>
                        <input type="text" name="school_motto"
                            value="{{ old('school_motto', $settings->get('school_motto')) }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Sambutan Kepala Sekolah</label>
                        <textarea name="headmaster_welcome" class="form-control">{{ old('headmaster_welcome', $settings->get('headmaster_welcome')) }}</textarea>
                    </div>
                </div>

                <!-- Contact -->
                <div class="tab-pane" id="contact-info">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="school_address" class="form-control">{{ old('school_address', $settings->get('school_address')) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="school_phone"
                            value="{{ old('school_phone', $settings->get('school_phone')) }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="school_email"
                            value="{{ old('school_email', $settings->get('school_email')) }}"
                            class="form-control">
                    </div>
                </div>

                <!-- Social -->
                <div class="tab-pane" id="social">
                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="url" name="school_facebook"
                            value="{{ old('school_facebook', $settings->get('school_facebook')) }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Instagram</label>
                        <input type="url" name="school_instagram"
                            value="{{ old('school_instagram', $settings->get('school_instagram')) }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>YouTube</label>
                        <input type="url" name="school_youtube"
                            value="{{ old('school_youtube', $settings->get('school_youtube')) }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Tiktok</label>
                        <input type="url" name="school_tiktok"
                            value="{{ old('school_tiktok', $settings->get('school_tiktok')) }}"
                            class="form-control">
                    </div>
                </div>

                <!-- PPDB -->
                <div class="tab-pane" id="ppdb-settings">
                    <div class="form-group">
                        <label>Informasi PPDB</label>
                        <textarea name="ppdb_info" class="form-control">{{ old('ppdb_info', $settings->get('ppdb_info')) }}</textarea>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
@endsection