<x-mobile-layout :restaurant="$restaurant">
    <ul>
        <button class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
            +
        </button>
        <a href="/restaurants/1/main_menu">
            <li class="relative mb-5">
                <img
                    src="https://th.bing.com/th/id/R.4767c2cef2fe33f19fe0abe8acf643b2?rik=PXnnztHtSXWldw&pid=ImgRaw&r=0"
                    alt=""
                    class="bg-cover bg-center h-52 w-full rounded-2xl blur-xs transition ease-linear duration-300"
                >
                <h3 class="text-center w-full top-[40%] absolute font-semibold text-white text-3xl tracking-widest">
                    PIZZA
                </h3>
            </li>
        </a>
    </ul>
</x-mobile-layout>
