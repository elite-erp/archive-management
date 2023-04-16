<template>
  <div class="pb-10 text-gray-500 flex gap-4 justify-end mx-[90px]">
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon hover:text-primary-500 hover:font-bold"
      :href="list.links[0].url"
    >
      <EIcon :name="mdiArrowRight" />
    </Link>
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon hover:text-primary-500 hover:font-bold"
      :href="link.url"
      v-for="(link, index) in filteredLinks"
      :key="index"
      v-html="link.label"
    />
    <Link
      class="h-10 w-10 inline-flex justify-center items-center btn-icon hover:text-primary-500 hover:font-bold"
      :href="list.links[list.links.length - 1].url"
    >
      <EIcon :name="mdiArrowLeft" />
    </Link>
  </div>
</template>
<script lang="ts" setup>
import { mdiArrowRight, mdiArrowLeft } from "@mdi/js";
import { computed } from "vue";
import { filterLinks } from "../utils";
interface Props {
  list: List;
}
interface List {
  links: Link[];
}
interface Link {
  url: string;
  label: string;
}

const props = defineProps(["list"]) as Props;

const filteredLinks = computed(() => filterLinks<Link>(props.list.links));
</script>
