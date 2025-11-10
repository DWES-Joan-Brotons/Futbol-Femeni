@extends('layouts.app')
@section('title', 'Crear Nova Jugadora')

@section('content')
<h1 class="text-2xl font-bold mb-4">Crear Nova Jugadora</h1>

@include('partials.messages')

<form action="{{ route('jugadores.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label for="nom" class="block font-bold">Nom:</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="equip" class="block font-bold">Equip:</label>
        <input type="text" id="equip" name="equip" value="{{ old('equip') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="posicio" class="block font-bold">Posició:</label>
        <select id="posicio" name="posicio" class="border p-2 w-full">
            <option value="">Selecciona una posició</option>
            @foreach ($posicions as $posicio)
                <option value="{{ $posicio }}" {{ old('posicio') == $posicio ? 'selected' : '' }}>
                    {{ $posicio }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        <a href="{{ route('jugadores.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel·lar</a>
    </div>
</form>
@endsection