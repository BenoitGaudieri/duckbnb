@extends('layouts.app')

@section('content')

    <div class="jumbotron position-relative">
        <div class="search position-absolute"></div>
    </div>

    <div class="divider"></div>


    <div class="container d-flex flex-wrap justify-content-center">
        @foreach($apartments as $apt)
            @if ($apt->is_visible==1)
                <div class="row col-4">
                    <a href="{{ route('show', $apt->id) }}" class="card mb-4">
                        <div class="card-body">
                            <img class="mb-2" width="200" height="200" src="{{ $apt->img_url }}">
                            <div class="card-title">
                                <h4>{{ $apt->title }}</h4>
                            </div>
                            <div class="card-text mb-2">
                                {{ $apt->description }}
                            </div>
                            <div class="card-text">
                                <strong>Views: {{ $apt->views }}</strong>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
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