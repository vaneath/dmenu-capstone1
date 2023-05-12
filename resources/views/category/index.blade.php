<x-mobile-layout :restaurant="$restaurant">
    <div class="mb-5">
        <img
            src="https://th.bing.com/th/id/R.6e5ae58716febbd616cc8270fe3134ce?rik=44CGb0vVc4u6WQ&pid=ImgRaw&r=0"
            alt=""
            class="rounded-2xl h-72 md:h-96 w-full bg-cover bg-center mb-5"
        >
        <h3 class="mb-1 font-bold text-white text-3xl">Hamburger</h3>
        <h4 class="font-semibold text-gray-300 text-sm">This food is made in Italy</h4>
        <div class="flex items-center justify-between">
            <p class="font-black text-yellow text-3xl">4.5 $</p>
            <button class="w-14 h-14 rounded-full bg-yellow font-bold text-2xl text-white">+</button>
        </div>
    </div>
</x-mobile-layout>
