<script lang="ts" setup>
import { mdiPencil, mdiArrowRight, mdiArrowLeft } from "@mdi/js";
import UserEdit from "./edit.vue";
import { ref, watch } from "vue";
import { uploadPhoto, filterLinks, fileSelector } from "../../utils";

const props = defineProps(["user", "documents", "errors"]);
const modalIsVisible = ref(false);

watch(props, () => {
  if (props.errors.name || props.errors.password || props.errors.role)
    modalIsVisible.value = true;
});
</script>
<template>
  <UserEdit
    :user="user"
    @hide-modal="modalIsVisible = false"
    v-if="modalIsVisible"
  />
  <div class="flex flex-row justify-between gap-10 w-11/12 mx-auto">
    <div class="w-3/12 flex flex-col items-center gap-4">
      <div class="flex flex-row justify-center items-center">
        <label class="flex flex-row relative w-36 h-36">
          <img
            :src="user.photo"
            class="edit-user-photo h-36 w-36 rounded-full ring-4 object-cover ring-gray-200"
          />
          <input
            type="file"
            class="hidden user-photo-input"
            accept="image/*"
            @input.prevent="
              (e) => uploadPhoto(e, '.edit-user-photo', `/users/${user.id}`)
            "
          />
          <button
            class="btn-icon absolute bg-green-100 top-24 left-0 shadow-md"
            type="button"
            @click.prevent="fileSelector('.edit-user-photo')"
          >
            <EIcon :name="mdiPencil" class="text-green-600 h-10 w-10" />
          </button>
        </label>
      </div>
      <h1 class="text-lg font-bold group-hover:text-primary-500 text-gray-500">
        {{ user.name }}
      </h1>
      <div class="flex flex-row justify-between items-center w-full">
        <span class="rounded-full bg-white text-gray-700 py-2 px-4">
          {{ user.role }}
        </span>

        <button @click="modalIsVisible = true" class="btn-icon p-4 my-2">
          <e-icon :name="mdiPencil" class="text-gray-400 h-10 w-10" />
        </button>
      </div>
    </div>
    <ECard class="w-9/12 mb-10">
      <h1 class="font-bold text-xl text-gray-500">المسودات</h1>
      <div class="w-full grid grid-cols-5 gap-16">
        <Link
          v-for="document in documents.data"
          class="group rounded-lg ring-2 ring-gray-200 hover:ring-4 hover:ring-primary-500 hover:shadow-2xl w-full flex gap-4 flex-col items-center justify-around pb-4"
          v-if="documents.data.length"
          :href="`/documents/${document.id}`"
          :key="user.id"
        >
        </Link>
      </div>
    </ECard>
  </div>
  <div
    v-if="documents.data.length"
    class="pb-10 flex gap-4 justify-end mx-[90px]"
  >
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon"
      :href="documents.links[0].url"
    >
      <EIcon :name="mdiArrowRight" />
    </Link>
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon"
      :href="link.url"
      v-for="(link, index) in filterLinks(documents.links)"
      :key="index"
      v-html="link.label"
    />
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon"
      :href="documents.links[documents.links.length - 1].url"
    >
      <EIcon :name="mdiArrowLeft" />
    </Link>
  </div>
</template>
