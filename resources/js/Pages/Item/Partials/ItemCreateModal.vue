<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { router, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import Swal from 'sweetalert2';
import FileInput from '@/Components/FileInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useItemStore } from '@/Stores/ItemStore.js';

const props = defineProps({
    restaurantId: {
        type: String,
        required: true,
    },
    categoryId: {
        type: String,
        required: true,
    },
    tagId: {
        type: String,
        required: true,
    },
});

let itemStore = useItemStore();

let form = useForm({
    name: '',
    category_id: props.categoryId,
    price: '',
    img_url: '',
    description: '',
    is_available: true,
});

function submit() {
    form.post(route('items.store'), {
        onSuccess: () => {
            itemStore.showCreateModal = false;
            console.log('success');
            console.log(props.categoryId);
            router.visit('/restaurants/' + props.restaurantId + '/categories/' + props.categoryId);
        },
        onFinish: () => {
            Swal.fire({
                icon: 'success',
                color: '#fff',
                title: 'Item created successfully!',
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
    <button @click="itemStore.showCreateModal = true"
            class="mb-2 bg-gray-800 px-3 py-2 text-yellow uppercase text-xs rounded-md hover:bg-gray-700">
        New Item
    </button>


    <Modal :show="itemStore.showCreateModal" max-width="md" @close="itemStore.showCreateModal = false">
        <form @submit.prevent="submit" class="mx-10 pt-10 pb-8" enctype="multipart/form-data">
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
                    required
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
                    Create
                </PrimaryButton>
            </div>
        </form>
    </Modal>
</template>

<style scoped>

</style>
