@extends('layouts.app')

@section('content')
    @include('partials.video_form', [
        'formTitle' => 'Subir tu video',
        'formSubtitle' => 'Completa los campos a continuación para compartir tu video con la comunidad.',
        'formAction' => route('video.store'),
        'buttonText' => 'Subir Video',
        'isEdit' => false,
    ])
@endsection