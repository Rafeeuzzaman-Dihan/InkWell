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
        $post = $request->route('post');

        if (!$post) {
            return abort(404);
        }

        if (Auth::user()->role === 'admin' || $post->user_id === Auth::id()) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'You do not have permission to manage this post.');
    }

}
