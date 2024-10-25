<?php

namespace App\Http\Controllers;

use App\Http\Models\VideoLike;

class VideoLikeController extends Controller
{
    private function toggleLikeDislike($video_id, $is_like)
    {
        $user = auth()->user();

        $existingLike = VideoLike::where('video_id', $video_id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingLike && $existingLike->is_like == $is_like) {
            $existingLike->delete();
            return $this->countLikesDislikes($video_id);
        }

        if ($existingLike) {
            $existingLike->update(['is_like' => $is_like]);
        } else {
            VideoLike::create([
                'user_id' => $user->id,
                'video_id' => $video_id,
                'is_like' => $is_like
            ]);
        }

        return $this->countLikesDislikes($video_id);
    }

    private function countLikesDislikes($video_id)
    {
        $likes_count = VideoLike::where('video_id', $video_id)->where('is_like', true)->count();
        $dislikes_count = VideoLike::where('video_id', $video_id)->where('is_like', false)->count();

        return response()->json([
            'likes_count' => $likes_count,
            'dislikes_count' => $dislikes_count,
        ]);
    }

    public function like($video_id) {
        return $this->toggleLikeDislike($video_id, true);
    }

    public function dislike($video_id) {
        return $this->toggleLikeDislike($video_id, false);
    }
}
