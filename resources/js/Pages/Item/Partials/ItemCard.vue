<script setup>
import { useAddToCartStore } from '@/Stores/AddToCartStore';
import ItemDeleteModal from './ItemDeleteModal.vue';
import ItemUpdateModal from './ItemUpdateModal.vue';

let addToCartStore = useAddToCartStore();

const props = defineProps({
    can: {
        type: Boolean,
        required: true,
    },
    item: {
        type: Object,
        required: true,
    },

});

</script>
<template>
    <div class="w-full mx-auto max-w-sm mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
        <div 
            v-if="props.can"
            class="absolute top-0 right-0 flex space-x-4 items-center px-6 py-2 bg-gray-900 rounded-lg z-10 mt-3 mr-3 aspect-w-2 aspect-h-1"
            @click.stop>
            <ItemUpdateModal :item="props.item" />
            <ItemDeleteModal :item="props.item" />
        </div>
        <img class="rounded-t-lg" :src="`/storage/${props.item.img_url}`" alt="product image" />
        <div class="mt-4 px-5 pb-5">
            <h5 v-text="props.item.name"
                class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"></h5>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white" v-text="'$' + props.item.price"></span>
                <button
                    @click="addToCartStore.items.find(item => item.id === props.item.id) ? addToCartStore.removeFromCart(props.item) : addToCartStore.addToCart(props.item)"
                    v-text="addToCartStore.items.find(item => item.id === props.item.id) ? 'Remove Item' : 'Add to cart'"
                    :class="addToCartStore.items.find(item => item.id === props.item.id) ? 'bg-red-500' : 'bg-yellow'"
                    class="text-white bg-yellow hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    ></button>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
