@extends('layouts.equip')
@section('title', "Detall del Partit")

@section('content')
<x-partit-fitxa :partit="$partit" />

<p class="mt-4">
    <a href="{{ route('partits.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Tornar al llistat</a>
    <a href="{{ route('partits.edit', $partit) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>
    <form action="{{ route('partits.destroy', $partit) }}" method="POST" class="inline-block" onsubmit="return confirm('Estàs segur que vols eliminar aquest partit?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
    </form>
</p>
@endsection