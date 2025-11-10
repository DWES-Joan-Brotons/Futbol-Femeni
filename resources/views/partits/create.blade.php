@extends('layouts.app')
@section('title', 'Crear Nou Partit')

@section('content')
<h1 class="text-2xl font-bold mb-4">Crear Nou Partit</h1>

@include('partials.messages')

<form action="{{ route('partits.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label for="local" class="block font-bold">Equip Local:</label>
        <input type="text" id="local" name="local" value="{{ old('local') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="visitant" class="block font-bold">Equip Visitant:</label>
        <input type="text" id="visitant" name="visitant" value="{{ old('visitant') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="data" class="block font-bold">Data:</label>
        <input type="date" id="data" name="data" value="{{ old('data') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="resultat" class="block font-bold">Resultat (opcional, ex. 2-1):</label>
        <input type="text" id="resultat" name="resultat" value="{{ old('resultat') }}" placeholder="Ex. 3-0" class="border p-2 w-full">
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        <a href="{{ route('partits.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel·lar</a>
    </div>
</form>
@endsection