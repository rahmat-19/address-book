<script setup>
import { inject, onMounted, ref } from "vue";
import { useRouter, useRoute } from "vue-router";
import {
  updateData,
  getData,
} from "../../components/utils/ImplementApiContact";

const router = useRouter();
const route = useRoute();

const errors = ref(null);
const showNotification = inject("showNotification");

const formData = ref({
  name: "",
  category: "",
  phone_number: "62",
  address: "",
  imageUrl: null,
  image: null,
});

const submitForm = async () => {
  try {
    await updateData(route.params.id, formData.value);
    showNotification("Update Contact Sucessfuly", "success");
    router.push({ name: "users.index" });
  } catch (error) {
    errors.value = error.response.data;
  }
};

const getUserSelected = async (id) => {
  const { data } = (await getData(id)).data;
  formData.value.name = data.name;
  formData.value.category = data.category;
  formData.value.phone_number = data.phone_number;
  formData.value.address = data.address;
  formData.value.imageUrl = data.image ? `http://localhost:8000${data.image}` : null;
};
const onFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    formData.value.imageUrl = URL.createObjectURL(file);
    formData.value.image = file;
  }
};
onMounted(() => {
  if (route.params.id) {
    getUserSelected(route.params.id);
  }
});
</script>

<template>
  <div class="form-container">
    <form @submit.prevent="submitForm">
      <div class="image-upload">
        <div v-if="formData.imageUrl" class="image-preview">
          <img :src="formData.imageUrl" alt="Image Preview" />
        </div>
        <input id="file-input" type="file" @change="onFileChange" />
        <label for="file-input" class="custom-file-upload">
          Upload Image
        </label>
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="formData.name" />

        <p
          v-if="errors?.errors?.name"
          v-for="item in errors?.errors.name"
          class="mesage-error"
        >
          {{ item }}
        </p>
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" v-model="formData.category">
          <option value="">Select Category</option>
          <option value="family">Family</option>
          <option value="friend">Friend</option>
          <option value="work">Work</option>
        </select>
        <p
          v-if="errors?.errors?.category"
          v-for="item in errors?.errors.category"
          class="mesage-error"
        >
          {{ item }}
        </p>
      </div>
      <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input
          type="number"
          id="phone_number"
          v-model="formData.phone_number"
        />
        <p
          v-if="errors?.errors?.phone_number"
          v-for="item in errors?.errors.phone_number"
          class="mesage-error"
        >
          {{ item }}
        </p>
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <textarea id="address" v-model="formData.address"></textarea>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<style scoped>
.image-upload {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.custom-file-upload {
  display: inline-block;
  padding: 10px 20px;
  cursor: pointer;
  background-color: #42b983;
  color: white;
  border-radius: 4px;
  margin-bottom: 10px;
}

#file-input {
  display: none;
}

.image-preview {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  overflow: hidden;
  border: 2px solid #42b983;
}

.image-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
