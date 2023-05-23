@php
    $items = [
        [
            'name' => 'hamburger',
            'quantity' => 1,
            'price' => 10,
        ],
        [
            'name' => 'pizza',
            'quantity' => 2,
            'price' => 20,
        ],
        [
            'name' => 'pasta',
            'quantity' => 3,
            'price' => 30,
        ],
    ];
@endphp
<x-head>
    <div>
        <div class="flex flex-col mt-4">

            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold">Order Details</h2>
                <a href="#" class="text-gray-600 hover:text-gray-900">View Order History</a>
            </div>
            <div class="information-wrapper flex flex-wrap">
                <div class="column-wrapper w-1/2 flex flex-wrap">
                    <div class="flex justify-between">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold">Order Number</h3>
                            <p class="text-gray-500">1234567890</p>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold">Shipping Address</h3>
                            <p class="text-gray-500">123 Main Street</p>
                            <p class="text-gray-500">Anytown, CA 12345</p>
                        </div>
                    </div>
                </div>

                <div class="column-wrapper w-1/2">
                    <div class="flex justify-between">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold">Order Date</h3>
                            <p class="text-gray-500">2023-05-21</p>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div class="w-full">
                            <h3 class="text-lg font-semibold">Billing Address</h3>
                            <p class="text-gray-500">123 Main Street</p>
                            <p class="text-gray-500">Anytown, CA 12345</p>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody class="text-center mt-10">
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['price'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-left">Subtotal</td>
                        <td>$60.00</td>
                    </tr>
                 </tbody>
            </table>


            <div class="mt-4">
                <h3 class="text-lg font-semibold">Order Total</h3>
                <p class="text-gray-500">$30.00</p>
            </div>
        </div>
    </div>
</x-head>
