<script lang="ts" setup>
import { mdiPencil } from "@mdi/js";
import { ref, watch } from "vue";
import CategoryRegister from "./register.vue";
import EPagination from "../../components/pagination.vue";
import { useSearch } from "../../search";

const props = defineProps(["categories", "errors"]);

const modalIsVisible = ref(false);

useSearch("/categories");

watch(props, () => {
  if (Object.keys(props.errors).length) modalIsVisible.value = true;
});
</script>
<template>
  <CategoryRegister
    @hide-modal="modalIsVisible = false"
    v-if="modalIsVisible"
  />
  <header class="flex flex-row justify-between items-center mx-[90px] mt-4">
    <h1 class="text-2xl font-bold text-gray-500">التصنيفات</h1>
    <button
      @click="modalIsVisible = true"
      class="btn-icon px-2 py-1 my-2 flex flex-row group hover:text-primary-600 justify-between gap-2 items-center"
    >
      <e-icon
        :name="mdiPencil"
        class="text-gray-400 group-hover:text-primary-600 h-10 w-10"
      />
      <span class="text-gray-500 group-hover:text-primary-600">تسجيل</span>
    </button>
  </header>
  <div class="mx-[90px] w-auto">
    <div class="mb-10" v-for="category in categories.data" :key="category.id">
      <Link
        :href="`/categories/${category.id}`"
        class="text-primary-600 inline-flex gap-4 text-lg flex-row items-center justify-between"
      >
        <span class="hover:underline">{{ category.label }}</span>
        <span class="text-sm text-gray-400">
          {{ category.documents_count }}
        </span>
      </Link>
      <ECard
        v-if="category.documents.length"
        class="mb-10 grid-cols-4 grid gap-10"
      >
        <Link
          v-for="document in category.documents"
          class="h-80 group rounded-lg relative ring-2 ring-gray-200 hover:ring-4 hover:ring-primary-500 hover:shadow-2xl w-full flex gap-4 flex-col items-center justify-between pb-4"
          v-if="category.documents.length"
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
      </ECard>
    </div>
  </div>
  <EPagination :list="categories" />
</template>
