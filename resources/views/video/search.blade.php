@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4 class="font-weight-bolder">Busqueda: {{ $search }}</h4>
        </div>

        <div class="col-md-4">
            <form class="form-inline float-right" role="order" action="{{ route('video.search', ['search' => $search]) }}">
                {{-- <div class="form-group"> --}}
                    <label class="mr-4">Ordenar</label>
                    <select class="form-control" id="order" name="order">
                        <option value="new"><a href=""> Recientes</option>
                        <option value="old">Antiguos</option>
                        <option value="alfa ">A-Z</option>
                    </select>
                    <button class="btn btn-primary ml-4" type="submit">Ordenar</button>
                {{-- </div> --}}
            </form>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm col-12">
            <h6 class="border-bottom border-gray pb-2 mb-0">Videos</h6>
            @include('video.video-list', $videos)
        </div>
        <hr>
    </div>
</div>
@endsection
