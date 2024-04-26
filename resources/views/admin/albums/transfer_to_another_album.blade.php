@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-3">
            <a href="{{ route('albums.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">Move Media To Album</div>
            <div class="card-body">
                <form action="{{ route('albums.transfer-pics', $id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="model_id" class="required">To Album</label>
                            <select name="model_id" id="model_id" class="form-control">
                                @foreach ($albums as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-success mt-3">SAVE</button>
                </form>
            </div>
        </div>
    </div>
@endsection
