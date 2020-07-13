{{-- PAGINA VISUALIZZATA DOPO LOGIN --}}

@extends('layouts.app')

@section('content')

@if (session('apartment_deleted'))
    <div class="alert alert-success">
        Appartamento <strong>{{ session('apartment_deleted') }}</strong> cancellato!
    </div>
@endif

<div class="container">

    <div class="row">
        <p>Ciao {{!empty(Auth::user()->first_name) ? Auth::user()->first_name : Auth::user()->email}}, benvenuto nella tua dashboard.</p>
    </div>
    <div class="row">
        <h2>I tuoi appartamenti!</h2>
    </div>
    <div class="row">
        @foreach ($apartments as $apartment)
            <p>{{ $apartment->id }}</p>
            
            <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete">
                <a href="#" class="btn-show"> ora vediamo </a>
            </form>
                
        @endforeach
    </div>
</div>

    
@endsection