<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CheckPostAuthor
{
    public function handle(Request $request, Closure $next)
    {
        // Find the post by ID from the route
        $post = Post::findOrFail($request->route('post'));

        // Allow admin to access any post or the author to access their own post
        if (Auth::user()->is_admin || $post->user_id === Auth::id()) {
            return $next($request); // Proceed to the next request handler
        }

        // Redirect if the user does not have permission
        return redirect()->route('dashboard')->with('error', 'You do not have permission to manage this post.');
    }
}
