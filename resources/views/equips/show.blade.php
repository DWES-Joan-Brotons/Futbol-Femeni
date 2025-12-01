@extends('layouts.equip')
@section('title', "Detall d'Equip")

@section('content')
{{-- Passem l'escut al component --}}
<x-equip 
    :nom="$equip->nom" 
    :estadi="$equip->estadi->nom ?? 'Sense estadi'" 
    :titols="$equip->titols"
    :escut="$equip->escut"
/>

<div class="mt-4 p-4 bg-white rounded-lg shadow-md">
    <h3 class="text-lg font-semibold text-gray-700">Edat Mitjana de les Jugadores:</h3>
    <p class="text-xl text-blue-800 font-bold">{{ $equip->edatMitjana ? number_format($equip->edatMitjana, 1) . ' anys' : 'N/D' }}</p>
</div>

<x-jugadores-equip-llista :jugadores="$equip->jugadores" />

<div class="mt-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-3">Últims 5 Partits Jugats</h3>
    @if($equip->ultimsPartits->isEmpty())
        <p class="text-gray-600">No s'han trobat partits recents.</p>
    @else
        <div class="space-y-3">
            @foreach($equip->ultimsPartits as $partit)
                <x-partit-fitxa :partit="$partit" />
            @endforeach
        </div>
    @endif
</div>

<div class="mt-6">
    <a href="{{ route('equips.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Tornar al llistat</a>
    <a href="{{ route('equips.edit', $equip) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>
    <form action="{{ route('equips.destroy', $equip) }}" method="POST" class="inline-block" onsubmit="return confirm('Estàs segur que vols eliminar aquest equip?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
    </form>
</div>
@endsection