<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Teacher;
use App\Models\Registration;
use App\Models\Contact;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(auth()->check(), auth()->user());
        $stats = [
            'total_posts' => Post::count(),
            'published_posts' => Post::published()->count(),
            'total_registrations' => Registration::count(),
            'pending_registrations' => Registration::pending()->count(),
            'verified_registrations' => Registration::verified()->count(),
            'total_teachers' => Teacher::guru()->count(),
            'total_staff' => Teacher::staff()->count(),
            'total_galleries' => Gallery::count(),
            'unread_messages' => Contact::unread()->count(),
        ];

        $recentRegistrations = Registration::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();
        $recentPosts = Post::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations', 'recentContacts', 'recentPosts'));
    }
}