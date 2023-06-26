<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { useReviewStore } from '@/Stores/ReviewStore.js';
import NavLink from '@/Components/NavLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Swal from 'sweetalert2';

// define props
const props = defineProps({
  restaurant_id: {
    type: String,
    required: true,
  },
  restaurant: {
    type: Object,
    required: true,
  },
  order_id: {
    type: String,
    required: true,
  },
  order: {
    type: Object,
    required: true,
  },
  items: {
    type: Object,
    required: true,
  },
  go_back_uri: {
    type: String,
    required: true,
  },
});

let form = useForm({
  review: null,
});

let reviewStore = useReviewStore();

// Submit the form
function submit() {
  form.review = reviewStore.getReview();
  form.post('/restaurants/' + props.restaurant_id + '/orders/' + props.order_id + '/reviews', {
    onFinish: () => {
      Swal.fire({
        icon: 'success',
        color: '#fff',
        title: 'Review submitted!',
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
  <Head :title="`Invoice #${props.order.id}`" />

  <!-- Modal -->
  <div class="hs-overlay w-full min-h-screen overflow-x-hidden overflow-y-auto bg-gray-500">
    <div
      class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
      <div class="relative flex flex-col bg-white shadow-lg rounded-xl dark:bg-gray-800">
        <div class="relative overflow-hidden min-h-[8rem] bg-gray-900 text-center rounded-t-xl">

          <!-- SVG Background Element -->
          <figure class="absolute inset-x-0 bottom-0">
            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
              <path fill="currentColor" class="fill-white dark:fill-gray-800" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z">
              </path>
            </svg>
          </figure>
          <!-- End SVG Background Element -->
        </div>

        <div class="relative z-10 -mt-12">
          <!-- Icon -->
          <img class="w-20 h-20 rounded-full mx-auto" :src="`/storage/${restaurant.bg_img_url}`" alt="ing">
          <!-- End Icon -->
        </div>

        <!-- Body -->
        <div class="p-4 sm:p-7 overflow-y-auto">
          <div class="container mx-auto px-4 py-4 dark-mode:text-white">
            <h2 class="text-center font-semibold text-xl text-white leading-tight mb-4">Leave A Review</h2>
            <form @submit.prevent="submit" class="space-y-4">
              <div>
                <label for="overall_rating" class="text-center block text-md font-medium text-gray-300 mb-1">Overall Rating:</label>
                <div class="flex justify-center gap-2">
                  <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 1">
                    <i :class="reviewStore.review.overall_rating >= 1 ? 'fas' : 'far'"
                      class="text-yellow fa-star fa-xl"></i>
                  </span>
                  <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 2">
                    <i :class="reviewStore.review.overall_rating >= 2 ? 'fas' : 'far'"
                      class="text-yellow fa-star fa-xl"></i>
                  </span>
                  <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 3">
                    <i :class="reviewStore.review.overall_rating >= 3 ? 'fas' : 'far'"
                      class="text-yellow fa-star fa-xl"></i>
                  </span>
                  <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 4">
                    <i :class="reviewStore.review.overall_rating >= 4 ? 'fas' : 'far'"
                      class="text-yellow fa-star fa-xl"></i>
                  </span>
                  <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 5">
                    <i :class="reviewStore.review.overall_rating >= 5 ? 'fas' : 'far'"
                      class="text-yellow fa-star fa-xl"></i>
                  </span>
                </div>
                <input v-model="reviewStore.review.overall_rating" class="hidden" type="number" id="overall_rating"
                  name="overall_rating" min="1" max="5" required>
              </div>

              <div>
                <label for="comment" class="block text-sm font-medium text-gray-400">Review:</label>
                <textarea v-model="reviewStore.review.comment"
                  class="resize-none h-44 mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                  id="comment" name="comment" rows="4" cols="20" required></textarea>
              </div>

              <div class="flex justify-end">
                <PrimaryButton>
                Submit Review
              </PrimaryButton>
              </div>
            </form>
          </div>
          <div class="mt-4 flex justify-center">
            <NavLink :href="props.go_back_uri" class="text-blue-600 hover:text-blue-700 hover:underline">

              Back To Invoice
            </NavLink>
            <NavLink :href="'/restaurants/' + props.restaurant_id"
              class="ml-4 text-blue-600 hover:text-blue-700 hover:underline">

              Order more
            </NavLink>
          </div>


        </div>
        <!-- End Body -->
      </div>
    </div>
  </div>
</template>
                  
  

<style scoped></style>
  