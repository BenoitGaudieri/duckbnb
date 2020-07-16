@extends('layouts.app')

@section('content')

<div class="container edit">
    <div class="edit--title">
        <h2 class="mb-4">Modifica <span class="text-main">{{ $apartment->title }}</span></h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="edit--form">
        <form action="{{ route("user.apartments.update", $apartment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
    
            <div class="form-group">
                <input class="form-control" type="text" name="title" id="title" value="{{ old("title", $apartment->title) }}" placeholder="Inserisci un titolo" required maxlength="150" pattern="[A-z0-9À-ž\s]+">
            </div>
    
            <div class="form-group">
                <textarea class="form-control" name="description" id="description" placeholder="Inserisci una descrizione" required maxlength="1500">{{ old("description", $apartment->description) }}</textarea>
            </div>
    
            <div class="form-group">
                <label for="price">Prezzo per notte</label>
                <input class="form-control" type="number" min="1" max="10000" name="price" id="price" value="{{ old("price", $apartment->price) }}" placeholder="€">
            </div>
            
            <div class="form-group">
                @isset($apartment->img_url)
                    <h6>Immagine corrente</h6>
                    <img style="display:block;" width="200" src="{{ asset('storage/'. $apartment->img_url) }}" alt="{{ $apartment->title }}">
                @endisset
                <label for="img_url">Inserisci una nuovo immagine</label>
                <input class="form-control" type="file" name="img_url" id="img_url" accept="image/*">
            </div>
    
            <div class="form-group">
                <label for="room_qty">N° di stanze :</label>
                <input class="form-control" type="number" min="1" max="10000" name="room_qty" id="room_qty" value="{{ old("room_qty", $apartment->room_qty) }}" placeholder="Inserisci il numero di stanze">
            </div>
    
            <div class="form-group">
                <label for="bathroom_qty">N° di bagni :</label>
                <input class="form-control" type="number" min="1" max="10000" name="bathroom_qty" id="bathroom_qty" value="{{ old("bathroom_qty", $apartment->bathroom_qty) }}" placeholder="Inserisci il numero di bagni">
            </div>
    
            <div class="form-group">
                <label for="bed_qty">N° di letti :</label>
                <input class="form-control" type="number" min="1" max="10000" name="bed_qty" id="bed_qty" value="{{ old("bed_qty", $apartment->bed_qty) }}" placeholder="Inserisci il numero di letti">
            </div>
    
            <div class="form-group">
                <label for="sqr_meters">N° di m<sup>2</sup> :</label>
                <input class="form-control" type="number" min="1" max="10000" 
                name="sqr_meters" id="sqr_meters" value="{{ old("sqr_meters", $apartment->sqr_meters) }}" 
                placeholder="Inserisci il numero di metri quadri">
            </div>
    
    
            <div class="form-group">
                <label for="activeStatus">Visibilità</label>
                <select id="activeStatus" name="is_visible">
                    <option value="1" selected>Pubblica</option>
                    <option value="0">Nascondi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="address-input">Indirizzo</label>
                <input id="address-input" placeholder="Modifica indirizzo completo"/>
            </div>
    
            <div class="edit--form--services">
                @foreach ($services as $service)
                    <div class="form-check form-check-inline">
                        <input name="services[]" type="checkbox" class="form-check-input" id="service-{{ $loop->iteration }}" value="{{ $service->id}}" 
                        @if($apartment->services->contains($service->id))
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="service-{{ $loop->iteration }}">{{ $service->name }}</label>
                    </div>
                @endforeach
            </div>
    
    
            <input type="hidden" id="lat" name="lat" value="{{ old("lat", $apartment->lat) }}">
            <input type="hidden" id="lng" name="lng" value="{{ old("lng", $apartment->lng) }}"> 
    
            <input class="button-main" type="submit" value="Salva Modifiche">
    
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset("js/place-create.js") }}" defer></script>    
    
@endpush
