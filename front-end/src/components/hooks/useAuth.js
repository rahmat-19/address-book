import { useRouter } from "vue-router";
import { inject, ref } from "vue";
import { useAuthStore } from "../../components/stores/authStore";

import VueCookies from "vue-cookies";
import Api from "../utils/axios";

export function useAuth() {
  const router = useRouter();
  const showNotification = inject("showNotification");
  const errors = ref(null);
  const useAuthPinia = useAuthStore();

  const login = async (formLogin) => {
    try {
      await Api.get("/sanctum/csrf-cookie");
      const { data } = (await Api.post("/login", formLogin)).data;
      useAuthPinia.getUserLogin(data);
      VueCookies.set("token", data, "2h");

      showNotification("Login Successfuly", "success");

      router.push({ name: "home" });
    } catch (error) {
      showNotification("Login Failed", "error");
      console.error("Error during login", error);
    }
  };

  const registrasi = async (formRegistrasi) => {
    try {
      await Api.get("/sanctum/csrf-cookie");
      const { data } = (await Api.post("/register", formRegistrasi)).data;
      VueCookies.set("token", data, "2h");
      useAuthPinia.getUserLogin(data);

      showNotification("Registration Successfuly", "success");

      router.push({ name: "home" });
    } catch (error) {
      errors.value = error.response.data;
      showNotification("Registration Failed", "error");
    }
  };

  return {
    errors,
    login,
    registrasi,
  };
}
