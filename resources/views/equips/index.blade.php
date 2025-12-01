@extends('layouts.equip')
@section('title', "Guia d'Equips")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Guia d'Equips</h1>

@include('partials.messages')

{{-- Només es mostra si l'usuari pot crear (Admin) --}}
@can('create', App\Models\Equip::class)
<p class="mb-4">
  <a href="{{ route('equips.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Nou equip</a>
</p>
@endcan

<table class="w-full border-collapse border border-gray-300">
  <thead class="bg-gray-200">
  <tr>
    <th class="border border-gray-300 p-2">Nom</th>
    <th class="border border-gray-300 p-2">Estadi</th>
    <th class="border border-gray-300 p-2">Títols</th>
    <th class="border border-gray-300 p-2">Accions</th>
  </tr>
  </thead>
  <tbody>
  @foreach($equips as  $equip)
    <tr class="hover:bg-gray-100">
      <td class="border border-gray-300 p-2">
        <a href="{{ route('equips.show', $equip) }}" class="text-blue-700 hover:underline">{{ $equip->nom }}</a>
      </td>
      <td class="border border-gray-300 p-2">{{ $equip->estadi->nom ?? 'Sense estadi' }}</td>
      <td class="border border-gray-300 p-2">{{ $equip->titols }}</td>
      <td class="border border-gray-300 p-2">
        
        {{-- Només es mostra si l'usuari pot editar AQUEST equip --}}
        @can('update', $equip)
            <a href="{{ route('equips.edit', $equip) }}" class="text-yellow-600 hover:underline">Editar</a>
        @endcan

        {{-- Només es mostra si l'usuari pot eliminar (Admin) --}}
        @can('delete', $equip)
            <form action="{{ route('equips.destroy', $equip) }}" method="POST" class="inline-block" onsubmit="return confirm('Estàs segur?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline ml-2">Eliminar</button>
            </form>
        @endcan

      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection