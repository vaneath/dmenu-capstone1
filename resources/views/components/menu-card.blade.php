@props(['url', 'name', 'description', 'price' ])

<div class="mb-5">
    <img
        src="{{ $url }}"
        alt=""
        class="rounded-2xl h-72 md:h-96 w-full bg-cover bg-center mb-5"
    >
    <h3 class="mb-1 font-bold text-white text-3xl">{{ ucwords($name) }}</h3>
    <h4 class="font-semibold text-gray-300 text-sm">{{ $description }}</h4>
    <div class="flex items-center justify-between">
        <p class="font-black text-yellow text-3xl">{{ $price }} $</p>
        <button class="w-14 h-14 rounded-full bg-yellow font-bold text-2xl text-white">+</button>
    </div>
</div>
