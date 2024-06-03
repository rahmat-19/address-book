<script setup>
defineProps(["message", "type"]);
</script>
<template>
  <div class="notification" :class="type">
    <span class="title">{{ type }}</span>
    <span class="message">{{ message }}</span>
  </div>
</template>
