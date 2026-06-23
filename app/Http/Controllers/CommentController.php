<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()
            ->approved()
            ->root()
            ->with('replies')
            ->latest()
            ->get();

        return response()->json($comments);
    }

    public function store(Request $request, Post $post)
    {
        $rules = [
            'body' => 'required|string|max:5000',
            'parent_id' => 'nullable|exists:comments,id',
            'email' => 'nullable|email|max:255',
        ];

        if (!$request->user()) {
            $rules['name'] = 'required|string|max:100';
        }

        $data = $request->validate($rules);

        if ($request->user()) {
            $data['user_id'] = $request->user()->id;
            $data['name'] = $request->user()->name;
            $data['email'] = $request->user()->email;
        }

        $data['post_id'] = $post->id;
        $data['is_approved'] = false;

        $comment = Comment::create($data);

        if ($comment->parent_id) {
            $comment->load('parent.user');
        }

        return response()->json($comment, 201);
    }
}
