<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onUnmounted, onMounted, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

let props = defineProps({
    reviews: {
        type: Array,
        required: true,
    },
    user_id: {
        type: String,
        required: true,
    },
    restaurants: {
        type: Array,
        required: true,
    },
});

let reviews = ref(props.reviews);
let selected_restaurant = ref(null);

// polling 1 second
const fetchReviews = async () => {
    try {
        const response = await axios.get('/api/reviews' + props.user_id);
        reviews.value = response.data.reviews;
    } catch (error) {
        console.error(error);
    }
}

// start polling every 1 seconds using setInterval
const pollInterval = setInterval(fetchReviews, 1000);

fetchReviews();

// stop polling when the component is unmounted
onUnmounted(() => {
    clearInterval(pollInterval);
});

</script>

<template>
  <Head title="Review" />

  <AuthenticatedLayout>

      <div>
          <select id="filter-by-restaurant" v-model="selected_restaurant" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-gray-700" type="button">
              <option value="" selected>All</option>
              <template v-for="restaurant in props.restaurants">
              <option v-text="restaurant.name" :value="restaurant.id"></option>
              </template>
          </select>
      </div>

      <div class="relative overflow-x-auto sm:rounded-lg">
          <table class="w-full mt-7 text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="p-4">
                      <div class="flex items-center">
                          <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                          <label for="checkbox-all-search" class="sr-only">checkbox</label>
                      </div>
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Review Date
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Restaurant
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Overall Rating
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Comment
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Reviewed On
                  </th>
              </tr>
              </thead>
              <tbody v-for="review in reviews">
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-if="review.restaurant_id === selected_restaurant || selected_restaurant === null || selected_restaurant === ''">
                  <td class="w-4 p-4">
                      <div class="flex items-center">
                          <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                          <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                      </div>
                  </td>
                  <th scope="row" v-text="review.created_at" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  </th>
                  <td v-text="review.restaurant.name" class="px-6 py-4">
                  </td>
                  <td v-text="review.overall_rating" class="px-6 py-4">
                  </td>
                  <td v-text="review.comment" class="px-6 py-4">
                  </td>
                  <td class="px-6 py-4">
                      <Link :href="route('orders.show', review.order.id)" class="font-medium text-yellow dark:text-blue-500 hover:underline">Invoice</Link>
                  </td>
              </tr>
              </tbody>
          </table>
      </div>

  </AuthenticatedLayout>

</template>

    
