<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Teacher;
use App\Models\Gallery;
use App\Models\Program;
use App\Services\SettingService;

class HomeController extends Controller
{
    public function __construct(
        private SettingService $settingService
    ) {}

    public function index()
    {
        $programs = Program::active()->ordered()->take(6)->get();
        $posts = Post::published()->latestFirst()->take(3)->get();
        $galleries = Gallery::ordered()->take(8)->get();
        $headmaster = Teacher::guru()->ordered()->first();
        $settings = $this->settingService;

        return view('pages.home', compact('programs', 'posts', 'galleries', 'headmaster', 'settings'));
    }

    public function dashboard()
    {
        $user = auth()->user();
        // Ambil data pendaftaran jika user sudah pernah mengisi form SPMB
        $registration = \App\Models\Registration::where('user_id', $user->id)->first();

        return view('pages.pendaftar.dashboard', compact('user', 'registration'));
    }

    public function profile()
    {
        $registration = \App\Models\Registration::where('user_id', auth()->id())->first();
        
        if (!$registration) {
            return redirect()->route('spmb')->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        return view('pages.pendaftar.profile', compact('registration'));
    }

    public function about()
    {
        $teachers = Teacher::guru()->ordered()->get();
        $staff = Teacher::staff()->ordered()->get();

        return view('pages.about', compact('teachers', 'staff'));
    }

    public function berita()
    {
        $posts = Post::published()->latestFirst()->paginate(6);

        return view('pages.berita', compact('posts'));
    }

    public function beritaDetail(string $slug)
    {   
        $post = Post::published()->where('slug', $slug)->firstOrFail();
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->latestFirst()
            ->take(3)
            ->get();

        return view('pages.berita-detail', compact('post', 'relatedPosts'));
    }

    public function spmb()
    {
        $settings = $this->settingService;

        return view('pages.pendaftar.spmb', compact('settings'));
    }

    public function contact()
    {
        $settings = $this->settingService;
        
        return view('pages.contact', compact('settings'));
    }
}