<div class="flex-col w-44 h-56 px-2 py-3 bg-blue text-white rounded-xl shadow-lg shadow-blue-500">
    <div class="flex justify-end gap-2">
        <div>
            <x-primary-icon-button >
                <span @click="$dispatch('open-qr-code', '{{ $_SERVER['HTTP_HOST'] . '/qr/' . $restaurant->unique_id }}')" class="material-symbols-outlined">
                  qr_code
                </span>
            </x-primary-icon-button>
        </div>
        <x-primary-icon-button>
            <span class="material-symbols-outlined">
               settings
            </span>
        </x-primary-icon-button>
    </div>
    <h3 class="mb-5 font-bold text-center text-xl">{{ $restaurant->name }}</h3>
    <div class="text-center">
        <a href="#" >
            <div class="mx-auto w-[80%] mb-3 px-4 py-2 rounded-lg bg-yellow">
                Payment
            </div>
        </a>
        <a href="{{ route('restaurant.show', ['restaurant' => $restaurant->name]) }}" >
            <div class="mx-auto w-[80%] px-4 py-2 rounded-lg bg-yellow">
                Edit Menu
            </div>
        </a>
    </div>
</div>
