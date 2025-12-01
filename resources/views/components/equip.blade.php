@props(['nom', 'estadi', 'titols', 'escut' => null])

<div class="equip border rounded-lg shadow-md p-4 bg-white flex items-center gap-4">
  @if($escut)
      <div class="flex-shrink-0">
          <img src="{{ Storage::url($escut) }}" alt="Escut de {{ $nom }}" class="h-16 w-16 object-contain">
      </div>
  @endif
  
  <div>
      <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
      <p><strong>Estadi:</strong> {{ $estadi }}</p>
      <p><strong>Títols:</strong> {{ $titols }}</p>
  </div>
</div>