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
        $post = Post::find($request->route('post'));

        if ($post && $post->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to manage this post.');
        }

        return $next($request);
    }
}
