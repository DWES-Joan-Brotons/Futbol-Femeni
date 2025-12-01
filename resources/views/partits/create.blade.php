@extends('layouts.equip')
@section('title', 'Crear Nou Partit')

@section('content')
<h1 class="text-2xl font-bold mb-4">Crear Nou Partit</h1>

@include('partials.messages')

<form action="{{ route('partits.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label for="local_id" class="block font-bold">Equip Local:</label>
        <select id="local_id" name="local_id" class="border p-2 w-full">
            <option value="">Selecciona un equip</option>
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}" {{ old('local_id') == $equip->id ? 'selected' : '' }}>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="visitant_id" class="block font-bold">Equip Visitant:</label>
        <select id="visitant_id" name="visitant_id" class="border p-2 w-full">
            <option value="">Selecciona un equip</option>
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}" {{ old('visitant_id') == $equip->id ? 'selected' : '' }}>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="estadi_id" class="block font-bold">Estadi:</label>
        <select id="estadi_id" name="estadi_id" class="border p-2 w-full">
            <option value="">Selecciona un estadi</option>
            @foreach ($estadis as $estadi)
                <option value="{{ $estadi->id }}" {{ old('estadi_id') == $estadi->id ? 'selected' : '' }}>
                    {{ $estadi->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="data" class="block font-bold">Data i Hora:</label>
        <input type="datetime-local" id="data" name="data" value="{{ old('data') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="jornada" class="block font-bold">Jornada:</label>
        <input type="number" id="jornada" name="jornada" value="{{ old('jornada') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="gols_local" class="block font-bold">Gols Local (opcional):</label>
        <input type="number" id="gols_local" name="gols_local" value="{{ old('gols_local') }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="gols_visitant" class="block font-bold">Gols Visitant (opcional):</label>
        <input type="number" id="gols_visitant" name="gols_visitant" value="{{ old('gols_visitant') }}" class="border p-2 w-full">
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        <a href="{{ route('partits.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel·lar</a>
    </div>
</form>
@endsection