<div x-data="{ createRestaurantFormOpen: false, toggleModal() { this.createRestaurantFormOpen = !this.createRestaurantFormOpen; this.$dispatch('create-restaurant-form-open', { createRestaurantFormOpen: this.createRestaurantFormOpen }); } }" @toggle-modal="toggleModal">
    <div class="w-48 h-56 px-2 py-3 bg-blue text-white rounded-xl">
        <h3 class="mt-5 font-bold text-center text-md">Add Restaurant</h3>
        <div class="mt-5">
            <button @click="toggleModal" class="flex items-center justify-center mx-auto rounded-full bg-orange-300 w-20 h-20 flex items-center justify-center">
                <span class="material-symbols-outlined">
                   add
                </span>
            </button>
        </div>
    </div>

    <x-restaurant-create-modal />
</div>
