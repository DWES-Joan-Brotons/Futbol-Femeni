@props(['partit'])

<div class="border rounded-lg shadow-md p-6 bg-white">
    <div class="text-center mb-4">
        <p class="text-sm text-gray-600">{{ $partit->data->format('d/m/Y H:i') }} - Jornada {{ $partit->jornada }}</p>
        <p class="text-xs text-gray-500">{{ $partit->estadi->nom }}</p>
    </div>
    
    <div class="flex justify-around items-center">
        <div class="text-center w-1/3">
            <a href="{{ route('equips.show', $partit->equipLocal) }}" class="text-xl font-bold text-blue-800 hover:underline">{{ $partit->equipLocal->nom }}</a>
        </div>
        
        <div class="text-center w-1/3">
            @if($partit->haJugat)
                <span class="text-4xl font-bold text-black">{{ $partit->gols_local }} - {{ $partit->gols_visitant }}</span>
            @else
                <span class="text-2xl font-semibold text-gray-500">VS</span>
            @endif
        </div>
        
        <div class="text-center w-1/3">
            <a href="{{ route('equips.show', $partit->equipVisitant) }}" class="text-xl font-bold text-blue-800 hover:underline">{{ $partit->equipVisitant->nom }}</a>
        </div>
    </div>
</div>