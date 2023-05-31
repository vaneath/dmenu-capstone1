@props(['category', 'restaurant'])
<div  @click="$dispatch('select-category', '{{ $category->id }}')" class="cursor-pointer">
    @if(!Auth::check() || (Auth::check() && $restaurant->user_id != Auth::id()))
        @if($category->is_visible)
            <div class="relative mb-5 hover:bg-black hover:opacity-80 rounded-2xl transition ease-linear duration-300 blur-xs">
                <img
                    src="{{ $category->img_url ?? asset('images/dmenu.png') }}"
                    alt="{{ $category->name }}"
                    class="bg-cover bg-center h-52 w-full rounded-2xl"
                >
                <h3 class="uppercase text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                    {{ $category->name }}
                </h3>
            </div>
        @endif
    @else
        <div class="relative mb-5 hover:bg-black hover:opacity-80 rounded-2xl transition ease-linear duration-300 blur-xs">
            <img
                src="{{ $category->img_url ?? asset('images/dmenu.png') }}"
                alt="{{ $category->name }}"
                class="bg-cover bg-center h-52 w-full rounded-2xl"
            >
            <h3 class="uppercase text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                {{ $category->name }}
            </h3>
        </div>
    @endif
</div>