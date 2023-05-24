{{--<div>--}}
{{--    <x-order.show-my-order />--}}
{{--</div>--}}

<x-mobile-layout
    :hind-section="true"
    :restaurant="$restaurant"
    :sections="$sections"
    :activeSectionPage="$activeSectionPage"
    :back="route('restaurant.index')"
    url="https://th.bing.com/th/id/R.93b95738cb630f899bacf7dd835b5ad5?rik=tTYET5ChbtekCw&riu=http%3a%2f%2fyesofcorsa.com%2fwp-content%2fuploads%2f2016%2f11%2f4K-Wallpapers-7.jpg&ehk=T6iESUSfpf9rlqxhPxnOLZKKmedMu0oOGAuICEPY%2fbo%3d&risl=&pid=ImgRaw&r=0"
>
    <div class="my-8">
        <div class="flow-root">
            <ul role="list" class="-my-6 divide-y divide-gray-200">
                <li class="flex py-6">
                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img src="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg" alt="Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch." class="h-full w-full object-cover object-center">
                    </div>

                    <div class="ml-4 flex flex-1 flex-col">
                        <div>
                            <div class="flex-col justify-between text-base font-medium text-gray-900">
                                <h3 class="text-yellow font-semibold text-lg">
                                    Medium Stuff Satchel
                                </h3>
                                <p class="text-sm text-white">$32.00</p>
                            </div>
                        </div>
                        <div class="flex flex-1 items-end justify-between text-sm">
                            <p class="text-white">
                                Qty
                                <span class="ml-1 px-3 py-1 bg-yellow rounded-full">
                                    1
                                </span>
                            </p>

                            <div class="flex px-5 py-2 bg-red-500 hover:bg-red-600 rounded-lg">
                                <button type="button" class="font-medium text-white">Remove</button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div
        id="show-my-order"
        class="w-full mx-auto fixed left-0 bottom-3 flex justify-center"
    >
        <div
            class="w-[30rem] h-14 px-10 bg-yellow rounded-full grid place-content-center"
        >
            <a href="{{ route('order.show', $restaurant->name) }}" class="font-semibold text-lg text-white absolute top-1/4 left-[40%]">
                Checkout
            </a>
        </div>
    </div>
</x-mobile-layout>
