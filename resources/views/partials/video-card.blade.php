<div class="col-md-4 col-lg-3 mb-4">
    <div class="card h-100 position-relative">
        <!-- Menú de tres puntos (opcional) -->
        @if (!empty($menuItems))
            <div class="dropdown position-absolute" style="top: 0.5rem; right: 0.5rem;">
                <a href="#" class="text-white bg-primary p-1 rounded-pill shadow-lg" style="opacity: 0.75;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach ($menuItems as $item)
                        <a 
                            class="dropdown-item {{ $item['class'] ?? '' }}" 
                            href="{{ $item['url'] }}"
                            @if(isset($item['data-toggle'])) data-toggle="{{ $item['data-toggle'] }}" @endif
                            @if(isset($item['role'])) role="{{ $item['role'] }}" @endif
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Imagen de la tarjeta -->
        <figure class="card-img-top mb-0">
            <img class="card-img-top" src="{{ $image }}" alt="Miniatura del video">
        </figure>

        <!-- Cuerpo de la tarjeta -->
        <div class="card-body d-flex justify-content-between flex-column py-2 px-3">
            <a class="card-text line-clamp-2 mb-0 font-weight-bold" href="{{ route('video.detail', ['video_id' => $videoId]) }}" title="{{ $title }}">
                {{ $title }}
            </a>
            <div>
                <a class="card-text line-clamp-1 mb-0" href="{{ route('user.channel', ['user_id' => $userId]) }}" title="{{ $userNickname }}">
                   <small class=" text-muted text-secondary font-weight-bold">{{ $userNickname }}</small>
                </a>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="card-text mb-0 capitalize-first-letter">
                        <small class="text-muted">{{ $time }}</small></p>
                    <p class="card-text mb-0">
                        <small class="text-muted">
                            {{ $likes }} <i class="fa-regular fa-thumbs-up"></i> | 
                            {{ $dislikes }} <i class="fa-regular fa-thumbs-down fa-flip-horizontal"></i> | 
                            {{ $comments }} <i class="fa-regular fa-comments"></i>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>