@extends('admin.layouts.app')

@section('page_title', 'Pesan Masuk')
@section('breadcrumb', ' > ' . 'Pesan Masuk')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-envelope mr-2 text-danger"></i>Pesan Masuk
                    @if ($unreadCount > 0)
                        <span class="badge badge-warning ml-2">{{ $unreadCount }} baru</span>
                    @endif
                </h3>
                <div>
                    @if ($unreadCount > 0)
                        <form method="POST" action="{{ route('admin.contacts.mark-all-read') }}" class="d-inline"
                            onsubmit="return confirm('Tandai semua sudah dibaca?')">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check-double mr-1"></i>
                                Tandai Semua Dibaca</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (request('filter'))
                <div class="mb-3">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-default btn-sm"><i
                            class="fas fa-times mr-1"></i> Hapus Filter</a>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:40px">No</th>
                            <th>Pengirim</th>
                            <th>Email</th>
                            <th>Pesan</th>
                            <th style="width:110px">Tanggal</th>
                            <th style="width:100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr class="{{ !$contact->is_read ? 'bg-light-blue' : '' }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                    @if (!$contact->is_read)
                                        <i class="fas fa-circle text-primary" style="font-size:8px;"></i>
                                    @endif
                                </td>
                                <td class="font-weight-semibold {{ !$contact->is_read ? '' : 'text-muted' }}">
                                    {{ $contact->name }}</td>
                                <td><small>{{ $contact->email }}</small></td>
                                <td>{{ Str::limit($contact->message, 60) }}</td>
                                <td><small>{{ $contact->created_at->format('d M Y') }}</small></td>
                                <td>
                                    <a href="{{ route('admin.contacts.show', $contact) }}"
                                        class="btn btn-info btn-xs btn-flat" title="Baca"><i class="fas fa-eye"></i></a>
                                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                                        class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs btn-flat"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Tidak ada pesan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $contacts->links() }}</div>
        </div>
    </div>
@endsection
