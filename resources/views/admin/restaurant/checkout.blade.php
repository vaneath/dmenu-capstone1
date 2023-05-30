<x-head
>
    <body class="mx-auto bg-blue px-7 py-5 mb-8">
    <div class="max-w-[40rem] mx-auto bg-white py-5 px-8 relative">
        <h1 class="text-2xl font-bold text-center mb-7">Invoice</h1>
        <div class="flex justify-between">
            <div class="flex-col mb-7">
                <img class="w-16 h-16 mx-auto" src="{{ asset('images/restaurant_logo.jfif') }}" alt="">
                <p class="font-bold text-xs text-gray-500">Restaurant name</p>
            </div>
            <div>
                <h3 class="text-xs font-semibold">Order Id: <span class="font-medium">3573495834</span></h3>
                <p class="font-bold text-xs">Restaurant address</p>
            </div>
        </div>
        <table class="w-full mt-7">
            <tr class="flex pb-2 mb-2 border-b border-gray-600">
                <th>#</th>
                <th class="pl-3">Name</th>
                <th class="absolute left-[62%]">Qty</th>
                <th class="absolute left-[83%]">Price</th>
            </tr>
            @for($i = 0; $i < 5; $i++)
                <tr class="flex">
                    <td>1.</td>
                    <td class="pl-3">Hamburger is the best</td>
                    <td class="absolute left-[62%]">33</td>
                    <td class="absolute left-[83%]">3$3</td>
                </tr>
            @endfor
        </table>
        <div class="flex justify-evenly items-center mt-12">
            <img class="w-32 h-32" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=test" alt="">
            <div class="flex gap-5">
                <div class="flex-col">
                    <h3>Subtotal: </h3>
                    <h3>Tax: </h3>
                    <h3>Total: </h3>
                </div>
                <div class="flex-col">
                    <p class="font-bold">12$</p>
                    <p class="font-bold">0$</p>
                    <p class="font-bold text-lg text-red-500">12$</p>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-7">
            <img
                src="{{ asset('images/dmenu.png') }}"
                class="h-12 w-12"
                alt="">
        </div>
        <h4 class="text-xs text-yellow w-full text-center font-semibold">dmenu.com</h4>
    </div>
    <div class="flex justify-center mt-5">
        <a href="#"
           class="text-sm px-7 py-2 transition ease-linear duration-300 bg-yellow text-white rounded-xl border-2 border-yellow hover:bg-transparent hover:scale-110 hover:text-yellow"
        >
            Download this invoice
        </a>
    </div>
    </body>
</x-head>
