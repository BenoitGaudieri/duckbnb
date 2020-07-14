@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-end mb-5">
        <div class="row">
            <button>
                <a class="mb-5 align-self-end" href="{{ route('search') }}">SEARCH</a>
            </button>
        </div>
    </div>

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