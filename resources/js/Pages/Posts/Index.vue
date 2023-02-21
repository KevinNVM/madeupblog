<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import LayoutCard from "@/Components/LayoutCard.vue";
import Pagination from "@/Shared/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref } from "@vue/reactivity";
import PostsCard from "@/Components/PostsCard.vue";
import PostFilters from "@/Components/PostFilters.vue";

const props = defineProps({
  posts: Object,
  title: {
    type: String,
    default: "Posts",
  },
});

const searchQuery = ref("");
const authorQuery = ref("");
const categoryQuery = ref("");

const showSearchButton = ref(false);
const setShowSearchButton = (e) =>
  (showSearchButton.value = e.target.value.length >= 1);
const resetSearchQuery = () => (searchQuery.value = "");
const handleSubmit = () => {
  router.visit(
    `?category=${categoryQuery.value}&author=${authorQuery.value}&search=${searchQuery.value}`,
    {
      only: ["posts"],
      preserveState: true,
    }
  );
};

const pushUrl = (value) => {
  const { author, category } = {
    ...value,
    category: value.category?.join(","),
  };
  authorQuery.value = author;
  categoryQuery.value = category;
  router.visit(
    `?category=${categoryQuery.value}&author=${authorQuery.value}&search=${searchQuery.value}`,
    {
      only: ["posts"],
      preserveState: true,
    }
  );
};
</script>


<template>
  <Head>
    <title>{{ title }}</title>
    <meta name="description" content="all posts" />
  </Head>

  <BaseLayout>
    <template #header>
      <form
        class="relative flex w-full gap-2 m-0 h-9"
        @submit.prevent="handleSubmit"
      >
        <input
          type="text"
          class="
            w-full
            text-xl
            font-semibold
            leading-tight
            text-gray-800
            bg-transparent
            border-0
            rounded-t
            border-b-black
            dark:border-b-white
            focus:ring-0
            dark:text-gray-200
            outline-0
            focus:bg-transparent
            hover:bg-transparent
            active:bg-transparent
            before:bg-transparent
            focus:border-b-2 focus:outline-0 focus:caret-indigo-700
          "
          name="search"
          placeholder="Search..."
          v-model="searchQuery"
          @input="setShowSearchButton"
        />

        <Transition>
          <div
            class="absolute top-0 bottom-0 right-0"
            v-show="showSearchButton"
          >
            <div class="flex items-center gap-2">
              <button type="button" @click="resetSearchQuery">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-8 h-8 dark:text-gray-500 active:scale-95"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
              <SecondaryButton type="submit">Search</SecondaryButton>
            </div>
          </div>
        </Transition>
      </form>
    </template>

    <LayoutCard>
      <PostFilters @push-url="pushUrl" />
    </LayoutCard>

    <template v-if="posts.data.length >= 1">
      <PostsCard :posts="posts.data"></PostsCard>
    </template>
    <LayoutCard v-else>
      <h2 class="font-semibold text-gray-500">There are no posts to show.</h2>
    </LayoutCard>
    <div class="grid place-items-center">
      <Pagination :links="posts.links" />
    </div>
  </BaseLayout>
</template>
