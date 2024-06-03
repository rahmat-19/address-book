//import vue router
import { createRouter, createWebHistory } from "vue-router";
import VueCookies from "vue-cookies";

const routes = [
  {
    path: "/",
    name: "home",
    component: () => import("../views/home.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () => import("../views/auth/login.vue"),
  },
  {
    path: "/register",
    name: "register",
    component: () => import("../views/auth/register.vue"),
  },
  {
    path: "/contact",
    name: "users.index",
    component: () => import("../views/contacts/index.vue"),
  },
  {
    path: "/contact/create",
    name: "users.create",
    component: () => import("../views/contacts/create.vue"),
  },
  {
    path: "/contact/:id",
    name: "users.update",
    component: () => import("../views/contacts/update.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from, next) => {
  const isAuthenticated = VueCookies.get("token");
  if (to.name !== "login" && to.name !== "register" && !isAuthenticated)
    next({ name: "login" });
  else if (to.name == "login" && isAuthenticated) next({ name: "home" });
  else next();
});

export default router;
