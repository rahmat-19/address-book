<script setup>
import { useFatchDashboard } from "../components/hooks/useFatchDashboard";

const { groupBy } = useFatchDashboard();
</script>

<template>
  <div>
    <p>Dashboard</p>
    <div class="dashboard">
      <div class="dashboard-item-1 dashboard-item">
        <p>Total Contact</p>
        <p>{{ groupBy?.totalUsers ?? 0 }}</p>
      </div>
      <div class="dashboard-item-2 dashboard-item">
        <p>Active Contact</p>
        <p>{{ groupBy?.activceCount?.activeCount ?? 0 }}</p>
      </div>
      <div class="dashboard-item-3 dashboard-item">
        <p>Not Active Contact</p>
        <p>{{ groupBy?.activceCount?.notActiveCount ?? 0 }}</p>
      </div>
      <div class="dashboard-item-4 dashboard-item">
        <p>Category Family</p>
        <p>{{ groupBy?.categoryCounts?.family ?? 0 }}</p>
      </div>
      <div class="dashboard-item-5 dashboard-item">
        <p>Category Friend</p>
        <p>{{ groupBy?.categoryCounts?.friend ?? 0 }}</p>
      </div>
      <div class="dashboard-item-6 dashboard-item">
        <p>Category Work</p>
        <p>{{ groupBy?.categoryCounts?.work ?? 0 }}</p>
      </div>
    </div>
  </div>
</template>
