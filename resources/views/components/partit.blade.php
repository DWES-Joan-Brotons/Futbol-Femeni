@props(['partit'])

@php
    $partitModel = \App\Models\Partit::find($partit['id']);
@endphp

<tr class="hover:bg-gray-100">
    <td class="border border-gray-300 p-2">
        <a href="{{ route('partits.show', $partitModel) }}" class="text-blue-700 hover:underline font-medium">
            {{ $partitModel->equipLocal->nom }}
        </a>
    </td>
    <td class="border border-gray-300 p-2 font-medium">
        <a href="{{ route('partits.show', $partitModel) }}" class="text-blue-700 hover:underline font-medium">
            {{ $partitModel->equipVisitant->nom }}
        </a>
    </td>
    <td class="border border-gray-300 p-2">{{ $partitModel->data->format('d/m/Y') }}</td>
    <td class="border border-gray-300 p-2">{{ $partitModel->resultat }}</td>
</tr>