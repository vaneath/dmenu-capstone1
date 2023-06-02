<div
x-data="{
    createItemFormOpen: false,
    updateItemFormOpen: false,
    updateItem: null,
    toggleModal() {
        this.createItemFormOpen = !this.createCategoryFormOpen;
    },
}"
@toggle-modal="toggleModal"
x-on:update-item-form-open.window="updateItemFormOpen = $event.detail.updateItemFormOpen, updateItem = $event.detail"
>
    <h1 class="text-white px-6 py-1 text-lg font-bold text-4xl">
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
        @if(!Auth::check() || (Auth::check() && $restaurant->user_id != Auth::id()))
            @if($item->is_available)
                <x-menu-card
                    :item="$item"
                    :restaurant="$restaurant"
                />
            @endif
        @else
            <x-menu-card
                :item="$item"
                :restaurant="$restaurant"
            />
        @endif
    @endforeach

    <x-item-create-modal :restaurant="$restaurant" :category="$category" />
    <x-item-update-modal :restaurant="$restaurant" :category="$category" />
</div>
