@extends('layouts.app')

@section('content')

<div class="container show-page">
    @foreach ($apartments as $apartment)

    <div class="card">
        
    </div>
    
    <h2>{{ $apartment->id }}</h2>
    <h2>{{ $apartment->title }}</h2>

    
    @endforeach
</div>

@endsection