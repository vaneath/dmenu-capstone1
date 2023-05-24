
<div
    x-data="{
        qrGeneratorPrefix: 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=',
    }"
    x-on:open-qr-code.window="document.querySelector('.qr-code-img').src = qrGeneratorPrefix + qrCodeUrl;"
    class="fixed left-0 top-[15%] sm:top-[20%] w-full z-50"
>
    <div x-show="openQrCode" class="bg-blue max-w-[40rem] mx-10 sm:mx-auto p-10 rounded-xl grid justify-evenlyz sm:flex justify-between gap-7" @click="$dispatch('close-qr-code')">
        <div class="grid content-center sm:flex-shrink-0 text-center">
            <h2 class="font-semibold text-3xl text-white">{{ $restaurant }}</h2>
            <div class="mt-7">
                <h3 class="mb-3 text-sm text-gray-300 place-self-end">You can download your Qr Code here</h3>
                <div class="flex justify-evenly">
                    <x-primary-button>Close</x-primary-button>
                    <x-primary-button>Download</x-primary-button>
                </div>
            </div>
        </div>
        <div class="mt-3  sm:block">
            <img
                class="qr-code-img"
                alt=""
            >
        </div>
    </div>
</div>
<div
    class="w-full h-full fixed top-0 left-0 z-40 bg-black bg-opacity-80"
    x-show="openQrCode"
></div>
