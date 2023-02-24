<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Link, router, Head } from "@inertiajs/vue3";
import { escapeHTML, getPostThumbnail } from "@/Plugin/plugins";
import { ref } from "vue";
import LayoutCard from "@/Components/LayoutCard.vue";

const props = defineProps({
  latest_articles: Array,
  popular_articles: Array,
  new_comers: Array,
  title: String,
});

const searchInput = ref("");
const searchPost = () => {
  router.visit(`/posts?search=${searchInput.value}`);
};
</script>

<template>
  <Head>
    <title>{{ title }}</title>
  </Head>

  <BaseLayout>
    <LayoutCard>
      <div class="w-full p-6 bg-transparent md:p-12">
        <div
          class="flex flex-col items-end justify-between mb-12 md:flex-row header"
        >
          <div class="title">
            <p class="mb-4 text-4xl font-bold text-gray-800 dark:text-gray-100">
              Lastest articles
            </p>
            <p class="text-2xl font-light text-gray-400">
              So you can get your latest made up articles faster.
            </p>
          </div>
          <div class="text-end">
            <form
              class="inset-0 flex flex-col w-full gap-2 md:flex-row"
              @submit.prevent.stop="searchPost"
            >
              <div class="relative">
                <input
                  type="text"
                  name="search"
                  id="search-post"
                  v-model="searchInput"
                  class="flex-1 w-full px-4 py-2 text-base text-gray-700 placeholder-gray-400 bg-white border border-transparent border-gray-300 rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent"
                  placeholder="Enter a title"
                />
              </div>
              <button
                class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-indigo-200"
                type="submit"
              >
                Search
              </button>
            </form>
          </div>
        </div>
        <div
          class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3 lg:gap-12"
        >
          <template v-for="(post, i) in latest_articles" :key="post.id + i">
            <div
              class="m-auto overflow-hidden transition duration-300 rounded-lg shadow-lg dark:shadow-gray-700 cursor-pointer h-90 md:w-80 hover:scale-110"
            >
              <Link :href="`/posts/${post.slug}`" class="block w-full h-full">
                <img
                  alt="blog photo"
                  :src="
                    getPostThumbnail(post) ??
                    `https://www.tailwind-kit.com/images/blog/${i + 1}.jpg`
                  "
                  class="object-cover w-full max-h-40"
                />
                <div class="w-full p-4 bg-white dark:bg-gray-800">
                  <p class="font-medium text-indigo-500 text-md">
                    {{ post.category.name }}
                  </p>
                  <p
                    :title="post.title"
                    class="line-clamp-2 mb-2 text-xl font-medium text-gray-800 dark:text-white"
                  >
                    {{ post.title }}
                  </p>
                  <p
                    class="font-light text-gray-400 dark:text-gray-300 text-md line-clamp-3"
                    v-text="
                      escapeHTML(
                        post.body
                          .trim()
                          .substr(0, post.body.length * 0.5)
                          .concat('...'),
                        true
                      )
                    "
                  ></p>
                  <div class="flex items-center mt-4">
                    <div href="#" class="relative block">
                      <img
                        :alt="post.user.name"
                        :src="post.user.profile_photo_url"
                        class="object-cover w-10 h-10 mx-auto rounded-full"
                      />
                    </div>
                    <div class="flex flex-col justify-between ml-4 text-sm">
                      <p class="text-gray-800 dark:text-white">
                        {{ post.user.name }}
                      </p>
                      <p class="text-gray-400 dark:text-gray-300">
                        {{ post.created_time }} - {{ post.read_time }} min read
                      </p>
                    </div>
                  </div>
                </div>
              </Link>
            </div>
          </template>
        </div>
      </div>
    </LayoutCard>
    <LayoutCard>
      <div class="w-full p-6 bg-transparent md:p-12">
        <div
          class="flex flex-col items-end justify-between mb-12 md:flex-row header"
        >
          <div class="title">
            <p class="mb-4 text-4xl font-bold text-gray-800 dark:text-gray-100">
              Popular Articles
            </p>
            <p class="text-2xl font-light text-gray-400">
              Seems more trusted huh?
            </p>
          </div>
        </div>
        <div
          class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3 lg:gap-12"
        >
          <template v-for="(post, i) in popular_articles" :key="post.id + i">
            <div
              class="m-auto overflow-hidden transition duration-300 rounded-lg shadow-lg dark:shadow-gray-700 cursor-pointer h-90 md:w-80 hover:scale-110"
            >
              <Link :href="`/posts/${post.slug}`" class="block w-full h-full">
                <img
                  alt="blog photo"
                  :src="
                    getPostThumbnail(post) ??
                    `https://www.tailwind-kit.com/images/blog/${i + 1}.jpg`
                  "
                  class="object-cover w-full max-h-40"
                />
                <div class="w-full p-4 bg-white dark:bg-gray-800">
                  <p class="font-medium text-indigo-500 text-md">
                    {{ post.category.name }} - {{ post.views }} Views
                  </p>
                  <p
                    :title="post.title"
                    class="line-clamp-2 mb-2 text-xl font-medium text-gray-800 dark:text-white"
                  >
                    {{ post.title }}
                  </p>
                  <p
                    class="font-light text-gray-400 dark:text-gray-300 text-md line-clamp-3"
                    v-text="
                      escapeHTML(
                        post.body
                          .trim()
                          .substr(0, post.body.length * 0.5)
                          .concat('...'),
                        true
                      )
                    "
                  ></p>
                  <div class="flex items-center mt-4">
                    <div href="#" class="relative block">
                      <img
                        :alt="post.user.name"
                        :src="post.user.profile_photo_url"
                        class="object-cover w-10 h-10 mx-auto rounded-full"
                      />
                    </div>
                    <div class="flex flex-col justify-between ml-4 text-sm">
                      <p class="text-gray-800 dark:text-white">
                        {{ post.user.name }}
                      </p>
                      <p class="text-gray-400 dark:text-gray-300">
                        {{ post.created_time }} - {{ post.read_time }} min read
                      </p>
                    </div>
                  </div>
                </div>
              </Link>
            </div>
          </template>
        </div>
      </div>
    </LayoutCard>
    <LayoutCard>
      <div class="w-full p-6 bg-transparent md:p-12">
        <div
          class="flex flex-col items-end justify-between mb-12 md:flex-row header"
        >
          <div class="title">
            <p class="mb-4 text-4xl font-bold text-gray-800 dark:text-gray-100">
              Cool Author
            </p>
            <p class="text-2xl font-light text-gray-400">
              More people to made up something i guess.
            </p>
          </div>
        </div>
        <div class="flex flex-wrap gap-12">
          <template v-for="(user, i) in new_comers" :key="i">
            <div class="w-16 md:w-24">
              <Link
                :href="`/posts?author=${user.username}`"
                class="rounded-full"
              >
                <img
                  :src="user.profile_photo_url"
                  :alt="user.name"
                  class="object-cover w-full rounded-full"
                />
              </Link>
              <div>
                <p
                  class="text-lg font-semibold text-center text-transparent bg-clip-text from-teal-500 to-indigo-500 bg-gradient-to-bl"
                >
                  {{ user.name }}
                </p>
              </div>
            </div>
          </template>
        </div>
      </div>
    </LayoutCard>
    <LayoutCard>
      <h2>
        Didn't find something interesting?
        <Link href="/posts" class="font-semibold text-indigo-300 underline"
          >More Posts</Link
        >
      </h2>
    </LayoutCard>
  </BaseLayout>
</template>
