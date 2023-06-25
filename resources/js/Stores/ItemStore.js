import { defineStore } from 'pinia';

export let useItemStore = defineStore('item', {
    state: () => ({
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
    }),
});
