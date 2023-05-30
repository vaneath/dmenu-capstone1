<div x-data="{ createCategoryFormOpen: false, toggleModal() { this.createCategoryFormOpen = !this.createCategoryFormOpen; this.$dispatch('create-restaurant-form-open', { createCategoryFormOpen: this.createCategoryFormOpen }); } }" @toggle-modal="toggleModal">
    <ul>
        @auth
        @if(auth()->id() == $restaurant->user_id)
        @if($categories->count() == 0)
            <button @click="toggleModal" class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
                +
            </button>
        @endif
        @endif
        @endauth
        @if($categories->count() > 0)
            @foreach ($categories as $category)
                @auth
                @if(auth()->id() == $restaurant->user_id)
                <button @click="toggleModal" class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
                    +
                </button>
                @endif
                @endauth
                <div  @click="$dispatch('select-category', '{{ $category->id }}')" class="cursor-pointer">
                    @if(!Auth::check() || (Auth::check() && $restaurant->user_id != Auth::id()))
                        @if($category->is_visible)
                            <li class="relative mb-5 hover:bg-black hover:opacity-80 rounded-2xl transition ease-linear duration-300 blur-xs">
                                <img
                                    src="{{ $category->img_url ?? asset('images/dmenu.png') }}"
                                    alt="{{ $category->name }}"
                                    class="bg-cover bg-center h-52 w-full rounded-2xl"
                                >
                                <h3 class="uppercase text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                                    {{ $category->name }}
                                </h3>
                            </li>
                        @endif
                    @else
                        <li class="relative mb-5 hover:bg-black hover:opacity-80 rounded-2xl transition ease-linear duration-300 blur-xs">
                            <img
                                src="{{ $category->img_url ?? asset('images/dmenu.png') }}"
                                alt="{{ $category->name }}"
                                class="bg-cover bg-center h-52 w-full rounded-2xl"
                            >
                            <h3 class="uppercase text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                                {{ $category->name }}
                            </h3>
                        </li>
                    @endif
                </div>
            @endforeach
        @endif
</ul>
<x-category-create-modal :section="$section"/>
</div>
