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

defineProps({
  hideFooter: Boolean,
  showProgressBar: { default: false, type: Boolean },
});

const toTop = () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
};

const updateProgressBar = () => {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height =
    document.documentElement.scrollHeight -
    document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBar").style.width = scrolled + "%";
};

const showFloatingButton = ref(false);
onMounted(() => {
  window.onscroll = () => {
    showFloatingButton.value = window.scrollY > 100;
    updateProgressBar();
  };
});
</script>



<template>
  <div>
    <div
      class="bg-indigo-500 border-b border-gray-700 dark:bg-gray-800 sticky top-0 z-50"
    >
      <Navbar></Navbar>
      <div
        class="progress-container"
        v-show="showFloatingButton && showProgressBar"
      >
        <div class="progress-bar bg-indigo-400" id="myBar"></div>
      </div>
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

.progress-container {
  width: 100%;
  height: 8px;
  background: #ccc;
}

.progress-bar {
  height: 8px;
  transition: all 50ms ease-in-out;
  width: 0%;
}
</style>
