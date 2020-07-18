@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="total-views" class="row mt-5">
            <span></span>
        </div>
        <div class="row">
            {{ $apartment->messages->count() }}
        </div>
        <div class="row">
            <canvas id="viewsPerMonth" width="400" height="400"></canvas>
            <canvas id="pieChart" width="400" height="400"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/views-chart.js') }}"></script>
@endpush
