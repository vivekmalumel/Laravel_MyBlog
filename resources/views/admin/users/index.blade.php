@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">All Users</h2>
    </div>
    <div class="card-body">
<table class="table table-hover">
    <thead>
        <tr>
            <th>
                Image
            </th>

            <th>
                Name
            </th>
            <th>
                Permissions
            </th>

            <th>
                Delete
            </th>
        </tr>
    </thead>
    <tbody>
    @if($users->count()>0)
        @foreach($users as $user)
            <tr>
                <td style="vertical-align: middle;">
                <img src="{{ asset($user->profile->avatar) }}" alt="{{ $user->name }}" height="100">
                </td>
                <td style="vertical-align: middle;">
                    {{ $user->name }}
                </td>
                <td style="vertical-align: middle;">

                    @if($user->admin)
                    <a href="{{route('user.not.admin',['id' => $user->id])}}" class="btn btn-xs btn-danger">Remove Permission</a>
                    @else
                        <a href="{{route('user.admin',['id' => $user->id])}}" class="btn btn-xs btn-success">Make Admin</a>
                    @endif

                </td>
                <td style="vertical-align: middle;">
                    <a href="{{ route('user.delete',['id'=> $user->id])}}" class="btn btn-xs btn-danger">
                                <span class="text-white" >Delete</span>
                    </a>
                </td>

            </tr>


        @endforeach
    @else
            <th colspan="5">No Users Found</th>
    @endif
    </tbody>
</table>
</div>
</div>

@stop
