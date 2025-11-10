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
            <th class="border border-gray-300 p-2">Posició</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jugadores as $key => $jugadora)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('jugadores.show', $key) }}" class="text-blue-700 hover:underline">{{ $jugadora['nom'] }}</a>
                </td>
                <td class="border border-gray-300 p-2">{{ $jugadora['equip'] }}</td>
                <td class="border border-gray-300 p-2">{{ $jugadora['posicio'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="border border-gray-300 p-2">No hi ha jugadores per mostrar.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection