@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">All Tags</h2>
    </div>
    <div class="card-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th>
                Tag
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
    @if($tags->count()>0)
        @foreach($tags as $tag)
            <tr>
                <td style="vertical-align: middle;">
                    {{ $tag->tag }}
                </td>
                <td style="vertical-align: middle;">
                    <a href="{{ route('tag.edit',['id'=> $tag->id])}}" class="btn btn-xs btn-info">
                        <span class="text-white">Edit</span>
                    </a>
                </td>
                <td style="vertical-align: middle;">
                    <a href="{{ route('tag.delete',['id'=> $tag->id])}}" class="btn btn-xs btn-danger">
                                <span class="text-white" >Delete</span>
                    </a>
                </td>

            </tr>


        @endforeach
    @else
            <th colspan="3" class="text-center">No Tags Yet!</th>
    @endif
    </tbody>
</table>
</div>
</div>

@stop
