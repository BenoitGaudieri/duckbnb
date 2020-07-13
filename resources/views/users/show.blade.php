@extends('layouts.app')

@section('content')


<style>
    /* The map needs dimensions to be displayed */
    #mapid {
        height: 500px;
        width: 1000px;
    }

    /* The map div */
    .map-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding-top: 50px;
    }
</style>
<div class="container">

    <div class="map-wrapper">
        <div class="mapid" id="mapid"></div>
        <h2>Your address:</h2>
        <h3 id="address"></h3>
    </div>


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
        Views: {{ $apartment->views }}
    </div>
    <div class="row" id="lat">
        {{ $apartment->lat }}
    </div>
    <div class="row" id="lng">
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
