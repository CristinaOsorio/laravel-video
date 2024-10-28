@extends('layouts.app')

@section('content')
    @include('partials.video_form', [
        'formTitle' => 'Editar Video',
        'formSubtitle' => 'Modifica los campos a continuación para actualizar tu video.',
        'formAction' => route('video.update', $video->id),
        'buttonText' => 'Actualizar Video',
        'isEdit' => true,
        'video' => $video,
    ])
@endsection
