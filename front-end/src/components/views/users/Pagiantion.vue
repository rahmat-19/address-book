<script setup>
defineProps(["pagination"]);
</script>
<template>
  <div class="pagination">
    <button
      class="pagination-button"
      @click="$emit('click:prev')"
      :disabled="!pagination.prev_page_url"
    >
      Previous
    </button>
    <span class="pagination-info"
      >Page {{ pagination.current_page }} of {{ pagination.last_page }}</span
    >
    <button
      class="pagination-button"
      @click="$emit('click:next')"
      :disabled="!pagination.next_page_url"
    >
      Next
    </button>
  </div>
</template>

<style>
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.pagination-button {
  padding: 8px 16px;
  margin: 0 5px;
  border: 1px solid #ccc;
  background-color: #f9f9f9;
  color: #333;
  cursor: pointer;
  border-radius: 4px;
}

.pagination-button:hover {
  background-color: #e0e0e0;
}

.pagination-button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.pagination-info {
  margin: 0 10px;
}
</style>
