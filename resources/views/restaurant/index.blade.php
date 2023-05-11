<x-setting>
    <x-restaurant-create />
    @foreach($restaurants as $restaurant)
        <x-restaurant-card :restaurant="$restaurant" />
    @endforeach

</x-setting>
