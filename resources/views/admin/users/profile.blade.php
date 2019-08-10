@extends('layouts.app')


@section('content')

    @include('admin.includes.errors')
    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">Edit Your Profile</h2>
        </div>
        <div class="card-body">
        <form action="{{ route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="avatar">Upload Avatar</label>
                <input type="file" name="avatar"  class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-control"><input type="checkbox" id="change_pwd">Change Password</label>
                    <label for="password">New Password</label>
                <input type="password" name="password" id="new_password"  class="form-control" disabled="true">
                </div>
                <div class="form-group">
                    <label for="about">About</label>
                <textarea name="about" class="form-control" cols="30" rows="10">{{ $user->profile->about }}</textarea>
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook Profile</label>
                <input type="text" name="facebook" value="{{ $user->profile->facebook }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="youtube">Youtube Profile</label>
                <input type="text" name="youtube" value="{{ $user->profile->youtube }}" class="form-control">
                </div>

                <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">Update Profile</button>
                        </div>
                </div>

            </form>

        </div>
    </div>

@endsection
