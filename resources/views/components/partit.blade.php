@props(['local', 'visitant', 'data', 'resultat'])

<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6 mt-6">
  <h1 class="text-3xl font-bold text-blue-800 mb-4">Detall del Partit</h1>
  
  <div class="space-y-3">
    <p><strong>Equip Local:</strong> {{ $local }}</p>
    <p><strong>Equip Visitant:</strong> {{ $visitant }}</p>
    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($data)->format('d/m/Y') }}</p>
    <p><strong>Resultat:</strong> {{ $resultat ?? 'Pendent de jugar' }}</p>
  </div>

  <div class="mt-6">
    <a href="{{ route('partits.index') }}" class="text-blue-600 hover:underline">&leftarrow; Tornar al llistat de partits</a>
  </div>
</div>