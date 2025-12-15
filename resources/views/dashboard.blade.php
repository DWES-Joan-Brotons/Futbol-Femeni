<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Panell de Control') }}
            </h2>
            <span class="px-3 py-1 text-xs font-bold text-white bg-blue-600 rounded-full">
                Temporada 2024/25
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Sección de Bienvenida --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">Benvingut, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        Aquí tens el resum de la competició en temps real.
                    </p>
                </div>
            </div>

            {{-- AQUÍ ES DONDE LLAMAMOS AL COMPONENTE LIVEWIRE --}}
            <div class="relative">
                <livewire:classificacio />
            </div>

        </div>
    </div>
</x-app-layout>