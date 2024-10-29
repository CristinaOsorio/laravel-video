@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8 d-flex align-items-center">
            <h5 class="font-weight-bolder mb-0">Búsqueda: {{ $search }}</h5>
        </div>

        <div class="col-md-4">
            <form class="form-inline float-right" role="order" action="{{ route('video.search', ['search' => $search]) }}">
                <label for="order" class="mr-4">Ordenar</label>
                <select class="form-control" id="order" name="order">
                    <option value="new"><a href=""> Recientes</option>
                    <option value="old">Antiguos</option>
                    <option value="alfa ">A-Z</option>
                </select>
                <button class="btn btn-primary ml-4" type="submit">Ordenar</button>
            </form>
        </div>
    </div>

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
                No existen videos.
            </div>
        @endforelse
    </div>
    
    @include('partials.pagination', ['paginator' => $videos])
        
</div>
@endsection
