@extends('layouts.app')

@section('content')
    
    <button><a href="{{ route('search') }}">SEARCH</a></button>
    
    <div>
        <ul>
        @foreach($apts as $apt)
            <li>ID: {{ $apt->id }}<br>Views:{{ $apt->views }}</li>
        @endforeach
        </ul>
    </div>
            
@endsection