<script setup>
import SideBarLink from '@/Components/SideBarLink.vue';
import { useSideBarStore } from '@/Stores/SideBarStore.js';

const sideBarStore = useSideBarStore();
</script>

<template>
    <div :class="sideBarStore.sideBarOpen ? 'block' : 'hidden'" @click="sideBarStore.toggleSideBar()" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

    <div  :class="sideBarStore.sideBarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-800 lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
                <img src="/images/dmenu.png" alt="" width="30" height="30">

                <span class="mx-2 text-2xl font-semibold text-white">Dmenu</span>
            </div>
        </div>
        <nav class="mt-10">
            <slot />
        </nav>
    </div>

</template>

<style scoped>

</style>
