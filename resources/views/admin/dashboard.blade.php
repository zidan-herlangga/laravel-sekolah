@extends('admin.layouts.app')

@section('page_title', 'Dashboard')

@section('content')

<!-- Stat Boxes -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total_posts'] }}</h3>
                <p>Total Berita</p>
            </div>
            <div class="icon"><i class="fas fa-newspaper"></i></div>
            <a href="{{ route('admin.posts.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-amber">
            <div class="inner">
                <h3>{{ $stats['total_registrations'] }}</h3>
                <p>Pendaftar SPMB</p>
            </div>
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
            <a href="{{ route('admin.registrations.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['total_teachers'] }}</h3>
                <p>Guru & Staff</p>
            </div>
            <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <a href="{{ route('admin.teachers.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['unread_messages'] }}</h3>
                <p>Pesan Baru</p>
            </div>
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <a href="{{ route('admin.contacts.index') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Detail Stats -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold"><i class="fas fa-user-graduate mr-2 text-amber-600"></i>Status Pendaftar SPMB</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-around text-center py-3">
                    <div>
                        <div class="text-3xl font-weight-bold text-dark">{{ $stats['pending_registrations'] }}</div>
                        <div class="text-muted text-sm">Menunggu</div>
                    </div>
                    <div class="border-right border-left px-4">
                        <div class="text-3xl font-weight-bold text-success">{{ $stats['verified_registrations'] }}</div>
                        <div class="text-muted text-sm">Terverifikasi</div>
                    </div>
                    <div>
                        <div class="text-3xl font-weight-bold text-dark">{{ $stats['total_galleries'] }}</div>
                        <div class="text-muted text-sm">Foto Galeri</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold"><i class="fas fa-chart-pie mr-2 text-info"></i>Ringkasan Konten</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-around text-center py-3">
                    <div>
                        <div class="text-3xl font-weight-bold text-dark">{{ $stats['published_posts'] }}</div>
                        <div class="text-muted text-sm">Berita Terbit</div>
                    </div>
                    <div class="border-right border-left px-4">
                        <div class="text-3xl font-weight-bold text-dark">{{ $stats['total_staff'] }}</div>
                        <div class="text-muted text-sm">Staf</div>
                    </div>
                    <div>
                        <div class="text-3xl font-weight-bold text-primary">{{ $stats['total_posts'] - $stats['published_posts'] }}</div>
                        <div class="text-muted text-sm">Berita Draft</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Data -->
<div class="row">
    <!-- Recent Registrations -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold"><i class="fas fa-user-plus mr-2 text-amber-600"></i>Pendaftar Terbaru</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-light">
                            <tr><th>Nama</th><th>NISN</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @forelse($recentRegistrations as $reg)
                            <tr>
                                <td class="font-weight-semibold">{{ Str::limit($reg->name, 25) }}</td>
                                <td><code>{{ $reg->nisn }}</code></td>
                                <td>
                                    @php
                                        $colors = ['pending' => 'warning', 'verified' => 'success', 'rejected' => 'danger'];
                                        $labels = ['pending' => 'Menunggu', 'verified' => 'Verifikasi', 'rejected' => 'Ditolak'];
                                    @endphp
                                    <span class="badge badge-status badge-{{ $colors[$reg->status] ?? 'secondary' }}">
                                        {{ $labels[$reg->status] ?? $reg->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">Belum ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold"><i class="fas fa-envelope mr-2 text-danger"></i>Pesan Terbaru</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="thead-light">
                            <tr><th>Pengirim</th><th>Subjek</th><th></th></tr>
                        </thead>
                        <tbody>
                            @forelse($recentContacts as $msg)
                            <tr class="{{ !$msg->is_read ? 'font-weight-bold' : '' }}">
                                <td>{{ Str::limit($msg->name, 20) }}</td>
                                <td>{{ Str::limit($msg->message, 40) }}</td>
                                <td>
                                    @if(!$msg->is_read)
                                    <span class="badge badge-primary badge-status">Baru</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">Belum ada pesan</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection