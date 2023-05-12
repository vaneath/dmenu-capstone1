<x-mobile-layout
    :restaurant="$restaurant"
    url="https://th.bing.com/th/id/R.cf3c02a778b9988ea28922849888e530?rik=4gnDcCikhk%2b4nA&pid=ImgRaw&r=0"
    :back="route('restaurant.index')"
>
    <x-slot:section>
        @for($i = 0; $i < 6; $i++)
            <button class="px-6 py-1 border-[3px] border-yellow rounded-3xl hover:bg-yellow">
                Main menu
            </button>
        @endfor
    </x-slot:section>
    <ul>
        <button class="w-full mb-5 py-2 bg-yellow rounded-2xl text-white font-bold text-lg">
            +
        </button>
        <x-category-card
            href="/restaurants/1/main_menu"
            url="https://th.bing.com/th/id/R.4767c2cef2fe33f19fe0abe8acf643b2?rik=PXnnztHtSXWldw&pid=ImgRaw&r=0"
            name="pizza"
        />
    </ul>
</x-mobile-layout>
