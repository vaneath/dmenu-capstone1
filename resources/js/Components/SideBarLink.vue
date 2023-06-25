<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    active: Boolean,
    icon: String,
    name: String,
});
//
let classes = computed(() =>
    props.active
        ? props.icon + ' fa-solid fa-lg fa-bounce'
        : props.icon + ' fa-solid fa-lg'
);
</script>

<template>
    <Link
        class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-600"
        :class="active ? 'text-yellow' : ''">
        <i :class="classes"></i>
        <span class="mx-3">{{ props.name }}</span>
    </Link>
</template>

<style scoped>

</style>
