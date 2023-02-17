
<template>
  <div class="py-4">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div
        class="
          overflow-hidden
          bg-white
          shadow-sm
          dark:bg-gray-800
          sm:rounded-lg
        "
      >
        <div
          class="text-gray-900 dark:text-gray-100"
          :class="{ 'p-6': usePadding }"
        >
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  usePadding: {
    type: Boolean,
    default: true,
  },
});
</script>
