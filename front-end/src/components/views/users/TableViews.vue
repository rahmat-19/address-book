<script setup>
defineProps(["contacts"]);
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
          <td>{{ contact?.active ? "Active" : "Not Active" }}</td>
          <td>{{ contact?.address }}</td>
          <td>{{ contact?.category }}</td>
          <td>
            <div class="button-group-table">
              <button
                class="action-btn-edit"
                @click="$emit('click:redirect:update', contact?.id)"
              >
                Edit
              </button>
              <button
                class="action-btn-delete"
                @click="$emit('click:delete', contact?.id)"
              >
                Delete
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
