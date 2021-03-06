@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>My Projects - {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
        </div>
        <div class="col-12 my-1">
            <div class="row">
                <div class="col-8">
                </div>
                <div class="col-4">
                    <form class="d-flex" action="{{ route('my_projects.search') }}" method="GET">
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
                            <a class="btn btn-primary my-1" href="{{ route('tasks.index', $project->id) }}">Tasks</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $projects->appends(Request::all())->links() }}
@endsection
