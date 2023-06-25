<script setup>
import { useAddToCartStore } from '@/Stores/AddToCartStore';
import { useForm } from '@inertiajs/vue3';
import MobileLayout from '@/Layouts/MobileLayout.vue';
import OrderCard from '@/Pages/Order/Partials/OrderCard.vue';
import Swal from 'sweetalert2';
import { delay } from 'lodash';
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
let addToCartStore = useAddToCartStore();

const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
});

let form = useForm({
    table_no: '',
    restaurant_id: props.restaurant.id,
    items: null,
    total: null,
});

async function checkout() {

    // add data to form
    form.items = addToCartStore.listCartItems();
    form.total = addToCartStore.getTotal();

    form.post(route('orders.store', {restaurant: 1}), {
        onSuccess: () => {
            addToCartStore.clearCart();
            Swal.fire({
                icon: 'success',
                color: '#fff',
                title: 'Order created successfully!',
                confirmButtonText: 'Cool',
                confirmButtonColor: '#E4A11B',
                timer: 3000,
                background: '#1E2836',
            });
            delay(() => {
                addToCartStore.clearCart();
                form.reset();
            }, 3000);
        },
        replace: true
    });
}

function removeItem(item) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        color: '#fff',
        showCancelButton: true,
        confirmButtonColor: '#E4A11B',
        cancelButtonColor: '#1E2836',
        confirmButtonText: 'Yes, remove it!',
        background: '#1E2836',
    }).then((result) => {
        if (result.isConfirmed) {
            addToCartStore.removeFromCart(item);
            Swal.fire({
                icon: 'success',
                color: '#fff',
                title: 'Item removed successfully!',
                confirmButtonText: 'Cool',
                confirmButtonColor: '#E4A11B',
                timer: 3000,
                background: '#1E2836',
            });
        }
    });
}
</script>

<template>
    <MobileLayout :restaurant_logo="props.restaurant.logo_url" :restaurant_bg="props.restaurant.bg_img_url">
        <template #header>
            <div class="flex justify-between items-top">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Review Order</h2>
                <div class="mt-4 flex items-center gap-3">
                    <InputLabel>
                        <span class="text-red-500">* </span>
                        Select <span class="text-red-500">table</span>:
                    </InputLabel>
                    <select v-model="form.table_no"
                            class="mt-2 w-20 h-10 py-2 px-4 text-sm text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 hover:bg-gray-200 focus:border-blue focus:ring-blue"
                            required
                    >
                        <option value="" disabled hidden selected>Table</option>
                        <template v-for="tableNo in parseInt(props.restaurant.table_amount)">
                            <option v-text="tableNo" :value="tableNo"></option>
                        </template>
                    </select>
                </div>
            </div>
            <InputError class="text-end" :message="form.errors.table_no" />
        </template>
        <template #content>
            <template v-for="item in addToCartStore.listCartItems()" :key="item.id">
                <OrderCard
                    :item="item"
                    @increase="addToCartStore.incrementItemQuantity(item)"
                    @decrease="addToCartStore.decrementItemQuantity(item)"
                    @remove="removeItem(item)" />
                </template>
            <p class="text-right font-medium text-lg mb-5">
                Subtotal: <span class="text-gray-700 font-semibold">{{ '$' + addToCartStore.getTotal()}}</span>
            </p>
            <form v-if="addToCartStore.listCartItems().length > 0 && addToCartStore.getTotal() > 0"
                @submit.prevent="checkout"
                  class="fixed bottom-0 left-0 right-0 flex justify-center mb-5">
                <button class="bg-gray-600 text-white px-4 py-2 text-yellow uppercase text-xs rounded-md hover:bg-gray-700">
                    Checkout
                </button>
            </form>
        </template>
    </MobileLayout>
</template>
