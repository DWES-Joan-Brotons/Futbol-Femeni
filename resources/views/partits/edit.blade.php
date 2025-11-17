@extends('layouts.app')
@section('title', 'Editar Partit')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Partit</h1>

@include('partials.messages')

<form action="{{ route('partits.update', $partit) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="local_id" class="block font-bold">Equip Local:</label>
        <select id="local_id" name="local_id" class="border p-2 w-full">
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}" {{ old('local_id', $partit->local_id) == $equip->id ? 'selected' : '' }}>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="visitant_id" class="block font-bold">Equip Visitant:</label>
        <select id="visitant_id" name="visitant_id" class="border p-2 w-full">
            @foreach ($equips as $equip)
                <option value="{{ $equip->id }}" {{ old('visitant_id', $partit->visitant_id) == $equip->id ? 'selected' : '' }}>
                    {{ $equip->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="estadi_id" class="block font-bold">Estadi:</label>
        <select id="estadi_id" name="estadi_id" class="border p-2 w-full">
            @foreach ($estadis as $estadi)
                <option value="{{ $estadi->id }}" {{ old('estadi_id', $partit->estadi_id) == $estadi->id ? 'selected' : '' }}>
                    {{ $estadi->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="data" class="block font-bold">Data i Hora:</label>
        <input type="datetime-local" id="data" name="data" value="{{ old('data', $partit->data->format('Y-m-d\TH:i')) }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="jornada" class="block font-bold">Jornada:</label>
        <input type="number" id="jornada" name="jornada" value="{{ old('jornada', $partit->jornada) }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="gols_local" class="block font-bold">Gols Local:</label>
        <input type="number" id="gols_local" name="gols_local" value="{{ old('gols_local', $partit->gols_local) }}" class="border p-2 w-full">
    </div>

    <div>
        <label for="gols_visitant" class="block font-bold">Gols Visitant:</label>
        <input type="number" id="gols_visitant" name="gols_visitant" value="{{ old('gols_visitant', $partit->gols_visitant) }}" class="border p-2 w-full">
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualitzar</button>
        <a href="{{ route('partits.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Cancel·lar</a>
    </div>
</form>
@endsection