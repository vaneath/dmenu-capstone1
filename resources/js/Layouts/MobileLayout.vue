<script setup>

const props = defineProps({
    restaurant_bg: String,
    restaurant_logo: {
        type: String,
        required: true,
    },
})

console.log(props.restaurant_bg);

</script>

<template>
    <div class="bg-gray-800">
        <div class="sm:max-w-md min-h-screen mx-auto relative">
            <div class="relative">
                <img class="bg-cover h-60 w-full text-white"
                    :src="`/storage/${restaurant_bg}`"
                    alt="">
                <img class="bg-cover bg-white absolute bottom-[20%] left-[5%] w-20 h-20 rounded-full"
                     :src="`/storage/${restaurant_logo}`" alt="">
            </div>
            <div class="relative top-[-30px] overflow-hidden w-full bg-white rounded-xl">
                <div class="mt-5 px-6">
                    <slot name="header" />
                </div>
                <div class="flex items-top space-x-3 mt-5 px-6 scrollbar-none">
                    <slot name="tag" />
                </div>
                <div class="mt-5 px-6">
                    <slot name="content" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
