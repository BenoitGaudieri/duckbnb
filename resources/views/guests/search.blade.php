@extends('layouts.app')

@section('content')

<style>
    img {
        width: 100%;
    }

    .left-panel {
        display: flex;
        justify-content: space-between;
    }

    #range-slider {
        width: 300px;
    }

</style>

<div class="ais-InstantSearch container search">
    <div class="left-panel">

        <div class="search-group">
            <h2>Servizi</h2>
            <div id="services"></div>
            
        </div>
    {{-- <div class="search-group">
        <h4>Bagni:</h4>
        <div id="bathrooms_qty"></div>
    </div> --}}
        <div class="search-group">
            <h4>Letti:</h4>
            <div id="beds_qty"></div>

        </div>

        <div class="search-group">
            <h4>Stanze:</h4>
            <div id="rooms_qty"></div>
        </div>

        <div class="search-group">
            <h4>Prezzo:</h4>
            <div id="range-slider"></div>
        </div>

        </div>
        
    <h1>Search</h1>
    <div id="clear-refinements"></div>
    <div class="right-panel">
        <div id="searchbox" class="ais-SearchBox"></div>
        <div id="hits"></div>
        <div class="search-group">
            <h2>Cerca per meta</h2>
            <input id="address-input" placeholder="Cerca per meta"/>
            <span id="results"></span>
        </div>
        <div id="pagination"></div>
    </div>
</div>


@endsection

@push('scripts')
<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/instantsearch.css@7/themes/algolia-min.css"/>
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch-lite.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
<script src="{{ asset("js/search.js") }}" defer></script>    

    
@endpush