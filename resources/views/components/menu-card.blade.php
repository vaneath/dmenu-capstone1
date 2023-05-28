@props(['item'])
{{ $item }}
@php
    $url="https://th.bing.com/th/id/R.6e5ae58716febbd616cc8270fe3134ce?rik=44CGb0vVc4u6WQ&pid=ImgRaw&r=0";
    $name=$item->name;
    $description=$item->description;
    $price=$item->price;
@endphp
<div
    x-data="{
    called: function() {
            console.log('called');
            $dispatch('test');
    },
    handleAddToCart: function(event) {
        event.stopPropagation();
        this.$dispatch('add-to-cart', {
            uniqueId: '{{ $item->unique_id }}',
        });
    },
    handleRemoveFromCart: function(event) {
        event.stopPropagation();
        this.$dispatch('remove-from-cart', {
            uniqueId: '{{ $item->unique_id }}',
        });
    },
}"
    class="mb-5"
>
    <img
        src="{{ $url }}"
        alt=""
        class="rounded-2xl h-60 md:h-72 w-full bg-contain bg-center mb-5"
    >
    <h3 class="mb-1 font-bold text-white text-3xl">{{ ucwords($name) }}</h3>
    <h4 class="font-semibold text-gray-300 text-sm">{{ $description }}</h4>
    <div class="flex items-center justify-between">
        <p class="font-black text-yellow text-3xl">{{ $price }} $</p>

        <div
            class="bg-white flex items-center justify-between px-5 py-2 rounded-full w-1/3 w-44"
        >
            <button
                class="font-bold rounded-full text-2xl text-white text-white"
                x-init="
            () => {
                $el.id = 'rmButton-' + '{{ $item->unique_id }}';
            }
        "
                @click="handleRemoveFromCart($event)"
                disabled
            >-
            </button>

            <span
                class="no-of-added-to-cart font-bold"
                class="w-14 h-14 rounded-full bg-yellow font-bold text-2xl text-white"
                x-init="
            () => {
                $el.id = '{{ $item->unique_id }}';
            }
        "
            >--</span>

            <button
                class="font-bold rounded-full text-2xl text-white text-yellow"
                @click="handleAddToCart($event)"
            >+
            </button>
        </div>

    </div>
</div>
