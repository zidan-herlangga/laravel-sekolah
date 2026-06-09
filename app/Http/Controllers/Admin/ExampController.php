<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\ExamResult;
use App\Models\Registration;
use Illuminate\Http\Request;

class ExampController extends Controller
{
    // List Semua Soal
    public function index() {
        $questions = Question::latest()->paginate(10);
        // Sesuaikan path view dengan folder anda
        return view('admin.examp.index', compact('questions')); 
    }

    // Form Tambah Soal
    public function create() {
        return view('admin.examp.create');
    }

    // Simpan Soal
    public function store(Request $request) {
        $data = $request->validate([
            'question_text' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required|in:A,B,C,D',
            'points' => 'required|numeric'
        ]);

        Question::create($data);
        return redirect()->route('admin.examp.index')->with('success', 'Soal berhasil ditambahkan');
    }

    // Edit Soal
    public function edit($id) {
        $exam = Question::findOrFail($id);
        return view('admin.examp.edit', compact('exam'));
    }

    // Update Soal
    public function update(Request $request, $id) {
        $data = $request->validate([
            'question_text' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required|in:A,B,C,D',
            'points' => 'required|numeric'
        ]);
    
        $exam = Question::findOrFail($id);
        $exam->update($data);
        return redirect()->route('admin.examp.index')->with('success', 'Soal berhasil diperbarui');
    }

    // Hapus Soal
    public function destroy($id) {
        $exam = Question::findOrFail($id);
        $exam->delete();
        return redirect()->route('admin.examp.index')->with('success', 'Soal berhasil dihapus');
    }

    public function bulkDelete(Request $request) {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }
        Question::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', count($ids) . ' soal berhasil dihapus.');
    }

    // Lihat Hasil Ujian Pendaftar
    public function results() {

        // no daftar 
        $registration = Registration::with('user')->get()->pluck('registration_number', 'user_id');
        
        $results = ExamResult::with('user')->latest()->paginate(20);
        return view('admin.examp.results', compact('results', 'registration'));
    }
}