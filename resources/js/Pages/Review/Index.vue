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
        go_back_uri: {
            type: String,
            required: true,
        },
    });

    let reviewStore = useReviewStore();

    // submit the form
    function submit() {
        let form = useForm({
            review: reviewStore.getReview(),
        });
        form.post('/restaurants/' + props.restaurant_id + '/orders/' + props.order_id + '/reviews', {
            onFinish: () => {
                console.log('Review created successfully!');
            },
        });
    }

</script>

<template>
    <div>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Leave A Review</h2>
      <form @submit.prevent="submit">
        <label for="overall_rating">Overall Rating:</label>
        <input 
          v-model="reviewStore.review.overall_rating"
          class="border-gray-300 focus:border-blue focus:ring-blue rounded-md shadow-sm"
          type="number" id="overall_rating" name="overall_rating" min="1" max="5" required>
        <button type="submit">Submit</button>
      </form>
      <Link :href="props.go_back_uri" class="text-blue-600 hover:text-blue-700 hover:underline">Go back</Link>
    </div>
  </template>
  

  <style scoped>
  form {
    max-width: 400px;
    margin: 0 auto;
  }
  
  label {
    display: block;
    margin-bottom: 8px;
  }
  
  input,
  textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
  }
  
  button {
    background-color: #f44336;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #d32f2f;
  }
  </style>
  