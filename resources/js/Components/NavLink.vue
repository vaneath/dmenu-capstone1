<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 py-2 border-y-4 text-yellow border-yellow font-medium leading-5 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 py-2 font-medium text-gray-400 leading-5 hover:text-yellow hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
