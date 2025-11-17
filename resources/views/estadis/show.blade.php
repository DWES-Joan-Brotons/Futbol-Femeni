@extends('layouts.app')
@section('title', "Detall d'Estadi")

@section('content')
<x-estadi :nom="$estadi->nom"   :capacitat="$estadi->capacitat" :equips="$estadi->equips"/>

<div class="mt-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-3">Equips que juguen en aquest estadi:</h3>
    @if($estadi->equips->isEmpty())
        <p class="text-gray-600">Encara no hi ha equips assignats a aquest estadi.</p>
    @else
        <ul class="list-disc list-inside bg-gray-50 p-4 rounded-md shadow-sm">
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
    <a href="{{ route('estadis.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Tornar al llistat</a>
    <a href="{{ route('estadis.edit', $estadi) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>
    <form action="{{ route('estadis.destroy', $estadi) }}" method="POST" class="inline-block" onsubmit="return confirm('Estàs segur que vols eliminar aquest estadi?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Eliminar</button>
    </form>
</div>
@endsection