<script setup>
import ServiceForm from "@/Components/ServiceForm.vue";
const props = defineProps({
  categories: {
    type: Object,
    required: true,
  },
  service: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="container">
    <h2 class="text-lg font-medium text-gray-900 mb-4">Edit Service</h2>
    <ServiceForm :categories="categories" :service="service" :isUpdate="true" />
  </div>
</template>
