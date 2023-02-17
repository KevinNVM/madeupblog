import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import "@imengyu/vue3-context-menu/lib/vue3-context-menu.css";
import ContextMenu from "@imengyu/vue3-context-menu";
import VueSelect from "vue-select";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

const VueToastConfig = {
    transition: "Vue-Toastification__slideBlurred",
    maxToasts: 5,
    newestOnTop: false,
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .component("v-select", VueSelect)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Toast, VueToastConfig)
            .use(ContextMenu)
            .mount(el);
    },
    progress: {
        color: "#5eead4",
    },
});
