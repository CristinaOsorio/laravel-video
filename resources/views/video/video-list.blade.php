<div class="row">
    @forelse ($videos as $video)
        @include('partials.video-card', [
                'title' => $video->title,
                'image' => Storage::disk('images')->has($video->image) ? url('/miniatura/' . $video->image) : asset('images/videos/miniature-lg.png'),
                'videoId' => $video->id,
                'userId' => $video->user->id,
                'userNickname' => $video->user->nickname,
                'time' => \FormatTime::LongTimeFilter($video->created_at),
                'likes' => $video->likes_count,
                'dislikes' => $video->dislikes_count,
                'comments' => $video->comments_count,
                'menuItems' => []
            ])
    @empty
        <div class="alert alert-warning mt-3" role="alert">
            {{ trans('videos.no_videos') }}
        </div>
    @endforelse
</div>