@extends('admin.layouts.app')

@section('page_title', 'Kelola Guru & Staff')
@section('breadcrumb', ' > ' . 'Kelola Guru & Staff')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold"><i class="fas fa-chalkboard-teacher mr-2 text-success"></i>Guru &
                    Staff</h3>
                <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>
                    Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.teachers.index') }}" class="row mb-4">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari nama...">
                        <div class="input-group-append"><button type="submit" class="btn btn-default"><i
                                    class="fas fa-search"></i></button></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">Semua Tipe</option>
                        <option value="guru" {{ request('type') === 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="staff" {{ request('type') === 'staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:60px">Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th style="width:80px">Tipe</th>
                            <th style="width:80px">Urutan</th>
                            <th style="width:140px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teachers as $teacher)
                            <tr>
                                <td><img src="{{ $teacher->photo ? Storage::url($teacher->photo) : 'https://via.placeholder.com/50x50?text=' . urlencode(substr($teacher->name, 0, 1)) }}"
                                        class="img-thumb" alt=""></td>
                                <td class="font-weight-semibold">{{ $teacher->name }}</td>
                                <td>{{ $teacher->position ?? '-' }}</td>
                                <td>
                                    <span
                                        class="badge badge-status {{ $teacher->type === 'guru' ? 'badge-success' : 'badge-info' }}">
                                        {{ ucfirst($teacher->type) }}
                                    </span>
                                </td>
                                <td>{{ $teacher->order }}</td>
                                <td>
                                    <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                        class="btn btn-info btn-xs btn-flat"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}"
                                        class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs btn-flat"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center ">
                {{ $teachers->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
