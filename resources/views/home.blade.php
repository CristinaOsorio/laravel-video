@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(session('message'))
            <div class="alert alert-success col-12" role="alert">
                {{ session('message') }}
            </div>
        @endif

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
        <div class="col-12">
            <div class="alert alert-warning mt-3" role="alert">
                {{ trans('videos.no_videos') }}
            </div>
        </div>
        @endforelse
        
        @include('partials.pagination', ['paginator' => $videos])

    </div>
</div>
@endsection
