@props(['nom', 'ciutat', 'capacitat', 'equip_principal'])

<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
  <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $nom }}</h1>
  
  <div class="space-y-3">
    <p><strong>Ciutat:</strong> {{ $ciutat }}</p>
    <p><strong>Capacitat:</strong> {{ number_format($capacitat, 0, ',', '.') }}</p>
    <p><strong>Equip Principal:</strong> {{ $equip_principal }}</p>
  </div>

  <div class="mt-6">
    <a href="{{ route('estadis.index') }}" class="text-blue-600 hover:underline">&leftarrow; Tornar al llistat d'estadis</a>
  </div>
</div>