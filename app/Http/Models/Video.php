<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Comments;
use App\Http\Models\User;

class Video extends Model
{
    protected $table = 'videos';

    // Relacion One To Many
    public function comments() {
        return $this->hasMany(Comment::class)->orderBy('id', 'DESC');
    }

    // Relacion de Muchos a Uno
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
