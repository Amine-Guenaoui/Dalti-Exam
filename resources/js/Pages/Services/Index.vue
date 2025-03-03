<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
// import Layout from '@/Layouts/Layout.vue';
import ServiceTable from "@/Components/ServiceTable.vue";
import ServiceFilter from "@/Components/ServiceFilter.vue";
// import Modal from '@/Components/Modal.vue';

const props = defineProps({
  services: {
    type: Object,
    required: true,
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
});

const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const currentService = ref(null);

const openCreateModal = () => {
  showCreateModal.value = true;
};

const openEditModal = (service) => {
  currentService.value = service;
  showEditModal.value = true;
};

const openDeleteModal = (service) => {
  currentService.value = service;
  showDeleteModal.value = true;
};

const handleDelete = () => {
  router.delete(route("services.destroy", currentService.value.id), {
    onSuccess: () => {
      showDeleteModal.value = false;
    },
  });
};

const closeModals = () => {
  showCreateModal.value = false;
  showEditModal.value = false;
  showDeleteModal.value = false;
  currentService.value = null;
};
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

  <ServiceFilter :filters="filters" class="mb-6" />

  <ServiceTable :services="services" @edit="openEditModal" @delete="openDeleteModal" />

  <!-- Edit Service Modal -->
  <!-- <Modal :show="showEditModal" @close="closeModals" maxWidth="2xl">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Edit Service</h2>
        <ServiceForm
          v-if="currentService"
          :service="currentService"
          :is-update="true"
          @success="closeModals"
        />
      </div>
    </Modal> -->
</template>
