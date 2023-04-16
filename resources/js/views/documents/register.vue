<template>
  <h1 class="font-bold text-2xl text-gray-500 mx-[90px] mb-2">تسجيل مسودة</h1>

  <ECard class="mx-[90px] w-auto">
    <form
      @submit.prevent="storeUser"
      class="mt-8 flex flex-col justify-center gap-[18px] items-center"
    >
      <EInput
        :icon="mdiAccountOutline"
        label="documents.title.label"
        placeholder="documents.title.placeholder"
        v-model="document.title"
        :error="document.errors?.title"
      />
      <EInput
        :icon="mdiLockOutline"
        type="textarea"
        label="documents.description.label"
        placeholder="documents.description.placeholder"
        :error="document.errors?.description"
        v-model="document.description"
      />
      <ESelect
        :icon="mdiLockOutline"
        :list="categories"
        option-text="label"
        option-value="id"
        label="documents.category.label"
        placeholder="documents.category.placeholder"
        :error="document.errors?.category_id"
        v-model="document.category_id"
      />
      <div
        class="ring ring-gray-400 bg-gray-100 items-center rounded p-5 w-full h-90 grid grid-cols-5 gap-4"
      >
        <div
          v-for="(attachment, index) in attachments"
          class="h-80 group rounded-lg relative ring-2 ring-gray-200 hover:ring-4 hover:ring-primary-500 hover:shadow-2xl w-full flex flex-col items-center justify-between"
          v-if="attachments.length"
          :key="index"
        >
          <img
            :src="attachment.url"
            class="absolute w-full object-cover h-80 rounded-lg"
          />
          <button
            type="button"
            @click.prevent="attachments.splice(index, 1)"
            class="bg-red-200 text-red-500 flex items-center justify-center text-lg p-3 font-bold focus:outline-none shadow rounded-full bottom-10 absolute group/button group-hover/button:text-red-200 hover:bg-red-400 hover:shadow-xl"
          >
            <EIcon
              :name="mdiTrashCanOutline"
              class="group-hover/button:text-red-200 group-hover/button:bg-red-400"
              size="w-8 h-8"
            />
          </button>
        </div>
        <label
          class="flex flex-row items-center relative rounded-lg hover:shadow-lg hover:bg-primary-200 bg-gray-200 w-36 h-36"
        >
          <EIcon
            @click.prevent="fileSelector('.document-photo-input')"
            :name="mdiUploadMultiple"
            size="h-40 w-40"
            class="p-4 rounded-lg text-gray-400 hover:text-primary-400 cursor-pointer"
          />
          <input
            type="file"
            class="hidden document-photo-input"
            multiple
            accept="image/*"
            @input.prevent="setAttachments"
          />
        </label>
      </div>
      <div class="flex flex-row justify-between items-center w-full">
        <button type="submit" class="btn btn-primary">
          {{ t("buttons.submit") }}
        </button>
        <button
          type="reset"
          @click.prevent="emits('hide-modal')"
          class="btn btn-secondary"
        >
          {{ t("buttons.clear") }}
        </button>
      </div>
    </form>
  </ECard>
</template>
<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import _ from "lodash";
import {
  mdiAccountOutline,
  mdiLockOutline,
  mdiTrashCanOutline,
  mdiUploadMultiple,
} from "@mdi/js";
import { t, fileSelector } from "../../utils";
import ESelect from "../../components/select.vue";
import { ref } from "vue";

let emits = defineEmits(["hide-modal"]);
defineProps(["categories"]);

const document = useForm({
  title: "",
  description: "",
  category_id: null,
  attachments: [] as any[],
});

function setAttachments(e: any) {
  e.target.onchange = (fileChange: any) => {
    if (fileChange.target.files.length) {
      for (let file of fileChange.target.files) {
        let reader = new FileReader();
        reader.readAsDataURL(file); // this is reading as data url

        reader.onload = (readerEvent) => {
          attachments.value.push({
            url: readerEvent.target.result,
            file: file,
          });
        };
      }
    }
  };
}
const attachments = ref<any[]>([]);
function storeUser() {
  document.attachments = attachments.value.map((attach) => {
    return attach.file;
  });
  document.post("/documents", {
    onSuccess: () => {
      emits("hide-modal");
    },
  });
}
</script>
