@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Editar video</h2>
            <hr>
        </div>
        <form method="post" action="{{ route('video.update', [ 'video_id' => $video->id]) }}" enctype= "multipart/form-data" class="col-lg-7">
            @csrf
            @method('PUT')

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="title">Titulo</label>
                <input id="title" class="form-control" type="text" name="title" value="{{ old('title', $video->title) }}">
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <textarea id="description" class="form-control" name="description" rows="3"> {{ old('description', $video->description) }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="image">Miniatura</label>
                @if(is_null($video->image))
                    <p>Sin imagen</p>
                @else
                    <img class="img-thumbnail d-block m-2" width="100px" height="100px" src="{{ route('miniatura.image', ['filename' => $video->image ]) }}" alt="">
                @endif
                <input class="form-control" type="file" name="image" value="{{ old('image') }}">
            </div>
            <div class="form-group">
                <label for="video">Video</label>
                <video controls width="100%">
                    <source src="{{ route('video-file', ['filename' => $video->video_path]) }}">
                        Tu navedador no es compatible co HTML5.
                </video>
                <input class="form-control" type="file" name="video" value="{{ old('video') }}">
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-outline-primary" type="submit">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection

