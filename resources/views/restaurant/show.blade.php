@php
    $activeSectionPage = $sections->first()->id;
@endphp
<x-mobile-layout :restaurant="$restaurant" :sections="$sections" :activeSectionPage="$activeSectionPage">
    
<div x-data>
    <span x-data="{ receivedData: '' }" x-on:update-active-section-page.window="receivedData = $event.detail">
        Received Data: <span x-text="receivedData"></span>
    </span>

</div>

<div 
x-data="{ activeSectionPage = null }"
x-on:update-active-section-page.window="activeSectionPage = $event.detail"
>
    <p x-text="activeSectionPage"></p>
    <p x-bind:x-text="activeSectionPage"></p>
</div>
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
