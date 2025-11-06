@extends('layouts.app')
@section('title', "Guia de Partits")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Guia de Partits</h1>

@if (session('success'))
  <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
@endif

<p class="mb-4">
  <a href="{{ route('partits.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Nou partit</a>
</p>

<table class="w-full border-collapse border border-gray-300">
  <thead class="bg-gray-200">
  <tr>
    {{-- Canvi 1: Ordre de columnes (Local primer) --}}
    <th class="border border-gray-300 p-2">Local</th>
    <th class="border border-gray-300 p-2">Visitant</th>
    <th class="border border-gray-300 p-2">Data</th>
    <th class="border border-gray-300 p-2">Resultat</th>
  </tr>
  </thead>
  <tbody>
  @foreach($partits as $key => $partit)
    <tr class="hover:bg-gray-100">
      
      {{-- Canvi 2: L'enllaç (<a>) ara està a 'Local' --}}
      <td class="border border-gray-300 p-2 font-semibold">
        <a href="{{ route('partits.show', $key) }}" class="text-blue-700 hover:underline">
            {{ $partit['local'] }}
        </a>
      </td>
      
      {{-- 'Visitant' (sense enllaç) --}}
      <td class="border border-gray-300 p-2 font-semibold">{{ $partit['visitant'] }}</td>

      {{-- 'Data' (mogut aquí, sense enllaç) --}}
      <td class="border border-gray-300 p-2">
        {{ \Carbon\Carbon::parse($partit['data'])->format('d/m/Y') }}
      </td>
      
      {{-- 'Resultat' --}}
      <td class="border border-gray-300 p-2">
        {{ $partit['resultat'] ?? 'Pendent' }}
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection