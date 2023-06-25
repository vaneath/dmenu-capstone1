<script setup>
import SuperAdminLayout from '@/Layouts/SuperAdminLayout.vue';
import {capitalize, defineProps} from 'vue';
import { onUnmounted } from 'vue';
import {Link} from "@inertiajs/vue3";

// define the props
const props = defineProps({
  user_id: {
    type: String,
    required: true,
  },
    users: {
        type: Array,
        required: true,
    },
    restaurants: {
        type: Array,
        required: true,
    },
    orders: {
        type: Array,
        required: true,
    },
    allOrders: {
        type: String,
        required: true,
    },
});

import { ref } from 'vue';
import axios from 'axios';
import DashboardCard from "@/Pages/Dashboard/Partials/DashboardCard.vue";
import route from "ziggy-js/src/js/index.js";
import QrModal from "@/Components/QrModal.vue";

const userId = props.user_id; // get the user id from the props
const statistics = ref(null); // initialize the statistics data
const isLoading = ref(true); // initialize the loading state

// define the function to fetch the statistics
const fetchStatistics = async () => {
  try {
    const response = await axios.get(`/api/users/${userId}/statistics`);
    statistics.value = response.data.statistics;
  } catch (error) {
    console.error(error);
  } finally {
    isLoading.value = false; // set loading state to false after fetch completes
  }
};

// start polling every 5 seconds using setInterval
const pollInterval = setInterval(fetchStatistics, 1000);

fetchStatistics();

// stop polling when the component is unmounted
onUnmounted(() => {
  clearInterval(pollInterval);
});
</script>

