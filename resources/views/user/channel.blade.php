@extends('layouts.app')

@section('content')

    <div class="container">        
        <!-- Banner con información de usuario -->
        <div class="jumbotron d-flex">
            <div class="profile-icon mb-0 mr-4 h1 font-weight-bold">{{ strtoupper($user->nickname[0]) }}</div>
            <div class="my-auto">
                
                <h2 class="mb-0 font-weight-bold">{{ $user->nickname }}</h2>
                <p class="lead mb-0 text-muted small">Se unio el {{ $user->created_at }}</span></p>
                <p class="lead mb-0"><span class="badge badge-dark">{{ $videos->total() }} videos</span></p>
            </div>
        </div>

        <h3>Videos</h3>
        <hr>

        <!-- Botones de filtro y orden -->
        @if ($videos->count() > 0)
            <div class="row mb-3">
                <div class="col">
                    <button class="btn btn-outline-primary active" data-sort="recent" onclick="fetchVideos('recent')">{{ config('filters.recent.label') }}</button>
                    <button class="btn btn-outline-primary" data-sort="likes" onclick="fetchVideos('likes')">{{ config('filters.likes.label') }}</button>
                    <button class="btn btn-outline-primary" data-sort="comments" onclick="fetchVideos('comments')">{{ config('filters.comments.label') }}</button>
                </div>
            </div>
        @endif

        <div id="videos-list">
            @include('user.partials.videos', ['videos' => $videos])
        </div>

@endsection

@section('js')
    <script>
         let currentSort = 'recent';

        function fetchVideos(sort) {

            if (sort === currentSort) {
                console.log('La opción seleccionada ya está activa. No se realizará la petición.');
                return; // Salir de la función
            }

            const userId = {{ $user->id }};
            const url = `/channel/${userId}?sort=${sort}`;

            const activeButton = document.querySelector(`button active`);
            
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

                    console.log(sort);
                    

                // Establecer el botón activo y deshabilitarlo
                const activeButton = document.querySelector(`button[data-sort="${sort}"]`);
                activeButton.classList.add('active');

                currentSort = sort;

            })
            .catch(error => console.error('Error fetching videos:', error));
        }

    </script>
@endsection
