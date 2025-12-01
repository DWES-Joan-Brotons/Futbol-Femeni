@extends('layouts.equip')
@section('title', 'Editar Equip')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Equip: {{ $equip->nom }}</h1>

@include('partials.messages')

<form action="{{ route('equips.update', $equip) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  
  <div>
    <label for="nom" class="block font-bold">Nom:</label>
    <input type="text" name="nom" id="nom" value="{{ old('nom', $equip->nom) }}" class="border p-2 w-full">
  </div>
  <div>
        <label for="estadi_id" class="block font-bold">Estadi:</label>
        <select name="estadi_id" id="estadi_id" class="border p-2 w-full">
            @foreach ($estadis as $estadi)
                <option value="{{ $estadi->id }}" {{ old('estadi_id', $equip->estadi_id) == $estadi->id ? 'selected' : '' }}>
                    {{ $estadi->nom }}
                </option>
            @endforeach
        </select>
  </div>
  <div>
    <label for="titols" class="block font-bold">Títols:</label>
    <input type="number" name="titols" id="titols" value="{{ old('titols', $equip->titols) }}" class="border p-2 w-full">
  </div>

  {{-- CAMP ESCUT EDICIÓ --}}
  <div class="mb-4">
    <label for="escut" class="block font-bold mb-1">Escut:</label>
    <input type="file" name="escut" id="escut" class="w-full border p-2 bg-white rounded">
    @if($equip->escut)
        <div class="mt-2">
            <p class="text-sm text-gray-600">Escut actual:</p>
            <img src="{{ Storage::url($equip->escut) }}" alt="Escut actual" class="h-16 w-auto mt-1 object-contain">
        </div>
    @endif
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualitzar</button>
</form>
@endsection