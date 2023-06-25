import { defineStore } from 'pinia';
export let useTableStore = defineStore('table', {
    state: () => ({
        table_no: '',
    }),
});
