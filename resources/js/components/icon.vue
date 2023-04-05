<template>
  <svg
    class="flex justify-center items-center"
    :class="props.size ? props.size : 'h-6 w-6'"
    viewBox="0 0 24 24"
  >
    <path :d="props.name" class="fill-current stroke-transparent" />
  </svg>
</template>
<script lang="ts" setup>
let props = defineProps(["name", "size"]);
</script>
