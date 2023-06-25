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
import { useCategoryStore } from '@/Stores/CategoryStore.js';

const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
    tags: {
        type: Array,
        required: true,
    },
});

let categoryStore = useCategoryStore();

let form = useForm({
    name: '',
    bg_img_url: '',
    restaurant_id: props.restaurant.id,
    tag_id: '',
    is_available: true,
});

function submit() {
    form.post(route('categories.store'), {
        onSuccess: () => {
            categoryStore.showCreateModal = false;

            router.visit('/restaurants/' + props.restaurant.id + '?tag=' + form.tag_id);
        },
        onFinish: () => {
            Swal.fire({
                icon: 'success',
                color: '#fff',
                title: 'Category created successfully!',
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
    <button @click="categoryStore.showCreateModal = true"
        class="mb-2 bg-gray-800 px-3 py-2 text-yellow uppercase text-xs rounded-md hover:bg-gray-700">
        New Category
    </button>


    <Modal :show="categoryStore.showCreateModal" max-width="md" @close="categoryStore.showCreateModal = false">
        <form @submit.prevent="submit" class="mx-10 pt-10 pb-8" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Category Name:"/>

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
                <InputLabel for="bg_img_url">
                    <span class="text-red-500">* </span>
                    Please upload category <span class="text-red-500">image</span>:
                </InputLabel>

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

            <div class="mt-4 relative">
                <InputLabel>
                    <span class="text-red-500">* </span>
                    Please select <span class="text-red-500">tags</span>:
                </InputLabel>
                <select v-model="form.tag_id"
                    class="mt-2 w-full h-10 py-2 px-4 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 hover:bg-gray-200 focus:border-blue focus:ring-blue">
                    <option value="" disabled hidden selected>Select your tag</option>
                    <template v-for="tag in tags">
                        <option v-text="tag.name" :value="tag.id"></option>
                    </template>
                </select>
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
