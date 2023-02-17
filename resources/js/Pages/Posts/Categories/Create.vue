<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import LayoutCard from "@/Components/LayoutCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useToast } from "vue-toastification";
import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const form = useForm({
  name: "",
  slug: "",
  desc: "",
});

const toast = useToast();

const handleSubmit = () => {
  form.post(`/dashboard/posts/categories`, {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Success");
    },
  });
};

defineProps(["title"]);
</script>



<template>
  <Head>
    <title>{{ title }}</title>
  </Head>

  <BaseLayout :hideFooter="true">
    <template #header>
      <h2
        class="
          text-xl
          font-semibold
          leading-tight
          text-gray-800
          capitalize
          dark:text-gray-200
        "
      >
        {{ title }}
      </h2>
    </template>

    <form @submit.prevent="handleSubmit">
      <LayoutCard>
        <h3 class="pb-4 text-lg">Please enter category details</h3>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
          <div>
            <InputLabel for="name">Name</InputLabel>
            <TextInput
              id="name"
              placeholder="Enter category name"
              class="w-full px-4 py-2"
              v-model="form.name"
            />
            <span class="error" v-if="form.errors.name">{{
              form.errors.name
            }}</span>
          </div>
          <div>
            <InputLabel for="slug">Slug (Leave empty for auto slug)</InputLabel>
            <TextInput
              id="slug"
              placeholder="example: this-is-a-cool-post"
              class="w-full px-4 py-2"
              v-model="form.slug"
            />
            <span class="error" v-if="form.errors.slug">{{
              form.errors.slug
            }}</span>
          </div>
        </div>
      </LayoutCard>

      <LayoutCard class="body-editor">
        <div class="">
          <InputLabel for="body">Description (optional)</InputLabel>
          <textarea
            class="
              w-full
              border-gray-300
              rounded-md
              shadow-sm
              dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
              focus:border-indigo-500
              dark:focus:border-indigo-600
              focus:ring-indigo-500
              dark:focus:ring-indigo-600
            "
            v-model="form.desc"
            rows="10"
            placeholder="Category description"
          ></textarea>
          <span class="error" v-if="form.errors.desc">{{
            form.errors.desc
          }}</span>
        </div>
        <div>
          <PrimaryButton type="submit" :disabled="form.processing"
            >Save</PrimaryButton
          >
        </div>
      </LayoutCard>
    </form>
  </BaseLayout>
</template>

<style>
.ck-content {
  color: black;
}
</style>
