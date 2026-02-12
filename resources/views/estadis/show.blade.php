@extends('layouts.equip')
@section('title', "Detall d'Estadi")

@section('content')
<x-estadi :nom="$estadi->nom" :capacitat="$estadi->capacitat" :equips="$estadi->equips"/>

{{-- BLOQUE IA --}}
<div class="mt-6 p-4 bg-gray-100 border-l-4 border-purple-500 text-gray-700">
    <p class="font-bold text-purple-700">Descripció IA (Gemini):</p>
    <p class="italic mt-1">
        "{{ $descripcioIA ?? 'Esperant resposta...' }}"
    </p>
</div>
{{-- FIN BLOQUE IA --}}

<div class="mt-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-3">Equips:</h3>
    @if($estadi->equips->isEmpty())
        <p class="text-gray-600">Sense equips assignats.</p>
    @else
        <ul class="list-disc list-inside bg-gray-50 p-4 rounded shadow-sm">
            @foreach($estadi->equips as $equip)
                <li class="text-gray-700">
                    <a href="{{ route('equips.show', $equip) }}" class="text-blue-600 hover:underline">
                        {{ $equip->nom }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<div class="mt-6">
    <a href="{{ route('estadis.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Tornar</a>
    <a href="{{ route('estadis.edit', $estadi) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>
</div>
@endsection