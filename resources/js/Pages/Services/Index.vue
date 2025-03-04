<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import ServiceTable from "@/Components/ServiceTable.vue";
import ServiceFilter from "@/Components/ServiceFilter.vue";

const props = defineProps({
  services: {
    type: Object,
    required: true,
  },
  categories: {
    type: Object,
    required: false,
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<template>
  <div class="sm:flex sm:items-center justify-between mb-8">
    <div>
      <h1 class="text-2xl font-semibold text-gray-900">Services</h1>
      <p class="mt-2 text-sm text-gray-700">
        Manage your service offerings for your booking system
      </p>
    </div>
    <div class="mt-4 sm:mt-0">
      <Link
        href="services/create"
        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
      >
        <svg
          class="-ml-1 mr-2 h-5 w-5"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 4.5v15m7.5-7.5h-15"
          />
        </svg>
        Add Service
      </Link>
    </div>
  </div>

  <ServiceFilter :categories="categories" :filters="filters" class="mb-5" />

  <ServiceTable :services="services" />
</template>
