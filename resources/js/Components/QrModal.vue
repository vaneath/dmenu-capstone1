<script setup>
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    restaurant: {
        type: Object,
        required: true,
    },
});

let show = ref(false);

</script>

<template>
    <button @click="show = true">
        <i class="fa-solid fa-qrcode fa-lg text-white hover:text-yellow"></i>
    </button>

    <Modal :show="show" @close="show = false" max-width="sm">
        <div class="bg-gray-800 py-10 text-center">
            <h2 class="text-2xl font-bold text-white">QR Code</h2>
            <img class="mx-auto rounded-lg" :src="props.restaurant.qr_code_url" alt="">

            <div class="mt-6">
                <SecondaryButton @click="show = false">
                    Close
                </SecondaryButton>

                <Link href="#" download>
                    <PrimaryButton
                        class="ml-3"
                    >
                        Download
                    </PrimaryButton>
                </Link>
            </div>
        </div>
    </Modal>
</template>

<style scoped>

</style>
