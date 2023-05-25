@props(['checkout' => false])

<x-head>
    @if(! $checkout)
        @include('layouts.navigation')
    @endif
    <body class="min-h-screen font-sans text-gray-900 antialiased">
        <div class="flex mt-10 flex-col mx-10 sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md mt-6 px-10 py-10 bg-blue shadow-md overflow-hidden rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
    <footer>
        <div class="grid place-content-center absolute bottom-0 w-full h-20 bg-yellow">
            <h3 class="text-white">
                dmenu.com
            </h3>
        </div>
    </footer>
    <x-flash-message />
</x-head>
