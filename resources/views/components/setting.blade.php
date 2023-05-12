<x-app-layout>
    <section class="px-6 py-8 mx-auto max-w-6xl">
        <x-slot name="header">
            <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
                <button class="absolute right-10 md:hidden">
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                </button>
            </h2>
        </x-slot>
        <div class="flex gap-5 mb-10">
            <aside
                class="w-36 flex-shrink-0 hidden md:block"
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
                    <li class="px-3 py-2 rounded-lg {{ request()->is('restaurants') ? 'bg-blue text-white' : '' }}">
                        <a href="{{ route('restaurant.index') }}" class="flex items-center gap-3">
                        <span class="material-symbols-outlined">
                            restaurant_menu
                        </span>
                            Restaurant
                        </a>
                    </li>
                </ul>
            </aside>
            <main class="flex flex-wrap gap-3">
                {{ $slot }}
            </main>
        </div>
    </section>
</x-app-layout>
