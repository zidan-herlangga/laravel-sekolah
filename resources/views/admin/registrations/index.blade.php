@extends('admin.layouts.app')

@section('page_title', 'Data Pendaftar SPMB')
@section('breadcrumb', ' > ' . 'Pendaftar SPMB')

@section('content')
    <!-- Status Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="info-box bg-dark">
                <span class="info-box-icon bg-gray-800"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total</span>
                    <span class="info-box-number">{{ $statusCounts['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-warning">
                <span class="info-box-icon bg-amber"><i class="fas fa-hourglass-half"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Menunggu</span>
                    <span class="info-box-number">{{ $statusCounts['pending'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-success">
                <span class="info-box-icon bg-emerald"><i class="fas fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Terverifikasi</span>
                    <span class="info-box-number">{{ $statusCounts['verified'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-danger">
                <span class="info-box-icon bg-red"><i class="fas fa-times-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ditolak</span>
                    <span class="info-box-number">{{ $statusCounts['rejected'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h3 class="card-title font-weight-bold"><i class="fas fa-user-graduate mr-2 text-amber-600"></i>Daftar
                    Pendaftar</h3>
                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" form="bulk-delete-form" id="bulk-delete-btn" class="btn btn-danger btn-sm"
                        style="border-radius:4px; display:none;" onclick="return confirm('Yakin hapus data yang dipilih?')">
                        <i class="fas fa-trash mr-1"></i> Hapus Terpilih
                    </button>
                    <form method="POST" action="{{ route('admin.registrations.export') }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" style="border-radius:4px">
                            <i class="fas fa-file-csv mr-1"></i> Export CSV
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.registrations.export-pdf') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius:4px">
                            <i class="fas fa-file-pdf mr-1"></i> Export PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Search & Filter -->
            <form method="GET" action="{{ route('admin.registrations.index') }}" class="row mb-4">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari nama atau NISN...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Terverifikasi
                        </option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
            </form>

            <!-- Table -->
            <form id="bulk-delete-form" method="POST" action="{{ route('admin.registrations.bulk-delete') }}">
                @csrf
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 40px;"><input type="checkbox" id="select-all"></th>
                            <th style="width: 40px;">#</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Asal Sekolah</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                            <tr>
                                <td><input type="checkbox" class="row-checkbox" name="ids[]" value="{{ $reg->id }}"></td>
                                <td>{{ $registrations->firstItem() + $loop->index }}</td>
                                <td class="font-weight-semibold">{{ Str::limit($reg->name, 30) }}</td>
                                <td><code>{{ $reg->nisn }}</code></td>
                                <td>{{ Str::limit($reg->school_origin, 25) }}</td>
                                <td><small>{{ $reg->phone }}</small></td>
                                <td>
                                    {{-- Menggunakan Accessor dari Model --}}
                                    <span class="badge badge-status badge-{{ $reg->status_color }}">
                                        {{ $reg->status_label }}
                                    </span>
                                </td>
                                <td><small>{{ $reg->created_at->format('d M Y') }}</small></td>
                                <td>
                                    <a href="{{ route('admin.registrations.show', $reg) }}"
                                        class="btn btn-info btn-xs btn-flat" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.registrations.destroy', $reg) }}"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus data pendaftar ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs btn-flat" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">Tidak ada data pendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </form>
            <div class="mt-3">{{ $registrations->links() }}</div>
        </div>
    </div>
@endsection
