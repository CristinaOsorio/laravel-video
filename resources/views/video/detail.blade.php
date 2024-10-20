@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-8">
                    <video class="w-100 bg-dark rounded-lg" controls id="video-player" height="400" width="video-player">
                        <source src="{{ route('video-file', ['filename' => $video->video_path]) }}">
                        Tu navegador no es compatible con html5
                    </video>
                    <div class="card border-0 bg-transparent">
                        <div class="card-body px-0">
                            <h5 class="mb-2 text-truncate font-weight-bold"> {{ $video->title }}</h5>
                            <p class="card-subtitle mb-2 text-muted mb-3">
                                <small>Subido por <strong><a href="{{ route('user.channel', ['user_id' => $video->user->id]) }}"> {{ $video->user->nickname }}</a></strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}</small>
                            </p>
                            
                            <p class="card-text">
                                {{ $video->description }}
                            </p>
                        </div>
                    </div>

                    @include('video.comments', $video)
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

