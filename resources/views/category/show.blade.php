<div 
x-data="{ 
    createItemFormOpen: false, 
    toggleModal() { 
        this.createItemFormOpen = !this.createCategoryFormOpen; 
    } 
}" 
@toggle-modal="toggleModal"
>
    <h1 class="text-white px-6 py-1">
        {{ ucwords($category->name) }}
    </h1>

    @auth
    @if(auth()->id() == $restaurant->user_id && $items->count() == 0)
        <button @click="toggleModal" class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold">
            +
        </button>
    @endif
    @endauth

    @foreach($items as $item)
        @auth
        @if(auth()->id() == $restaurant->user_id)
        <button @click="toggleModal" class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold">
            +
        </button>
        @endif
        @endauth
        <x-menu-card
            :item="$item"
        />
    @endforeach

    <x-item-create-modal :restaurant="$restaurant" :category="$category" />
</div>