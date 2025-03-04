<script setup>
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import InputField from "@/Components/InputField.vue";
import TextareaField from "@/Components/TextareaField.vue";

// Props
const props = defineProps({
  categories: {
    type: Object,
    required: true,
  },
  service: {
    type: Object,
    default: null,
  },
  isUpdate: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["success"]);

// Form initialization
const form = useForm({
  name: props.service?.name || "",
  slug_name: props.service?.slug_name || "",
  description: props.service?.description || "",
  duration: props.service?.duration_minutes || 60,
  price: props.service?.price || 0,
  category: props.service?.category || "0",
  is_active: props.service?.is_active ?? true,
});

// Duration presets
const durationPresets = [
  { value: 15, label: "15 min" },
  { value: 30, label: "30 min" },
  { value: 45, label: "45 min" },
  { value: 60, label: "1 hr" },
  { value: 90, label: "1 hr 30 min" },
  { value: 120, label: "2 hr" },
];

const buttonLabel = computed(() =>
  props.isUpdate ? "Update Service" : "Create Service"
);
const formTitle = computed(() =>
  props.isUpdate ? "Edit Service" : "Create New Service"
);

const submit = () => {
  if (props.isUpdate) {
    form.put(route("services.update", props.service.id), {
      onSuccess: () => emit("success"),
    });
  } else {
    form.post(route("services.store"));
  }
};
</script>

<template>
  <form @submit.prevent="submit">
    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
      <InputField
        v-model="form.name"
        label="Service Name"
        name="name"
        id="name"
        :error="form.errors.name"
        wrapperClass="sm:col-span-2"
      />

      <InputField
        v-model="form.slug_name"
        label="Slug Name"
        name="slug_name"
        id="slug_name"
        :error="form.errors.slug_name"
        wrapperClass="sm:col-span-2"
      />

      <div class="sm:col-span-2">
        <label for="category" class="block text-sm font-medium text-gray-700"
          >Category</label
        >
        <div class="mt-1">
          <select
            v-model="form.category"
            id="category"
            name="category"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md bg-white px-[14px] py-[10px]"
            :class="{ 'border-red-500': form.errors.category }"
          >
            <option value="0" select disabled>-- Select a category --</option>
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
        </div>
        <p v-if="form.errors.category" class="mt-2 text-sm text-red-600">
          {{ form.errors.category[0] }}
        </p>
      </div>

      <TextareaField
        v-model="form.description"
        label="Description"
        name="description"
        id="description"
        :rows="3"
        :error="form.errors.description"
        helperText="Brief description of the service."
        wrapperClass="sm:col-span-6"
      />

      <InputField
        v-model="form.duration"
        label="Duration (minutes)"
        name="duration"
        id="duration"
        type="number"
        :min="5"
        :step="5"
        :error="form.errors.duration"
        wrapperClass="sm:col-span-3"
      >
        <template #extra>
          <div class="mt-2 flex flex-wrap gap-2">
            <button
              v-for="preset in durationPresets"
              :key="preset.value"
              type="button"
              @click="form.duration = preset.value"
              class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              {{ preset.label }}
            </button>
          </div>
        </template>
      </InputField>

      <InputField
        v-model="form.price"
        label="Price"
        name="price"
        id="price"
        type="number"
        suffix="USD"
        :step="0.01"
        :min="0"
        :error="form.errors.price"
        wrapperClass="sm:col-span-3"
      />

      <div class="sm:col-span-6">
        <div class="flex items-start">
          <div class="flex items-center h-5">
            <input
              v-model="form.is_active"
              id="is_active"
              name="is_active"
              type="checkbox"
              class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
            />
          </div>
          <div class="ml-3 text-sm">
            <label for="is_active" class="font-medium text-gray-700">Active</label>
            <p class="text-gray-500">
              Set whether this service is currently available for booking.
            </p>
          </div>
        </div>
        <p v-if="form.errors.is_active" class="mt-2 text-sm text-red-600">
          {{ form.errors.is_active }}
        </p>
      </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
      <button
        type="submit"
        :disabled="form.processing"
        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
      >
        <span v-if="form.processing">Saving...</span>
        <span v-else>{{ buttonLabel }}</span>
      </button>
    </div>
  </form>
</template>
