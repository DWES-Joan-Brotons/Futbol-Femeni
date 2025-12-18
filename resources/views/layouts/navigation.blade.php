<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('equips.index')" :active="request()->routeIs('equips.*')">
                        {{ __('Guia d\'Equips') }}
                    </x-nav-link>
                    <x-nav-link :href="route('estadis.index')" :active="request()->routeIs('estadis.*')">
                        {{ __('Estadis') }}
                    </x-nav-link>
                    <x-nav-link :href="route('jugadores.index')" :active="request()->routeIs('jugadores.*')">
                        {{ __('Jugadores') }}
                    </x-nav-link>
                    <x-nav-link :href="route('partits.index')" :active="request()->routeIs('partits.index')">
                        {{ __('Partits') }}
                    </x-nav-link>
                    
                    {{-- NOU ENLLAÇ HISTÒRIC --}}
                    <x-nav-link :href="route('partits.historic')" :active="request()->routeIs('partits.historic')">
                        {{ __('Històric') }}
                    </x-nav-link>

                    {{-- Enllaços Creació --}}
                    @can('create', App\Models\Equip::class)
                        <x-nav-link :href="route('equips.create')" :active="request()->routeIs('equips.create')" class="text-blue-600">
                            {{ __('+ Equip') }}
                        </x-nav-link>
                    @endcan
                    @can('create', App\Models\Partit::class)
                         <x-nav-link :href="route('partits.create')" :active="request()->routeIs('partits.create')" class="text-green-600">
                            {{ __('+ Partit') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                @switch(App::getLocale())
                                    @case('ca') 🇸🇱 Català @break
                                    @case('es') 🇪🇸 Español @break
                                    @case('en') 🇺🇸 English @break
                                    @default 🇸🇱 Català
                                @endswitch
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('language.switch', 'ca')">
                            🇸🇱 Català
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('language.switch', 'es')">
                            🇪🇸 Español
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('language.switch', 'en')">
                            🇺🇸 English
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('equips.index')" :active="request()->routeIs('equips.*')">
                {{ __('Guia d\'Equips') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('estadis.index')" :active="request()->routeIs('estadis.*')">
                {{ __('Estadis') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('jugadores.index')" :active="request()->routeIs('jugadores.*')">
                {{ __('Jugadores') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('partits.index')" :active="request()->routeIs('partits.index')">
                {{ __('Partits') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('partits.historic')" :active="request()->routeIs('partits.historic')">
                {{ __('Històric') }}
            </x-responsive-nav-link>

            {{-- Responsive Links amb protecció --}}
            @can('create', App\Models\Equip::class)
                <x-responsive-nav-link :href="route('equips.create')">
                    {{ __('+ Crear Equip') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>