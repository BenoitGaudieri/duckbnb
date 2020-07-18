<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('img/favicon.png')}}" sizes="48x48" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @stack('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">

        <header class="navbar navbar-expand-md shadow-sm fixed-top">
            <div class="container">
                <div class="logo-container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="img-fluid" src="{{ asset('img/logo-header.png')}}" alt="Duckbnb">
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span><ion-icon class="hamburger-menu" name="menu-outline"></ion-icon></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mr-2">
                            <a href="{{ route("search") }}" class="nav-link">Cerca</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Iscriviti</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><ion-icon class="login-icon" name="lock-open"></ion-icon></a>
                            </li>
                        @else
                            <div class="nav-auth-link">
                                <a class="nav-item mr-2" href="{{ route('user.apartments.index') }}">
                                    Dashboard
                                </a>
                                <a class="nav-item mr-2" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            <li class="nav-item dropdown">
                                <span id="navbarDropdown" class="nav-item--user nav-link" href="#" role="" data-toggle="" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="nav-item--user--avatar">
                                        @if(Auth::user()->path_img == 'img/avatar-default.png')
                                        <img class="img-fluid" src="{{ asset(Auth::user()->path_img) }}" alt="">
                                        @else
                                        <img class="img-fluid" src="{{ asset('storage/' . Auth::user()->path_img) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="nav-item--user--name">
                                        @if(!empty(Auth::user()->first_name))
                                        {{  Auth::user()->first_name }}
                                        @else
                                        {{Auth::user()->email}}
                                        @endif
                                    </div>
                                    {{-- <span class="caret"></span> --}}
                                </span>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </header>
       

   


       