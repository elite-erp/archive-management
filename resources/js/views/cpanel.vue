<template>
  <div class="flex flex-row items-center min-h-[87vh] w-[80%] mx-auto">
    <div class="flex flex-row items-center justify-around w-1/2">
      <ECount
        :icon="mdiFolderOutline"
        label="التصنيفات"
        :count="categories_count"
      >
        <Link
          href="/categories"
          class="btn btn-secondary rounded-2xl w-[80%] flex flex-row justify-around items-center"
        >
          <e-icon :name="mdiPencil" size="w-6 h-6" class="text-primary-400" />
          <span class="text-primary-500 font-bold">أضف تصنيف</span>
        </Link>
      </ECount>
      <ECount :icon="mdiFileDocument" label="المسودات" :count="documents_count">
        <Link
          href="/documents/create"
          class="btn btn-primary rounded-2xl w-[80%] flex flex-row justify-around items-center"
        >
          <e-icon :name="mdiPencil" size="w-6 h-6" class="text-white" />
          <span class="text-white font-bold">أضف مسودة</span>
        </Link>
      </ECount>
    </div>

    <div></div>
  </div>
</template>
<script lang="ts" setup>
import { mdiFileDocument, mdiFolderOutline, mdiPencil } from "@mdi/js";
import ECount from "../components/counter.vue";
defineProps(["categories_count", "documents_count"]);
</script>
