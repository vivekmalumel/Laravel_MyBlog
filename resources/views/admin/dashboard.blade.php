@extends('layouts.app')

@section('content')
                <div class="row">
                <div class="col-lg-3">
                    <div class="card  text-center">
                        <div class="card-header bg-info">
                            POSTED
                        </div>
                        <div class="card-body">
                            <h2 class="text-center">{{$post_count}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card  text-center">
                            <div class="card-header bg-danger">
                                TRASHED POSTS
                            </div>
                            <div class="card-body">
                            <h2 class="text-center">{{$trashed_count}}</h2>
                            </div>
                        </div>

                </div>

                <div class="col-lg-3">
                        <div class="card  text-center">
                                <div class="card-header bg-success">
                                    USERS
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center">{{$user_count}}</h2>
                                </div>
                            </div>

                </div>

                <div class="col-lg-3">
                        <div class="card  text-center">
                                <div class="card-header bg-warning">
                                    CATRGORIES
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center">{{$category_count}}</h2>
                                </div>
                            </div>

                    </div>
            </div>

@endsection
