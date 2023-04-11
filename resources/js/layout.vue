<template>
  <div class="bg-gray-100 h-full min-h-screen w-full">
    <nav class="flex justify-between items-center p-10 h-[88px] w-full">
      <img src="/assets/icons/logo-text.png" />
      <input
        type="search"
        class="border p-3 w-[390px] outline-none border-gray-300 rounded-lg bg-white h-[54px]"
        :placeholder="t('search')"
      />
      <div class="flex flex-row shadow-md rounded-xl items-center h-[54px]">
        <Link class="nav-link rounded-s-xl" href="/">
          {{ t("nav.cpanel") }}
        </Link>
        <Link class="nav-link" href="/users">
          {{ t("nav.users") }}
        </Link>
        <Link class="nav-link" href="/documents">
          {{ t("nav.documents") }}
        </Link>
        <Link class="nav-link rounded-e-xl" href="/categories">
          {{ t("nav.categories") }}
        </Link>
      </div>
      <div
        class="flex flex-col justify-start w-[160px]"
        @click.prevent="activeUserMenu = !activeUserMenu"
      >
        <div class="flex flex-row items-center justify-between">
          <img class="h-[60px] w-[60px] rounded-full" src="/imgs/user.png" />
          <span>{{ user.name }}</span>
        </div>
      </div>
    </nav>
    <div
      v-if="activeUserMenu"
      class="absolute top-20 w-36 left-10 flex flex-col items-center text-primary-600 justify-center rounded-lg bg-white text-center divide-y divide-gray-200 z-10 shadow-md"
    >
      <Link href="/profile" v-text="t('nav.profile')" class="py-4 w-full" />
      <Link
        href="/logout"
        method="post"
        v-text="t('nav.logout')"
        class="py-4 w-full"
      />
    </div>
    <slot />
  </div>
</template>

<script lang="ts" setup>
import { t } from "./utils.js";
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const user = computed(() => usePage().props?.auth?.user);
const activeUserMenu = ref(false);
</script>

<style lang="postcss" scoped>
.nav-link {
  @apply inline-flex justify-center items-center text-primary-800 font-semibold text-lg bg-white border-gray-300 h-full px-3 border-e hover:bg-primary-50;
}
</style>
