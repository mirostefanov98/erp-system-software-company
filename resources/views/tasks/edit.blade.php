@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit task: {{ $task->name }} of project: {{ $task->project->name }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tasks.index', $task->project_id) }}"> Back</a>
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

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Task name:</strong>
                    <input type="text" name="name" value="{{ $task->name }}" class="form-control" placeholder="Task name"
                        required>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" name="description" placeholder="Description of task"
                        id="exampleFormControlTextarea1" rows="3" required>{{ $task->description }}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Priority:</strong>
                    <select class="form-control" name="priority" id="exampleFormControlSelect1" required>
                        <option @if ($task->priority == 1) selected @endif
                            value="1">Low</option>
                        <option @if ($task->priority == 2) selected @endif
                            value="2">Medium</option>
                        <option @if ($task->priority == 3) selected @endif
                            value="3">High</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="form-control" name="status" id="exampleSelect1">
                        <option @if ($task->status == 0) selected @endif
                            value="0">0%</option>
                        <option @if ($task->status == 25) selected @endif
                            value="25">25%</option>
                        <option @if ($task->status == 50) selected @endif
                            value="50">50%</option>
                        <option @if ($task->status == 75) selected @endif
                            value="75">75%</option>
                        <option @if ($task->status == 100) selected @endif
                            value="100">100%</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>State:</strong>
                    <select class="form-control" name="state" id="exampleSelect1">
                        <option @if ($task->state == 0) selected @endif
                            value="0">
                            Active
                        </option>
                        <option @if ($task->state == 1) selected @endif
                            value="1">Finished</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </div>

    </form>
@endsection
