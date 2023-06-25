<script setup>
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';

let show = ref(false);
</script>

<template>
    <nav class="w-full h-16 px-20 py-2 flex justify-between bg-gray-800 shadow-sm shadow-blue">
        <div class="flex space-x-8">
            <NavLink :active="route().current('welcome')" href="/">Home</NavLink>
            <NavLink :active="false" href="/">About</NavLink>
            <NavLink :active="false" href="/">Features</NavLink>
            <NavLink :active="false" href="/">Team</NavLink>
        </div>
        <div class="flex space-x-4">
            <img src="/images/dmenu.png">
        </div>
        <div class="flex space-x-8">
            <NavLink :active="route().current('login')" :href="route('login')">Login</NavLink>
            <NavLink :active="route().current('register')" :href="route('register')">Register</NavLink>
        </div>
    </nav>
</template>

<style scoped>

</style>
