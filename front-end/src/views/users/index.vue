<script setup>
import { inject, ref } from "vue";
import { useFetchUsers } from "../../components/hooks/useFetchUsers";
import FillterUssers from "../../components/views/users/FillterUsers.vue";
import { useRouter } from "vue-router";

const router = useRouter();

const searchQuery = ref("");
const activeFilter = ref("");
const selectedCategory = ref("");
const currentPage = ref(1);

const { users, pagination, getUsesrExportExcel, deleteUserSelected } =
  useFetchUsers(searchQuery, activeFilter, selectedCategory, currentPage);

const showNotification = inject("showNotification");
const notify = () => {
  showNotification("sdkjhgfsd", "success");
};
const prevPage = () => {
  if (pagination.value.prev_page_url) {
    pagination.value.current_page--;
  }
};
const nextPage = () => {
  if (pagination.value.next_page_url) {
    pagination.value.current_page++;
  }
};
const redirectPageCreateContact = () => {
  router.push({ name: "users.create" });
};
const redirectPageUpdateContact = (id) => {
  router.push({
    name: "users.update",
    params: { id },
  });
};
const onChangeSearch = (value) => {
  searchQuery.value = value;
};
const onChangeCategory = (value) => {
  selectedCategory.value = value;
};
const onChangeStatus = (value) => {
  activeFilter.value = value;
};
</script>

<template>
  <div class="container-users">
    <FillterUssers
      @change:serach="onChangeSearch"
      @change:category="onChangeCategory"
      @change:status="onChangeStatus"
    ></FillterUssers>
    <div class="body-users">
      <div class="user-data-header">
        <div>
          <p>-- Data Users --</p>
        </div>
        <div class="button-group">
          <button class="action-btn-create" @click="getUsesrExportExcel">
            Export
          </button>
          <button class="action-btn-create" @click="notify">Import</button>
          <button class="action-btn-create" @click="redirectPageCreateContact">
            + Create User
          </button>
        </div>
      </div>

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
          <tr v-if="users.length == 0">
            <td colspan="6" class="alert-not-available">Data Not Available!</td>
          </tr>
          <tr v-else v-for="(user, index) in users" :key="index">
            <td>{{ user?.name }}</td>
            <td>+{{ user?.phone_number }}</td>
            <td>{{ user?.active ? "Active" : "Not Active" }}</td>
            <td>{{ user?.address }}</td>
            <td>{{ user?.category }}</td>
            <td>
              <div class="button-group-table">
                <button
                  class="action-btn-edit"
                  @click="redirectPageUpdateContact(user?.id)"
                >
                  Edit
                </button>
                <button
                  class="action-btn-delete"
                  @click="deleteUserSelected(user?.id)"
                >
                  Delete
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="pagination">
        <button @click="prevPage" :disabled="!pagination.prev_page_url">
          Previous
        </button>
        <span
          >Page {{ pagination.current_page }} of
          {{ pagination.last_page }}</span
        >
        <button @click="nextPage" :disabled="!pagination.next_page_url">
          Next
        </button>
      </div>
    </div>
  </div>
</template>
