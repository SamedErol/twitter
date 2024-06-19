<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id)
    {
        $tweet = Tweet::findOrFail($id);
        $user = Auth::user();

        // Check if the user has already liked the tweet
        $like = Like::where('tweet_id', $tweet->id)->where('user_id', $user->id)->first();

        if ($like) {
            // If liked, remove the like
            $like->delete();
        } else {
            // If not liked, add the like
            Like::create([
                'tweet_id' => $tweet->id,
                'user_id' => $user->id
            ]);
        }
        return redirect()->back();
    }
}
