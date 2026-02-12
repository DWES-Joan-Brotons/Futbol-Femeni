<div wire:poll.5s class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200 font-sans">
    
    {{-- Capçalera --}}
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
                    <th class="px-4 py-4 text-center w-20 cursor-pointer hover:bg-gray-100 hover:text-blue-600 transition" wire:click="sortBy('punts')">
                        Pos
                    </th>
                    <th class="px-4 py-4 cursor-pointer hover:bg-gray-100 hover:text-blue-600 transition" wire:click="sortBy('nom')">Equip</th>
                    <th class="px-4 py-4 text-center font-black text-gray-800 text-base cursor-pointer hover:bg-gray-100 transition" wire:click="sortBy('punts')">PTS</th>
                    <th class="px-2 py-4 text-center cursor-pointer hover:text-blue-600" wire:click="sortBy('pj')">PJ</th>
                    <th class="px-2 py-4 text-center hidden sm:table-cell cursor-pointer" wire:click="sortBy('pg')">V</th>
                    <th class="px-2 py-4 text-center hidden sm:table-cell cursor-pointer" wire:click="sortBy('pe')">E</th>
                    <th class="px-2 py-4 text-center hidden sm:table-cell cursor-pointer" wire:click="sortBy('pp')">D</th>
                    <th class="px-2 py-4 text-center hidden md:table-cell cursor-pointer" wire:click="sortBy('gf')">GF</th>
                    <th class="px-2 py-4 text-center hidden md:table-cell cursor-pointer" wire:click="sortBy('gc')">GC</th>
                    <th class="px-4 py-4 text-center font-bold cursor-pointer" wire:click="sortBy('dif')">+/-</th>
                    <th class="px-4 py-4 text-center hidden lg:table-cell">Forma</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach($taula as $index => $equip)
                @php
                    $rank = $loop->iteration;
                    $isMyTeam = Auth::check() && Auth::user()->team_id === $equip['id'];
                    
                    // --- LÒGICA DE COLORS (CELDA ENTERA/FILA) ---
                    // Per defecte
                    $rowClass = 'hover:bg-gray-50 transition duration-500'; 
                    $textClass = 'text-gray-800';

                    // Si puja: Fons Verd fort
                    if ($equip['moviment'] === 'pujar') {
                        $rowClass = 'bg-green-200 transition duration-500'; 
                        $textClass = 'text-green-900 font-bold';
                    } 
                    // Si baixa: Fons Roig fort
                    elseif ($equip['moviment'] === 'baixar') {
                        $rowClass = 'bg-red-200 transition duration-500';
                        $textClass = 'text-red-900 font-bold';
                    } 
                    // Si és el meu equip (i no es mou), blau
                    elseif ($isMyTeam) {
                        $rowClass = 'bg-blue-50 border-l-4 border-blue-500';
                        $textClass = 'text-blue-900';
                    }
                @endphp

                <tr class="{{ $rowClass }}">
                    
                    {{-- Posició + Flecha --}}
                    <td class="px-4 py-3 text-center font-medium {{ $textClass }}">
                        <div class="flex items-center justify-center gap-1">
                            <span class="text-lg">{{ $rank }}</span>
                            
                            @if($equip['moviment'] === 'pujar')
                                <span class="text-green-700 text-sm animate-bounce">▲</span>
                            @elseif($equip['moviment'] === 'baixar')
                                <span class="text-red-700 text-sm animate-pulse">▼</span>
                            @endif
                        </div>
                    </td>

                    {{-- Nom Equip --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex-shrink-0 bg-gray-100 rounded-full overflow-hidden border border-gray-200">
                                @if($equip['escut'])
                                    <img src="{{ asset('storage/' . $equip['escut']) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="flex items-center justify-center h-full w-full text-xs text-gray-400">{{ substr($equip['nom'], 0, 2) }}</span>
                                @endif
                            </div>
                            <span class="font-bold {{ $textClass }}">
                                {{ $equip['nom'] }}
                                @if($isMyTeam && $equip['moviment'] === 'igual') 
                                    <span class="ml-2 text-[10px] bg-blue-100 text-blue-800 px-1 py-0.5 rounded">EL TEU EQUIP</span> 
                                @endif
                            </span>
                        </div>
                    </td>

                    {{-- Punts --}}
                    <td class="px-4 py-3 text-center text-xl font-black {{ $textClass }}">
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
                        @if($equip['dif'] > 0) <span class="text-green-600">+{{ $equip['dif'] }}</span>
                        @elseif($equip['dif'] < 0) <span class="text-red-600">{{ $equip['dif'] }}</span>
                        @else <span class="text-gray-400">-</span> @endif
                    </td>

                    {{-- Forma --}}
                    <td class="px-4 py-3 hidden lg:table-cell">
                        <div class="flex justify-center items-center gap-1">
                            @foreach($equip['forma'] as $resultat)
                                <span class="w-2.5 h-2.5 rounded-sm {{ $resultat === 'V' ? 'bg-green-500' : ($resultat === 'E' ? 'bg-gray-300' : 'bg-red-500') }}"></span>
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('classificacio-canviada', () => {
                // Alerta simple
                alert('⚠️ Actualització: La classificació ha canviat!');
            });
        });
    </script>
</div>