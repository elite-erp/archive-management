<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import { t } from "../utils";
import { mdiAccountOutline, mdiLockOutline } from "@mdi/js";

let user = useForm({
  name: "",
  password: "",
});
function authenticate() {
  user.post("/authenticate");
}
</script>
<template>
  <div
    class="flex flex-col justify-center items-center h-screen w-screen bg-gray-100 py-10"
  >
    <img src="/assets/icons/logo-text.png" />
    <ECard class="w-5/12 min-h-fit my-6">
      <form
        @submit.prevent="authenticate"
        class="flex flex-col items-center justify-start gap-14"
      >
        <h2 class="text-xl font-bold text-gray-500">{{ t("login.title") }}</h2>
        <EInput
          :icon="mdiAccountOutline"
          label="login.user.label"
          placeholder="login.user.placeholder"
          :error="user.errors?.name"
          v-model="user.name"
        />
        <EInput
          :icon="mdiLockOutline"
          type="password"
          label="login.password.label"
          placeholder="login.password.placeholder"
          :error="user.errors?.password"
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
    </ECard>
  </div>
</template>
<style lang="postcss" scoped></style>
