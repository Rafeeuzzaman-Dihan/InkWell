<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($postId)
    {
        $post = Post::findOrFail($postId);

        $likeExists = Like::where('post_id', $post->id)
            ->where('user_id', Auth::id())
            ->exists();

        if (!$likeExists) {
            $like = new Like();
            $like->post_id = $post->id;
            $like->user_id = Auth::id();
            $like->save();

            return response()->json(['action' => 'liked']);
        } else {
            $like = Like::where('post_id', $post->id)
                ->where('user_id', Auth::id())
                ->first();
            $like->delete();
        }
    }

    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);

        $like = Like::where('post_id', $post->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($like) {
            $like->delete();
        }

        return response()->json(['action' => 'not_found']);
    }
}
