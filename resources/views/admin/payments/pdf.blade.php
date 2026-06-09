<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Data Pembayaran - {{ $schoolName }}</title>
    <style>
        @page { margin: 20px; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            color: #333;
        }
        h2 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 4px;
        }
        .subtitle {
            text-align: center;
            font-size: 11px;
            color: #666;
            margin-bottom: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #0d3b4f;
            color: #fff;
            padding: 7px 6px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
        }
        td {
            padding: 5px 6px;
            border-bottom: 1px solid #e0e0e0;
        }
        tr:nth-child(even) td {
            background: #f9f9f9;
        }
        .text-right { text-align: right; }
        .font-bold { font-weight: 700; }
        .badge-success { color: #065f46; }
        .badge-warning { color: #92400e; }
        .badge-danger { color: #991b1b; }
        .badge-secondary { color: #666; }
    </style>
</head>
<body>
    <h2>{{ $schoolName }}</h2>
    <div class="subtitle">Data Pembayaran SPMB - {{ date('d/m/Y') }}</div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>No. Daftar</th>
                <th>NISN</th>
                <th>Tagihan</th>
                <th>Status</th>
                <th>Metode</th>
                <th>ID Transaksi</th>
                <th>Dibayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="font-bold">{{ $p->registration->name ?? '-' }}</td>
                    <td>{{ $p->registration->registration_number ?? '-' }}</td>
                    <td>{{ $p->registration->nisn ?? '-' }}</td>
                    <td class="text-right">{{ 'Rp ' . number_format($p->amount, 0, ',', '.') }}</td>
                    <td>
                        @php
                            $map = ['success' => 'Berhasil', 'pending' => 'Menunggu', 'expired' => 'Kedaluwarsa', 'failed' => 'Gagal'];
                        @endphp
                        {{ $map[$p->status] ?? $p->status }}
                    </td>
                    <td>{{ $p->method ?? '-' }}</td>
                    <td>{{ $p->transaction_id }}</td>
                    <td>{{ $p->paid_at?->format('d/m/Y') ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="9" style="text-align:center;padding:20px;color:#999;">Tidak ada data pembayaran.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
