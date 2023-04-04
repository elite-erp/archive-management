<script lang="ts" setup>
defineProps(["user"]);
</script>
<template>
  <div>
    <img :src="user.photo" />
    <div class="text-xl">
      <span class="font-bold">{{ user.name }}</span>
      <span>{{ user.isAdmin ? "مدير" : "موظف" }}</span>
      <button>edit</button>
    </div>
  </div>
</template>