<template>
  <Head title="Dashboard" />



  <SuperAdminLayout v-if="isLoading"></SuperAdminLayout>

  <SuperAdminLayout v-if="!isLoading">
          <h2 class="text-lg font-bold">All Restaurant</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 mt-3 gap-3">
              <div class="w-full">
                  <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                      <div class="p-3 rounded-full bg-blue bg-opacity-75">
                          <svg fill="#ffffff" height="30px" width="30px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 480.008 480.008" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M456.004,0.004h-136c-4.4,0-8,3.6-8,8s3.6,8,8,8h136c4.4,0,8,3.6,8,8v8h-120c-4.4,0-8,3.6-8,8s3.6,8,8,8h120v56h-104 c-4.4,0-8,3.6-8,8c0,4.4,3.6,8,8,8h104v8c0,4.4-3.6,8-8,8h-104c-4.4,0-8,3.6-8,8c0,4.4,3.6,8,8,8h98.2l10.7,32h-4.9h-177.7 c33.9-14.8,57.7-48.7,57.7-88c0-52.9-43.1-96-96-96c-52.9,0-96,43.1-96,96c0,39.3,23.8,73.2,57.7,88h-177.7h-4.9l10.7-32h106.2 c4.4,0,8-3.6,8-8c0-4.4-3.6-8-8-8h-112c-4.4,0-8-3.6-8-8v-8h104c4.4,0,8-3.6,8-8c0-4.4-3.6-8-8-8h-104v-56h120c4.4,0,8-3.6,8-8 s-3.6-8-8-8h-120v-8c0-4.4,3.6-8,8-8h144c4.4,0,8-3.6,8-8s-3.6-8-8-8h-144c-13.2,0-24,10.8-24,24v16v72v16 c0,9.5,5.6,17.7,13.7,21.6l-13.3,39.9c-0.8,2.4-0.4,5.1,1.1,7.2c1.5,2.1,3.9,3.3,6.5,3.3h8v233.5c-9.3,3.3-16,12.1-16,22.5v16 c0,4.4,3.6,8,8,8h464c4.4,0,8-3.6,8-8v-16c0-10.4-6.7-19.2-16-22.5v-233.5h8c2.6,0,5-1.2,6.5-3.3c1.5-2.1,1.9-4.8,1.1-7.2 l-13.3-39.9c8.1-3.9,13.7-12.1,13.7-21.6v-16v-72v-16C480.004,10.804,469.204,0.004,456.004,0.004z M160.004,96.004 c0-44.1,35.9-80,80-80c44.1,0,80,35.9,80,80s-35.9,80-80,80C195.904,176.004,160.004,140.104,160.004,96.004z M32.004,200.004h416 v232h-160v-56v-32v-120c0-4.4-3.6-8-8-8h-80c-4.4,0-8,3.6-8,8v120v32v56h-160V200.004z M208.004,368.004v-16h64v16H208.004z M272.004,384.004v48h-64v-48H272.004z M208.004,336.004v-104h64v104H208.004z M464.004,464.004h-448v-8c0-4.4,3.6-8,8-8h176h80 h176c4.4,0,8,3.6,8,8V464.004z"></path> </g> </g> <g> <g> <path d="M168.004,216.004h-112c-4.4,0-8,3.6-8,8v144v32c0,4.4,3.6,8,8,8h112c4.4,0,8-3.6,8-8v-32v-144 C176.004,219.604,172.404,216.004,168.004,216.004z M160.004,392.004h-96v-16h96V392.004z M160.004,360.004h-96v-128h40v33.1 c-13.8,3.6-24,16-24,30.9c0,4.4,3.6,8,8,8h48c4.4,0,8-3.6,8-8c0-14.9-10.2-27.3-24-30.9v-33.1h40V360.004z M112.004,280.004 c5.9,0,11.1,3.2,13.8,8h-27.7C100.904,283.204,106.104,280.004,112.004,280.004z"></path> </g> </g> <g> <g> <path d="M424.004,216.004h-112c-4.4,0-8,3.6-8,8v144v32c0,4.4,3.6,8,8,8h112c4.4,0,8-3.6,8-8v-32v-144 C432.004,219.604,428.404,216.004,424.004,216.004z M416.004,392.004h-96v-16h96V392.004z M416.004,360.004h-96v-128h40v33.1 c-13.8,3.6-24,16-24,30.9c0,4.4,3.6,8,8,8h48c4.4,0,8-3.6,8-8c0-14.9-10.2-27.3-24-30.9v-33.1h40V360.004z M368.004,280.004 c5.9,0,11.1,3.2,13.8,8h-27.7C356.904,283.204,362.104,280.004,368.004,280.004z"></path> </g> </g> <g> <g> <path d="M279.404,64.804c-3.4-18.6-19.8-32.8-39.4-32.8c-19.6,0-36,14.2-39.4,32.8c-14.1,3.3-24.6,16-24.6,31.2 c0,14.9,10.2,27.4,24,31v25c0,4.4,3.6,8,8,8h64c4.4,0,8-3.6,8-8v-25c13.8-3.6,24-16.1,24-31 C304.004,80.904,293.504,68.204,279.404,64.804z M272.004,112.004c-4.4,0-8,3.6-8,8v24h-48v-24c0-4.4-3.6-8-8-8 c-8.8,0-16-7.2-16-16c0-8.3,6.3-15,14.4-15.8c10.3,5.3,10,12.9,9.8,14.5c-0.8,4.3,2.1,8.4,6.4,9.2c0.5,0.1,1,0.1,1.5,0.1 c3.8,0,7.1-2.7,7.8-6.5c1.3-6.8-0.7-20.9-15.4-30c2.1-11.1,11.8-19.5,23.5-19.5c13.2,0,24,10.8,24,24c0,4.4,3.6,8,8,8 c8.8,0,16,7.2,16,16S280.804,112.004,272.004,112.004z"></path> </g> </g> </g></svg>
                      </div>

                      <div class="mx-5">
                          <h4 class="text-2xl font-semibold text-gray-700" v-text="statistics.total_restaurants"></h4>
                          <div class="text-gray-500">Total Restaurants</div>
                      </div>
                  </div>
              </div>
              <div class="w-full">
                  <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                      <div class="p-3 rounded-full bg-yellow bg-opacity-75">
                          <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none"
                               xmlns="http://www.w3.org/2000/svg">
                              <path d="M6.99998 11.2H21L22.4 23.8H5.59998L6.99998 11.2Z" fill="currentColor"
                                    stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                              <path
                                  d="M9.79999 8.4C9.79999 6.08041 11.6804 4.2 14 4.2C16.3196 4.2 18.2 6.08041 18.2 8.4V12.6C18.2 14.9197 16.3196 16.8 14 16.8C11.6804 16.8 9.79999 14.9197 9.79999 12.6V8.4Z"
                                  stroke="currentColor" stroke-width="2"/>
                          </svg>
                      </div>

                      <div class="mx-5">
                          <h4 class="text-2xl font-semibold text-gray-700" v-text="props.allOrders"></h4>
                          <div class="text-gray-500">Total Orders</div>
                      </div>
                  </div>
              </div>
              <div class="w-full">
                  <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
                      <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                          <svg class="h-8 w-8 text-white" viewBox="0 0 28 30" fill="none"
                               xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                  fill="currentColor"/>
                              <path
                                  d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                  fill="currentColor"/>
                              <path
                                  d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                  fill="currentColor"/>
                              <path
                                  d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                  fill="currentColor"/>
                              <path
                                  d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                  fill="currentColor"/>
                              <path
                                  d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                  fill="currentColor"/>
                          </svg>
                      </div>

                      <div class="mx-5">
                          <h4 class="text-2xl font-semibold text-gray-700" v-text="statistics.total_restaurant_owners"></h4>
                          <div class="text-gray-500">Total Users</div>
                      </div>
                  </div>
              </div>
          </div>

          <h2 class="text-lg font-bold mt-5">Active Restaurant</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 gap-5">
              <template v-for="restaurant in statistics.most_ordered_restaurant" :key="restaurant.id">
                  <div class="flex-col px-6 py-4 w-60 gap-3 bg-gray-700 rounded-md">
                      <div class="flex-col items-center justify-evenly">
                          <img class="mx-auto w-20 h-20"
                               :src="`https://api.multiavatar.com/${restaurant.id}.png?apiKey=HyN9v0JeFp2imV`"
                               alt="">
                          <div class="mt-3 flex justify-center items-center gap-3">
                              <p class="font-bold text-xl text-white text-center" v-text="restaurant.name"></p>
                              <QrModal :restaurant="restaurant" />
                          </div>
                      </div>
                      <div class="mt-3 flex justify-between">
                          <p class="text-gray-300 text-base" v-text="`${restaurant.table_amount} tables`"></p>
                          <p class="text-gray-300 text-base" v-text="`${restaurant.orders_count} orders`"></p>
                      </div>
                      <p></p>
                  </div>
              </template>
          </div>

          <h2 class="text-lg font-bold mt-8">Best Sale Food</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-5">
              <template v-for="item in statistics.most_ordered_item">
                  <div class="mx-auto flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                      <img class="object-cover w-full rounded-lg h-96 md:h-auto md:w-48" :src="`/storage/${item.img_url}`" alt="">
                      <div class="flex flex-col justify-between p-4 leading-normal">
                          <div class="flex justify-between items-center">
                              <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white" v-text="capitalize(item.name)"></h5>
                              <p class="text-yellow" v-text="`$${item.price}`"></p>
                          </div>
                          <p class="text-gray-400 text-sm text-medium">
                               {{ item.order_items_count }} orders from <Link :href="route('restaurants.show', item.category.restaurant.id)" class="text-yellow hover:underline">{{item.category.restaurant.name }}</Link>
                          </p>
                          <p class="my-3 font-normal text-gray-700 dark:text-gray-400" v-text="item.description"></p>
                      </div>
                  </div>
              </template>
          </div>

          <h2 class="text-lg font-bold mt-8">Recent Order</h2>
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
                      Order Date
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Restaurant
                  </th>
                  <th scope="col" class="px-6 py-3">
                      item
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Price
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Status
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Action
                  </th>
              </tr>
              </thead>
              <tbody v-for="order in props.orders">
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="w-4 p-4">
                      <div class="flex items-center">
                          <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                          <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                      </div>
                  </td>
                  <th scope="row" v-text="order.created_at" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  </th>
                  <td v-text="order.restaurant.name" class="px-6 py-4">
                  </td>
                  <td v-text="order.order_items.length" class="px-6 py-4">
                  </td>
                  <td v-text="`$${order.total}`" class="px-6 py-4">
                  </td>
                  <td v-text="capitalize(order.payment_status)" :class="order.payment_status === 'paid' ? 'text-green-500' : 'text-orange-200'" class="px-6 py-4">
                  </td>
                  <td class="px-6 py-4">
                      <Link :href="route('orders.show', order.id)" class="font-medium text-yellow dark:text-blue-500 hover:underline">View Invoice</Link>
                  </td>
              </tr>
              </tbody>
          </table>
  </SuperAdminLayout>

</template>
