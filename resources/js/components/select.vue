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
    <select
      :value="modelValue"
      class="peer h-16 px-4 py-2 border border-gray-400 outline-none text-gray-600 focus:outline-none rounded-lg focus:border-primary-700"
      :placeholder="t(placeholder)"
      @change.prevent="(e: any) => $emit('update:modelValue', e.target?.value)"
    >
      <option
        v-for="item in list"
        :key="item[optionValue]"
        :value="item[optionValue]"
        v-text="item[optionText]"
      />
    </select>
    <span class="text-gray-600 peer-focus:text-primary-800 text-sm">{{
      t(label)
    }}</span>
  </label>
</template>
<script lang="ts" setup>
import { t } from "../utils";

defineProps([
  "optionText",
  "optionValue",
  "label",
  "list",
  "placeholder",
  "modelValue",
  "error",
]);
</script>
