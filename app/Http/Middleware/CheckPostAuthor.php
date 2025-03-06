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
        $post = Post::findOrFail($request->route('post'));

        if (Auth::user()->is_admin || $post->user_id === Auth::id()) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'You do not have permission to manage this post.');
    }
}
