{{--<x-mobile-layout--}}
{{--    :hindSection="true"--}}
{{--    :restaurant="$restaurant"--}}
{{--    :sections="$sections"--}}
{{--    :activeSectionPage="$activeSectionPage"--}}
{{--    :back="route('restaurant.index')"--}}
{{--    url="https://th.bing.com/th/id/R.93b95738cb630f899bacf7dd835b5ad5?rik=tTYET5ChbtekCw&riu=http%3a%2f%2fyesofcorsa.com%2fwp-content%2fuploads%2f2016%2f11%2f4K-Wallpapers-7.jpg&ehk=T6iESUSfpf9rlqxhPxnOLZKKmedMu0oOGAuICEPY%2fbo%3d&risl=&pid=ImgRaw&r=0"--}}

{{-->--}}
{{--    <div class="mx-auto bg-white px-7 py-5 mb-8">--}}
{{--        <h1 class="text-2xl font-bold text-center mb-7">Invoice</h1>--}}
{{--        <table class="w-full">--}}
{{--            <tr class="flex pb-2 mb-2 border-b border-gray-600">--}}
{{--                <th>#</th>--}}
{{--                <th class="pl-3">Name</th>--}}
{{--                <th class="pl-36">Qty</th>--}}
{{--                <th class="pl-16">Price</th>--}}
{{--            </tr>--}}
{{--            <tr class="flex">--}}
{{--                <td>1</td>--}}
{{--                <td class="pl-3">Hamburger is the best</td>--}}
{{--                <td class="absolute left-[59%]">3</td>--}}
{{--                <td class="absolute left-[79%]">3$</td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--        <div class="w-1/2 relative left-1/2 mt-12">--}}
{{--            <div class="w-full flex justify-between">--}}
{{--                <h3>Subtotal: </h3>--}}
{{--                <p class="font-bold">12$</p>--}}
{{--            </div><div class="w-full flex justify-between">--}}
{{--                <h3>Tax: </h3>--}}
{{--                <p class="font-bold">0$</p>--}}
{{--            </div>--}}
{{--            <div class="mt-2 w-full flex justify-between items-end">--}}
{{--                <h3>Total: </h3>--}}
{{--                <p class="font-bold text-lg text-red-500">12$</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-mobile-layout>--}}
<x-head
>
    <body class="mx-auto bg-blue px-7 py-5 mb-8">
    <div class="max-w-[40rem] mx-auto bg-white py-5 px-8 relative">
        <h1 class="text-2xl font-bold text-center mb-7">Invoice</h1>
        <div class="flex justify-between">
            <div class="mb-7">
                <h3 class="text-xs">Restaurant: </h3>
                <p class="font-bold text-xs">Restaurant name</p>
            </div>
            <div>
                <h3 class="text-xs">Address: </h3>
                <p class="font-bold text-xs">Restaurant address</p>
            </div>
        </div>
        <table class="w-full">
            <tr class="flex pb-2 mb-2 border-b border-gray-600">
                <th>#</th>
                <th class="pl-3">Name</th>
                <th class="absolute left-[62%]">Qty</th>
                <th class="absolute left-[83%]">Price</th>
            </tr>
            <tr class="flex">
                <td>1</td>
                <td class="pl-3">Hamburger is the best</td>
                <td class="absolute left-[62%]">33</td>
                <td class="absolute left-[83%]">3$3</td>
            </tr>
        </table>
        <div class="w-1/2 relative left-1/2 mt-12">
            <div class="w-full flex justify-between">
                <h3>Subtotal: </h3>
                <p class="font-bold">12$</p>
            </div>
            <div class="w-full flex justify-between">
                <h3>Tax: </h3>
                <p class="font-bold">0$</p>
            </div>
            <div class="mt-2 w-full flex justify-between items-end">
                <h3>Total: </h3>
                <p class="font-bold text-lg text-red-500">12$</p>
            </div>
        </div>
    </div>
    <h4 class="text-sm text-yellow mt-10 w-full text-center font-bold">dmenu.com</h4>
    </body>
</x-head>
