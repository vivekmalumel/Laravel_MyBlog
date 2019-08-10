<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->




    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <style>
        #loader{
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 999;
            text-align: center;
            display: inline-flex;
            background: #80808030;
            }
            #loader>img {
                width: 100px;
                height: 100px;
                margin: auto;
            }
    </style>
@yield('styles')
</head>
<body>
    <div id="loader">
    <img src="{{url('images/loader.gif')}}" alt="">
    </div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                         <!--   <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li> -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            <div class="container">
                <div class="row">
                    @if(auth::check())
                    <div class="col-lg-4">
                        <ul class="list-group">
                                <li class="list-group-item">
                                <a href="{{ route('home') }}">Home</a>
                                    </li>

                                    <li class="list-group-item">
                                        <a href="{{ route('posts') }}">All Posts</a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ route('myposts') }}">My Posts</a>
                                        </li>

                            <li class="list-group-item">
                            <a href="{{ route('post.create') }}">Create New Post</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('posts.trashed') }}">Trashed Posts</a>
                            </li>

                            <li class="list-group-item">
                                    <a href="{{ route('categories') }}">Categories</a>
                            </li>
                            <li class="list-group-item">
                                    <a href="{{ route('category.create') }}">Create New Category</a>
                            </li>
                            <li class="list-group-item">
                                    <a href="{{ route('tags') }}">All Tags</a>
                            </li>
                            <li class="list-group-item">
                                    <a href="{{ route('tag.create') }}">Add New Tag</a>
                            </li>
                            @if(Auth::user()->admin)
                            <li class="list-group-item">
                                <a href="{{ route('users') }}">All Users</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('user.create') }}">Add User</a>
                            </li>
                            @endif
                            <li class="list-group-item">
                                <a href="{{ route('user.profile') }}">My Profile</a>
                            </li>
                            <li class="list-group-item">
                                    <a href="{{ route('settings') }}">Settings</a>
                                </li>


                        </ul>

                    </div>
                    @else
                     <div class="col-lg-2"></div>
                    @endif
                    <div class="col-lg-8">
                            @yield('content')
                    </div>
                </div>
            </div>

        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js')}}"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}");
        @endif
        @if(Session::has('info'))
            toastr.info("{{Session::get('info')}}");
        @endif
    $(document).ready(function(){
        $('#file_upload').change(function() {
            var file = $('#file_upload')[0].files[0].name;
            $('#sel_file_name').text(file);
        });

        $('#change_pwd').change(function(){

                if($(this).is(':checked'))
                    $('#new_password').prop('disabled',false);
                else
                    $('#new_password').prop('disabled',true);
        });
        setTimeout(function(){
            $('#loader').css("display","none");
        },500);

    });

    </script>

    @yield('scripts')

</body>
</html>
