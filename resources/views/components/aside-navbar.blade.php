<aside
    {{ $attributes->merge(['class' => 'w-36 flex-shrink-0 sm:block']) }}
>
    <h2 class="text-lg font-semibold hidden sm:inline">Links</h2>
    <ul class="mt-5 flex-col space-y-3">
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
        <li class="px-3 py-2 rounded-lg {{ request()->is('order') ? 'bg-blue text-white' : '' }}">
            <a href="{{ route('restaurant.index') }}" class="flex items-center gap-3">
                        <span class="material-symbols-outlined">
                           edit_note
                        </span>
                Order
            </a>
        </li>
    </ul>
</aside>
