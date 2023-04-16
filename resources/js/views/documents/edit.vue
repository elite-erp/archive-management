<template>
  <EModal @close="emits('hide-modal')">
    <h1 class="font-bold text-2xl text-gray-500 text-center">تعديل مسودة</h1>
    <form
      @submit.prevent="storeDocument"
      class="mt-8 flex flex-col justify-center gap-[22px] items-center"
    >
      <EInput
        :icon="mdiAccountOutline"
        label="documents.title.label"
        placeholder="documents.title.placeholder"
        v-model="document.title"
        :error="document.errors?.title"
      />
      <EInput
        :icon="mdiLockOutline"
        type="textarea"
        label="documents.description.label"
        placeholder="documents.description.placeholder"
        :error="document.errors?.description"
        v-model="document.description"
      />
      <ESelect
        :icon="mdiLockOutline"
        :list="categories"
        option-text="label"
        option-value="id"
        label="documents.category.label"
        placeholder="documents.category.placeholder"
        :error="document.errors?.category_id"
        v-model="document.category_id"
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
import { t } from "../../utils";
import EModal from "../../components/modal.vue";
import ESelect from "../../components/select.vue";

let props = defineProps(["document", "categories"]);
let emits = defineEmits(["hide-modal"]);

const document = useForm({
  title: props.document.title,
  description: props.document.description,
  category_id: props.document.category_id,
});

function storeDocument() {
  document.patch(`/documents/${props.document.id}`, {
    onSuccess: () => {
      emits("hide-modal");
    },
  });
}
</script>
