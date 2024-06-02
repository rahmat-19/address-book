<template>
  <div>
    <nav>
      <div class="title-navbar">Countac Mange</div>
      <div class="item-navbar">
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
    </nav>

    <NotificationProvider>
      <!--- render router view -->
      <router-view class="body-component"></router-view>
    </NotificationProvider>
  </div>
</template>

<script>
import NotificationProvider from "./components/utils/NotificationProvider.vue";

export default {
  components: { NotificationProvider },
};
</script>
