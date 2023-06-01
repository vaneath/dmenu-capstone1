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
        <div class="relative mb-5 rounded-2xl">
            <div class="absolute flex space-x-3 z-40 bg-white top-3 right-3 px-6 py-5 rounded-lg">
                <i class="fa-solid fa-up-down-left-right fa-lg" style="color: #e4a11b;"></i>
                <i class="fa-regular fa-pen-to-square fa-lg" style="color: #e4a11b;"></i>
                <i class="fa-solid fa-trash fa-lg" style="color: #e4a11b;"></i>
            </div>
            <div class="bg-black w-full h-full rounded-2xl">
                <img
                    src="{{ $category->img_url ?? asset('images/dmenu.png') }}"
                    alt="{{ $category->name }}"
                    class="bg-cover bg-center h-52 w-full rounded-2xl blur-xs transition ease-linear duration-300 hover:opacity-80"
                >
            </div>
            <h3 class="uppercase text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                {{ $category->name }}
            </h3>
        </div>
    @endif
</div>
