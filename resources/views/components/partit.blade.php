@props(['partit', 'key'])

<tr class="hover:bg-gray-100">
    <td class="border border-gray-300 p-2">
        <a href="{{ route('partits.show', $key) }}" class="text-blue-700 hover:underline font-medium">{{ $partit['local'] }}</a>
    </td>
    <td class="border border-gray-300 p-2 font-medium">
        {{ $partit['visitant'] }}
    </td>
    <td class="border border-gray-300 p-2">{{ \Carbon\Carbon::parse($partit['data'])->format('d/m/Y') }}</td>
    <td class="border border-gray-300 p-2">{{ $partit['resultat'] ?? 'Pendent' }}</td>
</tr>