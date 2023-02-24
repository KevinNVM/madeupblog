<script setup>
import Navbar from "@/Components/Navbar.vue";
import { Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import AOS from "aos";

onMounted(() => {
  AOS.init();
});
</script>

<template>
  <main class="relative h-screen overflow-hidden">
    <div class="bg-indigo-500 dark:bg-gray-700">
      <Navbar></Navbar>
    </div>
    <div class="relative z-20 flex items-center bg-white dark:bg-gray-800">
      <div
        class="container relative flex flex-col items-center justify-between px-6 py-16 mx-auto"
      >
        <div class="flex flex-col">
          <h1
            data-aos="slide-up"
            class="w-full text-4xl font-light text-center uppercase sm:text-5xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-pink-500"
          >
            Blogging Website Built With Laravel 9
          </h1>
          <h2
            class="w-full max-w-2xl py-8 mx-auto text-xl font-light text-center text-gray-500 dark:text-white"
            data-aos="slide-up"
            data-aos-delay="50"
          >
            The construction of <b>madeupblog</b> primarily relied on
            <a target="_blank" href="//php.net" class="text-blue-500">PHP</a>,
            complemented by the
            <a target="_blank" href="//laravel.com" class="text-red-400"
              >Laravel</a
            >
            framework. By integrating
            <a target="_blank" href="//inertiajs.com" class="text-amber-500"
              >InertiaJS</a
            >
            into
            <a target="_blank" href="//laravel.com" class="text-red-400"
              >Laravel</a
            >, the website was seamlessly connected from the
            <a target="_blank" href="//php.net" class="text-blue-500">PHP</a>
            backend to the
            <a target="_blank" href="//vuejs.org" class="text-green-500"
              >VueJS</a
            >
            frontend, bridging the gap between these two programming languages.
          </h2>
          <div class="flex items-center justify-center mt-4">
            <Link
              href="/"
              type="button"
              class="px-4 py-2 mr-4 text-white uppercase bg-gray-800 border-2 border-transparent text-md hover:bg-gray-900 dark:bg-gray-900 transition duration-300 focus:ring-4 focus:ring-indigo-400/50 ring-0 ring-offset-2"
              data-aos="slide-up"
              data-aos-delay="0"
            >
              Home Page
            </Link>
            <a
              type="button"
              href="https://github.com/KevinNVM/madeupblog"
              class="px-4 py-2 text-gray-800 uppercase bg-transparent border-2 border-gray-800 dark:text-white hover:bg-gray-800 hover:text-white text-md dark:hover:bg-gray-900 transition duration-300 focus:ring-4 focus:ring-indigo-400/50 ring-0 ring-offset-2"
              data-aos="slide-up"
              data-aos-delay="50"
            >
              Source Code
            </a>
          </div>
        </div>
        <div class="relative block w-full mx-auto mt-6 md:mt-0">
          <img
            src="/images/Blogging.svg"
            class="max-w-xs m-auto md:max-w-2xl"
          />
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
a:not([type="button"]) {
  text-decoration: underline;
}
b {
  font-weight: 900;
}
</style>
