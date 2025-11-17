@props(['jugadores'])

<div class="mt-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-3">Jugadores</h3>
    @if($jugadores->isEmpty())
        <p class="text-gray-600">Aquest equip encara no té jugadores registrades.</p>
    @else
        <ul class="list-disc list-inside bg-gray-50 p-4 rounded-md shadow-sm">
            @foreach($jugadores as $jugadora)
                <li class="text-gray-700">
                    <a href="{{ route('jugadores.show', $jugadora) }}" class="text-blue-600 hover:underline">
                        {{ $jugadora->nom }} (Dorsal: {{ $jugadora->dorsal }}) - {{ $jugadora->edat }} anys
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>