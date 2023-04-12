<template>
  <svg
    class="flex justify-center items-center"
    :class="size || 'h-6 w-6'"
    viewBox="0 0 24 24"
  >
    <path v-if="name.length" :d="name" class="fill-current" />
  </svg>
</template>
<script lang="ts" setup>
defineProps(["name", "size"]);
</script>
