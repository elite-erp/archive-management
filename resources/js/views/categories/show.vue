<script lang="ts" setup>
import { mdiPencil } from "@mdi/js";
import { ref, watch } from "vue";
import CategoryEdit from "./edit.vue";
import EPagination from "../../components/pagination.vue";

const props = defineProps(["category", "documents", "errors"]);

const modalIsVisible = ref(false);

watch(props, () => {
  if (Object.keys(props.errors).length) modalIsVisible.value = true;
});
</script>

<template>
  <CategoryEdit
    :category="category"
    @hide-modal="modalIsVisible = false"
    v-if="modalIsVisible"
  />
  <header class="flex flex-row justify-between items-center mx-[90px] mt-4">
    <h1 class="text-2xl font-bold text-gray-500">
      <span>التصنيف: </span>
      <span>{{ category.label }}</span>
    </h1>
    <button
      @click="modalIsVisible = true"
      class="btn-icon px-2 py-1 my-2 flex flex-row group hover:text-primary-600 justify-between gap-2 items-center"
    >
      <e-icon
        :name="mdiPencil"
        class="text-gray-400 group-hover:text-primary-600 h-10 w-10"
      />
      <span class="text-gray-500 group-hover:text-primary-600">تعديل</span>
    </button>
  </header>
  <ECard class="mx-[90px] mb-10 grid-cols-4 grid gap-10">
    <Link
      v-for="document in documents.data"
      class="h-80 group rounded-lg relative ring-2 ring-gray-200 hover:ring-4 hover:ring-primary-500 hover:shadow-2xl w-full flex gap-4 flex-col items-center justify-between pb-4"
      v-if="documents.data.length"
      :href="`/documents/${document.id}`"
      :key="document.id"
    >
      <img
        :src="document.attachments[0]?.path"
        class="absolute w-full object-cover h-80 rounded-lg"
      />
      <div
        class="bg-gray-500/50 absolute bottom-0 flex flex-col justify-around items-center rounded-lg w-full h-1/3"
      >
        <h1
          class="text-lg font-bold group-hover:text-primary-800 text-center text-gray-800 px-2"
        >
          {{ document.title }}
        </h1>
        <span class="rounded-full bg-white py-1 px-3 mx-2 text-center">
          {{ document.category.label }}
        </span>
      </div>
    </Link>
  </ECard>
  <EPagination :list="documents" />
</template>
