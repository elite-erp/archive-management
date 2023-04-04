<script lang="ts" setup>
import { router } from "@inertiajs/vue3";
import { reactive } from "vue";

let user = reactive({
  name: "",
  password: "",
});
function authenticate() {
  router.post("/authenticate", user);
}
</script>
<template>
  <form @submit.prevent="authenticate">
    user <input v-model="user.name" />
    <br />
    password <input v-model="user.name" />
    <br />
    <button type="submit">login</button>
  </form>
</template>
