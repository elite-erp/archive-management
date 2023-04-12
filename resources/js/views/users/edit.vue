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
      <div class="flex flex-col justify-start w-full">
        <span class="mb-2 text-gray-600">الوظيفة</span>
        <div>
          <label class="mx-4">
            <input
              type="radio"
              v-model="user.role"
              value="مدير"
              :checked="user.role == 'مدير'"
            />
            <span class="mx-2 text-gray-600">مدير</span>
          </label>
          <label>
            <input
              type="radio"
              v-model="user.role"
              value="موظف"
              :checked="user.role == 'موظف'"
            />
            <span class="mx-2 text-gray-600">موظف</span>
          </label>
        </div>
        <span
          v-if="user.errors?.role"
          v-text="user.errors?.role"
          class="error-message"
        />
      </div>
      <div class="flex flex-row justify-between items-center w-full">
        <button type="submit" class="btn btn-primary">
          {{ t("users.buttons.submit") }}
        </button>
        <button type="submit" class="btn btn-secondary">
          {{ t("login.buttons.clear") }}
        </button>
      </div>
    </form>
  </EModal>
</template>
<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import { mdiAccountOutline, mdiLockOutline } from "@mdi/js";
import { t } from "../../utils";
import EModal from "../../components/modal.vue";

let props = defineProps(["user"]);
let emits = defineEmits(["hide-modal"]);

const user = useForm({
  name: props.user.name,
  role: props.user.role,
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
