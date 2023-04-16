import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import checker from "vite-plugin-checker";

export default defineConfig({
  plugins: [
    checker({
      vueTsc: true,
    }),
    vue(),
    laravel({
      input: ["resources/css/app.css", "resources/js/app.ts"],
      refresh: true,
    }),
  ],
});