@forelse ($videos as $video)
    <div class="media text-muted py-2 border-bottom border-gray">
        @if (Storage::disk('images')->has($video->image))
            <img class="video-image-mask rounded" src="{{ url('/miniatura/' . $video->image) }}" alt="Miniatura del video">
        @else
            <img class="video-image-mask rounded" src="{{ asset('images/videos/miniature-lg.png') }}" alt="Sin miniatura del video">
        @endif
        <div class="media-body pl-3 pb-3 mb-0 lh-125 ">
            <div class="d-flex justify-content-between align-items-center w-100">
                <strong class="text-gray-dark">
                    <h4 class="my-0 font-weight-normal">
                        <a href="{{ route('video.detail', ['video_id' => $video->id]) }}">
                            {{ $video->title }}
                        </a>
                    </h4>
                </strong>
            </div>
            <p>
                <a href="{{ route('user.channel', ['user_id' => $video->user->id]) }}"> {{ $video->user->name . ' ' . $video->user->surname }}</a> |
                {{ \FormatTime::LongTimeFilter($video->created_at) }}
            </p>

            @if (Auth::check() && Auth::user()->id == $video->user->id)
                <a href="{{ route('video.edit', [ 'id' => $video->id ]) }}" class="btn btn-sm btn-warning text-white">Editar</a>
                <a href="#deleteModal{{ $video->id }}" class="btn btn-sm btn-danger text-white"  role="button" data-toggle="modal">Eliminar</a>

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
        </div>
    </div>
@empty
    <div class="alert alert-warning mt-3" role="alert">
        No existen videos.
    </div>
@endforelse
<div class="col-12 pt-3">
    {{ $videos->links() }}
</div>