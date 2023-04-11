<script lang="ts" setup>
import { mdiPencil, mdiArrowRight, mdiArrowLeft } from "@mdi/js";
import { ref, Teleport, watch } from "vue";
import UserRegister from "./register.vue";

const props = defineProps(["users", "errors"]);

const modalIsVisible = ref(false);

watch(props, () => {
  if (props.errors.name || props.errors.password || props.errors.role)
    modalIsVisible.value = true;
});

function showUser(id: string | number) {
  return `/users/${id}`;
}
function filter(links: Record<string, any>[]) {
  return links.slice(1, links.length - 1);
}
</script>
<template>
  <Teleport to="body">
    <UserRegister @hide-modal="modalIsVisible = false" v-if="modalIsVisible" />
  </Teleport>
  <header class="flex flex-row justify-between items-center mx-[90px] mt-4">
    <h1 class="text-2xl font-bold text-gray-500">المستخدمين</h1>
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
  <ECard class="mx-[90px] mb-10 grid-cols-5 grid gap-16">
    <Link
      v-for="user in users.data"
      class="group rounded-lg ring-2 ring-gray-200 hover:ring-4 hover:ring-primary-500 hover:shadow-2xl w-full flex gap-4 flex-col items-center justify-between pb-4"
      v-if="users.data.length"
      :href="showUser(user.id)"
      :key="user.id"
    >
      <div class="bg-gray-400 rounded-lg w-full h-2/3">
        <img :src="user.photo" class="w-full object-cover h-full rounded-lg" />
      </div>
      <h1
        class="text-lg font-bold group-hover:text-primary-500 text-center text-gray-500 px-2"
      >
        {{ user.name }}
      </h1>
      <span class="rounded-full bg-gray-300 py-1 px-3 mx-2 text-center">
        {{ user.role }}
      </span>
    </Link>
  </ECard>
  <div class="pb-10 flex gap-4 justify-end mx-[90px]">
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon"
      :href="users.links[0].url"
    >
      <EIcon :name="mdiArrowRight" />
    </Link>
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon"
      :href="link.url"
      v-for="(link, index) in filter(users.links)"
      :key="index"
      v-html="link.label"
    />
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon"
      :href="users.links[users.links.length - 1].url"
    >
      <EIcon :name="mdiArrowLeft" />
    </Link>
  </div>
</template>
