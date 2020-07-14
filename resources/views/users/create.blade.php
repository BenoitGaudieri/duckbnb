@extends('layouts.app')

@section('content')
{{-- @dd($services) --}}
<div class="container">
    <h1 class="mb-4">Crea un nuovo appartamento</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route("user.apartments.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("POST")

        <div class="form-group">
            <label for="title">Titolo :</label>
            <input class="form-control" type="text" name="title" id="title" value="{{ old("title") }}" placeholder="Inserisci un titolo" required maxlength="150" pattern="[A-z0-9À-ž\s]+">
        </div>

        <div class="form-group">
            <label for="description">Descrizione :</label>
            <textarea class="form-control" name="description" id="description" placeholder="Inserisci una descrizione" required maxlength="1500">{{ old("description") }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Prezzo :</label>
            <input class="form-control" type="number" min="1" max="10000" name="price" id="price" value="{{ old("price") }}" placeholder="€">
        </div>

        <div class="form-group">
            <label for="img_url">Apartment image :</label>
            <input class="form-control" type="file" name="img_url" id="img_url" accept="image/*">
        </div>

        <div class="form-group">
            <label for="room_qty">N° di stanze :</label>
            <input class="form-control" type="number" min="1" max="10000" name="room_qty" id="room_qty" value="{{ old("room_qty") }}" placeholder="Inserisci il n° di stanze">
        </div>

        <div class="form-group">
            <label for="bathroom_qty">N° di bagni :</label>
            <input class="form-control" type="number" min="1" max="10000" name="bathroom_qty" id="bathroom_qty" value="{{ old("bathroom_qty") }}" placeholder="Inserisci il n° di bagni">
        </div>

        <div class="form-group">
            <label for="bed_qty">N° di letti :</label>
            <input class="form-control" type="number" min="1" max="10000" name="bed_qty" id="bed_qty" value="{{ old("bed_qty") }}" placeholder="Inserisci il n° di letti">
        </div>

        <div class="form-group">
            <label for="sqr_meters">N° di m<sup>2</sup> :</label>
            <input class="form-control" type="number" min="1" max="10000" 
            name="sqr_meters" id="sqr_meters" value="{{ old("sqr_meters") }}" placeholder="Inserisci il n° di m&sup2;">
        </div>

        <div class="form-group">
            <label for="activeStatus">Active Status</label>
            <select id="activeStatus" name="is_visible">
                <option value="1" selected>Active</option>
                <option value="0">Not Active</option>
            </select>
        </div>
        
        <div class="form-group">
            <input id="address-input" placeholder="Dove vorresti alloggiare?"/>
            <span id="coords"></span>
        </div>

        @foreach ($services as $service)
            <div class="form-check form-check-inline">
                <input name="services[]" type="checkbox" class="form-check-input" id="service-{{ $loop->iteration }}" value="{{ $service->id}}">
                <label class="form-check-label" for="service-{{ $loop->iteration }}">{{ $service->name }}</label>
            </div>
        @endforeach

        <input type="hidden" id="lat" name="lat" value="{{ old("lat") }}">
        <input type="hidden" id="lng" name="lng" value="{{ old("lng") }}"> 
        
        <input class="btn btn-primary" type="submit" value="Create new post">
    </form>
</div>


@endsection

@push('scripts')
<script src="{{ asset("js/place-create.js") }}" defer></script>    
    
@endpush