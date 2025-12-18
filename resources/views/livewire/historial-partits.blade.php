<div class="space-y-6">
    {{-- Filtres --}}
    <div class="bg-white p-4 rounded-lg shadow flex flex-col md:flex-row gap-4 items-end">
        <div class="w-full md:w-1/3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Buscar Equip</label>
            <input wire:model="equip" type="text" placeholder="Ex: Barcelona..." 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <div class="w-full md:w-auto">
            <label class="block text-sm font-medium text-gray-700 mb-1">Data</label>
            <input wire:model="data" type="date" 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <button wire:click="filtrar" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
            Filtrar Resultats
        </button>
    </div>

    {{-- Taula de Resultats --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-700 uppercase font-bold text-xs">
                <tr>
                    <th class="px-6 py-3">Data</th>
                    <th class="px-6 py-3">Local</th>
                    <th class="px-6 py-3">Visitant</th>
                    <th class="px-6 py-3 text-center">Resultat</th>
                    <th class="px-6 py-3 hidden md:table-cell">Estadi</th>
                    <th class="px-6 py-3 hidden md:table-cell">Àrbitre</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($partits as $partit)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $partit->data->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $partit->equipLocal->nom }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $partit->equipVisitant->nom }}</td>
                        <td class="px-6 py-4 text-center font-bold text-blue-600 bg-blue-50 rounded">
                            {{ $partit->resultat }}
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">{{ $partit->estadi->nom }}</td>
                        <td class="px-6 py-4 hidden md:table-cell text-xs italic">
                            {{ $partit->arbitre->name ?? 'Sense assignar' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No s'han trobat partits amb aquests criteris.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>