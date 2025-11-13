@props(['nom', 'capacitat', 'equips'])

<div class="border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-2xl font-bold text-blue-800 mb-4">{{ $nom }}</h2>
    <p><strong>Capacitat:</strong> {{ number_format($capacitat, 0, ',', '.') }}</p>

    @if($equips && $equips->count() > 0)
        <h3 class="text-lg font-semibold mt-4">Equips que juguen aquí:</h3>
        <ul class="list-disc list-inside">
            @foreach($equips as $equip)
                <li>{{ $equip->nom }}</li>
            @endforeach
        </ul>
    @else
        <p class="mt-4"><em>No hi ha equips assignats a aquest estadi.</em></p>
    @endif
</div>

<p class="mt-4">
    <a href="{{ route('estadis.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Tornar al llistat</a>
</p>