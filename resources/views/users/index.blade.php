{{-- PAGINA VISUALIZZATA DOPO LOGIN --}}

@extends('layouts.app')

@section('content')
<h1>Home/User</h1>
@if (session('apartment_deleted'))
    <div class="alert alert-success">
        Post <strong>{{ session('apartment_deleted') }}</strong> successfully deleted!
    </div>
@endif
<h2>I tuoi appartamenti!</h2>
<ul>
    @foreach ($apartments as $apartment)
        <li>{{ $apartment->id }}</li>
        <button>
            <form action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete">
            </form>
        </button>
    @endforeach
</ul>

    
@endsection