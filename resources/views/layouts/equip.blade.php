<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- Aquí mostramos el título que define cada vista con @section('title') --}}
            @yield('title', 'Futbol Femení')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Si utilizas mensajes flash (success/error), es buen lugar para incluirlos aquí --}}
                    @include('partials.messages')

                    {{-- Aquí se inyectará el contenido de tus vistas (index, create, etc.) --}}
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>