<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Http\Models\VideoLike;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'nickname',
        'email',
        'password',
        'role',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('d \d\e F \d\e Y');
    }

    public function videoLikes() {
        return $this->hasMany(VideoLike::class);
    }

    public function videos() {
        return $this->hasMany(Video::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function ($user) {
            foreach ($user->videos as $video) {
                if (Storage::disk('videos')->exists($video->video_path)) {
                    Storage::disk('videos')->delete($video->video_path);
                }
                if (Storage::disk('images')->exists($video->image)) {
                    Storage::disk('images')->delete($video->image);
                }
            }

            if ($user->image && Storage::disk('images/profile')->exists($user->image)) {
                Storage::disk('images/profile')->delete($user->image);
            }
        });
    }
}
