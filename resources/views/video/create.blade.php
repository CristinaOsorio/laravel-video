@extends('layouts.app')

@section('content')
    @include('partials.video_form', [
        'formTitle' => trans('videos.create.title'),
        'formSubtitle' => trans('videos.create.subtitle'),
        'formAction' => route('video.store'),
        'buttonText' => trans('videos.create.action.store'),
        'isEdit' => false,
    ])
@endsection