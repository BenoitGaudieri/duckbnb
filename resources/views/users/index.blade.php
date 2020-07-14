{{-- PAGINA VISUALIZZATA DOPO LOGIN --}}

@extends('layouts.app')

@section('content')

@if (session('apartment_deleted'))
    <div class="alert alert-success">
        Appartamento <strong>{{ session('apartment_deleted') }}</strong> cancellato!
    </div>
@endif

<div class="container dashboard">

    <div class="row dashbord-welcome">
        <p>Ciao <span class="text-main dashboard-welcome--username">{{!empty(Auth::user()->first_name) ? Auth::user()->first_name : Auth::user()->email}}</span>, benvenuto nella tua dashboard.</p>
    </div>
    {{-- Secondary Nav --}}
    <nav class="row dashboard-nav">
       <ul>
            <li class="dashboard-nav--link">
                <a href="">I tuoi appartamenti</a>
            </li>
            <li class="dashboard-nav--link">
                <a href="">Messaggi</a>
            </li>
       </ul>
    </nav>

    <h4>Prova stampa dei messaggi:</h4>
    @foreach($apartments as $apartment)
        <div class="row">
            @foreach($apartment->messages as $message)
                <p><strong>Inviato da:</strong>{{ $message->mail_from }}</p>
                <p><strong>Testo messaggio: </strong>{{ $message->body }}</p>
                <hr>
            @endforeach
        </div>
    @endforeach

    <div class="row dashboard-apts">
        <div class="dashboard-apts--title">
            <h2>I tuoi appartamenti</h2>
            <a href="{{ route('user.apartments.create') }}" class="button-main">Aggiungi</a>
        </div>
        @if(count($apartments) > 0)
            @foreach ($apartments as $apartment)
                <div class="dashboard-apts--apt">
                    <div class="dashboard-apts--apt-title">
                        <a href="{{route('user.apartments.show', $apartment->id)}}">
                            {{ $apartment->title }}
                        </a>
                    </div>
                    <div class="dashboard-apts--apt-delete">
                        <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST">
                    </div>
                        @csrf
                        @method('DELETE')
                        <input class="button-dark" type="submit" value="Elimina">
                    </form>
                </div>       
            @endforeach
        @else 
            <p>Non hai nessun appartamento, aggiungine uno!</p>
        @endif
    </div>
</div>

    
@endsection
