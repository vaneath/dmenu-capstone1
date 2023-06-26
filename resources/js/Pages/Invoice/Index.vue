<script setup>
import { defineProps, ref, onMounted, onUnmounted, watch } from 'vue';
import axios from 'axios';
import {useTableStore} from "@/Stores/TableStore.js";
import Swal from 'sweetalert2';

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

watch(payment_status, () => {
    if (payment_status.value === 'paid') {
        Swal.fire({
            icon: 'success',
            color: '#fff',
            title: 'Payment received!',
            confirmButtonText: 'Cool',
            confirmButtonColor: '#E4A11B',
            timer: 3000,
            background: '#1E2836',
        });
    }
});

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
                            <span :class="payment_status === 'paid' ? 'text-green-500' : 'text-orange-200'" class="block text-sm uppercase" v-text="payment_status"></span>
                        </div>
                        <img class="mt-3 w-32 h-32 mx-auto" :src="props.order.invoice_qr" alt="">
                    </div>

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
