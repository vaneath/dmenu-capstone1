<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import RestaurantCreateModal from '@/Pages/Restaurant/Partials/RestaurantCreateModal.vue';
import { useRestaurantStore } from '@/Stores/RestaurantStore.js';
import RestaurantCard from '@/Pages/Restaurant/Partials/RestaurantCard.vue';
import Dropdown from '@/Components/Dropdown.vue';

const props = defineProps({
    show: Boolean,
    restaurants: Array,
});

let restaurantStore = useRestaurantStore();

restaurantStore.showCreateModal = props.show;

</script>

<template>
    <Head title="Restaurants" />

    <AuthenticatedLayout>
        <div class="flex justify-between">
            <h2 class="font-bold text-3xl text-gray-700">Restaurant</h2>
            <div class="flex space-x-5">
                <Dropdown>
<!--                    <template #trigger>-->
<!--                        <button class="text-white bg-gray-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">-->
<!--                            Sort by-->
<!--                        </button>-->
<!--                    </template>-->
                    <template #content>
                        <button @click="restaurantStore.showCreateModal = true" class="btn btn-primary">Create</button>
                    </template>
                </Dropdown>
                <RestaurantCreateModal />
            </div>
        </div>
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 justify-items-center">
            <template v-for="restaurant in restaurants" :key="restaurant.id">
                <RestaurantCard :restaurant="restaurant" />
            </template>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
