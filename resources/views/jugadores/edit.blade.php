@extends('layouts.app')
@section('title', 'Editar Jugadora')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Jugadora: {{ $jugadora->nom }}</h1>

@include('partials.messages')

<form action="{{ route('jugadores.update', $jugadora) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="nom" class="block font-bold">Nom:</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom', $jugadora->nom) }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="equip_id" class="block font-bold">Equip:</label>
        <select id="equip_id" name="equip_id" class="border p-2 w-full">
            <option value="">Selecciona un equip</option>
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}" {{ old('equip_id', $jugadora->equip_id) == $equip->id ? 'selected' : '' }}>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div>
        <label for="data_naixement" class="block font-bold">Data de Naixement:</label>
        <input type="date" id="data_naixement" name="data_naixement" value="{{ old('data_naixement', $jugadora->data_naixement->format('Y-m-d')) }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="dorsal" class="block font-bold">Dorsal:</label>
        <input type="number" id="dorsal" name="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="foto" class="block font-bold">Foto (només .png, max 2MB):</label>
        <input type="file" id="foto" name="foto" class="border p-2 w-full">
        @if($jugadora->foto)
            <img src="{{ Storage::url($jugadora->foto) }}" alt="Foto de {{ $jugadora->nom }}" class="mt-2 h-20 w-20 object-cover">
        @endif
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualitzar</button>
        <a href="{{ route('jugadores.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel·lar</a>
    </div>
</form>
@endsection