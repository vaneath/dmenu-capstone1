<div class="flex-col w-48 h-56 px-2 py-3 bg-blue text-white rounded-xl shadow-lg shadow-blue-500">
    <!-- {{ $restaurant }} -->
    <div class="flex justify-end gap-2">
        <a href="#">
                    <span class="material-symbols-outlined">
                      qr_code
                    </span>
        </a>
        <a href="#">
                    <span class="material-symbols-outlined">
                       settings
                    </span>
        </a>
    </div>
    <h3 class="mb-5 font-bold text-center text-xl">{{ $restaurant->name }}</h3>
    <div class="w-36 mx-auto text-center flex-col space-y-3">
        <div class="px-4 py-2 rounded-lg bg-orange-300">
            <a href="#" >Payment</a>
        </div>
        <div class="px-4 py-2 rounded-lg bg-orange-300">
            <a href="#">Edit Menu</a>
        </div>
    </div>
</div>
