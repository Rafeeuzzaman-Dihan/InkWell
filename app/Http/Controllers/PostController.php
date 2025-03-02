<?php

namespace App\Http\Controllers;

use App\Models\Category; // Include the Category model
use App\Models\Post; // Include the Post model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // Show the author dashboard with categories
    public function dashboard()
    {
        $categories = Category::all(); // Fetch all categories
        return view('author.dashboard', compact('categories'));
    }

    // Show the form to create a new post
    public function create()
    {
        $categories = Category::all(); // Fetch categories to select from
        return view('posts.create', compact('categories'));
    }

    // Store the newly created post
    public function store(Request $request)
    {
        $this->validator($request->all())->validate(); // Call the validator method

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store the image
        }

        // Create the post
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => implode(',', $request->categories),
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        // Redirect back to the dashboard with a success message
        return redirect()->route('author.dashboard')->with('success', 'Post created successfully!');
    }

    // Validator method
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
