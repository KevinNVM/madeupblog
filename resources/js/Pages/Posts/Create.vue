<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import LayoutCard from "@/Components/LayoutCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
  title: null,
  slug: null,
  body: null,
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
        Share
      </h2>
    </template>

    <LayoutCard>
      <article class="">
        <header>
          <h1 class="text-xl font-semibold text-center capitalize lg:text-2xl">
            {{ form.title }}
          </h1>
          <div
            class="
              flex
              items-center
              justify-center
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
            <span aria-label="date release" class="text-sm">5 Days Ago</span>
          </div>
        </header>
        <section aria-label="article body" class="py-8">
          <p class="mx-auto prose prose-invert">
            {{ form.body }}
          </p>
        </section>
      </article>
    </LayoutCard>

    <LayoutCard>
      <h4 class="text-xl font-semibold">Comments</h4>
      <section aria-label="comment section" class="w-full">
        <div class="flex flex-col gap-2 py-4" v-for="i in [1, 2, 3]" :key="i">
          <header class="flex items-center gap-2">
            <img
              src="https://via.placeholder.com/50"
              alt="Comment User"
              class="object-cover w-10 h-10 rounded-full"
            />
            <div class="flex flex-col justify-center gap-0.5">
              <p class="leading-3">User Ipsum</p>
              <small class="text-gray-600 dark:text-gray-300">Just Now</small>
            </div>
          </header>
          <section aria-label="comment body" class="w-full">
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur,
              consequatur! Lorem, ipsum dolor sit amet consectetur adipisicing
              elit. Provident deleniti ad reiciendis enim natus cupiditate modi
              eaque sapiente alias quia atque, maxime doloribus culpa vitae
              illum quae, nihil sequi esse.
            </p>
          </section>
          <footer class="flex items-center gap-2">
            <div class="flex gap-2">
              <button
                class="
                  px-3
                  py-1
                  transition-all
                  duration-300
                  rounded-full
                  bg-gray-500/20
                  focus:ring
                  ring-indigo-500/75
                  disabled:text-gray-500
                "
              >
                1 Like
              </button>
              <button
                disabled
                class="
                  px-3
                  py-1
                  transition-all
                  duration-300
                  rounded-full
                  bg-gray-500/20
                  focus:ring
                  ring-indigo-500/75
                  disabled:text-gray-500
                "
              >
                Reply
              </button>
            </div>
          </footer>
        </div>
      </section>
    </LayoutCard>
  </BaseLayout>
</template>


