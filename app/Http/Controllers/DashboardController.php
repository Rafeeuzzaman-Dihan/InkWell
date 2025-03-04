<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $categories = Category::all();
        
        return view('dashboard', compact('user', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create the post
        Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'category' => implode(',', $validatedData['categories']),
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Post created successfully!');
    }
}
