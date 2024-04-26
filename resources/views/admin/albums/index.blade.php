@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-3">
                <a href="{{ route('albums.create') }}" class="btn btn-success">
                    Create Album
                </a>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">Albums List</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($albums as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->name ?? '-' }}</td>
                                        <td>
                                            <button class="btn btn-dark dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('albums.edit', $value->id) }}">Edit</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('albums.show', $value->id) }}">Show</a></li>
                                                <li>
                                                    <form action="{{ route('albums.destroy', $value->id) }}" method="post"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </li>
                                                @if ($value->pictures->count() != 0)
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('albums.transfer-pics-blade', $value->id) }}">Move
                                                            Pics And
                                                            Delete</a></li>
                                                @endif

                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
