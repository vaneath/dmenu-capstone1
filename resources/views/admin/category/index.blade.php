<x-mobile-layout
    :restaurant="$restaurant"
    :sections="$sections"
    :activeSectionPage="$activeSectionPage"
    :back="route('restaurant.index')"
    url="https://th.bing.com/th/id/R.93b95738cb630f899bacf7dd835b5ad5?rik=tTYET5ChbtekCw&riu=http%3a%2f%2fyesofcorsa.com%2fwp-content%2fuploads%2f2016%2f11%2f4K-Wallpapers-7.jpg&ehk=T6iESUSfpf9rlqxhPxnOLZKKmedMu0oOGAuICEPY%2fbo%3d&risl=&pid=ImgRaw&r=0"
>

    <div
        x-data="{
    activeSectionPage: 0,
    ignoreEvent: false,
    xDataEmptyCart: true,
    xDataCartItems: {},
    restaurantName: '{{ $restaurant->name }}',
    fetchCategories: function(sectionId){
        if (sectionId == 0) {
            document.getElementById('display-items').innerHTML = '';
            document.getElementById('display-categories').innerHTML = '';
            return;
        }
        fetch('/restaurants/' + this.restaurantName + '/sections/' + sectionId + '/categories')
        .then(response => {
            if (!response.ok) {
                return '';
            }
            return response.text();
        })
        .then(html => {
        document.getElementById('display-items').innerHTML = '';
        document.getElementById('display-categories').innerHTML = html;
        })
        .catch(error => {
        console.warn('Error fetching HTML:', error);
        });
    },
    fetchItems: function(categoryId){
        if (categoryId == 0) {
            document.getElementById('display-categories').innerHTML = '';
            document.getElementById('display-items').innerHTML = '';
            return;
        }
        // path : '/restaurants/' + this.restaurantName + '/menu/' + categoryId + '/items'
        fetch('/restaurants/' + this.restaurantName + '/menu/' + categoryId + '/items')
        .then(response => response.text())
        .then(html => {
        document.getElementById('display-categories').innerHTML = '';
        document.getElementById('display-items').innerHTML = html;
        })
        .catch(error => {
        console.warn('Error fetching HTML:', error);
        });
    },
    addToCart: function(itemUniqueID) {
        if (this.xDataEmptyCart == 'true') {
            this.xDataCartItems = {};
        }
        this.xDataCartItems[itemUniqueID] = this.xDataCartItems[itemUniqueID] + 1 || 1;
    },
    removeFromCart: function(itemUniqueID) {
        console.log('removeFromCart is called');
        let rmButton = document.getElementById('rmButton-' + itemUniqueID);
        if (this.xDataCartItems[itemUniqueID] != undefined && this.xDataCartItems[itemUniqueID] != 0) {
            this.xDataCartItems[itemUniqueID] = this.xDataCartItems[itemUniqueID] - 1;
            if (this.xDataCartItems[itemUniqueID] == 0) {
                rmButton.classList.remove('text-yellow');
                rmButton.classList.add('text-white');
                rmButton.disabled = true;
            }
        }
    },
    updateItemInformation: function(itemUniqueID) {
        {{-- Condition for each item buttons and quantity display --}}
        let itemQuantity = document.getElementById(itemUniqueID);
        let rmButton = document.getElementById('rmButton-' + itemUniqueID);
        if (this.xDataCartItems[itemUniqueID] != undefined && this.xDataCartItems[itemUniqueID] != 0) {
            itemQuantity.classList.remove('text-white');
            itemQuantity.innerHTML = this.xDataCartItems[itemUniqueID] / 2;
            rmButton.classList.remove('text-white');
            rmButton.classList.add('text-yellow');
            rmButton.disabled = false;
        } else {
            itemQuantity.innerText = '--';
            rmButton.classList.remove('text-yellow');
            rmButton.classList.add('text-white');
            rmButton.disabled = true;
        }
        {{-- Condition for show-my-order button --}}
        let showMyOrder = document.getElementById('show-my-order');
        if ( (Object.values(this.xDataCartItems).reduce((a, b) => a + b, 0) == 0) ) {
            console.log('empty cart');
            showMyOrder.classList.add('hidden');
        } else {
            console.log('not empty cart');
            showMyOrder.classList.remove('hidden');
            console.log(showMyOrder);
        }

    },
    sessionStoreCartItems: function() {
        sessionStorage.setItem('emptyCart', this.xDataEmptyCart);
        sessionStorage.setItem('cartItems', JSON.stringify(this.xDataCartItems));
        console.log(this.xDataCartItems);
    },
}"
        x-on:update-active-section-page.window="activeSectionPage = $event.detail, fetchCategories($event.detail)"
        x-on:select-category.window="fetchItems($event.detail)"
        x-on:add-to-cart="addToCart($event.detail.uniqueId), updateItemInformation($event.detail.uniqueId);"
        x-on:remove-from-cart="removeFromCart($event.detail.uniqueId), updateItemInformation($event.detail.uniqueId);"
        x-on:test="
if (!ignoreEvent) {
    addToCart('test'), updateNoOfAddedToCart();
    ignoreEvent = true;
    setTimeout(() => { ignoreEvent = false }, 5000);
}"
        x-init="
() => {
    {{-- sessionStorage.setItem('xDataEmptyCart', true);
    sessionStorage.setItem('xDataCartItems', JSON.stringify({})); --}}
}
"
    >

        <div id="display-items">
        </div>

        <div id="display-categories"></div>

    <a @click="sessionStoreCartItems" href="{{ route('order.index', $restaurant->name) }}"
       class="w-[20rem] mb-1 fixed mx-auto left-0 right-0 bottom-3 bg-yellow rounded-full px-10 py-2 text-center hidden"
       id="show-my-order"
       >
        <div
            class="font-semibold text-lg text-white"
        >
            Show my order
        </div>
    </a>

</div>


</x-mobile-layout>
