<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('equips.index')" :active="request()->routeIs('dashboard')">
        {{ __('Guia Equips') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('estadis.index')" :active="request()->routeIs('dashboard')">
        {{ __('Estadis') }}
    </x-nav-link>
</div>