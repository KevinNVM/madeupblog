<script setup>
import { Head, Link } from "@inertiajs/vue3";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import LayoutCard from "@/Components/LayoutCard.vue";

defineProps({
  posts: Array,
});
</script>

<template>
  <Head>
    <title>All Posts</title>
  </Head>

  <BaseLayout>
    <template #header>
      <h2
        class="
          text-xl
          font-semibold
          leading-tight
          text-gray-800
          dark:text-gray-200
        "
      >
        All Posts
      </h2>
    </template>

    <LayoutCard v-for="post in posts" :key="post.slug">
      <article class="">
        <header>
          <h1 class="text-lg font-semibold capitalize">
            <Link
              class="hover:underline underline-offset-2"
              :href="route('posts.show', post.id)"
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
            <span aria-label="author" class="text-sm">Author </span>
            in
            <Link
              href="#/posts/category/Lifestyle"
              aria-label="category"
              class="font-semibold leading-normal text-indigo-500"
              >Lifestyle</Link
            >
            <date class="text-sm">5 Days Ago</date>
          </div>
        </header>
        <section class="article-body">
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere
            minima maxime consequatur illum molestiae ad, eligendi quae magnam
            laudantium ab saepe consequuntur, ea quidem, reprehenderit
            blanditiis possimus neque laboriosam nemo!
          </p>
        </section>
      </article>
    </LayoutCard>
  </BaseLayout>
</template>


