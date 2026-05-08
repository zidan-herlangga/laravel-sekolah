@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 font-weight-bold">Hasil Ujian Seleksi</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success shadow-sm">
                <div class="card-header border-0">
                    <h3 class="card-title text-muted text-sm">Data Nilai Peserta</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Pendaftaran</th>
                                <th>Nama Peserta</th>
                                <th class="text-center">Skor</th>
                                <th class="text-center">Mulai</th>
                                <th class="text-center">Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $res)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span
                                            class="font-weight-bold text-primary">{{ $registration[$res->user_id] ?? '-' }}</span>
                                    </td>
                                    <td>{{ $res->user->name }}</td>
                                    <td class="text-center">
                                        <div class="badge badge-pill badge-dark px-3 py-2" style="font-size: 1rem">
                                            {{ $res->score }}
                                        </div>
                                    </td>
                                    <td class="text-center text-sm">
                                        {{ $res->start_time ? $res->start_time->format('H:i:s') : '-' }}
                                    </td>
                                    <td class="text-center text-sm">
                                        @if ($res->end_time)
                                            {{ $res->end_time->format('H:i:s') }}
                                        @else
                                            <span class="badge badge-warning text-xs">Sedang Mengerjakan</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada peserta yang menyelesaikan ujian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
