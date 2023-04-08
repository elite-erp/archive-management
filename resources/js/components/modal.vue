<template>
  <section
    class="absolute flex flex-row justify-center items-center top-0 left-0 bg-gray-500/50 h-screen w-screen"
    @click.self="emits('close')"
  >
    <ECard class="w-6/12 h-[94%] flex flex-col">
      <slot />
    </ECard>
  </section>
</template>

<script setup>
const emits = defineEmits(["close"]);
</script>
