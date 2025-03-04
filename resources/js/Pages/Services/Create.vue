<script setup>
import ServiceForm from "@/Components/ServiceForm.vue";
const props = defineProps({
  categories: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="container">
    <h2 class="text-lg font-medium text-gray-900 mb-4">Create New Service</h2>
    <ServiceForm :categories="categories" />
  </div>
</template>
