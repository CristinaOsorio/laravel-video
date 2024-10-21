<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Comment;
use App\Http\Models\User;
use App\Http\Models\VideoLike;

class Video extends Model
{
    protected $table = 'videos';

    public function comments() {
        return $this->hasMany(Comment::class)->orderBy('id', 'DESC');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes() {
        return $this->hasMany(VideoLike::class)->where('is_like', true);
    }

    public function dislikes() {
        return $this->hasMany(VideoLike::class)->where('is_like', false);
    }
}
