@extends('layouts.equip')
@section('title', "Detall de la Jugadora")

@section('content')
<div class="border rounded-lg shadow-md p-4 bg-white">
    @if($jugadora->foto)
        <img src="{{ Storage::url($jugadora->foto) }}" alt="Foto de {{ $jugadora->nom }}" class="mb-4 h-40 w-40 object-cover rounded-full">
    @endif
    <h1 class="text-3xl font-bold text-blue-800 mb-6">{{ $jugadora->nom }}</h1>
    
    <p><strong>Equip:</strong>
        @if ($jugadora->equip)
            <a href="{{ route('equips.show', $jugadora->equip) }}" class="text-blue-600 hover:underline">
                {{ $jugadora->equip->nom }}
            </a>
        @else
            <span class="text-gray-500">Sense equip assignat</span>
        @endif
    </p>
    
    <p><strong>Dorsal:</strong> {{ $jugadora->dorsal }}</p>
    
    <p><strong>Data de Naixement:</strong> 
        @if ($jugadora->data_naixement)
            {{ $jugadora->data_naixement->format('d/m/Y') }} ({{ $jugadora->edat }} anys)
        @else
            <span class="text-gray-500">Data no especificada</span>
        @endif
    </p>
</div>

<p class="mt-4">
    <a href="{{ route('jugadores.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Tornar al llistat</a>
    <a href="{{ route('jugadores.edit', $jugadora) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>
    <form action="{{ route('jugadores.destroy', $jugadora) }}" method="POST" class="inline-block" onsubmit="return confirm('Estàs segur que vols eliminar aquesta jugadora?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
    </form>
</p>
@endsection