@extends('layouts.app')


@section('content')

    @include('admin.includes.errors')
    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">Edit Blog Settings</h2>
        </div>
        <div class="card-body">
        <form action="{{ route('settings.update')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="site_name">Site Name</label>
                <input type="text" name="site_name" value="{{$settings->site_name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="contact_email">Contact Email</label>
                    <input type="email" name="contact_email" value="{{$settings->contact_email}}" class="form-control">
                </div>
                <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="number" name="contact_number" value="{{$settings->contact_number}}" class="form-control">
                </div>
                <div class="form-group">
                        <label for="address">Content</label>
                <textarea name="address" rows="5" cols="5" id="address" class="form-control">{{$settings->address}}</textarea>
                </div>
                <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">Update Settings</button>
                        </div>
                </div>

            </form>

        </div>
    </div>

@endsection
