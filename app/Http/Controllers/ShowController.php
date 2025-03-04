<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ShowController extends Controller
{
    public function show($id)
    {
        $post = Post::with('categories')->findOrFail($id);
        return view('post.show', compact('post'));
    }
}
