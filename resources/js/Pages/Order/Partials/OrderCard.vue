<script setup>

import { capitalize } from 'vue';

const props = defineProps({
    item: Object,
});
</script>

<template>
    <div class='flex mb-4'>
        <div class='h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200'>
            <img :src="`/storage/${props.item.img_url}`"  class="h-full w-full object-cover object-center" alt="">
        </div>

        <div class='ml-4 flex flex-1 flex-col'>
            <div>
                <div class='flex-col justify-between text-base font-medium text-gray-900'>
                    <div class="flex justify-between items-center">
                        <h3 v-text="capitalize(props.item.name)"
                            class='text-yellow font-semibold text-lg'>
                        </h3>
                        <i @click="$emit('remove')" class="fa-solid fa-trash fa-lg text-red-500"></i>
                    </div>
                    <p v-text="props.item.price + ' $'"
                        class='text-sm text-gray-500'></p>
                </div>
            </div>
            <div class='flex flex-1 items-end justify-between text-sm'>
                <div class='bg-yellow px-5 py-1 rounded-full flex gap-5'>
                    <div @click="$emit('decrease')"
                        class='cursor-pointer text-sm text-white font-black text-lg'>
                        -
                    </div>
                    <span v-text="props.item.quantity" class='font-bold text-md text-white'></span>
                    <div @click="$emit('increase')"
                        class='cursor-pointer text-sm text-white font-semibold'>
                        +
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
