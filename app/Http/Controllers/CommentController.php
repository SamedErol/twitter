<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tweet_id' => 'required',
            'content' => 'required|string|max:280',
        ]);

        $comment = new Comment();
        $comment->tweet_id = $request->tweet_id;
        $comment->user_id = auth()->user()->id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back();
    }
}
