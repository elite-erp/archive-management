<template>
  <Teleport to="body">
    <section
      class="absolute flex flex-row justify-center items-center top-0 left-0 bg-gray-500/50 min-h-screen h-full w-screen overflow-y-hidden"
      @click.self="emits('close')"
    >
      <ECard
        :class="cardClasses"
        class="w-6/12 min-h-fit max-h-[94%] flex flex-col pt-2"
      >
        <slot />
      </ECard>
    </section>
  </Teleport>
</template>

<script lang="ts" setup>
import { onMounted, onUnmounted, Teleport } from "vue";

defineProps(["cardClasses"]);

const emits = defineEmits(["close"]);
onMounted(() => {
  document.body.setAttribute("class", "overflow-y-clip");
});
onUnmounted(() => {
  document.body.setAttribute("class", "");
});
</script>
