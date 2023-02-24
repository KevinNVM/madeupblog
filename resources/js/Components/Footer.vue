<template>
  <footer v-show="!hideFooter" class="mt-20 bg-white shadow dark:bg-gray-800">
    <div
      class="flex justify-between px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8"
    >
      <div>
        <h2
          class="text-xl font-semibold leading-tight text-gray-800 dark:text-white"
        >
          {{ $inertia.page.props.appName }}
        </h2>
        <p class="text-sm text-gray-800 dark:text-white">
          &copy; Copyright {{ new Date().getFullYear() }}
        </p>
      </div>
      <ToggleDarkmode />
    </div>
  </footer>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ToggleDarkmode from "./ToggleDarkmode.vue";

defineProps({
  hideFooter: {
    type: Boolean,
    default: false,
  },
});
</script>
