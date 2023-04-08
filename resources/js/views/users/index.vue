<script lang="ts" setup>
import { mdiPencil } from "@mdi/js";
import { ref, Teleport } from "vue";
import { t } from "../../utils";
import UserRegister from "./user-register.vue";

defineProps(["users"]);
const modalIsVisible = ref(false);

function showUser(id) {
  return `/users/${id}`;
}
</script>
<template>
  <Teleport to="body">
    <UserRegister @hide-modal="modalIsVisible = false" v-if="modalIsVisible" />
  </Teleport>
  <header class="flex flex-row justify-between items-center mx-[90px] mt-10">
    <h1 class="text-2xl font-bold text-gray-500">المستخدمين</h1>
    <button @click="modalIsVisible = true" class="btn-icon p-2 my-2">
      <e-icon :name="mdiPencil" class="text-gray-400 h-10 w-10" />
    </button>
  </header>
  <e-card class="mx-[90px] mb-10 flex gap-4">
    <div
      v-for="user in users.data"
      class="w-3/12 rounded-lg ring-2 ring-gray-200 flex gap-4 flex-col items-center justify-around pb-4"
      v-if="users.data.length"
      :href="`/users/${user.id}`"
      :key="user.id"
    >
      <Link :href="showUser(user.id)" class="bg-gray-400 rounded-lg w-full">
        <img :src="user.photo" class="w-full object-cover h-auto" />
      </Link>
      <Link class="text-lg font-bold text-gray-500" :href="showUser(user.id)">
        {{ user.name }}
      </Link>
      <span class="rounded-full bg-gray-300 py-1 px-3">
        {{ user.role }}
      </span>
    </div>
  </e-card>
</template>
