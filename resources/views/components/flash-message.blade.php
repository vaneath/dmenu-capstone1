@if(session()->has('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        class="fixed bg-blue text-white py-3 px-6 rounded-lg bottom-3 right-3"
    >
        <p>
            {{ session('success') }}
        </p>
    </div>
@endif
