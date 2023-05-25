<x-app-layout>
    <body>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
        @include('superadmin._layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            @include('superadmin._layouts.header')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                    @yield('body')
                </div>
            </main>
        </div>
    </div>
    </body>
</x-app-layout>
