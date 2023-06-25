<script setup>
import { Link } from '@inertiajs/vue3';
import CategoryDeleteModal from "@/Pages/Category/Partials/CategoryDeleteModal.vue";
import CategoryUpdateModal from './CategoryUpdateModal.vue';
import { useCategoryStore } from '@/Stores/CategoryStore.js';

const props = defineProps({
    can: Boolean,
    category: Object,
    restaurant: Object,
    tags: Array,
});

</script>

<template>
    <div class="mb-5 relative">
        <div
                v-if="props.can"
                class="absolute top-0 right-0 flex space-x-4 items-center px-6 py-2 bg-gray-900 rounded-lg z-10 mt-3 mr-3 aspect-w-2 aspect-h-1"
                @click.stop
            >
                <CategoryUpdateModal 
                    :category="category"
                    :restaurant="restaurant"
                    :tags="tags"
                    />
                <CategoryDeleteModal :category="category" />
        </div>
    <Link :href="`/restaurants/${props.restaurant.id}/categories/${props.category.id}`">
            <img class="w-full h-48 rounded-3xl" :src="`/storage/${props.category.bg_img_url}`" alt="">
            <div
                class="grid place-items-center absolute h-full bottom-0 left-0 right-0 rounded-3xl bg-gray-900 bg-opacity-50 hover:bg-opacity-70">
                <h3 class="text-white text-xl font-bold">{{ category.name }}</h3>
            </div>
    </Link>
    </div>
</template>

<style scoped>

</style>
