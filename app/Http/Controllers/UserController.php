<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display the user management page
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('admin.user', compact('users'));
    }

    // Show the form for editing a user (optional)
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user')); // Create this view if you want to implement editing
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
