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
        $posts = Post::where('user_id', $user->id)->get();
        
        return view('dashboard', compact('user', 'categories', 'posts'));
    }
}
