@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Crear un nuevo videos</h2>
            <hr>
        </div>
        <form method="post" action="{{ route('video.store') }}" enctype= "multipart/form-data" class="col-lg-7">
            @csrf

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
                <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <textarea id="description" class="form-control" name="description" rows="3"> {{ old('description') }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Miniatura</label>
                <input class="form-control" type="file" name="image" value="{{ old('image') }}">
            </div>
            <div class="form-group">
                <label for="video">Video</label>
                <input class="form-control" type="file" name="video" value="{{ old('video') }}">
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-outline-primary" type="submit">Crear</button>
            </div>
        </form>
    </div>
</div>
@endsection

