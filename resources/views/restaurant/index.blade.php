<x-setting class="grid grid-cols-2 sm:grid-cols-3 justify-items-center lg:grid-cols-5 gap-3">
    <x-restaurant.restaurant-create />
    @foreach($restaurants as $restaurant)
        <x-restaurant.restaurant-card :restaurant="$restaurant" />
    @endforeach
</x-setting>
