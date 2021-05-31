@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Change status and state of task: {{ $task->name }} of project: {{ $task->project->name }}</h2>
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

    <form action="{{ route('tasks.change_update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

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
                    <option @if ($task->state == 0) selected @endif value="0">
                        Active
                    </option>
                    <option @if ($task->state == 1) selected @endif value="1">
                        Finished</option>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Change</button>
        </div>
        </div>

    </form>
@endsection
