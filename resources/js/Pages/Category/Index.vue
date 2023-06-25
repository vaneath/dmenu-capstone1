<script setup>
import { Link, router } from '@inertiajs/vue3';
import MobileLayout from '@/Layouts/MobileLayout.vue';
import CategoryCard from '@/Pages/Category/Partials/CategoryCard.vue';
import CategoryCreateModal from '@/Pages/Category/Partials/CategoryCreateModal.vue';
import TagCreateModal from '@/Pages/Tag/Partials/TagCreateModal.vue';
import ItemCard from '@/Pages/Item/Partials/ItemCard.vue';
import ItemCreateModal from '@/Pages/Item/Partials/ItemCreateModal.vue';
import { ref, watch } from 'vue';
import { useAddToCartStore } from '@/Stores/AddToCartStore.js';
import RestaurantUpdateModal from "@/Pages/Restaurant/Partials/RestaurantUpdateModal.vue";
import RestaurantDeleteModal from "@/Pages/Restaurant/Partials/RestaurantDeleteModal.vue";
import TagDeleteModal from "@/Pages/Tag/Partials/TagDeleteModal.vue";
import TagUpdateModal from "@/Pages/Tag/Partials/TagUpdateModal.vue";
import {useTableStore} from "@/Stores/TableStore.js";

let addToCartStore = useAddToCartStore();
let TableStore = useTableStore();

let props = defineProps({
    table_no: Number,
    canCreate: Boolean,
    restaurant: Object,
    tags: Array,
    categories: Array,
    currentTag: String,
    currentCategory: String,
    items: Object,
    showItem: Boolean,
});


TableStore.table_no = props.table_no;
let currentTag = ref(props.currentTag);

watch(currentTag, (value) => {
    router.get('/restaurants/' + props.restaurant.id, {
        category: value,
    });
});
</script>

<template>
    <Head :title="props.restaurant.name"/>

    <MobileLayout :restaurant_bg="props.restaurant.bg_img_url" :restaurant_logo="props.restaurant.logo_url">
        <template #header>
            <div class="flex justify-between">
                <div class="flex gap-5 items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-text="props.restaurant.name"></h2>
                    <div v-if="props.canCreate" class="flex space-x-3 items-center">
                        <RestaurantUpdateModal :restaurant="props.restaurant" />
                        <RestaurantDeleteModal :restaurant="props.restaurant" />
                    </div>
                </div>
                <div class="flex space-x-3">
                    <CategoryCreateModal v-if="props.tags.length > 0 && !showItem && props.canCreate" :restaurant="restaurant" :tags="tags"/>
                    <ItemCreateModal v-if="showItem && props.canCreate" :restaurant-id="props.restaurant.id" :tag-id="props.currentTag" :category-id="props.currentCategory"/>
                </div>
            </div>
        </template>
        <template #tag>
            <TagCreateModal v-if="props.canCreate" :restaurant="props.restaurant"/>
            <div v-for="tag in props.tags" :key="tag.id" class="flex-col space-y-3">
                <Link
                      v-text="tag.name"
                      :href="'/restaurants/' + props.restaurant.id + '?tag=' + tag.id"
                      class="shrink-0 text-xs font-medium uppercase px-4 py-1.5 border-2 border-yellow rounded-full hover:text-white hover:bg-yellow"
                      :class=" currentTag === tag.id ? 'text-white bg-yellow' : 'text-gray-600 bg-white'"
                >
                </Link>
                <div v-if="props.canCreate" class="flex justify-center space-x-3 items-center px-4 h-7 bg-gray-700 rounded-full">
                    <TagUpdateModal :tag="tag" />
                    <TagDeleteModal :tag="tag" />
                </div>
            </div>
        </template>
        <template #content>
            <template v-if="! showItem">
                <template v-for="category in categories" :key="category.id">
                    <CategoryCard 
                        :can="props.canCreate"
                        :restaurant="props.restaurant"
                        :tags="props.tags"
                        :category="category"/>
                </template>
            </template>
            <template v-else>
                <div class="flex justify-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-text="props.currentCategory.name"></h2>
                </div>
                <template v-for="item in items">
                    <ItemCard 
                        :can="props.canCreate"
                        :item="item"/>
                </template>
            </template>
        </template>
    </MobileLayout>

    <div v-show="addToCartStore.items.length > 0"
        class="fixed bottom-0 left-0 right-0 flex justify-center mb-5">
        <button @click="router.visit('/restaurants/' + props.restaurant.id + '/show-my-order')"
                v-text="'My Order' + ' (' + addToCartStore.items.length + ')'"
                class="bg-gray-600 text-white px-4 py-2 text-yellow uppercase text-xs rounded-md hover:bg-gray-700"
        ></button>
    </div>


</template>

<style scoped>

</style>
