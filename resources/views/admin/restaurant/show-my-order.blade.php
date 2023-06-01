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
        checkoutXDataCartItems: JSON.parse(JSON.stringify(JSON.parse(sessionStorage.getItem('cartItems')))),
        getCheckoutXDataCartItems: function() {
            if (this.checkoutXDataCartItems == null) {
                return {};
            }
            return this.checkoutXDataCartItems;
        },
        getCheckoutXDataCartItemsDetails: function() {
            let response = 0;

            let checkoutXDataCartItemsKeys = JSON.stringify(Object.keys(this.getCheckoutXDataCartItems()));
            try{
                fetch('/items/' + checkoutXDataCartItemsKeys)
                .then(response => response.text())
                .then(data => {
                    console.log('data: ', data);
                    return data;
                })
                .catch(error => {
                    console.warn('Error fetching HTML:', error);
                    return null;
                });
            } catch(error) {
                console.log('error: ', error);
                return null;
            }
            
        },
        cartItemsDetails: null,
        checkoutXDataCartItemsDetails: 'not null',
        setCheckoutXDataCartItems: function(checkoutXDataCartItems) {
            checkoutXDataCartItems = JSON.parse(JSON.stringify(checkoutXDataCartItems));
            if (checkoutXDataCartItems == null) {
                checkoutXDataCartItems = {};
            }
            this.checkoutXDataCartItems = checkoutXDataCartItems;
        },
        increaseQuantity: function(itemUniqueID) {

            console.log('checkoutXakjdlkjfa', this.cartItemsDetails);

            let checkoutXDataCartItems = this.getCheckoutXDataCartItems();
            checkoutXDataCartItems[itemUniqueID].quantity = checkoutXDataCartItems[itemUniqueID].quantity + 1 || 1;
            console.log('increase: ', checkoutXDataCartItems);
            this.setCheckoutXDataCartItems(checkoutXDataCartItems);
            document.getElementById('quantity-' + itemUniqueID).innerText = checkoutXDataCartItems[itemUniqueID].quantity / 2;
            this.populateHiddenInput(checkoutXDataCartItems);
        },
        populateHiddenInput: function(checkoutXDataCartItems) {
            let cartItems = JSON.parse(JSON.stringify(checkoutXDataCartItems));
            for(let [item, quantity] of Object.entries(checkoutXDataCartItems)) {
                cartItems[item] = checkoutXDataCartItems[item].quantity / 2;
            }
            let cartItemsInput = document.getElementById('cart-items-input');
            cartItemsInput.value = JSON.stringify(cartItems);
        },
        decreaseQuantity: function(itemsUniqueId){
            let checkoutXDataCartItems = this.getCheckoutXDataCartItems();
            if (checkoutXDataCartItems[itemsUniqueId] <= 0) {
                return;
            } else {
                if(checkoutXDataCartItems[itemsUniqueId].quantity > 0){
                    checkoutXDataCartItems[itemsUniqueId].quantity = checkoutXDataCartItems[itemsUniqueId].quantity - 1;
                } 
                this.setCheckoutXDataCartItems(checkoutXDataCartItems);
                document.getElementById('quantity-' + itemsUniqueId).innerText = checkoutXDataCartItems[itemsUniqueId].quantity / 2;
            }
            this.populateHiddenInput(checkoutXDataCartItems);
        },
        deleteFromCartItems: function(itemUniqueID) {
            let checkoutXDataCartItems = this.getCheckoutXDataCartItems();
            delete checkoutXDataCartItems[itemUniqueID];
            this.populateHiddenInput(checkoutXDataCartItems);
            this.setCheckoutXDataCartItems(checkoutXDataCartItems);
            document.getElementById('item-' + itemUniqueID).remove();
        },
        checkoutItems: function() {
            this.populateHiddenInput(this.getCheckoutXDataCartItems());
            event.target.submit();
        },
        displayItems: function(){
            let checkoutXDataCartItems = this.getCheckoutXDataCartItems();
            let itemList = document.getElementById('item-list');
            let content = ``;
            for(let [item, quantity] of Object.entries(checkoutXDataCartItems)) {
                let imgUrl = null;
                if (this.checkoutXDataCartItems[item].img_url) {
                    imgUrl = this.checkoutXDataCartItems[item].img_url;
                } else {
                    imgUrl = 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg';
                }
                content += `
                <li class='flex py-6' id='item-${item}'>
                    <div class='h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200'>
                        <img src='${ imgUrl }' alt='Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.'' class='h-full w-full object-cover object-center'>
                    </div>

                    <div class='ml-4 flex flex-1 flex-col'>
                        <div>
                            <div class='flex-col justify-between text-base font-medium text-gray-900'>
                                <h3 class='text-yellow font-semibold text-lg'>
                                    ${checkoutXDataCartItems[item].name}
                                </h3>
                                <p class='text-sm text-white'>${checkoutXDataCartItems[item].price} $</p>
                            </div>
                        </div>
                        <div class='flex flex-1 items-end justify-between text-sm'>
                            <div class='bg-white px-5 py-1 rounded-full flex gap-5'>
                                <div class='cursor-pointer text-sm text-yellow font-black text-lg' @click='decreaseQuantity(&quot;${item}&quot;)'>
                                    -
                                </div>
                                <span class='font-bold' id='quantity-${item}'>
                                    ${checkoutXDataCartItems[item].quantity / 2}
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
        {{-- sessionStorage.setItem('cartItemsAtCheckout', JSON.stringify({})); --}}
        displayItems();
        {{-- combineCartItems();
        let cartItemsInput = document.getElementById('cart-items-input');
        cartItemsInput.value = sessionStorage.getItem('cartItems'); --}}
    }
    "
>
    <div class="my-8">
        <div class="flow-root">
            <ul role="list" class="-my-6 divide-y divide-gray-200" id="item-list">
            </ul>
        </div>
    </div>

    <div class="w-[20rem] mb-1 fixed mx-auto left-0 right-0 bottom-3 bg-yellow rounded-full px-10 py-2 text-center">
    <form @submit.prevent="checkoutItems" action="{{ route('order.store', $restaurant->id) }}" method="POST" id="order-form">
        @csrf
        <input type="hidden" name="restaurant" value="{{ $restaurant->id }}"> 
        <input type="hidden" id="cart-items-input" name="cart_items" value="">
        <button 
            class="font-semibold text-lg text-white"
            id="show-my-order"
            type="submit" id="submit-order">Checkout</button>
    </form>
    </div>
</div>

</x-mobile-layout>
