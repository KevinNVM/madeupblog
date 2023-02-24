<template>
  <div>
    <button
      role="button"
      class="flex items-center gap-2 font-semibold transition duration-300 md:text-lg active:scale-95 transiton"
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
        class="flex flex-col flex-wrap md:flex-row md:items-center"
      >
        <input type="hidden" name="categories" :value="filters.category" />
        <div class="px-1 mb-4 md:w-1/2" aria-label="categories filter">
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
          class="flex flex-col px-1 mb-4 md:w-1/2"
          aria-label="categories filter"
        >
          <label for="author">Author</label>
          <TextInput
            id="author"
            placeholder="Enter author name"
            v-model="filters.author"
            class="p-2 border"
            name="author"
          />
        </div>
        <div class="flex flex-col w-full mb-4" aria-label="categories filter">
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
const { categories } = defineProps({ categories: Array });

let categoryOptions = categories?.map((category) => ({
  label: category.name,
  value: category.slug,
}));

const filters = ref({
  category: [],
  author: "",
});
</script>

<style>
@import "vue-select/dist/vue-select.css";
</style>
