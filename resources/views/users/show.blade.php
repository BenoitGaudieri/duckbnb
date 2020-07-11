@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{ $apartment->id }}
    </div>
    <div class="row">
        {{ $apartment->title }}
    </div>
    <div class="row">
        {{ $apartment->description }}
    </div>
    <div class="row">
        <img src="{{ asset('storage/'. $apartment->img_url) }}" alt="{{ $apartment->title }}">
    </div>
    <div class="row">
        {{ $apartment->views }}
    </div>
    <div class="row">
        {{ $apartment->lat }}
    </div>
    <div class="row">
        {{ $apartment->lng }}
    </div>
    <div class="row">
        <h3>Services</h3>
        @forelse($apartment->services as $service)
            <span class="badge badge-pill badge-primary">
                {{ $service->name }}
            </span>
        @empty
            <span>No services available</span>
        @endforelse
    </div>
</div>
@endsection