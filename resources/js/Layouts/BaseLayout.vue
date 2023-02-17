<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Footer from "@/Components/Footer.vue";
import Navbar from "@/Components/Navbar.vue";

defineProps(["hideFooter"]);
</script>

<template>
  <div>
    <div class="bg-indigo-500 border-b border-gray-700 dark:bg-gray-800">
      <Navbar></Navbar>
    </div>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <!-- Page Heading -->
      <header class="bg-white shadow dark:bg-gray-800" v-if="$slots.header">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main class="pt-12">
        <slot />
      </main>

      <Footer :hide-footer="hideFooter"></Footer>
    </div>
  </div>
</template>
