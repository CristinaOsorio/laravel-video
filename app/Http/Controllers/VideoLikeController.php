<?php

namespace App\Http\Controllers;

use App\Http\Models\VideoLike;

class VideoLikeController extends Controller
{
    private function toggleLikeDislike($video_id, $is_like) {
        $user = auth()->user();

        $existingLike = VideoLike::where('video_id', $video_id)
                                ->where('user_id', $user->id)
                                ->first();

        if ($existingLike) {
            $existingLike->update(['is_like' => $is_like]);
        } else {
            VideoLike::create([
                'user_id' => $user->id,
                'video_id' => $video_id,
                'is_like' => $is_like
            ]);
        }

        return back()->with('status', $is_like ? 'Te ha gustado el video.' : 'No te ha gustado el video.');
    }

    public function like($video_id) {
        return $this->toggleLikeDislike($video_id, true);
    }

    public function dislike($video_id) {
        return $this->toggleLikeDislike($video_id, false);
    }

}
