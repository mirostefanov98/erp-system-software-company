@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h2>My Projects - {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
        </div>
    </div>
    <table class="table table-bordered text-center ">
        <thead>
            <tr>
                <th scope="col">Project name</th>
                <th scope="col">State</th>
                <th scope="col">Deadline date</th>
                <th scope="col" style="width:15%">Status</th>
                <th scope="col">Users</th>
                <th scope="col">Actions</th>
            </tr>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>
                        @if ($project->state == 0)
                            <strong class="text-success">Active</strong>
                        @else
                            <strong class="text-danger">Finished</strong>
                        @endif
                    </td>
                    <td>{{ $project->deadline_date }}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $project->status }}%;"
                                aria-valuenow="{{ $project->status }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $project->status }}%</div>
                        </div>

                    </td>
                    <td>
                        @foreach ($project->users as $user)
                            {{ $user->firstname }} {{ $user->lastname }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('tasks.index', $project->id) }}">Tasks</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
