<script setup>
import LayoutCard from "@/Components/LayoutCard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { reactive } from "@vue/reactivity";
import { computed } from "@vue/runtime-core";
import TableLite from "vue3-table-lite";

const { posts } = defineProps({
  posts: Array,
});

const postsCount = posts.count;
const tablePosts = posts.map((post, index) => ({
  ...post,
  id: index + 1,
  body: post.body.trim().substr(0, 50).concat("..."),
  created_at: new Date(post.created_at).toLocaleString(),
  updated_at: new Date(post.updated_at).toLocaleString(),
}));
const table = reactive({
  columns: [
    {
      label: "ID",
      field: "id",
      width: "1%",
      sortable: true,
      isKey: true,
    },
    {
      label: "Title",
      field: "title",
      width: "10%",
      sortable: true,
    },
    {
      label: "Slug",
      field: "slug",
      width: "15%",
      sortable: true,
    },
    {
      label: "Body",
      field: "body",
      width: "15%",
      sortable: true,
    },
    {
      label: "Likes",
      field: "likes",
      width: "5%",
      sortable: true,
    },
    {
      label: "Created At",
      field: "created_at",
      width: "7%",
      sortable: true,
    },
    {
      label: "Updated At",
      field: "updated_at",
      width: "7%",
      sortable: true,
    },
  ],
  rows: tablePosts,
  totalRecordCount: computed(() => {
    return table.rows.length;
  }),
  sortable: {
    order: "id",
    sort: "asc",
  },
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
        >
          <div class="p-6 text-gray-900 dark:text-gray-100">
            Welcome {{ $page.props.auth.user.name }}!
          </div>
        </div>
      </div>
      <LayoutCard>
        <h2 class="font-semibold text-lg">Posts</h2>
        <table-lite
          :is-static-mode="true"
          :columns="table.columns"
          :rows="table.rows"
          :total="table.totalRecordCount"
          :sortable="table.sortable"
        ></table-lite>
      </LayoutCard>
    </div>
  </AuthenticatedLayout>
</template>
