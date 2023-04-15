<template>
  <div
    v-if="documents.data.length"
    class="w-full grid gap-10"
    :class="columns(cols || 3)"
  >
    <Link
      v-for="document in documents.data"
      class="h-80 group rounded-lg relative ring-2 ring-gray-200 hover:ring-4 hover:ring-primary-500 hover:shadow-2xl w-full flex gap-4 flex-col items-center justify-between pb-4"
      :href="`/documents/${document.id}`"
      :key="document.id"
    >
      <img
        :src="document.photo"
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
  </div>
  <div
    v-else
    class="w-full h-full text-yellow-400 font-bold text-2xl flex justify-center items-center"
  >
    لا يوجد نتائج
  </div>
</template>
<script lang="ts" setup>
defineProps(["documents", "cols"]);
function columns(cols: number) {
  switch (cols) {
    case 3:
      return "grid-cols-3";
    case 4:
      return "grid-cols-4";
    case 5:
      return "grid-cols-5";
    case 6:
      return "grid-cols-6";
  }
}
</script>
