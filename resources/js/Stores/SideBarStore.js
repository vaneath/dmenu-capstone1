import { defineStore} from 'pinia';

export let useSideBarStore = defineStore('sideBar', {
    state: () => ({
        sideBarOpen: false,
    }),

    actions: {
        toggleSideBar() {
            this.sideBarOpen = !this.sideBarOpen;
        }
    }
});
