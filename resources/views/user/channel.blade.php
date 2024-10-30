@extends('layouts.app')

@section('content')
<div class="container">        
    <!-- Banner con información de usuario -->
    <div class="jumbotron d-flex">
        <div class="profile-icon mb-0 mr-4 h1 font-weight-bold">{{ strtoupper($user->nickname[0]) }}</div>
        <div class="my-auto">
            <h2 class="mb-0 font-weight-bold">{{ $user->nickname }}</h2>
            <p class="lead mb-0 text-muted small">{{ trans('user.channel.joined', ['date' => $user->created_at]) }}</p>
            <p class="lead mb-0"><span class="badge badge-dark">{{ trans('user.channel.video_count', ['count' => $videos->total()]) }}</span></p>
        </div>
    </div>

    <h3>{{ trans('user.channel.channel_videos', ['user' =>  $user->nickname]) }}</h3>

    <hr>

    <!-- Botones de filtro y orden -->
    @if ($videos->count() > 0)
        <div class="row mb-3">
            <div class="col">
                <button class="btn btn-outline-primary active" data-sort="recent" onclick="fetchVideos('recent')">{{ trans('user.channel.filters.recent') }}</button>
                <button class="btn btn-outline-primary" data-sort="likes" onclick="fetchVideos('likes')">{{ trans('user.channel.filters.likes') }}</button>
                <button class="btn btn-outline-primary" data-sort="comments" onclick="fetchVideos('comments')">{{ trans('user.channel.filters.comments') }}</button>
            </div>

            <div class="col d-flex justify-content-end">
                @include('partials.pagination', ['paginator' => $videos])
            </div>
        </div>
    @endif

    <!-- Listado de videos del usuario -->
    <div id="videos-list">
        @include('user.partials.video-list', ['videos' => $videos])
    </div>

    <!-- Página de paginación -->
    @include('partials.pagination', ['paginator' => $videos])
</div>


@endsection

@section('js')
    <script>
        let currentSort = 'recent';

        function fetchVideos(sort) {

            if (sort === currentSort) {
                return; // Salir de la función
            }

            const videosList = document.getElementById('videos-list');
            videosList.classList.add('inactive');

            const userId = {{ $user->id }};
            const url = `/channel/${userId}?sort=${sort}`;
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('videos-list').innerHTML = html;

                document.querySelectorAll('.btn-outline-primary')
                    .forEach(button => {
                        button.classList.remove('active');
                    });
                // Establecer el botón activo y deshabilitarlo
                const activeButton = document.querySelector(`button[data-sort="${sort}"]`);
                activeButton.classList.add('active');

                currentSort = sort;

            })
            .catch(error => console.error('Error fetching videos:', error))
            .finally(() => {
                videosList.classList.remove('inactive');
            });
        }

    </script>
@endsection
