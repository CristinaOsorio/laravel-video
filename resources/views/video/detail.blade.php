@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>{{ $video->title }}</h2>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <video class="w-100" controls id="video-player">
                        <source src="{{ route('video-file', ['filename' => $video->video_path]) }}">
                        Tu navegador no es compatible con html5
                    </video>
                    <div class="card video-data">
                        <div class="card-header">
                            Subido por <strong><a href="{{ route('user.channel', ['user_id' => $video->user->id]) }}"> {{ $video->user->name . ' ' . $video->user->surname }}</a></strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}
                          </div>
                        <div class="card-body">
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

