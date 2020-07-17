@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="mt-5">PROVA</h1>
            <canvas id="viewsPerMonth" width="400" height="400"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/views-chart.js') }}"></script>
@endpush
