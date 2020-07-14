@extends('layouts.app')

@section('content')
    
    <button><a href="{{ route('search') }}">SEARCH</a></button>
        <div>
            <ul>
                @foreach($apartments as $apt)
                    @if ($apt->is_visible==1)
                        <li>ID: {{ $apt->id }}<br>Views:{{ $apt->views }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
            
@endsection