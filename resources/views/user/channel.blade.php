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
                    <button class="btn btn-outline-primary">Más recientes</button>
                    <button class="btn btn-outline-secondary">Más likes</button>
                    <button class="btn btn-outline-info">Más comentados</button>
                </div>
            </div>
        @endif

        <div class="row">

            @forelse ($videos as $video)
                <!-- Video Card -->
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <figure class="card-img-top mb-0">

                            @if (Storage::disk('images')->has($video->image))
                                <img class="card-img-top" src="{{ url('/miniatura/' . $video->image) }}" alt="Miniatura del video">
                            @else
                                <img class="card-img-top" src="{{ asset('images/videos/miniature-lg.png') }}" alt="Sin miniatura del video">
                            @endif
                        </figure>

                        <div class="card-body d-flex justify-content-between flex-column">
                            <p class="card-title">
                                <a class="line-clamp" href="{{ route('video.detail', ['video_id' => $video->id]) }}" title="{{ $video->title }}">
                                    {{ $video->title }}
                                </a>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text text-muted small mb-0 capitalize-first-letter">{{ \FormatTime::LongTimeFilter($video->created_at) }}</p>
                                <p class="card-text mb-0">{{ $video->likes_count }} <i class="fa-regular fa-thumbs-up"></i> | {{ $video->dislikes_count }} <i class="fa-regular fa-thumbs-down  fa-flip-horizontal"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin de Video Card -->
                @empty
                <div class="col-md-12 col-lg-12 text-center py-4">
                    <h3>No hay videos para mostrar</h3>
                </div>

            @endforelse

        </div>
    </div>

@endsection
