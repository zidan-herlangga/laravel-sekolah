@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 font-weight-bold text-dark">Edit Soal</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.examp.update', $exam->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Teks Pertanyaan</label>
                                    <textarea name="question_text" id="summernote" class="form-control @error('question_text') is-invalid @enderror">{{ old('question_text', $exam->question_text) }}</textarea>
                                    @error('question_text')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pilihan A</label>
                                            <input type="text" name="option_a" class="form-control"
                                                value="{{ old('option_a', $exam->option_a) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilihan B</label>
                                            <input type="text" name="option_b" class="form-control"
                                                value="{{ old('option_b', $exam->option_b) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pilihan C</label>
                                            <input type="text" name="option_c" class="form-control"
                                                value="{{ old('option_c', $exam->option_c) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pilihan D</label>
                                            <input type="text" name="option_d" class="form-control"
                                                value="{{ old('option_d', $exam->option_d) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h3 class="card-title font-weight-bold">Pengaturan</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kunci Jawaban</label>
                                    <select name="correct_answer" class="form-control custom-select" required>
                                        <option value="">-- Pilih Kunci --</option>
                                        @foreach (['A', 'B', 'C', 'D'] as $opt)
                                            <option value="{{ $opt }}"
                                                {{ old('correct_answer', $exam->correct_answer) == $opt ? 'selected' : '' }}>
                                                Opsi {{ $opt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Poin Soal</label>
                                    <input type="number" name="points" class="form-control"
                                        value="{{ old('points', $exam->points) }}" required>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary btn-block font-weight-bold py-2">
                                    <i class="fas fa-save mr-1"></i> Simpan Soal
                                </button>
                                <a href="{{ route('admin.examp.index') }}" class="btn btn-default btn-block">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                placeholder: 'Tuliskan pertanyaan di sini...'
            });
        });
    </script>
@endpush
