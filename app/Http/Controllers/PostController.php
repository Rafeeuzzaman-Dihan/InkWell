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

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        $post->categories()->attach($request->categories);

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $post->load('categories');
        return view('posts.show', compact('post'));
    }

    public function index()
    {
        $posts = Post::with('categories')->get();
        return view('posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validator($request->all())->validate();

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        $post->categories()->sync($request->categories);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())->with('categories')->get();
        return view('posts.my_posts', compact('posts'));
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
