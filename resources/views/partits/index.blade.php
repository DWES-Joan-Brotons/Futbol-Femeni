@extends('layouts.equip')
@section('title', "Llistat de Partits")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Llistat de Partits</h1>

@include('partials.messages')

<p class="mb-4">
    <a href="{{ route('partits.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Nou Partit</a>
</p>

<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Jornada</th>
            <th class="border border-gray-300 p-2">Data</th>
            <th class="border border-gray-300 p-2">Local</th>
            <th class="border border-gray-300 p-2">Visitant</th>
            <th class="border border-gray-300 p-2">Resultat</th>
            <th class="border border-gray-300 p-2">Accions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($partits as $partit)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 p-2">{{ $partit->jornada }}</td>
                <td class="border border-gray-300 p-2">{{ $partit->data->format('d/m/Y H:i') }}</td>
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('equips.show', $partit->equipLocal) }}" class="text-blue-700 hover:underline font-medium">
                        {{ $partit->equipLocal->nom }}
                    </a>
                </td>
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('equips.show', $partit->equipVisitant) }}" class="text-blue-700 hover:underline font-medium">
                        {{ $partit->equipVisitant->nom }}
                    </a>
                </td>
                <td class="border border-gray-300 p-2 font-bold">
                    <a href="{{ route('partits.show', $partit) }}" class="text-blue-700 hover:underline">
                        {{ $partit->resultat }}
                    </a>
                </td>
                <td class="border border-gray-300 p-2">
                    <a href="{{ route('partits.edit', $partit) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form action="{{ route('partits.destroy', $partit) }}" method="POST" class="inline-block" onsubmit="return confirm('Estàs segur?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline ml-2">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="border border-gray-300 p-2">No hi ha partits per mostrar.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection