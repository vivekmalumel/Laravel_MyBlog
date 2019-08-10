@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">All Posts</h2>
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
                Author
            </th>
            <th>
                Edit
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
                <td style="vertical-align: middle;" class="text-info">
                    <a href="{{ route('user.posts',['id'=> $post->user->id])}}">{{ $post->user->name }}</a>
                </td>
                <td style="vertical-align: middle;">
                    <a href="{{ route('post.edit',['id'=> $post->id])}}" class="btn btn-xs btn-info">
                        <span class="text-white">Edit</span>
                    </a>
                </td>
                <td style="vertical-align: middle;">
                    <a href="{{ route('post.delete',['id'=> $post->id])}}" class="btn btn-xs btn-danger">
                                <span class="text-white" >Trash</span>
                    </a>
                </td>

            </tr>


        @endforeach
    @else
            <th colspan="5">No Posts Found</th>
    @endif
    </tbody>
</table>
</div>
</div>

@stop
