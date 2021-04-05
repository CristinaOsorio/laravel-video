@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(session('message'))
            <div class="alert alert-success col-12" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="my-3 p-3 bg-white rounded shadow-sm col-12">
            <h6 class="border-bottom border-gray pb-2 mb-0">Videos</h6>
            @include('video.video-list', $videos)
        </div>
        <hr>
    </div>
</div>
@endsection
