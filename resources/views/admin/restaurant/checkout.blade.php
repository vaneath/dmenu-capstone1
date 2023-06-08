<x-head
>
    @auth
        @if(auth()->id() == $restaurant->user_id)
            <a href="{{ auth()->id() == $restaurant->user_id ? route('restaurant.index') : route('restaurant.menu', $restaurant->name) }}">
                <div
                    class="top-5 left-5 z-30 fixed w-14 h-14 rounded-full bg-yellow font-bold text-2xl text-white">
                    <span class="material-symbols-outlined absolute left-[35%] top-[25%]">
                        arrow_back_ios
                    </span>
                </div>
            </a>
        @endif
    @endauth
    <body class="mx-auto bg-blue px-7 py-5 mb-8">
    <div class="max-w-[40rem] mx-auto bg-white py-5 px-8 relative">
        <h1 class="text-2xl font-bold text-center">Invoice</h1>
        <div class="flex justify-between mt-10 gap-5">
            <div class="flex-col justify-center space-y-3 flex-1">
                <div class="w-24 h-24 mx-auto">
                    <img class="mx-auto rounded-lg" src="{{ asset('storage'). '/' . $restaurant->logo_url }}" alt="">
                </div>
                <p class="font-bold text-lg text-gray-700 text-center">{{ ucwords($restaurant->name) }}</p>
            </div>
            <div class="flex-col space-y-2">
                <h3 class="text-xs font-semibold leading-relaxed">Order Id: <span class="font-medium">{{ $order->id }}</span></h3>
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
                <th class="absolute left-[70%]">Per</th>
                <th class="absolute left-[85%]">Price</th>
            </tr>
            @foreach($orderItems as $orderItem)
                <tr class="flex">
                    <td>{{ $loop->iteration }}.</td>
                    <td class="pl-3">{{ $orderItem->item->name }}</td>
                    <td class="absolute left-[50%]">{{ $orderItem->quantity }}</td>
                    <td class="absolute left-[70%]">{{ $orderItem->item->price }}$</td>
                    <td class="absolute left-[85%]">{{ $orderItem->amount }}$</td>
                </tr>
            @endforeach
        </table>
        <div class="flex justify-evenly items-center mt-12">
            <div class="px-5">
                <div class="flex-col items-center justify-center rounded-lg">
                    <p class="py-2 text-white text-sm text-center bg-red-600 rounded-t-lg">KHQR</p>
                    <div class="border-2 border-red-600 rounded-b-lg">
                        <div class="divide-y divide-dashed">
                            <p class="mt-2 rounded-tr-[100px] text-center text-gray-500">{{ ucwords(auth()->user()->name) }}</p>
                            <img class="mt-1 w-32 h-32 rounded-b-lg" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl={{ $order->id }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
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
                                $subTotal += $orderItem->amount;
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
            Download Invoice
        </a>
    </div>
    </body>
</x-head>
