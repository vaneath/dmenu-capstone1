<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useTagStore } from "@/Stores/TagStore.js";
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import route from "ziggy-js/src/js/index.js";

const props = defineProps({
  restaurant: {
    type: Object,
    required: true,
  },
});

let tagStore = useTagStore();

let form = useForm({
  name: "",
  restaurant_id: props.restaurant.id,
  is_available: true,
});

function submit() {
  form.post(route("tags.store"), {
    onSuccess: () => {
      tagStore.showCreateModal = false;

      form.reset();
    },
    onFinish: () => {
      Swal.fire({
        icon: "success",
        color: "#fff",
        title: "Tag created successfully!",
        confirmButtonText: "Cool",
        confirmButtonColor: "#E4A11B",
        timer: 3000,
        background: "#1E2836",
      });
    },
    preserveScroll: true,
  });
}
</script>

<template>
  <button
    @click="tagStore.showCreateModal = true"
    class="flex justify-center items-center w-7 h-7 px-3 bg-gray-800 text-yellow rounded-xl hover:bg-gray-700"
  >
    <i class="fa-sharp fa-solid fa-plus fa-lg"></i>
  </button>

  <Modal
    :show="tagStore.showCreateModal"
    max-width="md"
    @close="tagStore.showCreateModal = false"
  >
    <form @submit.prevent="submit" class="mx-10 pt-10 pb-8" enctype="multipart/form-data">
      <div>
        <InputLabel for="name" value="Tag Name:" />

        <TextInput
          id="name"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
        />

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox name="remember" v-model:checked="form.is_available" />
          <span class="ml-2 text-sm text-gray-600">Is available?</span>
        </label>
      </div>

      <div class="mt-4 flex justify-end">
        <PrimaryButton> Create </PrimaryButton>
      </div>
    </form>
  </Modal>
</template>

<style scoped></style>
