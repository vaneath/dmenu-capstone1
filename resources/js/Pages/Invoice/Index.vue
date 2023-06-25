<script setup>
import { defineProps, ref, onMounted, onUnmounted } from 'vue';
import axios from 'axios';
import {useTableStore} from "@/Stores/TableStore.js";

const props = defineProps({
    order: {
        type: Object,
        required: true,
    },
});

let TableStore = useTableStore();

const table_no = ref(TableStore.table_no);
let payment_status = ref(props.order.payment_status);

// fetch payment status
const fetchPaymentStatus = async () => {
    try {
        const response = await axios.get(`/api/orders/${props.order.id}/payment-status`);
        payment_status.value = response.data.payment_status;
    } catch (error) {
        console.error(error);
    }
};

// start polling every 5 seconds using setInterval
const pollInterval = setInterval(fetchPaymentStatus, 2000);

fetchPaymentStatus();

// stop polling when the component is unmounted
onUnmounted(() => {
    clearInterval(pollInterval);
});


</script>

<template>
<!--    <p v-text="props.order"></p>-->
    <Head :title="`Invoice #${props.order.id}`" />

    <!-- Modal -->
    <div class="hs-overlay w-full min-h-screen overflow-x-hidden overflow-y-auto bg-gray-500">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white shadow-lg rounded-xl dark:bg-gray-800">
                <div class="relative overflow-hidden min-h-[8rem] bg-gray-900 text-center rounded-t-xl">

                    <!-- SVG Background Element -->
                    <figure class="absolute inset-x-0 bottom-0">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1920 100.1">
                            <path fill="currentColor" class="fill-white dark:fill-gray-800" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"></path>
                        </svg>
                    </figure>
                    <!-- End SVG Background Element -->
                </div>

                <div class="relative z-10 -mt-12">
                    <!-- Icon -->
                    <img class="w-20 h-20 rounded-full mx-auto" :src="`/storage/${props.order.restaurant.logo_url}`"  alt="">
                    <!-- End Icon -->
                </div>

                <!-- Body -->
                <div class="p-4 sm:p-7 overflow-y-auto">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                            Invoice from {{ props.order.restaurant.name }}
                        </h3>
                        <p v-text="`#${props.order.id}`"
                            class="text-sm text-gray-500"></p>
                    </div>

                    <!-- Grid -->
                    <div class="mt-5 sm:mt-10 grid grid-cols-3 gap-5">
                        <div>
                            <span class="block text-xs uppercase text-gray-500">Amount paid:</span>
                            <span v-text="`$${props.order.total}`" class="block text-sm font-medium text-yellow"></span>
                        </div>
                        <!-- End Col -->

                        <div>
                            <span class="block text-xs uppercase text-gray-500">Order date:</span>
                            <span v-text="props.order.created_at" class="block text-sm font-medium text-gray-800 dark:text-gray-200"></span>
                        </div>
                        <!-- End Col -->

                        <div>
                            <span class="block text-xs uppercase text-gray-500">Table No:</span>
                            <span v-text="props.order.table_no" class="block text-sm font-medium text-gray-800 dark:text-gray-200"></span>
                        </div>
                        <!-- End Col -->

                    </div>
                    <!-- End Grid -->

                    <div class="mt-5 sm:mt-10">
                        <h4 class="text-xs font-semibold uppercase text-gray-800 dark:text-gray-200">Summary</h4>

                        <ul v-for="item in props.order.order_items" class="mt-3 flex flex-col">
                            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-gray-700 dark:text-gray-200">
                                <div class="flex items-center justify-between w-full">
                                    <span>{{ `${item.name} x ${item.quantity}` }}</span>
                                    <span>{{ `$${item.amount}`}}</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-5">
                        <div class="flex justify-center items-end gap-x-2">
                            <span class="block text-xs uppercase text-gray-500">Payment status:</span>
                            <span :class="props.order.payment_status === 'paid' ? 'text-green-500' : 'text-orange-200'" class="block text-sm uppercase" v-text="payment_status"></span>
                        </div>
                        <img class="mt-3 w-32 h-32 mx-auto" :src="props.order.invoice_qr" alt="">
                    </div>

                    <!-- Button -->
<!--                    <div class="mt-5 flex justify-end gap-x-2">-->
<!--                        <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800" href="#">-->
<!--                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">-->
<!--                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>-->
<!--                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>-->
<!--                            </svg>-->
<!--                            Invoice PDF-->
<!--                        </a>-->
<!--                        <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800" href="#">-->
<!--                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">-->
<!--                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>-->
<!--                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>-->
<!--                            </svg>-->
<!--                            Print-->
<!--                        </a>-->
<!--                    </div>-->
                    <!-- End Buttons -->

                    <div class="mt-5 sm:mt-10">
                        <p class="text-sm text-gray-500">If you have any questions, please contact us at <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium" href="#">dmenu@reply.com</a> or call at <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium" href="tel:+1898345492">+855 12 234 345</a>. <a class="inline-flex items-center gap-x-1.5 text-red-600 decoration-2 hover:underline font-medium" :href="`/restaurants/${props.order.restaurant.id}/orders/${props.order.id}/reviews`">Give Feedback</a>.</p>
                    </div>
                </div>
                <!-- End Body -->
            </div>
        </div>
    </div>
    <!-- End Modal -->
</template>
