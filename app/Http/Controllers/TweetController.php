<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tweet;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        $tweets = Tweet::with('user', 'images')->latest()->get();

        return view('dashboard', compact('tweets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Doğrudan Tweet::create kullanarak tweet oluşturma
        $tweet = Tweet::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('images')) {
            $fileNames = $this->uploadMultiImage($request->images, "tweet");

            foreach ($fileNames as $fileName) {
                Image::create([
                    'file_path' => $fileName,
                    "tweet_id" => $tweet->id,
                ]);
            }
        }

        return redirect()->route('tweets.index');
    }
}
