<template>
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
</template>

<script setup>
// import { ref } from "vue";

// const searchQuery = ref("");
// const activeFilter = ref("");
// const selectedCategory = ref("");
defineProps(["searchQuery", "activeFilter", "selectedCategory"]);
</script>
