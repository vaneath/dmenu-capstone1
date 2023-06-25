import { defineStore } from 'pinia';
export let useRestaurantStore = defineStore('restaurant', {
    state: () => ({
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
    }),
});
