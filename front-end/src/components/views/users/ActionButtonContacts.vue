<script setup>
defineProps(["getUsesrExportExcel", "redirectPageCreateContact", "openModal"]);
</script>

<template>
  <div class="user-data-header">
    <div>
      <p class="titile">-- Data Contacts --</p>
    </div>
    <div class="button-group">
      <button class="action-btn-create" @click="getUsesrExportExcel">
        Export
      </button>
      <button class="action-btn-create" @click="openModal">Import</button>
      <button class="action-btn-create" @click="redirectPageCreateContact">
        + Create User
      </button>
    </div>
  </div>
</template>

<style>
@media screen and (max-width: 768px) {
  .titile {
    display: none;
  }
}
</style>
