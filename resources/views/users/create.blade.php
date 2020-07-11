@extends('layouts.app')

@section('content')
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

    {{-- <form action="{{ route("user.apartments.store") }}" method="POST" enctype="multipart/form-data"> --}}
        @csrf
        @method("POST")

        <div class="form-group">
            <label for="title">Titolo :</label>
            <input class="form-control" type="text" name="title" id="title" value="{{ old("title") }}" placeholder="Inserisci un titolo">
        </div>

        <div class="form-group">
            <label for="description">Descrizione :</label>
            <textarea class="form-control" name="description" id="description" placeholder="Inserisci una descrizione">{{ old("body") }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Prezzo :</label>
            <input class="form-control" type="number" min="1" max="10000" name="price" id="price" value="{{ old("price") }}" placeholder="€">
        </div>

        <div class="form-group">
            <label for="path_img">Apartment image :</label>
            <input class="form-control" type="file" name="path_img" id="path_img" accept="image/*">
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
            <input class="form-control" type="number" min="1" max="10000" name="
            sqr_meters" id="sqr_meters" value="{{ old("sqr_meters") }}" placeholder="Inserisci il n° di metri quadri">
        </div>

        <label for="activeStatus">Active Status</label>
        <select id="activeStatus" name="activeStatus">
            <option value="true" selected>Active</option>
            <option value="false">Not Active</option>
        </select>

        <h1>+input algolia mappa</h1>


        <input class="btn btn-primary" type="submit" value="Create new post">

    </form>

</div>


@endsection