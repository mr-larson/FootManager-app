@extends('layouts.app')

@section('content')
    <div class="game-container">
        <h2>Football Match Simulation</h2>
        <div id="game">
            <!-- Game HTML structure goes here -->
        </div>
    </div>

    <script type="module" src="{{ asset('js/main.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
