<template>
  <div>
    <button
      role="button"
      class="
        font-semibold
        md:text-lg
        active:scale-95
        transiton
        flex
        gap-2
        items-center
        transition
        duration-300
      "
      :class="{ 'border-b-2 border-spacing-2 border-indigo-300': showFilters }"
      @click="toggleFilters"
    >
      Filters
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
          d="M19.5 8.25l-7.5 7.5-7.5-7.5"
        />
      </svg>
    </button>
    <Transition>
      <form
        @submit.prevent="$emit('push-url', filters)"
        v-show="showFilters"
        class="flex flex-col md:flex-row flex-wrap md:items-center"
      >
        <input type="hidden" name="categories" :value="filters.category" />
        <div class="mb-4 md:w-1/2 px-1" aria-label="categories filter">
          <label for="category">Category</label>
          <v-select
            id="category"
            multiple
            :options="categoryOptions"
            :reduce="(value) => value.value"
            placeholder="Choose Categories"
            v-model="filters.category"
          ></v-select>
        </div>
        <div
          class="mb-4 md:w-1/2 px-1 flex flex-col"
          aria-label="categories filter"
        >
          <label for="author">Author</label>
          <TextInput
            id="author"
            placeholder="Enter author username"
            v-model="filters.author"
            class="p-2 border"
            name="author"
          />
        </div>
        <div class="mb-4 w-full flex flex-col" aria-label="categories filter">
          <SecondaryButton type="submit" class="grid">Apply</SecondaryButton>
        </div>
      </form>
    </Transition>
  </div>
</template>

<script setup>
import { router } from "@inertiajs/core";
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import SecondaryButton from "./SecondaryButton.vue";
import TextInput from "./TextInput.vue";

const showFilters = ref(false);
const toggleFilters = () => (showFilters.value = !showFilters.value);

let categoryOptions = [];
const fetchPostCategories = async () => {
  const response = await fetch(route("posts.actions.getCategories"));
  const data = await response.json();
  console.log(data);
  return data;
};
onMounted(async () => {
  categoryOptions = await fetchPostCategories();
});

const filters = ref({
  category: [],
  author: "",
});
</script>

<style>
@import "vue-select/dist/vue-select.css";
</style>
