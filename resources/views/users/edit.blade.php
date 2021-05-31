@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit User: {{ $user->firstname }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Number') }}</label>

            <div class="col-md-6">
                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number"
                    value="{{ $user->number }}" autocomplete="number" autofocus>

                @error('number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

            <div class="col-md-6">
                <input id="position" type="text" class="form-control @error('position') is-invalid @enderror"
                    name="position" value="{{ $user->position }}" autocomplete="position" autofocus>

                @error('position')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
            <div class="col-md-6">
                <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" autofocus>
                    <option disabled>Select role</option>
                    <option @if ($user->role == 0) selected @endif value="0">
                        Admin</option>
                    <option @if ($user->role == 1) selected @endif value="1">
                        Project manager</option>
                    <option @if ($user->role == 2) selected @endif value="2">
                        Developer</option>
                    <option @if ($user->role == 3) selected @endif value="3">
                        Human Resources</option>
                </select>

                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
@endsection
