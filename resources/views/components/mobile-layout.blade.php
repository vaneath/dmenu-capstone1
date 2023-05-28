@props(['restaurant', 'sections', 'activeSectionPage', 'back', 'url', 'hindSection' => false])
@php
    if($activeSectionPage == null) {
        $activeSectionPage = 0;
    }
@endphp
<x-head>
    <div x-data="{
    createSectionFormOpen: false,
    someVariable: 'someValue',
    activeSectionPage: '{{ $activeSectionPage }}',
    setActiveSectionPage(sectionId) {
        this.activeSectionPage = sectionId;
        $dispatch('update-active-section-page', sectionId);
    },
    toggleModal() {
        this.createSectionFormOpen = !this.createSectionFormOpen;
        this.$dispatch('create-restaurant-form-open', { createSectionFormOpen: this.createSectionFormOpen });
    },
}"
         x-init="$dispatch('update-active-section-page', activeSectionPage)"
         @toggle-modal="toggleModal">
        <div class="mx-auto max-w-[40rem] mb-10 relative block">
            @auth
                @if(auth()->id() == $restaurant->user_id)
                    <a href="{{ $back }}">
                        <div
                            class="top-5 left-5 z-30 absolute w-14 h-14 rounded-full bg-yellow font-bold text-2xl text-white">
            <span class="material-symbols-outlined absolute left-[35%] top-[25%]">
                arrow_back_ios
            </span>
                        </div>
                    </a>
                @endif
            @endauth
            <img
                src="{{ $url }}"
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
                @if(! $hindSection)
                    <div class="mb-8" id="section">
                        <div class="flex gap-5 text-white whitespace-nowrap overflow-x-scroll">
                            @auth
                                @if(auth()->id() == $restaurant->user_id)
                                    <button @click="toggleModal" class="px-4 py-2 bg-yellow font-bold text-xl rounded-full">
                                        +
                                    </button>
                                @endif
                            @endauth
                            @foreach($sections as $section)
                                <button
                                    :class="{ 'bg-yellow': activeSectionPage == '{{ $section->id }}' }"
                                    class="px-6 py-1 border-[3px] border-yellow rounded-3xl hover:bg-yellow"
                                    @click="setActiveSectionPage('{{ $section->id }}')"
                                >
                                    {{ ucwords($section->name) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
                {{ $slot }}
                <p class="text-center text-white">dmenu.com</p>
            </div>
        </div>
        <x-section-create-modal :restaurant="$restaurant"/>
    </div>

</x-head>
