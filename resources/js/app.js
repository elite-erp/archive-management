import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import "../css/app.css";
import Layout from "./layout.vue";
import ECard from "./components/card.vue";
import EIcon from "./components/icon.vue";

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob("./views/**/*.vue", { eager: true });
    let page = pages[`./views/${name}.vue`];
    if (name != "login") page.default.layout = page.default.layout || Layout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("ECard", ECard)
      .component("EIcon", EIcon)
      .mount(el);
  },
});
