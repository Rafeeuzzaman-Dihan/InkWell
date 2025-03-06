<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->input('category');
        $posts = Post::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->whereHas('categories', function ($query) use ($selectedCategory) {
                $query->where('categories.id', $selectedCategory);
            });
        })->latest()->paginate(6);

        return view('home', compact('posts', 'categories', 'selectedCategory'));
    }

    public function show($id)
    {
        $post = Post::with(['comments.user'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
