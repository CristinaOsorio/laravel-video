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

                                    <button id="like-btn" class="btn" data-video-id="{{ $video->id }}">
                                        <i class="fa-{{ $user_reaction === 'like' ? 'solid' : 'regular' }} fa-thumbs-up"></i>
                                        <span id="likes-count">{{ $likes_count }}</span>
                                    </button>

                                    <button id="dislike-btn" class="btn" data-video-id="{{ $video->id }}">
                                        <i class="fa-{{ $user_reaction === 'dislike' ? 'solid' : 'regular' }} fa-thumbs-down"></i>
                                        <span id="dislikes-count">{{ $dislikes_count }}</span>
                                    </button>
                                    
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

@section('js')

    <script>
        $(document).ready(function() {

            function updateReactionCounts(likesCount, dislikesCount, userReaction) {
                $('#likes-count').text(likesCount);
                $('#dislikes-count').text(likesCount);

                if (userReaction === true) {
                    $('#like-btn i').removeClass('fa-regular').addClass('fa-solid');
                    $('#dislike-btn i').removeClass('fa-solid').addClass('fa-regular');
                } else if (userReaction === false) {
                    $('#dislike-btn i').removeClass('fa-regular').addClass('fa-solid');
                    $('#like-btn i').removeClass('fa-solid').addClass('fa-regular');
                } else {
                    $('#like-btn i').removeClass('fa-solid').addClass('fa-regular');
                    $('#dislike-btn i').removeClass('fa-solid').addClass('fa-regular');
                }
            }

            async function handleReaction(videoId, isLike) {
                try {
                    const response = await $.ajax({
                        url: `/videos/${videoId}/${isLike ? 'like' : 'dislike'}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    });
                    updateReactionCounts(response.likes_count, response.dislikes_count, isLike);

                } catch (error) {
                    console.error('Error al actualizar la reacción:', error);
                }
            }

            $('#like-btn').on('click', function() {
                const videoId = $(this).data('video-id');
                handleReaction(videoId, true);
            });

            $('#dislike-btn').on('click', function() {
                const videoId = $(this).data('video-id');
                handleReaction(videoId, false);
            });

        });

    </script>
@endsection