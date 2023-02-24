<script setup>
import { onMounted, ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Footer from "@/Components/Footer.vue";
import Navbar from "@/Components/Navbar.vue";

defineProps(["hideFooter"]);

const toTop = () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
};

const showFloatingButton = ref(false);
onMounted(() => {
  window.onscroll = () => (showFloatingButton.value = window.scrollY > 200);
});
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
      <slot name="heading" />
      <Transition mode="out-in" name="scale" appear>
        <main class="pt-12" :key="$page.url">
          <slot />
        </main>
      </Transition>

      <Footer :hide-footer="hideFooter"></Footer>
    </div>
    <div id="floating_button" class="fixed bottom-10 right-10 float-container">
      <Transition>
        <button
          v-show="showFloatingButton"
          @click="toTop"
          class="p-4 text-lg font-semibold transition duration-300 bg-teal-200 rounded-full active:scale-90 active:shadow-2xl"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75"
            />
          </svg>
        </button>
      </Transition>
    </div>
  </div>
</template>

<style scoped>
.scale-enter-active,
.scale-leave-active {
  transition: all 0.5s ease;
}
.scale-enter-from,
.scale-leave-to {
  opacity: 0;
  transform: scale(0.9);
}
</style>
