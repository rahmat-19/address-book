<template>
  <div class="user-data-header">
    <div>
      <p class="titile">-- Data Contacts --</p>
    </div>
    <div class="button-group">
      <Button variant="gold" size="medium" @click="handleButtonClick('export')">
        Export
      </Button>
      <Button variant="gold" size="medium" @click="handleButtonClick('modal')">
        Import
      </Button>
      <Button
        variant="gold"
        size="medium"
        @click="handleButtonClick('redirect-create')"
      >
        + Create Contact
      </Button>
    </div>
  </div>
</template>

<script setup>
import Button from "../../hallper/Button.vue";
const emits = defineEmits([
  "close:modal",
  "click:export",
  "click:redirect:create",
]);

const handleButtonClick = (event) => {
  if (event == "modal") emits("close:modal");
  if (event == "export") emits("click:export");
  if (event == "redirect-create") emits("click:redirect:create");
};
</script>

<style>
@media screen and (max-width: 768px) {
  .titile {
    display: none;
  }
}
</style>
