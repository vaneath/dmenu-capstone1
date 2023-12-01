<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import QrModal from "@/Components/QrModal.vue";
import { Link } from "@inertiajs/vue3";

let props = defineProps({
  restaurant: {
    type: Object,
    required: true,
  },
});

let location = `#${props.restaurant.home_address}, st.${props.restaurant.street_address}, ${props.restaurant.commune} ${props.restaurant.district}, Phnom Penh, Cambodia`;
</script>

<template>
  <div
    class="relative max-w-sm bg-white pb-5 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
  >
    <Link href="#">
      <img
        class="rounded-t-lg bg-cover h-60 w-full"
        :src="`/storage/${props.restaurant.bg_img_url}`"
        alt=""
      />
    </Link>
    <div class="p-5">
      <Link :href="route('restaurants.show', props.restaurant.id)">
        <h5
          v-text="props.restaurant.name"
          class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:underline"
        ></h5>
      </Link>
      <p class="mt-3 font-normal text-gray-700 dark:text-gray-400" v-text="location"></p>
    </div>
    <div class="flex justify-between px-5">
      <div class="flex space-x-3 items-center">
        <QrModal :restaurant="props.restaurant" />
        <i class="fa-brands fa-facebook fa-lg text-white hover:text-sky-800"></i>
      </div>
      <Link :href="route('restaurants.show', props.restaurant.id)">
        <PrimaryButton> Menu </PrimaryButton>
      </Link>
    </div>
  </div>
</template>

<style scoped></style>
