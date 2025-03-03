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

        // Check if the user already liked the post
        $likeExists = Like::where('post_id', $post->id)
                          ->where('user_id', Auth::id())
                          ->exists();

        if (!$likeExists) {
            // Create a new like
            $like = new Like();
            $like->post_id = $post->id;
            $like->user_id = Auth::id();
            $like->save();
        }

        return redirect()->route('posts.show', $postId);
    }

    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);

        // Find the like and delete it
        $like = Like::where('post_id', $post->id)
                    ->where('user_id', Auth::id())
                    ->first();

        if ($like) {
            $like->delete();
        }

        return redirect()->route('posts.show', $postId);
    }
}
