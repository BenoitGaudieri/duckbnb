@extends('layouts.app')

@section('content')

<script>
var idArr = []

</script>

<div class="container">
    <form action="{{ route('search.submit') }}" method="POST">
        @csrf
        @method('POST')
        <div class="search-group">
            <input id="address-input" placeholder="Cerca per meta"/>
        </div>
        <input type="hidden" id="apartmentId" name="id[]" value="">
        <input type="submit" value="Cerca">
    </form>

    <div class="row justify-content-center">
        <h6>Modifica raggio di ricerca</h6>
    </div>
    <div class="row justify-content-center">
        <form class="row" id="select-radius">
            <input type="radio" name="radius" id="20" value="20000" checked>
            <label for="20">20 Km</label>

            <input type="radio" name="radius" id="30" value="30000">
            <label for="30">30 Km</label>

            <input type="radio" name="radius" id="50" value="50000">
            <label for="50">50 Km</label>
        </form>
    </div>

    @if (!empty($apartments) && count($apartments) > 0)
    <button id="reset">Resetta filtri</button>

    <label for="select-rooms">Numero minimo di stanze</label>
    <select name="Rooms" id="select-rooms">
        <option value="1">>1</option>
        <option value="2">>2</option>
        <option value="3">>3</option>
        <option value="4">>4</option>
    </select>
    
    <label for="select-beds">Numero minimo di letti</label>
    <select name="Rooms" id="select-beds">
        <option value="1">>1</option>
        <option value="2">>2</option>
        <option value="3">>3</option>
        <option value="4">>4</option>
    </select>
    
    <div id="check-servizi">
        <label for="wifi">WiFi</label>
        <input class="checkbox" type="checkbox" name="wifi" id="wifi" value="WiFi" data-id="1">
        
        <label for="car">Posto Macchina</label>
        <input class="checkbox" type="checkbox" name="car" id="car" value="Posto Macchina" data-id="2">
        
        <label for="pool">Piscina</label>
        <input class="checkbox" type="checkbox" name="pool" id="pool" value="Piscina" data-id="3">
        
        <label for="portin">Portineria</label>
        <input class="checkbox" type="checkbox" name="portin" id="portin" value="Portineria" data-id="4">
        
        <label for="sauna">Sauna</label>
        <input class="checkbox" type="checkbox" name="sauna" id="sauna" value="Sauna" data-id="5">
        
        <label for="mare">Vista Mare</label>
        <input class="checkbox" type="checkbox" name="mare" id="mare" value="Vista Mare" data-id="6">
        
        <label for="ac">Aria Condizionata</label>
        <input class="checkbox" type="checkbox" name="ac" id="ac" value="Aria Condizionata" data-id="7">
        
        <label for="fuma">Fumatori</label>
        <input class="checkbox" type="checkbox" name="fuma" id="fuma" value="Fumatori" data-id="8">
        
        <label for="colazione">Prima Colazione</label>
        <input type="checkbox" name="colazione" id="colazione" value="Prima Colazione" data-id="9">
    </div>

    {{-- <button id="test">Test ajax</button> --}}

    <div class="row" id="search-results">
        @foreach ($apartments as $apartment)
        <div class="card" data-id="{{ $apartment->id }}">
            <a href="{{ route('show', $apartment->id) }}" class="card-apt--img">
                <h2>{{ $apartment->title }}</h2>
            </a>
            <img class="img-fluid" src="{{ asset('storage/'. $apartment->img_url) }}" alt="{{ $apartment->title }}">
            <h6><span class="weight-light price">Prezzo:</span> {{$apartment->price}}€</h6>
            <h6><span class="weight-light">Stanze:</span> <span class="rooms">{{$apartment->room_qty}}</span></h6>
            <h6><span class="weight-light">Posti Letto:</span> {{$apartment->bed_qty}}</h6>
            <h6><span class="weight-light">Bagni:</span> {{$apartment->bathroom_qty}}</h6>
            <h6><span class="weight-light">m&sup2;:</span> {{$apartment->sqr_meters}}</h6>

            {{-- <script>
                idArr.push({{ $apartment->id }})

            </script> --}}

            <h5>Servizi</h5>
            @forelse($apartment->services as $service)
            <h6 class="weight-light nome-servizio">{{ $service->name }}</h6>
            @empty
            <h6 class="">Nessun servizio compreso</h6>
            @endforelse
        </div>
        
        @endforeach

    @endif
    </div>
</div>
@endsection

<style>

    .card {
        margin: 25px 25px 0 0;
    }
    .search-group {
        margin: 25px 25px 0 0;
    }
    img {
        width: 200px;
    }

</style>

<script id="card-template" type="text/x-handlebars-template">
    <div class="card">
        <img class="card-img" src="@{{ imgUrl }}" alt="">
        <div class="card-body">
            <ul>
                <li>@{{ title }}</li>
                <li>€@{{ price }} al giorno</li>
                <li>@{{ rooms }} stanze</li>
                <li>@{{ beds }} posti letto</li>
                <li>@{{ bathrooms }} bagni</li>
                <li>@{{ sqrMeters }} m&sup2;</li>
            </ul>
        </div>
    </div>
</script>


@push('scripts')
<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/instantsearch.css@7/themes/algolia-min.css"/>
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch-lite.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
<script src="{{ asset("js/search.js") }}" defer></script>
<script src="{{ asset("js/search-filtering.js") }}" defer></script>
{{-- <script src="{{ asset("js/select.js") }}" defer></script> --}}
@endpush