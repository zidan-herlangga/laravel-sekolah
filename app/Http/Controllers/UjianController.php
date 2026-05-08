<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    // Halaman Instruksi
    public function index() {
        $countQuestions = Question::count();

        $result = ExamResult::where('user_id', Auth::id())->first();
        if ($result && $result->end_time) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah menyelesaikan ujian.');
        }
        return view('pages.pendaftar.ujian.index', compact('countQuestions'));
    }

    // Mulai Ujian (Generate/Ambil Soal)
    public function start() {
        $questions = Question::inRandomOrder()->take(50)->get();
        
        $result = ExamResult::firstOrCreate(
            ['user_id' => auth()->id()],
            ['start_time' => now()]
        );

        // Ambil start_time dari database, tambahkan 1 jam
        $endTime = $result->start_time->copy()->addHour();

        // Pastikan variabel ini dikirim ke view
        return view('pages.pendaftar.ujian.start', compact('questions', 'endTime'));
    }

    // Simpan Jawaban (AJAX atau Form Submit)
    public function submit(Request $request) {
        $userAnswers = $request->input('answers'); // Array [question_id => answer]
        // array_keys(): Argument #1 ($array) must be of type array, null given
        if (!is_array($userAnswers)) {
            return redirect()->route('dashboard')->with('error', 'Data jawaban tidak valid.');
        }
        $questions = Question::whereIn('id', array_keys($userAnswers))->get();
        
        $score = 0;
        foreach ($questions as $q) {
            if ($userAnswers[$q->id] == $q->correct_answer) {
                $score += $q->points;
            }
        }

        ExamResult::where('user_id', Auth::id())->update([
            'score' => $score,
            'end_time' => Carbon::now(),
            'answers' => json_encode($userAnswers)
        ]);

        return redirect()->route('dashboard')->with('success', 'Ujian telah selesai. Nilai Anda telah direkam.');
    }
}