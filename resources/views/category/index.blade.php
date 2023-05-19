<div x-data="{ createCategoryFormOpen: false, toggleModal() { this.createCategoryFormOpen = !this.createCategoryFormOpen; this.$dispatch('create-restaurant-form-open', { createCategoryFormOpen: this.createCategoryFormOpen }); } }" @toggle-modal="toggleModal">
    <ul>
        @if($categories->count() == 0)
            <button @click="toggleModal" class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
                +
            </button>
        @endif
        @if($categories->count() > 0)
            @foreach ($categories as $category)
                @if (auth()->user()->id == $restaurant->user_id)
                    <button @click="toggleModal" class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
                        +
                    </button>
                @endif
                <!-- <a href="/restaurants/{{ $restaurant->id }}/sections/{{ $section->id }}/categories/{{ $category->id }}"> -->
                <div  @click="$dispatch('select-category', {{ $category->id }})" class="cursor-pointer">
                    <li class="relative mb-5">
                        <img
                            src="{{ $category->img_url ?? asset('images/dmenu.png') }}"
                            alt="{{ $category->name }}"
                            class="bg-cover bg-center h-52 w-full rounded-2xl blur-xs transition ease-linear duration-300 hover:opacity-70"
                        >
                        <h3 class="uppercase text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                            {{ $category->name }}
                        </h3>
                    </li>
                </div>
                <!-- </a> -->
            @endforeach
        @endif
    </ul>
    <x-category-create-modal :section="$section"/>
</div>
