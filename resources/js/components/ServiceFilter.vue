<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import debounce from "lodash/debounce";
import InputField from "@/Components/InputField.vue";

const props = defineProps({
  filters: {
    type: Object,
    default: () => ({
      search: "",
      category: "",
      status: "",
    }),
  },
});

const search = ref(props.filters.search || "");
const category = ref(props.filters.category || "");
const status = ref(props.filters.status || "");

// Categories could be fetched from the backend as well
const categories = [
  { id: "", name: "All Categories" },
  { id: "cleaning", name: "Cleaning" },
  { id: "consultation", name: "Consultation" },
  { id: "treatment", name: "Treatment" },
  { id: "maintenance", name: "Maintenance" },
];

const statuses = [
  { id: "", name: "All Statuses" },
  { id: "active", name: "Active" },
  { id: "inactive", name: "Inactive" },
];

// Apply filters with debounce
const applyFilters = debounce(() => {
  router.get(
    route("services.index"),
    {
      search: search.value,
      category: category.value,
      status: status.value,
    },
    { preserveState: true }
  );
}, 300);

// Watch for changes in filter values
watch([search, category, status], () => {
  applyFilters();
});

const resetFilters = () => {
  search.value = "";
  category.value = "";
  status.value = "";
  applyFilters();
};
</script>

<template>
  <div class="bg-white shadow rounded-lg p-4 mb-4">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
      <!-- <div>
        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
        <input v-model="search" type="text" name="search" id="search"
          class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          placeholder="Search by name or description">
      </div> -->
      <InputField v-model="search" label="Search" name="search" id="search" />

      <div>
        <label for="category" class="block text-sm font-medium text-gray-700"
          >Category</label
        >
        <select
          v-model="category"
          id="category"
          name="category"
          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        >
          <option
            v-for="categoryOption in categories"
            :key="categoryOption.id"
            :value="categoryOption.id"
          >
            {{ categoryOption.name }}
          </option>
        </select>
      </div>

      <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select
          v-model="status"
          id="status"
          name="status"
          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        >
          <option
            v-for="statusOption in statuses"
            :key="statusOption.id"
            :value="statusOption.id"
          >
            {{ statusOption.name }}
          </option>
        </select>
      </div>
    </div>

    <div class="mt-4 flex justify-end">
      <button
        @click="resetFilters"
        type="button"
        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
      >
        Reset Filters
      </button>
    </div>
  </div>
</template>
