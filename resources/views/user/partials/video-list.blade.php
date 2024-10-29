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
                'menuItems' => [
                    [
                    'label' => 'Editar',
                    'url' => route('video.edit', ['id' => $video->id]),
                    'class' => 'small'
                ],
                [
                    'label' => 'Eliminar',
                    'url' => '#deleteModal' . $video->id,
                    'class' => 'text-danger small',
                    'data-toggle' => 'modal'
                ]
                ]
            ])

        @if (Auth::check() && Auth::user()->id == $video->user->id)
            <!-- Modal / Ventana / Overlay en HTML -->
            <div id="deleteModal{{ $video->id }}" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar video</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro que quieres borrar este elemento?</p>
                            <p><small>{{ $video->title }}</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <a href="{{ route('video.delete', ['video_id' => $video->id]) }}" type="button" class="btn btn-danger" >Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif 

    @empty

        <div class="col-md-12 col-lg-12 text-center py-4">
            <h3>No hay videos para mostrar</h3>
        </div>

    @endforelse

</div>