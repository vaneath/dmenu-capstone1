<x-head>
    <div class="mx-auto w-[40rem] mb-10 relative block">
        <img
            src="https://th.bing.com/th/id/R.cf3c02a778b9988ea28922849888e530?rik=4gnDcCikhk%2b4nA&pid=ImgRaw&r=0"
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
            <div class="mb-8">
                <div class="flex gap-5 text-white whitespace-nowrap overflow-x-scroll">
                    @for($i = 0; $i < 6; $i++)
                        <button class="px-6 py-1 border-[3px] border-yellow rounded-3xl hover:bg-yellow">
                            Main menu
                        </button>
                    @endfor
                    <button class="px-4 py-2 bg-yellow font-bold text-xl rounded-full">
                        +
                    </button>
                </div>
            </div>
            <ul>
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
        </ul>
            <p class="text-center text-white">dmenu.com</p>
        </div>
    </div>
</x-head>
