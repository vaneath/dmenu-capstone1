@props(['restaurant'])

<div
    x-data="{
        qrGeneratorPrefix: 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=',
        restaurantNameHeading: document.getElementById('restaurant-name-heading'),
    }"
    x-on:open-qr-code.window="document.querySelector('.qr-code-img').src = qrGeneratorPrefix + qrCodeUrl; restaurantNameHeading.innerText = qrCodeRestaurant;"
    class="fixed left-0 top-[15%] sm:top-[20%] w-full z-50"
>
    <div x-show="openQrCode" class="bg-blue max-w-[40rem] mx-10 sm:mx-auto p-10 rounded-xl grid justify-evenlyz sm:flex justify-between gap-7" @click="$dispatch('close-qr-code')">
        <div class="grid content-center sm:flex-shrink-0 text-center">
            <h2 class="font-semibold text-3xl text-white" id="restaurant-name-heading"></h2>
            <div class="mt-7">
                <h3 class="mb-3 text-sm text-gray-300 place-self-end">You can download your Qr Code here</h3>
                <div class="flex justify-evenly">
                    <x-primary-button>Close</x-primary-button>
                    <a
                        download="{{ $restaurant?->name }}-qr-code.png"
                        class="inline-flex items-center px-4 py-2 bg-yellow border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        href="{{ $restaurant?->qr_code_url }}"
                    >
                        Download</a>
                </div>
            </div>
        </div>
        <div class="mt-3  sm:block">
            <img
                class="qr-code-img"
                alt=""
{{--                src="{{ $qr_code_url }}"--}}
            >
        </div>
    </div>
</div>
<div
    class="w-full h-full fixed top-0 left-0 z-40 bg-black bg-opacity-80"
    x-show="openQrCode"
></div>
