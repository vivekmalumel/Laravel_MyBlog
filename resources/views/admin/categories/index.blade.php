@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">All Categories</h2>
    </div>
    <div class="card-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th>
                Category Name
            </th>

            <th>
                Editing
            </th>

            <th>
                Deleting
            </th>
        </tr>
    </thead>
    <tbody>
    @if($categories->count()>0)
        @foreach($categories as $category)
            <tr>
                <td>
                    {{ $category->name }}
                </td>
                <td>
                    <a href="{{ route('category.edit',['id'=> $category->id])}}" class="btn btn-xs btn-info">
                        <span class="fas fa-pencil-alt"></span>
                    </a>
                </td>
                <td>
                    <a href="{{ route('category.delete',['id'=> $category->id])}}" class="btn btn-xs btn-info">
                                <span class="fas fa-trash-alt text-danger" ></span>
                    </a>
                </td>

            </tr>


        @endforeach
    @else
            <th colspan="3">No categories found</th>
    @endif
    </tbody>
</table>
</div>
</div>

@stop
