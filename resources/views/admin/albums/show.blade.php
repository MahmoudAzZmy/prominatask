@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('albums.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>
            <div class="card col-12 mt-3">
                <div class="card-header">
                    Show Ablum {{ $album->name }}
                </div>
                <div class="card-body">
                    @foreach ($album->pictures as $media)
                        <a href="{{ $media->getUrl() }}" target="_blank">
                            <img src="{{ $media->getUrl() }}" width="250px" height="250px">
                        </a>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
@endsection
