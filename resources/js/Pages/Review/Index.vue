<script setup>
    import { defineProps } from 'vue';
    import { useForm } from '@inertiajs/inertia-vue3';
    import { useReviewStore } from '@/Stores/ReviewStore.js';
    import { Link } from '@inertiajs/inertia-vue3';

    // define props
    const props = defineProps({
        restaurant_id: {
            type: String,
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
                console.log('Review created successfully!');
                // history.back();
            },
        });
    }
</script>

<template>
  <div class="container mx-auto px-4 py-4 dark-mode:text-white">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Leave A Review</h2>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
    <label for="overall_rating" class="block text-sm font-medium text-gray-700 mb-1">Overall Rating:</label>
    <div class="flex">
      <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 1">
        <i :class="reviewStore.review.overall_rating >= 1 ? 'fas' : 'far' " class="text-yellow-300 fa-star"></i>
      </span>
      <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 2">
        <i :class="reviewStore.review.overall_rating >= 2 ? 'fas' : 'far' " class="text-yellow-300 fa-star"></i>
      </span>
      <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 3">
        <i :class="reviewStore.review.overall_rating >= 3 ? 'fas' : 'far' " class="text-yellow-300 fa-star"></i>
      </span>
      <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 4">
        <i :class="reviewStore.review.overall_rating >= 4 ? 'fas' : 'far' " class="text-yellow-300 fa-star"></i>
      </span>
      <span class="cursor-pointer" @click="reviewStore.review.overall_rating = 5">
        <i :class="reviewStore.review.overall_rating >= 5 ? 'fas' : 'far' " class="text-yellow-300 fa-star"></i>
      </span>
    </div>
    <input
      v-model="reviewStore.review.overall_rating"
      class="hidden"
      type="number" id="overall_rating" name="overall_rating" min="1" max="5" required>
  </div>

      <div>
        <label for="comment" class="block text-sm font-medium text-gray-700">Comment:</label>
        <textarea
          v-model="reviewStore.review.comment"
          class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
          id="comment" name="comment" rows="4" cols="50" required></textarea>
      </div>
      
      <button type="submit">
        Submit Review
      </button>
    </form>
  </div>
  <div class="mt-4">
      <Link :href="props.go_back_uri" class="text-blue-600 hover:text-blue-700 hover:underline">Back To Invoice</Link>
      <Link :href="'/restaurants/' + props.restaurant_id" class="ml-4 text-blue-600 hover:text-blue-700 hover:underline">Order More</Link>
  </div>
</template>
                  
  

  <style scoped>
  </style>
  