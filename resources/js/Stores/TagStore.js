import { defineStore } from 'pinia';
export let useTagStore = defineStore('tag', {
    state: () => ({
        showCreateModal: false,
        showEditModal: false,
        showDeleteModal: false,
    }),
});
