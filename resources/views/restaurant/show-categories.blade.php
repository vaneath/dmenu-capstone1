<div x-data="{ createCategoryFormOpen: false, toggleModal() { this.createCategoryFormOpen = !this.createCategoryFormOpen; this.$dispatch('create-restaurant-form-open', { createCategoryFormOpen: this.createCategoryFormOpen }); } }" @toggle-modal="toggleModal">
    <ul>
    <p>activeSectionPage</p>
    <button class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
        +
    </button>
    <a href="/restaurants/1/main_menu">
        <li class="relative mb-5">
            <img
                src="https://th.bing.com/th/id/R.4767c2cef2fe33f19fe0abe8acf643b2?rik=PXnnztHtSXWldw&pid=ImgRaw&r=0"
                alt=""
                class="bg-cover bg-center h-52 w-full rounded-2xl blur-xs transition ease-linear duration-300"
            >
            <h3 class="text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                PIZZA
            </h3>
        </li>
    </a>
    @foreach ($categories as $category)
        <button @click="toggleModal" class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
            +
        </button>
        <a href="/restaurants/{{ $restaurant->id }}/sections/{{ $section->id }}/categories/{{ $category->id }}">
            <li class="relative mb-5">
                <img
                    src="{{ $category->img_url }}"
                    alt=""
                    class="bg-cover bg-center h-52 w-full rounded-2xl blur-xs transition ease-linear duration-300"
                >
                <h3 class="text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                    {{ $category->name }}
                </h3>
            </li>
        </a>
    @endforeach
</ul> 
<x-category-create-modal :section="$section"/>
</div>