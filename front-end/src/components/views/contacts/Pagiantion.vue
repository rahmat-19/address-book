<script setup>
import Button from "../../hallper/Button.vue";
defineProps(["pagination"]);
const emit = defineEmits(["click:prev", "click:next"]);
const handlePagination = (value) => {
  console.log(value);
  if (value == "prev") emit("click:prev");
  if (value == "next") emit("click:next");
};
</script>
<template>
  <div class="pagination">
    <Button
      variant="jade"
      size="medium"
      @click="handlePagination('prev')"
      :disabled="!pagination.prev_page_url"
    >
      Previous
    </Button>

    <span class="pagination-info"
      >Page {{ pagination.current_page }} of {{ pagination.last_page }}</span
    >

    <Button
      variant="jade"
      size="medium"
      @click="handlePagination('next')"
      :disabled="!pagination.next_page_url"
    >
      Next
    </Button>
  </div>
</template>

<style>
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin-top: 20px;
  margin-bottom: 2rem;
}
</style>
