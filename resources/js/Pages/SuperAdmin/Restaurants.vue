<script setup>
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import RestaurantCard from '@/Pages/Restaurant/Partials/RestaurantCard.vue';

const props = defineProps({
    restaurants: Array,
});

</script>

<template>
    <SuperAdminLayout>
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 justify-items-center">
            <template v-for="restaurant in restaurants" :key="restaurant.id">
                <RestaurantCard :restaurant="restaurant" />
            </template>
        </div>
    </SuperAdminLayout>
</template>

<style scoped>

</style>
