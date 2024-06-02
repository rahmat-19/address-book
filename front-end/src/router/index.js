//import vue router
import { createRouter, createWebHistory } from "vue-router";
import VueCookies from "vue-cookies";

//define a routes
const routes = [
  {
    path: "/",
    name: "home",
    component: () => import(/* webpackChunkName: "home" */ "../views/home.vue"),
  },
  {
    path: "/login",
    name: "login",
    component: () =>
      import(/* webpackChunkName: "home" */ "../views/auth/login.vue"),
  },
  {
    path: "/register",
    name: "register",
    // ASYNC IMPORT
    component: () =>
      import(/* webpackChunkName: "home" */ "../views/auth/register.vue"),
  },
  {
    path: "/users",
    name: "users.index",
    component: () =>
      import(/* webpackChunkName: "index" */ "../views/users/index.vue"),
  },
  {
    path: "/users/create",
    name: "users.create",
    component: () =>
      import(/* webpackChunkName: "index" */ "../views/users/create.vue"),
  },
  {
    path: "/users/:id",
    name: "users.update",
    component: () =>
      import(/* webpackChunkName: "index" */ "../views/users/update.vue"),
  },
];

//create router
const router = createRouter({
  // linkActiveClass: "active",
  history: createWebHistory(),
  routes, // <-- routes,
});

console.log(VueCookies.get("user"), "=====");
const isAuthenticated = VueCookies.get("user");

router.beforeEach(async (to, from, next) => {
  if (to.name !== "login" && !isAuthenticated) next({ name: "login" });
  else if (to.name == "login" && isAuthenticated) next({ name: "home" });
  else next();
});

export default router;
