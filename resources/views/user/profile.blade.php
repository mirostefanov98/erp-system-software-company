@extends('layouts.app')

@section('content')

    <div class="row justify-content-start">
        <div class="col-md-3 text-center">
            <img src="{{ asset('storage/' . $user->image_path) }}" class="m-3 rounded-circle" alt="No image" width="150px"
                height="150px">
        </div>
        <div class="col-md-3">
            <h2>{{ $user->firstname }}'s Profile</h2>
            <h5><b>Firstname:</b> {{ $user->firstname }}</h5>
            <h5><b>Lastname:</b> {{ $user->lastname }}</h5>
            <h5><b>Email:</b> {{ $user->email }}</h5>
            <h5><b>Telephone number:</b> {{ $user->number }}</h5>
            <h5><b>Position:</b> {{ $user->position }}</h5>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-3">
            <form enctype="multipart/form-data" action="{{ route('update_avatar') }}" method="POST">
                @csrf
                <h5>Upload new Profile picture</h5>
                <input type="file" name="image" class="form-control p-1" accept="image/*">
                <input type="submit" class="btn btn-primary m-1" value="Change profile picture">
            </form>
        </div>
        <div class="col-md-7 offset-md-2">
            <form enctype="multipart/form-data" action="{{ route('change_password') }}" method="POST">
                @csrf
                <h5>Change password</h5>
                <div class="mb-3 row">
                    <label for="old_password" class="col-sm-4 col-form-label">Current Password:</label>
                    <div class="col-sm-5">
                        <input type="password" name="old_password" class="form-control" id="old_password">
                        @if ($errors->has('old_password'))
                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="new_password" class="col-sm-4 col-form-label">New Password:</label>
                    <div class="col-sm-5">
                        <input type="password" name="new_password" class="form-control" id="new_password">
                        @if ($errors->has('new_password'))
                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="confirm_password" class="col-sm-4 col-form-label">New Confirm Password:</label>
                    <div class="col-sm-5">
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                        @if ($errors->has('confirm_password'))
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-5">
                        <input type="submit" class="btn btn-primary m-1" value="Change Password">
                    </div>
                </div>
            </form>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

@endsection
