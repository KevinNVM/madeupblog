<script setup>
import { onMounted, ref } from "vue";

const isUserPreferDark = () =>
  localStorage.theme === "dark" ||
  (!("theme" in localStorage) &&
    window.matchMedia("(prefers-color-scheme: dark)").matches);

const darkTheme = ref(isUserPreferDark());
const toggleTheme = () => {
  darkTheme.value = !darkTheme.value;
  localStorage.theme = darkTheme.value ? "dark" : "light";
  fetchUserTheme();
};

const fetchUserTheme = () => {
  // On page load or when changing themes, best to add inline in `head` to avoid FOUC
  if (isUserPreferDark()) {
    document.documentElement.classList.add("dark");
  } else {
    document.documentElement.classList.remove("dark");
  }
};

onMounted(() => fetchUserTheme());
</script>

<template>
  <div class="flex gap-2">
    <svg
      v-show="darkTheme"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="#fff"
      class="w-6 h-6"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"
      />
    </svg>
    <svg
      v-show="!darkTheme"
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
        d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
      />
    </svg>

    <label class="switch">
      <input type="checkbox" :checked="darkTheme" @change="toggleTheme()" />
      <span class="slider round"></span>
    </label>
  </div>
</template>


<style scoped>
.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 20px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  border-radius: 20px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #2196f3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196f3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}
</style>
