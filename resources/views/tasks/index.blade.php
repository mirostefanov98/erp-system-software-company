@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Tasks of project: {{ $project->name }}</h2>
        </div>
        <div class="col-12 my-1">
            <div class="row">
                <div class="col-8">
                    @if (Auth::user()->role <= 1)
                        <a class="btn btn-primary" href="{{ route('tasks.create', $project->id) }}">Add</a>
                    @endif
                </div>
                <div class="col-4">
                    <form class="d-flex" action="{{ route('tasks.search', $project->id) }}" method="GET">
                        <input class="form-control mx-1" type="search" name="search" aria-label="Search"
                            placeholder="Task name/Description" required />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered text-center ">
        <thead>
            <tr>
                <th scope="col">@sortablelink('priority')</th>
                <th scope="col">Task name</th>
                <th scope="col">@sortablelink('status')</th>
                <th scope="col" style="width: 30%">Description</th>
                <th scope="col">@sortablelink('state')</th>
                <th scope="col" style="width: 20%">Actions</th>
            </tr>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($tasks as $task)
                <tr>
                    <td>
                        @switch($task->priority)
                            @case(1)
                                <strong class="text-success">Low</strong>
                            @break

                            @case(2)
                                <strong class="text-primary">Medium</strong>
                            @break
                            @case(3)
                                <strong class="text-danger">High</strong>
                            @break
                        @endswitch

                    </td>
                    <td>{{ $task->name }}</td>
                    <td>

                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $task->status }}%;"
                                aria-valuenow="{{ $task->status }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $task->status }}%</div>
                        </div>
                    </td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if ($task->state == 0)
                            <strong class="text-success">In Progress</strong>
                        @else
                            <strong class="text-danger">Done</strong>
                        @endif
                    </td>
                    <td>
                        @if (Auth::user()->role <= 1)
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">

                                <a class="btn btn-primary" href="{{ route('tasks.edit', $task->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" @if ($task->state == 0) disabled @endif
                                    onclick="if(!confirm('Are you sure to delete this task?')) return false ">
                                    Delete
                                </button>
                            @else
                                <a class="btn btn-primary" href="{{ route('tasks.change', $task->id) }}">Change
                                    status</a>

                        @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tasks->appends(Request::all())->links() }}
@endsection
