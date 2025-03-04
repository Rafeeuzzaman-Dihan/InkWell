<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function dashboard()
    {
        $categories = Category::all();
        return view('author.dashboard', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => implode(',', $request->categories),
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'min:255'],
            'categories' => ['required', 'array', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif|max:2048'],
        ], [
            'title.required' => 'The post title is required.',
            'content.required' => 'The post content is required.',
            'content.min' => 'The content must be at least 255 characters.',
            'categories.required' => 'You must select at least one category.',
            'categories.min' => 'You must select at least one category.',
        ]);
    }
}
