<template>
  <div class="user-data-header">
    <div>
      <p class="titile">-- Data Contacts --</p>
    </div>
    <div class="button-group">
      <button class="action-btn-create" @click="$emit('click:export')">
        Export
      </button>
      <button class="action-btn-create" @click="$emit('close:modal')">
        Import
      </button>
      <button class="action-btn-create" @click="$emit('click:redirect:create')">
        + Create Contact
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
