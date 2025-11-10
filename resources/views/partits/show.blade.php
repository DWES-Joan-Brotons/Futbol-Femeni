@extends('layouts.app')
@section('title', "Detall del Partit")

@section('content')
<div class="border rounded-lg shadow-md p-4 bg-white">
    <h1 class="text-3xl font-bold text-blue-800 mb-6">
        {{ $partit['local'] }} vs {{ $partit['visitant'] }}
    </h1>
    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($partit['data'])->format('d/m/Y') }}</p>
    <p><strong>Resultat:</strong> {{ $partit['resultat'] ?? 'Pendent' }}</p>
</div>

<p class="mt-4">
    <a href="{{ route('partits.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Tornar al llistat</a>
</p>
@endsection