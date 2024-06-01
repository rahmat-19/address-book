<script setup>
import { onMounted, ref } from "vue";
import Api from "../../components/utils/axios";
import { useRouter, onBeforeRouteUpdate, useRoute } from "vue-router";

const router = useRouter();
const route = useRoute();

const user = ref(null);
const errors = ref(null);
const formData = ref({
  name: "",
  category: "",
  phone_number: "62",
  address: "",
});

const submitForm = async () => {
  await Api.patch(`/users/${route.params.id}`, formData.value)
    .then(() => {
      router.push({ name: "users.index" });
    })
    .catch((error) => {
      errors.value = error.response.data;
    });
};

const getUserSelected = async (id) => {
  const { data } = (await Api.get(`/users/${id}`)).data;
  formData.value.name = data.name;
  formData.value.category = data.category;
  formData.value.phone_number = data.phone_number;
  formData.value.address = data.address;
  return (user.value = data);
};
onMounted(() => {
  if (route.params.id) {
    getUserSelected(route.params.id);
  }
});
// Hook untuk mengeksekusi logika sebelum rute dimasukkan
// onBeforeRouteEnter((to, from, next) => {
//     next((vm) => {
//       // Menyimpan data ke dalam state
//       vm.user.value = "dskfjdskfj";
//     });
//   fetchUserData(to.params.userId)
//     .then((data) => {
//     })
//     .catch(() => {
//       next("/error"); // Alihkan ke halaman error jika terjadi kesalahan
//     });
// });
</script>

<template>
  <div class="form-container">
    <form @submit.prevent="submitForm">
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
