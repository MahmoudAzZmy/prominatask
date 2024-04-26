@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-3">
            <a href="{{ route('albums.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
        <div class="card col-12 mt-3">
            <div class="card-header">Edit Album</div>
            <div class="card-body">
                <form action="{{ route('albums.update', $album) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row form-group">
                        <div class="col-12">
                            <label for="name" class="required">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $album->name }}" required>
                        </div>
                        <div class="col-12">
                            <label for="picture">Pictures
                            </label>
                            <div class="needsclick dropzone " id="picture-dropzone">

                            </div>
                            @if ($errors->has('picture'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('picture') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">SAVE</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var uploadedPictureMap = {}
        Dropzone.options.pictureDropzone = {
            url: '{{ route('albums.storeMedia') }}',

            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },

            success: function(file, response) {
                $('form').append('<input type="hidden" name="picture[]" value="' + response.name + '">')
                uploadedPictureMap[file.name] = response.name
            },

            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedPictureMap[file.name]
                }
                $('form').find('input[name="picture[]"][value="' + name + '"]').remove()
            },

            init: function() {
                @if (isset($album) && $album->pictures)
                    var files = {!! json_encode($album->pictures) !!}
                    for (var i in files) {
                        let file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="picture[]" value="' + file.file_name + '">')
                    }
                @endif
            },

        }
    </script>
@endsection
