@extends('layouts.app')

@section('content')

<div class="container">
    
    <h2 class="weight-light">{{ $apartment->title }}</h2>
    <h4 id="address" class="text-main weight-regular"></h4>
    
    <div class="map-show">
        <div class="map-wrapper show">
            <div class="mapid" id="mapid"></div>
        </div>        
    </div>

    {{-- latlng is here for map funcionality --}}
    <div class="latlng">
        <div id="lat">
            {{$apartment->lat}}
        </div>
        <div id="lng">
            {{$apartment->lng}}
        </div>
    </div>
    
    <div class="row info">
        <div class="info-img">
            <img class="img-fluid" src="{{ asset('storage/'. $apartment->img_url) }}" alt="{{ $apartment->title }}">
        </div>
        <div class="info-detail">
            <div class="info-detail--description">
                <h5>Descrizione</h5>
                {{ $apartment->description }}
            </div>
            <div class="info-detail--data">
                <div class="info-detail--data--details">
                    <h5>Dettaglio</h5>
                    
                    <h6><span class="weight-light">Prezzo:</span> {{$apartment->price}}€</h6>
                    <h6><span class="weight-light">Stanze:</span> {{$apartment->room_qty}}</h6>
                    <h6><span class="weight-light">Posti Letto:</span> {{$apartment->bed_qty}}</h6>
                    <h6><span class="weight-light">Bagni:</span> {{$apartment->bathroom_qty}}</h6>
                    <h6><span class="weight-light">m&sup2;:</span> {{$apartment->sqr_meters}}</h6>
                </div>
                <div class="info-detail--data--services">
                    <h5>Servizi</h5>
                    @forelse($apartment->services as $service)
                        <h6 class="weight-light">{{ $service->name }}</h6>
                    @empty
                        <h6 classe="">Nessun servizio compreso</h6>
                    @endforelse
                </div>
            </div>
        </div>
    </div>    
    @if(Auth::id() == $apartment['user_id'])
        <div class="dashboard">
            <h4 class="section-title weight-light">Dashboard Proprietario</h4>
            <div class="dashboard-ctas">
                <a class="dashboard-ctas--btn button-main" href="#">Sponsorizza</a>
                <a class="dashboard-ctas--btn button-light" href="{{ route('user.apartments.edit', $apartment->id) }}">Modifica</a>
             <a class=" dashboard-ctas--btn button-dark" href="{{ route('user.stats', $apartment->id) }}">Statistiche</a> 
            <a class="dashboard-ctas--btn button-shadow" href="#">Nascondi</a>
            </div>
        </div>
    @else
        <div class="message">
            <h4 class="section-title weight-light">Contatta il proprietario</h4>
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <form method="POST" action="{{ route('send', $apartment->id) }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="La tua email">
                </div>
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" placeholder="Inserisci il tuo messaggio"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="send" value="Send" class="btn btn-info">
                </div>
            </form>
            
        </div>

        <div class="review">
            <h4 class="section-title weight-light">Scrivi una recensione</h4>
            <p>form</p>
        </div>
    @endif

    <div class="reviews">
        <h4 class="section-title weight-light">Recensioni</h4>

        <div class="row reviews-single">
            <div class="reviews-single--avatar">
                img
            </div>
            <div class="reviews-single--data">
                <p>data</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">

    @if(count($errors) > 0 )
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <ul>
                @foreach($errors ->all() as $error)
                    <li> {{ $error }}</li>  
                @endforeach
            </ul>
        </div>
    @endif

</div>

@endsection

@push('scripts')
{{-- Map --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
crossorigin=""></script>
{{-- Algolia search script for reverse geoloc --}}
<script src="https://cdn.jsdelivr.net/algoliasearch/3.31/algoliasearchLite.min.js"></script>
<script src="{{ asset("js/show-map.js") }}" defer></script>    
@endpush
