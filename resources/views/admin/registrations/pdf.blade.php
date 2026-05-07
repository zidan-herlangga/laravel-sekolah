<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Data Pendaftar - {{ $schoolName }}</title>
    <style>
        /* Setup Halaman (Penting untuk PDF) */
        @page {
            margin: 1.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        /* Header Laporan */
        .report-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #444;
            padding-bottom: 15px;
        }

        .report-header h2 {
            margin: 0;
            text-transform: uppercase;
            font-size: 16pt;
            color: #1a5f7a;
        }

        .report-header p {
            margin: 5px 0 0;
            font-size: 10pt;
            color: #666;
        }

        /* Ringkasan Data */
        .summary-info {
            margin-bottom: 15px;
            width: 100%;
        }

        .summary-info td {
            border: none;
            padding: 2px 0;
        }

        /* Styling Tabel Utama */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Menjaga lebar kolom konsisten */
        }

        th {
            background-color: #1a5f7a;
            color: #ffffff;
            text-transform: uppercase;
            font-size: 9pt;
            letter-spacing: 0.5px;
            padding: 12px 8px;
            border: 1px solid #144d63;
        }

        td {
            padding: 10px 8px;
            border: 1px solid #e0e0e0;
            word-wrap: break-word;
        }

        /* Baris Zebra (Selingan Warna) */
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Baris saat hover (jika dilihat di browser) */
        tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Penomoran */
        .text-center {
            text-align: center;
        }

        /* Status Badge Style */
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 8pt;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
            /* Default style */
            background-color: #eee;
            color: #333;
        }

        /* Penyesuaian Kolom */
        .col-no {
            width: 30px;
        }

        .col-name {
            width: auto;
        }

        .col-nisn {
            width: 100px;
        }

        .col-school {
            width: 180px;
        }

        .col-status {
            width: 100px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10pt;
        }
    </style>
</head>

<body>
    <div class="report-header">
        <h2>LAPORAN PENDAFTARAN SISWA BARU</h2>
        <h2>{{ $schoolName }}</h2>
        <p>Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
    </div>

    <table class="summary-info">
        <tr>
            <td width="150">Tanggal Laporan</td>
            <td>: {{ date('d F Y') }}</td>
            <td width="150" style="text-align: right;">Total Pendaftar:</td>
            <td width="50" style="text-align: right;"><strong>{{ count($registrations) }}</strong></td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-name">Nama Calon Siswa</th>
                <th class="col-nisn">NISN</th>
                <th class="col-school">Asal Sekolah</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($registrations as $index => $reg)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ strtoupper($reg->name) }}</strong></td>
                    <td class="text-center">{{ $reg->nisn }}</td>
                    <td>{{ $reg->school_origin }}</td>
                    <td class="text-center">
                        <span class="badge">{{ $reg->status_label }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">Belum ada data pendaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
        <br><br>
        <p>Petugas Panitia,</p>
        <div style="height: 60px;"></div>
        <p><strong>( __________________________ )</strong></p>
    </div>
</body>

</html>
