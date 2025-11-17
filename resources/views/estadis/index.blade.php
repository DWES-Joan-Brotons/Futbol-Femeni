@extends('layouts.app')
@section('title', "Guia d'Estadis")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Guia d'Estadis</h1>

@include('partials.messages')

<p class="mb-4">
  <a href="{{ route('estadis.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Nou Estadi</a>
</p>

<table class="w-full border-collapse border border-gray-300">
  <thead class="bg-gray-200">
  <tr>
    <th class="border border-gray-300 p-2">Nom</th>
    <th class="border border-gray-300 p-2">Capacitat</th>
    <th class="border border-gray-300 p-2">Accions</th>
  </tr>
  </thead>
  <tbody>
  @foreach($estadis as  $estadi)
    <tr class="hover:bg-gray-100">
      <td class="border border-gray-300 p-2">
        <a href="{{ route('estadis.show',  $estadi) }}" class="text-blue-700 hover:underline">{{ $estadi->nom }}</a>
      </td>
      <td class="border border-gray-300 p-2">{{ number_format($estadi->capacitat) }}</td>
      <td class="border border-gray-300 p-2">
        <a href="{{ route('estadis.edit', $estadi) }}" class="text-yellow-600 hover:underline">Editar</a>
        <form action="{{ route('estadis.destroy', $estadi) }}" method="POST" class="inline-block" onsubmit="return confirm('Estàs segur?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline ml-2">Eliminar</button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection