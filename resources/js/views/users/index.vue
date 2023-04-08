<script lang="ts" setup>
import { mdiPencil } from "@mdi/js";
import { ref, Teleport } from "vue";
import { t } from "../../utils";
import UserRegister from "./user-register.vue";

defineProps(["users"]);
const modalIsVisible = ref(false);
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
  <e-card class="mx-[90px] mb-10">
    <div v-for="user in users.data" v-if="users.data.length" :key="user.id">
      <img :src="user.photo" />
      <h3>
        {{ user.name }}
      </h3>
      <span>
        {{ user.role }}
      </span>
    </div>
  </e-card>
</template>
