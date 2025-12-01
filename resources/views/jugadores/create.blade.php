@extends('layouts.equip')
@section('title', 'Crear Nova Jugadora')

@section('content')
<h1 class="text-2xl font-bold mb-4">Crear Nova Jugadora</h1>

@include('partials.messages')

<form action="{{ route('jugadores.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="nom" class="block font-bold">Nom:</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="equip_id" class="block font-bold">Equip:</label>
        <select id="equip_id" name="equip_id" class="border p-2 w-full">
            <option value="">Selecciona un equip</option>
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}" {{ old('equip_id') == $equip->id ? 'selected' : '' }}>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div>
        <label for="data_naixement" class="block font-bold">Data de Naixement:</label>
        <input type="date" id="data_naixement" name="data_naixement" value="{{ old('data_naixement') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="dorsal" class="block font-bold">Dorsal:</label>
        <input type="number" id="dorsal" name="dorsal" value="{{ old('dorsal') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="foto" class="block font-bold">Foto (només .png, max 2MB):</label>
        <input type="file" id="foto" name="foto" class="border p-2 w-full">
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        <a href="{{ route('jugadores.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel·lar</a>
    </div>
</form>
@endsection