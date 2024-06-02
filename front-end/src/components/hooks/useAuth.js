import { useRouter } from "vue-router";
import { inject, ref } from "vue";
import VueCookies from "vue-cookies";

import Api from "../utils/axios";

export function useAuth() {
  const router = useRouter();
  const showNotification = inject("showNotification");
  const errors = ref(null);

  const login = async (formLogin) => {
    try {
      await Api.get("/sanctum/csrf-cookie");
      const { data } = (await Api.post("/login", formLogin)).data;
      const user = (
        await Api.get("/api/user", {
          headers: { Authorization: `Bearer ${data}` },
        })
      ).data;
      VueCookies.set("token", data, "2h");
      VueCookies.set("user", user, "2h");

      showNotification("Login Successfuly", "success");

      router.push({ name: "home" });
    } catch (error) {
      console.error("Error during login", error);
    }
  };

  const registrasi = async (formRegistrasi) => {
    try {
      await Api.get("/sanctum/csrf-cookie");
      const { data } = (await Api.post("/register", formRegistrasi)).data;
      const user = (
        await Api.get("/api/user", {
          headers: { Authorization: `Bearer ${data}` },
        })
      ).data;
      VueCookies.set("token", data, "2h");
      VueCookies.set("user", user, "2h");

      showNotification("Registration Successfuly", "success");

      router.push({ name: "home" });
    } catch (error) {
      errors.value = error.response.data;
      console.log(error.response.data);
      showNotification("Registration Failed", "error");
    }
  };

  return {
    errors,
    login,
    registrasi,
  };
}
