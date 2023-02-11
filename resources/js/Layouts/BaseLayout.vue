<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
const showMenu = ref(false);
const toggleNav = () => (showMenu.value = !showMenu.value);
</script>

<template>
  <div>
    <div class="bg-indigo-500 border-b border-gray-700 dark:bg-gray-800">
      <nav
        class="container p-6 mx-auto md:flex md:justify-between md:items-center"
      >
        <div class="flex items-center justify-between">
          <Link
            href="/"
            class="
              text-xl
              font-bold
              text-gray-100
              md:text-2xl
              hover:text-indigo-400
            "
            >Logo
          </Link>
          <!-- Mobile menu button -->
          <div @click="toggleNav" class="flex md:hidden">
            <button
              type="button"
              class="
                text-gray-100
                hover:text-gray-400
                focus:outline-none focus:text-gray-400
              "
            >
              <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                <path
                  fill-rule="evenodd"
                  d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                ></path>
              </svg>
            </button>
          </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <ul
          :class="showMenu ? 'flex' : 'hidden'"
          class="
            flex-col
            mt-8
            space-y-4
            md:flex
            md:space-y-0
            md:flex-row
            md:items-center
            md:space-x-10
            md:mt-0
          "
        >
          <li class="text-gray-100 hover:text-indigo-400">
            <Link :href="route('posts.index')">Posts</Link>
          </li>
          <li class="text-gray-100 hover:text-indigo-400">
            <Link href="/about">About</Link>
          </li>
        </ul>
      </nav>
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

      <footer class="mt-20 bg-white shadow dark:bg-gray-800">
        <div class="flex flex-col px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <h2
            class="
              text-xl
              font-semibold
              leading-tight
              text-gray-800
              dark:text-white
            "
          >
            {{ $inertia.page.props.appName }}
          </h2>
          <p class="text-sm text-gray-800 dark:text-white">
            &copy; Copyright {{ new Date().getFullYear() }}
          </p>
        </div>
      </footer>
    </div>
  </div>
</template>
