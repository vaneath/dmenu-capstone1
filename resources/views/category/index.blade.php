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
    <x-menu-card
        url="https://th.bing.com/th/id/R.6e5ae58716febbd616cc8270fe3134ce?rik=44CGb0vVc4u6WQ&pid=ImgRaw&r=0"
        name="hamburger"
        description="I like this hamburger from Italy"
        price="10"
    />
</x-mobile-layout>
