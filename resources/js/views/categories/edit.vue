<template>
  <EModal @close="emits('hide-modal')">
    <h1 class="font-bold text-2xl text-gray-500 text-center">تعديل مستخدم</h1>
    <form
      @submit.prevent="storeCategory"
      class="mt-8 flex flex-col justify-center gap-[22px] items-center"
    >
      <EInput
        :icon="mdiAccountOutline"
        label="login.category.label"
        placeholder="login.category.placeholder"
        v-model="category.label"
        :error="category.errors?.label"
      />
      <EInput
        :icon="mdiLockOutline"
        type="password"
        label="login.password.label"
        placeholder="login.password.placeholder"
        v-model="category.password"
        :error="category.errors?.password"
      />
      <div class="flex flex-col justify-start w-full">
        <span class="mb-2 text-gray-600">الوظيفة</span>
        <div>
          <label class="mx-4">
            <input
              type="radio"
              v-model="category.role"
              value="مدير"
              :checked="category.role == 'مدير'"
            />
            <span class="mx-2 text-gray-600">مدير</span>
          </label>
          <label>
            <input
              type="radio"
              v-model="category.role"
              value="موظف"
              :checked="category.role == 'موظف'"
            />
            <span class="mx-2 text-gray-600">موظف</span>
          </label>
        </div>
        <span
          v-if="category.errors?.role"
          v-text="category.errors?.role"
          class="error-message"
        />
      </div>
      <div class="flex flex-row justify-between items-center w-full">
        <button type="submit" class="btn btn-primary">
          {{ t("categories.buttons.submit") }}
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
import EInput from "../../components/input.vue";

let props = defineProps(["category"]);
let emits = defineEmits(["hide-modal"]);

const category = useForm({
  label: props.category.label,
  role: props.category.role,
  password: props.category.password,
});

function storeCategory() {
  category.patch(`/categories/${props.category.id}`, {
    onSuccess: () => {
      emits("hide-modal");
    },
  });
}
</script>
