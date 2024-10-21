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

                            <div class="d-flex justify-content-between">

                                <p class="card-subtitle mb-2 text-muted mb-3">
                                    <small>Subido por <strong><a href="{{ route('user.channel', ['user_id' => $video->user->id]) }}"> {{ $video->user->nickname }}</a></strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}</small>
                                </p>
                                

                                <div>
                                    {{--  Like Actions --}}
                                    <a type="button" class="btn btn-primary"
                                        onclick="event.preventDefault();
                                                document.getElementById('video-like-form').submit();">
                                        {{ __('👍') }}
                                    </a>

                                    <form id="video-like-form" action="{{ route('video.like', ['video_id' => $video->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                
                                    <a type="button" class="btn btn-primary"
                                        onclick="event.preventDefault();
                                                document.getElementById('video-dislike-form').submit();">
                                        {{ __('👎') }}
                                    </a>

                                    <form id="video-dislike-form" action="{{ route('video.dislike', ['video_id' => $video->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </div>
                            <p class="card-text">
                                {{ $video->description }}
                            </p>

                            @if(session('status'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>

                    @include('video.comments', $video)
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
