<script setup>
import Header from '@/Partials/Header.vue';
import SideBar from '@/Partials/SideBar.vue';
import SideBarLink from '@/Components/SideBarLink.vue';

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">

            <!-- Page Content -->
            <div class="flex h-screen bg-gray-200 font-roboto">
                <SideBar>
                    <SideBarLink
                        :active="route().current('dashboard')"
                        :href="route('dashboard')"
                        icon="fa-database"
                        name="Dashboard"
                    />
                    <SideBarLink
                        :active="route().current('restaurants.index')"
                        :href="route('restaurants.index')"
                        icon="fa-utensils"
                        name="Restaurants"
                    />
                    <SideBarLink
                        :active="route().current('orders.index')"
                        :href="route('orders.index')"
                        icon="fa-bowl-food"
                        name="Orders"
                    />
                    <SideBarLink
                        :active="route().current('profile.edit')"
                        :href="route('profile.edit')"
                        icon="fa-users"
                        name="Profile"
                    />
                </SideBar>

                <div class="flex-1 flex flex-col overflow-hidden">
                    <Header />

                    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                        <div class="container mx-auto px-6 py-8">
                            <slot />
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
