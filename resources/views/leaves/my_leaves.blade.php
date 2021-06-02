@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h2>My leaves</h2>
        </div>
        <div class="col-8 my-1">
            <a class="btn btn-primary" href="{{ route('leaves.create') }}">Add</a>
        </div>
    </div>
    <table class="table table-bordered text-center ">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Description</th>
                <th scope="col">State</th>
            </tr>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{ $leave->user->firstname }} {{ $leave->user->lastname }}</td>
                    <td>{{ $leave->start_date }}</td>
                    <td>{{ $leave->end_date }}</td>
                    <td>{{ $leave->description }}</td>
                    <td>
                        @if ($leave->state == 0)
                            <strong class="text-danger">Unapproved</strong>
                        @else
                            <strong class="text-success">Approved</strong>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $leaves->links() }}
@endsection
