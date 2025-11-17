@extends('layouts.app')
@section('title', 'Editar Equip')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Equip: {{ $equip->nom }}</h1>

@include('partials.messages')

<form action="{{ route('equips.update', $equip) }}" method="POST" class="space-y-4">
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
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualitzar</button>
</form>
@endsection