<div x-data="{ createCategoryFormOpen: false, toggleModal() { this.createCategoryFormOpen = !this.createCategoryFormOpen; this.$dispatch('create-restaurant-form-open', { createCategoryFormOpen: this.createCategoryFormOpen }); } }" @toggle-modal="toggleModal">
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
                <div class="relative z-50 flex space-x-5 bg-white top-3 right-3 px-6 py-4 rounded-lg mt-5">
                    <i class="fa-solid fa-up-down-left-right fa-lg" style="color: #e4a11b;"></i>
                    <i class="fa-regular fa-pen-to-square fa-lg" style="color: #e4a11b;"></i>
                    <i class="fa-solid fa-trash fa-lg" style="color: #e4a11b;"></i>
                </div>
                <x-category-card
                    :category="$category"
                    :restaurant="$restaurant"
                />
            @endforeach
        @endif
<x-category-create-modal :section="$section"/>
</div>
