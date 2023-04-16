<script lang="ts" setup>
import { mdiUploadOutline, mdiPencil, mdiPrinter, mdiTrashCan } from "@mdi/js";
import DocumentEdit from "./edit.vue";
import EModal from "../../components/modal.vue";
import { ref, watch } from "vue";
import { fileSelector } from "../../utils";
import { router } from "@inertiajs/vue3";

const props = defineProps(["document", "documents", "errors", "categories"]);
const modalIsVisible = ref(false);

watch(props, () => {
  if (Object.keys(props.errors).length) modalIsVisible.value = true;
});

function deleteAttachment() {
  router.delete(`/attachments/${attachmentToRemove.value}`, {
    onSuccess() {
      attachmentToRemove.value = null;
      showAttachmentConfirmDialog.value = false;
    },
  });
}

const showAttachmentConfirmDialog = ref(false);
const attachmentToRemove = ref<string | number | null>(null);

function confirmDeleteAttachment(id: string | number) {
  showAttachmentConfirmDialog.value = true;
  attachmentToRemove.value = id;
}

function setAttachments(e: any) {
  e.target.onchange = (fileChange: any) => {
    if (fileChange.target.files.length) {
      attachments.value = fileChange.target.files;
    }
  };
}

const attachments = ref([]);
watch(attachments, () => {
  router.post(
    "/attachments",
    {
      attachments: attachments.value,
      document_id: props.document.id,
    },
    {
      forceFormData: true,
    }
  );
});
</script>
<template>
  <DocumentEdit
    @hide-modal="modalIsVisible = false"
    v-if="modalIsVisible"
    :categories="categories"
    :document="document"
  />
  <div class="flex flex-row items-start justify-between gap-10 w-[90%] mx-auto">
    <ECard
      class="relative flex flex-col items-start gap-10 justify-between w-4/12"
    >
      <button
        @click="modalIsVisible = true"
        type="button"
        class="btn btn-icon p-3 w-14 group h-14 absolute top-10 left-4"
      >
        <EIcon
          :name="mdiPencil"
          title="تعديل"
          class="text-gray-400 group-hover:text-primary-400"
          size="h-8 w-8"
        />
      </button>
      <h2 class="flex flex-col justify-start">
        <span class="font-bold text-xl ml-4 text-gray-400"> مسودة</span>
      </h2>
      <h2 class="flex flex-col justify-start">
        <span class="ml-4 text-gray-400"> العنوان </span>
        <span class="font-bold text-lg text-gray-600">
          {{ document.title }}
        </span>
      </h2>
      <h2 class="flex-col flex gap-2">
        <span class="ml-4 text-gray-400"> التصنيف </span>
        <Link
          :href="`/categories/${document.category.id}`"
          class="bg-gray-200 text-gray-800 px-3 py-2 hover:bg-primary-200 hover:text-primary-800 rounded-lg"
        >
          {{ document.category.label }}
        </Link>
      </h2>
      <h2 class="flex-col flex gap-2 w-full">
        <span class="ml-4 text-gray-400"> الوصف </span>
        <span
          class="p-5 shadow ring ring-gray-100 text-gray-600 w-full rounded"
        >
          {{ document.description }}
        </span>
      </h2>
    </ECard>
    <div class="flex w-9/12 flex-col items-center gap-4 mb-10">
      <div
        class="relative h-[90%] rounded shadow"
        v-for="attachment in document.attachments"
        :key="attachment.id"
        v-if="document.attachments"
      >
        <button
          @click.prevent="confirmDeleteAttachment(attachment.id)"
          type="button"
          class="btn btn-icon p-2 ring group hover:bg-red-400 group-hover:text-white ring-red-200 w-10 h-10 absolute top-10 left-10"
        >
          <EIcon
            :name="mdiTrashCan"
            size="h-6 w-6"
            class="text-red-400 group-hover:bg-red-400 group-hover:text-white"
          />
        </button>
        <img :src="attachment.path" class="w-full h-full rounded-lg" />
      </div>
      <div
        v-else
        class="flex flex-row items-center justify-center font-bold text-lg text-yellow-500"
      >
        لا يوجد مرفقات لهذه المسودة
      </div>
    </div>
    <div class="flex flex-col gap-2">
      <button
        @click.prevent="fileSelector('.document-photo-input')"
        type="button"
        class="btn btn-icon p-3 w-14 h-14 group"
      >
        <EIcon
          :name="mdiUploadOutline"
          class="text-gray-700 group-hover:text-primary-500"
          size="h-8 w-8"
        />
      </button>
      <Link
        :href="`/documents/${document.id}/print`"
        class="btn inline-block btn-icon p-3 w-14 h-14 group"
      >
        <EIcon
          class="text-gray-700 group-hover:text-primary-500"
          :name="mdiPrinter"
          size="h-8 w-8"
        />
      </Link>
    </div>
  </div>
  <input
    type="file"
    class="hidden document-photo-input"
    multiple
    accept="image/*"
    @input.prevent="setAttachments"
  />

  <EModal
    class="w-full h-full"
    card-classes="items-center justify-center gap-4 p-10"
    @click.prevent="showAttachmentConfirmDialog = false"
    @close="showAttachmentConfirmDialog = false"
    v-if="showAttachmentConfirmDialog"
  >
    <h2 class="text-2xl text-gray-600">حذف</h2>
    <strong class="text-gray-500">هل أنت متأكد أنك تريد حذف المرفق ؟</strong>
    <div class="mt-4 w-full flex flex-row items-center justify-around">
      <button
        class="btn bg-red-400/90 text-white"
        @click.prevent="deleteAttachment"
      >
        نعم
      </button>
      <button
        @click.prevent="showAttachmentConfirmDialog = false"
        class="btn bg-secondary bg-gray-100 text-gray-400"
      >
        إلغاء
      </button>
    </div>
  </EModal>
</template>
