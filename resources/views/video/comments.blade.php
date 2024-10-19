<hr>
<h5 class="mb-2 text-truncate font-weight-bold">Comentarios</h5>
@if(Auth::check())
    @if(session('message'))
        <div class="alert alert-success col-12" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <form class="col-md-12" method="post" action="{{ route('comment') }}">
        @csrf

        <input id="video_id" type="hidden" name="video_id" value="{{ $video->id }}" required/>
        <p>
            <div class="form-group">
                <textarea id="body" class="form-control" name="body" rows="3"></textarea>
            </div>
            <input type="submit" value="Comentar" class="btn btn-success">
        </p>
    </form>
@endif

@if(isset($video->comments))
    <div id="comments-list">
       @foreach ($video->comments as $comment)
           <div class="comment-item col-md-12 pull-left mb-2 mt-2">
                <div class="card video-data">
                    <div class="card-header">
                        <strong>{{ $comment->user->name . ' ' . $comment->user->surname }}</strong> {{ \FormatTime::LongTimeFilter($comment->created_at) }}
                        @if (Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id))
                            <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                            <a href="#deleteModal{{ $comment->id }}" role="button" class="close" data-toggle="modal">
                                <span aria-hidden="true">&times;</span>
                            </a>

                            <!-- Modal / Ventana / Overlay en HTML -->
                            <div id="deleteModal{{ $comment->id }}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Eliminar comentario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Seguro que quieres borrar este elemento?</p>
                                            <p><small>{{ $comment->body }}</small></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <a href="{{ route('comment.delete', ['comment_id' => $comment->id]) }}" type="button" class="btn btn-danger" >Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{ $comment->body }}
                        </p>
                    </div>
                </div>
           </div>
       @endforeach
    </div>
@endif