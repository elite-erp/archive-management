<template>
  <EModal @close="emits('hide-modal')">
    <h1 class="font-bold text-2xl text-gray-500 text-center">تسجيل تصنيف</h1>
    <form
      @submit.prevent="storeCategory"
      class="mt-8 flex flex-col justify-center gap-[18px] items-center"
    >
      <EInput
        :icon="mdiAccountOutline"
        label="categories.form.label"
        placeholder="categories.form.placeholder"
        v-model="category.label"
        :error="category.errors?.label"
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
import { mdiAccountOutline } from "@mdi/js";
import { t } from "../../utils";
import EModal from "../../components/modal.vue";

let emits = defineEmits(["hide-modal"]);

const category = useForm({
  label: "",
});

function storeCategory() {
  category.post("/categories", {
    onSuccess: () => {
      emits("hide-modal");
    },
  });
}
</script>
