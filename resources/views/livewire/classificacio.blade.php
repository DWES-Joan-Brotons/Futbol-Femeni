<div wire:poll.5s class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200 font-sans">
    
    <div class="px-6 py-5 bg-gray-900 border-b border-gray-600 flex justify-between items-center text-white">
        <div>
            <h3 class="text-2xl font-black tracking-tight flex items-center gap-3">
                🏆 Lliga Femenina
            </h3>
            <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest font-semibold">Classificació Oficial</p>
        </div>
        <div class="flex items-center gap-2 bg-gray-800 px-3 py-1 rounded-full border border-gray-700">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            <span class="text-[10px] text-gray-300 font-bold uppercase">En Directe</span>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b tracking-wider select-none">
                <tr>
                    <th class="px-4 py-4 text-center w-16 cursor-pointer hover:bg-gray-100 hover:text-blue-600 transition" wire:click="sortBy('punts')">
                        Pos
                    </th>
                    
                    <th class="px-4 py-4 cursor-pointer hover:bg-gray-100 hover:text-blue-600 transition" wire:click="sortBy('nom')">
                        <div class="flex items-center gap-1">
                            Equip
                            @if($sortCol === 'nom') <span>{{ $sortAsc ? '▲' : '▼' }}</span> @endif
                        </div>
                    </th>

                    <th class="px-4 py-4 text-center font-black text-gray-800 text-base cursor-pointer hover:bg-gray-100 hover:text-blue-600 transition" title="Punts" wire:click="sortBy('punts')">
                        <div class="flex items-center justify-center gap-1">
                            PTS
                            @if($sortCol === 'punts') <span class="text-xs">{{ $sortAsc ? '▲' : '▼' }}</span> @endif
                        </div>
                    </th>

                    <th class="px-2 py-4 text-center cursor-pointer hover:text-blue-600" title="Partits Jugats" wire:click="sortBy('pj')">PJ</th>
                    <th class="px-2 py-4 text-center hidden sm:table-cell cursor-pointer hover:text-green-600" title="Victòries" wire:click="sortBy('pg')">V</th>
                    <th class="px-2 py-4 text-center hidden sm:table-cell cursor-pointer hover:text-yellow-600" title="Empats" wire:click="sortBy('pe')">E</th>
                    <th class="px-2 py-4 text-center hidden sm:table-cell cursor-pointer hover:text-red-600" title="Derrotes" wire:click="sortBy('pp')">D</th>
                    
                    <th class="px-2 py-4 text-center hidden md:table-cell cursor-pointer hover:text-blue-600" wire:click="sortBy('gf')">GF</th>
                    <th class="px-2 py-4 text-center hidden md:table-cell cursor-pointer hover:text-blue-600" wire:click="sortBy('gc')">GC</th>
                    
                    <th class="px-4 py-4 text-center font-bold cursor-pointer hover:text-blue-600" wire:click="sortBy('dif')">
                        <div class="flex items-center justify-center gap-1">
                            +/-
                            @if($sortCol === 'dif') <span class="text-xs">{{ $sortAsc ? '▲' : '▼' }}</span> @endif
                        </div>
                    </th>
                    <th class="px-4 py-4 text-center hidden lg:table-cell">Forma</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach($taula as $index => $equip)
                @php
                    // Recalculem el rang visual (1, 2, 3...) independentment de l'ordre de l'array
                    $rank = $loop->iteration;
                    
                    // Highlight si és l'equip de l'usuari logueado
                    $isMyTeam = Auth::check() && Auth::user()->team_id === $equip['id'];
                    $rowClass = $isMyTeam ? 'bg-blue-50 border-l-4 border-blue-500' : 'hover:bg-gray-50';
                    
                    // Colors zona classificació (només si estem ordenant per punts, si no, no té sentit pintar zones)
                    if ($sortCol === 'punts' && !$isMyTeam) {
                        if ($rank <= 4) $rowClass = 'bg-green-50/30'; 
                        if ($rank >= count($taula) - 3) $rowClass = 'bg-red-50/30';
                    }
                @endphp

                <tr class="transition duration-150 ease-in-out {{ $rowClass }}">
                    
                    {{-- Posició --}}
                    <td class="px-4 py-3 text-center text-gray-500 font-medium">
                        {{ $rank }}
                    </td>

                    {{-- Nom Equip i Escut --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex-shrink-0 flex items-center justify-center bg-gray-100 rounded-full overflow-hidden border border-gray-200">
                                @if($equip['escut'])
                                    <img src="{{ asset('storage/' . $equip['escut']) }}" alt="Escut" class="w-full h-full object-cover">
                                @else
                                    <span class="text-xs font-bold text-gray-400">{{ substr($equip['nom'], 0, 2) }}</span>
                                @endif
                            </div>
                            
                            <span class="font-bold text-gray-800 {{ $isMyTeam ? 'text-blue-700' : '' }}">
                                {{ $equip['nom'] }}
                                @if($isMyTeam) <span class="ml-2 text-[10px] bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded border border-blue-200">EL TEU EQUIP</span> @endif
                            </span>
                        </div>
                    </td>

                    {{-- Punts --}}
                    <td class="px-4 py-3 text-center text-lg font-black text-gray-800">
                        {{ $equip['punts'] }}
                    </td>

                    {{-- Stats --}}
                    <td class="px-2 py-3 text-center font-mono text-gray-600">{{ $equip['pj'] }}</td>
                    <td class="px-2 py-3 text-center hidden sm:table-cell text-gray-600">{{ $equip['pg'] }}</td>
                    <td class="px-2 py-3 text-center hidden sm:table-cell text-gray-600">{{ $equip['pe'] }}</td>
                    <td class="px-2 py-3 text-center hidden sm:table-cell text-gray-600">{{ $equip['pp'] }}</td>
                    <td class="px-2 py-3 text-center hidden md:table-cell text-gray-400 text-xs">{{ $equip['gf'] }}</td>
                    <td class="px-2 py-3 text-center hidden md:table-cell text-gray-400 text-xs">{{ $equip['gc'] }}</td>

                    {{-- Diferència --}}
                    <td class="px-4 py-3 text-center font-bold text-sm">
                        @if($equip['dif'] > 0)
                            <span class="text-green-600">+{{ $equip['dif'] }}</span>
                        @elseif($equip['dif'] < 0)
                            <span class="text-red-600">{{ $equip['dif'] }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- Forma --}}
                    <td class="px-4 py-3 hidden lg:table-cell">
                        <div class="flex justify-center items-center gap-1">
                            @foreach($equip['forma'] as $resultat)
                                <span class="w-2.5 h-2.5 rounded-sm 
                                    {{ $resultat === 'V' ? 'bg-green-500' : ($resultat === 'E' ? 'bg-gray-300' : 'bg-red-500') }}"
                                    title="{{ $resultat === 'V' ? 'Victòria' : ($resultat === 'E' ? 'Empat' : 'Derrota') }}">
                                </span>
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>