@props(['restaurant', 'url', 'back'])
<x-head>
    <div class="mx-auto max-w-[40rem] mb-10 relative block">
        <a href="{{ $back }}">
            <div class="top-5 left-5 z-50 absolute w-14 h-14 rounded-full bg-yellow font-bold text-2xl text-white">
            <span class="material-symbols-outlined absolute left-[35%] top-[25%]">
                arrow_back_ios
            </span>
            </div>
        </a>
        <img
            src="{{ $url }}"
            alt="restaurant-img"
            class="bg-cover h-40 w-full"
        >
        <div class="bg-blue absolute top-32 w-full rounded-l-3xl rounded-r-3xl px-5 py-7">
            <h2 class="mb-3 text-3xl text-white font-bold">
                {{ ucwords($restaurant->name) }}
            </h2>
            <div class="flex mb-5 items-end text-sm text-gray-300">
                <span class="material-symbols-outlined">
                    location_on
                </span>
                {{ ucwords($restaurant->location) }}
            </div>
            <div class="mb-8" id="section">
                <div class="flex gap-5 text-white whitespace-nowrap overflow-x-scroll">
                    <button class="px-4 py-2 bg-yellow font-bold text-xl rounded-full">
                        +
                    </button>
                    {{ $section }}
                </div>
            </div>
            {{ $slot }}
            <p class="text-center text-white">dmenu.com</p>
        </div>
    </div>
</x-head>
