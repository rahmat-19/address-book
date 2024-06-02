import { defineStore } from "pinia";
import Api from "../utils/axios";
import VueCookies from "vue-cookies";

export const useAuthStore = defineStore("auth", {
  state: () => {
    authUser: null;
  },
  getters: {
    user: (state) => state.authUser,
  },

  actions: {
    async getUserLogin(token) {
      const { data } = await Api.get("/api/user", {
        headers: { Authorization: `Bearer ${token}` },
      });
      VueCookies.set("user", data, "2h");

      this.authUser = data;
    },

    async getUserCookie() {
      this.authUser = VueCookies.get("user");
    },

    async handleLogout() {
      this.authUser = null;
    },
  },
});
