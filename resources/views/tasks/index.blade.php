@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h2>Tasks of project: {{ $project->name }}</h2>
        </div>
        <div class="col-8 my-1">
            <a class="btn btn-primary" href="{{ url()->previous() }}    "> Back</a>
            @if (Auth::user()->role <= 1)
                <a class="btn btn-primary" href="{{ route('tasks.create', $project->id) }}">Add</a>
            @endif
        </div>
    </div>
    <table class="table table-bordered text-center ">
        <thead>
            <tr>
                <th scope="col">Task name</th>
                <th scope="col">Status</th>
                <th scope="col">Priority</th>
                <th scope="col">Description</th>
                <th scope="col">State</th>
                <th scope="col">Actions</th>
            </tr>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>

                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $task->status }}%;"
                                aria-valuenow="{{ $task->status }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $task->status }}%</div>
                        </div>
                    </td>
                    <td>
                        @switch($task->priority)
                            @case(1)
                                <p class="text-success">Low</p>
                            @break

                            @case(2)
                                <p class="text-primary">Medium</p>
                            @break
                            @case(3)
                                <p class="text-danger">High</p>
                            @break
                        @endswitch

                    </td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if ($task->state == 0)
                            Active
                        @else
                            Finished
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
@endsection
