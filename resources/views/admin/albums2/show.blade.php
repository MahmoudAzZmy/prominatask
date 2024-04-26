@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('albums1.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>
            <div class="card col-12 mt-3">
                <div class="card-header">
                    Show Ablum {{ $album->name }} Js
                </div>
                <div class="card-body">
                    @foreach ($album->pics as $pic)
                        <a href="{{ $pic->pic()->getUrl() }}" target="_blank">
                            <img src="{{ $pic->pic()->getUrl() }}" width="250px" height="250px">
                        </a>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
@endsection
