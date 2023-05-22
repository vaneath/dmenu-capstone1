<nav class="bg-blue flex justify-evenly items-center">
    <div class="w-16 h-16 md:w-20 md:h-20">
        <a href="/">
            <img src="{{ asset('images/dmenu.png') }}" alt="">
        </a>
    </div>
    <div class="flex gap-5">
        <a href="{{ auth() ? route('profile.edit') : route('login')  }}"
           class="text-sm px-7 py-2 transition ease-linear duration-300 bg-yellow text-white rounded-xl border-2 border-yellow hover:bg-transparent hover:scale-110 hover:text-yellow"
        >
            {{ auth()->user() ? ucwords(auth()->user()->name) : 'Login' }}
        </a>
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="sm:inline-flex text-sm px-7 py-2 transition ease-linear duration-300 bg-yellow text-white rounded-xl border-2 border-yellow hover:bg-transparent hover:scale-110 hover:text-yellow"
                >
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('register') }}"
               class="text-sm px-7 py-2 transition ease-linear duration-300 bg-yellow text-white rounded-xl border-2 border-yellow hover:bg-transparent hover:scale-110 hover:text-yellow"
            >
                Register
            </a>
        @endauth
    </div>
</nav>
