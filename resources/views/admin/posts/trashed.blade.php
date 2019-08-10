@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Trashed Posts</h2>
    </div>
    <div class="card-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th>
                Image
            </th>

            <th>
                Title
            </th>
            <th>
                Edit
            </th>

            <th>
                Restore
            </th>
            <th>
                Delete
            </th>
        </tr>
    </thead>
    <tbody>
    @if($posts->count()>0)
        @foreach($posts as $post)
            <tr>
                <td style="vertical-align: middle;">
                <img src="{{ $post->featured }}" alt="{{ $post->title }}" height="100">
                </td>
                <td style="vertical-align: middle;">
                    {{ $post->title }}
                </td>
                <td style="vertical-align: middle;">
                    <a href="{{ route('post.edit',['id'=> $post->id])}}" class="btn btn-xs btn-info">
                        <span class="fas fa-pencil-alt"></span>
                    </a>
                </td>
                <td style="vertical-align: middle;">
                    <a href="{{ route('post.restore',['id'=> $post->id])}}" class="btn btn-xs btn-success">
                                <span class="text-white" >Restore</span>
                    </a>
                </td>

                <td style="vertical-align: middle;">
                    <a href="{{ route('post.kill',['id'=> $post->id])}}" class="btn btn-xs btn-danger">
                                <span class="text-white" >Delete</span>
                    </a>
                </td>

            </tr>


        @endforeach
    @else
            <th colspan="5">No Trashed Posts Found</th>
    @endif
    </tbody>
</table>
</div>
</div>

@stop
