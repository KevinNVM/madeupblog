<script setup>
import { getPostThumbnail, escapeHTML } from "@/Plugin/plugins";
import LayoutCard from "./LayoutCard.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
  posts: Object,
});
</script>

<template>
  <LayoutCard :use-padding="false" v-for="post in posts" :key="post.slug">
    <article class="block p-6 group md:flex gap-4">
      <img
        :src="getPostThumbnail(post)"
        v-if="getPostThumbnail(post)"
        :alt="post.title"
        draggable="false"
        class="
          object-cover
          md:aspect-square
          aspect-video
          w-full
          md:max-w-[10rem]
          max-w-full
          transition-opacity
          group-hover:saturate-150
          mb-4
          rounded-lg
        "
      />
      <div>
        <header>
          <h1 class="text-lg font-semibold capitalize">
            <Link
              class="hover:underline underline-offset-2"
              :href="route('posts.show', post.slug)"
            >
              {{ post.title }}
            </Link>
          </h1>
          <div
            class="
              flex
              items-center
              gap-2
              pt-1
              text-gray-600
              dark:text-gray-300
            "
          >
            <Link
              :href="`/posts?author=${post.user.username}`"
              aria-label="author"
              class="text-sm font-semibold text-teal-400"
              >{{ post.user.name }}</Link
            >
            in
            <Link
              :href="
                post.category_id
                  ? `/posts/categories/${post.category.slug}`
                  : '#'
              "
              aria-label="category"
              class="font-semibold leading-normal text-indigo-500"
              >{{ post.category?.name }}</Link
            >
            <span aria-label="date release" class="text-sm">{{
              post.created_time
            }}</span>
          </div>
        </header>
        <section
          class="article-body line-clamp-3"
          v-html="escapeHTML(post.body, true)"
        ></section>
      </div>
    </article>
  </LayoutCard>
</template>
