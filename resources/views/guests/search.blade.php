@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="search-act" action="{{ route('search.submit') }}" method="POST">
            @csrf
            @method('POST')

            <div class="search-act--input search-group">
                <input id="address-input" placeholder="La tua prossima meta?"/>
            </div>

            <input type="hidden" id="lat" name="lat" value="">
            <input type="hidden" id="lng" name="lng" value="">
            <input type="hidden" id="apartmentId" name="id[]" value="">
            
            <button type="submit" class="search-act--btnSubmit">
                <ion-icon name="search-outline"></ion-icon>
            </button>
        </form>

        {{-- Origin point reference --}}
        @foreach($origin as $key => $value)
            <input type="hidden" id="origin-{{ $key }}" name="origin-{{ $key }}" value="{{ $value }}">
        @endforeach

        @include('shared.handlebar')

        @if (!empty($apartments) && count($apartments) > 0)

            <button id="reset">Resetta filtri</button>
            
            <div class="row justify-content-center">
                <h6>Modifica raggio di ricerca</h6>
                <div class="row justify-content-center">
                    <form class="row search-option" id="select-radius">
                        <input type="radio" name="radius" id="20" value="20000" checked>
                        <label for="20">20 Km</label>

                        <input type="radio" name="radius" id="30" value="30000">
                        <label for="30">30 Km</label>

                        <input type="radio" name="radius" id="50" value="50000">
                        <label for="50">50 Km</label>
                    </form>
                </div>
            </div>

            <div class="row">
                <label for="select-rooms">Numero minimo di stanze</label>
                <select class="search-option" name="Rooms" id="select-rooms">
                    <option value="1">>1</option>
                    <option value="2">>2</option>
                    <option value="3">>3</option>
                    <option value="4">>4</option>
                </select>
            </div>
            
            <div class="row">
                <label for="select-beds">Numero minimo di letti</label>
                <select class="search-option" name="Rooms" id="select-beds">
                    <option value="1">>1</option>
                    <option value="2">>2</option>
                    <option value="3">>3</option>
                    <option value="4">>4</option>
                </select>
            </div>

            <form class="search-option" id="check-servizi">
                @foreach($services as $service)
                    <input type="checkbox" name="{{ $service->name }}" id="{{ $service->name }}" value="{{ $service->name }}" data-id="{{ $service->id }}">
                    <label for="{{ $service->name }}">{{ $service->name }}</label>        
                @endforeach
            </form>

            @if(Session::has('empty'))
                <div class="alert alert-danger">
                    {{ Session::get('empty') }}
                </div>
            @endif

            <div class="row" id="search-results">
                @foreach ($apartments as $apartment)
                    <div class="card card-apt">
                        <a href="{{ route('show', $apartment->id) }}" class="card-apt--img">
                            @if($apartment->img_url == 'https://picsum.photos/200/300')
                                <img class="img-fluid" src="{{ $apartment->img_url }}" alt="">
                            @else
                                <img class="img-fluid" src="{{ asset('storage/' . $apartment->img_url) }}" alt="">
                            @endif
                        </a>
                        <div class="card-apt--location">
                            <h5 class="weight-regular">
                                Recensioni 
                                (<span class="text-main">{{ count($apartment->reviews)}}</span>)
                            </h5>
                            <h5 id="address" class="weight-regular text-main"> Città </h5>
                        </div>
                        <div class="card-apt--title">
                            <h4 class="weight-regular"> {{ $apartment->title }} </h4>
                        </div>
                        <div class="card-apt--price">
                            <h4 class="weight-regular"> <span class="text-main weight-bold">{{ $apartment->price }}€</span> a notte</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3>Nessun risultato trovato</h3>
        @endif
    </div>
@endsection



@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7/themes/algolia-min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch-lite.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
    <script src="{{ asset("js/search.js") }}" defer></script>
    <script src="{{ asset("js/search-filtering.js") }}" defer></script>
@endpush