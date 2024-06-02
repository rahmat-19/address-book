<template>
  <div class="body-filter">
    <p class="titile">-- Filtered Data Contacts --</p>
    <div class="item-filter">
      <!-- Search Input -->
      <div>
        <label for="search">Search:</label>
        <input
          id="search"
          v-model="searchQuery"
          @input="onChangeSearch"
          type="text"
          placeholder="Search..."
        />
      </div>

      <!-- Select Active/Non-active -->
      <div>
        <label for="status">Status:</label>

        <select id="status" v-model="activeFilter" @change="onChangeStatus">
          <option value="">All</option>
          <option value="1">Active</option>
          <option value="0">Non-active</option>
        </select>
      </div>

      <!-- Select Category -->
      <div>
        <label for="country">Category:</label>
        <select
          id="country"
          v-model="selectedCategory"
          @change="onChangeCategory"
        >
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
import { ref } from "vue";

const emit = defineEmits(["change:serach", "change:category", "change:status"]);

const searchQuery = ref("");
const activeFilter = ref("");
const selectedCategory = ref("");

const onChangeSearch = () => {
  emit("change:serach", searchQuery.value);
};
const onChangeCategory = () => {
  emit("change:category", selectedCategory.value);
};
const onChangeStatus = () => {
  emit("change:status", activeFilter.value);
};
</script>

<style>
@media screen and (max-width: 768px) {
  .titile {
    display: none;
  }
  .item-filter {
    display: flex;
    flex-direction: column;
  }
}
</style>
