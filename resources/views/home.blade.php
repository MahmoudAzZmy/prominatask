@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('albums.index') }}" class="btn btn-info">Albums with dropzone</a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('albums1.index') }}" class="btn btn-success">Albums List using js</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
