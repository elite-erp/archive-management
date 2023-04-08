<template>
  <EModal>
    <h1 class="font-bold text-2xl text-gray-500 text-center">تسجيل مستخدم</h1>
    <form
      @submit.prevent="storeUser"
      class="mt-8 flex flex-col justify-center gap-[22px] items-center"
    >
      <label class="flex flex-row relative w-36 h-36">
        <img
          src="/imgs/user.png"
          class="register-user-photo w-36 h-36 rounded-full ring-4 object-cover ring-gray-200"
        />
        <input
          type="file"
          class="hidden user-photo-input"
          accept="image/*"
          @input.prevent="changePhoto"
        />
        <button
          class="btn-icon absolute bg-green-100 top-24 left-0 shadow-md"
          type="button"
          @click.prevent="selectFile"
        >
          <EIcon :name="mdiPencil" class="text-green-600 h-10 w-10" />
        </button>
      </label>
      <EInput
        :icon="mdiAccountOutline"
        label="login.user.label"
        placeholder="login.user.placeholder"
        v-model="user.name"
      />
      <EInput
        :icon="mdiLockOutline"
        type="password"
        label="login.password.label"
        placeholder="login.password.placeholder"
        v-model="user.password"
      />
      <div class="flex flex-col justify-start w-full">
        <span class="mb-2 text-gray-600">الوظيفة</span>
        <div>
          <label class="mx-4">
            <input type="radio" v-model="user.role" value="مدير" />
            <span class="mx-2 text-gray-600">مدير</span>
          </label>
          <label>
            <input type="radio" v-model="user.role" value="موظف" />
            <span class="mx-2 text-gray-600">موظف</span>
          </label>
        </div>
      </div>
      <div class="flex flex-row justify-between items-center w-full">
        <button type="submit" class="btn btn-primary">
          {{ t("login.buttons.submit") }}
        </button>
        <button type="submit" class="btn btn-secondary">
          {{ t("login.buttons.clear") }}
        </button>
      </div>
    </form>
  </EModal>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { mdiAccountOutline, mdiLockOutline, mdiPencil } from "@mdi/js";
import { t } from "../../utils";
import EModal from "../../components/modal.vue";
import EInput from "../../components/input.vue";

let emits = defineEmits("hide-modal");

function selectFile() {
  document.querySelector(".user-photo-input")?.click();
}

const user = useForm({
  name: "",
  password: "",
  photo: null,
  role: "",
});

function changePhoto(e: any) {
  e.target.onchange = (fileChange: any) => {
    if (fileChange.target.files.length) {
      let photo: any = document.querySelector("img.register-user-photo");

      // setting up the reader
      let reader = new FileReader();
      reader.readAsDataURL(fileChange.target?.files[0]); // this is reading as data url

      reader.onload = (readerEvent) => {
        var content = readerEvent.target.result; // this is the content!
        if (photo != null) photo.src = content;
        user.photo = fileChange.target.files[0];
      };
    }
  };
}

function storeUser() {
  user.post("/users");
  emits("hide-modal");
}
</script>
