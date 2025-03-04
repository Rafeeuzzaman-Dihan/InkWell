<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        // Check if the authenticated user is an admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            $users = User::all(); // Fetch all users from the database
            return view('admin.users', compact('users')); // Return the user management view
        }

        // If not an admin, redirect with an error
        return redirect('/')->with('error', 'You do not have access to this resource.');
    }
}
