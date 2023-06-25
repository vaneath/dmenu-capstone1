<script setup>
    import { defineProps } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';

    let props = defineProps({
        error: {
            type: Object,
            required: true,
        },
        go_back_uri: {
            type: String,
            required: true,
        },
    });
</script>

<template>
    <div
        class="flex flex-col items-center justify-center h-screen bg-gray-100 dark:bg-gray-900"
    >
        <div class="flex flex-col items-center justify-center">
            <div class="flex flex-col items-center justify-center">
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-gray-100" v-text="props.error.message">
                </h2>
                <p 
                    v-if="props.error.message === 'Order already reviewed.'"
                    class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                    Thank you for your feedback.
                </p>
                <p 
                    v-else
                    class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                    Our Restaurant Always Open For You.
                </p>
            </div>
            <div class="mt-6 space-x-4">
                <Link :href="props.go_back_uri" class="px-4 py-2 font-semibold text-white bg-green-500 rounded-lg">
                    Go back
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>