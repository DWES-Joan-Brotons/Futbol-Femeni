@extends('layouts.equip')
@section('title', "Guia d'Estadis")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Guia d'Estadis</h1>

@include('partials.messages')

@can('create', App\Models\Estadi::class)
<p class="mb-4">
  <a href="{{ route('estadis.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded shadow hover:bg-blue-700 transition">
      + Nou Estadi
  </a>
</p>
@endcan

<div class="overflow-x-auto rounded-lg shadow">
    <table class="w-full border-collapse border border-gray-200 bg-white">
      <thead class="bg-gray-100">
      <tr>
        <th class="p-3 text-left font-semibold text-gray-700 border-b">Nom</th>
        <th class="p-3 text-center font-semibold text-gray-700 border-b">Capacitat</th>
        <th class="p-3 text-center font-semibold text-gray-700 border-b">Accions</th>
      </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
      @foreach($estadis as $estadi)
        <tr class="hover:bg-gray-50 transition">
          <td class="p-3">
            <a href="{{ route('estadis.show', $estadi) }}" class="text-blue-700 hover:underline font-medium">{{ $estadi->nom }}</a>
          </td>
          <td class="p-3 text-center">{{ number_format($estadi->capacitat) }}</td>
          <td class="p-3">
            <div class="flex items-center justify-center space-x-2">
                @can('update', $estadi)
                    <a href="{{ route('estadis.edit', $estadi) }}" class="text-yellow-500 hover:text-yellow-700 p-1" title="Editar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>
                @endcan

                @can('delete', $estadi)
                    <form action="{{ route('estadis.destroy', $estadi) }}" method="POST" class="inline" onsubmit="return confirm('Estàs segur?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Eliminar">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>
                @endcan
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
</div>
@endsection