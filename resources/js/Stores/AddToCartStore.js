import { update } from 'lodash';
import { defineStore } from 'pinia';
export let useAddToCartStore = defineStore('add-to-cart', {
    state: () => ({
        total: 0,
        items: [],
    }),
    actions: {
        addToCart(item) {
            item['quantity'] = 1;
            item['amount'] = item.price;
            this.items.push(item);
            this.updateTotal();
        },
        removeFromCart(item) {
            this.items.splice(this.items.indexOf(item), 1);
            this.updateTotal();
        },
        listCartItems() {
            return this.items;
        },
        incrementItemQuantity(item) {
            item.quantity++;
            item.amount = item.price * item.quantity;
            this.items.splice(this.items.indexOf(item), 1, item);
            this.updateTotal();
        },
        decrementItemQuantity(item) {
            if(item.quantity > 0) {
                item.quantity--;
                item.amount = item.price * item.quantity;
                this.items.splice(this.items.indexOf(item), 1, item);
                this.updateTotal();
            }
        },
        clearCart() {
            this.items = [];
            this.total = 0;
        },
        updateTotal() {
            this.total = this.items.length === 0 ? 0 : this.items.reduce((accumulator, currentValue) => accumulator + Number(currentValue.amount), 0);
        },
        getTotal() {
            console.log(this.total);
            return this.total;
        }
    }
});
