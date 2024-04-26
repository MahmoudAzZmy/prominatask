@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-3">
            <a href="{{ route('albums1.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">Edit Album JS</div>
            <div class="card-body">
                <form action="{{ route('albums1.update', $album) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="name" class="required">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $album->name }}" required>
                        </div>
                        <div class="col-12">
                            <div class="card mt-2">
                                <div class="card-header">
                                    Pics
                                </div>
                                <div class="card-body">
                                    <div class="col-12 mt-3">
                                        @foreach ($album->pics as $key => $pic)
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="pic_name" class="required">PIC Name
                                                    </label>
                                                    <input type="text" name="pic_name[]" value="{{ $pic->name }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <a href="{{ $pic->pic()->getUrl() }}" target="_blank">
                                                                <img src="{{ $pic->pic()->getUrl() }}" width="100px"
                                                                    height="100px">
                                                            </a>
                                                        </div>
                                                        <div class="col-8">
                                                            <label for="pics" class="">Pic</label>
                                                            <input type="file" name="pics[{{ $key }}]"
                                                                class="form-control">
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                        @endforeach



                                        <div class="appendHere my-5"></div>
                                    </div>
                                    {{-- <div class="card-footer">
                                        <button class="btn btn-success" type="button" onclick="addMoreInput()">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div> --}}

                                </div>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-success mt-3">SAVE</button>
                </form>
            </div>
        </div>
    </div>
@endsection
{{-- @section('scripts')
    <script>
        let counter = 1;

        function addMoreInput() {
            counter++;
            $(".appendHere").append(`
            <div class="form-group  parentItem">
                <div class="col-md-12">
                    <hr>
                </div>
                  <div class="form-group row">
                                        <div class="col-md-5">
                                            <label for="pic_name" class="required">PIC Name
                                            </label>
                                            <input type="text" name="pic_name[]" class="form-control">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="pic">Pic</label>
                                            <input type="file" name="pics[]" class="form-control">
                                        </div>
                                    </div>

                <div class="d-md-none"></div>
                <div class="col-md-2 my-4">
                    <button class="btn btn-danger" type="button" onclick="removeInput(this)">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        `);
        }

        function removeInput(button) {
            $(button).closest('.parentItem').remove();
        }
    </script>
@endsection --}}
