<script lang="ts" setup>
import { router } from "@inertiajs/vue3";
import { reactive } from "vue";
import { t } from "../utils";
import { mdiAccountOutline, mdiLockOutline } from "@mdi/js";
import EInput from "../components/input.vue";

let user = reactive({
  name: "",
  password: "",
});
function authenticate() {
  router.post("/authenticate", user);
}
</script>
<template>
  <div
    class="flex flex-col justify-center items-center h-screen w-screen bg-gray-100 py-10"
  >
    <img src="/assets/icons/logo-text.png" />
    <form
      @submit.prevent="authenticate"
      class="flex flex-col items-center justify-start gap-14 w-5/12 h-3/4 my-6 bg-white shadow-md rounded py-10 px-10"
    >
      <h2 class="text-xl font-bold text-gray-500">{{ t("login.title") }}</h2>
      <EInput
        :icon="mdiAccountOutline"
        label="login.user.label"
        placeholder="login.user.placeholder"
        v-model="user.name"
      />
      <EInput
        :icon="mdiLockOutline"
        type="password"
        label="login.password.label"
        placeholder="login.password.placeholder"
        v-model="user.password"
      />
      <div class="flex flex-row justify-between items-center w-full">
        <button type="submit" class="btn btn-primary">
          {{ t("login.buttons.submit") }}
        </button>
        <button type="submit" class="btn btn-secondary">
          {{ t("login.buttons.clear") }}
        </button>
      </div>
    </form>
  </div>
</template>
<style lang="postcss" scoped>
.btn {
  @apply h-[66px] w-5/12 rounded-lg text-lg font-bold focus:outline-none shadow;
}
.btn-primary {
  @apply bg-primary-700 text-white;
}
.btn-secondary {
  @apply bg-primary-100 text-primary-800;
}
</style>
