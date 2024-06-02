<template>
  <div class="register-container">
    <div class="register-box">
      <h1>Register</h1>
      <form @submit.prevent="handleRegistrasi">
        <div class="input-group">
          <label for="username">name</label>
          <input
            type="text"
            id="username"
            v-model="formRegistration.name"
            required
          />
          <p
            v-if="errors?.errors?.name"
            v-for="item in errors?.errors.name"
            class="mesage-error"
          >
            {{ item }}
          </p>
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            v-model="formRegistration.email"
            required
          />
          <p
            v-if="errors?.errors?.email"
            v-for="item in errors?.errors.email"
            class="mesage-error"
          >
            {{ item }}
          </p>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            v-model="formRegistration.password"
            required
          />
          <p
            v-if="errors?.errors?.password"
            v-for="item in errors?.errors.password"
            class="mesage-error"
          >
            {{ item }}
          </p>
        </div>

        <button type="submit">Register</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuth } from "../../components/hooks/useAuth";

const { registrasi, errors } = useAuth();

const formRegistration = ref({
  name: "",
  email: "",
  password: "",
});

const handleRegistrasi = async () => {
  registrasi(formRegistration.value);
};
</script>

<style scoped>
.register-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
}

.register-box {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  width: 300px;
  text-align: center;
}

.register-box h1 {
  margin-bottom: 20px;
}

.input-group {
  margin-bottom: 15px;
  text-align: left;
}

.input-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.input-group input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #218838;
}
</style>
