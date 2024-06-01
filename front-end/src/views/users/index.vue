<script setup>
import { ref } from "vue";
import { useFetchUsers } from "../../components/hooks/useFetchUsers";
// import FillterUssers from "../../components/views/users/FillterUsers.vue";
import { useRouter } from "vue-router";

const router = useRouter();

const searchQuery = ref("");
const activeFilter = ref("");
const selectedCategory = ref("");
const currentPage = ref(1);

const {
  users,
  pagination,
  fetchDataUsers,
  getUsesrExportExcel,
  deleteUserSelected,
} = useFetchUsers(searchQuery, activeFilter, selectedCategory, currentPage);
const prevPage = () => {
  if (pagination.value.prev_page_url) {
    currentPage.value--;
  }
};

const nextPage = () => {
  if (pagination.value.next_page_url) {
    currentPage.value++;
  }
};

const redirectPageCreateContact = () => {
  router.push({ name: "users.create" });
};
const redirectPageUpdateContact = (id) => {
  router.push({
    name: "users.update",
    params: { id },
    // query: { query: "update" },
  });
};
</script>

<template>
  <div class="container-users">
    <div class="body-filter">
      <p>-- Filtered Data Users --</p>
      <div>
        <!-- Search Input -->
        <div>
          <label for="search">Search:</label>
          <input
            id="search"
            type="text"
            v-model="searchQuery"
            placeholder="Search..."
          />
        </div>

        <!-- Select Active/Non-active -->
        <div>
          <label for="status">Status:</label>
          <select id="status" v-model="activeFilter">
            <option value="">All</option>
            <option value="1">Active</option>
            <option value="0">Non-active</option>
          </select>
        </div>

        <!-- Select Country -->
        <div>
          <label for="country">Country:</label>
          <select id="country" v-model="selectedCategory">
            <option value="">All</option>
            <option value="family">Family</option>
            <option value="friend">Friend</option>
            <option value="work">Work</option>
          </select>
        </div>
      </div>
    </div>
    <div class="body-users">
      <div class="user-data-header">
        <div>
          <p>-- Data Users --</p>
        </div>
        <div class="button-group">
          <button class="action-btn-create" @click="getUsesrExportExcel">
            Export
          </button>
          <button class="action-btn-create">Import</button>
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
            <td colspan="5" class="alert-not-available">Data Not Available!</td>
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
