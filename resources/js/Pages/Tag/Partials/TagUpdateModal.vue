<template>
    <i @click="tagStore.showEditModal = true" class="fa-solid fa-pen fa-xs text-white"></i>

    <Modal :show="tagStore.showEditModal" max-width="md" @close="closeModal()">
        <form @submit.prevent="update" class="mx-10 pt-10 pb-8" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Tag Name:"/>

                <TextInput
                    id="name"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.name"/>
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

<script setup>
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import {useTagStore} from "@/Stores/TagStore.js";
import route from "ziggy-js/src/js/index.js";

const props = defineProps({
    tag: {
        type: Object,
        required: true,
    },
});

let tagStore = useTagStore();

let form = useForm({
    id: props.tag.id,
    name: props.tag.name,
    is_available: props.tag.is_available,
});

function closeModal() {
    tagStore.showEditModal = false;
    form.reset()
}

function update() {
    form.patch(route('tags.update', props.tag.id), {
        preserveScroll: true,

        onSuccess: () => {
            closeModal();
        },
    });
}


</script>

<style scoped>

</style>
