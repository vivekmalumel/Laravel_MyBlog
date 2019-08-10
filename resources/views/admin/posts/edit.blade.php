@extends('layouts.app')


@section('content')

    @if(count($errors)> 0)
        <ul class="list-group">
        @foreach($errors->all() as $error )
            <li class="list-group-item text-danger">{{ $error }}</li>

        @endforeach
    </ul>


    @endif
    <div class="card card-default">
    <div class="card-header">
        <h2 class="card-title">Update Post: {{$post->title}}</h2>
    </div>
        <div class="card-body">
        <form action="{{ route('post.update',['id'=>$post->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                <input type="text" name="title" value="{{$post->title}}" class="form-control">
                </div>

                <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category" class="form-control">
                            <option value="">--Select Category--</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id}}"
                                @if($category->id == $post->category_id)
                                selected
                                @endif
                                >{{ $category->name}}</option>
                        @endforeach
                        </select>
                    </div>

                <div class="form-group">
                        <label for="featured">Featured Image</label>
                        <div class="form-control">
                            <img src="{{asset($post->featured)}}" alt="{{$post->title}}" width="150" height="100">

                        <label class="btn btn-primary"> Change Image<input type="file" name="featured" class="form-control" id="file_upload" style="display:none"></label>
                        <span id="sel_file_name"></span>
                    </div>
                </div>

                <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" rows="5" cols="5" id="content" class="form-control">
                          {{$post->content}}
                        </textarea>
                </div>
                <div class="form-group">
                        <label for="tags">Select Tags</label>
                        <div class="form-control">
                        @foreach($tags as $tag)
                        <div class="checkbox">
                            <label><input type="checkbox" name="tags[]" value="{{$tag->id}}"

                                    @foreach($post->tags as $t)
                                        @if($tag->id == $t->id)
                                            {{"checked"}}
                                        @endif
                                    @endforeach

                            >{{$tag->tag}}</label>
                        </div>
                        @endforeach
                        </div>
                    </div>

                <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">Update Post</button>
                        </div>
                </div>

            </form>

        </div>
    </div>

@endsection

@section('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@stop


@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
    $(document).ready(function() {
        $('#content').summernote();
    });
</script>
@stop
