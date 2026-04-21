@extends('admin.layouts.app')

@section('page_title', 'Detail Pesan')
@section('breadcrumb', " > " . "Kelola Pesan > Detail Pesan")

@section('content')
<div class="card" style="max-width:700px;">
    <div class="card-header">
        <h3 class="card-title font-weight-bold"><i class="fas fa-envelope-open mr-2 text-danger"></i>Detail Pesan</h3>
    </div>
    <div class="card-body">
        <table class="table table-borderless table-sm mb-4">
            <tr><td style="width:120px" class="font-weight-semibold text-muted">Pengirim</td><td class="font-weight-semibold">{{ $contact->name }}</td></tr>
            <tr><td class="font-weight-semibold text-muted">Email</td><td>{{ $contact->email }}</td></tr>
            <tr><td class="font-weight-semibold text-muted">Tanggal</td><td>{{ $contact->created_at->format('d F Y, H:i WIB') }}</td></tr>
            <tr><td class="font-weight-semibold text-muted">Status</td>
                <td>
                    @if($contact->is_read)
                    <span class="badge badge-status badge-success">Sudah Dibaca</span>
                    @else
                    <span class="badge badge-status badge-primary">Belum Dibaca</span>
                    @endif
                </td>
            </tr>
        </table>

        <div class="bg-gray-100 rounded-xl p-5">
            <label class="font-weight-semibold text-muted text-sm d-block mb-2">Isi Pesan:</label>
            <p class="text-dark-800 leading-relaxed" style="white-space:pre-wrap;">{{ $contact->message }}</p>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-default"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
    </div>
</div>
@endsection