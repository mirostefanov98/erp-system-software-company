@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Request New Leave</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('leaves.my_leaves') }}"> Back</a>
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

    <form action="{{ route('leaves.store') }}" method="POST">
        @csrf

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Start date:</strong>
                <input class="form-control" type="date" name="start_date" value="{{ date('Y-m-d') }}"
                    min="{{ date('Y-m-d') }}" id="example-date-input" required>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End date:</strong>
                <input class="form-control" type="date" name="end_date" value="{{ date('Y-m-d') }}"
                    min="{{ date('Y-m-d') }}" id="example-date-input" required>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea class="form-control" name="description" placeholder="Description for Leave"
                    id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Request</button>
        </div>
        </div>

    </form>
@endsection
