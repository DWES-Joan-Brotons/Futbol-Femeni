@extends('layouts.equip')

@section('title', 'Històric de Partits')

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Històric de Partits</h1>
    
    {{-- Aquí carreguem el component Livewire --}}
    <livewire:historial-partits />
@endsection