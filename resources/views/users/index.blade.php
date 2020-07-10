{{-- PAGINA VISUALIZZATA DOPO LOGIN --}}

@extends('layouts.app')
{{-- HEADER --}}
{{-- <h2>{{ Auth::user()->email }}</h2>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div> --}}
{{-- FINE HEADER --}}


@section('content')
<h1>Home/User</h1>

<h2>I tuoi appartamenti!</h2>
<ul>
    @foreach ($apartments as $apt)
        <li>{{ $apt->id }}</li>
    @endforeach
</ul>

    
@endsection