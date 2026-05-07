@extends('admin.layouts.app')

@section('page_title', 'Detail Pendaftar')
@section('breadcrumb', ' > ' . 'Kelola Pendaftar > Detail Pendaftar')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <!-- Data Pribadi -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-user mr-2 text-amber-600"></i>Data Pribadi</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width:180px" class="font-weight-semibold text-muted">Nama Lengkap</td>
                            <td>{{ $registration->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold text-muted">NISN</td>
                            <td><code>{{ $registration->nisn }}</code></td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold text-muted">Jenis Kelamin</td>
                            <td>{{ $registration->gender_label }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold text-muted">Tempat, Tanggal Lahir</td>
                            <td>{{ $registration->birth_place }}, {{ $registration->birth_date?->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold text-muted">Asal Sekolah</td>
                            <td>{{ $registration->school_origin }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold text-muted">Telepon</td>
                            <td>{{ $registration->phone }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold text-muted">Email</td>
                            <td>{{ $registration->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold text-muted">Alamat</td>
                            <td>{{ $registration->address ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-users mr-2 text-info"></i>Data Orang Tua</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td style="width:180px" class="font-weight-semibold text-muted">Nama Orang Tua</td>
                            <td>{{ $registration->parent_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-semibold text-muted">Telepon Orang Tua</td>
                            <td>{{ $registration->parent_phone ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Dokumen Upload -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-file-alt mr-2 text-secondary"></i>Dokumen
                        Terupload</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <small class="d-block text-muted">Kartu Keluarga</small>
                            @if ($registration->kartu_keluarga)
                                <a href="{{ asset('storage/' . $registration->kartu_keluarga) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Lihat</a>
                            @else
                                <span class="badge badge-secondary">Belum Upload</span>
                            @endif
                        </div>
                        <div class="col-md-4 mb-2">
                            <small class="d-block text-muted">Ijazah / SKL</small>
                            @if ($registration->ijazah)
                                <a href="{{ asset('storage/' . $registration->ijazah) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Lihat</a>
                            @else
                                <span class="badge badge-secondary">Belum Upload</span>
                            @endif
                        </div>
                        <div class="col-md-4 mb-2">
                            <small class="d-block text-muted">Akte Kelahiran</small>
                            @if ($registration->akte_kelahiran)
                                <a href="{{ asset('storage/' . $registration->akte_kelahiran) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Lihat</a>
                            @else
                                <span class="badge badge-secondary">Belum Upload</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Status Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><i class="fas fa-clipboard-check mr-2 text-success"></i>Status
                        Verifikasi</h3>
                </div>
                <div class="card-body">
                    <div class="text-center py-3">
                        <i
                            class="fas {{ $registration->status == 'verified' ? 'fa-check-circle' : ($registration->status == 'rejected' ? 'fa-times-circle' : 'fa-hourglass-half') }} text-4xl text-{{ $registration->status_color }} mb-2"></i>
                        <h4 class="font-weight-bold text-{{ $registration->status_color }}">
                            {{ $registration->status_label }}</h4>
                        <small class="text-muted">Terdaftar: {{ $registration->created_at->format('d F Y, H:i') }}</small>
                    </div>

                    <!-- TOMBOL KHUSUS: VERIFIKASI DOKUMEN LENGKAP -->
                    @if ($registration->status == 'pending' && $registration->documents_complete)
                        <div class="alert alert-info p-2">
                            <small><strong>Info:</strong> Dokumen terlihat lengkap. Klik tombol di bawah untuk memverifikasi
                                dan mengirim jadwal tes.</small>
                        </div>

                        <form method="POST"
                            action="{{ route('admin.registrations.verify-documents', $registration->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-check-double mr-1"></i> Verifikasi & Kirim Jadwal
                            </button>
                        </form>
                    @endif

                    <!-- Form Ubah Status Manual -->
                    <form method="POST" action="{{ route('admin.registrations.update', $registration) }}">
                        @csrf @method('PUT')
                        <div class="form-group mt-3">
                            <label class="font-weight-semibold">Ubah Status Manual</label>
                            <select name="status" required class="form-control">
                                <option value="pending" {{ $registration->status === 'pending' ? 'selected' : '' }}>
                                    Menunggu</option>
                                <option value="verified" {{ $registration->status === 'verified' ? 'selected' : '' }}>
                                    Terverifikasi</option>
                                <option value="rejected" {{ $registration->status === 'rejected' ? 'selected' : '' }}>
                                    Ditolak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-semibold">Catatan (Untuk Siswa)</label>
                            {{-- Kolom notes ini akan berisi jadwal tes jika menggunakan tombol Verifikasi --}}
                            <textarea name="notes" class="form-control" rows="3" placeholder="Catatan verifikasi / Jadwal Tes">{{ old('notes', $registration->notes) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan
                            Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.registrations.index') }}" class="btn btn-default"><i
                class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar</a>
    </div>
@endsection
