@extends('layouts.app')

@section('content')
    
    <button><a href="{{ route('search') }}">SEARCH</a></button>
    
    <div>
        <ol>
        @foreach($apts as $apt)
            <li>{{ $apt->id }}<br>{{ $apt->views }}</li>
        @endforeach
        </ol>
    </div>
            
@endsection