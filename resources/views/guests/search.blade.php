@extends('layouts.app')

@section('content')

<style>
    img {
        width: 100%;
    }

</style>

<div class="ais-InstantSearch container">
    <h1>Search</h1>

    <div class="left-panel">
      <div id="clear-refinements"></div>

      <h2>Servizi</h2>
      <div id="services"></div>
    </div>

    <div class="right-panel">
      <div id="searchbox" class="ais-SearchBox"></div>
      <div id="hits"></div>
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