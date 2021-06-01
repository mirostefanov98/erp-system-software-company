@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Project: {{ $project->name }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger my-2">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Project name:</strong>
                    <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>State:</strong>
                    <select class="form-control" name="state" id="exampleSelect1" required>
                        <option @if ($project->state == 0) selected @endif
                            value="0">
                            Active
                        </option>
                        <option @if ($project->state == 1) selected @endif
                            value="1">Finished</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Deadline date:</strong>
                    <input class="form-control" type="date" name="date" value="{{ $project->deadline_date }}"
                        id="example-date-input" required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="form-control" name="status" id="exampleSelect1">
                        <option @if ($project->status == 0) selected @endif
                            value="0">0%</option>
                        <option @if ($project->status == 25) selected @endif
                            value="25">25%</option>
                        <option @if ($project->status == 50) selected @endif
                            value="50">50%</option>
                        <option @if ($project->status == 75) selected @endif
                            value="75">75%</option>
                        <option @if ($project->status == 100) selected @endif
                            value="100">100%</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Add users:</strong>
                    <select multiple class="form-control" name="users[]" id="exampleSelect1" size="6">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @foreach ($project->users as $item)  @if ($user->id==$item->id)
                                selected @endif
                        @endforeach
                        >
                        {{ $user->firstname }}
                        {{ $user->lastname }} - position:
                        {{ $user->position }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
@endsection
