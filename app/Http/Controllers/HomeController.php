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

    public function ppdb()
    {
        $settings = $this->settingService;

        return view('pages.ppdb', compact('settings'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}