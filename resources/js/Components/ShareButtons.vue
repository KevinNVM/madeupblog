<script setup>
import { copyTextToClipboard, useToast } from "@/Plugin/plugins";

defineProps({
  url: {
    type: String,
    default: window.location.href,
  },
  text: {
    type: String,
    default: "Hey, Check this out!\n",
  },
});

const copyUrl = () => {
  copyTextToClipboard(window.location.href);
  useToast().success("Copied URL To Clipboard!");
};
</script>

<template>
  <div class="flex flex-wrap sharing-buttons">
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-blue-500 border-2 border-blue-500 rounded-full ease hover:bg-blue-700 hover:border-blue-700"
      target="_blank"
      rel="noopener"
      :href="`https://facebook.com/sharer/sharer.php?u=${url}`"
      title="Share on Facebook"
      aria-label="Share on Facebook"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Facebook</title>
        <path
          d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 border-2 rounded-full bg-sky-500 border-sky-500 ease hover:bg-sky-700 hover:border-sky-700"
      target="_blank"
      rel="noopener"
      :href="`https://twitter.com/intent/tweet?url=${url}&amp;text=${text}`"
      title="Share on Twitter"
      aria-label="Share on Twitter"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Twitter</title>
        <path
          d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-blue-600 border-2 border-blue-600 rounded-full ease hover:bg-blue-700 hover:border-blue-700"
      target="_blank"
      rel="noopener"
      :href="`https://www.linkedin.com/shareArticle?mini=true&amp;url=${url}&amp;title=${text}&amp;summary=${text}&amp;source=${url}`"
      title="Share on Linkedin"
      aria-label="Share on Linkedin"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Linkedin</title>
        <path
          d="M136 183v283H42V183h94zm6-88c1 27-20 49-53 49-32 0-52-22-52-49 0-28 21-49 53-49s52 21 52 49zm333 208v163h-94V314c0-38-13-64-47-64-26 0-42 18-49 35-2 6-3 14-3 23v158h-94V183h94v41c12-20 34-48 85-48 62 0 108 41 108 127z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 border-2 rounded-full bg-slate-600 border-slate-600 ease hover:bg-slate-700 hover:border-slate-700"
      target="_blank"
      rel="noopener"
      :href="`https://www.tumblr.com/widgets/share/tool?posttype=link&amp;title=${text}&amp;caption=${text}&amp;content=${url}&amp;canonicalUrl=${url}&amp;shareSource=tumblr_share_button`"
      title="Share on Tumblr"
      aria-label="Share on Tumblr"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Tumblr</title>
        <path
          d="M406 480c-14 15-50 32-98 32-120 0-147-89-147-141V227h-47c-6 0-10-4-10-10v-68c0-7 4-13 11-16 62-21 82-76 85-117 0-11 6-16 16-16h71c5 0 10 4 10 10v115h83c5 0 10 5 10 10v82c0 5-5 10-10 10h-84v133c0 34 24 54 68 36 5-2 9-3 13-2 3 1 6 3 7 8l22 64c2 5 4 10 0 14z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-red-600 border-2 border-red-600 rounded-full ease hover:bg-red-700 hover:border-red-700"
      target="_blank"
      rel="noopener"
      :href="`https://pinterest.com/pin/create/button/?url=${url}&amp;media=${url}&amp;description=${text}`"
      title="Share on Pinterest"
      aria-label="Share on Pinterest"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Pinterest</title>
        <path
          d="M268 6C165 6 64 75 64 186c0 70 40 110 64 110 9 0 15-28 15-35 0-10-24-30-24-68 0-81 62-138 141-138 68 0 118 39 118 110 0 53-21 153-90 153-25 0-46-18-46-44 0-38 26-74 26-113 0-67-94-55-94 25 0 17 2 36 10 51-14 60-42 148-42 209 0 19 3 38 4 57 4 3 2 3 7 1 51-69 49-82 72-173 12 24 44 36 69 36 106 0 154-103 154-196C448 71 362 6 268 6z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-orange-600 border-2 border-orange-600 rounded-full ease hover:bg-orange-700 hover:border-orange-700"
      target="_blank"
      rel="noopener"
      :href="`https://reddit.com/submit/?url=${url}&amp;resubmit=true&amp;title=${text}`"
      title="Share on Reddit"
      aria-label="Share on Reddit"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Reddit</title>
        <path
          d="M440 204c-15 0-28 6-38 15-35-24-83-40-137-42l28-125 88 20c0 22 18 39 39 39 22 0 40-18 40-39s-17-40-40-40c-15 0-28 9-35 22l-97-22c-5-1-10 3-11 7l-31 138c-53 2-100 18-136 43a53 53 0 0 0-38-16c-56 0-74 74-23 100l-3 24c0 84 95 152 210 152 117 0 211-68 211-152 0-8-1-17-3-25 50-25 32-99-24-99zM129 309a40 40 0 1 1 80 0 40 40 0 0 1-80 0zm215 93c-37 37-139 37-176 0-4-3-4-9 0-13s10-4 13 0c28 28 120 29 149 0 4-4 10-4 14 0s4 10 0 13zm-1-54c-22 0-39-17-39-39a39 39 0 1 1 39 39z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 border-2 rounded-full bg-lime-600 border-lime-600 ease hover:bg-lime-700 hover:border-lime-700"
      target="_blank"
      rel="noopener"
      :href="`https://www.xing.com/app/user?op=share;url=${url};title=${text}`"
      title="Share on Xing"
      aria-label="Share on Xing"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Xing</title>
        <path
          d="m227 210-70 123c-5 9-11 13-18 13H74c-8 0-12-8-9-14l69-122-44-76c-4-7 1-14 9-14h65c7 0 13 4 18 12l45 78zM447 46 303 299l91 167c4 7 0 14-8 14h-66c-7 0-13-4-18-12l-92-169L355 44c4-8 10-12 17-12h66c8 0 12 7 9 14z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-green-600 border-2 border-green-600 rounded-full ease hover:bg-green-700 hover:border-green-700"
      target="_blank"
      rel="noopener"
      :href="`https://wa.me/?text=${text}%20${url}`"
      title="Share on Whatsapp"
      aria-label="Share on Whatsapp"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Whatsapp</title>
        <path
          d="M413 97A222 222 0 0 0 64 365L31 480l118-31a224 224 0 0 0 330-195c0-59-25-115-67-157zM256 439c-33 0-66-9-94-26l-7-4-70 18 19-68-4-7a185 185 0 0 1 287-229c34 36 56 82 55 131 1 102-84 185-186 185zm101-138c-5-3-33-17-38-18-5-2-9-3-12 2l-18 22c-3 4-6 4-12 2-32-17-54-30-75-66-6-10 5-10 16-31 2-4 1-7-1-10l-17-41c-4-10-9-9-12-9h-11c-4 0-9 1-15 7-5 5-19 19-19 46s20 54 23 57c2 4 39 60 94 84 36 15 49 17 67 14 11-2 33-14 37-27s5-24 4-26c-2-2-5-4-11-6z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 border-2 rounded-full bg-amber-500 border-amber-500 ease hover:bg-amber-700 hover:border-amber-700"
      target="_blank"
      rel="noopener"
      :href="`https://news.ycombinator.com/submitlink?u=${url}&amp;t=${text}`"
      title="Share on Hacker News"
      aria-label="Share on Hacker News"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Hacker News</title>
        <path
          d="M32 32v448h448V32H32zm21 197zm218 54v101h-31V281l-80-153h37c53 98 50 101 60 126 12-27 5-25 60-126h35l-81 155z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-indigo-600 border-2 border-indigo-600 rounded-full ease hover:bg-indigo-700 hover:border-indigo-700"
      target="_blank"
      rel="noopener"
      :href="`http://vk.com/share.php?title=${text}&amp;url=${url}`"
      title="Share on VK"
      aria-label="Share on VK"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>VK</title>
        <path
          d="M63 63c-31 32-31 83-31 184v18c0 101 0 152 31 184s83 31 184 31h18c101 0 152 0 184-31s31-83 31-184v-18c0-101 0-152-31-184s-83-31-184-31h-18C146 32 95 32 63 63zm45 105h51c1 86 39 122 69 129V168h48v74c30-3 61-37 71-74h48a142 142 0 0 1-65 93 147 147 0 0 1 76 94h-53a92 92 0 0 0-77-67v67h-6c-102 0-160-70-162-187z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-blue-500 border-2 border-blue-500 rounded-full ease hover:bg-blue-700 hover:border-blue-700"
      target="_blank"
      rel="noopener"
      :href="`https://telegram.me/share/url?text=${text}&amp;url=${url}`"
      title="Share on Telegram"
      aria-label="Share on Telegram"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Telegram</title>
        <path
          d="M256 8a248 248 0 1 0 0 496 248 248 0 0 0 0-496zm115 169c-4 39-20 134-28 178-4 19-10 25-17 25-14 2-25-9-39-18l-56-37c-24-17-8-25 6-40 3-4 67-61 68-67l-1-4-5-1q-4 1-105 70-15 10-27 9c-9 0-26-5-38-9-16-5-28-7-27-16q1-7 18-14l145-62c69-29 83-34 92-34 2 0 7 1 10 3l4 7a43 43 0 0 1 0 10z"
        ></path>
      </svg>
    </a>
    <a
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-gray-600 border-2 border-gray-600 rounded-full ease hover:bg-gray-700 hover:border-gray-700"
      target="_blank"
      rel="noopener"
      :href="`mailto:?subject=${text}&amp;body=${url}`"
      title="Share by Email"
      aria-label="Share by Email"
      draggable="false"
    >
      <svg
        aria-hidden="true"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
        class="w-6 h-6"
      >
        <title>Email</title>
        <path
          d="M464 64a48 48 0 0 1 29 86L275 314c-11 8-27 8-38 0L19 150a48 48 0 0 1 29-86h416zM218 339c22 17 54 17 76 0l218-163v208c0 35-29 64-64 64H64c-35 0-64-29-64-64V176l218 163z"
        ></path>
      </svg>
    </a>
    <a
      role="button"
      class="inline-flex items-center p-2 mb-1 mr-1 text-white transition duration-200 bg-gray-600 border-2 border-gray-600 rounded-full ease hover:bg-gray-700 hover:border-gray-700"
      title="Copy Link"
      aria-label="Copy Link"
      draggable="false"
      @click="copyUrl"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"
        />
      </svg>
    </a>
  </div>
</template>
