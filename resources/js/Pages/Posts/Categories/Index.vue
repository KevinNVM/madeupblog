<script setup>
import LayoutCard from "@/Components/LayoutCard.vue";
import ShareButtons from "@/Components/ShareButtons.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { defineComponent } from "@vue/runtime-core";

defineProps({
  categories: Array,
  title: String,
});
</script>

<script>
export default defineComponent({
  methods: {
    onContextMenu(e) {
      //prevent the browser's default menu
      e.preventDefault();
      //show our menu
      this.$contextmenu({
        x: e.x,
        y: e.y,
        items: [
          {
            label: `Category: ${e?.target?.getAttribute("data-category")}`,
            divided: true,
          },
          {
            label: "Edit",
            onClick: () =>
              router.visit(
                route(
                  "categories.edit",
                  e?.target?.getAttribute("data-category")
                )
              ),
          },
          {
            label: "Delete",
            onClick: () => {
              if (
                !confirm(
                  "Are you sure?\nDeleting category will delete all of it's related posts!\nThis Action Cannot be Undone!"
                )
              )
                return false;
              router.delete(
                route(
                  "categories.destroy",
                  e?.target?.getAttribute("data-category")
                )
              );
            },
          },
        ],
      });
    },
  },
});
</script>

<template>
  <Head>
    <title>{{ title }}</title>
    <meta name="description" content="category list" />
  </Head>

  <BaseLayout :hide-footer="true">
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
        {{ title }}
      </h2>
    </template>

    <template v-if="categories.length >= 1">
      <LayoutCard>
        <div class="flex flex-wrap gap-4 justify-center items-center">
          <Link
            @contextmenu="onContextMenu($event)"
            v-for="category in categories"
            :data-category="category?.slug"
            :key="category.id"
            class="
              p-3
              text-lg
              font-semibold
              text-white
              transition-all
              duration-500
              md:text-xl
              rounded-xl
              bg-gradient-to-tl
              from-indigo-400
              via-pink-500
              to-indigo-500
              bg-size-200 bg-pos-0
              hover:bg-pos-100 hover:shadow-xl
              dark:hover:shadow-lg dark:hover:shadow-gray-500
            "
            :href="`/posts/categories/${category.slug}`"
          >
            {{ category.name }}
          </Link>
        </div>
      </LayoutCard>
    </template>
    <LayoutCard v-else>
      <h1 class="text-gray-500 dark:text-gray-400">
        There are no category yet.
      </h1>
    </LayoutCard>
  </BaseLayout>
</template>
