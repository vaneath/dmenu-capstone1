<script setup>
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
    users: Array
});

</script>

<template>
    <SuperAdminLayout>
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 justify-items-center">
            <template v-for="user in props.users">
                <div
                    class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col items-center py-7">
                        <img class="w-20 h-20"
                             :src="`https://api.multiavatar.com/${user.id}.png?apiKey=HyN9v0JeFp2imV`"
                             alt="">
                        <h5 class="my-2 text-xl font-medium text-gray-900 dark:text-white" v-text="user.name"></h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400" v-text="`${user.restaurants.length} restaurant(s)`"></span>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <PrimaryButton>Edit</PrimaryButton>
                            <DangerButton>Delete</DangerButton>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </SuperAdminLayout>
</template>

<style scoped>

</style>
