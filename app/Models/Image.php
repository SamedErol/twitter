<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['tweet_id', 'file_path'];

    public function tweet()
    {
        return $this->belongsTo(Tweet::class, "tweet_id", "id");
    }
}
