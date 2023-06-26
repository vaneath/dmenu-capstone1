<script setup>
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';

let show = ref(false);
</script>

<template>
    <nav class="w-full h-24 mt-0 px-20 flex justify-between items-center bg-gray-800 shadow-sm shadow-blue">
            <NavLink href="/">
                <img class="w- h-20" src="/images/dmenu.png">
            </NavLink>
        <div class="flex items-cen space-x-8">
            <NavLink :active="route().current('login')" :href="route('login')">Login</NavLink>
            <NavLink :active="route().current('register')" :href="route('register')">Register</NavLink>
        </div>
    </nav>
</template>

<style scoped>

</style>
