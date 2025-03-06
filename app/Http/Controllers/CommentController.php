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

    public function update(Request $request, $id)
    {
        $request->validate(['body' => 'required|string']);
        $comment = Comment::findOrFail($id);

        // Check if the user is authorized to update the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->update($request->only('body'));

        return response()->json([
            'body' => $comment->body,
            'updated_at' => $comment->updated_at->format('M d, Y h:i A')
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Check if the user is authorized to delete the comment
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully.']);
    }
}
