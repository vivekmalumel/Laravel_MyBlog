@extends('layouts.app')


@section('content')

    @include('admin.includes.errors')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Create New Category</h2>
        </div>
        <div class="card-body">
        <form action="{{ route('category.store')}}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">Store Category</button>
                        </div>
                </div>

            </form>

        </div>
    </div>

@endsection
