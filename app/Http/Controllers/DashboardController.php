<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $categories = Category::all();
        
        return view('dashboard', compact('user', 'categories'));
    }
}
