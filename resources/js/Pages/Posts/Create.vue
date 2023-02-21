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

const { categories } = defineProps({
  title: String,
  categories: Array,
});

const form = useForm({
  title: "",
  slug: "",
  category_id: null,
  body: "",
});

const toast = useToast();

const handleSubmit = () => {
  form.post(`/dashboard/posts/`, {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Success");
    },
  });
};

const ckeditor = CKEditor.component;
const editor = ClassicEditor;
const editorConfig = {};

const selectOptions = categories.map((category) => ({
  label: category.name,
  value: category.id,
}));
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
          dark:text-gray-200
          capitalize
        "
      >
        {{ title }}
      </h2>
    </template>

    <form @submit.prevent="handleSubmit">
      <LayoutCard>
        <Link type="button" :href="route('posts.index')">Visit Posts Page</Link>
        <h3 class="pb-4 text-lg">Please enter your post details</h3>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
          <div>
            <InputLabel for="title">Title</InputLabel>
            <TextInput
              id="title"
              placeholder="Enter a post title"
              class="w-full px-4 py-2"
              v-model="form.title"
            />
            <span class="error" v-if="form.errors.title">{{
              form.errors.title
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
          <div class="pb-12">
            <InputLabel for="category">Category</InputLabel>
            <v-select
              id="category"
              :options="selectOptions"
              :reduce="(value) => value.value"
              v-model="form.category_id"
              placeholder="Choose Categories"
            ></v-select>
            <span class="error" v-if="form.errors.slug">{{
              form.errors.slug
            }}</span>
          </div>
        </div>
      </LayoutCard>

      <LayoutCard class="body-editor">
        <div class="py-12">
          <InputLabel for="body">Post Body</InputLabel>
          <!-- <textarea
            class="w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
            v-model="form.body"
            rows="10"
            placeholder="Use toolbar to modify text!"
          ></textarea> -->
          <ckeditor
            :editor="editor"
            :config="editorConfig"
            class="text-black"
            v-model="form.body"
            rows="10"
          ></ckeditor>
          <span class="error" v-if="form.errors.body">{{
            form.errors.body
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
