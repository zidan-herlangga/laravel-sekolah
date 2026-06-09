@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold">Bank Soal CBT</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="submit" form="bulk-delete-form" id="bulk-delete-btn" class="btn btn-danger btn-sm shadow-sm"
                        style="display:none;" onclick="return confirm('Yakin hapus soal yang dipilih?')">
                        <i class="fas fa-trash mr-1"></i> Hapus Terpilih
                    </button>
                    <a href="{{ route('admin.examp.create') }}" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah Soal Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-body table-responsive p-0">
                    <form id="bulk-delete-form" method="POST" action="{{ route('admin.examp.bulk-delete') }}">
                        @csrf
                    <table class="table table-hover text-nowrap">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 40px"><input type="checkbox" id="select-all"></th>
                                <th style="width: 50px">No</th>
                                <th>Pertanyaan</th>
                                <th class="text-center">Kunci</th>
                                <th class="text-center">Poin</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($questions as $q)
                                <tr>
                                    <td><input type="checkbox" class="row-checkbox" name="ids[]" value="{{ $q->id }}"></td>
                                    <td>{{ ($questions->currentPage() - 1) * $questions->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="text-wrap" style="max-width: 400px;">
                                            {!! Str::limit(strip_tags($q->question_text), 80) !!}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success px-3 py-2">{{ $q->correct_answer }}</span>
                                    </td>
                                    <td class="text-center font-weight-bold">{{ $q->points }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.examp.edit', $q->id) }}" class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.examp.destroy', $q->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus soal ini?')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                        Belum ada data soal yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
                </div>
                <div class="card-footer bg-white">
                    <div class="float-right">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
