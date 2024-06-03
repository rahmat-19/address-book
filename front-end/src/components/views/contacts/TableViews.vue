<script setup>
import Button from "../../hallper/Button.vue";

defineProps(["contacts"]);
const emit = defineEmits([
  "click:update:status",
  "click:redirect:update",
  "click:delete",
]);
const handelButton = (emitKey, arg1 = null, arg2 = null) => {
  if (emitKey == "status") emit("click:update:status", arg1, arg2);
  if (emitKey == "update") emit("click:redirect:update", arg1);
  if (emitKey == "delete") emit("click:delete", arg1);
};
</script>

<template>
  <div class="table-container">
    <table class="styled-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Active</th>
          <th>Address</th>
          <th>Category</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="contacts.length == 0">
          <td colspan="6" class="alert-not-available">Data Not Available!</td>
        </tr>
        <tr v-else v-for="(contact, index) in contacts" :key="index">
          <td>{{ contact?.name }}</td>
          <td>+{{ contact?.phone_number }}</td>
          <td>
            <Button
              size="small"
              @click="handelButton('status', contact?.id, contact.active)"
            >
              {{ contact?.active ? "Active" : "Not Active" }}
            </Button>
          </td>
          <td>{{ contact?.address }}</td>
          <td>{{ contact?.category }}</td>
          <td>
            <div class="button-group-table">
              <Button
                size="small"
                variant="gold"
                @click="handelButton('update', contact?.id)"
              >
                Edit
              </Button>
              <Button
                size="small"
                variant="danger"
                @click="handelButton('delete', contact?.id)"
              >
                Delete
              </Button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
