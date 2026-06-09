@extends('admin.layouts.app')

@section('page_title', 'Detail Pembayaran')
@section('breadcrumb', ' > ' . ' Pembayaran' . ' > ' . 'Detail')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-credit-card mr-2 text-primary"></i>Detail Pembayaran
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.payments.index') }}" class="btn btn-default btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="text-muted" style="width: 180px;">ID Transaksi</td>
                            <td class="font-weight-bold">{{ $payment->transaction_id }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status</td>
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
                        </tr>
                        <tr>
                            <td class="text-muted">Jumlah</td>
                            <td class="font-weight-bold text-lg">{{ 'Rp ' . number_format($payment->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Metode</td>
                            <td>{{ $payment->method ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Waktu Dibayar</td>
                            <td>{{ $payment->paid_at?->format('d F Y H:i:s') ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Waktu Kedaluwarsa</td>
                            <td>{{ $payment->expired_at?->format('d F Y H:i:s') ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Dibuat</td>
                            <td>{{ $payment->created_at->format('d F Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-user-graduate mr-1"></i>Data Pendaftar</h5>
                        </div>
                        <div class="card-body py-2">
                            <table class="table table-borderless table-sm mb-0">
                                <tr>
                                    <td class="text-muted" style="width: 120px;">Nama</td>
                                    <td class="font-weight-bold">{{ $payment->registration->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">NISN</td>
                                    <td>{{ $payment->registration->nisn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">No. Daftar</td>
                                    <td><code>{{ $payment->registration->registration_number ?? '-' }}</code></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Telepon</td>
                                    <td>{{ $payment->registration->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email</td>
                                    <td>{{ $payment->registration->email ?? ($payment->user?->email ?? '-') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if ($payment->raw_response)
                        <div class="card bg-light mt-3">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fas fa-code mr-1"></i>Response Midtrans</h5>
                            </div>
                            <div class="card-body py-2">
                                <pre class="mb-0" style="font-size: 11px; max-height: 200px; overflow-y: auto;">{{ json_encode($payment->raw_response, JSON_PRETTY_PRINT) }}</pre>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
