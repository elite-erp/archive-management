<script lang="ts" setup>
import {
  mdiUploadOutline,
  mdiPencil,
  mdiArrowRight,
  mdiArrowLeft,
  mdiPrinter,
} from "@mdi/js";
import UserEdit from "./edit.vue";
import { ref, watch } from "vue";
import { uploadPhoto, filterLinks, fileSelector } from "../../utils";

const props = defineProps(["document", "documents", "errors"]);
const modalIsVisible = ref(false);

watch(props, () => {
  if (Object.keys(props.errors).length) modalIsVisible.value = true;
});
</script>
<template>
  <div class="flex flex-row items-start justify-between gap-10 w-[90%] mx-auto">
    <ECard class="flex flex-col items-start gap-10 justify-between w-4/12">
      <h1 class="flex flex-col justify-start">
        <span class="ml-4"> مسودة :</span>
        <span class="">
          {{ document.title }}
        </span>
      </h1>
      <span class="bg-gray-200 px-3 py-2 rounded-lg">
        {{ document.category.label }}
      </span>
      <span>
        {{ document.description }}
      </span>
    </ECard>
    <ECard>
      <img
        v-for="attachment in document.attachments"
        :key="attachment.id"
        :src="attachment.path"
        class="w-auto h-[90%]"
      />
    </ECard>
    <div class="flex flex-col gap-2">
      <button type="button" class="btn btn-icon p-3 w-14 h-14">
        <EIcon :name="mdiUploadOutline" size="h-8 w-8" />
      </button>
      <Link
        :href="`/documents/${document.id}/print`"
        class="btn inline-block btn-icon p-3 w-14 h-14"
      >
        <EIcon :name="mdiPrinter" size="h-8 w-8" />
      </Link>
    </div>
  </div>
</template>
