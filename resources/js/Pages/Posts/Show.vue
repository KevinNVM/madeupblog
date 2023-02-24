<script setup>
import { Head, Link, usePage, router } from "@inertiajs/vue3";
import LayoutCard from "@/Components/LayoutCard.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { useToast } from "vue-toastification";
import axios from "axios";
import { ref } from "@vue/runtime-core";
import {
  copyTextToClipboard,
  fallbackCopyTextToClipboard,
} from "./../../Plugin/plugins";
import ShareButtons from "@/Components/ShareButtons.vue";
import { Disqus } from "vue-disqus";

const props = defineProps({
  post: Object,
  title: {
    type: String,
    default: "Posts",
  },
});

const page = usePage();
const toast = useToast();
let post_likes = ref(props.post.likes);

const likePost = async () => {
  const response = await axios.post(
    `/session-helpers/posts/actions/like?from=${props.post.slug}`
  );
  if (response.data === 1) {
    toast.success("Thank You! We appreciate your contributions");
    post_likes.value += 1;
  } else if (response.data === 2)
    toast("Thank you! but you already liked this post");
  else toast.error("We are very sorry, Something happened on our end");
};

const deletePost = () => {
  if (!confirm("are you sure?\nThis action is ireversable!")) return false;
  axios.delete(`/dashboard/posts/${props.post.slug}`);
  router.visit(route("posts.index"), {
    method: "get",
    onSuccess: (page) => {
      toast.success("Post Deleted!", {
        timeout: 4000,
      });
    },
  });
};

const copyUrl = () =>
  copyTextToClipboard(window.location.href)
    ? toast.success("Copied URL To Clipboard!", {
        timeout: 2000,
      })
    : toast.error("Failed to copy URL", {
        timeout: 2000,
      });

const showShareButtons = ref(false);
const toggleShareButtons = (e) => {
  showShareButtons.value = !showShareButtons.value;
  if (navigator.share && !showShareButtons.value) {
    navigator
      .share({
        title: "Hey, Check this out!",
        url: window.location.href,
      })
      .then(() => {
        toast.success("Thank you for sharing!");
      })
      .catch((err) => {
        // Handle errors, if occured
        toast.error("Error sharing this page, Please try again later");
        console.log("Error while using Web share API:");
        console.log(err);
      });
  } else {
    console.log(
      "platform does not support web share API. Please use fallback links..."
    );
  }
};

let i = 0;
const newComment = (e) => {
  i++;
  if (i === 1)
    toast.success("Comment posted!", {
      timeout: 2000,
    });
  i--;
};
</script>

<template>
  <Head>
    <title>{{ title }}</title>
    <meta name="description" :content="post.title" />
    <meta name="author" :content="post.user.name" />
    <meta name="keyword" :content="`${post.title},${post.category.name}`" />
  </Head>

  <BaseLayout :show-progress-bar="true">
    <template #header>
      <h2
        role="button"
        class="text-xl font-semibold leading-tight text-gray-800 select-none dark:text-gray-200 hover:cursor-pointer"
        @click="toggleShareButtons"
      >
        Share
      </h2>
      <Transition>
        <ShareButtons v-show="showShareButtons" />
      </Transition>
    </template>

    <LayoutCard>
      <article class="">
        <header>
          <h1
            class="flex items-center justify-center gap-1 text-xl font-semibold text-center capitalize lg:text-2xl"
          >
            <button @click="copyUrl" class="hover:underline underline-offset-2">
              {{ post.title }}
            </button>
            <div class="flex gap-1">
              <Link
                type="button"
                :href="route('posts.edit', post.slug)"
                v-if="
                  $page.props.auth.user &&
                  $page.props.auth.user.id === post.user_id
                "
                class="text-amber-500"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-5 h-5"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                  />
                </svg>
              </Link>
              <button
                type="button"
                @click="deletePost"
                v-if="
                  $page.props.auth.user &&
                  $page.props.auth.user.id === post.user_id
                "
                class="text-red-500"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-5 h-5"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                  />
                </svg>
              </button>
            </div>
          </h1>
          <div
            class="flex flex-col items-center justify-center gap-2 pt-1 text-gray-600 dark:text-gray-300"
          >
            <div>
              <Link
                aria-label="author"
                :href="`/posts?author=${post.user.name}`"
                class="text-sm font-semibold text-teal-400"
                >{{ post.user.name.replace(/^(.{1}[^\s]*).*/, "$1") }}</Link
              >
              in
              <Link
                :href="`/posts/categories/${post.category?.slug}`"
                aria-label="category"
                class="font-semibold leading-normal text-indigo-500"
                >{{ post.category?.name }}</Link
              >
              <span aria-label="date release" class="ml-2 text-sm">{{
                new Date(post.created_at).toLocaleString()
              }}</span>
            </div>
            <span aria-label="likes" class="text-sm">
              {{ post.views }} Views
            </span>
            <span aria-label="likes" class="text-sm">
              {{ post_likes }} person likes this post
            </span>
          </div>
        </header>
        <section aria-label="article body" class="py-8">
          <div class="mx-auto prose dark:prose-invert" v-html="post.body"></div>
        </section>
        <footer>
          <p>
            Like this post ?
            <button
              class="text-teal-500 dark:text-indigo-500"
              @click="likePost"
            >
              Leave a Like
            </button>
          </p>
        </footer>
      </article>
    </LayoutCard>

    <!-- <LayoutCard>
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
                class="px-3 py-1 transition-all duration-300 rounded-full bg-gray-500/20 focus:ring ring-indigo-500/75 disabled:text-gray-500"
              >
                1 Like
              </button>
              <button
                disabled
                class="px-3 py-1 transition-all duration-300 rounded-full bg-gray-500/20 focus:ring ring-indigo-500/75 disabled:text-gray-500"
              >
                Reply
              </button>
            </div>
          </footer>
        </div>
      </section>
    </LayoutCard> -->
    <LayoutCard>
      <section aria-label="comment section" class="w-full">
        <Disqus @new-comment="newComment" />
      </section>
    </LayoutCard>
  </BaseLayout>
</template>
