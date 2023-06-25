<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';
import { onUnmounted, onMounted } from 'vue';

// define the props
const props = defineProps({
  user_id: {
    type: String,
    required: true,
  },
  role: {
    type: String,
    required: true,
  },
    orders: {
        type: Array,
        required: true,
    }
});

import { ref } from 'vue';
import axios from 'axios';
import DashboardCard from "@/Pages/Dashboard/Partials/DashboardCard.vue";

const userId = props.user_id; // get the user id from the props

const statistics = ref(null); // initialize the statistics data
const isLoading = ref(true); // initialize the loading state

// define the function to fetch the statistics
const fetchStatistics = async () => {
  try {
    const response = await axios.get(`/api/users/${userId}/statistics`);
    statistics.value = response.data.statistics;
  } catch (error) {
    console.error(error);
  } finally {
    isLoading.value = false; // set loading state to false after fetch completes
  }
};

// start polling every 1 seconds using setInterval
const pollInterval = setInterval(fetchStatistics, 2000);

fetchStatistics();

// stop polling when the component is unmounted
onUnmounted(() => {
  clearInterval(pollInterval);
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout v-if="isLoading"></AuthenticatedLayout>

  <AuthenticatedLayout v-if="!isLoading && role === 'admin'">
      <DashboardCard :statistics="statistics" :user_id="user_id" :orders="orders"/>
  </AuthenticatedLayout>

</template>
