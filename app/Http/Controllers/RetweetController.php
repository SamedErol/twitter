<?php

namespace App\Http\Controllers;

use App\Models\Retweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetweetController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tweet_id' => 'required|exists:tweets,id',
            'comment' => 'nullable|string|max:280'
        ]);

        Retweet::create([
            'tweet_id' => $request->tweet_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }
}
