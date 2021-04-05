@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4 class="font-weight-bolder">Canal de {{ $user->name . ' ' . $user->surname }}</h4>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm col-12">
            <h6 class="border-bottom border-gray pb-2 mb-0">Videos</h6>
            @include('video.video-list', $videos)
        </div>
        <hr>
    </div>
</div>
@endsection
