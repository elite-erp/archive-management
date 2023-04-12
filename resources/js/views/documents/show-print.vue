<script lang="ts" setup>
import { mdiPrinter } from "@mdi/js";

defineProps(["document"]);

function print() {
  window.print();
}
</script>
<template>
  <div
    class="w-[90%] mx-auto items-center print:hidden flex flex-row justify-between gap-2 mb-3"
  >
    <h1 class="font-bold text-xl text-gray-500">
      طباعة:
      <Link
        class="text-primary-500 hover:underline"
        :href="`/documents/${document.id}`"
        >{{ document.title }}</Link
      >
    </h1>
    <button
      type="button"
      @click="print()"
      class="btn inline-block btn-icon p-3 w-14 h-14"
    >
      <EIcon :name="mdiPrinter" size="h-8 w-8" />
    </button>
  </div>

  <div
    class="flex flex-row items-start justify-between print:table gap-10 print:w-full print:h-auto w-[90%] mx-auto"
  >
    <ECard class="print:p-0 print:table flex flex-col gap-10">
      <img
        v-for="attachment in document.attachments"
        :key="attachment.id"
        :src="attachment.path"
        class="print:w-full print:h-auto w-full h-auto"
      />
    </ECard>
  </div>
</template>
<style>
@media print {
  img {
    page-break-inside: avoid; /* or 'auto' */
  }
}
</style>
