<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { router, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { useRestaurantStore } from '@/Stores/RestaurantStore.js';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FileInput from '@/Components/FileInput.vue';
import Swal from 'sweetalert2';
import route from "ziggy-js/src/js/index.js";

let restaurantStore = useRestaurantStore();

let form = useForm({
    name: '',
    table_amount: '',
    bg_img_url: '',
    logo_url: '',
    khqr_url: '',
    home_address: '',
    street_address: '',
    commune: '',
    district: '',
});

function submit() {
    form.post(route('restaurants.store'), {
        onSuccess: () => {
            restaurantStore.showCreateModal = false;

            router.visit(route('restaurants.index'));
        },
        onFinish: () => {
            Swal.fire({
                icon: 'success',
                color: '#fff',
                title: 'Restaurant created successfully!',
                confirmButtonText: 'Cool',
                confirmButtonColor: '#E4A11B',
                timer: 3000,
                background: '#1E2836',
            });
        },
    });
}

</script>

<template>
    <PrimaryButton class="hidden sm:inline"
                   @click="restaurantStore.showCreateModal = true">
        Create Restaurant
    </PrimaryButton>

    <PrimaryButton class="sm:hidden"
                   @click="restaurantStore.showCreateModal = true">
        Create
    </PrimaryButton>

    <Modal :show="restaurantStore.showCreateModal" max-width="2xl" @close="restaurantStore.showCreateModal = false">
        <form @submit.prevent="submit" class="mx-10 pt-10 pb-8" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Restaurant Name:"/>

                <TextInput
                    id="name"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name"/>
            </div>

            <div class="mt-4">
                <InputLabel for="table_amount" value="Amount of table:"/>

                <TextInput
                    id="table_amount"
                    min="0"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.table_amount"
                    required
                    autocomplete="table_amount"
                />

                <InputError class="mt-2" :message="form.errors.table_amount"/>
            </div>

            <div class="mt-4">
                <InputLabel for="bg_img_url" value="Background Image:"/>

                <FileInput
                    id="bg_img_url"
                    @input="form.bg_img_url = $event.target.files[0]"
                    class="mt-1 block w-full"
                    v-model="form.bg_img_url"
                    required
                    autocomplete="bg_img_url"
                />

                <InputError class="mt-2" :message="form.errors.bg_img_url"/>
            </div>

            <div class="mt-4">
                <InputLabel for="logo_url" value="Restaurant Logo:"/>

                <FileInput
                    id="logo_url"
                    @input="form.logo_url = $event.target.files[0]"
                    class="mt-1 block w-full"
                    v-model="form.logo_url"
                    required
                    autocomplete="logo_url"
                />

                <InputError class="mt-2" :message="form.errors.logo_url"/>
            </div>

            <div class="mt-4">
                <InputLabel for="khqr_url">
                    <span class="text-red-500">* </span>
                    Please upload your <span class="text-red-500">KHQR</span> for this restaurant:
                </InputLabel>

                <FileInput
                    id="khqr_url"
                    @input="form.khqr_url = $event.target.files[0]"
                    class="mt-1 block w-full"
                    v-model="form.khqr_url"
                    required
                    autocomplete="khqr_url"
                />

                <InputError class="mt-2" :message="form.errors.khqr_url"/>
            </div>

            <div class="flex gap-5">
                <div class="grow mt-4">
                    <InputLabel for="home_address" value="Home Address:"/>

                    <TextInput
                        id="home_address"
                        class="mt-1 block w-full"
                        v-model="form.home_address"
                        required
                        autocomplete="home_address"
                    />

                    <InputError class="mt-2" :message="form.errors.home_address"/>
                </div>

                <div class="grow mt-4">
                    <InputLabel for="street_address" value="Street Address:"/>

                    <TextInput
                        id="street_address"
                        class="mt-1 block w-full"
                        v-model="form.street_address"
                        required
                        autocomplete="street_address"
                    />

                    <InputError class="mt-2" :message="form.errors.street_address"/>
                </div>
            </div>

            <div class="flex gap-5">
                <div class="grow mt-4">
                    <InputLabel for="commune" value="Commune(ឃុំ):"/>

                    <TextInput
                        id="commune"
                        class="mt-1 block w-full"
                        v-model="form.commune"
                        required
                        autocomplete="commune"
                    />

                    <InputError class="mt-2" :message="form.errors.commune"/>
                </div>

                <div class="grow mt-4">
                    <InputLabel for="district" value="District(សង្កាត់):"/>

                    <TextInput
                        id="district"
                        class="mt-1 block w-full"
                        v-model="form.district"
                        required
                        autocomplete="district"
                    />

                    <InputError class="mt-2" :message="form.errors.district"/>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <PrimaryButton>
                    Create
                </PrimaryButton>
            </div>
        </form>
    </Modal>
</template>

<style scoped>

</style>
