<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import LayoutCard from "@/Components/LayoutCard.vue";
import Pagination from "@/Shared/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

defineProps(["posts"]);

const forceDelete = (id) => {
  if (confirm("are you sure?"))
    router.delete(route("trashed.destroy", id), {
      only: ["posts"],
      onSuccess: () => useToast().success("Deleted!"),
    });
};

const restore = (id) =>
  router.put(`/dashboard/trashed/${id}`, {
    only: ["posts"],
    onSuccess: () => useToast().success("Restored!"),
  });
</script>

<template>
  <BaseLayout>
    <LayoutCard>
      <p>Trashed Posts ({{ posts.data.length }})</p>

      <ul
        v-for="post in posts.data"
        :key="post.id"
        class="flex flex-col gap-2 pt-8"
      >
        <li class="line-clamp-1">Title: "{{ post.title }}"</li>
        <li class="line-clamp-1">
          Deleted at: {{ new Date(post.deleted_at).toLocaleString() }}
        </li>
        <li class="line-clamp-1">
          <PrimaryButton @click="restore">Restore</PrimaryButton>
        </li>
        <li class="line-clamp-1">
          <SecondaryButton @click="forceDelete(post.slug)"
            >Remove</SecondaryButton
          >
        </li>
      </ul>

      <Pagination :links="posts.links" />
    </LayoutCard>
  </BaseLayout>
</template>
