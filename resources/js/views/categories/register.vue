<template>
  <EModal @close="emits('hide-modal')">
    <h1 class="font-bold text-2xl text-gray-500 text-center">تسجيل مستخدم</h1>
    <form
      @submit.prevent="storeCategory"
      class="mt-8 flex flex-col justify-center gap-[18px] items-center"
    >
      <label class="flex flex-row relative w-36 h-36">
        <img
          src="/imgs/category.png"
          class="register-category-photo w-36 h-36 rounded-full ring-4 object-cover ring-gray-200"
        />
        <input
          type="file"
          class="hidden category-photo-input"
          accept="image/*"
          @input.prevent="
            (e) => changePhoto(e, 'img.register-category-photo', category)
          "
        />
        <button
          class="btn-icon absolute bg-green-100 top-24 left-0 shadow-md"
          type="button"
          @click.prevent="fileSelector('.category-photo-input')"
        >
          <EIcon :label="mdiPencil" class="text-green-600 h-10 w-10" />
        </button>
      </label>
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
        :error="category.errors?.password"
        v-model="category.password"
      />
      <div class="flex flex-col justify-start w-full">
        <span class="mb-2 text-gray-600">الصلاحية</span>
        <div>
          <label class="mx-4">
            <input type="radio" v-model="category.role" value="مدير" />
            <span class="mx-2 text-gray-600">مدير</span>
          </label>
          <label>
            <input type="radio" v-model="category.role" value="موظف" />
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
import { mdiAccountOutline, mdiLockOutline, mdiPencil } from "@mdi/js";
import { t, changePhoto, fileSelector } from "../../utils";
import EModal from "../../components/modal.vue";
import EInput from "../../components/input.vue";

let emits = defineEmits(["hide-modal"]);

const category = useForm({
  label: "",
  password: "",
  photo: null,
  role: "",
});

function storeCategory() {
  category.post("/categories", {
    onSuccess: () => {
      emits("hide-modal");
    },
  });
}
</script>
