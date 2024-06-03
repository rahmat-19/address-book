<template>
  <div>
    <nav>
      <div class="title-navbar">Address Book</div>
      <div v-if="useAuthPinia.user" class="item-navbar">
        <router-link
          :to="{ name: 'home' }"
          class="item"
          exactActiveClass="active"
          >Dahboard</router-link
        >
        <router-link
          :to="{ name: 'users.index' }"
          exactActiveClass="active"
          class="item"
          >Contact</router-link
        >
      </div>
      <div v-if="useAuthPinia.user" class="item-logout" @click="handleLogout">
        <span>Logout</span>
      </div>
    </nav>

    <NotificationProvider>
      <!--- render router view -->
      <router-view class="body-component"></router-view>
    </NotificationProvider>
  </div>
</template>

<script setup>
import { clearAllCookies } from "./components/utils/clearCookies";
import { getHeaderConfigAxios } from "./components/utils/getHeaderConfigAxios";
import { useAuthStore } from "./components/stores/authStore";
import { useRouter } from "vue-router";

import NotificationProvider from "./components/hallper/NotificationProvider.vue";
import Api from "./components/utils/axios";

const useAuthPinia = useAuthStore();
const router = useRouter();
const handleLogout = () => {
  Api.post("logout", {}, getHeaderConfigAxios());
  clearAllCookies();
  useAuthPinia.handleLogout();

  router.push({ name: "login" });
};
</script>
