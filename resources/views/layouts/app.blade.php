@props(['footer' => false])

<x-head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main {{ $attributes->merge(['class' => '']) }}>
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            @if($footer)
                @include('layouts.footer')
            @endif
        </div>
    </body>
    <x-flash-message />
</x-head>
