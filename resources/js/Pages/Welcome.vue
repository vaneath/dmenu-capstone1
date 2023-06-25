<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Login from '@/Pages/Auth/Login.vue';
import Register from '@/Pages/Auth/Register.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    showLogin: {
        type: Boolean,
    },
    showRegister: {
        type: Boolean,
    },
})

</script>

<template>
    <Head title="Welcome" />
    <GuestLayout>
        
    </GuestLayout>
    

    <Login :show="showLogin" :can-reset-password="canResetPassword" :status="status" @close="showLogin = false" />
    <Register :show="showRegister" @close="showRegister = false" />
</template>

