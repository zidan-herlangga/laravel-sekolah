@extends('admin.layouts.app')

@section('page_title', 'Pengaturan Situs')
@section('breadcrumb', ' > Kelola Pengaturan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold"><i class="fas fa-cog mr-2 text-gray-600"></i>Pengaturan Situs</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf @method('PUT')

                <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#general">Umum</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact-info">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#social">Media Sosial</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#spmb-settings">SPMB</a></li>
                </ul>

                <div class="tab-content">
                    <!-- General -->
                    <div class="tab-pane active" id="general">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" name="school_name"
                                        value="{{ old('school_name', $settings['school_name'] ?? '') }}" required
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nama Singkat <span class="text-danger">*</span></label>
                                    <input type="text" name="school_short_name"
                                        value="{{ old('school_short_name', $settings['school_short_name'] ?? '') }}"
                                        required class="form-control" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <label>Motto</label>
                                    <input type="text" name="school_motto"
                                        value="{{ old('school_motto', $settings['school_motto'] ?? '') }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Sambutan Kepala Sekolah</label>
                                    <textarea name="headmaster_welcome" class="form-control tinymce" rows="6">{{ old('headmaster_welcome', $settings['headmaster_welcome'] ?? '') }}</textarea>
                                </div>
                            </div>

                            {{-- Verification Google Console --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Google Site Verification Code</label>
                                    <input type="text" name="google_site_verification"
                                        value="{{ old('google_site_verification', $settings['google_site_verification'] ?? '') }}"
                                        class="form-control" placeholder="Google Site Verification Code">
                                </div>

                                {{-- Verification Bing --}}
                                <div class="form-group">
                                    <label>Bing Site Verification Code</label>
                                    <input type="text" name="msvalidate.01"
                                        value="{{ old('msvalidate.01', $settings['msvalidate.01'] ?? '') }}"
                                        class="form-control" placeholder="Bing Site Verification Code">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="tab-pane" id="contact-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="school_address" class="form-control" rows="3">{{ old('school_address', $settings['school_address'] ?? '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="text" name="school_phone"
                                        value="{{ old('school_phone', $settings['school_phone'] ?? '') }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="school_email"
                                        value="{{ old('school_email', $settings['school_email'] ?? '') }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social -->
                    <div class="tab-pane" id="social">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fab fa-facebook mr-1"></i> Facebook URL</label>
                                    <input type="url" name="school_facebook"
                                        value="{{ old('school_facebook', $settings['school_facebook'] ?? '') }}"
                                        class="form-control" placeholder="https://facebook.com/...">
                                </div>
                                <div class="form-group">
                                    <label><i class="fab fa-instagram mr-1"></i> Instagram URL</label>
                                    <input type="url" name="school_instagram"
                                        value="{{ old('school_instagram', $settings['school_instagram'] ?? '') }}"
                                        class="form-control" placeholder="https://instagram.com/...">
                                </div>
                                <div class="form-group">
                                    <label><i class="fab fa-youtube mr-1"></i> YouTube URL</label>
                                    <input type="url" name="school_youtube"
                                        value="{{ old('school_youtube', $settings['school_youtube'] ?? '') }}"
                                        class="form-control" placeholder="https://youtube.com/...">
                                </div>
                                <div class="form-group">
                                    <label><i class="fab fa-tiktok mr-1"></i> Tiktok URL</label>
                                    <input type="url" name="school_tiktok"
                                        value="{{ old('school_tiktok', $settings['school_tiktok'] ?? '') }}"
                                        class="form-control" placeholder="https://tiktok.com/...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SPMB -->
                    <div class="tab-pane" id="spmb-settings">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Informasi SPMB</label>
                                    <textarea name="spmb_info" class="form-control tinymce" rows="5">{{ old('spmb_info', $settings['spmb_info'] ?? '') }}</textarea>
                                    <small class="text-muted">Informasi ini akan ditampilkan di halaman SPMB.</small>
                                </div>
                            </div>

                            {{-- Nonaktifkan Halaman SPMB --}}
                            <div class="col-md-4">
                                <div class="form-group mt-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="spmb_disabled" value="1"
                                            {{ ($settings['spmb_disabled'] ?? '') === '1' ? 'checked' : '' }}
                                            class="form-check-input" id="spmbDisabled">
                                        <label class="form-check-label" for="spmbDisabled">Nonaktifkan Halaman
                                            SPMB</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan
                        Pengaturan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
