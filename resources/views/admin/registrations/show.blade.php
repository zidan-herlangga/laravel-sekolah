@extends('admin.layouts.app')

@section('page_title', 'Detail Pendaftar')
@section('breadcrumb', " > " . "Kelola Pendaftar > Detail Pendaftar")

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-user mr-2 text-amber-600"></i>Data Pribadi</h3></div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr><td style="width:180px" class="font-weight-semibold text-muted">Nama Lengkap</td><td>{{ $registration->name }}</td></tr>
                    <tr><td class="font-weight-semibold text-muted">NISN</td><td><code>{{ $registration->nisn }}</code></td></tr>
                    <tr><td class="font-weight-semibold text-muted">Jenis Kelamin</td><td>{{ $registration->gender_label }}</td></tr>
                    <tr><td class="font-weight-semibold text-muted">Tempat, Tanggal Lahir</td><td>{{ $registration->birth_place }}, {{ $registration->birth_date?->format('d F Y') }}</td></tr>
                    <tr><td class="font-weight-semibold text-muted">Asal Sekolah</td><td>{{ $registration->school_origin }}</td></tr>
                    <tr><td class="font-weight-semibold text-muted">Telepon</td><td>{{ $registration->phone }}</td></tr>
                    <tr><td class="font-weight-semibold text-muted">Email</td><td>{{ $registration->email ?? '-' }}</td></tr>
                    <tr><td class="font-weight-semibold text-muted">Alamat</td><td>{{ $registration->address ?? '-' }}</td></tr>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-users mr-2 text-info"></i>Data Orang Tua</h3></div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr><td style="width:180px" class="font-weight-semibold text-muted">Nama Orang Tua</td><td>{{ $registration->parent_name ?? '-' }}</td></tr>
                    <tr><td class="font-weight-semibold text-muted">Telepon Orang Tua</td><td>{{ $registration->parent_phone ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Status Card -->
        <div class="card">
            <div class="card-header"><h3 class="card-title font-weight-bold"><i class="fas fa-clipboard-check mr-2 text-success"></i>Status Verifikasi</h3></div>
            <div class="card-body">
                @php
                    $colors = ['pending' => 'warning', 'verified' => 'success', 'rejected' => 'danger'];
                    $labels = ['pending' => 'Menunggu Verifikasi', 'verified' => 'Terverifikasi', 'rejected' => 'Ditolak'];
                    $icons = ['pending' => 'fa-hourglass-half', 'verified' => 'fa-check-circle', 'rejected' => 'fa-times-circle'];
                @endphp
                <div class="text-center py-3">
                    <i class="fas {{ $icons[$registration->status] }} text-4xl text-{{ $colors[$registration->status] }} mb-2"></i>
                    <h4 class="font-weight-bold text-{{ $colors[$registration->status] }}">{{ $labels[$registration->status] }}</h4>
                    <small class="text-muted">Terdaftar: {{ $registration->created_at->format('d F Y, H:i') }}</small>
                </div>

                <form method="POST" action="{{ route('admin.registrations.update', $registration) }}">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="font-weight-semibold">Ubah Status</label>
                        <select name="status" required class="form-control">
                            <option value="pending" {{ $registration->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="verified" {{ $registration->status === 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="rejected" {{ $registration->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold">Catatan</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Catatan verifikasi (opsional)">{{ old('notes', $registration->notes) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('admin.registrations.index') }}" class="btn btn-default"><i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar</a>
</div>
@endsection