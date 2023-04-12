<template>
  <EModal @close="emits('hide-modal')">
    <h1 class="font-bold text-2xl text-gray-500 text-center">تعديل مستخدم</h1>
    <form
      @submit.prevent="storeUser"
      class="mt-8 flex flex-col justify-center gap-[22px] items-center"
    >
      <EInput
        :icon="mdiAccountOutline"
        label="login.document.label"
        placeholder="login.document.placeholder"
        v-model="document.name"
        :error="document.errors?.name"
      />
      <EInput
        :icon="mdiLockOutline"
        type="password"
        label="login.password.label"
        placeholder="login.password.placeholder"
        v-model="document.password"
        :error="document.errors?.password"
      />
      <div class="flex flex-col justify-start w-full">
        <span class="mb-2 text-gray-600">الوظيفة</span>
        <div>
          <label class="mx-4">
            <input
              type="radio"
              v-model="document.role"
              value="مدير"
              :checked="document.role == 'مدير'"
            />
            <span class="mx-2 text-gray-600">مدير</span>
          </label>
          <label>
            <input
              type="radio"
              v-model="document.role"
              value="موظف"
              :checked="document.role == 'موظف'"
            />
            <span class="mx-2 text-gray-600">موظف</span>
          </label>
        </div>
        <span
          v-if="document.errors?.role"
          v-text="document.errors?.role"
          class="error-message"
        />
      </div>
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
import { t } from "../../utils";
import EModal from "../../components/modal.vue";

let props = defineProps(["document"]);
let emits = defineEmits(["hide-modal"]);

const document = useForm({
  name: props.document.name,
  role: props.document.role,
  password: props.document.password,
});

function storeUser() {
  document.patch(`/documents/${props.document.id}`, {
    onSuccess: () => {
      emits("hide-modal");
    },
  });
}
</script>
