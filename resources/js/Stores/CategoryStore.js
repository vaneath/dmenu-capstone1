import { defineStore } from 'pinia';
export let useCategoryStore = defineStore('category', {
    state: () => ({
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
    }),
});
