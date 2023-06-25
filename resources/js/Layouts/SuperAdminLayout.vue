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
                        :active="route().current('superadmin.index')"
                        :href="route('superadmin.index')"
                        icon="fa-database"
                        name="Dashboard"
                    />
                    <SideBarLink
                        :active="route().current('superadmin.users')"
                        :href="route('superadmin.users')"
                        icon="fa-users"
                        name="Users"
                    />
                    <SideBarLink
                        :active="route().current('superadmin.restaurants')"
                        :href="route('superadmin.restaurants')"
                        icon="fa-utensils"
                        name="Restaurants"
                    />
                    <SideBarLink
                        :active="route().current('superadmin.orders')"
                        :href="route('superadmin.orders')"
                        icon="fa-bowl-food"
                        name="Orders"
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
