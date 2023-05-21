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
        let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
        let emptyCart = sessionStorage.getItem('emptyCart');
        if (emptyCart == 'true') {
            cartItems = {};
            sessionStorage.setItem('emptyCart', false);
        }
        cartItems[itemUniqueID] = cartItems[itemUniqueID] + 1 || 1;
        sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
        let updatedCartItems = JSON.parse(sessionStorage.getItem('cartItems'));
    },
    updateNoOfAddedToCart: function() {
        let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
        let noOfAddedToCart = document.querySelectorAll('.no-of-added-to-cart');
        noOfAddedToCart.forEach((element) => {
            if (cartItems[element.id] != undefined && cartItems[element.id] != 0) {
                element.classList.remove('hidden');
                element.innerText = cartItems[element.id]/4;
            }
            else if (!element.classList.contains('hidden')) {
                element.classList.add('hidden');
            }
        });
    },
}"
x-on:update-active-section-page.window="activeSectionPage = $event.detail, fetchCategories($event.detail)"
x-on:select-category.window="fetchItems($event.detail)"
x-on:add-to-cart="addToCart($event.detail.uniqueId), updateNoOfAddedToCart();"
x-on:test="
if (!ignoreEvent) { 
    addToCart('test'), updateNoOfAddedToCart();
    ignoreEvent = true; 
    setTimeout(() => { ignoreEvent = false }, 5000); 
}"
x-init="
() => {
    sessionStorage.setItem('emptyCart', true);
    sessionStorage.setItem('cartItems', JSON.stringify({}));
}
"
>

    <div id="display-items">
    </div>

    <div id="display-categories"></div>

</div>
</x-mobile-layout>
