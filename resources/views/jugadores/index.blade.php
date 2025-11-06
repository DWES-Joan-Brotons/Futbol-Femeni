@extends('layouts.app')
@section('title', "Guia de Jugadores")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Guia de Jugadores</h1>

@if (session('success'))
  <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
@endif

<p class="mb-4">
  <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Nova jugadora</a>
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
  @foreach($jugadores as $key => $jugadora)
    <tr class="hover:bg-gray-100">
      <td class="border border-gray-300 p-2">
        {{-- Enllacem al 'show' usant la clau de l'array com a ID --}}
        <a href="{{ route('jugadores.show', $key) }}" class="text-blue-700 hover:underline">{{ $jugadora['nom'] }}</a>
      </td>
      <td class="border border-gray-300 p-2">{{ $jugadora['equip'] }}</td>
      <td class="border border-gray-300 p-2">{{ $jugadora['posicio'] }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection