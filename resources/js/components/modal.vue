<template>
  <section
    class="fixed flex flex-row justify-center items-center top-0 left-0 bg-gray-500/50 min-h-screen h-full w-screen overflow-y-hidden"
    @click.self="emits('close')"
  >
    <ECard class="w-6/12 max-h-[94%] flex flex-col">
      <slot />
    </ECard>
  </section>
</template>

<script setup>
import { onMounted, onUnmounted } from "vue";

const emits = defineEmits(["close"]);
onMounted(() => {
  document.body.classList = "overflow-y-clip";
});
onUnmounted(() => {
  document.body.classList = "";
});
</script>
