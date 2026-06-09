<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\ExamResult;
use App\Models\Registration;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    private function checkVerified(): ?Registration
    {
        $registration = Registration::where('user_id', Auth::id())->where('status', 'verified')->first();
        if (!$registration) {
            return null;
        }

        return $registration;
    }

    // Halaman Instruksi
    public function index() {
        $registration = $this->checkVerified();
        if (!$registration) {
            return redirect()->route('dashboard')->with('error', 'Akun Anda belum terverifikasi. Silakan tunggu konfirmasi admin.');
        }

        $countQuestions = Question::count();

        $result = ExamResult::where('user_id', Auth::id())->first();
        if ($result && $result->end_time) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah menyelesaikan ujian.');
        }

        $settings = app(SettingService::class);
        $examDate = $settings->get('spmb_exam_date');
        $examTime = $settings->get('spmb_exam_time');
        $examLocation = $settings->get('spmb_exam_location');

        $examStart = null;
        $examCanStart = true;

        if ($examDate && $examTime && $examDate !== '-' && $examTime !== '-') {
            try {
                $examStart = Carbon::parse($examDate . ' ' . $examTime);
                $examCanStart = now()->greaterThanOrEqualTo($examStart);
            } catch (\Exception $e) {
                $examStart = null;
            }
        }

        return view('pages.pendaftar.ujian.index', compact(
            'countQuestions', 'examStart', 'examCanStart', 'examLocation'
        ));
    }

    public function start() {
        $registration = $this->checkVerified();
        if (!$registration) {
            return redirect()->route('dashboard')->with('error', 'Akun Anda belum terverifikasi. Silakan tunggu konfirmasi admin.');
        }

        $settings = app(SettingService::class);
        $examDate = $settings->get('spmb_exam_date');
        $examTime = $settings->get('spmb_exam_time');

        if ($examDate && $examTime && $examDate !== '-' && $examTime !== '-') {
            try {
                $examStart = Carbon::parse($examDate . ' ' . $examTime);
                if (now()->lessThan($examStart)) {
                    return redirect()->route('pendaftar.ujian.index')->with('error', 'Ujian belum dimulai. Silakan tunggu hingga waktu yang ditentukan.');
                }
            } catch (\Exception $e) {
                // abaikan jika format tanggal tidak valid
            }
        }

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