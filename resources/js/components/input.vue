<template>
  <label class="w-full h-24 gap-2 flex flex-col-reverse relative">
    <span v-if="error" v-text="error" class="error-message" />
    <!-- 

    set input first to use peer class to handle focus state.
    tailwindcss or generally sibiling selector can not work with previus elements.
    so I reversed them in order when setting. button use flex-col-reverse to render
    them in reverse.

    (e: any) is typescript syntax
    -->
    <input
      :value="modelValue"
      :type="type || 'text'"
      class="peer h-16 pl-4 py-2 border border-gray-400 outline-none text-gray-600 focus:outline-none rounded-lg focus:border-primary-700"
      :placeholder="t(placeholder)"
      :class="icon.length ? 'pr-12' : 'pr-4'"
      @input.prevent="(e: any) => emits('update:modelValue', e.target?.value)"
    />
    <span class="text-gray-600 peer-focus:text-primary-800 text-sm">{{
      t(label)
    }}</span>
    <icon
      class="w-6 h-6 absolute right-4 bottom-[20px] text-gray-500 peer-focus:text-primary-800"
      v-if="icon"
      :name="icon"
    />
  </label>
</template>
<script lang="ts" setup>
import { t } from "../utils";
import icon from "./icon.vue";

defineProps(["label", "icon", "placeholder", "modelValue", "type", "error"]);

let emits = defineEmits(["update:modelValue"]);
</script>
