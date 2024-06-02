<script setup>
import { onMounted, ref } from "vue";
import Api from "../components/utils/axios";

const groupBy = ref(null);

const fetchDataUsers = async () => {
  const { data } = (await Api.get("/users/dashboard/group-by")).data;
  groupBy.value = data;
};

onMounted(() => {
  //call method "fetchDataUsers"
  fetchDataUsers();
});
</script>

<template>
  <div>
    <p>Dashboard</p>
    <div class="dashboard">
      <div class="dashboard-item-1 dashboard-item">
        <p>Total User</p>
        <p>{{ groupBy?.totalUsers }}</p>
      </div>
      <div class="dashboard-item-2 dashboard-item">
        <p>Active User</p>
        <p>{{ groupBy?.totalUsers }}</p>
      </div>
      <div class="dashboard-item-3 dashboard-item">
        <p>Not Active User</p>
        <p>{{ groupBy?.totalUsers }}</p>
      </div>
      <div class="dashboard-item-4 dashboard-item">
        <p>Total Users</p>
        <p>{{ groupBy?.totalUsers }}</p>
      </div>
      <div class="dashboard-item-5 dashboard-item">
        <p>Total Users</p>
        <p>{{ groupBy?.totalUsers }}</p>
      </div>
      <div class="dashboard-item-6 dashboard-item">
        <p>Total Users</p>
        <p>{{ groupBy?.totalUsers }}</p>
      </div>
    </div>
  </div>
</template>
