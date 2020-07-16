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

    @if (!empty($apartments) && count($apartments) > 0)
    <button id="reset">Resetta filtri</button>
    <select name="Rooms" id="select-rooms">
        <option value="">Rooms number</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4+">4+</option>
    </select>
    
    <div id="check-servizi">
        <label for="wifi">WiFi</label> <input type="checkbox" name="wifi" id="wifi" value="WiFi">
        <label for="car">Posto Macchina</label> <input type="checkbox" name="car" id="car" value="Posto Macchina">
        <label for="pool">Piscina</label> <input type="checkbox" name="pool" id="pool" value="Piscina">
        <label for="portin">Portineria</label> <input type="checkbox" name="portin" id="portin" value="Portineria">
        <label for="sauna">Sauna</label> <input type="checkbox" name="sauna" id="sauna" value="Sauna">
        <label for="mare">Vista Mare</label> <input type="checkbox" name="mare" id="mare" value="Vista Mare">
        <label for="ac">Aria Condizionata</label> <input type="checkbox" name="ac" id="ac" value="Aria Condizionata">
        <label for="fuma">Fumatori</label> <input type="checkbox" name="fuma" id="fuma" value="Fumatori">
        <label for="colazione">Prima Colazione</label> <input type="checkbox" name="colazione" id="colazione" value="Prima Colazione">
    </div>

    {{-- <button id="test">Test ajax</button> --}}

    <div class="row">
        @foreach ($apartments as $apartment)
        <div class="card">
        <a href="{{ route('show', $apartment->id) }}" class="card-apt--img">
            <h2>{{ $apartment->title }}</h2>
        </a>
        <img class="img-fluid" src="{{ asset('storage/'. $apartment->img_url) }}" alt="{{ $apartment->title }}">
        <h6><span class="weight-light price">Prezzo:</span> {{$apartment->price}}€</h6>
        <h6><span class="weight-light">Stanze:</span> <span class="rooms">{{$apartment->room_qty}}</span></h6>
        <h6><span class="weight-light">Posti Letto:</span> {{$apartment->bed_qty}}</h6>
        <h6><span class="weight-light">Bagni:</span> {{$apartment->bathroom_qty}}</h6>
        <h6><span class="weight-light">m&sup2;:</span> {{$apartment->sqr_meters}}</h6>

        <script>
            idArr.push({{ $apartment->id }})

        </script>

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

@push('scripts')
<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/instantsearch.css@7/themes/algolia-min.css"/>
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch-lite.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
<script src="{{ asset("js/search.js") }}" defer></script>
<script src="{{ asset("js/select.js") }}" defer></script>
@endpush