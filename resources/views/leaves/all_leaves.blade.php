@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h2>All Days off</h2>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered text-center ">
            <thead>
                <tr>
                    <th scope="col">@sortablelink('user_id', 'Name')</th>
                    <th scope="col">Start date</th>
                    <th scope="col">End date</th>
                    <th scope="col" style="width: 30%">Description</th>
                    <th scope="col">@sortablelink('state')</th>
                    <th scope="col" style="width: 20%">Actions</th>
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
                        <td>
                            <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST">

                                <a class="btn btn-primary my-1" href="{{ route('leaves.change_state', $leave->id) }}">
                                    @if ($leave->state == 0)
                                        Аpprove
                                    @else
                                        Cancel
                                    @endif
                                </a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger  my-1"
                                    onclick="if(!confirm('Are you sure to delete this leave?')) return false ">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $leaves->links() }}
@endsection
