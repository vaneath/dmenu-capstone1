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
<div 
    x-data="{
        increaseQuantity: function(itemUniqueID) {
            let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
            let cartItemsAtCheckout = JSON.parse(sessionStorage.getItem('cartItemsAtCheckout'));
            let emptyCart = sessionStorage.getItem('emptyCart');
            if (cartItemsAtCheckout[itemUniqueID] == undefined) {
                cartItemsAtCheckout[itemUniqueID] = 1;
            } else {
                cartItemsAtCheckout[itemUniqueID] += 1;
            }
            sessionStorage.setItem('cartItemsAtCheckout', JSON.stringify(cartItemsAtCheckout));
            document.getElementById('quantity-' + itemUniqueID).innerHTML = cartItems[itemUniqueID]/4 + cartItemsAtCheckout[itemUniqueID]/2;
        },
        decreaseQuantity: function(itemsUniqueId){
            let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
            let cartItemsAtCheckout = JSON.parse(sessionStorage.getItem('cartItemsAtCheckout'));
            let emptyCart = sessionStorage.getItem('emptyCart');
            if (cartItemsAtCheckout[itemsUniqueId] == undefined) {
                cartItemsAtCheckout[itemsUniqueId] = 0;
            } else if (cartItemsAtCheckout[itemsUniqueId] == 0){
                cartItemsAtCheckout[itemsUniqueId] = -2;
            } else if (cartItems[itemsUniqueId]/4 + cartItemsAtCheckout[itemsUniqueId]/2 == 0){
                cartItemsAtCheckout[itemsUniqueId] = 0;
            } else{
                cartItemsAtCheckout[itemsUniqueId] -= 1;
            }
            sessionStorage.setItem('cartItemsAtCheckout', JSON.stringify(cartItemsAtCheckout));
            console.log(itemsUniqueId, cartItemsAtCheckout[itemsUniqueId]);
            document.getElementById('quantity-' + itemsUniqueId).innerHTML = cartItems[itemsUniqueId]/4 + cartItemsAtCheckout[itemsUniqueId]/2;
        },
        deleteFromCartItems: function(itemUniqueID) {
            let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
            let cartItemsAtCheckout = JSON.parse(sessionStorage.getItem('cartItemsAtCheckout'));
            let emptyCart = sessionStorage.getItem('emptyCart');
            if (cartItemsAtCheckout[itemUniqueID] == undefined) {
                cartItemsAtCheckout[itemUniqueID] = 0;
            };
            delete cartItems[itemUniqueID];
            delete cartItemsAtCheckout[itemUniqueID];
            sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
            sessionStorage.setItem('cartItemsAtCheckout', JSON.stringify(cartItemsAtCheckout));
            document.getElementById('item-' + itemUniqueID).remove();
            if (Object.keys(cartItemsAtCheckout).length == 0) {
                sessionStorage.setItem('emptyCart', true);
            }
        },
        combineCartItems: function() {
            let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
            let cartItemsAtCheckout = JSON.parse(sessionStorage.getItem('cartItemsAtCheckout'));
            let cartItemsInput = document.getElementById('cart-items-input');
            let emptyCart = sessionStorage.getItem('emptyCart');
            for (let item in cartItems){
                if (cartItemsAtCheckout[item] == undefined) {
                    cartItemsAtCheckout[item] = 0;
                }
                cartItems[item] = cartItems[item]/4 + cartItemsAtCheckout[item]/2;
            }
            cartItemsInput.value = JSON.stringify(cartItems);
        },
        checkoutItems: function() {
            combineCartItems();
            event.target.submit();
        },
        displayItems: function(){
            let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
            let cartItemsAtCheckout = JSON.parse(sessionStorage.getItem('cartItemsAtCheckout'));
            let itemList = document.getElementById('item-list');
            let content = ``;
            for(item in cartItems){
                if (cartItemsAtCheckout[item] == undefined) {
                    cartItemsAtCheckout[item] = 0;
                }
                let quantity = cartItems[item]/4 + cartItemsAtCheckout[item]/2;
                console.log(item);
                content += `
                <li class='flex py-6' id='item-${item}'>
                    <div class='h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200'>
                        <img src='https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg' alt='Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.'' class='h-full w-full object-cover object-center'>
                    </div>

                    <div class='ml-4 flex flex-1 flex-col'>
                        <div>
                            <div class='flex-col justify-between text-base font-medium text-gray-900'>
                                <h3 class='text-yellow font-semibold text-lg'>
                                    ${item}
                                </h3>
                                <p class='text-sm text-white'>$32.00</p>
                            </div>
                        </div>
                        <div class='flex flex-1 items-end justify-between text-sm'>
                            <div class='bg-white px-5 py-1 rounded-full flex gap-5'>
                                <div class='cursor-pointer text-sm text-yellow font-black text-lg' @click='decreaseQuantity(&quot;${item}&quot;)'>
                                    -
                                </div>
                                <span class='font-bold' id='quantity-${item}'>
                                    ${quantity}
                                </span>
                                <div class='cursor-pointer text-sm text-yellow font-semibold' @click='increaseQuantity(&quot;${item}&quot;)'>
                                    +
                                </div>
                            </div>

                            <div class='flex px-5 py-2 bg-red-500 hover:bg-red-600 rounded-lg' @click='deleteFromCartItems(&quot;${item}&quot;)'>
                                <button type='button' class='font-medium text-white'>Remove</button>
                            </div>
                        </div>
                    </div>
                </li>
                `;
            }
            itemList.innerHTML = content;

        }
    }"
    x-init="
    () => {
        displayItems();
        sessionStorage.setItem('cartItemsAtCheckout', JSON.stringify({}));
        combineCartItems();
        let cartItemsInput = document.getElementById('cart-items-input');
        cartItemsInput.value = sessionStorage.getItem('cartItems');
    }
    "
>
    <div class="my-8">
        <div class="flow-root">
            <ul role="list" class="-my-6 divide-y divide-gray-200" id="item-list">
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
                            <div class="bg-white px-5 py-1 rounded-full flex gap-5">
                                <div class="text-sm text-yellow font-black text-lg">
                                    -
                                </div>
                                <span class="font-bold">
                                    1
                                </span>
                                <div class="text-sm text-yellow font-semibold">
                                    +
                                </div>
                            </div>

                            <div class="flex px-5 py-2 bg-red-500 hover:bg-red-600 rounded-lg">
                                <button type="button" class="font-medium text-white">Remove</button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <a href="{{ route('order.show', $restaurant->name) }}"
       class="w-[20rem] mb-1 fixed mx-auto left-0 right-0 bottom-3 bg-yellow rounded-full px-10 py-2 text-center"
    >
        <div
            class="font-semibold text-lg text-white"
            id="show-my-order"
        >
            Checkout
        </div>
    </a>

    <form @submit.prevent="checkoutItems" action="{{ route('order.store', $restaurant->name) }}" method="POST" id="order-form">
        @csrf
        <input type="hidden" name="restaurant" value="{{ $restaurant }}"> 
        <input type="hidden" id="cart-items-input" name="cart_items" value="">
        <button type="submit" id="submit-order">Checkout V2</button>
    </form>
</div>

</x-mobile-layout>
