<template>
  <div class="w-1/2 flex flex-col items-center justify-between gap-8">
    <div class="flex flex-row w-[246px] h-[128px] rounded-xl shadow-md">
      <div class="w-1/2 bg-white p-5 rounded-r-xl">
        <e-icon :name="icon" size="w-20 h-20" class="text-gray-400" />
      </div>
      <div
        class="rounded-l-xl w-1/2 flex py-4 flex-col items-center justify-around bg-gray-200"
      >
        <h2 class="font-bold text-4xl text-gray-500">
          {{ count }}
        </h2>
        <span class="text-gray-500 font-medium">{{ label }}</span>
      </div>
    </div>
    <slot />
  </div>
</template>
<script lang="ts" setup>
defineProps(["count", "icon", "label"]);
</script>
