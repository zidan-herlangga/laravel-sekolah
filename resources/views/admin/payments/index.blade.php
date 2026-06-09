@extends('admin.layouts.app')

@section('page_title', 'Data Pembayaran SPMB')
@section('breadcrumb', ' > ' . 'Pembayaran')

@section('content')
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="info-box bg-dark">
                <span class="info-box-icon bg-gray-800"><i class="fas fa-credit-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Transaksi</span>
                    <span class="info-box-number">{{ $statusCounts['total'] }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-success">
                <span class="info-box-icon bg-emerald"><i class="fas fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Berhasil</span>
                    <span class="info-box-number">{{ $statusCounts['success'] }}</span>
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
            <div class="info-box bg-danger">
                <span class="info-box-icon bg-red"><i class="fas fa-times-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Gagal/Kedaluwarsa</span>
                    <span class="info-box-number">{{ $statusCounts['expired'] + $statusCounts['failed'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h3 class="card-title font-weight-bold"><i class="fas fa-credit-card mr-2 text-primary"></i>Daftar Pembayaran</h3>
                <div class="d-flex gap-2">
                    <form method="POST" action="{{ route('admin.payments.export') }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" style="border-radius:4px">
                            <i class="fas fa-file-csv mr-1"></i> Export CSV
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.payments.export-pdf') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius:4px">
                            <i class="fas fa-file-pdf mr-1"></i> Export PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.payments.index') }}" class="row mb-4">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari nama, NISN, atau no. pendaftaran...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Berhasil</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Kedaluwarsa</option>
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Pendaftar</th>
                            <th>No. Pendaftaran</th>
                            <th>NISN</th>
                            <th>Tagihan</th>
                            <th>Status</th>
                            <th>Metode</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td>{{ $payments->firstItem() + $loop->index }}</td>
                                <td class="font-weight-semibold">
                                    {{ Str::limit($payment->registration->name ?? '-', 30) }}
                                </td>
                                <td><code>{{ $payment->registration->registration_number ?? '-' }}</code></td>
                                <td>{{ $payment->registration->nisn ?? '-' }}</td>
                                <td class="text-nowrap">{{ 'Rp ' . number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $badgeMap = [
                                            'success' => ['bg-success', 'Berhasil'],
                                            'pending' => ['bg-warning', 'Menunggu'],
                                            'expired' => ['bg-secondary', 'Kedaluwarsa'],
                                            'failed' => ['bg-danger', 'Gagal'],
                                        ];
                                        $badge = $badgeMap[$payment->status] ?? ['bg-secondary', $payment->status];
                                    @endphp
                                    <span class="badge {{ $badge[0] }}">{{ $badge[1] }}</span>
                                </td>
                                <td><small>{{ $payment->method ?? '-' }}</small></td>
                                <td><small>{{ $payment->paid_at?->format('d M Y H:i') ?? $payment->created_at->format('d M Y') }}</small></td>
                                <td>
                                    <a href="{{ route('admin.payments.show', $payment) }}"
                                        class="btn btn-info btn-xs btn-flat" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">Belum ada data pembayaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $payments->links() }}</div>
        </div>
    </div>
@endsection
