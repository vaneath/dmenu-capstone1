<x-mobile-layout
    :restaurant="$restaurant"
    :sections="$sections"
    :activeSectionPage="$activeSectionPage"
    :back="route('restaurant.index')"
    url="https://th.bing.com/th/id/R.93b95738cb630f899bacf7dd835b5ad5?rik=tTYET5ChbtekCw&riu=http%3a%2f%2fyesofcorsa.com%2fwp-content%2fuploads%2f2016%2f11%2f4K-Wallpapers-7.jpg&ehk=T6iESUSfpf9rlqxhPxnOLZKKmedMu0oOGAuICEPY%2fbo%3d&risl=&pid=ImgRaw&r=0"
>

    <div
        x-data="{
    ignoreEvent: false,
    xDataEmptyCart: true,
    xDataCartItems: {},
    restaurantName: '{{ $restaurant->name }}',
    handleCommonDisplay: function(commonDisplay) {
        console.log('hanldeCommonDisplay is called');
        document.getElementById('common-display').innerHTML = commonDisplay;
        localStorage.setItem('commonDisplay', JSON.stringify(commonDisplay));
        console.log('handleCommonDisplay', activeSectionPage);
        localStorage.setItem('activeSectionPage', activeSectionPage);
        localStorage.setItem('localRestaurantId', '{{ $restaurant->id }}');
    },
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
        {{-- document.getElementById('display-items').innerHTML = '';
        document.getElementById('display-categories').innerHTML = html; --}}
        this.handleCommonDisplay(html);
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
        {{-- document.getElementById('display-categories').innerHTML = '';
        document.getElementById('display-items').innerHTML = html; --}}
        this.handleCommonDisplay(html);
        })
        .catch(error => {
        console.warn('Error fetching HTML:', error);
        });
    },
    addToCart: function(foodItem) {
        console.log('addToCart is called', foodItem.id);
        if (this.xDataEmptyCart == 'true') {
            this.xDataCartItems = {};
        }
        if ( this.xDataCartItems[foodItem.id] == undefined ) {
            this.xDataCartItems[foodItem.id] = {};
            this.xDataCartItems[foodItem.id]['name'] = foodItem.name;
            this.xDataCartItems[foodItem.id]['price'] = foodItem.price;
            this.xDataCartItems[foodItem.id]['imgUrl'] = foodItem.imgUrl;
        }
        this.xDataCartItems[foodItem.id]['quantity'] = this.xDataCartItems[foodItem.id]['quantity'] + 1 || 1;
    },
    removeFromCart: function(foodItem) {
        console.log('removeFromCart is called');
        let rmButton = document.getElementById('rmButton-' + foodItem.id);
        if (this.xDataCartItems[foodItem.id] != undefined && this.xDataCartItems[foodItem.id]['quantity'] != 0) {
            this.xDataCartItems[foodItem.id]['quantity'] = this.xDataCartItems[foodItem.id]['quantity'] - 1;
            if (this.xDataCartItems[foodItem.id]['quantity'] == 0) {
                rmButton.classList.remove('text-yellow');
                rmButton.classList.add('text-white');
                rmButton.disabled = true;
            }
        }
    },
    updateItemInformation: function(foodItem) {
        let itemQuantity = document.getElementById(foodItem.id);
        let rmButton = document.getElementById('rmButton-' + foodItem.id);
        if (this.xDataCartItems[foodItem.id] != undefined && this.xDataCartItems[foodItem.id]['quantity'] != 0) {
            itemQuantity.classList.remove('text-white');
            itemQuantity.innerHTML = this.xDataCartItems[foodItem.id]['quantity'] / 2;
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
        x-on:update-active-section-page.window="
        if($event.detail.localCommonDisplay == null) {
            activeSectionPage = $event.detail.activeSectionPage;
            fetchCategories($event.detail.activeSectionPage);
        } else {
            activeSectionPage = $event.detail.activeSectionPage;
            handleCommonDisplay($event.detail.localCommonDisplay);
        }
        "
        x-on:select-category.window="fetchItems($event.detail);"
        x-on:add-to-cart="addToCart($event.detail), updateItemInformation($event.detail);"
        x-on:remove-from-cart="removeFromCart($event.detail), updateItemInformation($event.detail);"
        x-on:test="
if (!ignoreEvent) {
    addToCart('test'), updateNoOfAddedToCart();
    ignoreEvent = true;
    setTimeout(() => { ignoreEvent = false }, 5000);
}"
        x-init="
() => {
    {{-- let localCommonDisplay = JSON.parse(localStorage.getItem('commonDisplay'));
    localCommonDisplay = localCommonDisplay.trim();
    if(localCommonDisplay != undefined && localCommonDisplay != '' && localCommonDisplay != null && localCommonDisplay != 'null' && localCommonDisplay != 'undefined') {
        console.log('localCommonDisplay is not empty', localCommonDisplay);
        handleCommonDisplay(localCommonDisplay);
    } --}}
}
"
    >

        <div id="display-items">
        </div>

        <div id="display-categories"></div>

        <div id="common-display"></div>

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
