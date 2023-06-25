<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router} from '@inertiajs/vue3';
import { capitalize, watch, onUnmounted, onMounted } from 'vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    orders: Array,
    user_id: String,
    restaurants: Array,
});

let orders = ref(props.orders);
let selected_restaurant = ref(null);

// function to polling to /api/orders?order_id=props.orders[0].id
const fetchOrders = async () => {
    try {
        let route = "/api/orders?user_id=" + props.user_id;
        const response = await axios.get(route);
        orders.value = response.data.orders;
        console.log(route);
    } catch (error) {
        console.error(error);
    }
}

// polling to /api/orders?order_id=props.orders[0].id
const pollInterval = setInterval(fetchOrders, 1000);

fetchOrders();

// stop polling when the component is unmounted
onUnmounted(() => {
    clearInterval(pollInterval);
});

// watch(props.orders.length, () =>{
//     router.get(route('orders.index'));
// }, {deep: true});

</script>

<template>
    <Head title="Orders" />

    <AuthenticatedLayout>

        <p v-text="selected_restaurant"></p>

        <div class="relative overflow-x-auto sm:rounded-lg">
            <div>
                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-gray-700" type="button">
                    <svg class="w-4 h-4 mr-2 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    Last 30 days
                    <svg class="w-3 h-3 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- filter by restaurant -->
                <div>
                    <select id="filter-by-restaurant" v-model="selected_restaurant" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-gray-700" type="button">
                        <!-- place holder text All -->
                        <option value="" selected>All</option>
                        <template v-for="restaurant in props.restaurants">
                        <option v-text="restaurant.name" :value="restaurant.id"></option>
                        </template>
                    </select>
                </div>


                <!-- Dropdown menu -->
                <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-1" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-1" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last day</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded dark:hover:bg-gray-600">
                                <input checked="" id="filter-radio-example-2" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-2" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last 7 days</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
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
                <tbody v-for="order in orders">
                  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"  v-if="order.restaurant_id === selected_restaurant || selected_restaurant === null || selected_restaurant === ''">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" v-text="order.order_at" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>

</style>
