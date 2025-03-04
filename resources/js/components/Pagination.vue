<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        pagination: Object
    })
</script>

<template>
    <div v-if="pagination && pagination.length > 3" class="px-4 py-3">
        <div class="hidden sm:flex-1 sm:flex sm:justify-end">
          <div>
            <nav class="relative flex justify-center gap-2" aria-label="Pagination">
              <Link
                v-for="(link, index) in pagination"
                :key="index"
                :href="link.url"
                preserve-scroll
                v-html="link.label"
                :class="[
                  'flex items-center justify-center px-3 py-2 text-sm rounded-lg text-gray-600',
                  link.url === null ? '!text-gray-300 cursor-not-allowed' : 'hover:bg-gray-50',
                  link.active ? 'bg-gray-200' : '',
                  index === 0 ? 'rounded-l-md' : '',
                  index === pagination.length - 1 ? 'rounded-r-md' : ''
                ]">
              </Link>
            </nav>
          </div>
        </div>
    </div>

</template>
