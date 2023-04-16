<template>
  <Teleport to="body">
    <ECard
      v-if="show"
      class="message fixed top-20 left-10 px-0 py-5 pb-0 bg-green-200/90 text-green-600 font-bold shadow-xl flex flex-col gap-4 items-start w-60"
    >
      <span class="w-full text-center">{{ message }}</span>
      <div class="progress rounded-b-lg">&nbsp;</div>
    </ECard>
  </Teleport>
</template>
<script lang="ts" setup>
import { usePage } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";

const show = ref(false);

const message = computed(() => usePage().props.message as string);

watch(
  message,
  (value) => {
    if (value?.length) {
      show.value = true;
      setTimeout(() => (show.value = false), 10000);
    }
  },
  { immediate: true }
);
</script>

<style lang="postcss" scoped>
.progress {
  @apply transition-all h-3 bg-green-400;
  animation: animateWidth 10s ease-in-out forwards;
}
.message {
  animation: bounce 1.2s;
  animation-iteration-count: 3;
}

@keyframes animateWidth {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}

@keyframes bounce {
  0%,
  100% {
    transform: translateY(-25%);
    animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
  }
  50% {
    transform: translateY(0);
    animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
  }
}
</style>
