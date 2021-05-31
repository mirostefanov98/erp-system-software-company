@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h2>All Projects</h2>
        </div>
        <div class="col-8 my-1">
            <a class="btn btn-primary" href="{{ route('projects.create') }}">Add</a>
        </div>
    </div>
    <table class="table table-bordered text-center ">
        <thead>
            <tr>
                <th scope="col">Project name</th>
                <th scope="col">State</th>
                <th scope="col">Deadline date</th>
                <th scope="col">Status</th>
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
                            Active
                        @else
                            Finished
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
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">

                            <a class="btn btn-primary" href="{{ route('tasks.index', $project->id) }}">Tasks</a>

                            <a class="btn btn-primary" href="{{ route('projects.edit', $project->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" @if ($project->state == 0) disabled @endif
                                onclick="if(!confirm('Are you sure to delete this project?')) return false ">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
