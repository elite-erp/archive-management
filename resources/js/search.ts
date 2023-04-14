import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";


const search = ref('');


export function useSearch(url?: string) {
  if (url) {
    watch(search, () => {
      router.visit(`${url}?search=${search.value}`);
    });
  }

  return search
}
