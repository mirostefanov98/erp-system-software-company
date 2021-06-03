@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>All Users</h2>
        </div>
        <div class="col-12 my-1">
            <div class="row">
                <div class="col-8">
                    <a class="btn btn-primary" href="{{ route('register') }}">Add</a>
                </div>
                <div class="col-4">
                    <form class="d-flex" action="{{ route('users.search') }}" method="GET">
                        <input class="form-control mx-1" type="search" name="search" aria-label="Search"
                            placeholder="Firstname/Lastname/Position" required />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered text-center table-responsive">
        <thead>
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Number</th>
                <th scope="col" style="width: 10%">@sortablelink('position')</th>
                <th scope="col">@sortablelink('role')</th>
                <th scope="col">Actions</th>
            </tr>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($users as $user)
                <tr>
                    <td><img src="{{ asset('storage/' . $user->image_path) }}" class="rounded-circle" alt="No image"
                            width="50px" height="50px"></td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->number }}</td>
                    <td>{{ $user->position }}</td>
                    <td>@switch($user->role)
                            @case(0)
                                Admin
                            @break

                            @case(1)
                                Project Manager
                            @break
                            @case(2)
                                Developer
                            @break
                            @case(3)
                                HR
                            @break

                        @endswitch
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">

                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" @if ($user->role == 0) disabled @endif
                                onclick="if(!confirm('Are you sure to delete this user?')) return false ">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->appends(Request::all())->links() }}
@endsection
