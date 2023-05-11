<x-app-layout {{$attributes->merge(['class' => ''])}}>
    <section class="px-6 py-8 mx-auto max-w-6xl">
        <x-slot name="header">
            <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
                <button class="absolute left-10"
                >
                <span class="material-symbols-outlined">
                    menu
                </span>
                </button>
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <div class="flex gap-5">
            <aside
                class="w-36 flex-shrink-0"
            >
                <h4 class="font-semibold mb-4">Links</h4>
                <ul>
                    <li class="px-3 py-2 rounded-lg {{ request()->is('profile') ? 'bg-blue text-white' : '' }}">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3">
                        <span class="material-symbols-outlined">
                        manage_accounts
                        </span>
                            Profile
                        </a>
                    </li>
                    <li class="px-3 py-2 rounded-lg {{ request()->is('restaurant') ? 'bg-blue text-white' : '' }}">
                        <a href="/restaurant" class="flex items-center gap-3">
                        <span class="material-symbols-outlined">
                            restaurant_menu
                        </span>
                            Restaurant
                        </a>
                    </li>
                </ul>
            </aside>
            <main class="flex flex-wrap gap-10">
                {{ $slot }}
            </main>
        </div>
    </section>
</x-app-layout>
