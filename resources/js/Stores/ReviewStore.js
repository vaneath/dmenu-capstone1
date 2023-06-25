import { defineStore } from 'pinia';
export let useReviewStore = defineStore('review', {
    state: () => ({
        review: {
            nickname: null,
            overall_rating: 0,
            overall_food_rating: null,
            overall_service_rating: null,
            overall_ambience_rating: null,
            overall_price_rating: null,
            comment: null,
            contact_name: null,
            contact_phone: null,
            contact_email: null,
        },
        itemReviews: [],
    }),
    actions: {
        updateReview(attribute, value) {
            this.review[attribute] = value;
        },
        getReview() {
            return this.review;
        }
    }
});