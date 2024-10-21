<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\User;
use App\Http\Models\Video;

class VideoLike extends Model
{
    protected $fillable = ['user_id', 'video_id', 'is_like'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function video() {
        return $this->belongsTo(Video::class);
    }
}
