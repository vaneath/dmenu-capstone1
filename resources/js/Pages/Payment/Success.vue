<script setup></script>
<template>
    <div
        class="flex flex-col items-center justify-center h-screen bg-gray-100 dark:bg-gray-900"
    >
        <div class="flex flex-col items-center justify-center">
            <div class="flex flex-col items-center justify-center">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-16 h-16 text-green-500 dark:text-green-300"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                    Payment Successful
                </h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                    Thank you for your purchase.
                </p>
            </div>
            <div class="mt-6 space-x-4">
                <button class="px-4 py-2 font-semibold text-white bg-green-500 rounded-lg">
                    Download Invoice
                </button>
                <button class="px-4 py-2 font-semibold text-white bg-orange-500 rounded-lg">
                    Order More
                </button>
            </div>
        </div>
    </div>
</template>