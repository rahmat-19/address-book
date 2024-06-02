<template>
  <div>
    <nav>
      <div class="title-navbar">Countac Mange</div>
      <div v-if="isLoggedIn" class="item-navbar">
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
          >Users</router-link
        >
      </div>
      <div v-if="isLoggedIn" class="item-logout" @click="handleLogout">
        <span>Logout</span>
      </div>
    </nav>

    <NotificationProvider>
      <!--- render router view -->
      <router-view class="body-component"></router-view>
    </NotificationProvider>
  </div>
</template>

<script>
import NotificationProvider from "./components/utils/NotificationProvider.vue";
import Api from "./components/utils/axios";
import { clearAllCookies } from "./components/utils/clearCookies";
import { getHeaderConfigAxios } from "./components/utils/getHeaderConfigAxios";
import VueCookies from "vue-cookies";

export default {
  components: { NotificationProvider },
  computed: {
    isLoggedIn() {
      return !!VueCookies.get("token"); // or however you determine if a user is logged in
    },
  },
  methods: {
    handleLogout() {
      Api.post("logout", {}, getHeaderConfigAxios());
      clearAllCookies();
      this.$router.push({ name: "login" });
    },
  },
};
</script>
