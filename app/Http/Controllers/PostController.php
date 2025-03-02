<?php

namespace App\Http\Controllers;

use App\Models\Category; // Include the Category model
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function dashboard()
    {
        $categories = Category::all();
        return view('author.dashboard', compact('categories'));
    }
}
