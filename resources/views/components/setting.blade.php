<x-app-layout x-data="{open: false}">
    @auth
    <div x-show="open" class=" bg-red-600 absolute w-full bg-transparent z-50 sm:hidden" >
        <nav class="bg-white w-full pt-5 pb-10">
            <x-aside-navbar class="mx-auto" />
        </nav>
    </div>
    @endauth
    <div class="absolute top-[5.5rem] right-10 inline sm:hidden" @click="open = ! open">
        <span x-show="! open" class="material-symbols-outlined">
            menu
        </span>
        <span x-show="open" class="material-symbols-outlined">
            close
        </span>
    </div>
    <section class="px-6 py-8 mx-auto max-w-7xl">
        @if(auth()->user()->role != 'superadmin')
            <x-slot name="header">
                    <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
            </x-slot>
        @endif
        <div class="flex justify-center gap-5 mb-10">
            @if(auth()->user()->role != 'superadmin')
                <x-aside-navbar class="hidden" />
            @endif
            <main {{ $attributes->merge(['class' => '']) }}>
                {{ $slot }}
            </main>
        </div>
    </section>
</x-app-layout>
