<template>
  <div class="bg-gray-100 h-screen w-screen">
    <nav class="flex justify-between items-center p-10 h-[88px] w-full">
      <img src="../assets/icons/logo-text.png" />
      <input
        type="search"
        class="border p-3 w-[390px] outline-none border-gray-300 rounded-lg bg-white h-[54px]"
      />
      <div class="flex flex-row shadow-md rounded-xl">
        <router-link class="nav-link rounded-s-xl" to="/">
          {{ t("nav.cpanel") }}
        </router-link>
        <router-link class="nav-link" to="/users">
          {{ t("nav.users") }}
        </router-link>
        <router-link class="nav-link" to="/documents">
          {{ t("nav.documents") }}
        </router-link>
        <router-link class="nav-link rounded-e-xl" to="/categories">
          {{ t("nav.categories") }}
        </router-link>
      </div>
      <div class="flex flex-row items-center justify-between w-[160px]">
        <img class="h-[60px] w-[60px] rounded-full" src="/imgs/user.png" />
        <span>المستخدم</span>
      </div>
    </nav>
    <slot />
  </div>
</template>

<script lang="ts" setup>
import { t } from "./utils.js";
</script>

<style lang="postcss" scoped>
.nav-link {
  @apply py-3 px-3 text-primary-800 font-semibold text-lg bg-white border-gray-300 h-full border-e;
}
</style>
