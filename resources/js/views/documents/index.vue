<script lang="ts" setup>
import { mdiPencil } from "@mdi/js";
import EPagination from "../../components/pagination.vue";
import { useSearch } from "../../search";
import EDocumentsGrid from "../../components/documents-grid.vue";

useSearch("/documents");

defineProps(["documents"]);
</script>

<template>
  <header class="flex flex-row justify-between items-center mx-[90px] mt-4">
    <h1 class="text-2xl font-bold text-gray-500">المسودات</h1>
    <Link
      href="/documents/create"
      class="btn-icon px-2 py-1 my-2 flex flex-row group hover:text-primary-600 justify-between gap-2 items-center"
    >
      <e-icon
        :name="mdiPencil"
        class="text-gray-400 group-hover:text-primary-600 h-10 w-10"
      />
      <span class="text-gray-500 group-hover:text-primary-600">تسجيل</span>
    </Link>
  </header>
  <ECard class="mx-[90px] mb-10">
    <EDocumentsGrid :documents="documents" :cols="4" />
  </ECard>
  <EPagination :list="documents" />
</template>
