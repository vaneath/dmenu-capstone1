<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { router, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { useItemStore } from '@/Stores/ItemStore.js';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FileInput from '@/Components/FileInput.vue';
import Swal from 'sweetalert2';
import {watch} from "vue";
import route from "ziggy-js/src/js/index.js";

const props = defineProps({
    item: Object,
})

let itemStore = useItemStore();

// watch(restaurantStore.showEditModal, () => {
//     router.visit(route('restaurants.index'));
// })

let form = useForm({
    name: '',
    description: '',
    price: '',
    is_available: true,
});

function update() {
    form.patch(route('items.update', props.item.id),
        {
            onSuccess: () => {
                itemStore.showEditModal = false;

                router.visit(route('items.show', props.item.id));
            },
            onFinish: () => {
                Swal.fire({
                    icon: 'success',
                    color: '#fff',
                    title: 'Item updated successfully!',
                    confirmButtonText: 'Cool',
                    confirmButtonColor: '#E4A11B',
                    timer: 3000,
                    background: '#1E2836',
                });
            },
        },
        {
            preserveScroll: true,
            data: form.data(),
        }
    );
}

</script>

<template>
    <i @click="itemStore.showEditModal = true" class="fa-solid fa-pen-to-square fa-lg text-yellow cursor-pointer"></i>

    <Modal :show="itemStore.showEditModal" max-width="md" @close="itemStore.showEditModal = false">
        <form @submit.prevent="update" class="mx-10 pt-10 pb-8" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Item Name:"/>

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
                <InputLabel for="description" value="Item Description:"/>

                <TextInput
                    id="description"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    required
                    autocomplete="description"
                />

                <InputError class="mt-2" :message="form.errors.description"/>
            </div>

            <div class="mt-4">
                <InputLabel for="price" value="Item Price:"/>

                <TextInput
                    id="price"
                    type="number"
                    step="any"
                    min="0"
                    class="mt-1 block w-full"
                    v-model="form.price"
                    required
                    autocomplete="price"
                />

                <InputError class="mt-2" :message="form.errors.price"/>
            </div>

            <div class="mt-4">
                <InputLabel for="img_url">
                    <span class="text-red-500">* </span>
                    Please upload item <span class="text-red-500">image</span>:
                </InputLabel>

                <FileInput
                    id="img_url"
                    @input="form.img_url = $event.target.files[0]"
                    class="mt-1 block w-full"
                    v-model="form.img_url"
                    autocomplete="img_url"
                />

                <InputError class="mt-2" :message="form.errors.img_url"/>
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.is_available" />
                    <span class="ml-2 text-sm text-gray-600">Is available?</span>
                </label>
            </div>

            <div class="mt-4 flex justify-end">
                <PrimaryButton>
                    Update
                </PrimaryButton>
            </div>
        </form>
    </Modal>
</template>

<style scoped>

</style>
