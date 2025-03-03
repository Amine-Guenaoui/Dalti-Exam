<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const showMobileMenu = ref(false);

const navigation = [
  { name: "Dashboard", href: "#", icon: "heroicon-o-home" },
  {
    name: "Services",
    href: "/services",
    icon: "heroicon-o-clipboard-document-list",
  },
  { name: "Bookings", href: "#", icon: "heroicon-o-calendar" },
];

const toggleMobileMenu = () => {
  showMobileMenu.value = !showMobileMenu.value;
};
</script>

<template>
  <div class="max-h-[60px] bg-gray-100 shadow-sm">
    <div class="top-0 z-10 flex h-16 bg-white shadow w-full">
      <div class="w-full flex justify-center items-center px-4">
        <div class="absolute left-0 ml-5">
          <h1 class="text-xl font-bold text-indigo-600 self-center">Booking System</h1>
        </div>

        <nav class="flex items-center flex-row">
          <Link
            v-for="item in navigation"
            :key="item.name"
            :href="item.href"
            :class="[
              $page.component.includes(item.name)
                ? 'bg-indigo-50 text-indigo-600'
                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900',
              'group flex items-center justify-center px-2 h-[63px] w-[100px] text-sm font-medium',
            ]"
          >
            {{ item.name }}
          </Link>
        </nav>
      </div>
    </div>

    <main class="flex-1">
      <div class="container-sm">
        <div class="mx-auto max-w-7xl mt-5 px-4 sm:px-6 md:px-8">
          <slot></slot>
        </div>
      </div>
    </main>
  </div>
</template>
