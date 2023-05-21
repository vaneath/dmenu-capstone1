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
    restaurantName: '{{ $restaurant->name }}',
    fetchCategories: function(sectionId){
        if (sectionId == 0) {
            document.getElementById('display-section').innerHTML = '';
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
        document.getElementById('display-section').innerHTML = html;
        })
        .catch(error => {
        console.warn('Error fetching HTML:', error);
        });
    },
    fetchItems: function(categoryId){
        if (categoryId == 0) {
            document.getElementById('display-section').innerHTML = '';
            return;
        }
        // path : '/restaurants/' + this.restaurantName + '/menu/' + categoryId + '/items'
        fetch('/restaurants/' + this.restaurantName + '/menu/' + categoryId + '/items')
        .then(response => response.text())
        .then(html => {
        document.getElementById('display-section').innerHTML = html;
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
        console.log('items to be added', cartItems);
        sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
        //sessionStorage.setItem('cartItems', JSON.stringify('abc'));

        let updatedCartItems = JSON.parse(sessionStorage.getItem('cartItems'));
        console.log('updated cart items', updatedCartItems);

        console.log('Stringified cart items', JSON.stringify(cartItems));
    },
    updateNoOfAddedToCart: function() {
        let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
        console.log(cartItems);
        let noOfAddedToCart = document.querySelectorAll('.no-of-added-to-cart');
        noOfAddedToCart.forEach((element) => {
            element.classList.remove('hidden');
            element.innerText = cartItems[element.id];
            console.log(cartItems[element.id], element.id);
        });
    },
}"
x-on:update-active-section-page.window="activeSectionPage = $event.detail, fetchCategories($event.detail)"
x-on:select-category.window="fetchItems($event.detail)"
x-on:add-to-cart="addToCart($event.detail.uniqueId), updateNoOfAddedToCart();"
x-on:test="
if (!ignoreEvent) { 
    addToCart('test'), updateNoOfAddedToCart();
    console.log('Event received'); 
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

    <div id="display-section">
    </div>

</div>
</x-mobile-layout>
