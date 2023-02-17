<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap p-4">
      <template v-for="(link, key) in links" :key="key">
        <div
          v-if="link.url === null"
          class="
            px-4
            py-3
            mb-1
            mr-1
            text-sm
            leading-4
            text-gray-400
            border
            rounded
          "
          v-html="link.label"
        />

        <Link
          v-else
          class="
            px-4
            py-3
            mb-1
            mr-1
            text-sm
            leading-4
            border
            rounded
            hover:bg-white/50
            focus:border-primary focus:text-primary
          "
          :class="{
            'dark:text-white bg-white dark:bg-white/50': link.active,
            'dark:text-white dark:bg-gray-800': !link.active,
          }"
          :href="link.url"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/vue3";
export default defineComponent({
  components: {
    Link,
  },
  props: {
    links: Array,
  },
});
</script>
