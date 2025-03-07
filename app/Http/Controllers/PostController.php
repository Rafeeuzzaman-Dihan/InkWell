<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // Display the author dashboard
    public function dashboard()
    {
        $categories = Category::all();
        return view('author.dashboard', compact('categories'));
    }

    // Show the form to create a new post
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create the post
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        // Attach categories to the post
        $post->categories()->attach($request->categories);

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    // Display a post
    public function show(Post $post)
    {
        $post->load('categories');
        return view('posts.show', compact('post'));
    }

    // Display all posts (Admin view)
    public function index()
    {
        $posts = Post::with('categories')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Show the form to edit a post
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // Update a post in the database
    public function update(Request $request, Post $post)
    {
        $this->validator($request->all())->validate();

        // Check for new image upload
        if ($request->hasFile('image')) {
            // Store the new image and update the image path
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath; // Update image path in the post
        }

        // Update the post with new data
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Sync categories
        $post->categories()->sync($request->categories);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }

    // Delete a post from the database
    public function destroy(Post $post)
    {
        // Optionally, delete the associated image from storage
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }

    // Display posts created by the authenticated user
    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())->with('categories')->get();
        return view('posts.my_posts', compact('posts'));
    }

    // Validate data for creating/updating posts
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
