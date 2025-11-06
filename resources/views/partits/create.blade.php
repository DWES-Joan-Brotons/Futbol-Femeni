@extends('layouts.app')
@section('title', 'Afegir nou partit')

@section('content')
<h1 class="text-2xl font-bold mb-4">Afegir nou partit</h1>

@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-2 mb-4">
    <ul>
      @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('partits.store') }}" method="POST" class="space-y-4">
  @csrf
  <div>
    <label for="local" class="block font-bold">Equip Local:</label>
    <input type="text" name="local" id="local" value="{{ old('local') }}" class="border p-2 w-full">
  </div>
  <div>
    <label for="visitant" class="block font-bold">Equip Visitant:</label>
    <input type="text" name="visitant" id="visitant" value="{{ old('visitant') }}" class="border p-2 w-full">
  </div>
  <div>
    <label for="data" class="block font-bold">Data:</label>
    {{-- Requisit Fase 3: input date --}}
    <input type="date" name="data" id="data" value="{{ old('data') }}" class="border p-2 w-full">
  </div>
  <div>
    <label for="resultat" class="block font-bold">Resultat (Opcional):</label>
    <input type="text" name="resultat" id="resultat" value="{{ old('resultat') }}" class="border p-2 w-full" placeholder="Ex: 2-1">
  </div>
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Afegir</button>
</form>
@endsection