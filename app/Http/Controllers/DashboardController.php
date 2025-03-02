<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'author':
                return redirect()->route('author.dashboard');
            case 'user':
                return redirect()->route('user.dashboard');

                return abort(403);
        }
    }
}
