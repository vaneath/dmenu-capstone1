<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-800 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <img src="{{ asset('images/dmenu.png') }}" alt="" width="30" height="30">

            <span class="mx-2 text-2xl font-semibold text-white">Dmenu</span>
        </div>
    </div>

    @if(auth()->user()?->role == 'superadmin')
        <nav class="mt-10">
            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-600 {{ request()->is('superadmin') ? 'text-yellow' : ''}}" href="{{ route('superadmin.index') }}">
                <i class="fa-solid fa-database fa-lg {{ request()->is('superadmin') ? 'fa-bounce' : '' }}"></i>

                <span class="mx-3">Dashboard</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-600 {{ request()->is('superadmin/users') ? 'text-yellow' : ''}}" href="{{ route('superadmin.users') }}">
                <i class="fa-solid fa-users fa-lg {{ request()->is('superadmin/users') ? 'fa-bounce' : ''}}"></i>
                <span class="mx-3">Users</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-600 {{ request()->is('superadmin/restaurants') ? 'text-yellow' : ''}}" href="{{ route('superadmin.restaurants') }}">
                <i class="fa-solid fa-utensils fa-lg {{ request()->is('superadmin/restaurants') ? 'fa-bounce' : ''}}"></i>
                <span class="mx-3">Restaurants</span>
            </a>
        </nav>
    @else
        <nav class="mt-10">
            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-600 {{ request()->is('dashboard') ? 'text-yellow' : ''}}" href="{{ route('dashboard.index', ) }}">
                <i class="fa-solid fa-database fa-lg {{ request()->is('dashboard') ? 'fa-bounce' : '' }}"></i>

                <span class="mx-3">Dashboard</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-600 {{ request()->is('restaurants') ? 'text-yellow' : ''}}" href="{{ route('restaurant.index') }}">
                <i class="fa-solid fa-utensils fa-lg {{ request()->is('restaurants') ? 'fa-bounce' : ''}}"></i>
                <span class="mx-3">Restaurants</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-600 {{ request()->is('orders') ? 'text-yellow' : ''}}" href="{{ route('order.order') }}">
                <i class="fa-solid fa-bowl-food fa-lg {{ request()->is('orders') ? 'fa-bounce' : ''}}"></i>
                <span class="mx-3">Order</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-600 {{ request()->is('profile') ? 'text-yellow' : ''}}" href="{{ route('profile.edit') }}">
                <i class="fa-solid fa-users fa-lg {{ request()->is('profile') ? 'fa-bounce' : ''}}"></i>
                <span class="mx-3">Profile</span>
            </a>
        </nav>
    @endif
</div>
