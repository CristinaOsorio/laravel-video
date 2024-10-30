@extends('layouts.app')

@section('content')
    @include('partials.video_form', [
        'formTitle' => trans('videos.edit.form_title'),
        'formSubtitle' => trans('videos.edit.form_subtitle'),
        'formAction' => route('video.update', $video->id),
        'buttonText' => trans('videos.edit.button_text'),
        'isEdit' => true,
        'video' => $video,
    ])
@endsection
