@extends('layouts.app')

@section('content')

<div class="container row">
    @foreach ($apartments as $apartment)

    <div class="card">
        <h2>{{ $apartment->title }}</h2>
        <img class="img-fluid" src="{{ asset('storage/'. $apartment->img_url) }}" alt="{{ $apartment->title }}">
        <h6><span class="weight-light">Prezzo:</span> {{$apartment->price}}€</h6>
        <h6><span class="weight-light">Stanze:</span> {{$apartment->room_qty}}</h6>
        <h6><span class="weight-light">Posti Letto:</span> {{$apartment->bed_qty}}</h6>
        <h6><span class="weight-light">Bagni:</span> {{$apartment->bathroom_qty}}</h6>
        <h6><span class="weight-light">m&sup2;:</span> {{$apartment->sqr_meters}}</h6>

        <h5>Servizi</h5>
        @forelse($apartment->services as $service)
        <h6 class="weight-light">{{ $service->name }}</h6>
        @empty
        <h6 classe="">Nessun servizio compreso</h6>
        @endforelse

    </div>

    
    @endforeach
</div>

@endsection

<style>

    .card {
        margin: 25px 25px 0 0;
    }
    img {
        width: 200px;
    }

</style>