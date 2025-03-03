<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $post = Post::findOrFail($postId);
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->save();

        return response()->json([
            'user_name' => $comment->user->name,
            'body' => $comment->body,
            'created_at' => $comment->created_at->format('M d, Y h:i A')
        ]);
    }
}
