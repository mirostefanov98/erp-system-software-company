@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>All Projects</h2>
        </div>
        <div class="col-12 my-1">
            <div class="row">
                <div class="col-8">
                    @if (Auth::user()->role <= 1)
                        <a class="btn btn-primary" href="{{ route('projects.create') }}">Add</a>
                    @endif
                </div>
                <div class="col-4">
                    <form class="d-flex" action="{{ route('projects.search') }}" method="GET">
                        <input class="form-control mx-1" type="search" name="search" aria-label="Search"
                            placeholder="Project name" required />
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
                    <th scope="col">Project name</th>
                    <th scope="col">@sortablelink('state')</th>
                    <th scope="col">@sortablelink('deadline_date','Deadline date')</th>
                    <th scope="col" style="width:15%">@sortablelink('status')</th>
                    <th scope="col">Users</th>
                    @if (Auth::user()->role == 0 || Auth::user()->role == 1)
                        <th scope="col">Actions</th>
                    @endif
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
                        @if (Auth::user()->role <= 1)
                            <td>
                                @if (Auth::user()->role == 0)
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">

                                        <a class="btn btn-primary  my-1"
                                            href="{{ route('tasks.index', $project->id) }}">Tasks</a>

                                        <a class="btn btn-primary  my-1"
                                            href="{{ route('projects.edit', $project->id) }}">Edit</a>

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger  my-1" @if ($project->state == 0) disabled @endif
                                            onclick="if(!confirm('Are you sure to delete this project?')) return false ">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    @foreach ($project->users as $user)
                                        @if (Auth::user()->id == $user->id)
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">

                                                <a class="btn btn-primary my-1"
                                                    href="{{ route('tasks.index', $project->id) }}">Tasks</a>

                                                <a class="btn btn-primary my-1"
                                                    href="{{ route('projects.edit', $project->id) }}">Edit</a>

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger my-1" @if ($project->state == 0) disabled @endif
                                                    onclick="if(!confirm('Are you sure to delete this project?')) return false ">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $projects->appends(Request::all())->links() }}
@endsection
