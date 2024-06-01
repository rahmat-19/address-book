//import vue router
import { createRouter, createWebHistory } from "vue-router";

//define a routes
const routes = [
  {
    path: "/",
    name: "home",
    component: () => import(/* webpackChunkName: "home" */ "../views/home.vue"),
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
  linkActiveClass: "active",
  history: createWebHistory(),
  routes, // <-- routes,
});

export default router;
