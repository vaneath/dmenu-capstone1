<h2 class="mb-3 text-2xl text-white">
    {{ ucwords($category->name) }}
</h2>
<div>
    <ul>
        @auth
            @if(auth()->id() == $restaurant->user_id)
                @if ($items->count() == 0)
                    <button class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
                        +
                    </button>
                @endif
            @endif
        @endauth
        @if ($items->count() > 0)
            @foreach ($items as $item)
                @auth
                    @if(auth()->id() == $restaurant->user_id)
                    <button class="w-full mb-5 py-2 bg-yellow rounded-2xl tFsext-white font-bold text-lg">
                        +
                    </button>
                    @endif
                @endauth
                <div @click="$dispatch('add-to-cart', )">
                    <li class="relative mb-5">
                        <img
                            src="{{ $item->img_url }}"
                            alt=""
                            class="bg-cover bg-center h-52 w-full rounded-2xl blur-xs transition ease-linear duration-300"
                        >
                        <h3 class="text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                            {{ $item->name }}
                        </h3>
                    </li>
                </div>
            @endforeach
        @endif
    </ul>
</div>
