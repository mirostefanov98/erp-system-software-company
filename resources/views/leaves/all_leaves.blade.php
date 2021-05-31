@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h2>All leaves</h2>
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
                <th scope="col">Actions</th>
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
                            Unapproved
                        @else
                            Approved
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST">

                            <a class="btn btn-primary" href="{{ route('leaves.change_state', $leave->id) }}">
                                @if ($leave->state == 0)
                                    Approved
                                @else
                                    Unapproved
                                @endif
                            </a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"
                                onclick="if(!confirm('Are you sure to delete this leave?')) return false ">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
