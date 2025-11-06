{{-- 1. Acceptem les propietats separades (nom, equip, posicio) --}}
@props(['nom', 'equip', 'posicio'])

<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
  
  {{-- 2. Usem les variables directament (sense 'jugadora[...]') --}}
  <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $nom }}</h1>
  
  <div class="space-y-3">
    <p><strong>Equip:</strong> {{ $equip }}</p>
    <p><strong>Posició:</strong> {{ $posicio }}</p>
  </div>

  <div class="mt-6">
    <a href="{{ route('jugadores.index') }}" class="text-blue-600 hover:underline">&leftarrow; Tornar al llistat de jugadores</a>
  </div>
</div>