@extends('layouts.app')
@section('title', "Llistat de Jugadores")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Llistat de Jugadores</h1>

@include('partials.messages')

<p class="mb-4">
    <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Nova Jugadora</a>
</p>

<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Nom</th>
            <th class="border border-gray-300 p-2">Equip</th>
            <th class="border border-gray-300 p-2">Dorsal</th>
            <th class="border border-gray-300 p-2">Edat</th>
            <th class="border border-gray-300 p-2">Accions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jugadores as $jugadora)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('jugadores.show', $jugadora) }}" class="text-blue-700 hover:underline">{{ $jugadora->nom }}</a>
                </td>
                <td class="border border-gray-300 p-2">{{ $jugadora->equip->nom ?? 'Sense equip' }}</td>
                <td class="border border-gray-300 p-2">{{ $jugadora->dorsal }}</td>
                <td class="border border-gray-300 p-2">{{ $jugadora->edat }}</td>
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('jugadores.edit', $jugadora) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form action="{{ route('jugadores.destroy', $jugadora) }}" method="POST" class="inline-block" onsubmit="return confirm('Estàs segur?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline ml-2">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="border border-gray-300 p-2">No hi ha jugadores per mostrar.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection