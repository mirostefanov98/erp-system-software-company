@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <img src="{{ asset('storage/'.$user->image_path) }}" class="float-left m-3 rounded-circle" alt="No image"
                    width="150px" height="150px">
                <h2>{{ $user->firstname }}'s Profile</h2>
                <form enctype="multipart/form-data" action="{{ route('update_avatar') }}" method="POST" class="row">
                    @csrf
                    <label class="form-label m-1">Upload new Profile picture</label>
                    <input type="file" name="image" class="form-control m-1 p-1" accept="image/*">
                    <input type="submit" class="btn btn-primary m-1" value="Change profile picture">
                </form>
            </div>
        </div>
    </div>
@endsection
