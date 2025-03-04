<script setup>
import { defineProps, defineModel, computed } from "vue";

const model = defineModel({ type: [String, Number, Boolean] });

const props = defineProps({
  label: String,
  name: String,
  id: String,
  error: String,
  helperText: String,
  min: Number,
  step: Number,
  rows: Number,
  prefix: String,
  suffix: String,
  wrapperClass: { type: String, default: "" },
});

const inputClasses = computed(() => {
  return `shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md pl-${
    props.prefix ? "7" : "3"
  } pr-${props.suffix ? "12" : "3"}`;
});
</script>

<template>
  <div :class="wrapperClass">
    <label :for="id" class="block text-sm font-medium text-gray-700">{{ label }}</label>
    <div class="mt-1 relative">
      <div
        v-if="prefix"
        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
      >
        <span class="text-gray-500 sm:text-sm">{{ prefix }}</span>
      </div>
      <textarea
        v-model="model"
        :id="id"
        :name="name"
        :rows="rows"
        :min="min"
        :step="step"
        :class="[
          inputClasses,
          'bg-white rounded-lg px-[14px] py-[10px] border border-grey-light-100 text-md text-subtlest placeholder-subtlest w-full !h-auto shadow-sm',
          error ? 'border-red-500' : '',
        ]"
        v-bind="$attrs"
      ></textarea>
      <div
        v-if="suffix"
        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
      >
        <span class="text-gray-500 sm:text-sm">{{ suffix }}</span>
      </div>
    </div>

    <slot name="extra"></slot>

    <p v-if="helperText" class="mt-2 text-sm text-gray-500">{{ helperText }}</p>
    <p v-if="error" class="mt-2 text-sm text-red-600">{{ error[0] }}</p>
  </div>
</template>
