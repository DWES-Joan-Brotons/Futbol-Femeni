@extends('layouts.equip')
@section('title', 'Afegir nou equip')

@section('content')
<h1 class="text-2xl font-bold mb-4">Afegir nou equip</h1>

@include('partials.messages')

{{-- IMPORTANT: enctype="multipart/form-data" per poder enviar fitxers --}}
<form action="{{ route('equips.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
  @csrf
  <div>
    <label for="nom" class="block font-bold">Nom:</label>
    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="border p-2 w-full">
  </div>
  <div>
        <label for="estadi_id" class="block font-bold">Estadi:</label>
        <select name="estadi_id" id="estadi_id" class="border p-2 w-full">
            @foreach ($estadis as $estadi)
                <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>
                    {{ $estadi->nom }}
                </option>
            @endforeach
        </select>
  </div>
  <div>
    <label for="titols" class="block font-bold">Títols:</label>
    <input type="number" name="titols" id="titols" value="{{ old('titols') }}" class="border p-2 w-full">
  </div>

  {{-- CAMP ESCUT NOU --}}
  <div class="mb-4">
    <label for="escut" class="block text-sm font-medium text-gray-700 mb-1">Escut:</label>
    <input type="file" name="escut" id="escut" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Afegir</button>
</form>
@endsection