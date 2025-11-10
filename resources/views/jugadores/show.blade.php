@extends('layouts.app')
@section('title', "Detall de la Jugadora")

@section('content')
<div class="border rounded-lg shadow-md p-4 bg-white">
    <h1 class="text-3xl font-bold text-blue-800 mb-6">{{ $jugadora['nom'] }}</h1>
    <p><strong>Equip:</strong> {{ $jugadora['equip'] }}</p>
    <p><strong>Posició:</strong> {{ $jugadora['posicio'] }}</p>
</div>

<p class="mt-4">
    <a href="{{ route('jugadores.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Tornar al llistat</a>
</p>
@endsection