<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\User;
use App\Http\Models\Video;


class Comment extends Model
{
    protected $table = 'comments';

    // Relacion de Muchos a Uno
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

     // Relacion de Muchos a Uno
     public function video() {
        return $this->belongsTo(Video::class, 'video_id');
    }

}
