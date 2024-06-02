import { createApp } from "vue";
import { createPinia } from "pinia";
import VueCookies from "vue-cookies";

import App from "./App.vue";

import router from "./router/index";
import "./style.css";
import { useAuthStore } from "./components/stores/authStore";

const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);

const authStore = useAuthStore();
authStore.getUserCookie();

app.mount("#app");
