@extends('layouts.app')

@section('content')

    <div class="jumbotron position-relative">
        <div class="search position-absolute"></div>
    </div>

    <div class="divider"></div>


    <div class="container sponsor-section">
        <div class="row sponsor-section--title">
            <h2 class="weight-light">Le migliori mete</h2>
        </div>
        <div class="row sponsor-section--apts">
            @foreach($apartments as $apt)
                @if ($apt->is_visible==1)
                    <div class="card-apt">
                        <a href="{{ route('show', $apt->id) }}" class="card-apt--img">
                            <img src="{{ $apt->img_url }}" alt="{{ $apt->title }}" class="img-fluid">
                        </a>
                        <div class="card-apt--location">
                            <h5 class="weight-regular">
                                Recensioni 
                                (<span class="text-main">{{ count($apt->reviews)}}</span>)
                            </h5>
                            <h5 class="weight-regular text-main"> Città </h5>
                        </div>
                        <div class="card-apt--title">
                            <h4 class="weight-regular"> {{ $apt->title }} </h4>
                        </div>
                        <div class="card-apt--price">
                            <h4 class="weight-regular"> <span class="text-main weight-bold">{{ $apt->price }}€</span> a notte</h4>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection