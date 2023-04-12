<template>
  <EModal @close="emits('hide-modal')">
    <h1 class="font-bold text-2xl text-gray-500 text-center">تعديل مستخدم</h1>
    <form
      @submit.prevent="storeUser"
      class="mt-8 flex flex-col justify-center gap-[22px] items-center"
    >
      <EInput
        :icon="mdiAccountOutline"
        label="login.user.label"
        placeholder="login.user.placeholder"
        v-model="user.name"
        :error="user.errors?.name"
      />
      <EInput
        :icon="mdiLockOutline"
        type="password"
        label="login.password.label"
        placeholder="login.password.placeholder"
        v-model="user.password"
        :error="user.errors?.password"
      />
      <div class="flex flex-row justify-between items-center w-full">
        <button type="submit" class="btn btn-primary">
          {{ t("buttons.submit") }}
        </button>
        <button
          type="reset"
          @click.prevent="emits('hide-modal')"
          class="btn btn-secondary"
        >
          {{ t("buttons.clear") }}
        </button>
      </div>
    </form>
  </EModal>
</template>
<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import { mdiAccountOutline, mdiLockOutline } from "@mdi/js";
import { t } from "../utils";
import EModal from "../components/modal.vue";

let props = defineProps(["user"]);
let emits = defineEmits(["hide-modal"]);

const user = useForm({
  name: props.user.name,
  password: props.user.password,
});

function storeUser() {
  user.patch(`/users/${props.user.id}`, {
    onSuccess: () => {
      emits("hide-modal");
    },
  });
}
</script>
