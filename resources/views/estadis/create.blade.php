@extends('layouts.app')
@section('title', 'Afegir nou estadi')

@section('content')
<h1 class="text-2xl font-bold mb-4">Afegir nou estadi</h1>

@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-2 mb-4">
    <ul>
      @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('estadis.store') }}" method="POST" class="space-y-4">
  @csrf
  <div>
    <label for="nom" class="block font-bold">Nom:</label>
    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="border p-2 w-full">
  </div>
  <div>
    <label for="ciutat" class="block font-bold">Ciutat:</label>
    <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}" class="border p-2 w-full">
  </div>
  <div>
    <label for="capacitat" class="block font-bold">Capacitat:</label>
    <input type="number" name="capacitat" id="capacitat" value="{{ old('capacitat') }}" class="border p-2 w-full">
  </div>
  <div>
    <label for="equip_principal" class="block font-bold">Equip Principal:</label>
    <input type="text" name="equip_principal" id="equip_principal" value="{{ old('equip_principal') }}" class="border p-2 w-full">
  </div>
  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Afegir</button>
</form>
@endsection