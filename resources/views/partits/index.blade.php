@extends('layouts.app')
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
            <th class="border border-gray-300 p-2">Local</th>
            <th class="border border-gray-300 p-2">Visitant</th>
            <th class="border border-gray-300 p-2">Data</th>
            <th class="border border-gray-300 p-2">Resultat</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($partits as $key => $partit)
            <x-partit :partit="$partit" :key="$key" />
        @empty
            <tr>
                <td colspan="4" class="border border-gray-300 p-2">No hi ha partits per mostrar.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection