<x-head
>
    <body class="mx-auto bg-blue px-7 py-5 mb-8">
    <div class="max-w-[40rem] mx-auto bg-white py-5 px-8 relative">
        <h1 class="text-2xl font-bold text-center mb-7">Invoice</h1>
        <div class="flex justify-between">
            <div class="flex-col mb-7">
                @empty($restaurant->logo_url)
                    <img class="w-16 h-16 mx-auto" src="{{ asset('images/restaurant_logo.jfif') }}" alt="">
                @else
                    <img class="w-16 h-16 mx-auto" src="{{ asset($restaurant->logo_url) }}" alt="">
                @endempty
                <p class="font-bold text-xs text-gray-500">{{ $restaurant->name }}</p>
            </div>
            <div>
                <h3 class="text-xs font-semibold">Order Id: <span class="font-medium">{{ $order->id }}</span></h3>
                <p class="font-bold text-xs">
                    Date: <span class="font-medium">{{ $order->created_at->format('d-m-Y h:i a') }}</span>
                </p>
                <p class="font-bold text-xs">
                    Address: <span class="font-medium">{{ $restaurant->village }}, {{ $restaurant->commune }}, {{ $restaurant->district }}, {{ $restaurant->province }}</span>
                </p>
            </div>
        </div>
        <table class="w-full mt-7">
            <tr class="flex pb-2 mb-2 border-b border-gray-600">
                <th>#</th>
                <th class="pl-3">Name</th>
                <th class="absolute left-[50%]">Qty</th>
                <th class="absolute left-[70%]">UP</th>
                <th class="absolute left-[85%]">Amount</th>
            </tr>
            {{-- @for($i = 0; $i < 2; $i++)
                <tr class="flex">
                    <td>1.</td>
                    <td class="pl-3">Hamburger is the best</td>
                    <td class="absolute left-[50%]">33</td>
                    <td class="absolute left-[70%]">$3</td>
                    <td class="absolute left-[85%]">$99</td>
                </tr>
            @endfor --}}
            @foreach($orderItems as $orderItem)
                <tr class="flex">
                    <td>{{ $loop->iteration }}.</td>
                    <td class="pl-3">{{ $orderItem->item->name }}</td>
                    <td class="absolute left-[50%]">{{ $orderItem->quantity }}</td>
                    <td class="absolute left-[70%]">{{ $orderItem->item->price }}$</td>
                    <td class="absolute left-[85%]">{{ $orderItem->sub_total }}$</td>
                </tr>
            @endforeach
        </table>
        <div class="flex justify-evenly items-center mt-12">
            <img class="w-32 h-32" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl={{ $order->id }}" alt="">
            <div class="flex gap-5">
                <div class="flex-col">
                    <h3>Subtotal: </h3>
                    <h3>Discount: </h3>
                    <h3>Tax: </h3>
                    <h3>Total: </h3>
                </div>
                <div class="flex-col">
                    <p class="font-bold">
                        @php
                            $subTotal = 0;
                            foreach ($orderItems as $orderItem) {
                                $subTotal += $orderItem->sub_total;
                            }
                        @endphp
                        {{ $subTotal }}$
                    </p>
                    <p class="font-bold">
                        @php
                            $discount = 0;
                            foreach ($orderItems as $orderItem) {
                                $discount += $orderItem->discount * $orderItem->quantity * $orderItem->item->price;
                            }
                        @endphp
                        @if($discount == 0)
                        {{ $discount }}$
                        @else
                        -{{ $discount }}$
                        @endif
                    </p>
                    <p class="font-bold">
                        @php
                            $tax = ($subTotal - $discount) * 0; // should be $restaurant->tax
                        @endphp
                        {{ $tax }}$
                    </p>
                    <p class="font-bold text-lg text-red-500">
                        @php
                            $total = $subTotal - $discount + $tax;
                        @endphp
                        {{ $total }}$
                    </p>
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
