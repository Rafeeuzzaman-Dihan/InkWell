<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('home', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with(['comments.user'])->findOrFail($id);

        return view('posts.show', compact('post'));
    }
}
