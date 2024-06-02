<template>
  <div>
    <slot></slot>
    <Notification v-for="(notification, index) in notifications" :key="index" />
  </div>
</template>

<script>
import { ref, provide } from "vue";
import Notification from "./Notification.vue";

export default {
  components: { Notification },
  setup() {
    const notifications = ref([]);

    const showNotification = (message, type = "info") => {
      notifications.value.push({ message, type });
      setTimeout(() => {
        notifications.value.shift();
      }, 3000);
    };

    provide("showNotification", showNotification);

    return { notifications };
  },
};
</script>

<style scoped>
.notification-container {
  position: fixed;
  top: 10px;
  right: 10px;
  z-index: 1000;
}
</style>
