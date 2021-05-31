@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h2>Users in company</h2>
        </div>
        <div class="col-8 my-1">
            <a class="btn btn-primary" href="{{ route('register') }}">Add</a>
        </div>
    </div>
    <table class="table table-bordered text-center ">
        <thead>
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Number</th>
                <th scope="col">Position</th>
                <th scope="col">Role</th>
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
@endsection
