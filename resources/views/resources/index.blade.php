@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h2>Resources</h2>
        </div>
        <div class="col-12 my-1">
            <div class="row">
                <div class="col-8">
                    @if (Auth::user()->role != 2)
                        <a class="btn btn-primary" href="{{ route('resources.create') }}">Add</a>
                    @endif
                </div>
                <div class="col-4">
                    <form class="d-flex" action="{{ route('resources.search') }}" method="GET">
                        <input class="form-control mx-1" type="search" name="search" aria-label="Search"
                            placeholder="Name/Description" required />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered text-center ">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Link</th>
                    @if (Auth::user()->role != 2)
                        <th scope="col" style="width: 15%">Actions</th>
                    @endif
                </tr>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($resources as $resource)
                    <tr>
                        <td>{{ $resource->name }}</td>
                        <td>{{ $resource->description }}</td>
                        <td><a href="{{ $resource->link }}">{{ $resource->link }}</a></td>
                        @if (Auth::user()->role != 2)
                            <td>
                                <form action="{{ route('resources.destroy', $resource->id) }}" method="POST">

                                    <a class="btn btn-primary  my-1"
                                        href="{{ route('resources.edit', $resource->id) }}">Edit</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger  my-1"
                                        onclick="if(!confirm('Are you sure to delete this resource?')) return false ">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $resources->appends(Request::all())->links() }}
@endsection
