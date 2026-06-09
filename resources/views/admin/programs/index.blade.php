@extends('admin.layouts.app')

@section('page_title', 'Kelola Program Unggulan')
@section('breadcrumb', " > " ."Kelola Program Unggulan")

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h3 class="card-title font-weight-bold"><i class="fas fa-star mr-2 text-amber-500"></i>Program Unggulan</h3>
            <div class="d-flex gap-2">
                <button type="submit" form="bulk-delete-form" id="bulk-delete-btn" class="btn btn-danger btn-sm"
                    style="display:none;" onclick="return confirm('Yakin hapus program yang dipilih?')">
                    <i class="fas fa-trash mr-1"></i> Hapus Terpilih
                </button>
                <a href="{{ route('admin.programs.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i> Tambah</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="bulk-delete-form" method="POST" action="{{ route('admin.programs.bulk-delete') }}">
            @csrf
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th style="width:40px"><input type="checkbox" id="select-all"></th>
                        <th style="width:60px">Ikon</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th style="width:80px">Status</th>
                        <th style="width:80px">Urutan</th>
                        <th style="width:140px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td><input type="checkbox" class="row-checkbox" name="ids[]" value="{{ $program->id }}"></td>
                        <td class="text-center"><i class="{{ $program->icon ?? 'fas fa-star' }} text-xl text-amber-500"></i></td>
                        <td class="font-weight-semibold">{{ $program->title }}</td>
                        <td><small>{{ Str::limit($program->description, 80) }}</small></td>
                        <td>
                            @if($program->is_active)
                            <span class="badge badge-status badge-success">Aktif</span>
                            @else
                            <span class="badge badge-status badge-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $program->order }}</td>
                        <td>
                            <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-info btn-xs btn-flat"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs btn-flat"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </form>
        <div class="mt-3">{{ $programs->links() }}</div>
    </div>
</div>
@endsection