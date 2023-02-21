<template>
  <nav class="container p-6 mx-auto md:flex md:justify-between md:items-center">
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
      >
        <ApplicationLogo
          class="block w-auto text-gray-200 fill-current h-9 dark:text-gray-800"
        />
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
        md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0
      "
    >
      <li class="text-gray-100 dark:hover:text-indigo-400 hover:text-gray-300">
        <Dropdown align="left">
          <template #trigger>
            <div role="button">Posts</div>
          </template>

          <template #content>
            <DropdownLink :href="route('posts.index')">All Posts </DropdownLink>
            <DropdownLink :href="route('categories.index')"
              >Categories
            </DropdownLink>
          </template>
        </Dropdown>
      </li>
      <li class="text-gray-100 dark:hover:text-indigo-400 hover:text-gray-300">
        <Link href="/about">About</Link>
      </li>
      <li class="text-gray-100 dark:hover:text-indigo-400 hover:text-gray-300">
        <Link
          :href="$page.props.auth.user ? route('dashboard') : route('login')"
          >{{ $page.props.auth.user ? "Dashboard" : "Login" }}</Link
        >
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { Link } from "@inertiajs/vue3";
import DropdownLink from "./DropdownLink.vue";
import Dropdown from "./Dropdown.vue";
import ApplicationLogo from "./ApplicationLogo.vue";

const showMenu = ref(false);
const toggleNav = () => (showMenu.value = !showMenu.value);
</script>
